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
            @can('inventario_dashboard')
            <li class="{{ $path[0] == 'inventory' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('inventory_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">DashBoard</span>
                </a>
            </li>
            @endcan
            <li class="nav-title">Navegación</li>
            @can('inventario_ubicaciones')
            <li class="{{ $path[0] == 'inventory' && $path[1] == 'location' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="location" data-filter-tags="location">
                    <i class="fal fa-map-marker"></i>
                    <span class="nav-link-text" data-i18n="nav.location">{{ __('inventory::labels.lbl_location') }}</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'location' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('inventory_location') }}" title="Datos ubicacion" data-filter-tags="Datos ubicacion">
                            <span class="nav-link-text" data-i18n="nav.datos_ubicacion">Listado Ubicaciones</span>
                        </a>
                    </li>
                    @can('inventario_ubicaciones_nuevo')
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'location' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('inventory_location_create') }}" title="Datos ubicacion nuevo" data-filter-tags="Datos ubicacion nuevo">
                            <span class="nav-link-text" data-i18n="nav.datos_ubicacion_nuevo">Nuevo Ubicación</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('inventario_categorias')
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
                    @can('inventario_categorias_nuevo')
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'category' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('inventory_category_create') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Nuevo Categoria</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('inventario_marcas')
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
                    @can('inventario_marcas_nuevo')
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'brand' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('inventory_brand_create') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Nuevo Marca</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('inventario_items')
                <li class="{{ $path[0] == 'inventory' && $path[1] == 'item' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Items" data-filter-tags="Items">
                        <i class="ni ni-social-dropbox"></i>
                        <span class="nav-link-text" data-i18n="nav.items">@lang('inventory::labels.lbl_items')</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'inventory' && $path[1] == 'item' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('inventory_item') }}" title="Listado de Items" data-filter-tags="Listado de Items">
                                <span class="nav-link-text" data-i18n="nav.listado_items">@lang('inventory::labels.lbl_list') @lang('inventory::labels.lbl_items')</span>
                            </a>
                        </li>
                        @can('inventario_items_nuevo')
                            <li class="{{ $path[0] == 'inventory' && $path[1] == 'item' && $path[2] == 'create' ? 'active' : '' }}">
                                <a href="{{ route('inventory_item_create') }}" title="Nuevo Item" data-filter-tags="Nuevo Item">
                                    <span class="nav-link-text" data-i18n="nav.item_nuevo">@lang('inventory::labels.btn_new') @lang('inventory::labels.lbl_item')</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('inventario_activos')
            <li class="{{ $path[0] == 'inventory' && $path[1] == 'asset' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                    <i class="fal fa-barcode-alt"></i>
                    <span class="nav-link-text" data-i18n="nav.empresa">Activos código</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'asset' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('inventory_asset') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Listado Activos</span>
                        </a>
                    </li>
                    @can('inventario_marcas_nuevo')
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'asset' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('inventory_asset_create') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                            <span class="nav-link-text" data-i18n="nav.datos_generales">Nuevo Activo</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('inventario_kardex')
            <li class="{{ $path[0] == 'kardex' && $path[1] == 'asset' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                    <i class="fal fa-file-chart-line"></i>
                    <span class="nav-link-text" data-i18n="nav.empresa">{{ __('inventory::labels.lbl_kardex') }}</span>
                </a>
                <ul>
                    @can('inventario_kardex_items_stock')
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'kardex' && $path[2] == 'item_stock' ? 'active' : '' }}">
                        <a href="{{ route('inventory_kardex_items_stock') }}" title="Stock por Item" data-filter-tags="Stock por Item">
                            <span class="nav-link-text" data-i18n="nav.stock_por_item">Stock por Item</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('inventario_compras')
            <li class="{{ $path[0] == 'inventory' && $path[1] == 'purchase' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="Compras" data-filter-tags="Compras">
                    <i class="fal fa-shopping-cart"></i>
                    <span class="nav-link-text" data-i18n="nav.compras">@lang('inventory::labels.lbl_shopping')</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'inventory' && $path[1] == 'purchase' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('inventory_purchase') }}" title="Listado de Compras" data-filter-tags="Listado de Compras">
                            <span class="nav-link-text" data-i18n="nav.listado_compras">@lang('inventory::labels.lbl_list') @lang('inventory::labels.lbl_shopping')</span>
                        </a>
                    </li>
                    @can('inventario_compras_nuevo')
                        <li class="{{ $path[0] == 'inventory' && $path[1] == 'purchase' && $path[2] == 'create' ? 'active' : '' }}">
                            <a href="{{ route('inventory_purchase_create') }}" title="Nueva Compra" data-filter-tags="Nueva Compra">
                                <span class="nav-link-text" data-i18n="nav.nueva_compra">@lang('inventory::labels.lbl_new') @lang('inventory::labels.lbl_purchase')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @endcan
        </ul>
    </nav>
</div>
