@extends('lend::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('lend::labels.module_name')</li>
    <li class="breadcrumb-item"><a href="{{ route('lend_quota_index') }}">{{ __('lend::labels.lbl_quotas') }}</a></li>
    <li class="breadcrumb-item active">@lang('lend::labels.lbl_edit')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list-ol'></i>@lang('lend::labels.lbl_quotas') <sup class='badge badge-primary fw-500'>@lang('lend::labels.lbl_edit')</sup>
        <small>@lang('lend::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('lend::labels.lbl_edit')
    </div>
@endsection
@section('content')
    @livewire('lend::quota.quota-edit',['quota_id' => $id])
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
@endsection
