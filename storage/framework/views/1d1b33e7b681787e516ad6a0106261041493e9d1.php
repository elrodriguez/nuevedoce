<?php
$path = explode('/', request()->path());
$path[1] = array_key_exists(1, $path) > 0 ? $path[1] : '';
$path[2] = array_key_exists(2, $path) > 0 ? $path[2] : '';
$path[3] = array_key_exists(3, $path) > 0 ? $path[3] : '';
$path[4] = array_key_exists(4, $path) > 0 ? $path[4] : '';
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
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                    data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurante_dashboard')): ?>
                <li class="<?php echo e($path[0] == 'restaurant' && $path[1] == 'dashboard' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('restaurant_dashboard')); ?>" title="Blank Project" data-filter-tags="blank page">
                        <i class="fal fa-tachometer-alt-fast"></i>
                        <span class="nav-link-text" data-i18n="nav.blankpage"><?php echo app('translator')->get('labels.dashBoard'); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-title"><?php echo app('translator')->get('labels.navigation'); ?></li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurante_administracion')): ?>
                <li class="<?php echo e($path[0] == 'restaurant' && $path[1] == 'administration' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Administración" data-filter-tags="Administracion">
                        <i class="fal fa-puzzle-piece"></i>
                        <span class="nav-link-text"
                            data-i18n="nav.clientes"><?php echo e(__('restaurant::labels.administration')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurante_administracion_categorias')): ?>
                            <li
                                class="<?php echo e($path[0] == 'restaurant' && $path[1] == 'administration' && $path[2] == 'categories' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('restaurant_categories_list')); ?>"
                                    title="<?php echo app('translator')->get('restaurant::labels.categories'); ?>"
                                    data-filter-tags="<?php echo app('translator')->get('restaurant::labels.categories'); ?>">
                                    <span class="nav-link-text"
                                        data-i18n="nav.<?php echo app('translator')->get('restaurant::labels.categories'); ?>"><?php echo app('translator')->get('restaurant::labels.categories'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurante_administracion_marcas')): ?>
                            <li
                                class="<?php echo e($path[0] == 'restaurant' && $path[1] == 'administration' && $path[2] == 'brands' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('restaurant_brands_list')); ?>" title="<?php echo app('translator')->get('restaurant::labels.brands'); ?>"
                                    data-filter-tags="<?php echo app('translator')->get('restaurant::labels.brands'); ?>">
                                    <span class="nav-link-text"
                                        data-i18n="nav.<?php echo app('translator')->get('restaurant::labels.brands'); ?>"><?php echo app('translator')->get('restaurant::labels.brands'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurante_administracion_mesas')): ?>
                            <li
                                class="<?php echo e($path[0] == 'restaurant' && $path[1] == 'administration' && $path[2] == 'tables' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('restaurant_tables_list')); ?>" title="<?php echo app('translator')->get('restaurant::labels.tables'); ?>"
                                    data-filter-tags="<?php echo app('translator')->get('restaurant::labels.tables'); ?>">
                                    <span class="nav-link-text"
                                        data-i18n="nav.<?php echo app('translator')->get('restaurant::labels.tables'); ?>"><?php echo app('translator')->get('restaurant::labels.tables'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurante_administracion_comandas')): ?>
                            <li
                                class="<?php echo e($path[0] == 'restaurant' && $path[1] == 'administration' && $path[2] == 'commands' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('restaurant_commands_list')); ?>"
                                    title="<?php echo app('translator')->get('restaurant::labels.commands'); ?>"
                                    data-filter-tags="<?php echo app('translator')->get('restaurant::labels.commands'); ?>">
                                    <span class="nav-link-text"
                                        data-i18n="nav.<?php echo app('translator')->get('restaurant::labels.commands'); ?>"><?php echo app('translator')->get('restaurant::labels.commands'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Restaurant\Resources/views/livewire/sidebar.blade.php ENDPATH**/ ?>