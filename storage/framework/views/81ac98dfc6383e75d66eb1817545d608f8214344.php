<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation <?php echo e($errors->any()?'was-validated':''); ?>" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="description"><?php echo app('translator')->get('labels.document_type'); ?> <span class="text-danger">*</span> </label>
                        <select wire:model.defer="voucher_type_id" class="custom-select">
                            <option value=""><?php echo e(__('labels.to_select')); ?></option>
                            <?php $__currentLoopData = $voucher_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($voucher_type->id); ?>"><?php echo e($voucher_type->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['voucher_type_id'];
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
                        <label class="form-label" for="number"><?php echo app('translator')->get('labels.number'); ?> <span class="text-danger">*</span> </label>
                        <input wire:model.defer="number" type="text" class="form-control" id="number" required="">
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
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="f_issuance"><?php echo app('translator')->get('labels.f_issuance'); ?> <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <input type="text" class="form-control " name="f_issuance" wire:model="f_issuance" onchange="this.dispatchEvent(new InputEvent('input'))" id="datepicker-1">
                            <div class="input-group-append">
                                <span class="input-group-text fs-xl">
                                    <i class="fal fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="reason_id"><?php echo app('translator')->get('labels.reason'); ?> <span class="text-danger">*</span> </label>
                        <select wire:model.defer="reason_id" class="custom-select">
                            <option value=""><?php echo e(__('labels.to_select')); ?></option>
                            <?php $__currentLoopData = $expense_reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense_reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($expense_reason->id); ?>"><?php echo e($expense_reason->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['reason_id'];
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
                    <div class="col-md-6 mb-3" wire:ignore>
                        <label class="form-label" for="supplier_id"><?php echo app('translator')->get('labels.supplier'); ?> <span class="text-danger">*</span> </label>
                        <span class="ml-1"><a wire:click="$emit('modalSupplierCreate')" href="javascript:void(0)">[ +Nuevo ]</a></span>
                        <div>
                            <input id="supplier_id" class="form-control companiesAutoComplete" type="text" placeholder="" data-url="<?php echo e(route('sales_expenses_supplier_search')); ?>" autocomplete="off" />
                        </div>
                        <?php $__errorArgs = ['supplier_id'];
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
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-themed" data-toggle="modal" data-target="#modalExpensesDetails">
                            <?php echo e(__('sales::labels.add_detail')); ?>

                        </button>
                    </div>
                </div>
                <?php if(count($box_items)>0): ?>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="table-responsive">
                            <table class="table m-0 table-bordered table-sm table-striped">
                                <thead class="bg-info-900">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th><?php echo e(__('labels.description')); ?></th>
                                        <th class="text-center"><?php echo e(__('labels.total')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $box_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $box_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="align-middle text-center" width="10%">
                                            <button class="btn btn-default btn-sm btn-icon rounded-circle waves-effect waves-themed" wire:click="removeItem(<?php echo e($key); ?>)" type="button">
                                                <i class="fal fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        <td class="align-middle"><?php echo e($box_item['description']); ?></td>
                                        <td class="align-middle text-right pr-3"><?php echo e(number_format($box_item['amount'], 2, '.', '')); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h3>Métodos de pago
                            <span class="ml-1"><a href="javascript:void(0)" wire:click="newPaymentMethodTypes">[ +<?php echo e(__('labels.add')); ?> ]</a></span>
                        </h3>
                        <?php $__currentLoopData = $payment_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-row">

                                <div class="col-md-1 mb-3 align-middle">
                                    <?php if($key > 0): ?>
                                    <a href="javascript:void(0);" class="btn btn-dark btn-sm btn-icon waves-effect waves-themed" wire:click="removePaymentMethodTypes('<?php echo e($key); ?>')">
                                        <i class="fal fa-times"></i>
                                    </a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="date_payment"><?php echo e(__('labels.date')); ?> <span class="text-danger">*</span> </label>
                                    <input wire:model="payment_method_types.<?php echo e($key); ?>.date_of_payment" class="form-control" type="date" />
                                </div>
                                <div class="col-md-3 mb-3" wire:ignore.self>
                                    <label class="form-label" for="validationCustom01">Método de pago <span class="text-danger">*</span> </label>
                                    <select class="custom-select form-control" wire:model.defer="payment_method_types.<?php echo e($key); ?>.method">
                                        <?php $__currentLoopData = $expense_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($expense_method_type->id); ?>"><?php echo e($expense_method_type->description); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3" wire:ignore.self>
                                    <label class="form-label" for="validationCustom01">Destino <span class="text-danger">*</span> </label>
                                    <select class="custom-select form-control" wire:model.defer="payment_method_types.<?php echo e($key); ?>.destination">
                                        <?php $__currentLoopData = $destination_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($destination_type['id']); ?>"><?php echo e($destination_type['description']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Referencia <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" wire:model.defer="payment_method_types.<?php echo e($key); ?>.reference">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Monto <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control text-right" wire:model.defer="payment_method_types.<?php echo e($key); ?>.amount">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="alert alert-info text-center"><?php echo e(__('labels.no_records_to_display')); ?></div>
                <?php endif; ?>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="<?php echo e(route('sales_expenses_list')); ?>" type="button" class="btn btn-secondary waves-effect waves-themed"><?php echo e(__('labels.list')); ?></a>
            <button type="button" class="btn btn-primary ml-auto waves-effect waves-themed" wire:loading.attr="disabled" wire:click="store">
                <span wire:loading wire:target="store" wire:loading.class="spinner-border spinner-border-sm" wire:loading.class.remove="fal fa-check" class="fal fa-check mr-2" role="status" aria-hidden="true"></span>
                <span><?php echo e(__('labels.save')); ?></span>
            </button>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalExpensesDetails" tabindex="-1" aria-labelledby="modalExpensesDetailsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExpensesDetailsLabel"><?php echo e(__('sales::labels.add_detail')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="description"><?php echo e(__('labels.description')); ?></label>
                            <textarea wire:model.defer="description" class="form-control" id="description"></textarea>
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
                    </div>
                    <div class="row">
                        <div class="offset-md-8 col-4 mb-3">
                            <label for="description"><?php echo e(__('labels.amount')); ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">S/.</span>
                                </div>
                                <input wire:model.defer="amount" type="text" class="form-control text-right">
                            </div>
                            <?php $__errorArgs = ['amount'];
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
                    <button wire:click="addDetail" type="button" class="btn btn-primary"><?php echo e(__('labels.add')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('livewire:load', function () {
            $("#datepicker-1").datepicker({
                format: 'dd/mm/yyyy',
                language:"<?php echo e(app()->getLocale()); ?>",
                autoclose:true
            }).datepicker('setDate','0');

            $('.companiesAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('supplier_id',item.value);
            });
        });
        document.addEventListener('response_expenses_store', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});

            $('.companiesAutoComplete').autoComplete('clear');
        });
        window.addEventListener('response_payment_total_different', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-times-hexagon text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('setting::labels.error')); ?>!</span>",
                message: "<span><strong><?php echo e(__('setting::labels.went_wrong')); ?>... </strong>"+event.detail.message+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(214, 36, 16, 0.5)'});
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/expenses/expenses-create.blade.php ENDPATH**/ ?>