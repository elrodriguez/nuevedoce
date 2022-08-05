<?php
    $path = explode('/', request()->path());
    $path[1] = (array_key_exists(1, $path)> 0)?$path[1]:'';
    $path[2] = (array_key_exists(2, $path)> 0)?$path[2]:'';
    $path[3] = (array_key_exists(3, $path)> 0)?$path[3]:'';
    $path[4] = (array_key_exists(4, $path)> 0)?$path[4]:'';
?>
<div class="page-sidebar">
    <?php if (isset($component)) { $__componentOriginala5469d359b5f07642104d160c27364732eddefa7 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\CompanyLogo::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('company-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\CompanyLogo::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala5469d359b5f07642104d160c27364732eddefa7)): ?>
<?php $component = $__componentOriginala5469d359b5f07642104d160c27364732eddefa7; ?>
<?php unset($__componentOriginala5469d359b5f07642104d160c27364732eddefa7); ?>
<?php endif; ?>
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
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.info-card-user','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('info-card-user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <ul id="js-nav-menu" class="nav-menu">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_dashboard')): ?>
            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'dashboard' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('transferservice_dashboard')); ?>" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage"><?php echo e(__('transferservice::labels.lbl_dashBoard')); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-title"><?php echo e(__('transferservice::labels.lbl_navigation')); ?></li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_clientes')): ?>
                <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'customers' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Clientes" data-filter-tags="Clientes">
                        <i class="fal fa-users-class"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes"><?php echo e(__('transferservice::labels.lbl_customers')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_clientes')): ?>
                        <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'customers' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('service_customers_index')); ?>" title="Listar Clientes" data-filter-tags="Listar Clientes">
                                <span class="nav-link-text" data-i18n="nav.listar_cliente"><?php echo e(__('transferservice::labels.lbl_to_list')); ?> <?php echo e(__('transferservice::labels.lbl_customer')); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_clientes_nuevo')): ?>
                        <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'customers' && $path[2] == 'create' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('service_customers_search', '')); ?>" title="Nuevo Cliente" data-filter-tags="Nuevo Cliente">
                                <span class="nav-link-text" data-i18n="nav.nuevo_cliente"><?php echo e(__('transferservice::labels.lbl_new')); ?> <?php echo e(__('transferservice::labels.lbl_customer')); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_locales')): ?>
                <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'locals' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Locales" data-filter-tags="Locales">
                        <i class="fal fa-store-alt"></i>
                        <span class="nav-link-text" data-i18n="nav.locales"><?php echo e(__('transferservice::labels.lbl_locals')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_locales')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'locals' && $path[2] == 'list' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_locals_index')); ?>" title="Listar Locales" data-filter-tags="Listar Locales">
                                    <span class="nav-link-text" data-i18n="nav.listar_locales"><?php echo e(__('transferservice::labels.lbl_to_list')); ?> <?php echo e(__('transferservice::labels.lbl_local')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_locales_nuevo')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'locals' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_locals_create', '')); ?>" title="Nuevo Local" data-filter-tags="Nuevo Local">
                                    <span class="nav-link-text" data-i18n="nav.nuevo_local"><?php echo e(__('transferservice::labels.lbl_new')); ?> <?php echo e(__('transferservice::labels.lbl_local')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_vehiculos')): ?>
                <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'vehicles' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Vehiculos" data-filter-tags="Vehiculos">
                        <i class="fal fa-truck"></i>
                        <span class="nav-link-text" data-i18n="nav.vehiculos"><?php echo e(__('transferservice::labels.lbl_vehicles')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_vehiculos')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'vehicles' && $path[2] == 'list' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_vehicles_index')); ?>" title="Listar Vehiculos" data-filter-tags="Listar Vehiculos">
                                    <span class="nav-link-text" data-i18n="nav.listar_vehiculos"><?php echo e(__('transferservice::labels.lbl_to_list')); ?> <?php echo e(__('transferservice::labels.lbl_vehicle')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_vehiculos_nuevo')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'vehicles' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_vehicles_create', '')); ?>" title="Nuevo Vehiculo" data-filter-tags="Nuevo Vehiculo">
                                    <span class="nav-link-text" data-i18n="nav.nuevo_vehiculo"><?php echo e(__('transferservice::labels.lbl_new')); ?> <?php echo e(__('transferservice::labels.lbl_vehicle')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_solicitudes_odt')): ?>
                <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'odt_requests' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Solicitudes ODT" data-filter-tags="Solicitudes ODT">
                        <i class="fal fa-paper-plane"></i>
                        <span class="nav-link-text" data-i18n="nav.solicitudes_odt"><?php echo e(__('transferservice::labels.lbl_odt_requests')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_solicitudes_odt')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'odt_requests' && $path[2] == 'list' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_odt_requests_index')); ?>" title="Listar Solicitudes ODT" data-filter-tags="Listar Solicitudes ODT">
                                    <span class="nav-link-text" data-i18n="nav.listar_solicitudes_odt"><?php echo e(__('transferservice::labels.lbl_to_list')); ?> <?php echo e(__('transferservice::labels.lbl_odt_request')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_solicitudes_odt_nuevo')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'odt_requests' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_odt_requests_create', '')); ?>" title="Nueva Solicitud ODT" data-filter-tags="Nueva Solicitud ODT">
                                    <span class="nav-link-text" data-i18n="nav.nuevo_solicitud_odt"><?php echo e(__('transferservice::labels.lbl_new')); ?> <?php echo e(__('transferservice::labels.lbl_odt_request')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_orden_carga')): ?>
                <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'load_order' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="<?php echo e(__('transferservice::labels.lbl_load_order')); ?>" data-filter-tags="<?php echo e(__('transferservice::labels.lbl_load_order')); ?>">
                        <i class="fal fa-person-dolly"></i>
                        <span class="nav-link-text" data-i18n="nav.orden_carga"><?php echo e(__('transferservice::labels.lbl_load_order')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_orden_carga')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'load_order' && $path[2] == 'list' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_load_order_index')); ?>" title="Listar orden carga" data-filter-tags="Listar orden carga">
                                    <span class="nav-link-text" data-i18n="nav.listar_orden_carga"><?php echo e(__('transferservice::labels.lbl_list')); ?> </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_orden_carga_nuevo')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'load_order' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_load_order_create')); ?>" title="Nueva orden carga" data-filter-tags="Nueva orden carga">
                                    <span class="nav-link-text" data-i18n="nav.nuevo_orden_carga"><?php echo e(__('transferservice::labels.lbl_new')); ?> </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_orden_carga_salida')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'load_order' && $path[2] == 'exit' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_load_order_exit')); ?>" title="Salida orden carga" data-filter-tags="Salida orden carga">
                                    <span class="nav-link-text" data-i18n="nav.salida_orden_carga"><?php echo e(__('transferservice::labels.lbl_exit')); ?> </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_orden_carga_retorno')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'load_order' && $path[2] == 'return' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_load_order_return')); ?>" title="Retorno orden carga" data-filter-tags="Retorno orden carga">
                                    <span class="nav-link-text" data-i18n="nav.retorno_orden_carga"><?php echo e(__('transferservice::labels.lbl_return')); ?> </span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_reportes')): ?>
                <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'reports' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Reportes" data-filter-tags="Reportes">
                        <i class="fal fa-analytics"></i>
                        <span class="nav-link-text" data-i18n="nav.reportes"><?php echo e(__('labels.reports')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('serviciodetraslados_reporte_eventos')): ?>
                            <li class="<?php echo e($path[0] == 'transferservice' && $path[1] == 'reports' && $path[2] == 'events' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('service_reports_events')); ?>" title="Reporte Eventos" data-filter-tags="Reporte Eventos">
                                    <span class="nav-link-text" data-i18n="nav.reporte_eventos"><?php echo e(__('labels.report')); ?> <?php echo e(__('transferservice::labels.lbl_events')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/TransferService\Resources/views/livewire/sidebar.blade.php ENDPATH**/ ?>