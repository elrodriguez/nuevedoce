@extends('inventory::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">Inventario</li>
    <li class="breadcrumb-item">Marca</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-users'></i>Marcas<sup class='badge badge-primary fw-500'>List</sup>   
    </h1>
    <div class="subheader-block">
        Listado
    </div>
@endsection
@section('content')
@livewire('inventory::brand.brand-list')
@endsection
