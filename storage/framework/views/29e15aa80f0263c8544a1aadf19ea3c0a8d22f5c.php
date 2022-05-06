<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group bg-white shadow-inset-2">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-default dropdown-toggle waves-effect waves-themed" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($show); ?></button>
                    <div class="dropdown-menu" style="">
                        <button class="dropdown-item" wire:click="$set('show', 10)">10</button>
                        <button class="dropdown-item" wire:click="$set('show', 20)">20</button>
                        <button class="dropdown-item" wire:click="$set('show', 50)">50</button>
                        <div role="separator" class="dropdown-divider"></div>
                        <button class="dropdown-item" wire:click="$set('show', 100)">100</button>
                        <button class="dropdown-item" wire:click="$set('show', 500)">500</button>
                    </div>
                </div>
                <div class="input-group-prepend">
                    <?php if($search): ?>
                        <button wire:click="$set('search', '')" type="button"
                            class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    <?php else: ?>
                        <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm"
                                wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    <?php endif; ?>
                </div>
                <input wire:keydown.enter="assetSearch" wire:model.defer="search" type="text"
                    class="form-control border-left-0 bg-transparent pl-0"
                    placeholder="<?php echo app('translator')->get('inventory::labels.lbl_type_here'); ?>">
                <div class="input-group-append">
                    <button wire:click="assetSearch" class="btn btn-default waves-effect waves-themed"
                        type="button"><?php echo app('translator')->get('inventory::labels.btn_search'); ?></button>
                    <?php if($PRT0001GN == 8): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_activos_nuevo')): ?>
                            <a href="<?php echo e(route('inventory_asset_create')); ?>"
                                class="btn btn-success waves-effect waves-themed"
                                type="button"><?php echo app('translator')->get('inventory::labels.btn_new'); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <?php if($PRT0001GN == 8): ?>
                            <th class="text-center"><?php echo app('translator')->get('inventory::labels.lbl_actions'); ?></th>
                        <?php endif; ?>
                        <th><?php echo app('translator')->get('inventory::labels.lbl_location'); ?></th>
                        <?php if($PRT0001GN == 8): ?>
                            <th><?php echo app('translator')->get('inventory::labels.lbl_patrimonial_code'); ?></th>
                        <?php else: ?>
                            <th><?php echo app('translator')->get('labels.code'); ?></th>
                        <?php endif; ?>
                        <th><?php echo app('translator')->get('inventory::labels.name'); ?></th>
                        <?php if($PRT0001GN == 8): ?>
                            <th><?php echo app('translator')->get('inventory::labels.lbl_asset_type'); ?></th>
                        <?php else: ?>
                            <th class="text-center"><?php echo app('translator')->get('labels.stock'); ?></th>
                        <?php endif; ?>
                        <th class="text-center"><?php echo app('translator')->get('inventory::labels.status'); ?></th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center align-middle"><?php echo e($key + 1); ?></td>
                            <?php if($PRT0001GN == 8): ?>
                                <td class="text-center tdw-50 align-middle">
                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fal fa-cogs"></i>
                                        </button>
                                        <div class="dropdown-menu"
                                            style="position: absolute; will-change: top, left; top: 35px; left: 0px;"
                                            x-placement="bottom-start">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_activos_editar')): ?>
                                                <a href="<?php echo e(route('inventory_asset_edit', $asset->id)); ?>"
                                                    class="dropdown-item">
                                                    <i class="fal fa-pencil-alt mr-1"></i>
                                                    <?php echo app('translator')->get('inventory::labels.lbl_edit'); ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_parte')): ?>
                                                <?php if(!$asset->part): ?>
                                                    <a href="<?php echo e(route('inventory_asset_part', [$asset->item_id, $asset->id])); ?>"
                                                        class="dropdown-item">
                                                        <i class="ni ni-layers"></i> <?php echo app('translator')->get('inventory::labels.parts'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <div class="dropdown-divider"></div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_activos_eliminar')): ?>
                                                <button onclick="confirmDelete(<?php echo e($asset->id); ?>)" type="button"
                                                    class="dropdown-item text-danger">
                                                    <i class="fal fa-trash-alt mr-1"></i>
                                                    <?php echo app('translator')->get('inventory::labels.lbl_delete'); ?>
                                                </button>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </td>
                            <?php endif; ?>
                            <td class="align-middle"><?php echo e($asset->location_name); ?></td>
                            <?php if($PRT0001GN == 8): ?>
                                <td class="align-middle"><?php echo e($asset->patrimonial_code); ?></td>
                            <?php else: ?>
                                <td class="align-middle"><?php echo e($asset->internal_id); ?></td>
                            <?php endif; ?>
                            <td class="align-middle"><?php echo e($asset->name_item . ' ' . $asset->description); ?></td>
                            <?php if($PRT0001GN == 8): ?>
                                <td class="align-middle"><?php echo e($asset->name_type_asset); ?></td>
                            <?php else: ?>
                                <td class="align-middle text-right"><?php echo e($asset->stock); ?></td>
                            <?php endif; ?>
                            <td class="align-middle text-center">
                                <?php if($asset->state): ?>
                                    <span class="badge badge-success"><?php echo e(__('inventory::labels.active')); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><?php echo e(__('inventory::labels.inactive')); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto"><?php echo e($assets->links()); ?></div>
        </div>
    </div>
    <script type="text/javascript">
        function confirmDelete(id) {
            initApp.playSound('<?php echo e(url('themes/smart-admin/media/sound')); ?>', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> <?php echo e(__('inventory::labels.msg_0001')); ?>",
                message: "<span><strong><?php echo e(__('inventory::labels.lbl_warning')); ?>: </strong> <?php echo e(__('inventory::labels.msg_0002')); ?></span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons: {
                    confirm: {
                        label: '<?php echo e(__('inventory::labels.btn_yes')); ?>',
                        className: 'btn-danger shadow-0'
                    },
                    cancel: {
                        label: '<?php echo e(__('inventory::labels.btn_not')); ?>',
                        className: 'btn-default'
                    }
                },
                className: "modal-alert",
                closeButton: false,
                callback: function(result) {
                    if (result) {
                        window.livewire.find('<?php echo e($_instance->id); ?>').deleteAsset(id)
                    }
                }
            });
            box.find('.modal-content').css({
                'background-color': 'rgba(255, 0, 0, 0.5)'
            });
        }

        document.addEventListener('set-asset-delete', event => {
            let res = event.detail.res;

            if (res == 'success') {
                initApp.playSound('<?php echo e(url('themes/smart-admin/media/sound')); ?>', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.success')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('inventory::labels.excellent')); ?>... </strong><?php echo e(__('inventory::labels.msg_delete')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({
                    'background-color': 'rgba(122, 85, 7, 0.5)'
                });
            } else {
                initApp.playSound('<?php echo e(url('themes/smart-admin/media/sound')); ?>', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.error')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('inventory::labels.went_wrong')); ?>... </strong><?php echo e(__('inventory::labels.msg_not_peptra')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({
                    'background-color': 'rgba(122, 85, 7, 0.5)'
                });
            }
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/asset/asset-list.blade.php ENDPATH**/ ?>