@extends('lend::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('lend::labels.module_name')</li>
    <li class="breadcrumb-item"><a href="{{ route('lend_paymentmethod_index') }}">{{ __('lend::labels.lbl_payment_method') }}</a></li>
    <li class="breadcrumb-item active">@lang('lend::labels.lbl_new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-funnel-dollar'></i>{{ __('lend::labels.lbl_payment_method') }} <sup class='badge badge-primary fw-500'>@lang('lend::labels.lbl_new')</sup>
        <small>@lang('lend::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('lend::labels.lbl_new')
    </div>
@endsection
@section('content')
    @livewire('lend::paymentmethod.paymentmethod-create')
@endsection
