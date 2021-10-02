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
                    <span class="nav-link-text" data-i18n="nav.blankpage">DashBoard</span>
                </a>
            </li>
            @endcan
            <li class="nav-title">Navegación</li>
            @can('serviciodetraslados_dashboard')
                <li class="{{ $path[0] == 'transferservice' && $path[1] == 'company' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                        <i class="fal fa-city"></i>
                        <span class="nav-link-text" data-i18n="nav.empresa">{{ __('transferservice::labels.my_company') }}</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'transferservice' && $path[1] == 'company' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('transferservice_company') }}" title="empresas" data-filter-tags="Datos Generales">
                                <span class="nav-link-text" data-i18n="nav.datos_generales">{{ __('transferservice::labels.companies_list') }}</span>
                            </a>
                        </li>
                        @can('configuraciones_empresas_nuevo')
                        <li class="{{ $path[0] == 'transferservice' && $path[1] == 'company' && $path[2] == 'create' ? 'active' : '' }}">
                            <a href="{{ route('transferservice_company_create') }}" title="empresas" data-filter-tags="nueva empresa">
                                <span class="nav-link-text" data-i18n="nav.nueva_empresa">{{ __('transferservice::labels.companies_create') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</div>