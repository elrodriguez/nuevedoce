<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label class="form-label"><?php echo app('translator')->get('pharmacy::labels.diseases'); ?> <span class="text-danger">*</span> </label>
                    <input disabled class="form-control"  type="text" value="<?php echo e($disease_name); ?>" />
                </div>
                <div class="col-md-4">
                    <label class="form-label"><?php echo app('translator')->get('pharmacy::labels.symptom'); ?> <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <input id="symptom_id" data-url="<?php echo e(route('pharmacy_symptoms_search')); ?>" class="form-control"  type="text" placeholder="Buscar <?php echo e(__('pharmacy::labels.symptom')); ?>" autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-4">
                    <button wire:target="addSymptoms" wire:loading.attr="disabled" wire:click="addSymptoms" type="button" class="btn btn-primary">
                        <?php echo e(__('labels.add')); ?>

                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                </div>
                <div class="col-md-4 mb-3">
                    <?php $__errorArgs = ['symptom_id'];
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
                <div class="col-md-4 mb-3 ">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th class="text-center "><?php echo e(__('labels.actions')); ?></th>
                                <th><?php echo e(__('labels.description')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($symptoms)>0): ?>
                                <?php $__currentLoopData = $symptoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $symptom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($k + 1); ?></td>
                                        <td class="text-center">
                                            <button onclick="confirmDeleteSymptoms(<?php echo e($symptom->symptom_id); ?>)" type="button" class="btn btn-danger btn-sm btn-icon rounded-circle waves-effect waves-themed">
                                                <i class="fal fa-times"></i>
                                            </button>
                                        </td>
                                        <td><?php echo e($symptom->description); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" class="dataTables_empty text-center" valign="top"><?php echo e(__('labels.no_records_to_display')); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            $('#symptom_id').autoComplete().on('autocomplete.select', function (evt, item) {
                selectSymptomId(item.value);
            });
        });
        function selectSymptomId(id){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('symptom_id',id);
        }
        document.addEventListener('phar-diseases-symptoms-save', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='<?php echo e(env('BOOTBOX_SUCCESS_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': '<?php echo e(env("BOOTBOX_SUCCESS_COLOR")); ?>'});
            $('#symptom_id').autoComplete('clear');
        });

        function confirmDeleteSymptoms(id){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='<?php echo e(env('BOOTBOX_INFO_ICON')); ?> text-danger mr-2'></i> ¿Desea eliminar estos datos?",
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
                        //console.log(id)
                        window.livewire.find('<?php echo e($_instance->id); ?>').deleteSymptoms(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': '<?php echo e(env("BOOTBOX_INFO_COLOR")); ?>'});
        }

        document.addEventListener('phar-diseases-symptoms-delete', event => {
            let res = event.detail.res;

            if(res == 'success'){
                initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='<?php echo e(env('BOOTBOX_SUCCESS_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.success')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('inventory::labels.excellent')); ?>... </strong><?php echo e(__('inventory::labels.msg_delete')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': '<?php echo e(env("BOOTBOX_SUCCESS_COLOR")); ?>'});
            }else{
                initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='<?php echo e(env('BOOTBOX_ERROR_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.error')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('inventory::labels.went_wrong')); ?>... </strong><?php echo e(__('inventory::labels.msg_not_peptra')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': '<?php echo e(env("BOOTBOX_ERROR_COLOR")); ?>'});
            }
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Pharmacy\Resources/views/livewire/diseases/diseases-symptoms.blade.php ENDPATH**/ ?>