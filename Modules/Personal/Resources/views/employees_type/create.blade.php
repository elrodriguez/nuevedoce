@extends('personal::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('personal::labels.lbl_personal')</li>
    <li class="breadcrumb-item"><a href="{{ route('personal_employee-type_index') }}">{{ __('personal::labels.lbl_employee_type') }}</a></li>
    <li class="breadcrumb-item active">@lang('personal::labels.lbl_new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-people-arrows'></i>{{ __('personal::labels.lbl_employee_type') }} <sup class='badge badge-primary fw-500'>@lang('personal::labels.lbl_new')</sup>
        <small>@lang('personal::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('personal::labels.lbl_new')
    </div>
@endsection
@section('content')
    @livewire('personal::employees-type.employees-type-create')
@endsection
