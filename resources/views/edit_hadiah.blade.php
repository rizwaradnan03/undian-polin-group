@extends('layout.layout')
@section('content')
<div class="col d-flex justify-content-center mt-5">
    <div class="card" style="width: 50%;">
        <div class="card-body">
          <h2 class="card-title text-center">EDIT HADIAH {{$data->nama}}</h2>
          <hr>
        <form action="{{url('/undian/'.$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="input_nama" class="form-label">Nama Hadiah</label>
                <input type="text" name="nama" class="form-control" id="input_nama" value="{{$data->nama}}" required>
            </div>
            <div class="mb-3">
                <label for="input_jumlah" class="form-label">Jumlah Hadiah</label>
                <input type="number" name="jumlah" class="form-control" id="input_jumlah" value="{{$data->jumlah}}" required>
            </div>
            <div class="mb-3">
                <label for="input_gambar" class="form-label">Gambar (URL)</label>
                <input type="text" name="gambar" class="form-control" id="input_gambar" value="{{$data->gambar}}" required>
            </div>
            <div class="mb-5">
                <label for="periode" class="form-label">Periode</label>
                <select name="periode_id" class="form-control" id="periode" required>
                    @foreach ($data_select as $d)
                        <option value="{{$d->id}}">({{$d->id}})  {{$d->nama_periode}}</option>
                    @endforeach
                </select>
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
        $('#periode').select2();
    </script>
@endsection
