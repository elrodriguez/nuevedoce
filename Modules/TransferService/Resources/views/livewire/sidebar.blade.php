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
            @can('serviciodetraslados_dashboard')
            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('transferservice_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">{{ __('transferservice::labels.lbl_dashBoard') }}</span>
                </a>
            </li>
            @endcan
            <li class="nav-title">{{ __('transferservice::labels.lbl_navigation') }}</li>
            @can('serviciodetraslados_clientes')
                <li class="{{ $path[0] == 'transferservice' && $path[1] == 'customers' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Clientes" data-filter-tags="Clientes">
                        <i class="fal fa-users-class"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes">{{ __('transferservice::labels.lbl_customers') }}</span>
                    </a>
                    <ul>
                        @can('serviciodetraslados_clientes')
                        <li class="{{ $path[0] == 'transferservice' && $path[1] == 'customers' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('service_customers_index') }}" title="Listar Clientes" data-filter-tags="Listar Clientes">
                                <span class="nav-link-text" data-i18n="nav.listar_cliente">{{ __('transferservice::labels.lbl_to_list') }} {{ __('transferservice::labels.lbl_customer') }}</span>
                            </a>
                        </li>
                        @endcan
                        @can('serviciodetraslados_clientes_nuevo')
                        <li class="{{ $path[0] == 'transferservice' && $path[1] == 'customers' && $path[2] == 'create' ? 'active' : '' }}">
                            <a href="{{ route('service_customers_search', '') }}" title="Nuevo Cliente" data-filter-tags="Nuevo Cliente">
                                <span class="nav-link-text" data-i18n="nav.nuevo_cliente">{{ __('transferservice::labels.lbl_new') }} {{ __('transferservice::labels.lbl_customer') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('serviciodetraslados_locales')
                <li class="{{ $path[0] == 'transferservice' && $path[1] == 'locals' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Locales" data-filter-tags="Locales">
                        <i class="fal fa-store-alt"></i>
                        <span class="nav-link-text" data-i18n="nav.locales">{{ __('transferservice::labels.lbl_locals') }}</span>
                    </a>
                    <ul>
                        @can('serviciodetraslados_locales')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'locals' && $path[2] == 'list' ? 'active' : '' }}">
                                <a href="{{ route('service_locals_index') }}" title="Listar Locales" data-filter-tags="Listar Locales">
                                    <span class="nav-link-text" data-i18n="nav.listar_locales">{{ __('transferservice::labels.lbl_to_list') }} {{ __('transferservice::labels.lbl_local') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('serviciodetraslados_locales_nuevo')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'locals' && $path[2] == 'create' ? 'active' : '' }}">
                                <a href="{{ route('service_locals_create', '') }}" title="Nuevo Local" data-filter-tags="Nuevo Local">
                                    <span class="nav-link-text" data-i18n="nav.nuevo_local">{{ __('transferservice::labels.lbl_new') }} {{ __('transferservice::labels.lbl_local') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('serviciodetraslados_vehiculos')
                <li class="{{ $path[0] == 'transferservice' && $path[1] == 'vehicles' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Vehiculos" data-filter-tags="Vehiculos">
                        <i class="fal fa-truck"></i>
                        <span class="nav-link-text" data-i18n="nav.vehiculos">{{ __('transferservice::labels.lbl_vehicles') }}</span>
                    </a>
                    <ul>
                        @can('serviciodetraslados_vehiculos')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'vehicles' && $path[2] == 'list' ? 'active' : '' }}">
                                <a href="{{ route('service_vehicles_index') }}" title="Listar Vehiculos" data-filter-tags="Listar Vehiculos">
                                    <span class="nav-link-text" data-i18n="nav.listar_vehiculos">{{ __('transferservice::labels.lbl_to_list') }} {{ __('transferservice::labels.lbl_vehicle') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('serviciodetraslados_vehiculos_nuevo')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'vehicles' && $path[2] == 'create' ? 'active' : '' }}">
                                <a href="{{ route('service_vehicles_create', '') }}" title="Nuevo Vehiculo" data-filter-tags="Nuevo Vehiculo">
                                    <span class="nav-link-text" data-i18n="nav.nuevo_vehiculo">{{ __('transferservice::labels.lbl_new') }} {{ __('transferservice::labels.lbl_vehicle') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('serviciodetraslados_solicitudes_odt')
                <li class="{{ $path[0] == 'transferservice' && $path[1] == 'odt_requests' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Solicitudes ODT" data-filter-tags="Solicitudes ODT">
                        <i class="fal fa-paper-plane"></i>
                        <span class="nav-link-text" data-i18n="nav.solicitudes_odt">{{ __('transferservice::labels.lbl_odt_requests') }}</span>
                    </a>
                    <ul>
                        @can('serviciodetraslados_solicitudes_odt')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'odt_requests' && $path[2] == 'list' ? 'active' : '' }}">
                                <a href="{{ route('service_odt_requests_index') }}" title="Listar Solicitudes ODT" data-filter-tags="Listar Solicitudes ODT">
                                    <span class="nav-link-text" data-i18n="nav.listar_solicitudes_odt">{{ __('transferservice::labels.lbl_to_list') }} {{ __('transferservice::labels.lbl_odt_request') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('serviciodetraslados_solicitudes_odt_nuevo')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'odt_requests' && $path[2] == 'create' ? 'active' : '' }}">
                                <a href="{{ route('service_odt_requests_create', '') }}" title="Nueva Solicitud ODT" data-filter-tags="Nueva Solicitud ODT">
                                    <span class="nav-link-text" data-i18n="nav.nuevo_solicitud_odt">{{ __('transferservice::labels.lbl_new') }} {{ __('transferservice::labels.lbl_odt_request') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('serviciodetraslados_orden_carga')
                <li class="{{ $path[0] == 'transferservice' && $path[1] == 'load_order' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="{{ __('transferservice::labels.lbl_load_order') }}" data-filter-tags="{{ __('transferservice::labels.lbl_load_order') }}">
                        <i class="fal fa-person-dolly"></i>
                        <span class="nav-link-text" data-i18n="nav.orden_carga">{{ __('transferservice::labels.lbl_load_order') }}</span>
                    </a>
                    <ul>
                        @can('serviciodetraslados_orden_carga')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'load_order' && $path[2] == 'list' ? 'active' : '' }}">
                                <a href="{{ route('service_load_order_index') }}" title="Listar orden carga" data-filter-tags="Listar orden carga">
                                    <span class="nav-link-text" data-i18n="nav.listar_orden_carga">{{ __('transferservice::labels.lbl_list') }} </span>
                                </a>
                            </li>
                        @endcan
                        @can('serviciodetraslados_orden_carga_nuevo')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'load_order' && $path[2] == 'create' ? 'active' : '' }}">
                                <a href="{{ route('service_load_order_create') }}" title="Nueva orden carga" data-filter-tags="Nueva orden carga">
                                    <span class="nav-link-text" data-i18n="nav.nuevo_orden_carga">{{ __('transferservice::labels.lbl_new') }} </span>
                                </a>
                            </li>
                        @endcan
                        @can('serviciodetraslados_orden_carga_salida')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'load_order' && $path[2] == 'exit' ? 'active' : '' }}">
                                <a href="{{ route('service_load_order_exit') }}" title="Salida orden carga" data-filter-tags="Salida orden carga">
                                    <span class="nav-link-text" data-i18n="nav.salida_orden_carga">{{ __('transferservice::labels.lbl_exit') }} </span>
                                </a>
                            </li>
                        @endcan
                        @can('serviciodetraslados_orden_carga_retorno')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'load_order' && $path[2] == 'return' ? 'active' : '' }}">
                                <a href="{{ route('service_load_order_return') }}" title="Retorno orden carga" data-filter-tags="Retorno orden carga">
                                    <span class="nav-link-text" data-i18n="nav.retorno_orden_carga">{{ __('transferservice::labels.lbl_return') }} </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('serviciodetraslados_reportes')
                <li class="{{ $path[0] == 'transferservice' && $path[1] == 'reports' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Reportes" data-filter-tags="Reportes">
                        <i class="fal fa-analytics"></i>
                        <span class="nav-link-text" data-i18n="nav.reportes">{{ __('labels.reports') }}</span>
                    </a>
                    <ul>
                        @can('serviciodetraslados_reporte_eventos')
                            <li class="{{ $path[0] == 'transferservice' && $path[1] == 'reports' && $path[2] == 'events' ? 'active' : '' }}">
                                <a href="{{ route('service_reports_events') }}" title="Reporte Eventos" data-filter-tags="Reporte Eventos">
                                    <span class="nav-link-text" data-i18n="nav.reporte_eventos">{{ __('labels.report') }} {{ __('transferservice::labels.lbl_events') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</div>
