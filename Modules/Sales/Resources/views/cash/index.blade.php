@extends('sales::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('theme/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url('theme/css/fa-solid.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url('theme/css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url('theme/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('sales::labels.module_name')</li>
    <li class="breadcrumb-item">@lang('sales::labels.lbl_administration')</li>
    <li class="breadcrumb-item active">@lang('sales::labels.petty_cash')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-cash-register'></i>{{ __('sales::labels.petty_cash') }}<sup class='badge badge-primary fw-500'>{{__('lend::labels.lbl_list')}}</sup>
        <small>@lang('sales::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('labels.list')
    </div>
@endsection
@section('content')
    @livewire('sales::cash.cash-list')
@endsection
@section('script')
    <script src="{{ url('theme/js/dependency/moment/moment.js') }}" defer></script>
    <script src="{{ url('theme/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}" defer></script>
    <script src="{{ url('theme/js/notifications/sweetalert2/sweetalert2.bundle.js') }}" defer></script>
@endsection

