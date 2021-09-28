@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('setting::labels.settings') }}</li>
    <li class="breadcrumb-item">{{ __('setting::labels.modules') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-cubes'></i>{{ __('setting::labels.modules') }} </span> <sup class='badge badge-primary fw-500'>List</sup>
    </h1>
    <div class="subheader-block">
        {{ __('setting::labels.list') }}
    </div>
@endsection
@section('content')
    @livewire('setting::modules.module-list')
@endsection
