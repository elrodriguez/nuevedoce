@extends('sales::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('sales::labels.module_name') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@stop
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-tachometer-alt-fast'></i>Tablero <span class='fw-300'>de resumen</span> <sup class='badge badge-primary fw-500'>New</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <livewire:sales::dashboard.total-expense />
    <livewire:sales::dashboard.total-sales />
@stop
@section('content')
    <div class="row">
        <div class="col-12 col-sm-6">
            <livewire:sales::dashboard.total-document />
        </div>
        <div class="col-12 col-sm-6">
            <livewire:sales::dashboard.series />
        </div>
    </div>
@stop
@section('script')

<script src="{{ url('themes/smart-admin/js/statistics/flot/flot.bundle.js') }}"></script>
@stop
