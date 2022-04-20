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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('farmacia_dashboard')): ?>
            <li class="<?php echo e($path[0] == 'pharmacy' && $path[1] == 'dashboard' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('pharmacy_dashboard')); ?>" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-tachometer-alt-fast"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage"><?php echo app('translator')->get('labels.dashBoard'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-title"><?php echo app('translator')->get('labels.navigation'); ?></li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('farmacia_administracion')): ?>
                <li class="<?php echo e($path[0] == 'pharmacy' && $path[1] == 'administration' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                        <i class="fal fa-puzzle-piece"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes"><?php echo e(__('pharmacy::labels.administration')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('farmacia_administracion_sintomas')): ?>
                        <li class="<?php echo e($path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'symptom' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('pharmacy_administration_symptom')); ?>" title="<?php echo app('translator')->get('pharmacy::labels.symptom'); ?>" data-filter-tags="<?php echo app('translator')->get('pharmacy::labels.symptom'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('pharmacy::labels.symptom'); ?>"><?php echo app('translator')->get('pharmacy::labels.symptom'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('farmacia_administracion_enfermedades')): ?>
                        <li class="<?php echo e($path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'diseases' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('pharmacy_administration_diseases')); ?>" title="<?php echo app('translator')->get('pharmacy::labels.diseases'); ?>" data-filter-tags="<?php echo app('translator')->get('pharmacy::labels.diseases'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('pharmacy::labels.diseases'); ?>"><?php echo app('translator')->get('pharmacy::labels.diseases'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('farmacia_administracion_medicinas')): ?>
                        <li class="<?php echo e($path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'medicines' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('pharmacy_administration_medicines')); ?>" title="<?php echo app('translator')->get('pharmacy::labels.medicines'); ?>" data-filter-tags="<?php echo app('translator')->get('pharmacy::labels.medicines'); ?>">
                                <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('pharmacy::labels.medicines'); ?>"><?php echo app('translator')->get('pharmacy::labels.medicines'); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('farmacia_administracion_productos')): ?>
                            <li class="<?php echo e($path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'products' ? 'active' : ''); ?>">
                                <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                                    <span class="nav-link-text" data-i18n="nav.clientes"><?php echo e(__('labels.products')); ?></span>
                                </a>
                                <ul>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('farmacia_administracion_productos_relacionados')): ?>
                                    <li class="<?php echo e($path[0] == 'pharmacy' && $path[1] == 'administration' && $path[2] == 'products' && $path[3] == 'related' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('pharmacy_administration_products_related')); ?>" title="<?php echo app('translator')->get('pharmacy::labels.related'); ?>" data-filter-tags="<?php echo app('translator')->get('pharmacy::labels.related'); ?>">
                                            <span class="nav-link-text" data-i18n="nav.<?php echo app('translator')->get('pharmacy::labels.related'); ?>"><?php echo app('translator')->get('pharmacy::labels.related'); ?></span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('farmacia_ventas')): ?>
                <li class="<?php echo e($path[0] == 'pharmacy' && $path[1] == 'sales' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                        <i class="fal fa-cash-register"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes"><?php echo e(__('pharmacy::labels.sales')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('farmacia_ventas_nuevo')): ?>
                            <li class="<?php echo e($path[0] == 'pharmacy' && $path[1] == 'sales' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('pharmacy_sales_create')); ?>" title="<?php echo app('translator')->get('labels.new'); ?>" data-filter-tags="<?php echo app('translator')->get('labels.new'); ?>">
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
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Pharmacy\Resources/views/livewire/sidebar.blade.php ENDPATH**/ ?>