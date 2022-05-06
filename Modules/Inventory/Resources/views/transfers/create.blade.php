@extends('inventory::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print"
        href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_inventory')</li>
    <li class="breadcrumb-item">
        <a href="{{ route('inventory_transfers_create') }}">@lang('inventory::labels.lbl_movements_transfers')</a>
    </li>
    <li class="breadcrumb-item active">@lang('labels.new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block">
        <x-js-get-date></x-js-get-date>
    </li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="fal fa-person-dolly"></i></i> @lang('inventory::labels.lbl_movements_transfers')
        <sup class='badge badge-primary fw-500'>@lang('labels.new')</sup>
    </h1>
    <div class="subheader-block">
        @lang('labels.new')
    </div>
@endsection
@section('content')
    <livewire:inventory::transfers.transfers-create />
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}"
        defer></script>
@endsection
