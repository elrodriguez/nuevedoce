@extends('transferservice::layouts.master')
@section('styles')
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('transferservice::labels.service_title')</li>
    <li class="breadcrumb-item"><a href="{{ route('service_locals_index') }}">{{ __('transferservice::labels.lbl_locals') }}</a></li>
    <li class="breadcrumb-item active">@lang('transferservice::labels.lbl_edit')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-store-alt'></i>@lang('transferservice::labels.lbl_locals') <sup class='badge badge-primary fw-500'>@lang('transferservice::labels.lbl_edit')</sup>
        <small>@lang('transferservice::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('transferservice::labels.lbl_edit')
    </div>
@endsection
@section('content')
    @livewire('transferservice::locals.locals-edit',['id' => $id])
@endsection
@section('script')
@endsection
