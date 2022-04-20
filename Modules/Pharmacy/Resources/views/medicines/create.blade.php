@extends('pharmacy::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
@stop
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('pharmacy::labels.module_name') }}</li>
    <li class="breadcrumb-item">{{ __('labels.administration') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('pharmacy_administration_medicines') }}">{{ __('pharmacy::labels.medicines') }}</a></li>
    <li class="breadcrumb-item active">{{ __('labels.new') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@stop
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-briefcase-medical"></i></i>{{ __('pharmacy::labels.medicines') }}<sup class='badge badge-primary fw-500'>{{ __('labels.new') }}</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.new') }}
    </div>
@stop
@section('content')
<livewire:pharmacy::medicines.medicines-create />
@stop
@section('script')
<script src="{{ url('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
@stop
