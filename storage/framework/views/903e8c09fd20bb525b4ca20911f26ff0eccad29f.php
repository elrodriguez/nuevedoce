<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation <?php echo e($errors->any() ? 'was-validated' : ''); ?>" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="floor">
                            <?php echo app('translator')->get('restaurant::labels.floor'); ?>
                            <span class="text-danger">*</span>
                            <span class="ml-1">
                                <a href="javascript:void(0)" wire:click="$emit('openModalFloorForm')">[
                                    +Nuevo ]</a>
                            </span>
                        </label>
                        <select wire:model.defer="floor_id" class="custom-select">
                            <option value=""><?php echo e(__('labels.to_select')); ?></option>
                            <?php $__currentLoopData = $floors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($floor->id); ?>"><?php echo e($floor->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['floor_id'];
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
                        <label class="form-label" for="name"><?php echo app('translator')->get('labels.name'); ?> <span
                                class="text-danger">*</span> </label>
                        <input wire:model.defer="name" type="text" class="form-control">
                        <?php $__errorArgs = ['name'];
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
                        <label class="form-label" for="description">
                            <?php echo app('translator')->get('labels.description'); ?>
                            <span class="text-danger">*</span>
                        </label>
                        <input wire:model.defer="description" type="text" class="form-control">
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
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="chairs">
                            <?php echo app('translator')->get('restaurant::labels.chairs'); ?>
                            <span class="text-danger">*</span>
                        </label>
                        <input wire:model.defer="chairs" class="form-control" id="chairs" type="number" min="1"
                            max="20" value="2">
                        <?php $__errorArgs = ['chairs'];
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
                        <label class="form-label">
                            <?php echo app('translator')->get('restaurant::labels.occupied'); ?>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model.defer="occupied" type="checkbox" class="custom-control-input" id="status">
                            <label class="custom-control-label" for="occupied"><?php echo e(__('labels.yes')); ?></label>
                        </div>
                        <?php $__errorArgs = ['occupied'];
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
                        <label class="form-label">
                            <?php echo app('translator')->get('labels.state'); ?>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model.defer="state" type="checkbox" class="custom-control-input" id="status">
                            <label class="custom-control-label" for="status">Activo</label>
                        </div>
                        <?php $__errorArgs = ['state'];
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
            <a href="<?php echo e(route('restaurant_tables_list')); ?>" type="button"
                class="btn btn-secondary waves-effect waves-themed"><?php echo e(__('labels.list')); ?></a>
            <button wire:target="save" wire:click="save" wire:loading.attr="disabled" type="button"
                class="btn btn-info ml-auto waves-effect waves-themed"><?php echo e(__('labels.save')); ?></button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-tables-save', event => {
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
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Restaurant\Resources/views/livewire/tables/tables-create.blade.php ENDPATH**/ ?>