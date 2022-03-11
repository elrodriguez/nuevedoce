@extends('inventory::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css') }}">
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_inventory')</li>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_items')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="ni ni-social-dropbox"></i></i> @lang('inventory::labels.lbl_items')<sup class='badge badge-primary fw-500'>@lang('inventory::labels.lbl_list')</sup>
    </h1>
    <div class="subheader-block">
        @lang('inventory::labels.lbl_list')
    </div>
@endsection
@section('content')
    @if($interfaz == '8')
        @livewire('inventory::item.item-list')
    @else
        @livewire('inventory::item.item-list-generic')
    @endif
@endsection
