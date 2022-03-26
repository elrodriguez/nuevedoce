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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_dashboard')): ?>
            <li class="<?php echo e($path[0] == 'sales' && $path[1] == 'dashboard' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('sales_dashboard')); ?>" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage"><?php echo app('translator')->get('labels.dashBoard'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-title"><?php echo app('translator')->get('labels.navigation'); ?></li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_administracion')): ?>
                <li class="<?php echo e($path[0] == 'sales' && $path[1] == 'administration' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                        <i class="fal fa-puzzle-piece"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes"><?php echo e(__('sales::labels.lbl_administration')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_administration_series')): ?>
                        <li class="<?php echo e($path[0] == 'sales' && $path[1] == 'administration' && $path[2] == 'series' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('sales_administration_series')); ?>" title="<?php echo app('translator')->get('labels.series'); ?>" data-filter-tags="<?php echo app('translator')->get('labels.series'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('labels.series'); ?>"><?php echo app('translator')->get('labels.series'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_administracion_caja_chica')): ?>
                        <li class="<?php echo e($path[0] == 'sales' && $path[1] == 'administration' && $path[2] == 'cash' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('sales_administration_cash')); ?>" title="<?php echo app('translator')->get('labels.petty_cash'); ?>" data-filter-tags="<?php echo app('translator')->get('labels.petty_cash'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('labels.petty_cash'); ?>"><?php echo app('translator')->get('labels.petty_cash'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_comprobante')): ?>
                <li class="<?php echo e(($path[0] === 'sales' && $path[1] === 'documents')?'active open':''); ?>">
                    <a href="#" title="<?php echo app('translator')->get('labels.sales'); ?>" data-filter-tags="<?php echo app('translator')->get('labels.sales'); ?>">
                        <i class="fal fa-file-invoice-dollar"></i>
                        <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('labels.sales'); ?>"> <?php echo app('translator')->get('sales::labels.voucher'); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_comprobante_listado')): ?>
                        <li class="<?php echo e(($path[0] === 'sales' && $path[1] === 'documents' && $path[2] === 'list') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('sales_document_list')); ?>" title="<?php echo app('translator')->get('labels.voucher_list'); ?>" data-filter-tags="<?php echo app('translator')->get('labels.voucher_list'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('labels.list'); ?>"><?php echo app('translator')->get('labels.voucher_list'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_comprobante_nuevo')): ?>
                        <li class="<?php echo e(($path[0] === 'sales' && $path[1] === 'documents' && $path[2] === 'create')?'active':''); ?>">
                            <a href="<?php echo e(route('sales_document_create')); ?>" title="<?php echo app('translator')->get('labels.new'); ?>" data-filter-tags="<?php echo app('translator')->get('labels.new_document'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('labels.new_document'); ?>"><?php echo app('translator')->get('labels.new_document'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_nota_venta')): ?>
                        <li class="<?php echo e(($path[0] === 'sales' && $path[1] === 'documents' && $path[2] === 'notes')?'active':''); ?>">
                            <a href="<?php echo e(route('sales_documents_sale_notes')); ?>" title="<?php echo app('translator')->get('sales::labels.sales_notes'); ?>" data-filter-tags="<?php echo app('translator')->get('sales::labels.sales_notes'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('sales::labels.sales_notes'); ?>"><?php echo app('translator')->get('sales::labels.sales_notes'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_gastos')): ?>
                <li class="<?php echo e($path[0] == 'sales' && $path[1] == 'expenses' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="<?php echo e(__('sales::labels.expenses')); ?>" data-filter-tags="<?php echo e(__('sales::labels.expenses')); ?>">
                        <i class="fal fa-money-bill-wave"></i>
                        <span class="nav-link-text" data-i18n="nav.<?php echo e(__('sales::labels.expenses')); ?>"><?php echo e(__('sales::labels.expenses')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_gastos')): ?>
                        <li class="<?php echo e($path[0] == 'sales' && $path[1] == 'expenses' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('sales_expenses_list')); ?>" title="<?php echo app('translator')->get('labels.list'); ?>" data-filter-tags="<?php echo app('translator')->get('labels.list'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('labels.list'); ?>"><?php echo app('translator')->get('labels.list'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_gastos_nuevo')): ?>
                        <li class="<?php echo e($path[0] == 'sales' && $path[1] == 'expenses' && $path[2] == 'create' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('sales_expenses_create')); ?>" title="<?php echo app('translator')->get('labels.new'); ?>" data-filter-tags="<?php echo app('translator')->get('labels.new'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('labels.new'); ?>"><?php echo app('translator')->get('labels.new'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/sidebar.blade.php ENDPATH**/ ?>