<div>
    <!-- Modal Right Large -->
    <div id="modalDocumentSummaryCancellations" wire:ignore.self class="modal fade default-example-modal-right-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-right modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4"><?php echo e(__('sales::labels.summary_and_cancellations')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo e($tevent == 'SL' || $tevent == 'SN' ? 'active' : ''); ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fal fa-object-group mr-1"></i><?php echo e(__('sales::labels.summaries')); ?></a>
                            <div class="dropdown-menu">
                                <a wire:click="$set('tevent','SL')" class="dropdown-item <?php echo e($tevent == 'SL' ? 'active' : ''); ?>"><?php echo e(__('labels.list')); ?></a>
                                <a wire:click="$set('tevent','SN')" class="dropdown-item <?php echo e($tevent == 'SN' ? 'active' : ''); ?>"><?php echo e(__('labels.new')); ?></a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-cancellations" role="tab"><i class="fal fa-times-hexagon mr-1"></i><?php echo e(__('sales::labels.cancellations')); ?></a></li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade <?php echo e($tevent == 'SL' ? 'active show' : ''); ?>" id="tab-summaries-list" role="tabpanel" aria-labelledby="tab-summaries-list">
                            <h5>Listado de resúmenes</h5>
                            <div class="form-group row">
                                <label class="col-form-label col-12 col-lg-3 form-label text-lg-right"><?php echo e(__('labels.broadcast_date')); ?></label>
                                <div class="col-12 col-lg-3">
                                    <div class="input-group">
                                        <input wire:model.defer="date_summary_search" onchange="this.dispatchEvent(new InputEvent('input'))" type="text" class="form-control" readonly=""  id="datepicker-summary">
                                        <div class="input-group-append">
                                            <span class="input-group-text fs-xl">
                                                <i class="fal fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 text-lg-left">
                                    <button wire:loading.attr="disabled" wire:click="getSummaries" type="button" class="btn btn-default waves-effect waves-themed"><?php echo e(__('labels.search')); ?></button>
                                </div>
                            </div>
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr slot="heading">
                                            <th class="text-center">Acciones</th>
                                            <th class="text-center">Fecha Emisión</th>
                                            <th class="text-center">Fecha Referencia</th>
                                            <th>Identificador</th>
                                            <th>Ticket</th>
                                            <th>Estado</th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($summaries) > 0): ?>
                                            <?php $__currentLoopData = $summaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $summary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="btn btn-info rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fal fa-cogs"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="<?php echo e(route('download_sale_summaries',['summary','xml',$summary->filename])); ?>"><i class="fal fa-download mr-1"></i>XML</a>
                                                                <?php if($summary->has_cdr): ?>
                                                                    <a class="dropdown-item" href="<?php echo e(route('download_sale_summaries',['summary','cdr','R-'.$summary->filename])); ?>"><i class="fal fa-download mr-1"></i>CDR</a>
                                                                <?php endif; ?>
                                                                <a wire:click="checkStatus(<?php echo e($summary->id); ?>)" class="dropdown-item" href="javascript:void(0)"><i class="fal fa-undo mr-1"></i>Consultar</a>
                                                                <a wire:click="destroy(<?php echo e($summary->id); ?>)" class="dropdown-item" href="javascript:void(0)"><i class="fal fa-trash-alt mr-1"></i>Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center align-middle"><?php echo e(\Carbon\Carbon::parse($summary->date_of_issue)->format('d/m/Y')); ?></td>
                                                    <td class="text-center align-middle"><?php echo e(\Carbon\Carbon::parse($summary->date_of_reference)->format('d/m/Y')); ?></td>
                                                    <td class="align-middle"><?php echo e($summary->identifier); ?></td>
                                                    <td class="align-middle"><?php echo e($summary->ticket); ?></td>
                                                    <td class="align-middle">
                                                        <?php if($summary->state_type_id == '01'): ?>
                                                            <span class="badge badge-info"><?php echo e($summary->state_type->description); ?></span>
                                                        <?php elseif($summary->state_type_id == '03'): ?>
                                                            <span class="badge badge-success"><?php echo e($summary->state_type->description); ?></span>
                                                        <?php elseif($summary->state_type_id == '05'): ?>
                                                            <span class="badge badge-primary"><?php echo e($summary->state_type->description); ?></span>
                                                        <?php elseif($summary->state_type_id == '07'): ?>
                                                            <span class="badge badge-secondary"><?php echo e($summary->state_type->description); ?></span>
                                                        <?php elseif($summary->state_type_id == '09'): ?>
                                                            <span class="badge badge-danger"><?php echo e($summary->state_type->description); ?></span>
                                                        <?php elseif($summary->state_type_id == '11'): ?>
                                                            <span class="badge badge-dark"><?php echo e($summary->state_type->description); ?></span>
                                                        <?php elseif($summary->state_type_id == '13'): ?>
                                                            <span class="badge badge-warning"><?php echo e($summary->state_type->description); ?></span>
                                                        <?php endif; ?>
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
                        <div class="tab-pane fade <?php echo e($tevent == 'SN' ? 'active show' : ''); ?>" id="tab-summaries-new" role="tabpanel" aria-labelledby="tab-summaries-new">
                            <h5>Registrar Resumen</h5>
                            <div class="form-group row">
                                <label class="col-form-label col-12 col-lg-3 form-label text-lg-right"><?php echo e(__('labels.broadcast_date')); ?></label>
                                <div class="col-12 col-lg-3">
                                    <div class="input-group">
                                        <input wire:model.defer="date_summary_new" onchange="this.dispatchEvent(new InputEvent('input'))" type="text" class="form-control" readonly=""  id="datepicker-summary-new">
                                        <div class="input-group-append">
                                            <span class="input-group-text fs-xl">
                                                <i class="fal fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <?php $__errorArgs = ['date_summary_new'];
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
                                <div class="col-12 col-lg-3 text-lg-left">
                                    <button wire:click="getDocuments" type="button" class="btn btn-default waves-effect waves-themed"><?php echo e(__('labels.search')); ?></button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Número</th>
                                        <th class="text-center">Moneda</th>
                                        <th class="text-right">T.Exportación</th>
                                        <th class="text-right">T.Gratuita</th>
                                        <th class="text-right">T.Inafecta</th>
                                        <th class="text-right">T.Exonerado</th>
                                        <th class="text-right">T.Gravado</th>
                                        <th class="text-right">T.Igv</th>
                                        <th class="text-right">Total</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($documents) > 0): ?>
                                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="align-middle"><?php echo e($document['series'].'-'.$document['number']); ?></td>
                                                    <td class="align-middle text-center"><?php echo e($document['currency_type_id']); ?></td>
                                                    <td class="align-middle text-right"><?php echo e($document['total_exportation']); ?></td>
                                                    <td class="align-middle text-right"><?php echo e($document['total_free']); ?></td>
                                                    <td class="align-middle text-right"><?php echo e($document['total_unaffected']); ?></td>
                                                    <td class="align-middle text-right"><?php echo e($document['total_exonerated']); ?></td>
                                                    <td class="align-middle text-right"><?php echo e($document['total_taxed']); ?></td>
                                                    <td class="align-middle text-right"><?php echo e($document['total_igv']); ?></td>
                                                    <td class="align-middle text-right"><?php echo e($document['total']); ?></td>
                                                    <td class="align-middle text-right">
                                                        <button type="button" class="btn btn-danger btn-icon waves-effect waves-themedr" wire:click="removeDocument(<?php echo e($k); ?>)"><i class="fal fa-times"></i></button>
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
                        <div class="tab-pane fade" id="tab-cancellations" role="tabpanel" aria-labelledby="tab-cancellations">Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic. </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('labels.close')); ?></button>
                    <?php if($tevent != 'SL'): ?>
                        <button type="button" class="btn btn-primary waves-effect waves-themed" wire:loading.attr="disabled" wire:click="save">
                            <span wire:loading wire:target="save" wire:loading.class="spinner-border spinner-border-sm" wire:loading.class.remove="fal fa-check" class="fal fa-check mr-2" role="status" aria-hidden="true"></span>
                            <span><?php echo e(__('sales::labels.generate')); ?></span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('modal-sales-vaucher-summary-cancellations', event => {
            $('#modalDocumentSummaryCancellations').modal('show');
        });
        document.addEventListener('livewire:load', function () {
            $("#datepicker-summary").datepicker({
                format: 'dd/mm/yyyy',
                language:"<?php echo e(app()->getLocale()); ?>",
                autoclose:true
            }).datepicker('setDate','0');
            $("#datepicker-summary-new").datepicker({
                format: 'dd/mm/yyyy',
                language:"<?php echo e(app()->getLocale()); ?>",
                autoclose:true
            }).datepicker('setDate','0');
        });
        document.addEventListener('sales-summary-create', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('sales::labels.lbl_success')); ?>!</span>",
                message: "<span><strong><?php echo e(__('sales::labels.lbl_excellent')); ?>... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('sales-summary-not-documents', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-times-square text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('sales::labels.lbl_error')); ?>!</span>",
                message: "<span><strong><?php echo e(__('sales::labels.cannot_continue_process')); ?>... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(214, 36, 16, 0.5)'});
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/document/document-summary-cancellations.blade.php ENDPATH**/ ?>