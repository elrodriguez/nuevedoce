@extends('sales::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('sales::labels.module_name')</li>
    <li class="breadcrumb-item"><a href="{{ route('sales_expenses_list') }}">@lang('sales::labels.expenses')</a></li>
    <li class="breadcrumb-item active">@lang('labels.new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-cash-register'></i>{{ __('sales::labels.expenses') }}<sup class='badge badge-primary fw-500'>{{__('labels.new')}}</sup>
        <small>@lang('labels.available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('labels.new')
    </div>
@endsection
@section('content')
<livewire:sales::expenses.expenses-edit :expense_id="$id" />
<livewire:sales::expenses.expenses-supplier-modal />
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
@endsection

