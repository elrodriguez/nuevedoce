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
            @can('farmacia_dashboard')
            <li class="{{ $path[0] == 'pharmacy' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('pharmacy_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">@lang('labels.dashBoard')</span>
                </a>
            </li>
            @endcan
            <li class="nav-title">@lang('labels.navigation')</li>
            @can('farmacia_administracion')
                <li class="{{ $path[0] == 'pharmacy' && $path[1] == 'administration' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                        <i class="fal fa-puzzle-piece"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes">{{ __('pharmacy::labels.administration') }}</span>
                    </a>
                    <ul>
                        @can('farmacia_administracion_sintomas')
                        <li class="{{ $path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'symptom' ? 'active' : '' }}">
                            <a href="{{ route('pharmacy_administration_symptom') }}" title="@lang('pharmacy::labels.symptom')" data-filter-tags="@lang('pharmacy::labels.symptom')">
                                <span class="nav-link-text" data-i18n="nav.@lang('pharmacy::labels.symptom')">@lang('pharmacy::labels.symptom')</span>
                            </a>
                        </li>
                        @endcan
                        @can('farmacia_administracion_enfermedades')
                        <li class="{{ $path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'diseases' ? 'active' : '' }}">
                            <a href="{{ route('pharmacy_administration_diseases') }}" title="@lang('pharmacy::labels.diseases')" data-filter-tags="@lang('pharmacy::labels.diseases')">
                                <span class="nav-link-text" data-i18n="nav.@lang('pharmacy::labels.diseases')">@lang('pharmacy::labels.diseases')</span>
                            </a>
                        </li>
                        @endcan
                        @can('farmacia_administracion_medicinas')
                        <li class="{{ $path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'medicines' ? 'active' : '' }}">
                            <a href="{{ route('pharmacy_administration_medicines') }}" title="@lang('pharmacy::labels.medicines')" data-filter-tags="@lang('pharmacy::labels.medicines')">
                                <span class="nav-link-text" data-i18n="nav.@lang('pharmacy::labels.medicines')">@lang('pharmacy::labels.medicines')</span>
                            </a>
                        </li>
                        @endcan
                        @can('farmacia_administracion_productos')
                            <li class="{{ $path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'products' ? 'active' : '' }}">
                                <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                                    <span class="nav-link-text" data-i18n="nav.clientes">{{ __('labels.products') }}</span>
                                </a>
                                <ul>
                                    @can('farmacia_administracion_productos_relacionados')
                                    <li class="{{ $path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'products' && $path[3] == 'related' ? 'active' : '' }}">
                                        <a href="{{ route('pharmacy_administration_products_related') }}" title="@lang('pharmacy::labels.related')" data-filter-tags="@lang('pharmacy::labels.related')">
                                            <span class="nav-link-text" data-i18n="nav.@lang('pharmacy::labels.related')">@lang('pharmacy::labels.related')</span>
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('farmacia_ventas')
                <li class="{{ $path[0] == 'pharmacy' && $path[1] == 'sales' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                        <i class="fal fa-cash-register"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes">{{ __('pharmacy::labels.sales') }}</span>
                    </a>
                    <ul>
                        @can('farmacia_ventas_nuevo')
                            <li class="{{ $path[0] == 'pharmacy' && $path[1] == 'sales' && $path[2] == 'create' ? 'active' : '' }}">
                                <a href="{{ route('pharmacy_sales_create') }}" title="@lang('labels.new')" data-filter-tags="@lang('labels.new')">
                                    <span class="nav-link-text" data-i18n="nav.@lang('labels.new')">@lang('labels.new')</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</div>
