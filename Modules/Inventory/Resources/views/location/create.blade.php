@extends('inventory::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('inventory::labels.lbl_inventory') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('inventory_location') }}">{{ __('inventory::labels.lbl_location') }}</a></li>
    <li class="breadcrumb-item active">{{ __('labels.new') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-map-marker"></i></i>{{ __('inventory::labels.lbl_location') }}<sup class='badge badge-primary fw-500'>New</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.new') }}
    </div>
@endsection
@section('content')
@livewire('inventory::location.location-create')
@endsection
