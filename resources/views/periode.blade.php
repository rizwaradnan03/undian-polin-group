@extends('layout.layout')
@section('content')
<div class="col d-flex justify-content-center mt-5">
    <div class="card" style="width: 50%;">
        <div class="card-body">
          <h2 class="card-title text-center">SETUP PERIODE</h2>
          <hr>
        <form action="{{url('/periode')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="input_nama" class="form-label">Nama Periode</label>
                <input type="text" name="nama_periode" class="form-control" id="input_nama" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_undian" class="form-label">Tanggal Periode Undian</label>
                <input type="date" name="tgl_expired" class="form-control" id="tanggal_undian" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="{{url('/')}}" class="btn btn-secondary">Kembali</a>
        </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $('#periode').select2();
    </script>
@endsection