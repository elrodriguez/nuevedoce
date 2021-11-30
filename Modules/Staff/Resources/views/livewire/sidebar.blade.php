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
        <x-info-card-user></x-info-card-user>
        <ul id="js-nav-menu" class="nav-menu">
            @can('personal_dashboard')
            <li class="{{ $path[0] == 'staff' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('staff_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">@lang('staff::labels.lbl_dashBoard')</span>
                </a>
            </li>
            @endcan
            <li class="nav-title">@lang('staff::labels.lbl_navigation')</li>
            @can('personal_tipo_empleados')
            <li class="{{ $path[0] == 'staff' && $path[1] == 'employees_type' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="Tipo de Empleado" data-filter-tags="Tipo de Empleado">
                    <i class="fal fa-people-arrows"></i>
                    <span class="nav-link-text" data-i18n="nav.tipo_empleado">@lang('staff::labels.lbl_employee_type')</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'staff' && $path[1] == 'employees_type' && $path[2] == 'data' ? 'active' : '' }}">
                        <a href="{{ route('staff_employee-type_index') }}" title="Listar Tipo de Empleado" data-filter-tags="Listar Tipo de Empleado">
                            <span class="nav-link-text" data-i18n="nav.datos_listar_tipo_empleado">@lang('staff::labels.lbl_to_list')</span>
                        </a>
                    </li>
                    @can('personal_tipo_empleados_nuevo')
                    <li class="{{ $path[0] == 'staff' && $path[1] == 'employees_type' && $path[2] == 'data' ? 'active' : '' }}">
                        <a href="{{ route('staff_employee-type_create') }}" title="Nuevo Tipo de Empleado" data-filter-tags="Nuevo Tipo de Empleado">
                            <span class="nav-link-text" data-i18n="nav.nuevo_tipo_empleado">@lang('staff::labels.lbl_new')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('personal_ocupaciones')
            <li class="{{ $path[0] == 'staff' && $path[1] == 'occupations' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="ocupaciones" data-filter-tags="ocupaciones">
                    <i class="fal fa-person-dolly"></i>
                    <span class="nav-link-text" data-i18n="nav.ocupaciones">@lang('staff::labels.lbl_occupations')</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'staff' && $path[1] == 'occupations' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('staff_occupation_index') }}" title="Listado" data-filter-tags="Listado">
                            <span class="nav-link-text" data-i18n="nav.listado">@lang('staff::labels.lbl_to_list')</span>
                        </a>
                    </li>
                    @can('personal_ocupaciones_nuevo')
                    <li class="{{ $path[0] == 'staff' && $path[1] == 'occupations' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('staff_occupation_create') }}" title="Nueva Ocupación" data-filter-tags="Nueva Ocupación">
                            <span class="nav-link-text" data-i18n="nav.nueva_ocupacion">@lang('staff::labels.lbl_new')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('personal_empleados')
            <li class="{{ $path[0] == 'staff' && $path[1] == 'employees' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="Empleados" data-filter-tags="Empleados">
                    <i class="fal fa-users"></i>
                    <span class="nav-link-text" data-i18n="nav.empleados">@lang('staff::labels.lbl_employees')</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'staff' && $path[1] == 'employees' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('staff_employees_index') }}" title="Listado de Empleados" data-filter-tags="Listado de Empleados">
                            <span class="nav-link-text" data-i18n="nav.listado_de_empleados">@lang('staff::labels.lbl_to_list')</span>
                        </a>
                    </li>
                    @can('personal_empleados_nuevo')
                    <li class="{{ $path[0] == 'staff' && $path[1] == 'employees' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('staff_employees_search') }}" title="Nuevo Empleado" data-filter-tags="Nuevo Empleado">
                            <span class="nav-link-text" data-i18n="nav.nuevo_empleado">@lang('staff::labels.lbl_new')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('personal_empresas')
                <li class="{{ $path[0] == 'staff' && $path[1] == 'companies' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Empresas" data-filter-tags="Empresas">
                        <i class="fal fa-landmark"></i>
                        <span class="nav-link-text" data-i18n="nav.empresas">@lang('staff::labels.lbl_companies')</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'staff' && $path[1] == 'companies' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('staff_companies_index') }}" title="Listado de Empresas" data-filter-tags="Listado de Empresas">
                                <span class="nav-link-text" data-i18n="nav.listado_de_empleados">@lang('staff::labels.lbl_to_list')</span>
                            </a>
                        </li>
                        @can('personal_empresas_nuevo')
                            <li class="{{ $path[0] == 'staff' && $path[1] == 'companies' && $path[2] == 'create' ? 'active' : '' }}">
                                <a href="{{ route('staff_companies_search') }}" title="Nueva Empresa" data-filter-tags="Nueva Empresa">
                                    <span class="nav-link-text" data-i18n="nav.nueva_empresa">@lang('staff::labels.lbl_new')</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</div>
