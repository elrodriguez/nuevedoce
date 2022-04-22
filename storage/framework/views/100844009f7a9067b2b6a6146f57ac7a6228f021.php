<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-default dropdown-toggle waves-effect waves-themed" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($show); ?></button>
                    <div class="dropdown-menu" style="">
                        <button class="dropdown-item" wire:click="$set('show', 10)">10</button>
                        <button class="dropdown-item" wire:click="$set('show', 20)">20</button>
                        <button class="dropdown-item" wire:click="$set('show', 50)">50</button>
                        <div role="separator" class="dropdown-divider"></div>
                        <button class="dropdown-item" wire:click="$set('show', 100)">100</button>
                        <button class="dropdown-item" wire:click="$set('show', 500)">500</button>
                    </div>
                </div>
                <div class="input-group-prepend">
                    <?php if($search): ?>
                        <button wire:click="$set('search', '')" type="button" class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    <?php else: ?>
                        <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    <?php endif; ?>
                </div>
                <select wire:model.defer="location_id" class="custom-select">
                    <option value="">Seleccionar</option>
                    <?php $__currentLoopData = $establishments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $establishment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($establishment->id); ?>"><?php echo e($establishment->description); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div wire:ignore>
                    <input wire:model.defer="search" type="text" class="form-control autoCompleteItem" data-url="<?php echo e(route('inventory_kardex_items_search')); ?>" autocomplete="off" placeholder="<?php echo app('translator')->get('inventory::labels.lbl_type_here'); ?>">
                </div>
                <input type="text" class="form-control" id="custom-range" placeholder="Rango de fechas">
                <div class="input-group-append">
                    <button wire:click="getItems" class="btn btn-default waves-effect waves-themed" type="button"><?php echo app('translator')->get('inventory::labels.btn_search'); ?></button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo e(__('labels.category')); ?></th>
                        <th><?php echo e(__('labels.brand')); ?></th>
                        <th><?php echo e(__('labels.model')); ?></th>
                        <th><?php echo e(__('labels.product')); ?></th>
                        <th><?php echo e(__('labels.date')); ?></th>
                        <th><?php echo e(__('labels.transaction_type')); ?></th>
                        <th><?php echo e(__('labels.number')); ?></th>
                        <th class="text-center"><?php echo e(__('labels.f_issuance')); ?></th>
                        <th class="text-center"><?php echo e(__('labels.entry_kardex')); ?></th>
                        <th class="text-center"><?php echo e(__('labels.exit_kardex')); ?></th>
                        <th class="text-center"><?php echo e(__('labels.balance')); ?></th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php if(count($items)>0): ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="align-middle"><?php echo e($key+1); ?></td>
                            <td class="align-middle"><?php echo e($item->category_name); ?></td>
                            <td class="align-middle"><?php echo e($item->brand_name); ?></td>
                            <td class="align-middle"><?php echo e($item->model_name); ?></td>
                            <td class="align-middle"><?php echo e($item->name.' '.$item->description); ?></td>
                            <td class="align-middle"><?php echo e($item->created_at); ?></td>
                            <td class="align-middle">
                                <?php if($item->inventory_kardexable_type == 'Modules\Inventory\Entities\InvPurchase'): ?>
                                    <?php if($item->quantity>0): ?>
                                        <?php echo e(__('Compra')); ?>

                                    <?php else: ?>
                                        <?php echo e(__('Anulación Compra')); ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo e($item->detail); ?> 
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <?php if($item->kardexable_type == 'Modules\Inventory\Entities\InvPurchase'): ?>
                                    <?php echo e($item->purchase_number); ?>

                                <?php elseif($item->kardexable_type == 'Modules\Sales\Entities\SalDocument'): ?>
                                    <?php echo e($item->document_number); ?>

                                <?php elseif($item->kardexable_type == 'Modules\Sales\Entities\SalSaleNote'): ?>
                                    <?php echo e($item->sale_note_number); ?>

                                <?php elseif($item->kardexable_type == 'Modules\TransferService\Entities\SerLoadOrder'): ?>
                                    <?php echo e($item->load_order_number); ?>

                                <?php endif; ?>
                            </td>
                            <td class="align-middle text-center"><?php echo e($item->date_of_issue); ?></td>
                            <?php if($item->kardexable_type == 'Modules\Inventory\Entities\InvPurchase'): ?>
                                <td class="align-middle text-right"><?php echo e($item->quantity); ?></td>
                                <td class="align-middle text-center">-</td>
                            <?php elseif($item->kardexable_type == 'Modules\Sales\Entities\SalDocument'): ?>
                                <td class="align-middle text-center">-</td>
                                <td class="align-middle text-right"><?php echo e($item->quantity); ?></td>
                            <?php elseif($item->kardexable_type == 'Modules\Sales\Entities\SalSaleNote'): ?>
                                <td class="align-middle text-center">-</td>
                                <td class="align-middle text-right"><?php echo e($item->quantity); ?></td>
                            <?php elseif($item->kardexable_type == 'Modules\TransferService\Entities\SerLoadOrder'): ?>
                                <?php if($item->quantity > 0): ?>
                                    <td class="align-middle text-center"><?php echo e($item->quantity); ?></td>
                                    <td class="align-middle text-right">-</td>
                                <?php else: ?>
                                    <td class="align-middle text-center">-</td>
                                    <td class="align-middle text-right"><?php echo e($item->quantity); ?></td>
                                <?php endif; ?>
                            <?php else: ?>
                                <td class="align-middle text-right"><?php echo e($item->quantity); ?></td>
                                <td class="align-middle text-center">-</td>
                            <?php endif; ?>
                            <?php
                                $balance = $balance + $item->quantity;
                            ?>
                            <td class="align-middle text-right"><?php echo e(number_format($balance, 2, '.', '')); ?></td>
                        </tr>
        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="dataTables_empty text-center" valign="top"><?php echo e(__('labels.no_records_to_display')); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer  pb-0 d-flex flex-row align-items-center" style="margin-bottom: 20px;">
            <div class="ml-auto"><?php echo e($items->links()); ?></div>
        </div>
    </div>
    <script type="text/javascript">
    document.addEventListener('livewire:load', function () {
        $('#custom-range').daterangepicker({
                locale:
                    {
                        format: 'DD/MM/YYYY'
                },
                opens: 'left'
            }, function(start, end, label){
                console.log(end.format('YYYY-MM-DD'))
                window.livewire.find('<?php echo e($_instance->id); ?>').set('start',start.format('YYYY-MM-DD'));
                window.livewire.find('<?php echo e($_instance->id); ?>').set('end',end.format('YYYY-MM-DD'));
        });
        $('.autoCompleteItem').autoComplete().on('autocomplete.select', function (evt, item) {
            window.livewire.find('<?php echo e($_instance->id); ?>').set('item_id',item.value);
        });
    });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/kardex/items-stock.blade.php ENDPATH**/ ?>