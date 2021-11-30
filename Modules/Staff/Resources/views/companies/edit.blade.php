@extends('staff::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('staff::labels.module_name')</li>
    <li class="breadcrumb-item"><a href="{{ route('staff_companies_index') }}">{{ __('staff::labels.lbl_companies') }}</a></li>
    <li class="breadcrumb-item active">@lang('staff::labels.lbl_edit')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-landmark'></i>@lang('staff::labels.lbl_companies') <sup class='badge badge-primary fw-500'>@lang('staff::labels.lbl_edit')</sup>
        <small>@lang('staff::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('staff::labels.lbl_edit')
    </div>
@endsection
@section('content')
    @livewire('staff::companies.companies-edit',['id' => $id])
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js') }}"></script>
@endsection
