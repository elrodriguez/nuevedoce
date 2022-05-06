<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label class="form-label" for="simpleinput"><?php echo e(__('labels.origin_warehouse')); ?></label>
                        <select wire:model="warehouse_id" class="custom-select form-control">
                            <option value=""><?php echo e(__('labels.to_select')); ?></option>
                            <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($warehouse->id == $destination_warehouse_id ? 'disabled' : ''); ?>

                                    value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['warehouse_id'];
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
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"
                            for="simpleinput"><?php echo e(__('labels.destination_warehouse')); ?></label>
                        <div wire:ignore>
                            <select wire:model="destination_warehouse_id" class="custom-select form-control">
                                <option value=""><?php echo e(__('labels.to_select')); ?></option>
                                <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php echo e($warehouse->id == $warehouse_id ? 'disabled' : ''); ?>

                                        value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->description); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php $__errorArgs = ['destination_warehouse_id'];
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
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label class="form-label" for="simpleinput"><?php echo e(__('labels.details')); ?></label>
                        <textarea wire:model.defer="detail" rows="1" class="form-control"></textarea>
                        <?php $__errorArgs = ['detail'];
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
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label class="form-label" for="simpleinput"><?php echo e(__('labels.product')); ?></label>
                        <div wire:ignore>
                            <input class="form-control basicAutoComplete" type="text"
                                data-url="<?php echo e(route('inventory_transfers_search')); ?>" autocomplete="off">
                        </div>
                        <div>
                            <?php $__errorArgs = ['product_id'];
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
            </div>
        </div>
        <div
            class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                <thead class="bg-primary-600">
                    <tr>
                        <th class="text-center"><?php echo e(__('labels.actions')); ?></th>
                        <th class="text-center"><?php echo e(__('labels.product')); ?></th>
                        <th class="text-right"><?php echo e(__('labels.actual_quantity')); ?></th>
                        <th class="text-right"><?php echo e(__('labels.amount_to_transfer')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($products) > 0): ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center align-middle">
                                    <button wire:click="removeProduct(<?php echo e($key); ?>)"
                                        class="btn btn-danger btn-sm btn-icon waves-effect waves-themed">
                                        <i class="fal fa-times"></i>
                                    </button>
                                </td>
                                <td class="align-middle"><?php echo e($product['description']); ?></td>
                                <td class="text-right align-middle"><?php echo e($product['stock']); ?></td>
                                <td class="text-right align-middle">
                                    <input class="form-control text-right" type="text"
                                        wire:model.defer="products.<?php echo e($key); ?>.quantity"
                                        name="products[<?php echo e($key); ?>].quantity">
                                    <?php $__errorArgs = ['products.' . $key . '.quantity'];
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr class="odd">
                            <td colspan="12" class="dataTables_empty text-center" valign="top">
                                <?php echo e(__('labels.no_data_available_in_the_table')); ?>

                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="<?php echo e(route('inventory_transfers')); ?>" type="button"
                class="btn btn-secondary waves-effect waves-themed">
                <?php echo app('translator')->get('labels.back'); ?>
            </a>
            <button wire:click="store" wire:loading.attr="disabled"
                class="btn btn-primary ml-auto waves-effect waves-themed" type="button">
                <?php echo app('translator')->get('labels.save'); ?>
            </button>
        </div>
    </div>
    <script>
        window.addEventListener('response_transfer_store', event => {
            swalAlert(event.detail.title, event.detail.message, event.detail.icon);
        });

        function swalAlert(title, msg, icon) {
            Swal.fire(title, msg, icon);
        }

        document.addEventListener('livewire:load', function() {
            $('.basicAutoComplete').autoComplete({
                autoSelect: true,
            }).on('autocomplete.select', function(evt, item) {
                window.livewire.find('<?php echo e($_instance->id); ?>').addProduct(item.value);
            });
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/transfers/transfers-create.blade.php ENDPATH**/ ?>