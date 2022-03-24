<div>
    <div class="px-3 px-sm-5 pt-4">
        <div class="input-group input-group-lg mb-5 shadow-1 rounded">
            <div class="input-group-prepend">
                <?php if($search): ?>
                    <button wire:click="$set('search', '')" type="button" class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                        <i class="fal fa-times"></i>
                    </button>
                <?php else: ?>
                    <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                        <i wire:target="resetPage" wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                    </span>
                <?php endif; ?>
            </div>
            <input type="text" class="form-control shadow-inset-2" wire:model.defer="search" id="filter-icon" aria-label="type 2 or more letters" >
            <div class="input-group-append">
                <button class="btn btn-primary hidden-sm-down" type="button" wire:click="resetPage" ><i class="fal fa-search mr-lg-2"></i><span class="hidden-md-down"><?php echo app('translator')->get('labels.search'); ?></span></button>
                <button class="btn btn-success hidden-sm-down" type="button" wire:click="$emit('openModelParameterCreate')"><i class="fal fa-plus mr-lg-2"></i><span class="hidden-md-down"><?php echo app('translator')->get('labels.new'); ?></span></button>
            </div>
        </div>
    </div>
    <div class="px-3 px-sm-5 pb-4">
        <div class="card">
            <ul class="list-group list-group-flush">
                <?php if(count($parameters) > 0): ?>
                <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label class="form-label"><code><?php echo e($item->id_parameter); ?></code> <?php echo e($item->description); ?></label>
                                <div class="d-flex flex-row align-items-center">
                                    <?php if($item->type == 1): ?>
                                        <div class="mr-3">
                                            <input type="text" class="form-control col-4" wire:model.defer="value_default.<?php echo e($key); ?>">
                                        </div>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed" id="btnsaveparameters<?php echo e($key); ?>" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('<?php echo e($item->id); ?>','<?php echo e($key); ?>')"><i class="fal fa-check"></i></button>
                                    <?php elseif($item->type == 2): ?>
                                        <?php
                                            $arrs = explode('|',$item->code_sql);
                                        ?>
                                        <div wire:ignore class="col-4 p-0">
                                            <select class="custom-select form-control" wire:model.defer="value_default.<?php echo e($key); ?>">
                                                <?php $__currentLoopData = $arrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        list($index,$text) = explode(',',$arr);
                                                    ?>
                                                <option value="<?php echo e($index); ?>"><?php echo e($text); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed mt-3" id="btnsaveparameters<?php echo e($key); ?>" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('<?php echo e($item->id); ?>','<?php echo e($key); ?>')"><i class="fal fa-check"></i></button>
                                    <?php elseif($item->type == 3): ?>
                                        <?php
                                            try {
                                                $arrs = \Illuminate\Support\Facades\DB::select($item->code_sql);
                                                $msg_mysql = null;
                                            } catch (\Illuminate\Database\QueryException $e) {
                                                $msg_mysql = $e->getMessage();
                                                $arrs = [];
                                            }
                                        ?>
                                        
                                        <?php if(count($arrs)>0): ?>
                                            <div wire:ignore class="col-4 p-0">
                                                <select class="custom-select form-control" wire:model.defer="value_default.<?php echo e($key); ?>">
                                                    <?php $__currentLoopData = $arrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($arr->id); ?>"><?php echo e($arr->description); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed mt-3" id="btnsaveparameters<?php echo e($key); ?>" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('<?php echo e($item->id); ?>','<?php echo e($key); ?>')"><i class="fal fa-check"></i></button>
                                        <?php else: ?>
                                            <div wire:ignore class="col-12 p-0">
                                                <div class="alert alert-danger" role="alert">
                                                    <?php echo e($msg_mysql); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php elseif($item->type == 4): ?>
                                        <?php
                                            $arrs = explode('|',$item->code_sql);
                                        ?>
                                        <div class="demo" wire:ignore>
                                            <?php $__currentLoopData = $arrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    list($index,$text) = explode(',',$arr);
                                                ?>
                                                <div class="custom-control custom-radio">
                                                    <input wire:model.defer="value_default.<?php echo e($key); ?>" type="radio" class="custom-control-input" id="radio<?php echo e($key.$index); ?>" name="radio<?php echo e($key.$item->type); ?>" value="<?php echo e($index); ?>">
                                                    <label class="custom-control-label" for="radio<?php echo e($key.$index); ?>"><?php echo e($text); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed mt-3" id="btnsaveparameters<?php echo e($key); ?>" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('<?php echo e($item->id); ?>','<?php echo e($key); ?>')"><i class="fal fa-check"></i></button>
                                    <?php elseif($item->type == 5): ?>
                                        <?php
                                            $arrs_k = explode('|',$item->code_sql);
                                        ?>
                                        <div class="demo mr-3" wire:ignore>
                                            <?php $__currentLoopData = $arrs_k; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    list($index,$text) = explode(',',$arr);
                                                ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked<?php echo e($key.$k.$index); ?>" wire:model.defer="value_default.<?php echo e($key); ?>" value="<?php echo e($index); ?>">
                                                    <label class="custom-control-label" for="defaultUnchecked<?php echo e($key.$k.$index); ?>"><?php echo e($text); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed mt-3" id="btnsaveparameters<?php echo e($key); ?>" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('<?php echo e($item->id); ?>','<?php echo e($key); ?>')"><i class="fal fa-check"></i></button>
                                    <?php elseif($item->type == 6): ?>
                                        <div class="demo">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                                                <label class="custom-control-label" for="defaultUnchecked">Unchecked</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="defaultChecked" checked="">
                                                <label class="custom-control-label" for="defaultChecked">Checked</label>
                                            </div>
                                        </div>
                                    <?php elseif($item->type == 7): ?>
                                        <div class="demo">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                                                <label class="custom-control-label" for="defaultUnchecked">Unchecked</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="defaultChecked" checked="">
                                                <label class="custom-control-label" for="defaultChecked">Checked</label>
                                            </div>
                                        </div>
                                    <?php elseif($item->type == 8): ?>
                                        <textarea class="form-control mr-3" wire:model.defer="value_default.<?php echo e($key); ?>"></textarea>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed" id="btnsaveparameters<?php echo e($key); ?>" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('<?php echo e($item->id); ?>','<?php echo e($key); ?>')"><i class="fal fa-check"></i></button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <span onclick="confirmDelete(<?php echo e($item->id); ?>)" style="cursor: pointer;" class="badge badge-danger badge-pill float-right"><?php echo app('translator')->get('labels.delete'); ?></span>
                            <span wire:click="$emit('openModelParameterEdit',<?php echo e($item->id); ?>)" style="cursor: pointer;" class="badge badge-primary badge-pill float-right mr-1"><?php echo app('translator')->get('labels.edit'); ?></span>
                        </div>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <li class="list-group-item">
                    <div class="alert alert-info text-center" role="alert">
                        <?php echo e(__('labels.no_records_to_display')); ?>

                    </div>
                </li>
                <?php endif; ?>
            </ul>
            <div class="card-footer">
                <?php echo e($parameters->links()); ?>

            </div>
        </div>

    </div>
    <script>
        window.addEventListener('response_parameter_value_default_update', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.message+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });

        function confirmDelete(id){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> ¿Desea eliminar estos datos?",
                message: "<span><strong>Advertencia: </strong> ¡Esta acción no se puede deshacer!</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                {
                    confirm:
                    {
                        label: 'Si',
                        className: 'btn-danger shadow-0'
                    },
                    cancel:
                    {
                        label: 'No',
                        className: 'btn-default'
                    }
                },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        window.livewire.find('<?php echo e($_instance->id); ?>').deleteparameter(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }

        document.addEventListener('set-parameter-delete', event => {
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
                    title: "<i class='fal fa-times-hexagon text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('setting::labels.error')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('setting::labels.went_wrong')); ?>... </strong><?php echo e(__('setting::labels.msg_not_peptra')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(214, 36, 16, 0.5)'});
            }
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Setting\Resources/views/livewire/parameters/parameters-list.blade.php ENDPATH**/ ?>