@extends('personal::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('personal::labels.lbl_personal')</li>
    <li class="breadcrumb-item">{{ __('personal::labels.lbl_companies') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-landmark'></i>{{ __('personal::labels.lbl_companies') }} <sup class='badge badge-primary fw-500'>{{__('personal::labels.lbl_list')}}</sup>
        <small>@lang('personal::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('personal::labels.lbl_list')
    </div>
@endsection
@section('content')
@livewire('personal::companies.companies-list')
@endsection
