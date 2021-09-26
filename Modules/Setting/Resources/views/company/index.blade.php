@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">Configuraciones</li>
    <li class="breadcrumb-item">Empresa</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-tachometer-alt-fast'></i>Datos <span class='fw-300'>Generales</span> <sup class='badge badge-primary fw-500'>Modificar</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        Modificar
    </div>
@endsection
@section('content')
@livewire('setting::company.company-data')
@endsection
