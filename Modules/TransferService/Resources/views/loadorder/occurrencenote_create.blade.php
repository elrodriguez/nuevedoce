@extends('transferservice::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item"><a href="{{ route('transferservice_dashboard') }}">@lang('transferservice::labels.service_title')</a></li>
    <li class="breadcrumb-item"><a href="{{ route('service_load_order_index') }}">{{ __('transferservice::labels.lbl_load_order') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('service_load_order_ocurrencenote',$id) }}">{{ __('transferservice::labels.lbl_occurrence_note') }}</a></li>
    <li class="breadcrumb-item active">{{ __('labels.new') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-person-dolly'></i>{{ __('transferservice::labels.lbl_load_order') }} <sup class='badge badge-primary fw-500'>{{__('transferservice::labels.lbl_occurrence_note')}}</sup>
        <small>@lang('transferservice::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('labels.new')
    </div>
@endsection
@section('content')
@livewire('transferservice::loadorder.loadorder-occurrence-note-create', ['oc_id' => $id])
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js') }}"></script>
    <script src="{{ asset('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
@endsection
