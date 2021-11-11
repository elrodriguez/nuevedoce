@extends('inventory::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('inventory::labels.lbl_inventory') }}</li>
    <li class="breadcrumb-item active">{{ __('inventory::labels.lbl_location') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-map-marker"></i></i>{{ __('inventory::labels.lbl_location') }}<sup class='badge badge-primary fw-500'>List</sup>   
    </h1>
    <div class="subheader-block">
        Listado
    </div>
@endsection
@section('content')
@livewire('inventory::location.location-list')
@endsection
