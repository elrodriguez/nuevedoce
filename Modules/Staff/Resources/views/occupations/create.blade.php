@extends('staff::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('staff::labels.module_name')</li>
    <li class="breadcrumb-item"><a href="{{ route('staff_occupation_index') }}">{{ __('staff::labels.lbl_occupations') }}</a></li>
    <li class="breadcrumb-item active">@lang('staff::labels.lbl_new')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-person-dolly'></i>{{ __('staff::labels.lbl_occupations') }} <sup class='badge badge-primary fw-500'>@lang('staff::labels.lbl_new')</sup>
        <small>@lang('staff::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('staff::labels.lbl_new')
    </div>
@endsection
@section('content')
    @livewire('staff::occupations.occupations-create')
@endsection
