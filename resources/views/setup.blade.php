@extends('layout.layout')
@section('content')
@if ($sukses_tambah = Session::get('sukses_tambah'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{$sukses_tambah}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="col d-flex justify-content-center mt-5">
    <div class="card" style="width: 40%;">
        <div class="card-body">
          <h2 class="card-title text-center">SETUP HADIAH</h2>
          <hr>
        <form action="{{url('/setup')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="input_nama" class="form-label">Nama Hadiah</label>
                <input type="text" name="nama" class="form-control" id="input_nama" required>
            </div>
            <div class="mb-3">
                <label for="input_jumlah" class="form-label">Jumlah Hadiah</label>
                <input type="number" name="jumlah" class="form-control" id="input_jumlah" required>
            </div>
            <div class="mb-3">
                <label for="input_jumlah" class="form-label">Gambar (URL)</label>
                <input type="text" class="form-control" name="gambar" id="input_gambar" required>
            </div>
            <div class="mb-5">
                <label for="periode" class="form-label">Periode</label>
                <select name="periode_id" class="form-control" id="periode" required>
                    <option value="0" disabled selected>--Pilih Periode--</option>
                    @foreach ($data as $d)
                        <option value="{{$d->id}}">({{$d->id}})  {{$d->nama_periode}}</option>
                    @endforeach
                </select>
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
