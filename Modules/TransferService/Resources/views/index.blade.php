@extends('transferservice::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('transferservice::labels.service_title') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-tachometer-alt-fast'></i>Tablero <span class='fw-300'>de resumen</span> <sup class='badge badge-primary fw-500'>New</sup>
        <small>{{ __('transferservice::labels.lbl_available_user') }}</small>
    </h1>
    <div class="subheader-block">
        {{ __('transferservice::labels.lbl_dashBoard') }}
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            @livewire('transferservice::customers.customers-quantity')
        </div>
        <div class="col-sm-6 col-xl-3">
            @livewire('transferservice::locals.locals-quantity')
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            @livewire('transferservice::odtrequests.odtrequests-quantity')
        </div>
        <div class="col-sm-6 col-xl-3">
            @livewire('transferservice::vehicles.vehicles-quantity')
        </div>
    </div>
@endsection
