@extends('restaurant::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print"
        href="{{ url('themes/smart-admin/css/formplugins/drop-down-combo-tree/comboTreePlugin.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">
        <a href="{{ route('restaurant_dashboard') }}">
            {{ __('restaurant::labels.module_name') }}
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('restaurant_tables_list') }}">{{ __('restaurant::labels.tables') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __('labels.edit') }}
    </li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block">
        <x-js-get-date></x-js-get-date>
    </li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-table"></i>
        {{ __('restaurant::labels.tables') }}
        <sup class='badge badge-primary fw-500'>
            {{ __('labels.edit') }}
        </sup>
    </h1>
    <div class="subheader-block">
        {{ __('labels.edit') }}
    </div>
@endsection
@section('content')
    <livewire:restaurant::tables.tables-edit :table_id="$id" />
    <livewire:restaurant::tables.tables-floors-modal :form_t="2" />
@stop
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/drop-down-combo-tree/comboTreePlugin.js') }}"></script>
@stop
