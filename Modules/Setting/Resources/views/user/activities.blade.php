@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('setting::labels.settings') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('setting_users') }}">{{ __('setting::labels.users') }}</a></li>
    <li class="breadcrumb-item active">{{ __('setting::labels.activities_system') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-users'></i>{{ __('setting::labels.users') }} <sup class='badge badge-primary fw-500'>Activities</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <div class="subheader-block">
        {{ __('setting::labels.activities_system') }}
    </div>
@endsection
@section('content')
@livewire('setting::user.user-activities',['user_id' => $id])
@endsection

