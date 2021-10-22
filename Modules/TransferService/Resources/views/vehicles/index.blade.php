@extends('transferservice::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('transferservice::labels.service_title')</li>
    <li class="breadcrumb-item">{{ __('transferservice::labels.lbl_vehicles') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-truck'></i>{{ __('transferservice::labels.lbl_vehicles') }} <sup class='badge badge-primary fw-500'>{{__('transferservice::labels.lbl_list')}}</sup>
        <small>@lang('transferservice::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('transferservice::labels.lbl_list')
    </div>
@endsection
@section('content')
@livewire('transferservice::vehicles.vehicles-list')
@endsection
