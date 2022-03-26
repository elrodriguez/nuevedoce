<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success waves-effect waves-themed" data-toggle="modal" data-target="#cashModalForm" wire:click="newCash">
        <i class="fal fa-lock-open-alt mr-1"></i> Aperturar Caja chica
    </button>

    <!-- Modal -->
    <div class="modal fade" id="cashModalForm" tabindex="-1" aria-labelledby="cashModalFormLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cashModalFormLabel"><?php echo e($title); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <?php if(auth()->check() && auth()->user()->hasRole('TI|Administrator')): ?>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><?php echo e(__('labels.users')); ?></label>
                            <select class="custom-select form-control" wire:model.defer="user_id">
                                <option value=""><?php echo e(__('labels.to_select')); ?></option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['user_id'];
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
                        <?php endif; ?>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Saldo inicial <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-right" wire:model.defer="initial">
                            <?php $__errorArgs = ['initial'];
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
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Referencia </label>
                            <input type="text" class="form-control" wire:model.defer="reference">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('labels.close')); ?></button>
                    <?php if($cash_id): ?>
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click="update"><?php echo e(__('labels.to_update')); ?></button>
                    <?php else: ?>
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click="store"><?php echo e(__('labels.save')); ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script defer>
        document.addEventListener('response_store_cash_event', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>"+event.detail.title+"!</span>",
                message: "<span><strong><?php echo e(__('lend::labels.lbl_excellent')); ?>... </strong>"+event.detail.message+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/cash/cash-modal-form.blade.php ENDPATH**/ ?>