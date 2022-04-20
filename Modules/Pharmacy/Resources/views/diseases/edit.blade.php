@extends('pharmacy::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/summernote/summernote.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('pharmacy::labels.module_name') }}</li>
    <li class="breadcrumb-item">{{ __('labels.administration') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('pharmacy_administration_diseases') }}">{{ __('pharmacy::labels.diseases') }}</a></li>
    <li class="breadcrumb-item active">{{ __('labels.edit') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-head-side-cough"></i></i>{{ __('pharmacy::labels.diseases') }}<sup class='badge badge-primary fw-500'>{{ __('labels.edit') }}</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.edit') }}
    </div>
@endsection
@section('content')
    <livewire:pharmacy::diseases.diseases-edit :disease_id="$id" />
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/summernote/summernote.js') }}"></script>
@stop
