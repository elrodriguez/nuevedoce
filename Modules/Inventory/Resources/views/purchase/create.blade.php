@extends('inventory::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_inventory')</li>
    <li class="breadcrumb-item"><a href="{{ route('inventory_purchase') }}">@lang('inventory::labels.lbl_shopping')</a></li>
    <li class="breadcrumb-item active">@lang('inventory::labels.btn_new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="fal fa-shopping-cart"></i> @lang('inventory::labels.lbl_new') <span class='fw-300'>@lang('inventory::labels.lbl_purchase')</span> <sup class='badge badge-primary fw-500'>@lang('inventory::labels.btn_new')</sup>

    </h1>
    <div class="subheader-block">
        @lang('inventory::labels.btn_new')
    </div>
@endsection
@section('content')
@livewire('inventory::purchase.purchase-create')
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js') }}"></script>
    <script src="{{ asset('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
@endsection
