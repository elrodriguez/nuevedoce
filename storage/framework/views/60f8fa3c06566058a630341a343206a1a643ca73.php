<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation <?php echo e($errors->any() ? 'was-validated' : ''); ?>" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="description"><?php echo app('translator')->get('inventory::labels.description'); ?> <span
                                class="text-danger">*</span> </label>
                        <input wire:model.defer="description" type="text" class="form-control" id="description">
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
                        <label class="form-label"><?php echo app('translator')->get('inventory::labels.status'); ?> <span
                                class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model.defer="status" type="checkbox" class="custom-control-input" id="status">
                            <label class="custom-control-label" for="status">Activo</label>
                        </div>
                        <?php $__errorArgs = ['status'];
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
            <a href="<?php echo e(route('restaurant_brands_list')); ?>" type="button"
                class="btn btn-secondary waves-effect waves-themed"><?php echo e(__('labels.list')); ?></a>
            <button wire:target="update" wire:click="update" wire:loading.attr="disabled" type="button"
                class="btn btn-info ml-auto waves-effect waves-themed"><?php echo e(__('labels.to_update')); ?></button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-brand-save', event => {
            initApp.playSound('<?php echo e(url('themes/smart-admin/media/sound')); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='<?php echo e(env('BOOTBOX_SUCCESS_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>" + event.detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({
                'background-color': "<?php echo e(env('BOOTBOX_SUCCESS_COLOR')); ?>"
            });
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Restaurant\Resources/views/livewire/brands/brands-edit.blade.php ENDPATH**/ ?>