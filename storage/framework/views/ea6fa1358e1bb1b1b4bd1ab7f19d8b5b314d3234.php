<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalSupplierCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSupplierCreateLabel">Nuevo Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6 mb-3"f>
                            <label class="form-label" for="identity_document_type_id">Tipo Doc. Identidad <span class="text-danger">*</span> </label>
                            <select class="custom-select form-control" wire:model="identity_document_type_id">
                                <option value=""><?php echo e(__('labels.to_select')); ?></option>
                                <?php $__currentLoopData = $identity_document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $identity_document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($identity_document_type->id); ?>"><?php echo e($identity_document_type->description); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['identity_document_type_id'];
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
                            <label class="form-label" for="number_id"><?php echo e(__('labels.number')); ?> <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="number_id" wire:model.defer="number_id">
                            <?php $__errorArgs = ['number_id'];
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
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="name"><?php echo e(__('labels.name')); ?> <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="name" wire:model.defer="name">
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
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="last_paternal"><?php echo e(__('labels.last_paternal')); ?> <span class="text-danger">*</span> </label>
                            <input <?php echo e($identity_document_type_id == '6' ? 'disabled': ''); ?> type="text" class="form-control" name="last_paternal" wire:model.defer="last_paternal">
                            <?php $__errorArgs = ['last_paternal'];
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
                            <label class="form-label" for="last_maternal"><?php echo e(__('labels.last_maternal')); ?> <span class="text-danger">*</span> </label>
                            <input <?php echo e($identity_document_type_id == '6' ? 'disabled': ''); ?> type="text" class="form-control" name="last_maternal" wire:model.defer="last_maternal">
                            <?php $__errorArgs = ['last_maternal'];
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
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="trade_name"><?php echo e(__('labels.trade_name')); ?></label>
                            <input type="text" class="form-control" name="trade_name" wire:model.defer="trade_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="department_id"><?php echo app('translator')->get('setting::labels.department'); ?> <span class="text-danger">*</span> </label>
                            <select wire:change="getProvinves" wire:model="department_id" id="department_id" class="custom-select" required="">
                                <option value="">Seleccionar</option>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($department->id); ?>"><?php echo e($department->description); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['department_id'];
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
                            <label class="form-label" for="province_id"><?php echo app('translator')->get('setting::labels.province'); ?> <span class="text-danger">*</span> </label>
                            <select wire:change="getPDistricts" wire:model="province_id" id="province_id" class="custom-select" required="">
                                <option value="">Seleccionar</option>
                                <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($province->id); ?>"><?php echo e($province->description); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['province_id'];
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
                            <label class="form-label" for="district_id"><?php echo app('translator')->get('setting::labels.district'); ?> <span class="text-danger">*</span> </label>
                            <select wire:model="district_id" id="district_id" class="custom-select" required="">
                                <option value="">Seleccionar</option>
                                <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($district->id); ?>"><?php echo e($district->description); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['district_id'];
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
                            <label class="form-label" for="sex"><?php echo app('translator')->get('labels.sex'); ?></label>
                            <select class="custom-select form-control" wire:model.defer="sex" id="sex" name="sex" required="">
                                <option><?php echo app('translator')->get('labels.to_select'); ?></option>
                                <option value="m">Masculino</option>
                                <option value="f">Femenino</option>
                            </select>
                            <?php $__errorArgs = ['sex'];
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
                    <button wire:click="storeSupplier" type="button" class="btn btn-primary"><?php echo e(__('labels.save')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-modal-expense-supplier-create', event => {
            $('#modalSupplierCreate').modal('show');
        });
        window.addEventListener('response_success_supplier_store', event => {
            alertSupplier(event.detail.message);
            $('.companiesAutoComplete').autoComplete('set', { value: event.detail.idperson, text: event.detail.nameperson });
            $('#modalSupplierCreate').modal('hide');
        });
        function alertSupplier(msg){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/expenses/expenses-supplier-modal.blade.php ENDPATH**/ ?>