@extends('inventory::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">Inventario</li>
    <li class="breadcrumb-item">Activo</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="ni ni-social-dropbox"></i></i>Activos<sup class='badge badge-primary fw-500'>List</sup>   
    </h1>
    <div class="subheader-block">
        Listado
    </div>
@endsection
@section('content')
@livewire('inventory::asset.asset-list')
@endsection
