@extends('personal::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('personal::labels.lbl_personal')</li>
    <li class="breadcrumb-item"><a href="{{ route('personal_occupation_index') }}">{{ __('personal::labels.lbl_occupations') }}</a></li>
    <li class="breadcrumb-item active">@lang('personal::labels.lbl_edit')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-person-dolly'></i>@lang('personal::labels.lbl_occupations') <sup class='badge badge-primary fw-500'>@lang('personal::labels.lbl_edit')</sup>
        <small>@lang('personal::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('personal::labels.lbl_edit')
    </div>
@endsection
@section('content')
    @livewire('personal::occupations.occupations-edit',['occupation_id' => $id])
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
@endsection
