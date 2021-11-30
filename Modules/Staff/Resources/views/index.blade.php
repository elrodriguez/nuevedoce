@extends('staff::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('staff::labels.module_name') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-tachometer-alt-fast'></i>Tablero <span class='fw-300'>de resumen</span> <sup class='badge badge-primary fw-500'>New</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        Dashboard
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-6 col-xl-3">
        @livewire('staff::companies.companies-quantity')
    </div>
    <div class="col-sm-6 col-xl-3">
        @livewire('staff::employees.employees-quantity')
    </div>
</div>
@endsection
