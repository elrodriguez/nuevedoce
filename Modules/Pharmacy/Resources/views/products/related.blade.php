@extends('pharmacy::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('pharmacy::labels.module_name') }}</li>
    <li class="breadcrumb-item">{{ __('labels.products') }}</li>
    <li class="breadcrumb-item active">{{ __('pharmacy::labels.related') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-box-full"></i></i>{{ __('pharmacy::labels.related') }}<sup class='badge badge-primary fw-500'>{{ __('labels.list') }}</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.list') }}
    </div>
@endsection
@section('content')
<livewire:pharmacy::products.related-list />
@endsection
