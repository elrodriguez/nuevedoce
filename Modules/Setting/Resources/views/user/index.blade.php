@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">Configuraciones</li>
    <li class="breadcrumb-item">Usuarios</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-users'></i>Usuarios <span class='fw-300'>Del sistema</span> <sup class='badge badge-primary fw-500'>List</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        Listado
    </div>
@endsection
@section('content')
@livewire('setting::user.user-list')
@endsection
