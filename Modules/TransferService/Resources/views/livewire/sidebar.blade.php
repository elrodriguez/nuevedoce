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
        </ul>
    </nav>
</div>
