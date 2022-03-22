@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('setting::labels.module_name') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('setting_banks') }}">{{ __('labels.bank_entities') }}</a></li>
    <li class="breadcrumb-item active">{{ __('labels.edit') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-pig"></i></i>{{ __('labels.bank_entities') }}<sup class='badge badge-primary fw-500'>{{ __('labels.edit') }}</sup>   
    </h1>
    <div class="subheader-block">
        {{ __('labels.edit') }}
    </div>
@endsection
@section('content')
@livewire('setting::banks.banks-edit',['bank_id' => $id])
@endsection
