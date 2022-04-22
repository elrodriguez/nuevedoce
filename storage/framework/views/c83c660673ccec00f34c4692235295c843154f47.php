<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="movementsIncomeExitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e($title); ?> de producto al almacén</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-12 mb-3">
                            <label class="form-label" for="product_id"><?php echo e(__('labels.product')); ?></label>
                            <div wire:ignore>
                                <input placeholder="<?php echo app('translator')->get('labels.search_product'); ?>" data-url="<?php echo e(route('inventory_search_products')); ?>" autocomplete="off" type="text" class="form-control" id="product_id">
                            </div>
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
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 mb-3">
                            <label class="form-label" for="warehouse_id"><?php echo e(__('labels.warehouse')); ?></label>
                            <select wire:model.defer="warehouse_id" class="custom-select" id="warehouse_id">
                                <option value=""><?php echo e(__('labels.to_select')); ?></option>
                                <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['warehouse_id'];
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
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="quantity"><?php echo e(__('labels.quantity')); ?></label>
                                <input wire:model.defer="quantity" type="text" class="form-control" id="quantity">
                                <?php $__errorArgs = ['quantity'];
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
                    <div class="row">
                        <div class="col-12 col-md-8 mb-3">
                            <label class="form-label" for="reason_id"><?php echo e(__('labels.reason_for_transfer')); ?></label>
                            <select wire:model.defer="reason_id" class="custom-select" id="reason_id">
                                <option value=""><?php echo e(__('labels.to_select')); ?></option>
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($transaction->id); ?>"><?php echo e($transaction->description); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['reason_id'];
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
                    <button wire:target="saveMovement" wire:click="saveMovement" wire:loading.attr="disabled" type="button" class="btn btn-primary"><?php echo e(__('labels.save')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-movements-income-exit-modal', event => {
            $('#movementsIncomeExitModal').modal('show');
        });
        document.addEventListener('livewire:load', function () {
            $('#product_id').autoComplete().on('autocomplete.select', function (evt, item) {
                selectproductM(item.value);
            });
        });   
        document.addEventListener('inv-transaction-save', event => {
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
        document.addEventListener('output-transaction-error', event => {
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
        function selectproductM(id){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('product_id',id);
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/movements/movements-income-exit-modal.blade.php ENDPATH**/ ?>