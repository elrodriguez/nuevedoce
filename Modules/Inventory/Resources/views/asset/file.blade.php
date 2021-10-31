@extends('inventory::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/dropzone/dropzone.css') }}">
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/dropzone/dropzone.js') }}"></script>
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_inventory')</li>
    <li class="breadcrumb-item"><a href="{{ route('inventory_asset') }}">@lang('inventory::labels.assents')</a></li>
    <li class="breadcrumb-item">@lang('inventory::labels.lbl_images')</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class="ni ni-social-dropbox"></i></i> @lang('inventory::labels.lbl_images')<sup class='badge badge-primary fw-500'>@lang('inventory::labels.lbl_list')</sup>
    </h1>
    <div class="subheader-block">
        @lang('inventory::labels.lbl_images')
    </div>
@endsection
@section('content')
    @livewire('inventory::asset.asset-file', ['asset_id' => $asset_id])
@endsection
