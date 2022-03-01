@extends('sales::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('sales::labels.module_name') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('sales_administration_series_create') }}">{{ __('sales::labels.series') }}</a></li>
    <li class="breadcrumb-item">{{ __('labels.edit') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-hashtag"></i></i>{{ __('sales::labels.series') }}<sup class='badge badge-primary fw-500'>{{ __('labels.edit') }}</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.edit') }}
    </div>
@endsection
@section('content')
        @livewire('sales::series.series-edit-form',['serie_id' => $id])
@endsection
