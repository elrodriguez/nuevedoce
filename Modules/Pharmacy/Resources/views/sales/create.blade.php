@extends('pharmacy::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/notifications/toastr/toastr.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/select2/select2.bundle.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('pharmacy::labels.module_name') }}</li>
    <li class="breadcrumb-item">{{ __('labels.sales') }}</li>
    <li class="breadcrumb-item active">{{ __('labels.new') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-cash-register"></i></i>{{ __('pharmacy::labels.sales') }}<sup class='badge badge-primary fw-500'>{{ __('labels.new') }}</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.new') }}
    </div>
@endsection
@section('content')
<livewire:pharmacy::sales.sales-create />
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/notifications/toastr/toastr.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/select2/select2.bundle.js') }}" defer></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
@endsection
