@extends('lend::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('lend::labels.module_name')</li>
    <li class="breadcrumb-item">{{ __('lend::labels.lbl_interest') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-humidity'></i>{{ __('lend::labels.lbl_interest') }} <sup class='badge badge-primary fw-500'>{{__('lend::labels.lbl_list')}}</sup>
        <small>@lang('lend::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('lend::labels.lbl_list')
    </div>
@endsection
@section('content')
    @livewire('lend::interest.interest-list')
@endsection