@extends('layout.layout')
@section('content')
<div class="row">
  <div class="col-lg-9">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        {{-- <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button> --}}
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset('img/carousel1.jpg')}}" class="d-block w-100" height="385px" alt="...">
        </div>
        <div class="carousel-item">
          <img src="{{asset('img/carousel2.jpg')}}" class="d-block w-100" height="385px" alt="...">
        </div>
        {{-- <div class="carousel-item">
          <img src="{{asset('img/infobank.png')}}" class="d-block w-100" height="385px" alt="...">
        </div> --}}
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="col-lg-3 card shadow-lg px-3 mb-5 bg-body rounded">
    <div class="row d-flex justify-content-center">
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>

    </div>
    <h1 style="font-size: 150px" class="text-center text-danger">{{$date_diff->days}}</h1>
    <h1 class="text-center">HARI LAGI!</h1>
    <hr>
    <h3 class="text-center">TERUS TINGKATKAN SALDO ANDA!!!</h3>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-6 offset-lg-3">
    <h1>APA ITU UNDIAN POLIN GROUP?</h1>
    <hr>
    <p class="h5">Undian Polin Group merupakan event untuk memeriahkan dan mengapresiasi kepada para nasabah koperasi Polin Group.</p>
  </div>
</div>
@endsection
@section('js')
<script>

</script>
@endsection
