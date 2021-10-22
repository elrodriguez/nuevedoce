@extends('inventory::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">Inventario</li>
    <li class="breadcrumb-item"><a href="{{ route('inventory_asset') }}">Activos</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="ni ni-social-dropbox"></i>Nuevo <span class='fw-300'>Activo</span> <sup class='badge badge-primary fw-500'>New</sup>
        
    </h1>
    <div class="subheader-block">
        Nuevo
    </div>
@endsection
@section('content')
@livewire('inventory::asset.asset-create')
@endsection
@section('script')
<script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
@endsection
