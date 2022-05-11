@php
$path = explode('/', request()->path());
$path[1] = array_key_exists(1, $path) > 0 ? $path[1] : '';
$path[2] = array_key_exists(2, $path) > 0 ? $path[2] : '';
$path[3] = array_key_exists(3, $path) > 0 ? $path[3] : '';
$path[4] = array_key_exists(4, $path) > 0 ? $path[4] : '';
@endphp
<div class="page-sidebar">
    <x-company-logo></x-company-logo>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                    data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <x-info-card-user></x-info-card-user>
        <ul id="js-nav-menu" class="nav-menu">
            @can('restaurante_dashboard')
                <li class="{{ $path[0] == 'restaurant' && $path[1] == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('restaurant_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                        <i class="fal fa-tachometer-alt-fast"></i>
                        <span class="nav-link-text" data-i18n="nav.blankpage">@lang('labels.dashBoard')</span>
                    </a>
                </li>
            @endcan
            <li class="nav-title">@lang('labels.navigation')</li>
            @can('restaurante_administracion')
                <li class="{{ $path[0] == 'restaurant' && $path[1] == 'administration' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                        <i class="fal fa-puzzle-piece"></i>
                        <span class="nav-link-text"
                            data-i18n="nav.clientes">{{ __('restaurant::labels.administration') }}</span>
                    </a>
                    <ul>
                        @can('restaurante_administracion_categorias')
                            <li
                                class="{{ $path[0] == 'restaurant' && $path[1] == 'administration' && $path[2] == 'categories' ? 'active' : '' }}">
                                <a href="{{ route('restaurant_categories_list') }}"
                                    title="@lang('restaurant::labels.categories')"
                                    data-filter-tags="@lang('restaurant::labels.categories')">
                                    <span class="nav-link-text"
                                        data-i18n="nav.@lang('restaurant::labels.categories')">@lang('restaurant::labels.categories')</span>
                                </a>
                            </li>
                        @endcan
                        @can('restaurante_administracion_marcas')
                            <li
                                class="{{ $path[0] == 'restaurant' && $path[1] == 'administration' && $path[2] == 'brands' ? 'active' : '' }}">
                                <a href="{{ route('restaurant_brands_list') }}" title="@lang('restaurant::labels.brands')"
                                    data-filter-tags="@lang('restaurant::labels.brands')">
                                    <span class="nav-link-text"
                                        data-i18n="nav.@lang('restaurant::labels.brands')">@lang('restaurant::labels.brands')</span>
                                </a>
                            </li>
                        @endcan
                        @can('restaurante_administracion_mesas')
                            <li
                                class="{{ $path[0] == 'restaurant' && $path[1] == 'administration' && $path[2] == 'tables' ? 'active' : '' }}">
                                <a href="{{ route('restaurant_tables_list') }}" title="@lang('restaurant::labels.tables')"
                                    data-filter-tags="@lang('restaurant::labels.tables')">
                                    <span class="nav-link-text"
                                        data-i18n="nav.@lang('restaurant::labels.tables')">@lang('restaurant::labels.tables')</span>
                                </a>
                            </li>
                        @endcan
                        @can('restaurante_administracion_comandas')
                            <li
                                class="{{ $path[0] == 'restaurant' && $path[1] == 'administration' && $path[2] == 'commands' ? 'active' : '' }}">
                                <a href="{{ route('restaurant_commands_list') }}"
                                    title="@lang('restaurant::labels.commands')"
                                    data-filter-tags="@lang('restaurant::labels.commands')">
                                    <span class="nav-link-text"
                                        data-i18n="nav.@lang('restaurant::labels.commands')">@lang('restaurant::labels.commands')</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</div>
