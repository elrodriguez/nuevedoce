@extends('personal::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('personal::labels.lbl_personal')</li>
    <li class="breadcrumb-item">{{ __('personal::labels.lbl_employee_type') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-people-arrows'></i>{{ __('personal::labels.lbl_employee_type') }} <sup class='badge badge-primary fw-500'>{{__('personal::labels.lbl_list')}}</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        @lang('personal::labels.lbl_list')
    </div>
@endsection
@section('content')
@livewire('personal::employees-type.employees-type-list')
@endsection
