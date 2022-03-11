@extends('sales::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('sales::labels.module_name') }}</li>
    <li class="breadcrumb-item">{{ __('sales::labels.series') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-hashtag"></i></i>{{ __('sales::labels.series') }}<sup class='badge badge-primary fw-500'>List</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.list') }}
    </div>
@endsection
@section('content')
    @livewire('sales::series.series-list')
@endsection
