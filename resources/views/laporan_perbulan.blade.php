@extends('layout.layout')
@section('content')
@section('css')
    <style>
        .custom-button {
            background-color: green;
            color: white;
        }
    </style>
@endsection
    <div class="row mt-3">
        <div class="table">
            <table id="datatables" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Rekening</th>
                        <th>Nama</th>
                        <th>Poin s/d Nov</th>
                        <th>Dec</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>Mei</th>
                        <th>Jumlah Poin</th>
                        <th>No Kupon</th>
                        <th>Saldo per akhir periode</th>
                    </tr>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach ($data as $d)
                        <tr>
                            <td>{{++$no}}</td>
                            <td>{{$d->norekening}}</td>
                            <td>{{$d->namalengkap}}</td>
                            <td>{{intval($d->point_sd_nov)}}</td>
                            <td>{{intval($d->point_dec)}}</td>
                            <td>{{intval($d->point_jan)}}</td>
                            <td>{{intval($d->point_feb)}}</td>
                            <td>{{intval($d->point_mar)}}</td>
                            <td>{{intval($d->point_apr)}}</td>
                            <td>{{intval($d->point_mei)}}</td>
                            <td>{{intval($d->total_poin)}}</td> 
                            <td>{{$d->no_kupon}}</td> 
                            <td>{{number_format(intval($d->saldo_akhir_periode), 0, '.', ',')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#datatables').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                            extend: 'excel',
                            text: '<h4 style="font-size: 13px;">Export Excel</h4>',
                            titleAttr: 'Export To Excel',
                            className: 'custom-button'
                        },],

                    });
    </script>
@endsection
