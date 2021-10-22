@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">Configuraciones</li>
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
        @livewire('setting::company.company-data')
    </div>
    <div class="col-sm-6 col-xl-3">
        @livewire('setting::establishment.establishment-quantity')
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-xl-3">
        @livewire('setting::roles.roles-quantity')
    </div>
    <div class="col-sm-4 col-xl-3">
        @livewire('setting::modules.module-quantity')
    </div>
    <div class="col-sm-4 col-xl-3">
        @livewire('setting::user.user-quantity')
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-xl-3">
        @livewire('setting::user.user-sessions')
    </div>
    <div class="col-sm-6 col-xl-3">

    </div>
</div>
@endsection
