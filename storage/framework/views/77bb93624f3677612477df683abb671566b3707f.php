<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            Rol: <?php echo e($role_name); ?>

        </div>
        <div class="card-body">
            <div class="card-columns">
                <?php if($modules_permissions): ?>
                <?php
                    $label = '';
                ?>
                    <?php $__currentLoopData = $modules_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($label != $module['label']): ?>
                            <div class="card id="card-<?php echo e($module['module_id']); ?>">
                                <div class="card-header bg-warning-100 d-flex pr-2 align-items-center flex-wrap">
                                    <div class="d-flex">
                                        <div class="custom-control custom-switch ">
                                            <input wire:change="selectAll(<?php echo e($module['module_id']); ?>)" wire:model.defer="input_all.<?php echo e($module['module_id']); ?>" value="<?php echo e($module['module_id']); ?>" id="demo-switch-<?php echo e($module['module_id']); ?>" type="checkbox" class="custom-control-input">
                                            <label class="custom-control-label fw-500" for="demo-switch-<?php echo e($module['module_id']); ?>"></label>
                                        </div>
                                        <button wire:click="savePermission(<?php echo e($module['module_id']); ?>)" class="btn btn-xs btn-info ml-auto waves-effect waves-themed">
                                            <?php echo e(__('setting::labels.save')); ?>

                                        </button>
                                    </div>
                                    <div class="card-title ml-auto"><?php echo e($module['label']); ?></div>
                                </div>
                                <div class="card-body">
                                    <?php $__currentLoopData = $modules_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($module['label'] == $permission['label']): ?>
                                            <div class="mb-1">
                                                <div class="custom-control d-flex custom-switch">
                                                    <input wire:model.defer="permissions.<?php echo e($module['module_id']); ?>.<?php echo e($permission['name']); ?>" value="<?php echo e($permission['id']); ?>"  id="eventlog-switch-<?php echo e($permission['id']); ?>" type="checkbox" class="custom-control-input">
                                                    <label class="custom-control-label fw-500" for="eventlog-switch-<?php echo e($permission['id']); ?>"><?php echo e($permission['name']); ?></label>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php
                            $label = $module['label'];
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('set-role-save-add-permission', event => {
            initApp.playSound('themes/smart-admin/media/sound', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-success mr-2'></i> <span class='text-success fw-500'><?php echo e(__('setting::labels.success')); ?>!</span>",
                message: "<span><strong><?php echo e(__('setting::labels.excellent')); ?>... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Setting\Resources/views/livewire/roles/roles-permissions.blade.php ENDPATH**/ ?>