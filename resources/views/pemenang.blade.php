@extends('layout.layout')
@section('content')
    {{-- {{dd($data);}} --}}
    <br>
    {{-- <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{asset('img/banner1.jpg')}}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{asset('img/dana_cepat.jpg')}}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{asset('img/infobank.png')}}" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div> --}}
    <br><br>
    <h1 class="text-center">DATA PEMENANG ({{ $data_judul->nama_periode }})</h1>
    @if (Auth::user())
        <a id="btn-reset" class="btn btn-danger">Reset Database</a>
    @endif
    <hr>
    <table class="table" id="datatables">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Hadiah</th>
                <th scope="col">Nama Pemenang</th>
                <th scope="col">Koperasi</th>
                <th scope="col">Periode</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0; ?>
            @foreach ($data as $d)
                <tr>
                    <th scope="row">{{ ++$no }}</th>
                    <td>{{ $d->nama }}</td>
                    <td>
                        @if ($d->nama_lengkap == null)
                            {{ 'Belum Ada Pemenang' }}
                        @else
                            {{ $d->nama_lengkap }} ({{ $d->noacc }})
                        @endif
                    </td>
                    <td>{{ $d->company }}</td>
                    <td>
                        @if ($d->nama_periode == null)
                            {{ 'Belum Ada Periode' }}
                        @else
                            {{ $d->nama_periode }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
            }, ],
        });

        $('#btn-reset').on("click", function() {
            Swal.fire({
                title: 'Apakah Anda Yakin Untuk Reset Database?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/reset') }}",
                        type: "GET",
                    }).done(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            showConfirmButton: false
                        })
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    })
                }
            })
        })
    </script>
@endsection
