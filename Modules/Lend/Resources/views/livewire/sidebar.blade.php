@php
    $path = explode('/', request()->path());
    $path[1] = (array_key_exists(1, $path)> 0)?$path[1]:'';
    $path[2] = (array_key_exists(2, $path)> 0)?$path[2]:'';
    $path[3] = (array_key_exists(3, $path)> 0)?$path[3]:'';
    $path[4] = (array_key_exists(4, $path)> 0)?$path[4]:'';
@endphp
<div class="page-sidebar">
    <x-company-logo></x-company-logo>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="{{ url('themes/smart-admin/img/demo/avatars/avatar-admin.png') }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        {{ auth()->user()->name }}
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">{{ auth()->user()->email }}</span>
            </div>
            <img src="{{ url('themes/smart-admin/img/card-backgrounds/cover-2-lg.png') }}" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            @can('prestamos_dashboard')
            <li class="{{ $path[0] == 'lend' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('lend_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">@lang('labels.dashBoard')</span>
                </a>
            </li>
            @endcan
            <li class="nav-title">@lang('labels.navigation')</li>
            @can('prestamos_intereses')
            <li class="{{ $path[0] == 'lend' && $path[1] == 'interest' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="Intereses" data-filter-tags="Intereses">
                    <i class="fal fa-humidity"></i>
                    <span class="nav-link-text" data-i18n="nav.interes">@lang('lend::labels.lbl_interest')</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'lend' && $path[1] == 'interest' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('lend_interest_list') }}" title="Lista Interéses" data-filter-tags="Lista Interéses">
                            <span class="nav-link-text" data-i18n="nav.lista_intereses">@lang('labels.list')</span>
                        </a>
                    </li>
                    @can('prestamos_intereses_nuevo')
                    <li class="{{ $path[0] == 'lend' && $path[1] == 'interest' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('lend_interest_create') }}" title="Nuevo Interés" data-filter-tags="Nuevo Interés">
                            <span class="nav-link-text" data-i18n="nav.nuevo_interes">@lang('lend::labels.lbl_new')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
        </ul>
    </nav>
</div>
