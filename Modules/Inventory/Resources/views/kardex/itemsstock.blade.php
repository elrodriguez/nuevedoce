@extends('inventory::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}">
@endsection 
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_inventory')</li>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_stock')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="fal fa-file-chart-line"></i></i> @lang('inventory::labels.lbl_stock')<sup class='badge badge-primary fw-500'>@lang('inventory::labels.lbl_list')</sup>
    </h1>
    <div class="subheader-block">
        @lang('inventory::labels.lbl_list')
    </div>
@endsection
@section('content')
    @livewire('inventory::kardex.items-stock')
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/dependency/moment/moment.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
@endsection
