@extends('inventory::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_inventory')</li>
    <li class="breadcrumb-item"><a href="{{ route('inventory_item') }}">@lang('inventory::labels.lbl_items')</a></li>
    <li class="breadcrumb-item">@lang('inventory::labels.parts')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="ni ni-social-dropbox"></i></i> @lang('inventory::labels.parts') <span id="spaItemName"></span><sup class='badge badge-primary fw-500'>@lang('inventory::labels.lbl_list')</sup>
    </h1>
    <div class="subheader-block">
        @lang('inventory::labels.lbl_list')
    </div>
@endsection
@section('content')
    @livewire('inventory::itempart.item-part-list', ['item_id' => $item_id])
@endsection
