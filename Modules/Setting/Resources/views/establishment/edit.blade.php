@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">Configuraciones</li>
    <li class="breadcrumb-item"><a href="{{ route('setting_establishment') }}">{{ __('setting::labels.establishment') }}</a></li>
    <li class="breadcrumb-item active">{{ __('setting::labels.new') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-store-alt'></i>{{ __('setting::labels.establishment') }} <sup class='badge badge-primary fw-500'>New</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        {{ __('setting::labels.new') }}
    </div>
@endsection
@section('content')
@livewire('setting::establishment.establishment-edit',['establishment_id' => $id])
@endsection

