@extends('transferservice::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('transferservice::labels.service_title')</li>
    <li class="breadcrumb-item"><a href="{{ route('service_customers_index') }}">{{ __('transferservice::labels.lbl_customers') }}</a></li>
    <li class="breadcrumb-item active">@lang('transferservice::labels.lbl_new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-users'></i>{{ __('transferservice::labels.lbl_customers') }} <sup class='badge badge-primary fw-500'>@lang('transferservice::labels.lbl_new')</sup>
        <small>@lang('transferservice::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('transferservice::labels.lbl_new')
    </div>
@endsection
@section('content')
    @livewire('transferservice::customers.customers-search')
    <div class="card-footer d-flex flex-row align-items-center">
        <a href="{{ route('service_customers_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('transferservice::labels.lbl_list')</a>
    </div>
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js') }}"></script>
@endsection
