<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation <?php echo e($errors->any()?'was-validated':''); ?>" novalidate="">
                <?php if($part && $id_item != 0): ?>
                    <br>
                    <div id="xyzDivParteAsigned">
                        <h2 class="fw-700 m-0"><i class="subheader-icon fal fa-box"></i> <?php echo app('translator')->get('inventory::labels.lbl_main_item'); ?>:</h2>
                        <br>
                        <div class="form-row">
                            <div class="col-md-7 mb-3">
                                <label class="form-label" for="partAsigned_text"><?php echo app('translator')->get('inventory::labels.lbl_item'); ?> <span class="text-danger">*</span> </label>
                                <input wire:model="partAsigned_text" wire:ignore id="partAsigned_text" required="" class="form-control" type="text" placeholder="Ingrese la parte a buscar y luego seleccione." autocomplete="off" readonly />
                                <?php $__errorArgs = ['partAsigned_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="amount_asigned"><?php echo app('translator')->get('inventory::labels.lbl_amount'); ?> <span class="text-danger">*</span> </label>
                                <input wire:model="amount_asigned" type="amount_asigned" class="form-control" id="amount" min="1" required="">
                                <?php $__errorArgs = ['amount_asigned'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <h2 class="fw-700 m-0"><i class="subheader-icon fal fa-edit"></i> <?php echo app('translator')->get('inventory::labels.lbl_edit'); ?> <?php echo app('translator')->get('inventory::labels.lbl_part'); ?> :</h2>
                    <br>
                <?php endif; ?>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="name"><?php echo app('translator')->get('inventory::labels.name'); ?> <span class="text-danger">*</span> </label>
                        <input wire:model="name" type="text" class="form-control" id="name" required="">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="category_id"><?php echo app('translator')->get('inventory::labels.category'); ?> <span class="text-danger">*</span> </label>
                        <select wire:model="category_id" id="category_id" class="custom-select" required="">
                            <option value=""><?php echo app('translator')->get('inventory::labels.lbl_select'); ?></option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="brand_id"><?php echo app('translator')->get('inventory::labels.brand'); ?> <span class="text-danger">*</span> </label>
                        <select wire:model="brand_id" id="brand_id" class="custom-select" required="">
                            <option value=""><?php echo app('translator')->get('inventory::labels.lbl_select'); ?></option>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="unit_measure_id"><?php echo app('translator')->get('inventory::labels.lbl_unit_measure'); ?> <span class="text-danger">*</span></label>
                        <select wire:model="unit_measure_id" id="unit_measure_id" class="custom-select" required="">
                            <option value=""><?php echo app('translator')->get('inventory::labels.lbl_select'); ?></option>
                            <?php $__currentLoopData = $unit_measures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['unit_measure_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3" wire:ignore>
                        <label class="form-label"><?php echo app('translator')->get('inventory::labels.lbl_is_a_part'); ?> <span class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="part" type="checkbox" class="custom-control-input" id="part" checked="">
                            <label class="custom-control-label" for="part"><?php echo app('translator')->get('inventory::labels.lbl_yes'); ?></label>
                        </div>
                        <?php $__errorArgs = ['part'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="description"><?php echo app('translator')->get('inventory::labels.description'); ?></label>
                        <input wire:model="description" type="text" class="form-control" id="description" required="">
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-2 mb-3" wire:ignore>
                        <label class="form-label" for="number_parts"><?php echo app('translator')->get('inventory::labels.number_parts'); ?> <span class="text-danger">*</span> </label>
                        <input wire:model="number_parts" type="number" class="form-control" id="number_parts" required="">
                        <?php $__errorArgs = ['number_parts'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="image"><?php echo app('translator')->get('inventory::labels.lbl_image'); ?> <span class="text-danger">*</span> </label>
                        <div class="custom-file" wire:ignore>
                            <input wire:model="image" type="file" class="custom-file-input" id="image" >
                            <label class="custom-file-label" for="customFile"><?php echo app('translator')->get('inventory::labels.lbl_choose_file'); ?></label>
                        </div>
                        <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label"><?php echo app('translator')->get('inventory::labels.status'); ?> <span class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="status" type="checkbox" class="custom-control-input" id="status" checked="">
                            <label class="custom-control-label" for="status"><?php echo app('translator')->get('inventory::labels.active'); ?></label>
                        </div>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3" wire:ignore>
                        <label class="form-label" for="weight"><?php echo app('translator')->get('inventory::labels.weight'); ?> (<?php echo app('translator')->get('inventory::labels.lbl_kg'); ?>) <span class="text-danger">*</span> </label>
                        <input wire:model="weight" type="number" class="form-control" id="weight" required="">
                        <?php $__errorArgs = ['weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="width"><?php echo app('translator')->get('inventory::labels.width'); ?> (<?php echo app('translator')->get('inventory::labels.lbl_meters'); ?>) <span class="text-danger">*</span> </label>
                        <input wire:model="width" type="number" class="form-control" id="width" required="">
                        <?php $__errorArgs = ['width'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="high"><?php echo app('translator')->get('inventory::labels.high'); ?> (<?php echo app('translator')->get('inventory::labels.lbl_meters'); ?>)<span class="text-danger">*</span> </label>
                        <input wire:model="high" type="number" class="form-control" id="high" required="">
                        <?php $__errorArgs = ['high'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="long"><?php echo app('translator')->get('inventory::labels.long'); ?> (<?php echo app('translator')->get('inventory::labels.lbl_meters'); ?>)<span class="text-danger">*</span> </label>
                        <input wire:model="long" type="number" class="form-control" id="long" required="">
                        <?php $__errorArgs = ['long'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <?php if(!$part): ?>
                <br>
                <div id="xyzDivPartesItems">
                    <h2 class="fw-700 m-0"><i class="subheader-icon fal fa-wrench"></i> <?php echo app('translator')->get('inventory::labels.lbl_add_parts'); ?>:</h2>
                    <br>
                    <div class="form-row">
                        <div class="col-md-4 mb-3" wire:ignore>
                            <label class="form-label" for="part_text"><?php echo app('translator')->get('inventory::labels.lbl_part'); ?> <span class="text-danger">*</span> </label>
                            <input wire:model="part_text"  id="part_text" required="" class="form-control basicAutoComplete" type="text" placeholder="Ingrese la parte a buscar y luego seleccione." data-url="<?php echo e(route('inventory_item_search')); ?>" autocomplete="off" />
                            <input wire:model="part_id" id="part_id" type="hidden" placeholder="" autocomplete="off" />
                            <input wire:model="part_weight" id="part_weight" type="hidden" placeholder="" autocomplete="off" />
                            <?php $__errorArgs = ['part_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php $__errorArgs = ['part_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label" for="amount"><?php echo app('translator')->get('inventory::labels.lbl_amount'); ?> <span class="text-danger">*</span> </label>
                            <input wire:model="amount" wire:ignore type="number" class="form-control" id="amount" min="1" required="">
                            <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="observations"><?php echo app('translator')->get('inventory::labels.lbl_observations'); ?> </label>
                            <input wire:model="observations" type="text" class="form-control" id="observations">
                            <?php $__errorArgs = ['observations'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-2 mb-3" style="margin-top: 23px;" wire:ignore>
                            <a wire:click="savePart" wire:loading.attr="disabled" class="btn btn-primary ml-auto waves-effect waves-themed" style="color: white;"><i class="fal fa-plus"></i> <?php echo app('translator')->get('inventory::labels.lbl_add'); ?></a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?php echo e(__('labels.actions')); ?></th>
                                            <th class=""><?php echo e(__('labels.name')); ?></th>
                                            <th class="text-center"><?php echo e(__('labels.quantity')); ?></th>
                                            <th class="text-center"><?php echo e(__('inventory::labels.lbl_observations')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $parts_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center align-middle">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fal fa-cogs"></i>
                                                    </button>
                                                    <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_parte_editar')): ?>
                                                            <a href="<?php echo e(route('inventory_item_edit', $item->item_id)); ?>" class="dropdown-item">
                                                                <i class="fal fa-pencil-alt mr-1"></i> <?php echo app('translator')->get('inventory::labels.lbl_edit'); ?>
                                                            </a>
                                                        <?php endif; ?>
                                                        <div class="dropdown-divider"></div>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_items_parte_eliminar')): ?>
                                                            <button onclick="confirmDeletePart(<?php echo e($item->id); ?>)" type="button" class="dropdown-item text-danger">
                                                                <i class="fal fa-trash-alt mr-1"></i> <?php echo app('translator')->get('inventory::labels.lbl_delete'); ?>
                                                            </button>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><?php echo e($item->name); ?></td>
                                            <td class="text-right align-middle"><?php echo e($item->quantity); ?></td>
                                            <td class="align-middle"><?php echo e($item->observations); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="<?php echo e(route('inventory_item')); ?>" type="button" class="btn btn-secondary waves-effect waves-themed"><?php echo app('translator')->get('inventory::labels.lbl_list'); ?></a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed"><?php echo app('translator')->get('inventory::labels.btn_save'); ?></button>
        </div>
    </div>
    <script type="text/javascript">
        function confirmDeletePart(id){
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
                        window.livewire.find('<?php echo e($_instance->id); ?>').deletePartItem(id);
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }

        document.addEventListener('set-item-save-not', event => {
            let part_count = event.detail.part_count;
            if(part_count > 0){
                $('#part').prop('disabled', true);
            }else{
                $('#part').prop('disabled', false);
            }
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.lbl_warning')); ?>!</span>",
                message: "<span>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('set-item-add-not', event => {
            let part_count = event.detail.part_count;
            if(part_count > 0){
                $('#part').prop('disabled', true);
            }else{
                $('#part').prop('disabled', false);
            }
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.lbl_warning')); ?>!</span>",
                message: "<span>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('set-item-part-delete', event => {
            let res = event.detail.res;
            let part_count = event.detail.part_count;
            let id_item = event.detail.id_item;
            if(part_count > 0){
                $('#part').prop('disabled', true);
            }else{
                $('#part').prop('disabled', false);
                if(id_item != 0){
                    $('#part').prop('disabled', true);
                }
            }
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

        document.addEventListener('inv-item-edit', event => {
            let part_count = event.detail.part_count;
            let id_item = event.detail.id_item;
            if(part_count > 0){
                $('#part').prop('disabled', true);
            }else{
                $('#part').prop('disabled', false);
                if(id_item != 0){
                    $('#part').prop('disabled', true);
                }
            }
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.success')); ?>!</span>",
                message: "<span><strong><?php echo e(__('inventory::labels.excellent')); ?>... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('livewire:load', function () {
            if(<?php echo e($parts_item_count); ?> > 0){
                $('#part').prop('disabled', true);
            }else{
                $('#part').prop('disabled', false);
                if(<?php echo e($id_item); ?> != 0){
                    $('#part').prop('disabled', true);
                }else{
                    $('#part').prop('disabled', false);
                }
            }

            if(<?php echo e($part); ?>){
                $("#number_parts").prop('disabled', true);
                $("#weight").prop('disabled', false);
            }else{
                $("#number_parts").prop('disabled', false);
                $("#weight").prop('disabled', true);
            }

            //Autocomplete
            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('part_id',item.value);
                window.livewire.find('<?php echo e($_instance->id); ?>').set('part_text',item.text);
                window.livewire.find('<?php echo e($_instance->id); ?>').set('part_weight',item.weight);
            });

            $('#part').click(function (){
                if ($(this).is(':checked')) {
                    $("#number_parts").prop('disabled', true);
                    $("#weight").prop('disabled', false);
                } else {
                    $("#number_parts").prop('disabled', false);
                    $("#weight").prop('disabled', true);
                }
            });
            $(":input").inputmask();
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/item/item-edit.blade.php ENDPATH**/ ?>