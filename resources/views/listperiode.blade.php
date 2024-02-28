@extends('layout.layout')
@section('content')
<br>
<br>
<h1 class="text-center">DATA PERIODE</h1>
<hr>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="tabel">

</div>
  <table class='table' id='datatables'>
        <thead class='thead-dark'>
          <th scope='col'>No</th>
          <th scope='col'>Nama Periode</th>
          <th scope='col'>Tanggal Pelaksanaan</th>
          <th scope='col'>Status</th>
          <th scope='col'>Aksi</th>
        </thead>
        <tbody>
            <?php $no = 0; ?>
            @foreach ($data as $d)
            <tr>
                <td>{{++$no}}</td>
                <td>{{$d->nama_periode}}</td>
                <td>{{$d->tgl_expired}}</td>
                @if ($d->status == 0)
                    <td><button class='text-success border border-2 border-success rounded bg-light p-3' id='aktif'>Aktif</button></td>
                @elseif ($d->status == 1)
                    <td><button class='text-danger border border-2 border-danger rounded bg-light p-3' id='tidak_aktif' value="{{$d->id}}">Tidak Aktif</button></td>
                @endif
                <td><a href='{{url('/periode/'.$d->id)}}' class='btn btn-warning'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg> Edit</a></td>
            </tr>
            @endforeach
      </tbody>
  </table>

@endsection
@section('js')
    <script>
        $('#datatables').DataTable();

        $('#aktif').on("click", function(){
            Swal.fire({
                title: 'Periode ini sudah aktif!',
                confirmButtonText: 'Ok',
                icon: 'success'
            })
        })

        $('button[id^="tidak_aktif"]').on("click", function(){
            var id = $(this).val();
            Swal.fire({
                title: 'Ingin mengubah periode saat ini?',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                icon: 'question'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{url('/updateperiode')}}",
                        data: {id: id, "_token": $('#token').val()},
                        type: 'POST'
                    }).done(function(response){
                        var data = JSON.parse(response);
                        Swal.fire({
                            title: 'Berhasil Mengubah!',
                            confirmButtonText: 'Ok',
                            icon: 'success'
                        }).then((resultt) =>{
                            if(resultt.isConfirmed){
                                location.reload();
                            }else{
                                location.reload();
                            }
                        })
                    })
                }
            })
        })
    </script>
@endsection
