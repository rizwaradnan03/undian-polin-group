<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="icon" href="https://asset.kompas.com/crops/IJ-bLTGuXrMSlqB8WC3o_gu_pnY=/124x98:1081x736/1200x800/data/photo/2019/08/07/5d4a15a792eda.jpg" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('asset/leaflet/leaflet.css')}}"/>
    <link href="{{asset('asset/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/datatables/DataTables-1.13.4/css/jquery.dataTables.css')}}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
    <style>
      *{
        font-family: sans-serif;
      }
    </style>
    @yield('css')
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand text-dark ml-2" href="{{url('/')}}"><img src="{{asset('img/koperasi_polin.jpeg')}}" width="200px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{url('/')}}">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{url('/hadiah')}}">Hadiah</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{url('/pemenang')}}">Pemenang Undian</a>
          </li>
          @if (Auth::user())

          @else
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{url('/lokasi')}}">Lokasi Kami</a>
          </li>
          @endif
          @if (Auth::user())
          <li class="nav-item">
            <a class="nav-link text-danger fw-bold" href="{{url('/listperiode')}}">Periode</a>
          </li>
          @endif
          @if (Auth::user())
          <li class="nav-item">
            <a class="nav-link text-danger fw-bold" href="{{url('/pilih-hadiah-undian')}}">Undi</a>
          </li>
          @endif
          @if (Auth::user())
          <li class="nav-item">
            <a class="nav-link text-danger fw-bold" href="{{url('/periode')}}">Setup Periode</a>
          </li>
          @endif
          @if (Auth::user())
          <li class="nav-item">
            <a class="nav-link text-danger fw-bold" href="{{url('/setup')}}">Setup Hadiah</a>
          </li>
          @endif
          @if (Auth::user())
          <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Laporan
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{url('/laporanperolehan')}}">Laporan Perolehan</a></li>
              <li><a class="dropdown-item" href="{{url('/laporanperbulan')}}">Laporan Total Poin</a></li>
            </ul>
          </div>
          @endif
        </ul>
          <li class="nav-item d-flex">
            @if (Auth::user())
            <a class="btn btn-danger" href="{{url('/getLogout')}}">Logout</a>
            @else
            <a class="btn btn-primary" href="{{url('/login')}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</a>
            @endif
          </li>
      </div>
    </div>
  </nav>
  @if ($berhasil_update = Session::get('berhasil_update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{$berhasil_update}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
    @if ($gagal = Session::get('gagal'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{$gagal}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($haruslogin = Session::get('haruslogin'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{$haruslogin}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($berhasil = Session::get('berhasil'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{$berhasil}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container">
        @yield('content')
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{url('/postLogin')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group mb-3">
                <label for="username">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" autofocus>
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
<script src="{{asset('asset/highcharts/code/highcharts.js')}}"></script>
<script src="{{asset('asset/leaflet/leaflet.js')}}"></script>
<script src="{{asset('asset/js/popper.min.js')}}"></script>
<script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
<script src="{{asset('asset/js/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="{{asset('asset/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('asset/js/sweetalert.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script src="{{asset('asset/datatables/DataTables-1.13.4/js/jquery.dataTables.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
@yield('js')
</html>
