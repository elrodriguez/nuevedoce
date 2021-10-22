@extends('setting::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ asset('themes/smart-admin/css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
 @endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('setting::labels.settings') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('setting_users') }}">{{ __('setting::labels.users') }}</a></li>
    <li class="breadcrumb-item active">{{ __('setting::labels.activities_system') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-users'></i>{{ __('setting::labels.users') }} <sup class='badge badge-primary fw-500'>Activities</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        {{ __('setting::labels.activities_system') }}
    </div>
@endsection
@section('content')
@livewire('setting::user.user-activities',['user_id' => $id])
@endsection
@section('script')
    <script src="{{ asset('themes/smart-admin/js/dependency/moment/moment.js') }}" defer></script>
    <script src="{{ asset('themes/smart-admin/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}" defer></script>
    <script src="{{ asset('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
    <script src="{{ asset('themes/smart-admin/js/datagrid/datatables/datatables.bundle.js') }}"></script>
@endsection
