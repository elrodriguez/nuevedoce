<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation <?php echo e($errors->any()?'was-validated':''); ?>" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="bank_id"><?php echo app('translator')->get('labels.bank'); ?> <span class="text-danger">*</span> </label>
                        <select wire:model.defer="bank_id" name="bank_id" id="bank_id" class="custom-select">
                            <option value=""><?php echo e(__('labels.to_select')); ?></option>
                            <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($bank->id); ?>"><?php echo e($bank->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['bank_id'];
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
                        <label class="form-label" for="coin_id"><?php echo app('translator')->get('labels.coin'); ?> <span class="text-danger">*</span> </label>
                        <select wire:model.defer="coin_id" name="coin_id" id="coin_id" class="custom-select">
                            <option value=""><?php echo e(__('labels.to_select')); ?></option>
                            <?php $__currentLoopData = $currency_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($currency_type->id); ?>"><?php echo e($currency_type->id.' - '.$currency_type->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['coin_id'];
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
                        <label class="form-label" for="description"><?php echo app('translator')->get('inventory::labels.description'); ?> <span class="text-danger">*</span> </label>
                        <input wire:model="description" type="text" class="form-control" id="description" required="">
                        <?php $__errorArgs = ['description'];
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
                        <label class="form-label" for="number"><?php echo app('translator')->get('labels.number'); ?> <span class="text-danger">*</span> </label>
                        <input wire:model="number" type="text" class="form-control" id="number" required="">
                        <?php $__errorArgs = ['number'];
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
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="<?php echo e(route('setting_banks_accounts')); ?>" type="button" class="btn btn-secondary waves-effect waves-themed"><?php echo e(__('labels.list')); ?></a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed"><?php echo e(__('labels.save')); ?></button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-bank-account-save', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Setting\Resources/views/livewire/banks/banks-accounts-create.blade.php ENDPATH**/ ?>