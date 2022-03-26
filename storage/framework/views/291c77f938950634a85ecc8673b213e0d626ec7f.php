<div>
    <!-- Modal -->
    <div class="modal fade" id="modalExpensesPayments" tabindex="-1" aria-labelledby="modalExpensesPaymentsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExpensesPaymentsLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
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
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right">TOTAL PAGADO</td>
                                    <td class="text-right"><?php echo e(number_format($total_payments, 2, '.', '')); ?></td>
                                </tr>
                                
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('labels.close')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-modal-expense-payments-1', event => {
            $('#modalExpensesPaymentsLabel').html(event.detail.title);
            $('#modalExpensesPayments').modal('show');
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/expenses/expenses-payments-modal.blade.php ENDPATH**/ ?>