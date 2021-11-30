@extends('staff::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('staff::labels.module_name')</li>
    <li class="breadcrumb-item">{{ __('staff::labels.lbl_employee_type') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-people-arrows'></i>{{ __('staff::labels.lbl_employee_type') }} <sup class='badge badge-primary fw-500'>{{__('staff::labels.lbl_list')}}</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        @lang('staff::labels.lbl_list')
    </div>
@endsection
@section('content')
@livewire('staff::employees-type.employees-type-list')
@endsection
