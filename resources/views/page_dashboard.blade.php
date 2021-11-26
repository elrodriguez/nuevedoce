<x-app-layout>
    <x-slot name="sidebar">
    </x-slot>  
    @section("breadcrumb")
        <x-company-name></x-company-name>
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><x-js-get-date></x-js-get-date></li>
    @endsection
    @section("subheader")
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-globe'></i>Modulos <span class='fw-300'>Del Sistema</span> <sup class='badge badge-primary fw-500'>New</sup>
            <small>Disponibles para el usuario</small>
        </h1>
        <div class="subheader-block">
            Modulos
        </div>
    @endsection
    @section('content')
        @livewire('dashboard')
    @endsection
</x-app-layout>