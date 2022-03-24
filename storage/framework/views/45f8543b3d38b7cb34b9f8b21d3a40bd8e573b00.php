<div>
    <div class="modal fade" id="modalDocumentPayments" tabindex="-1" aria-labelledby="modalPaymentsLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pagos del comprobante: <span id="modalDocumentePaymentsLabel" wire:ignore></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <tr >
                            <th scope="col" class="border-top-0">#</th>
                            <th scope="col" class="border-top-0">Fecha de pago</th>
                            <th scope="col" class="border-top-0">Método de pago</th>
                            <th scope="col" class="border-top-0">Destino</th>
                            <th scope="col" class="border-top-0">Referencia</th>
                            <th scope="col" class="border-top-0">Monto</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($key+1); ?></th>
                                <td><?php echo e(\Carbon\Carbon::parse($payment->date_of_payment)->format('d/m/Y')); ?></td>
                                <td><?php echo e($payment->description); ?></td>
                                <td>
                                    <?php if($payment->user_id): ?>
                                    <?php echo e('CAJA CHICA'.($payment->reference_number?' - '.$payment->reference_number:'')); ?>

                                    <?php else: ?>
                                    <?php echo e($payment->bank_name.' - '.$payment->back_account_description); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($payment->reference); ?></td>
                                <td><?php echo e($payment->payment); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('labels.close')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('modal-sales-vaucher-payments', event => {
            $('#modalDocumentePaymentsLabel').html(event.detail.vaucher);
            $('#modalDocumentPayments').modal('show');
        });
    </script>
</div><?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/document/document-modal-payments.blade.php ENDPATH**/ ?>