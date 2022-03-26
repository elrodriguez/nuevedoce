<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="name"><?php echo app('translator')->get('setting::labels.name_short'); ?> <span class="text-danger">*</span> </label>
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
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="number">Ruc <span class="text-danger">*</span> </label>
                        <input wire:model="number" type="text" class="form-control" id="number" required="">
                        <?php $__errorArgs = ['number'];
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
                        <label class="form-label" for="email">Email <span class="text-danger">*</span> </label>
                        <input wire:model="email" type="text" class="form-control" id="email" required="">
                        <?php $__errorArgs = ['email'];
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
                        <label class="form-label" for="tradename"><?php echo app('translator')->get('setting::labels.tradename'); ?> <span class="text-danger">*</span> </label>
                        <input wire:model="tradename" type="text" class="form-control" id="tradename" required="">
                        <?php $__errorArgs = ['tradename'];
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
                        <label class="form-label" for="phone">Teléfono fijo <span class="text-danger">*</span> </label>
                        <input wire:model="phone" type="text" class="form-control" id="phone" required="">
                        <?php $__errorArgs = ['phone'];
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
                        <label class="form-label" for="phone_mobile">Teléfono móvil <span class="text-danger">*</span> </label>
                        <input wire:model="phone_mobile" type="text" class="form-control" id="phone_mobile" required="">
                        <?php $__errorArgs = ['phone_mobile'];
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
                        <label class="form-label" for="representative_name">Nombre del representante <span class="text-danger">*</span> </label>
                        <input wire:model="representative_name" type="text" class="form-control" id="representative_name" required="">
                        <?php $__errorArgs = ['representative_name'];
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
                        <label class="form-label" for="representative_number">Número de identificación <span class="text-danger">*</span> </label>
                        <input wire:model="representative_number" type="text" class="form-control" id="representative_number" required="">
                        <?php $__errorArgs = ['representative_number'];
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
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="logo">Logo Sistema</label>
                        <input wire:model="logo" type="file" id="logo">
                        <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php if($logo_view): ?>
                            <img class="img-thumbnail mt-5" width="100%" src="<?php echo e(url('storage/'.$this->logo_view)); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="logo_store">Logo Documentos </label>
                        <input wire:model="logo_store" type="file" id="logo_store">
                        <?php $__errorArgs = ['logo_store'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php if($logo_store_view): ?>
                            <img class="img-thumbnail mt-5" width="100%" src="<?php echo e(url('storage/'.$this->logo_store_view)); ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="logo">Esta es la empresa principal</label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="main" type="checkbox" class="custom-control-input" id="maincompany">
                            <label class="custom-control-label" for="maincompany">si</label>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="<?php echo e(route('setting_company')); ?>" type="button" class="btn btn-secondary waves-effect waves-themed"><?php echo e(__('setting::buttons.list')); ?></a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed"><?php echo e(__('setting::buttons.save')); ?></button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-company-update', event => {
            initApp.playSound('themes/smart-admin/media/sound', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-success mr-2'></i> <span class='text-success fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        })
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Setting\Resources/views/livewire/company/company-edit.blade.php ENDPATH**/ ?>