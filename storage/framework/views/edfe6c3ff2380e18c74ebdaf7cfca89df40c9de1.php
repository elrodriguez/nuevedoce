<div>
    <div wire:ignore.self class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="app-list w-auto h-auto p-0 text-left">
                        <?php if(count($shortcuts) > 0): ?>
                            <?php $__currentLoopData = $shortcuts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shortcut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($shortcut->permission)): ?>
                                    <li>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuraciones_acceso_directo_eliminar')): ?>
                                        <button onclick="confirmDeleteShortCut(<?php echo e($shortcut->id); ?>)" class="btn btn-link m-0 p-0 text-center text-light" ><?php echo e(__('labels.delete')); ?></button>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route($shortcut->route_name)); ?>" class="app-list-item text-white border-0 m-0">
                                            <div class="icon-stack">
                                                <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                                <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                <i class="<?php echo e($shortcut->icon); ?> icon-stack-1x opacity-100 color-white"></i>
                                            </div>
                                            <span class="app-list-name">
                                                <?php echo e($shortcut->name); ?>

                                            </span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuraciones_acceso_directo')): ?>
                        <li>
                            <a wire:click="$set('add_show', true)" href="javascript:void(0)" class="app-list-item text-white border-0 m-0">
                                <div class="icon-stack">
                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                    <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                                </div>
                                <span class="app-list-name">
                                    <?php echo e(__('setting::labels.add_more')); ?>

                                </span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <?php if($add_show): ?>
                    <div class="container">
                        <h4 class="text-light">Nuevo Acceso directo</h4>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="icon"><?php echo e(__('setting::labels.icon')); ?> <span class="text-light">*</span> </label>
                                <input wire:model.defer="icon" type="text" class="form-control" id="icon">
                                <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback-2 text-light"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="name"><?php echo e(__('labels.name')); ?> <span class="text-light">*</span> </label>
                                <input wire:model.defer="name" type="text" class="form-control" id="name">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback-2 text-light"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="route_name"><?php echo e(__('setting::labels.route')); ?><span class="text-light">*</span> </label>
                                <input wire:model.defer="route_name" type="text" class="form-control" id="route_name">
                                <?php $__errorArgs = ['route_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback-2 text-light"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4 mb-3" style="display: none">
                                <label class="form-label text-light" for="role_name"><?php echo e(__('setting::labels.role')); ?> <span class="text-light">*</span> </label>
                                <input wire:model.defer="role_name" type="text" class="form-control" id="role_name" disabled>
                                <?php $__errorArgs = ['role_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback-2 text-light"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="module_id"><?php echo e(__('setting::labels.modules')); ?> <span class="text-light">*</span> </label>
                                <select wire:model.defer="module_id" wire:change="getPermissions" class="custom-select" id="module_id">
                                    <option value=""><?php echo e(__('labels.to_select')); ?></option>
                                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($module->id); ?>"><?php echo e($module->label); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['module_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback-2 text-light"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="permission_id"><?php echo e(__('setting::labels.permission')); ?> <span class="text-light">*</span> </label>
                                <select wire:model.defer="permission_id" class="custom-select" id="permission_id">
                                    <option value=""><?php echo e(__('labels.to_select')); ?></option>
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->name); ?>"><?php echo e($row->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['permission_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback-2 text-light"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if($add_show): ?>
                <div class="modal-footer">
                    <button wire:click="$set('add_show', false)" type="button" class="btn btn-secondary"><?php echo e(__('labels.close')); ?></button>
                    <button wire:click="saveShortCuts" type="button" class="btn btn-primary"><?php echo e(__('labels.save')); ?></button>
                  </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-short-cut-save', event => {
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
        function confirmDeleteShortCut(id){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> ¿Desea eliminar estos datos?",
                message: "<span><strong>Advertencia: </strong> ¡Esta acción no se puede deshacer!</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                {
                    confirm:
                    {
                        label: 'Si',
                        className: 'btn-danger shadow-0'
                    },
                    cancel:
                    {
                        label: 'No',
                        className: 'btn-default'
                    }
                },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        window.livewire.find('<?php echo e($_instance->id); ?>').deleteshortcut(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }

        document.addEventListener('set-short-cut-delete', event => {
            let res = event.detail.res;

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
                    title: "<i class='fal fa-times-hexagon text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('setting::labels.error')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('setting::labels.went_wrong')); ?>... </strong><?php echo e(__('setting::labels.msg_not_peptra')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(214, 36, 16, 0.5)'});
            }
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\resources\views/livewire/shortcuts.blade.php ENDPATH**/ ?>