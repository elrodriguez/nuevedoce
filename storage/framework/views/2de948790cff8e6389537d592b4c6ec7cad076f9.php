<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group bg-white shadow-inset-2">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-default dropdown-toggle waves-effect waves-themed" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($show); ?></button>
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
                        <button wire:click="$set('search', '')" type="button"
                            class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    <?php else: ?>
                        <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm"
                                wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    <?php endif; ?>
                </div>
                <input wire:keydown.enter="companiesSearch" wire:model.defer="search" type="text"
                    class="form-control border-left-0 bg-transparent pl-0" placeholder="Escriba aquí...">
                <div class="input-group-append">
                    <button wire:click="companiesSearch" class="btn btn-default waves-effect waves-themed"
                        type="button">Buscar</button>
                    <a href="<?php echo e(route('inventory_transfers_create')); ?>"
                        class="btn btn-success waves-effect waves-themed"
                        type="button"><?php echo e(__('setting::buttons.new')); ?></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div style="scroll:auto">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo e(__('labels.actions')); ?></th>
                            <th class="text-center"><?php echo e(__('labels.date')); ?></th>
                            <th><?php echo e(__('labels.origin_warehouse')); ?></th>
                            <th><?php echo e(__('labels.destination_warehouse')); ?></th>
                            <th><?php echo e(__('labels.detail')); ?></th>
                            <th><?php echo e(__('labels.products')); ?></th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo e($key + 1); ?></td>
                                <td class="text-center align-middle">
                                    <a href="<?php echo e(route('inventory_transfers_export_pdf', $transfer->id)); ?>"
                                        class="btn btn-primary btn-icon waves-effect waves-themed" type="button">
                                        <i class="fal fa-print"></i>
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <?php echo e(\Carbon\Carbon::parse($transfer->created_at)->format('d/m/Y')); ?>

                                </td>
                                <td class="align-middle"><?php echo e($transfer->origin_name); ?></td>
                                <td class="align-middle"><?php echo e($transfer->destination_name); ?></td>
                                <td class="align-middle"><?php echo e($transfer->description); ?></td>
                                <td class="text-right align-middle">
                                    <button wire:click="$emit('openModalProductsTransfer',<?php echo e($transfer->id); ?>)"
                                        class="btn btn-warning waves-effect waves-themed" type="button">
                                        <?php echo e($transfer->quantity); ?>

                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer  pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto"><?php echo e($transfers->links()); ?></div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-company-delete', event => {
            let res = event.detail.res;

            if (res == 'success') {
                initApp.playSound('<?php echo e(url('themes/smart-admin/media/sound')); ?>', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='<?php echo e(env('BOOTBOX_SUCCESS_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('setting::labels.success')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('setting::labels.excellent')); ?>... </strong><?php echo e(__('setting::labels.msg_delete')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({
                    'background-color': '<?php echo e(env('BOOTBOX_SUCCESS_COLOR')); ?>'
                });
            } else {
                initApp.playSound('<?php echo e(url('themes/smart-admin/media/sound')); ?>', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='<?php echo e(env('BOOTBOX_ERROR_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('setting::labels.error')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('setting::labels.went_wrong')); ?>... </strong><?php echo e(__('setting::labels.msg_not_peptra')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({
                    'background-color': '<?php echo e(env('BOOTBOX_ERROR_COLOR')); ?>'
                });
            }
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/transfers/transfers-list.blade.php ENDPATH**/ ?>