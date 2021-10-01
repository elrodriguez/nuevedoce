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
            <li class="{{ $path[0] == 'inventory' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('inventory_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">DashBoard</span>
                </a>
            </li>
            <li class="nav-title">Navegación</li>
            <li class="{{ $path[0] == 'inventory' && $path[1] == 'category' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                    <i class="ni ni-book-open"></i>
                    <span class="nav-link-text" data-i18n="nav.empresa">Categoria</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'category' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('inventory_category') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Listado Categoria</span>
                        </a>
                    </li>
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'category' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('inventory_category_create') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Nuevo Categoria</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ $path[0] == 'inventory' && $path[1] == 'brand' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                    <i class="ni ni-tag"></i>
                    <span class="nav-link-text" data-i18n="nav.empresa">Marca</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'brand' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('inventory_brand') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Listado Marca</span>
                        </a>
                    </li>
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'brand' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('inventory_brand_create') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Nuevo Marca</span>
                        </a>
                    </li>
                </ul>
            </li>
           
            
        </ul>
    </nav>
</div>
