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
            @can('configuraciones_dashboard')
            <li class="{{ $path[0] == 'setting' && $path[1] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('setting_dashboard') }}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">DashBoard</span>
                </a>
            </li>
            @endcan
            <li class="nav-title">Navegación</li>
            @can('configuraciones_empresas')
                <li class="{{ $path[0] == 'setting' && $path[1] == 'company' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                        <i class="fal fa-city"></i>
                        <span class="nav-link-text" data-i18n="nav.empresa">{{ __('setting::labels.my_company') }}</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'company' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('setting_company') }}" title="empresas" data-filter-tags="Datos Generales">
                                <span class="nav-link-text" data-i18n="nav.datos_generales">{{ __('setting::labels.companies_list') }}</span>
                            </a>
                        </li>
                        @can('configuraciones_empresas_nuevo')
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'company' && $path[2] == 'create' ? 'active' : '' }}">
                            <a href="{{ route('setting_company_create') }}" title="empresas" data-filter-tags="nueva empresa">
                                <span class="nav-link-text" data-i18n="nav.nueva_empresa">{{ __('setting::labels.companies_create') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('configuraciones_establecimientos')
                <li class="{{ $path[0] == 'setting' && $path[1] == 'establishment' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="establecimientos" data-filter-tags="establecimientos">
                        <i class="fal fa-store-alt"></i>
                        <span class="nav-link-text" data-i18n="nav.establecimientos">{{ __('setting::labels.establishment') }}</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'establishment' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('setting_establishment') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                                <span class="nav-link-text" data-i18n="nav.datos_generales">Listado</span>
                            </a>
                        </li>
                        @can('configuraciones_establecimientos_nuevo')
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'establishment' && $path[2] == 'create' ? 'active' : '' }}">
                            <a href="{{ route('setting_establishment_create') }}" title="Datos Generales" data-filter-tags="Datos Generales">
                                <span class="nav-link-text" data-i18n="nav.datos_generales">Nuevo</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('configuraciones_bancos')
                <li class="{{ $path[0] == 'setting' && $path[1] == 'banks' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="bancos" data-filter-tags="bancos">
                        <i class="fal fa-pig"></i>
                        <span class="nav-link-text" data-i18n="nav.bancos">{{ __('labels.bank_entities') }}</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'banks' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('setting_banks') }}" title="bancos listado" data-filter-tags="bancos listado">
                                <span class="nav-link-text" data-i18n="nav.bancos_listado">{{ __('labels.list') }}</span>
                            </a>
                        </li>
                        @can('configuraciones_establecimientos_nuevo')
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'banks' && $path[2] == 'create' ? 'active' : '' }}">
                            <a href="{{ route('setting_banks_create') }}" title="bancos nuevo" data-filter-tags="bancos nuevo">
                                <span class="nav-link-text" data-i18n="nav.bancos_nuevo">{{ __('labels.new') }}</span>
                            </a>
                        </li>
                        @endcan
                        @can('configuraciones_bancos_cuentas')
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'banks' && $path[2] == 'accounts' ? 'active' : '' }}">
                            <a href="{{ route('setting_banks_accounts') }}" title="{{ __('labels.bank_accounts') }}" data-filter-tags="{{ __('labels.bank_accounts') }}">
                                <span class="nav-link-text" data-i18n="nav.bancos_cuentas">{{ __('labels.bank_accounts') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('configuraciones_roles')
                <li class="{{ $path[0] == 'setting' && $path[1] == 'roles' ? 'active' : '' }}">
                    <a href="{{ route('setting_roles') }}" title="roles" data-filter-tags="roles">
                        <i class="fal fa-user-tie"></i>
                        <span class="nav-link-text" data-i18n="nav.roles">{{ __('setting::labels.roles') }}</span>
                    </a>
                </li>
            @endcan
            @can('configuraciones_usuarios')
                <li class="{{ $path[0] == 'setting' && $path[1] == 'users' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="usuarios" data-filter-tags="usuarios">
                        <i class="fal fa-users"></i>
                        <span class="nav-link-text" data-i18n="nav.usuarios">Usuarios</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'users' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('setting_users') }}" title="Listado de Usuarios" data-filter-tags="Listado de Usuarios">
                                <span class="nav-link-text" data-i18n="nav.listado_de_usuarios">Listado de Usuarios</span>
                            </a>
                        </li>
                        @can('configuraciones_usuarios_nuevo')
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'users' && $path[2] == 'create' ? 'active' : '' }}">
                            <a href="{{ route('setting_users_create') }}" title="Nuevo Usuarios" data-filter-tags="Nuevo Usuarios">
                                <span class="nav-link-text" data-i18n="nav.nuevo_usuarios">Nuevo Usuarios</span>
                            </a>
                        </li>
                        @endcan
                        @can('configuraciones_usuarios_actividades')
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'users' && $path[2] == 'activities' ? 'active' : '' }}">
                            <a href="{{ route('setting_users_activities') }}" title="Actividades en el sistema" data-filter-tags="Actividades en el sistema">
                                <span class="nav-link-text" data-i18n="nav.actividades_en_el_sistema">{{ __('setting::labels.activities_system') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('configuraciones_modulos')
                <li class="{{ $path[0] == 'setting' && $path[1] == 'modules' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" title="modulos" data-filter-tags="modulos">
                        <i class="fal fa-cubes"></i>
                        <span class="nav-link-text" data-i18n="nav.modulos">{{ __('setting::labels.modules') }}</span>
                    </a>
                    <ul>
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'modules' && $path[2] == 'list' ? 'active' : '' }}">
                            <a href="{{ route('setting_modules') }}" title="Listado de modulos" data-filter-tags="Listado de modulos">
                                <span class="nav-link-text" data-i18n="nav.listado_de_modulos">Listado de Modulos</span>
                            </a>
                        </li>
                        @can('configuraciones_modulos_nuevo')
                        <li class="{{ $path[0] == 'setting' && $path[1] == 'modules' && $path[2] == 'create' ? 'active' : '' }}">
                            <a href="{{ route('setting_modules_create') }}" title="Nuevo Modulo" data-filter-tags="Nuevo Modulo">
                                <span class="nav-link-text" data-i18n="nav.nuevo_modulo">Nuevo Modulo</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('configuraciones_parametros')
            <li class="{{ $path[0] == 'setting' && $path[1] == 'parameters' ? 'active' : '' }}">
                <a href="{{ route('parameters') }}" title="{{ __('setting::labels.parameters') }}" data-filter-tags="{{ __('setting::labels.parameters') }}">
                    <i class="fal fa-puzzle-piece"></i>
                    <span class="nav-link-text" data-i18n="nav.{{ __('setting::labels.parameters') }}">{{ __('setting::labels.parameters') }}</span>
                </a>
            </li>
            @endcan
        </ul>
    </nav>
</div>
