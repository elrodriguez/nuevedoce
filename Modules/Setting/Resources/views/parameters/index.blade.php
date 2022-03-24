@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('setting::labels.settings') }}</li>
    <li class="breadcrumb-item active">{{ __('labels.parameters') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-puzzle-piece'></i>{{ __('labels.parameters') }} </span> <sup class='badge badge-primary fw-500'>{{ __('labels.list') }}</sup>
    </h1>
    <div class="subheader-block">
        {{ __('labels.list') }}
    </div>
@endsection
@section('content')
<livewire:setting::parameters.parameters-list />
<livewire:setting::parameters.parameters-create />
<livewire:setting::parameters.parameters-edit />
@endsection
