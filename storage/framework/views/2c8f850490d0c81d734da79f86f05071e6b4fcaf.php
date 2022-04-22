<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="movementsTransferModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('inventory::labels.lbl_transfer_between_warehouses')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="location_id"><?php echo e(__('labels.origin_warehouse')); ?></label>
                            <input disabled value="<?php echo e($location_name); ?>" class="form-control" type="text">
                            <?php $__errorArgs = ['location_id'];
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
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="location_new_id"><?php echo e(__('labels.destination_warehouse')); ?></label>
                            <select wire:model.defer="location_new_id" class="custom-select" id="location_new_id">
                                <option value=""><?php echo e(__('labels.to_select')); ?></option>
                                <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['location_new_id'];
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
                    <div class="row">
                        <div class="col-12 col-md-9 mb-3">
                            <label class="form-label" for="product_id"><?php echo e(__('labels.product')); ?></label>
                            <input disabled value="<?php echo e($item_name); ?>" class="form-control" type="text">
                            <?php $__errorArgs = ['product_id'];
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
                        <div class="col-12 col-md-3 mb-3">
                            <label class="form-label" for="actual_quantity"><?php echo e(__('labels.actual_quantity')); ?></label>
                            <input disabled value="<?php echo e($stock); ?>" class="form-control text-right" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-9 mb-3">
                            <label class="form-label" for="reason_transfer"><?php echo e(__('labels.reason_for_transfer')); ?></label>
                            <textarea wire:model.defer="reason_transfer" class="form-control" rows="1"></textarea>
                            <?php $__errorArgs = ['reason_transfer'];
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
                        <div class="col-12 col-md-3 mb-3">
                            <label class="form-label" for="quantity_move"><?php echo e(__('labels.amount_to_transfer')); ?></label>
                            <input wire:model.defer="quantity_move" class="form-control text-right" type="text">
                            <?php $__errorArgs = ['quantity_move'];
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('labels.close')); ?></button>
                    <button wire:target="saveMovementTransfer" wire:click="saveMovementTransfer" wire:loading.attr="disabled" type="button" class="btn btn-primary"><?php echo e(__('labels.save')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-movements-transfer-modal', event => {
            $('#movementsTransferModal').modal('show');
        });
        document.addEventListener('inv-transfer-save', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='<?php echo e(env('BOOTBOX_SUCCESS_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': '<?php echo e(env("BOOTBOX_SUCCESS_COLOR")); ?>'});
            $('#product_id').autoComplete('clear');
        });
        document.addEventListener('inv-movements-transfer-alert-error', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='<?php echo e(env('BOOTBOX_ERROR_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.error')); ?>!</span>",
                message: "<span><strong><?php echo e(__('inventory::labels.went_wrong')); ?>... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': '<?php echo e(env("BOOTBOX_ERROR_COLOR")); ?>'});
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/movements/movements-transfer-modal.blade.php ENDPATH**/ ?>