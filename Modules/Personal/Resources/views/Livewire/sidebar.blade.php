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
            <li class="{{ $path[0] == 'personal' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('personal_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">DashBoard</span>
                </a>
            </li>
            <li class="nav-title">Navegación</li>
            <li class="{{ $path[0] == 'personal' && $path[1] == 'employees_type' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="Tipo de Empleado" data-filter-tags="Tipo de Empleado">
                    <i class="fal fa-home-lg"></i>
                    <span class="nav-link-text" data-i18n="nav.tipo_empleado">@lang('personal::labels.lbl_employee_type')</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'personal' && $path[1] == 'employees_type' && $path[2] == 'data' ? 'active' : '' }}">
                        <a href="{{ route('personal_employee-type_index') }}" title="Listar Tipo de Empleado" data-filter-tags="Listar Tipo de Empleado">
                            <span class="nav-link-text" data-i18n="nav.datos_listar_tipo_empleado">@lang('personal::labels.lbl_to_list')</span>
                        </a>
                    </li>
                    <li class="{{ $path[0] == 'personal' && $path[1] == 'employees_type' && $path[2] == 'data' ? 'active' : '' }}">
                        <a href="{{ route('personal_employee-type_create') }}" title="Nuevo Tipo de Empleado" data-filter-tags="Nuevo Tipo de Empleado">
                            <span class="nav-link-text" data-i18n="nav.nuevo_tipo_empleado">@lang('personal::labels.lbl_new')</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ $path[0] == 'personal' && $path[1] == 'occupations' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="ocupaciones" data-filter-tags="ocupaciones">
                    <i class="fal fa-home-lg"></i>
                    <span class="nav-link-text" data-i18n="nav.ocupaciones">@lang('personal::labels.lbl_occupations')</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'personal' && $path[1] == 'occupations' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('personal_occupation_index') }}" title="Listado" data-filter-tags="Listado">
                            <span class="nav-link-text" data-i18n="nav.listado">@lang('personal::labels.lbl_to_list')</span>
                        </a>
                    </li>
                    <li class="{{ $path[0] == 'personal' && $path[1] == 'occupations' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('personal_occupation_create') }}" title="Nueva Ocupación" data-filter-tags="Nueva Ocupación">
                            <span class="nav-link-text" data-i18n="nav.nueva_ocupacion">@lang('personal::labels.lbl_new')</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ $path[0] == 'personal' && $path[1] == 'employees' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="Empleados" data-filter-tags="Empleados">
                    <i class="fal fa-users"></i>
                    <span class="nav-link-text" data-i18n="nav.empleados">@lang('personal::labels.lbl_employees')</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'personal' && $path[1] == 'employees' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('personal_employees_index') }}" title="Listado de Empleados" data-filter-tags="Listado de Empleados">
                            <span class="nav-link-text" data-i18n="nav.listado_de_empleados">@lang('personal::labels.lbl_to_list')</span>
                        </a>
                    </li>
                    <li class="{{ $path[0] == 'personal' && $path[1] == 'employees' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('personal_employees_search') }}" title="Nuevo Empleado" data-filter-tags="Nuevo Empleado">
                            <span class="nav-link-text" data-i18n="nav.nuevo_empleado">@lang('personal::labels.lbl_new')</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>