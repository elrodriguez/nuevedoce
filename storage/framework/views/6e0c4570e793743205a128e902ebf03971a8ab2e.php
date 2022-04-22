<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="movementsRemoveModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?php echo e(__('inventory::labels.lbl_remove_product_from_warehouse')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                            <label class="form-label" for="current_amount"><?php echo e(__('labels.actual_quantity')); ?></label>
                            <input disabled value="<?php echo e($current_amount); ?>" class="form-control text-right" type="text">
                            <?php $__errorArgs = ['current_amount'];
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
                        <div class="col-12 col-md-3 mb-3">
                            <label class="form-label" for="quantity_remove"><?php echo e(__('labels.amount_to_withdraw')); ?></label>
                            <input wire:model.defer="quantity_remove" class="form-control text-right" type="text">
                            <?php $__errorArgs = ['quantity_remove'];
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
                    <button wire:target="saveMovementRemove" wire:click="saveMovementRemove" wire:loading.attr="disabled" type="button" class="btn btn-primary"><?php echo e(__('labels.save')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-movements-remove-modal', event => {
            $('#movementsRemoveModal').modal('show');
        });
        document.addEventListener('inv-remove-save', event => {
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
        document.addEventListener('inv-movements-remove-alert-error', event => {
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
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/movements/movements-remove-modal.blade.php ENDPATH**/ ?>