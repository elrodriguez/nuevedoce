@extends('inventory::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('inventory::labels.module_name') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-tachometer-alt-fast'></i>Tablero <span class='fw-300'>de resumen</span> <sup class='badge badge-primary fw-500'>New</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    @livewire('inventory::item.item-number-movements')
@endsection
@section('content')
<div class="row">
    <div class="col-sm-4 col-xl-3">
        @livewire('inventory::location.location-quantity')
    </div>
    <div class="col-sm-4 col-xl-3">
        @livewire('inventory::category.category-quantity')
    </div>
    <div class="col-sm-4 col-xl-3">
        @livewire('inventory::brand.brand-quantity')
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-xl-3">
        @livewire('inventory::item.item-quantity')
    </div>
    <div class="col-sm-4 col-xl-3">
        @livewire('inventory::asset.asset-quantity')
    </div>
    <div class="col-sm-4 col-xl-3">
        @livewire('inventory::purchase.purchase-quantity')
    </div>
</div>
@endsection
