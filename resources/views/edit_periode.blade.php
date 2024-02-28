@extends('layout.layout')
@section('content')
<div class="col d-flex justify-content-center mt-5">
    <div class="card" style="width: 50%;">
        <div class="card-body">
          <h2 class="card-title text-center">EDIT HADIAH {{$data->nama_periode}}</h2>
          <hr>
        <form action="{{url('/periode/'.$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="input_nama" class="form-label">Nama Periode</label>
                <input type="text" name="nama_periode" class="form-control" id="input_nama" value="{{$data->nama_periode}}" required>
            </div>
            <div class="mb-3">
                <label for="input_jumlah" class="form-label">Tanggal Periode</label>
                <input type="date" name="tgl_expired" class="form-control" id="input_jumlah" value="{{$data->tgl_expired}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Edit Data</button>
            <a href="{{url('/')}}" class="btn btn-secondary">Kembali</a>
        </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
       
    </script>
@endsection