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
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACWgWHx0R0SxRW3U_dVDdHWaMNETIjwUM&callback=initMap" async defer></script>
    <script>
        function initMap() {
            
        }
    </script>
@endsection

