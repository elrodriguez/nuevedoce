@extends('transferservice::layouts.master')
@section('styles')
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('transferservice::labels.service_title')</li>
    <li class="breadcrumb-item"><a href="{{ route('service_vehicles_index') }}">{{ __('transferservice::labels.lbl_vehicles') }}</a></li>
    <li class="breadcrumb-item active">@lang('transferservice::labels.lbl_crew')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-truck'></i>@lang('transferservice::labels.lbl_vehicles') <sup class='badge badge-primary fw-500'>@lang('transferservice::labels.lbl_crew')</sup>
        <small>@lang('transferservice::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('transferservice::labels.lbl_crew')
    </div>
@endsection
@section('content') 
    @livewire('transferservice::vehicles.vehicles-crew',['vehicle_id' => $id])
@endsection
@section('script')
<script src="{{ asset('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
@endsection
