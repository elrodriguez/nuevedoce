<div>
    <div class="modal" tabindex="-1" id="create-parameters-edit" wire:ignore.self >
        <form class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('labels.edit'); ?> <?php echo app('translator')->get('labels.parameter'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="example-select"><?php echo app('translator')->get('labels.type'); ?></label>
                                <select wire:model.defer="id_type" class="form-control" id="example-select" wire:change="changeType()">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item['id']); ?>"><?php echo e($item['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('id_type')): ?>
                                    <div class="invalid-feedback-2"><?php echo e($errors->first('id_type')); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="parameter"><?php echo app('translator')->get('labels.parameter'); ?></label>
                                <input type="text" wire:model.defer="id_parameter" class="form-control" id="parameter" disabled>
                            </div>
                            <?php if($errors->has('id_parameter')): ?>
                                <div class="invalid-feedback-2"><?php echo e($errors->first('id_parameter')); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label" for="value_default_1"><?php echo app('translator')->get('labels.value_default'); ?></label>
                        <?php if($id_type == 8): ?>
                            <textarea wire:model.defer="value_default" class="form-control" id="value_default_1" maxlength="255"></textarea>
                            <?php if($errors->has('value_default')): ?>
                                <div class="invalid-feedback-2"><?php echo e($errors->first('value_default')); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="text" wire:model.defer="value_default" class="form-control" id="value_default_1">
                            <?php if($errors->has('value_default')): ?>
                                <div class="invalid-feedback-2"><?php echo e($errors->first('value_default')); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="description"><?php echo app('translator')->get('labels.description'); ?></label>
                        <textarea type="text" wire:model.defer="description" class="form-control" id="description"></textarea>
                        <?php if($errors->has('description')): ?>
                            <div class="invalid-feedback-2"><?php echo e($errors->first('description')); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <?php if($display): ?>
                        <div class="form-group">
                            <label class="form-label" for="code_sql"><?php echo app('translator')->get('labels.value_array_sql'); ?></label>
                            <textarea type="text" wire:model.defer="code_sql" class="form-control mb-2" id="code_sql"></textarea>
                            <?php if($id_type == 2 || $id_type == 5 || $id_type == 6): ?>
                            Ejemplo: <code class="mb-2">1,text1|2,text2|3,text3</code>
                            <?php elseif($id_type == 3 || $id_type == 7): ?>
                            Ejemplo: <code>SELECT id,description FROM My_Table</code>
                            <?php elseif($id_type == 4): ?>
                            Ejemplo: <code class="mb-2">1,text1|2,text2</code>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('labels.cancel'); ?></button>
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click="update"><?php echo app('translator')->get('labels.to_update'); ?></button>
                </div>
            </div>
        </form>
    </div>
    <script defer>
        window.addEventListener('message-confir-modal-paramter-edit', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.message+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            $('#create-parameters').modal('hide');
        });
        window.addEventListener('open-modal-paramter-edit', event => {
            $('#create-parameters-edit').modal('show');
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Setting\Resources/views/livewire/parameters/parameters-edit.blade.php ENDPATH**/ ?>