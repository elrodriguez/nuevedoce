@extends('setting::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">{{ __('setting::labels.settings') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('setting_roles') }}">{{ __('setting::labels.roles') }}</a></li>
    <li class="breadcrumb-item active">{{ __('setting::labels.permissions') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-cubes'></i>{{ __('setting::labels.roles') }} </span> <sup class='badge badge-primary fw-500'>Permissions</sup>
    </h1>
    <div class="subheader-block">
        {{ __('setting::labels.permissions') }}
    </div>
@endsection
@section('content')
    @livewire('setting::roles.roles-permissions',['role_id' => $id])
@endsection


