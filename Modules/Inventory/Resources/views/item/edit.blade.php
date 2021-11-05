@extends('inventory::layouts.master')
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_inventory')</li>
    <li class="breadcrumb-item"><a href="{{ route('inventory_item') }}">@lang('inventory::labels.lbl_items')</a></li>
    <li class="breadcrumb-item active">@lang('inventory::labels.btn_edit')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="ni ni-social-dropbox"></i> @lang('inventory::labels.btn_edit') <span class='fw-300'>@lang('inventory::labels.lbl_item')</span> <sup class='badge badge-primary fw-500'>@lang('inventory::labels.btn_edit')</sup>

    </h1>
    <div class="subheader-block">
        @lang('inventory::labels.btn_edit')
    </div>
@endsection
@section('content')
@livewire('inventory::item.item-edit',['item_id' => $id])
@endsection
@section('script')
<script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
<script src="{{ asset('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js') }}" defer></script>
@endsection
