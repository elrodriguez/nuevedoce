<div>
    <div class="row">
        <div class="col-md-12 mb-3 d-flex flex-row align-items-center">
            <div class="ml-auto">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('sales::cash.cash-modal-form')->html();
} elseif ($_instance->childHasBeenRendered('l573486803-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l573486803-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l573486803-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l573486803-0');
} else {
    $response = \Livewire\Livewire::mount('sales::cash.cash-modal-form');
    $html = $response->html();
    $_instance->logRenderedChild('l573486803-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
        <thead class="bg-primary-600">
            <tr>
                <th class="text-center align-middle"><?php echo e(__('labels.actions')); ?></th>
                <th class="text-center align-middle">Referencia</th>
                <th class="align-middle">Vendedor</th>
                <th class="text-center align-middle">Apertura</th>
                <th class="text-center align-middle">Cierre</th>
                <th class="text-center align-middle">Saldo inicial</th>
                <th class="text-center align-middle">Saldo final</th>
                <th class="text-center align-middle"><?php echo e(__('labels.state')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($collection)>0): ?>
                <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center align-middle">
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="btn btn-info rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fal fa-cogs"></i>
                                </a>
                                <div class="dropdown-menu" style="">
                                    <?php if($item->state): ?>
                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#cashModalForm" wire:click="showEdit('<?php echo e($item->id); ?>')" ><i class="fal fa-edit mr-1"></i><?php echo e(__('labels.edit')); ?></a>
                                        <a class="dropdown-item text-danger" href="javascript:closeCash('<?php echo e(route('sales_administration_cash_close',$item->id)); ?>')"><i class="fal fa-lock-alt mr-1"></i>Cerrar Caja</a>
                                        <div class="dropdown-divider"></div>
                                    <?php endif; ?>
                                    <a class="dropdown-item" href="<?php echo e(route('sales_administration_cash_report_pdf',$item->id)); ?>" target="_blank"><i class="fal fa-file-pdf mr-1"></i>Reporte Caja PDF</a>
                                    <a class="dropdown-item" href="<?php echo e(route('sales_administration_cash_report_products_pdf',$item->id)); ?>" target="_blank"><i class="fal fa-file-pdf mr-1"></i>Reporte Productos PDF</a>
                                    <a class="dropdown-item" href="<?php echo e(route('sales_administration_cash_reportproducts_excel_pdf',$item->id)); ?>"><i class="fal fa-file-excel mr-1"></i>Reporte Productos EXCEL</a>
                                </div>
                            </div>
                        </td>
                        <td class="text-center align-middle"><?php echo e($item->reference_number); ?></td>
                        <td class="align-middle"><?php echo e($item->name); ?></td>
                        <td class="text-center align-middle"><?php echo e(\Carbon\Carbon::parse($item->date_opening)->format('d/m/Y')); ?><br><code><?php echo e($item->time_opening); ?></code></td>
                        <td class="text-center align-middle">
                            <?php if(!$item->state): ?>
                                <?php echo e(\Carbon\Carbon::parse($item->date_closed)->format('d/m/Y')); ?>

                                <br>
                                <code><?php echo e($item->time_closed); ?></code>
                            <?php endif; ?>
                        </td>
                        <td class="text-right align-middle"><?php echo e($item->beginning_balance); ?></td>
                        <td class="text-right align-middle"><?php echo e($item->final_balance); ?></td>
                        <td class="text-center align-middle">
                            <?php if($item->state): ?>
                                <span class="badge badge-info">Aperturada</span>
                            <?php else: ?>
                                <span class="badge badge-success">Cerrada</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="dataTables_empty text-center" valign="top"><?php echo e(__('labels.no_records_to_display')); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
        <?php if($collection->links()): ?>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="row">
                            <div class="col-md-12 d-flex flex-row align-items-center">
                                <div class="ml-auto"><?php echo e($collection->links()); ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
    <script type="text/javascript">
        function closeCash(close_url) {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> <?php echo e(__('lend::messages.msg_0001')); ?>",
                message: "<span><strong><?php echo e(__('lend::labels.lbl_warning')); ?>: </strong> <?php echo e(__('lend::messages.msg_0002')); ?></span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                    {
                        confirm:
                            {
                                label: '<?php echo e(__('labels.yes')); ?>',
                                className: 'btn-danger shadow-0'
                            },
                        cancel:
                            {
                                label: '<?php echo e(__('labels.no')); ?>',
                                className: 'btn-default'
                            }
                    },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        $.get(close_url, function(data) {
                            if(data.success == true){
                                window.livewire.find('<?php echo e($_instance->id); ?>').listCash();
                                initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
                                let box = bootbox.alert({
                                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>¡Exito!</span>",
                                    message: "<span><strong><?php echo e(__('lend::labels.lbl_excellent')); ?>... </strong>Caja cerrada</span>",
                                    centerVertical: true,
                                    className: "modal-alert",
                                    closeButton: false
                                });
                                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
                            }
                        }).fail(function( data ) {
                            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
                            let box = bootbox.alert({
                                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>¡Error!</span>",
                                message: "<span><strong>Fatal... </strong><?php echo e(__('messages.msg_access_permission')); ?></span>",
                                centerVertical: true,
                                className: "modal-alert",
                                closeButton: false
                            });
                            box.find('.modal-content').css({'background-color': 'rgba(205, 97, 85, 0.5)'});
                        });
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/cash/cash-list.blade.php ENDPATH**/ ?>