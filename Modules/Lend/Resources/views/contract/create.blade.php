@extends('lend::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('lend::labels.module_name')</li>
    <li class="breadcrumb-item"><a href="{{ route('lend_contract_index') }}">{{ __('lend::labels.lbl_contract') }}</a></li>
    <li class="breadcrumb-item active">@lang('lend::labels.lbl_new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-money-check-alt'></i>{{ __('lend::labels.lbl_contract') }} <sup class='badge badge-primary fw-500'>@lang('lend::labels.lbl_new')</sup>
        <small>@lang('lend::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('lend::labels.lbl_new')
    </div>
@endsection
@section('content')

@endsection
