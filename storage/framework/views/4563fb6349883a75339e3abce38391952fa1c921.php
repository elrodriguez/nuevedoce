<div>
    <!-- Modal -->
    <div class="modal fade" id="modal-products-transfer" tabindex="-1" aria-labelledby="modalProductsTransferLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductsTransferLabel">Productos Trasladados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col"><?php echo e(__('labels.product')); ?></th>
                                <th class="text-center" scope="col"><?php echo e(__('labels.quantity')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $xtotalp = 0;
                                $c = 1;
                            ?>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($product->quantity > 0): ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($c); ?></td>
                                        <td><?php echo e($product->name); ?></td>
                                        <td class="text-right"><?php echo e($product->quantity); ?></td>
                                    </tr>
                                    <?php
                                        $xtotalp = $xtotalp + $product->quantity;
                                        $c++;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-right" colspan="2"><?php echo e(__('labels.total')); ?></th>
                                <th class="text-right"><?php echo e(number_format($xtotalp, 2, '.', '')); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <?php echo e(__('labels.close')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-modal-products-transfer', event => {
            $('#modal-products-transfer').modal('show');
        })
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/transfers/transfers-products-modal.blade.php ENDPATH**/ ?>