@extends('personal::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('personal::labels.lbl_personal')</li>
    <li class="breadcrumb-item"><a href="{{ route('personal_companies_index') }}">{{ __('personal::labels.lbl_companies') }}</a></li>
    <li class="breadcrumb-item active">@lang('personal::labels.lbl_new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-landmark'></i>{{ __('personal::labels.lbl_companies') }} <sup class='badge badge-primary fw-500'>@lang('personal::labels.lbl_new')</sup>
        <small>@lang('personal::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('personal::labels.lbl_new')
    </div>
@endsection
@section('content')
    @livewire('personal::companies.companies-search')
    <div class="card-footer d-flex flex-row align-items-center">
        <a href="{{ route('personal_companies_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('personal::labels.lbl_list')</a>
    </div>
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js') }}"></script>
@endsection
