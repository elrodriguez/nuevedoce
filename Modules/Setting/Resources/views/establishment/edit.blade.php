@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">Configuraciones</li>
    <li class="breadcrumb-item"><a href="{{ route('setting_establishment') }}">{{ __('setting::labels.establishment') }}</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-users'></i>{{ __('setting::labels.establishment') }} <sup class='badge badge-primary fw-500'>New</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        Nuevo
    </div>
@endsection
@section('content')
@livewire('setting::establishment.establishment-edit',['establishment_id' => $id])
@endsection

