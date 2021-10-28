@extends('transferservice::layouts.master')
@section('styles')
    <link rel="stylesheet" media="screen, print" href="{{ url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <style>
        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }
    
        #infowindow-content .title {
            font-weight: bold;
        }
    
        #infowindow-content {
            display: none;
        }
    
        #map #infowindow-content {
            display: inline;
        }
    
        .pac-card {
            background-color: #fff;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
            margin: 10px;
            padding: 0 0.5em;
            font: 400 18px Roboto, Arial, sans-serif;
            overflow: hidden;
            font-family: Roboto;
            padding: 0;
        }
    
        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }
    
        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }
    
        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
    
        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }
    
        #pac-input:focus {
            border-color: #4d90fe;
        }
    
        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }
    
        #target {
            width: 345px;
        }
    </style>
@endsection
@section('breadcrumb')
    <x-company-name></x-company-name>
    <li class="breadcrumb-item">@lang('transferservice::labels.service_title')</li>
    <li class="breadcrumb-item">{{ __('transferservice::labels.lbl_odt_requests') }}</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
@endsection
@section('subheader')
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-paper-plane'></i>{{ __('transferservice::labels.lbl_odt_requests') }} <sup class='badge badge-primary fw-500'>{{__('transferservice::labels.lbl_list')}}</sup>
        <small>@lang('transferservice::labels.lbl_available_user')</small>
    </h1>
    <div class="subheader-block">
        @lang('transferservice::labels.lbl_list')
    </div>
@endsection
@section('content')
@livewire('transferservice::odtrequests.odtrequests-list')
@endsection
@section('script')
    <script src="{{ url('themes/smart-admin/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env("GOOGLE_MAPS_KEY") }}&callback=initMap&libraries=places&v=weekly&channel=2" async></script>
@endsection
