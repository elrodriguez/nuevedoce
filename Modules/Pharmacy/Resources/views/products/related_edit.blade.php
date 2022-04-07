@extends('pharmacy::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/notifications/toastr/toastr.css') }}">
    <style>
        .text-short-er {
            width: 230px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
    </style>
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('pharmacy::labels.module_name') }}</li>
    <li class="breadcrumb-item">{{ __('labels.products') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('pharmacy_administration_products_related') }}">{{ __('pharmacy::labels.related') }}</a></li>
    <li class="breadcrumb-item active">{{ __('labels.edit') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-box-full"></i></i>{{ __('pharmacy::labels.related') }}<sup class='badge badge-primary fw-500'>{{ __('labels.edit') }}</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.edit') }}
    </div>
@endsection
@section('content')
<livewire:pharmacy::products.related-edit :related_id="$id" />
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/notifications/toastr/toastr.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
@endsection
