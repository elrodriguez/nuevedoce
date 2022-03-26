<div>
    <div wire:ignore.self class="modal fade" id="modalSaleNotePayments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nota de Venta: <span id="modalSaleNotePaymentsLabel"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center"><?php echo e(__('labels.actions')); ?></th>
                                <th scope="col" class="text-center"><?php echo e(__('labels.date_payment')); ?></th>
                                <th scope="col"><?php echo e(__('sales::labels.payment_methods')); ?></th>
                                <th scope="col"><?php echo e(__('sales::labels.destination')); ?></th>
                                <th scope="col"><?php echo e(__('sales::labels.reference')); ?></th>
                                <th scope="col" class="text-center"><?php echo e(__('labels.amount')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center">
                                        <button onclick="confirmDelete(<?php echo e($payment->id); ?>)" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed">
                                            <i class="fal fa-times"></i>
                                        </button>
                                    </td>
                                    <td class="text-center"><?php echo e(\Carbon\Carbon::parse($payment->date_of_payment)->format('d/m/Y')); ?></td>
                                    <td><?php echo e($payment->description); ?></td>
                                    <td>
                                        <?php
                                            $destination_type = \App\Models\BankAccount::class;
                                        ?>
                                        <?php if($payment->destination_type == $destination_type): ?>
                                        <?php echo e($payment->banck_name); ?>

                                        <?php else: ?>
                                        <?php echo e($payment->cash_name); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($payment->reference); ?></td>
                                    <td class="text-right"><?php echo e(number_format($payment->payment, 2, '.', '')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!$paid): ?>
                                <tr>
                                    <td>

                                    </td>
                                    <td class="text-center">
                                        <input wire:model.defer="date_of_payment" onchange="this.dispatchEvent(new InputEvent('input'))" class="form-control" type="text" id="inputDatePayment">
                                        <?php $__errorArgs = ['date_of_payment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </td>
                                    <td class="text-center">
                                        <select wire:model.defer="method_type_id" class="custom-select form-control">
                                            <?php $__currentLoopData = $cat_payment_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_payment_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cat_payment_method_type->id); ?>"><?php echo e($cat_payment_method_type->description); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['method_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </td>
                                    <td class="text-center">
                                        <select wire:model.defer="destination_id" class="custom-select form-control" >
                                            <?php $__currentLoopData = $cat_expense_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_expense_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cat_expense_method_type['id']); ?>"><?php echo e($cat_expense_method_type['description']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['destination_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </td>
                                    <td class="text-center">
                                        <input wire:model.defer="reference" class="form-control" type="text">
                                        <?php $__errorArgs = ['reference'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </td>
                                    <td class="text-right pr-0">
                                        <input wire:model.defer="payment" class="form-control text-right" type="text">
                                        <?php $__errorArgs = ['payment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right">TOTAL PAGADO</td>
                                <td class="text-right"><?php echo e(number_format($total_payments, 2, '.', '')); ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">TOTAL A PAGAR</td>
                                <td class="text-right"><?php echo e(number_format($total_note, 2, '.', '')); ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">PENDIENTE DE PAGO</td>
                                <td class="text-right"><?php echo e(number_format(($total_note - $total_payments), 2, '.', '')); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('labels.close')); ?></button>
                    <?php if(!$paid): ?>
                        <button wire:click="storePayment" type="button" class="btn btn-primary"><?php echo e(__('labels.save')); ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('modal-sales-note-payments', event => {
            $('#modalSaleNotePaymentsLabel').html(event.detail.vaucher);
            $('#modalSaleNotePayments').modal('show');
        });
        document.addEventListener('livewire:load', function () {
            $("#inputDatePayment").datepicker({
                format: 'dd/mm/yyyy',
                language:"<?php echo e(app()->getLocale()); ?>",
                autoclose:true
            }).datepicker('setDate','0');
        });
        function confirmDelete(id){
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
                        window.livewire.find('<?php echo e($_instance->id); ?>').deletePayment(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('actions-sales-note-payments', event => {
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
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/document/sale-notes-modal-payments.blade.php ENDPATH**/ ?>