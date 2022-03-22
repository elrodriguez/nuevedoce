@extends('setting::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('setting::labels.module_name') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('setting_banks') }}">{{ __('labels.bank_entities') }}</a></li>
    <li class="breadcrumb-item">{{ __('labels.bank_accounts') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-piggy-bank"></i></i>{{ __('labels.bank_accounts') }}<sup class='badge badge-primary fw-500'>{{ __('labels.list') }}</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.list') }}
    </div>
@endsection
@section('content')
    <livewire:setting::banks.banks-accounts-list />
@endsection
