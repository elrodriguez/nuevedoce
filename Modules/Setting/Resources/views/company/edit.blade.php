@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('setting::labels.settings') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('setting_company') }}">{{ __('setting::labels.companies') }}</a></li>
    <li class="breadcrumb-item active">{{ __('setting::labels.edit') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-city'></i>{{ __('setting::labels.companies') }} <sup class='badge badge-primary fw-500'>Edit</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        {{ __('setting::labels.edit') }}
    </div>
@endsection
@section('content')
@livewire('setting::company.company-edit',['company_id' => $id])
@endsection
