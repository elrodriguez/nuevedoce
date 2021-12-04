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
            @can('prestamos_dashboard')
            <li class="{{ $path[0] == 'lend' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('lend_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">@lang('labels.dashBoard')</span>
                </a>
            </li>
            @endcan
            <li class="nav-title">@lang('labels.navigation')</li>
            @can('prestamos_clientes')
                <li class="{{ $path[0] == 'lend' && $path[1] == 'customers' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Clientes" data-filter-tags="Clientes">
                        <i class="fal fa-users-class"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes">{{ __('lend::labels.lbl_customers') }}</span>
                    </a>
                    <ul>
                        @can('prestamos_clientes')
                        <li class="{{ $path[0] == 'lend' && $path[1] == 'customers' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('lend_customers_index') }}" title="Listar Clientes" data-filter-tags="Listar Clientes">
                                <span class="nav-link-text" data-i18n="nav.listar_cliente">{{ __('lend::labels.lbl_to_list') }} {{ __('lend::labels.lbl_customer') }}</span>
                            </a>
                        </li>
                        @endcan
                        @can('prestamos_clientes_nuevo')
                        <li class="{{ $path[0] == 'lend' && $path[1] == 'customers' && $path[2] == 'create' ? 'active' : '' }}">
                            <a href="{{ route('lend_customers_search') }}" title="Nuevo Cliente" data-filter-tags="Nuevo Cliente">
                                <span class="nav-link-text" data-i18n="nav.nuevo_cliente">{{ __('lend::labels.lbl_new') }} {{ __('lend::labels.lbl_customer') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('prestamos_intereses')
            <li class="{{ $path[0] == 'lend' && $path[1] == 'interest' ? 'active open' : '' }}">
                <a href="javascript:void(0);" title="Intereses" data-filter-tags="Intereses">
                    <i class="fal fa-humidity"></i>
                    <span class="nav-link-text" data-i18n="nav.interes">@lang('lend::labels.lbl_interest')</span>
                </a>
                <ul>
                    <li class="{{ $path[0] == 'lend' && $path[1] == 'interest' && $path[2] == 'list' ? 'active' : '' }}">
                        <a href="{{ route('lend_interest_list') }}" title="Lista Interéses" data-filter-tags="Lista Interéses">
                            <span class="nav-link-text" data-i18n="nav.lista_intereses">@lang('labels.list')</span>
                        </a>
                    </li>
                    @can('prestamos_intereses_nuevo')
                    <li class="{{ $path[0] == 'lend' && $path[1] == 'interest' && $path[2] == 'create' ? 'active' : '' }}">
                        <a href="{{ route('lend_interest_create') }}" title="Nuevo Interés" data-filter-tags="Nuevo Interés">
                            <span class="nav-link-text" data-i18n="nav.nuevo_interes">@lang('lend::labels.lbl_new')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('prestamos_forma_pago')
                <li class="{{ $path[0] == 'lend' && $path[1] == 'paymentmethod' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Formas de Pago" data-filter-tags="Formas de Pago">
                        <i class="fal fa-funnel-dollar"></i>
                        <span class="nav-link-text" data-i18n="nav.formas_pago">@lang('lend::labels.lbl_payment_method')</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'lend' && $path[1] == 'paymentmethod' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('lend_paymentmethod_index') }}" title="Lista Formas de Pago" data-filter-tags="Lista Formas de Pago">
                                <span class="nav-link-text" data-i18n="nav.lista_formas_pago">@lang('labels.list')</span>
                            </a>
                        </li>
                        @can('prestamos_forma_pago_nuevo')
{{--                            <li class="{{ $path[0] == 'lend' && $path[1] == 'paymentmethod' && $path[2] == 'create' ? 'active' : '' }}">--}}
{{--                                <a href="{{ route('lend_paymentmethod_create') }}" title="Nueva Forma de Pago" data-filter-tags="Nueva Forma de Pago">--}}
{{--                                    <span class="nav-link-text" data-i18n="nav.nueva_forma_pago">@lang('lend::labels.lbl_new')</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('prestamos_cuotas')
                <li class="{{ $path[0] == 'lend' && $path[1] == 'quota' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Número de Cuotas" data-filter-tags="Número de Cuotas">
                        <i class="fal fa-list-ol"></i>
                        <span class="nav-link-text" data-i18n="nav.numero_cuotas">@lang('lend::labels.lbl_quotas')</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'lend' && $path[1] == 'quota' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('lend_quota_index') }}" title="Lista de Cuotas" data-filter-tags="Lista de Cuotas">
                                <span class="nav-link-text" data-i18n="nav.lista_formas_pago">@lang('labels.list')</span>
                            </a>
                        </li>
                        @can('prestamos_cuotas_nuevo')
                            <li class="{{ $path[0] == 'lend' && $path[1] == 'quota' && $path[2] == 'create' ? 'active' : '' }}">
                                <a href="{{ route('lend_quota_create') }}" title="Nuevo Numero de Cuotas" data-filter-tags="Nuevo Numero de Cuotas">
                                    <span class="nav-link-text" data-i18n="nav.nueva_cuota">@lang('lend::labels.lbl_new')</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('prestamos_contrato')
                <li class="{{ $path[0] == 'lend' && $path[1] == 'contract' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="Contratos" data-filter-tags="Contratos">
                        <i class="fal fa-money-check-alt"></i>
                        <span class="nav-link-text" data-i18n="nav.contratos">@lang('lend::labels.lbl_contract')</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'lend' && $path[1] == 'contract' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('lend_contract_index') }}" title="Lista de Contratos" data-filter-tags="Lista de Contratos">
                                <span class="nav-link-text" data-i18n="nav.lista_contratos">@lang('labels.list')</span>
                            </a>
                        </li>
                        @can('prestamos_contrato_nuevo')
                            <li class="{{ $path[0] == 'lend' && $path[1] == 'contract' && $path[2] == 'create' ? 'active' : '' }}">
                                <a href="{{ route('lend_contract_create') }}" title="Nuevo Contrato" data-filter-tags="Nuevo Contrato">
                                    <span class="nav-link-text" data-i18n="nav.nueva_contrato">@lang('lend::labels.lbl_new')</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</div>
