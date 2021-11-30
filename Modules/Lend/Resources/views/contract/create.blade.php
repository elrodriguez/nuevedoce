@extends('lend::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
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
    @livewire('lend::contract.contract-create')
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js') }}"></script>
    <script src="{{ asset('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
@endsection
