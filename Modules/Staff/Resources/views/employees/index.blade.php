@extends('staff::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('staff::labels.module_name')</li>
    <li class="breadcrumb-item">{{ __('staff::labels.lbl_employees') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-users'></i>{{ __('staff::labels.lbl_employees') }} <sup class='badge badge-primary fw-500'>{{__('staff::labels.lbl_list')}}</sup>
        <small>@lang('staff::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('staff::labels.lbl_list')
    </div>
@endsection
@section('content')
@livewire('staff::employees.employees-list')
@endsection
