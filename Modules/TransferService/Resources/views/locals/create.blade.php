@extends('transferservice::layouts.master')
@section('styles')
    html, body { height: 100%; margin: 0; padding: 0; }
    #map { height: 100%; }
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('transferservice::labels.service_title')</li>
    <li class="breadcrumb-item"><a href="{{ route('service_locals_index') }}">{{ __('transferservice::labels.lbl_locals') }}</a></li>
    <li class="breadcrumb-item active">@lang('transferservice::labels.lbl_new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-store-alt'></i>{{ __('transferservice::labels.lbl_locals') }} <sup class='badge badge-primary fw-500'>@lang('transferservice::labels.lbl_new')</sup>
        <small>@lang('transferservice::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('transferservice::labels.lbl_new')
    </div>
@endsection
@section('content')
    @livewire('transferservice::locals.locals-create')
@endsection
@section('script')

@endsection
