<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group bg-white shadow-inset-2">
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
                <input wire:keydown.enter="updatingSearchSaleNote" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="Escriba aquí...">
                <div class="input-group-append">
                    <button wire:click="updatingSearchSaleNote" class="btn btn-default waves-effect waves-themed" type="button">Buscar</button>
                    <a href="<?php echo e(route('sales_documents_sale_notes_create')); ?>" class="btn btn-success waves-effect waves-themed" type="button"><?php echo e(__('labels.new')); ?></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center"><?php echo e(__('labels.actions')); ?></th>
                        <th class="text-center"><?php echo e(__('labels.broadcast_date')); ?></th>
                        <th><?php echo e(__('labels.customer')); ?></th>
                        <th class="text-center"><?php echo e(__('sales::labels.sale_note')); ?></th>
                        <th><?php echo e(__('labels.state')); ?></th>
                        <th class="text-center"><?php echo e(__('labels.total')); ?></th>
                        <th class="text-center"><?php echo e(__('sales::labels.voucher')); ?></th>
                        <th><?php echo e(__('labels.state')); ?> <?php echo e(__('labels.paid')); ?></th>
                        <th class="text-center"><?php echo e(__('labels.payments')); ?></th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php if(count($notes) > 0): ?>
                        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center align-middle"><?php echo e($key + 1); ?></td>
                            <td class="text-center tdw-50 align-middle">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fal fa-cogs"></i>
                                    </button>
                                    <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ventas_nota_venta_editar')): ?>
                                        <a href="<?php echo e(route('sales_documents_sale_notes_edit',$note->external_id)); ?>" class="dropdown-item">
                                            <i class="fal fa-pencil-alt mr-1"></i><?php echo e(__('labels.edit')); ?>

                                        </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuraciones_establecimientos_eliminar')): ?>
                                        <div class="dropdown-divider"></div>
                                        <button onclick="confirmCancel(<?php echo e($note->id); ?>)" type="button" class="dropdown-item text-danger">
                                            <i class="fal fa-trash-alt mr-1"></i><?php echo e(__('labels.ticket_cancel')); ?>

                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center"><?php echo e(\Carbon\Carbon::parse($note->date_of_issue)->format('d/m/Y')); ?></td>
                            <td class="align-middle"><?php echo e($note->customer->full_name); ?></td>
                            <td class="align-middle text-center"><?php echo e($note->series.'-'.str_pad($note->number, 8, "0", STR_PAD_LEFT)); ?></td>
                            <td class="align-middle">
                                <?php if($note->state_type_id == '01'): ?>
                                    <span class="badge badge-info"><?php echo e($note->description); ?></span>
                                <?php elseif($note->state_type_id == '03'): ?>
                                    <span class="badge badge-success"><?php echo e($note->description); ?></span>
                                <?php elseif($note->state_type_id == '05'): ?>
                                    <span class="badge badge-primary"><?php echo e($note->description); ?></span>
                                <?php elseif($note->state_type_id == '07'): ?>
                                    <span class="badge badge-secondary"><?php echo e($note->description); ?></span>
                                <?php elseif($note->state_type_id == '09'): ?>
                                    <span class="badge badge-danger"><?php echo e($note->description); ?></span>
                                <?php elseif($note->state_type_id == '11'): ?>
                                    <span class="badge badge-dark"><?php echo e($note->description); ?></span>
                                <?php elseif($note->state_type_id == '13'): ?>
                                    <span class="badge badge-warning"><?php echo e($note->description); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle text-right"><?php echo e($note->total); ?></td>
                            <td><?php echo e($note->voucher); ?></td>
                            <td class="align-middle">
                                <?php if($note->paid): ?>
                                <span class="badge badge-success"><?php echo e(__('labels.paid')); ?></span>
                                <?php else: ?>
                                <span class="badge badge-warning"><?php echo e(__('labels.pending')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle text-center">
                                <button wire:click="$emit('openModalNotePayments',<?php echo e($note->id); ?>)" class="btn btn-warning btn-icon rounded-circle waves-effect waves-themed">
                                    <i class="fal fa-comment-alt-dollar"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr class="odd"><td valign="top" colspan="10" class="dataTables_empty text-center"><?php echo e(__('labels.no_records_to_display')); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="card-footer  pb-0 d-flex flex-row align-notes-center">
            <div class="ml-auto"><?php echo e($notes->links()); ?></div>
        </div>
    </div>
    
    <script type="text/javascript">
        function confirmCancel(id){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> ¿<?php echo e(__('labels.you_want_to_cancel_document')); ?>?",
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
                        window.livewire.find('<?php echo e($_instance->id); ?>').cancelDocument(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('response_anulation_sale_note', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.message+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/document/sale-notes-list.blade.php ENDPATH**/ ?>