@extends('layout.layout')
<style>
    #map{
        height: 400px;
    }
</style>
@section('content')
<br>
    <h1 class="text-center">KANTOR PUSAT</h1>
    <hr>
    <div id="map" class="card shadow-lg p-3 bg-body rounded mt-3">

    </div>
@endsection
@section('js')
    <script>
        var map = L.map('map').setView([-6.403673035259556, 106.83675792603611], 23);
        var redIcon = L.icon({
            iconUrl: "{{asset('asset/leaflet/images/marker-icon-red.png')}}",
            shadowUrl: "{{asset('asset/leaflet/images/marker-shadow.png')}}",
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41],
            bindTooltip: 'Hai'
        });
            L.tileLayer('http://{s}.google.com/vt/lyrs=m&hl=en&x={x}&y={y}&z={z}', {
                        attribution: 'Google',
                        subdomains:['mt0','mt1','mt2','mt3'],
                        maxNativeZoom: 18,
                        maxZoom: 18,
            }).addTo(map),
            marker = L.marker([-6.403673035259556, 106.83675792603611],{icon: redIcon}).addTo(map)
            marker.bindTooltip(
                ,{
                className: 'map_tooltip',
                permanent: true,
                direction: 'right',
                opacity: 1,
                offset: [10,-17],
                sticky: true
            }).openTooltip();
    </script>
    <style>
        .map_tooltip{
        color: red;
        text-align: left;
    }
    </style>
@endsection
