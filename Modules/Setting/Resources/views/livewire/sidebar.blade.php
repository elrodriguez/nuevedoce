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
            <li class="{{ $path[0] == 'setting' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('setting_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">DashBoard</span>
                </a>
            </li>
            <li class="nav-title">Navegación</li>
            <li class="{{ $path[0] == 'setting' && $path[1] == 'company' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                    <i class="fal fa-home-lg"></i>
                    <span class="nav-link-text" data-i18n="nav.empresa">Empresa</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'setting' && $path[1] == 'company' && $path[2] == 'data' ? 'active' : '' }}">
                        <a href="{{ route('setting_company') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Datos Generales</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ $path[0] == 'setting' && $path[1] == 'establishment' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                    <i class="fal fa-home-lg"></i>
                    <span class="nav-link-text" data-i18n="nav.empresa">{{ __('setting::labels.establishment') }}</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'setting' && $path[1] == 'establishment' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('setting_establishment') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Listado</span>
                        </a>
                    </li>
                    <li class="{{ $path[0] == 'setting' && $path[1] == 'establishment' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('setting_establishment_create') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Nuevo</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ $path[0] == 'setting' && $path[1] == 'users' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                    <i class="fal fa-users"></i>
                    <span class="nav-link-text" data-i18n="nav.empresa">Usuarios</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'setting' && $path[1] == 'users' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('setting_users') }}" title="Listado de Usuarios" data-filter-tags="Listado de Usuarios">
                            <span class="nav-link-text" data-i18n="nav.listado_de_usuarios">Listado de Usuarios</span>
                        </a>
                    </li>
                    
                    <li class="{{ $path[0] == 'setting' && $path[1] == 'users' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('setting_users_create') }}" title="Nuevo Usuarios" data-filter-tags="Nuevo Usuarios">
                            <span class="nav-link-text" data-i18n="nav.nuevo_usuarios">Nuevo Usuarios</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
