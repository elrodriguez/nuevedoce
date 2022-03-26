@extends('sales::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('sales::labels.module_name')</li>
    <li class="breadcrumb-item active">@lang('labels.expenses')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-money-bill-wave'></i>{{ __('sales::labels.expenses') }}<sup class='badge badge-primary fw-500'>{{__('lend::labels.lbl_list')}}</sup>
        <small>@lang('labels.available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('labels.list')
    </div>
@endsection
@section('content')
<livewire:sales::expenses.expenses-list />
<livewire:sales::expenses.expenses-payments-modal />
@endsection


