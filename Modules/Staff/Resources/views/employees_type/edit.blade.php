@extends('staff::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('staff::labels.module_name')</li>
    <li class="breadcrumb-item"><a href="{{ route('staff_employee-type_index') }}">{{ __('staff::labels.lbl_employee_type') }}</a></li>
    <li class="breadcrumb-item active">@lang('staff::labels.lbl_edit')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-people-arrows'></i>@lang('staff::labels.lbl_employee_type') <sup class='badge badge-primary fw-500'>@lang('staff::labels.lbl_edit')</sup>
        <small>@lang('staff::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('staff::labels.lbl_edit')
    </div>
@endsection
@section('content')
    @livewire('staff::employees-type.employees-type-edit',['employee_type_id' => $id])
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
@endsection
