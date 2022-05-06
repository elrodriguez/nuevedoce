<?php
$path = explode('/', request()->path());
$path[1] = array_key_exists(1, $path) > 0 ? $path[1] : '';
$path[2] = array_key_exists(2, $path) > 0 ? $path[2] : '';
$path[3] = array_key_exists(3, $path) > 0 ? $path[3] : '';
$path[4] = array_key_exists(4, $path) > 0 ? $path[4] : '';

$PRT0001GN = \App\Models\Parameter::where('id_parameter', 'PRT0001GN')->first()->value_default;
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_dashboard')): ?>
                <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'dashboard' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('inventory_dashboard')); ?>" title="Blank Project" data-filter-tags="blank page">
                        <i class="fal fa-tachometer-alt-fast"></i>
                        <span class="nav-link-text" data-i18n="nav.blankpage">DashBoard</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-title">Navegación</li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_ubicaciones')): ?>
                <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'location' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="location" data-filter-tags="location">
                        <i class="fal fa-map-marker"></i>
                        <span class="nav-link-text"
                            data-i18n="nav.location"><?php echo e(__('inventory::labels.lbl_location')); ?></span>
                    </a>
                    <ul>
                        <li
                            class="<?php echo e($path[0] == 'inventory' && $path[1] == 'location' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('inventory_location')); ?>" title="Datos ubicacion"
                                data-filter-tags="Datos ubicacion">
                                <span class="nav-link-text" data-i18n="nav.datos_ubicacion">Listado Ubicaciones</span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_ubicaciones_nuevo')): ?>
                            <li
                                class="<?php echo e($path[0] == 'inventory' && $path[1] == 'location' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_location_create')); ?>" title="Datos ubicacion nuevo"
                                    data-filter-tags="Datos ubicacion nuevo">
                                    <span class="nav-link-text" data-i18n="nav.datos_ubicacion_nuevo">Nuevo Ubicación</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_categorias')): ?>
                <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'category' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                        <i class="ni ni-book-open"></i>
                        <span class="nav-link-text" data-i18n="nav.empresa">Categoria</span>
                    </a>
                    <ul>
                        <li
                            class="<?php echo e($path[0] == 'inventory' && $path[1] == 'category' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('inventory_category')); ?>" title="Datos Generales"
                                data-filter-tags="Datos Generales">
                                <span class="nav-link-text" data-i18n="nav.datos_generales">Listado Categoria</span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_categorias_nuevo')): ?>
                            <li
                                class="<?php echo e($path[0] == 'inventory' && $path[1] == 'category' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_category_create')); ?>" title="Datos Generales"
                                    data-filter-tags="Datos Generales">
                                    <span class="nav-link-text" data-i18n="nav.datos_generales">Nuevo Categoria</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_marcas')): ?>
                <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'brand' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                        <i class="ni ni-tag"></i>
                        <span class="nav-link-text" data-i18n="nav.empresa">Marca</span>
                    </a>
                    <ul>
                        <li
                            class="<?php echo e($path[0] == 'inventory' && $path[1] == 'brand' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('inventory_brand')); ?>" title="Datos Generales"
                                data-filter-tags="Datos Generales">
                                <span class="nav-link-text" data-i18n="nav.datos_generales">Listado Marca</span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_marcas_nuevo')): ?>
                            <li
                                class="<?php echo e($path[0] == 'inventory' && $path[1] == 'brand' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_brand_create')); ?>" title="Datos Generales"
                                    data-filter-tags="Datos Generales">
                                    <span class="nav-link-text" data-i18n="nav.datos_generales">Nuevo Marca</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items')): ?>
                <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'item' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Items" data-filter-tags="Items">
                        <i class="ni ni-social-dropbox"></i>
                        <span class="nav-link-text" data-i18n="nav.items"><?php echo app('translator')->get('inventory::labels.lbl_items'); ?></span>
                    </a>
                    <ul>
                        <li
                            class="<?php echo e($path[0] == 'inventory' && $path[1] == 'item' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('inventory_item')); ?>" title="Listado de Items"
                                data-filter-tags="Listado de Items">
                                <span class="nav-link-text"
                                    data-i18n="nav.listado_items"><?php echo app('translator')->get('inventory::labels.lbl_list'); ?>
                                    <?php echo app('translator')->get('inventory::labels.lbl_items'); ?></span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_nuevo')): ?>
                            <li
                                class="<?php echo e($path[0] == 'inventory' && $path[1] == 'item' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_item_create')); ?>" title="Nuevo Item"
                                    data-filter-tags="Nuevo Item">
                                    <span class="nav-link-text" data-i18n="nav.item_nuevo"><?php echo app('translator')->get('inventory::labels.btn_new'); ?>
                                        <?php echo app('translator')->get('inventory::labels.lbl_item'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_activos')): ?>
                <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'asset' ? 'active open' : ''); ?>">
                    <?php if($PRT0001GN == '8'): ?>
                        <a href="javascript:void(0);" title="Activos" data-filter-tags="Activos">
                            <i class="fal fa-barcode-alt"></i>
                            <span class="nav-link-text" data-i18n="nav.activos">Activos código</span>
                        </a>
                    <?php else: ?>
                        <a href="javascript:void(0);" title="Productos Almacen" data-filter-tags="Productos Almacen">
                            <i class="fal fa-garage"></i>
                            <span class="nav-link-text" data-i18n="nav.producto_almacen">Producto almacén</span>
                        </a>
                    <?php endif; ?>
                    <ul>
                        <?php if($PRT0001GN == '8'): ?>
                            <li
                                class="<?php echo e($path[0] == 'inventory' && $path[1] == 'asset' && $path[2] == 'list' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_asset')); ?>" title="Activos" data-filter-tags="Activos">
                                    <span class="nav-link-text" data-i18n="nav.activos">Listado Activos</span>
                                </a>
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_activos_nuevo')): ?>
                                <li
                                    class="<?php echo e($path[0] == 'inventory' && $path[1] == 'asset' && $path[2] == 'create' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('inventory_asset_create')); ?>" title="Activos Nuevo"
                                        data-filter-tags="Activos Nuevo">
                                        <span class="nav-link-text" data-i18n="nav.activos_nuevo">Nuevo Activo</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li
                                class="<?php echo e($path[0] == 'inventory' && $path[1] == 'asset' && $path[2] == 'list' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_asset')); ?>" title="Producto almacén"
                                    data-filter-tags="Producto almacén">
                                    <span class="nav-link-text" data-i18n="nav.producto_almacen">
                                        <?php echo e(__('labels.list')); ?>

                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_compras')): ?>
                <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'purchase' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="Compras" data-filter-tags="Compras">
                        <i class="fal fa-shopping-cart"></i>
                        <span class="nav-link-text" data-i18n="nav.compras"><?php echo app('translator')->get('inventory::labels.lbl_shopping'); ?></span>
                    </a>
                    <ul>
                        <li
                            class="<?php echo e($path[0] == 'inventory' && $path[1] == 'purchase' && $path[2] == 'list' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('inventory_purchase')); ?>" title="Listado de Compras"
                                data-filter-tags="Listado de Compras">
                                <span class="nav-link-text"
                                    data-i18n="nav.listado_compras"><?php echo app('translator')->get('inventory::labels.lbl_list'); ?>
                                    <?php echo app('translator')->get('inventory::labels.lbl_shopping'); ?></span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_compras_nuevo')): ?>
                            <li
                                class="<?php echo e($path[0] == 'inventory' && $path[1] == 'purchase' && $path[2] == 'create' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_purchase_create')); ?>" title="Nueva Compra"
                                    data-filter-tags="Nueva Compra">
                                    <span class="nav-link-text" data-i18n="nav.nueva_compra"><?php echo app('translator')->get('inventory::labels.lbl_new'); ?>
                                        <?php echo app('translator')->get('inventory::labels.lbl_purchase'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_movimientos')): ?>
                <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'movements' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="<?php echo app('translator')->get('inventory::labels.lbl_movements'); ?>"
                        data-filter-tags="<?php echo app('translator')->get('inventory::labels.lbl_movements'); ?>">
                        <i class="fal fa-person-dolly"></i>
                        <span class="nav-link-text"
                            data-i18n="nav.<?php echo app('translator')->get('inventory::labels.lbl_movements'); ?>"><?php echo app('translator')->get('inventory::labels.lbl_movements'); ?>
                            & <?php echo app('translator')->get('inventory::labels.lbl_movements_transfers'); ?></span>
                    </a>
                    <ul>
                        <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'movements' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('inventory_movements')); ?>"
                                title="<?php echo e(__('inventory::labels.lbl_movements')); ?>"
                                data-filter-tags="<?php echo e(__('inventory::labels.lbl_movements')); ?>">
                                <span class="nav-link-text"
                                    data-i18n="nav.movimientos"><?php echo e(__('inventory::labels.lbl_movements')); ?></span>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_traslados')): ?>
                            <li class="<?php echo e($path[0] == 'inventory' && $path[1] == 'transfers' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_transfers')); ?>"
                                    title="<?php echo app('translator')->get('inventory::labels.lbl_movements_transfers'); ?>"
                                    data-filter-tags="<?php echo app('translator')->get('inventory::labels.lbl_movements_transfers'); ?>">
                                    <span class="nav-link-text"
                                        data-i18n="nav.traslados"><?php echo app('translator')->get('inventory::labels.lbl_movements_transfers'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_kardex')): ?>
                <li class="<?php echo e($path[0] == 'kardex' && $path[1] == 'asset' ? 'active open' : ''); ?>">
                    <a href="javascript:void(0);" title="empresa" data-filter-tags="empresa">
                        <i class="fal fa-file-chart-line"></i>
                        <span class="nav-link-text"
                            data-i18n="nav.empresa"><?php echo e(__('inventory::labels.lbl_kardex')); ?></span>
                    </a>
                    <ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_kardex_items_stock')): ?>
                            <li
                                class="<?php echo e($path[0] == 'inventory' && $path[1] == 'kardex' && $path[2] == 'item_stock' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_kardex_items_stock')); ?>" title="Stock por Item"
                                    data-filter-tags="Stock por Item">
                                    <span class="nav-link-text" data-i18n="nav.stock_por_item">Stock por Item</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_kardex_active_codes')): ?>
                            <li
                                class="<?php echo e($path[0] == 'inventory' && $path[1] == 'kardex' && $path[2] == 'active_codes' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('inventory_kardex_active_codes')); ?>"
                                    title="<?php echo e(__('inventory::labels.lbl_assets_with_code')); ?>"
                                    data-filter-tags="<?php echo e(__('inventory::labels.lbl_assets_with_code')); ?>">
                                    <span class="nav-link-text"
                                        data-i18n="nav.activos_con_codigos"><?php echo e(__('inventory::labels.lbl_assets_with_code')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/sidebar.blade.php ENDPATH**/ ?>