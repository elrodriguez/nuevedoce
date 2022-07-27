<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group bg-white shadow-inset-2">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-default dropdown-toggle waves-effect waves-themed" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($show); ?></button>
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
                        <button wire:click="$set('search', '')" type="button" class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    <?php else: ?>
                        <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                            <i wire:loading wire:target="itemSearch" wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    <?php endif; ?>
                </div>
                <input wire:keydown.enter="itemSearch" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="<?php echo app('translator')->get('inventory::labels.lbl_type_here'); ?>">
                <div class="input-group-append">
                    <button wire:click="itemSearch" class="btn btn-default waves-effect waves-themed" type="button"><?php echo app('translator')->get('inventory::labels.btn_search'); ?></button>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_importar')): ?>
                        <button onclick="openModalImport()" type="button" class="btn btn-warning waves-effect waves-themed"><?php echo e(__('labels.to_import')); ?></button>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_nuevo')): ?>
                        <a href="<?php echo e(route('inventory_item_create')); ?>" class="btn btn-success waves-effect waves-themed" type="button"><?php echo app('translator')->get('inventory::labels.btn_new'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div >
            <table class="table m-0">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center"><?php echo app('translator')->get('inventory::labels.lbl_actions'); ?></th>
                    <th><?php echo app('translator')->get('inventory::labels.name'); ?></th>
                    <th><?php echo app('translator')->get('inventory::labels.category'); ?></th>
                    <th><?php echo app('translator')->get('inventory::labels.description'); ?></th>
                    <th><?php echo app('translator')->get('inventory::labels.brand'); ?></th>
                    <th class="text-center"><?php echo app('translator')->get('inventory::labels.lbl_part'); ?></th>
                    <th class="text-center"><?php echo app('translator')->get('inventory::labels.lbl_assigned'); ?></th>
                    <th class=""><?php echo app('translator')->get('inventory::labels.lbl_unit_measure'); ?></th>
                    <th class="text-center"><?php echo app('translator')->get('inventory::labels.status'); ?></th>
                </tr>
                </thead>
                <tbody class="">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo e($key + 1); ?></td>
                        <td class="text-center tdw-50 align-middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fal fa-cogs"></i>
                                </button>
                                <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_editar')): ?>
                                        <a href="<?php echo e(route('inventory_item_edit',$item->id)); ?>" class="dropdown-item">
                                            <i class="fal fa-pencil-alt mr-1"></i> <?php echo app('translator')->get('inventory::labels.lbl_edit'); ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_parte')): ?>
                                        <?php if(!$item->part): ?>
                                        <a href="<?php echo e(route('inventory_item_part',$item->id)); ?>" class="dropdown-item">
                                            <i class="ni ni-layers"></i> <?php echo app('translator')->get('inventory::labels.parts'); ?>
                                        </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_fotos')): ?>
                                        <a href="<?php echo e(route('inventory_item_file',$item->id)); ?>" class="dropdown-item">
                                            <i class="ni ni-picture"></i> <?php echo app('translator')->get('inventory::labels.lbl_images'); ?>
                                        </a>
                                    <?php endif; ?>
                                    <div class="dropdown-divider"></div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_eliminar')): ?>
                                        <button onclick="confirmDelete(<?php echo e($item->id); ?>)" type="button" class="dropdown-item text-danger">
                                            <i class="fal fa-trash-alt mr-1"></i> <?php echo app('translator')->get('inventory::labels.lbl_delete'); ?>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle"><?php echo e($item->name); ?></td>
                        <td class="align-middle"><?php echo e($item->name_category); ?></td>
                        <td class="align-middle"><?php echo e($item->description); ?></td>
                        <td class="align-middle"><?php echo e($item->name_brand); ?></td>
                        <td class="text-center align-middle">
                            <?php if($item->part): ?>
                                <span class="badge badge-success"><?php echo e(__('inventory::labels.btn_yes')); ?></span>
                            <?php else: ?>
                                <span class="badge badge-danger"><?php echo e(__('inventory::labels.btn_not')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center align-middle">
                            <?php if($item->item_id): ?>
                                <span class="badge badge-success"><?php echo e(__('inventory::labels.btn_yes')); ?></span>
                            <?php else: ?>
                                <span class="badge badge-danger"><?php echo e(__('inventory::labels.btn_not')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="align-middle"><?php echo e($item->unit_measure); ?></td>
                        <td class="text-center align-middle">
                            <?php if($item->status): ?>
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
        </div>
        <div class="card-footer  pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto"><?php echo e($items->links()); ?></div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImportLabel"><?php echo e(__('labels.to_import')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible mb-0">
                        <div class="d-flex flex-start w-100 ">
                            <div class="mr-2 hidden-md-down">
                                <span class="icon-stack icon-stack-lg">
                                    <i class="base base-6 icon-stack-3x opacity-100 color-primary-500"></i>
                                    <i class="base base-10 icon-stack-2x opacity-100 color-primary-300 fa-flip-vertical"></i>
                                    <i class="fal fa-info icon-stack-1x opacity-100 color-white"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-fill">
                                <div class="flex-fill">
                                    <span class="h5">Cómo funciona</span>
                                    <br>
                                    Para importar tiene que tener el <a href="<?php echo e(route('inventory_item_download_example')); ?>">formato</a> correcto y deberá ser un archivo excel
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="input-group">
                            <input wire:model.defer="file_excel" type="file" id="inputGroupFile03" aria-describedby="inputGroupFile03">
                            
                        </div>
                    </div>
                    <?php if($loading_import): ?>
                        <div class="alert alert-info mt-3" role="alert">
                            <strong><?php echo e(__('labels.congratulations')); ?></strong> <?php echo e(__('labels.file_has_been_uploaded_successfully')); ?>

                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('labels.close')); ?></button>
                    <button wire:loading.remove wire:loading.attr="disabled" wire:click="import" type="button" class="btn btn-primary waves-effect waves-themed">
                        <?php echo e(__('labels.save')); ?>

                    </button>
                    <button style="display:none" wire:target="import" wire:loading class="btn btn-primary waves-effect waves-themed" type="button" disabled="">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <?php echo e(__('labels.aca_loading')); ?>...
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function confirmDelete(id){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> <?php echo e(__('inventory::labels.msg_0001')); ?>",
                message: "<span><strong><?php echo e(__('inventory::labels.lbl_warning')); ?>: </strong> <?php echo e(__('inventory::labels.msg_0002')); ?></span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                    {
                        confirm:
                            {
                                label: '<?php echo e(__('inventory::labels.btn_yes')); ?>',
                                className: 'btn-danger shadow-0'
                            },
                        cancel:
                            {
                                label: '<?php echo e(__('inventory::labels.btn_not')); ?>',
                                className: 'btn-default'
                            }
                    },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        window.livewire.find('<?php echo e($_instance->id); ?>').deleteItem(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }

        document.addEventListener('set-item-delete', event => {
            let res = event.detail.res;

            if(res == 'success'){
                initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.success')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('inventory::labels.excellent')); ?>... </strong><?php echo e(__('inventory::labels.msg_delete')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }else{
                initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.error')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('inventory::labels.went_wrong')); ?>... </strong><?php echo e(__('inventory::labels.msg_not_peptra')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }
        });
        function openModalImport(){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('loading_import',false);
            $('#modalImport').modal('show');
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/item/item-list.blade.php ENDPATH**/ ?>