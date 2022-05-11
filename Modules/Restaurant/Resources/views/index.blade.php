@extends('restaurant::layouts.master')

@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item active">{{ __('restaurant::labels.module_name') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block">
        <x-js-get-date></x-js-get-date>
    </li>
@stop
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-tachometer-alt-fast'></i>Tablero <span class='fw-300'>de resumen</span> <sup
            class='badge badge-primary fw-500'>New</sup>
        <small>Disponibles para el usuario</small>
    </h1>
@stop
@section('content')

@stop
@section('script')

    <script src="{{ url('themes/smart-admin/js/statistics/flot/flot.bundle.js') }}"></script>
@stop
