@extends('setting::layouts.master')
@section('style')
<style type="text/css">
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
</style>
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">Configuraciones</li>
    <li class="breadcrumb-item"><a href="{{ route('setting_establishment') }}">{{ __('setting::labels.establishment') }}</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-store-alt'></i>{{ __('setting::labels.establishment') }} <sup class='badge badge-primary fw-500'>New</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        Nuevo
    </div>
@endsection
@section('content')
@livewire('setting::establishment.establishment-create')
@endsection
@section('script')
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8pwR-4eX6K60OuUCrR1gIN0YU9AEMU0c&callback=initMap2&libraries=&v=weekly"
      async
    ></script>
    <script>
        function initMap2() {
            console.log('empieza')
            // The location of Uluru
            const uluru = { lat: -25.344, lng: 131.036 };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: uluru,
            });
            console.log('sigue')
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
            console.log(marker)
            console.log(map)
        }
    </script>
@endsection

