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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_dashboard')): ?>
            <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'dashboard' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('lend_dashboard')); ?>" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage"><?php echo app('translator')->get('labels.dashBoard'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-title"><?php echo app('translator')->get('labels.navigation'); ?></li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_clientes')): ?>
                <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'customers' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Clientes" data-filter-tags="Clientes">
                        <i class="fal fa-users-class"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes"><?php echo e(__('lend::labels.lbl_customers')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_clientes')): ?>
                        <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'customers' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('lend_customers_index')); ?>" title="Listar Clientes" data-filter-tags="Listar Clientes">
                                <span class="nav-link-text" data-i18n="nav.listar_cliente"><?php echo e(__('lend::labels.lbl_to_list')); ?> <?php echo e(__('lend::labels.lbl_customer')); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_clientes_nuevo')): ?>
                        <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'customers' && $path[2] == 'create' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('lend_customers_search')); ?>" title="Nuevo Cliente" data-filter-tags="Nuevo Cliente">
                                <span class="nav-link-text" data-i18n="nav.nuevo_cliente"><?php echo e(__('lend::labels.lbl_new')); ?> <?php echo e(__('lend::labels.lbl_customer')); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_intereses')): ?>
            <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'interest' ? 'active open' : ''); ?>">
                <a href="javascript:void(0);" title="Intereses" data-filter-tags="Intereses">
                    <i class="fal fa-percent"></i>
                    <span class="nav-link-text" data-i18n="nav.interes"><?php echo app('translator')->get('lend::labels.lbl_interest'); ?></span>
                </a>
                <ul>
                    <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'interest' && $path[2] == 'list' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('lend_interest_list')); ?>" title="Lista Interéses" data-filter-tags="Lista Interéses">
                            <span class="nav-link-text" data-i18n="nav.lista_intereses"><?php echo app('translator')->get('labels.list'); ?></span>
                        </a>
                    </li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_intereses_nuevo')): ?>
                    <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'interest' && $path[2] == 'create' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('lend_interest_create')); ?>" title="Nuevo Interés" data-filter-tags="Nuevo Interés">
                            <span class="nav-link-text" data-i18n="nav.nuevo_interes"><?php echo app('translator')->get('lend::labels.lbl_new'); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_forma_pago')): ?>
                <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'paymentmethod' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Formas de Pago" data-filter-tags="Formas de Pago">
                        <i class="fal fa-list-alt"></i>
                        <span class="nav-link-text" data-i18n="nav.formas_pago"><?php echo app('translator')->get('lend::labels.lbl_payment_method'); ?></span>
                    </a>
                    <ul>
                        <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'paymentmethod' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('lend_paymentmethod_index')); ?>" title="Lista Formas de Pago" data-filter-tags="Lista Formas de Pago">
                                <span class="nav-link-text" data-i18n="nav.lista_formas_pago"><?php echo app('translator')->get('labels.list'); ?></span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_forma_pago_nuevo')): ?>





                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_cuotas')): ?>
                <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'quota' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Número de Cuotas" data-filter-tags="Número de Cuotas">
                        <i class="fal fa-list-ol"></i>
                        <span class="nav-link-text" data-i18n="nav.numero_cuotas"><?php echo app('translator')->get('lend::labels.lbl_quotas'); ?></span>
                    </a>
                    <ul>
                        <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'quota' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('lend_quota_index')); ?>" title="Lista de Cuotas" data-filter-tags="Lista de Cuotas">
                                <span class="nav-link-text" data-i18n="nav.lista_formas_pago"><?php echo app('translator')->get('labels.list'); ?></span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_cuotas_nuevo')): ?>
                            <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'quota' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('lend_quota_create')); ?>" title="Nuevo Numero de Cuotas" data-filter-tags="Nuevo Numero de Cuotas">
                                    <span class="nav-link-text" data-i18n="nav.nueva_cuota"><?php echo app('translator')->get('lend::labels.lbl_new'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_contrato')): ?>
                <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'contract' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Contratos" data-filter-tags="Contratos">
                        <i class="fal fa-file-invoice-dollar"></i>
                        <span class="nav-link-text" data-i18n="nav.contratos"><?php echo app('translator')->get('lend::labels.lbl_contract'); ?></span>
                    </a>
                    <ul>
                        <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'contract' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('lend_contract_index')); ?>" title="Lista de Contratos" data-filter-tags="Lista de Contratos">
                                <span class="nav-link-text" data-i18n="nav.lista_contratos"><?php echo app('translator')->get('labels.list'); ?></span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_contrato_nuevo')): ?>
                            <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'contract' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('lend_contract_create')); ?>" title="Nuevo Contrato" data-filter-tags="Nuevo Contrato">
                                    <span class="nav-link-text" data-i18n="nav.nueva_contrato"><?php echo app('translator')->get('lend::labels.lbl_new'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_cobros')): ?>
                <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'charges' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Cobros" data-filter-tags="Cobros">
                        <i class="fal fa-cash-register"></i>
                        <span class="nav-link-text" data-i18n="nav.cobros"><?php echo app('translator')->get('lend::labels.lbl_charges'); ?></span>
                    </a>
                    <ul>
                        <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'charges' && $path[2] == 'on_day' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('lend_charges_on_day')); ?>" title="buscar pagos del dia" data-filter-tags="Lista de Contratos">
                                <span class="nav-link-text" data-i18n="nav.buscar_pagos_del_dia"><?php echo app('translator')->get('lend::labels.lbl_filter_payments_the_day'); ?></span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prestamos_cobros_pagar')): ?>
                            <li class="<?php echo e($path[0] == 'lend' && $path[1] == 'charges' && $path[2] == 'pay' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('lend_charges_pay')); ?>" title="Pagar Cuota" data-filter-tags="Pagar Cuota">
                                    <span class="nav-link-text" data-i18n="nav.pagar_cuota"><?php echo app('translator')->get('lend::labels.lbl_pay_fee'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Lend\Resources/views/livewire/sidebar.blade.php ENDPATH**/ ?>