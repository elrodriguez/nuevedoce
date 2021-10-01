@extends('personal::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('personal::labels.lbl_personal')</li>
    <li class="breadcrumb-item"><a href="{{ route('personal_employees_index') }}">{{ __('personal::labels.lbl_employees') }}</a></li>
    <li class="breadcrumb-item active">@lang('personal::labels.lbl_edit')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-users'></i>@lang('personal::labels.lbl_employees') <sup class='badge badge-primary fw-500'>@lang('personal::labels.lbl_edit')</sup>
        <small>@lang('personal::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('personal::labels.lbl_edit')
    </div>
@endsection
@section('content')
    @livewire('personal::employees.employees-edit',['occupation_id' => $id])
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
@endsection
