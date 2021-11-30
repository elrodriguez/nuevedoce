@extends('staff::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('staff::labels.module_name')</li>
    <li class="breadcrumb-item"><a href="{{ route('staff_employees_index') }}">{{ __('staff::labels.lbl_employees') }}</a></li>
    <li class="breadcrumb-item active">@lang('staff::labels.lbl_new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-users'></i>{{ __('staff::labels.lbl_employees') }} <sup class='badge badge-primary fw-500'>@lang('staff::labels.lbl_new')</sup>
        <small>@lang('staff::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('staff::labels.lbl_new')
    </div>
@endsection
@section('content')
    @livewire('staff::employees.employees-search')
    <div class="card-footer d-flex flex-row align-items-center">
        <a href="{{ route('staff_employees_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('staff::labels.lbl_list')</a>
    </div>
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js') }}"></script>
@endsection
