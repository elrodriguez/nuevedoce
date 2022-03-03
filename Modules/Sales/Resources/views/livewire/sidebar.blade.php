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
            @can('ventas_dashboard')
            <li class="{{ $path[0] == 'sales' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('sales_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">@lang('labels.dashBoard')</span>
                </a>
            </li>
            @endcan
            <li class="nav-title">@lang('labels.navigation')</li>
            @can('ventas_administracion')
                <li class="{{ $path[0] == 'sales' && $path[1] == 'administration' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                        <i class="fal fa-puzzle-piece"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes">{{ __('sales::labels.lbl_administration') }}</span>
                    </a>
                    <ul>
                        @can('ventas_administration_series')
                        <li class="{{ $path[0] == 'sales' && $path[1] == 'administration' && $path[2] == 'series' ? 'active' : '' }}">
                            <a href="{{ route('sales_administration_series') }}" title="@lang('labels.series')" data-filter-tags="@lang('labels.series')">
                                <span class="nav-link-text" data-i18n="nav.@lang('labels.series')">@lang('labels.series')</span>
                            </a>
                        </li>
                        @endcan
                        @can('ventas_administracion_caja_chica')
                        <li class="{{ $path[0] == 'sales' && $path[1] == 'administration' && $path[2] == 'cash' ? 'active' : '' }}">
                            <a href="{{ route('sales_administration_cash') }}" title="@lang('labels.petty_cash')" data-filter-tags="@lang('labels.petty_cash')">
                                <span class="nav-link-text" data-i18n="nav.@lang('labels.petty_cash')">@lang('labels.petty_cash')</span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('ventas_comprobante')
                <li class="{{ ($path[0] === 'sales' && $path[1] === 'documents')?'active open':'' }}">
                    <a href="#" title="@lang('labels.sales')" data-filter-tags="@lang('labels.sales')">
                        <i class="fal fa-file-invoice-dollar"></i>
                        <span class="nav-link-text" data-i18n="nav.@lang('labels.sales')"> @lang('sales::labels.voucher')</span>
                    </a>
                    <ul>
                        @can('ventas_comprobante_listado')
                        <li class="{{ ($path[0] === 'sales' && $path[1] === 'documents' && $path[2] === 'list') ? 'active' : '' }}">
                            <a href="{{ route('sales_document_list') }}" title="@lang('labels.voucher_list')" data-filter-tags="@lang('labels.voucher_list')">
                                <span class="nav-link-text" data-i18n="nav.@lang('labels.list')">@lang('labels.voucher_list')</span>
                            </a>
                        </li>
                        @endcan
                        @can('ventas_comprobante_nuevo')
                        <li class="{{ ($path[0] === 'sales' && $path[1] === 'documents' && $path[2] === 'create')?'active':'' }}">
                            <a href="{{ route('sales_document_create') }}" title="@lang('labels.new')" data-filter-tags="@lang('labels.new_document')">
                                <span class="nav-link-text" data-i18n="nav.@lang('labels.new_document')">@lang('labels.new_document')</span>
                            </a>
                        </li>
                        @endcan
                        @can('ventas_nota_venta')
                        <li class="{{ ($path[0] === 'sales' && $path[1] === 'documents' && $path[2] === 'note')?'active':'' }}">
                            <a href="{{ route('sales_documents_sale_notes') }}" title="@lang('sales::labels.sales_notes')" data-filter-tags="@lang('sales::labels.sales_notes')">
                                <span class="nav-link-text" data-i18n="nav.@lang('sales::labels.sales_notes')">@lang('sales::labels.sales_notes')</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</div>
