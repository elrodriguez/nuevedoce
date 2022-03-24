<div>
    <div class="panel-container show">
        <form class="needs-validation <?php echo e(($errors->any()?'was-validated':'')); ?>" novalidate wire:ignore.self>
            <div class="panel-content">
                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="document_type_id"><?php echo app('translator')->get('labels.voucher_type'); ?> <span class="text-danger">*</span> </label>
                        <select class="custom-select form-control" wire:change="changeSeries" wire:model.defer="document_type_id">
                            <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($document_type->id); ?>"><?php echo e($document_type->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['document_type_id'];
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
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="serie_id"><?php echo app('translator')->get('labels.serie'); ?> <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <select class="custom-select form-control" wire:change="selectCorrelative" wire:model.defer="serie_id">
                                <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($serie->id); ?>"><?php echo e($serie->id); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text"><?php echo e($correlative); ?></span>
                            </div>
                        </div>
                        <?php $__errorArgs = ['serie_id'];
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
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="note_type_id">Tipo nota <span class="text-danger">*</span> </label>
                        <select class="custom-select form-control" wire:model.defer="note_type_id">
                            <option value=""><?php echo e(__('labels.to_select')); ?></option>
                            <?php $__currentLoopData = $note_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($note_type->id); ?>"><?php echo e($note_type->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['note_type_id'];
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
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="f_issuance"><?php echo app('translator')->get('labels.f_issuance'); ?> <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <input type="text" class="form-control " name="f_issuance" wire:model="f_issuance" onchange="this.dispatchEvent(new InputEvent('input'))" id="datepicker-1">
                            <div class="input-group-append">
                                <span class="input-group-text fs-xl">
                                    <i class="fal fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <?php echo app('translator')->get('labels.customer'); ?>
                        </label>
                        <input type="text" class="form-control" value="<?php echo e(json_decode($this->customer)->trade_name); ?>" disabled />
                        <?php $__errorArgs = ['customer_id'];
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
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <?php echo app('translator')->get('labels.description'); ?>
                        </label>
                        <input type="text" class="form-control" wire:model.defer="note_description"/>
                        <?php $__errorArgs = ['note_description'];
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
            <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="table-responsive">
                            <table class="table m-0 table-bordered table-sm table-striped">
                                <thead class="bg-info-900">
                                  <tr>
                                    <th class="text-center"></th>
                                    <th><?php echo e(__('labels.description')); ?></th>
                                    <th class="text-center"><?php echo e(__('labels.price')); ?></th>
                                    <th class="text-center"><?php echo e(__('labels.quantity')); ?></th>
                                    <th class="text-center"><?php echo e(__('labels.total')); ?></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($box_items)>0): ?>
                                        <?php $__currentLoopData = $box_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $box_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="align-middle text-center" width="10%">
                                                <button class="btn btn-default btn-sm btn-icon rounded-circle waves-effect waves-themed" wire:click="removeItem(<?php echo e($key); ?>)" type="button">
                                                    <i class="fal fa-trash-alt"></i>
                                                </button>
                                            </td>
                                            <td width="50%" class="align-middle"><?php echo e(json_decode($box_item['item'])->name); ?></td>
                                            <td class="align-middle  text-right"><?php echo e($box_item['input_unit_price_value']); ?></td>
                                            <td width="10%" class="align-middle text-center">
                                                <?php if(json_decode($box_item['item'])->item_type_id== '01'): ?>
                                                    <input type="text" wire:model="box_items.<?php echo e($key); ?>.quantity" class="form-control text-right form-control-sm" name="box_items[<?php echo e($key); ?>].quantity">
                                                    <?php $__errorArgs = ['box_items.'.$key.'.quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <?php else: ?>
                                                    <i class="fal fa-times"></i>
                                                <?php endif; ?>

                                            </td>
                                            <td class="align-middle text-right pr-3"><?php echo e(number_format($box_item['total'], 2, '.', '')); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="dataTables_empty text-center" valign="top"><?php echo e(__('labels.no_data_available_in_the_table')); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


            <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
                <div class="row">
                    <div class="col-md-4 offset-md-8 mb-3">
                        <?php if($total_exportation>0): ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-6 col-form-label text-right">OP.EXPORTACIÓN:</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control rounded-0 border-top-0 border-left-0 border-right-0 pr-3 bg-transparent text-right" wire:model.defer="total_exportation">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($total_free>0): ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-6 col-form-label text-right">OP.GRATUITAS:</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control rounded-0 border-top-0 border-left-0 border-right-0 pr-3 bg-transparent text-right" wire:model.defer="total_free">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($total_unaffected>0): ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-6 col-form-label text-right">OP.INAFECTAS:</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control rounded-0 border-top-0 border-left-0 border-right-0 pr-3 bg-transparent text-right" wire:model.defer="total_unaffected">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($total_exonerated>0): ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-6 col-form-label text-right">OP.EXONERADAS:</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control rounded-0 border-top-0 border-left-0 border-right-0 pr-3 bg-transparent text-right" wire:model.defer="total_exonerated">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($total_taxed>0): ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-6 col-form-label text-right">OP.GRAVADA:</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control rounded-0 border-top-0 border-left-0 border-right-0 pr-3 bg-transparent text-right" wire:model.defer="total_taxed">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($total_prepayment>0): ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-6 col-form-label text-right">ANTICIPOS:</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control rounded-0 border-top-0 border-left-0 border-right-0 pr-3 bg-transparent text-right" wire:model.defer="total_prepayment">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($total_igv>0): ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-6 col-form-label text-right">IGV:</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control rounded-0 border-top-0 border-left-0 border-right-0 pr-3 bg-transparent text-right" wire:model.defer="total_igv">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($total_plastic_bag_taxes>0): ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-6 col-form-label text-right">ICBPER:</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control rounded-0 border-top-0 border-left-0 border-right-0 pr-3 bg-transparent text-right" wire:model.defer="total_plastic_bag_taxes">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($total>0): ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-6 col-form-label text-right">TOTAL A PAGAR</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control rounded-0 border-top-0 border-left-0 border-right-0 pr-3 bg-transparent text-right" wire:model.defer="total">
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex flex-row align-items-center">
                        <a href="<?php echo e(route('sales_document_list')); ?>" type="button" class="btn btn-default ml-auto waves-effect waves-themed mr-3"><i class="fal fa-times mr-1"></i><?php echo e(__('labels.cancel')); ?></a>
                        <button type="button" class="btn btn-primary waves-effect waves-themed" wire:loading.attr="disabled" wire:click="validateForm()">
                            <span wire:loading wire:target="validateForm" wire:loading.class="spinner-border spinner-border-sm" wire:loading.class.remove="fal fa-check" class="fal fa-check mr-2" role="status" aria-hidden="true"></span>
                            <span>Generar</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
    <div class="modal fade" id="exampleModalprint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Imprimir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="document_external_id" value="<?php echo e($external_id); ?>">
                    <div class="row js-list-filter">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center mb-g">
                            <a type="button" onclick="printPDF('a4')" href="javascript:void(0)" class="rounded bg-white p-0 m-0 d-flex flex-column w-100 h-100 js-showcase-icon shadow-hover-2">
                                <div class="rounded-top color-fusion-300 w-100 bg-primary-300">
                                    <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-3x hover-bg">
                                        <i class="fal fa-file"></i>
                                    </div>
                                </div>
                                <div class="rounded-bottom p-1 w-100 d-flex justify-content-center align-items-center text-center">
                                    <span class="d-block text-truncate text-muted">A4</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center mb-g">
                            <a type="button" onclick="printPDF('ticket')" href="javascript:void(0)" class="rounded bg-white p-0 m-0 d-flex flex-column w-100 h-100 js-showcase-icon shadow-hover-2">
                                <div class="rounded-top color-fusion-300 w-100 bg-primary-300">
                                    <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-3x hover-bg">
                                        <i class="fal fa-receipt"></i>
                                    </div>
                                </div>
                                <div class="rounded-bottom p-1 w-100 d-flex justify-content-center align-items-center text-center">
                                    <span class="d-block text-truncate text-muted">Ticket</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div-->
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('response_payment_total_different', event => {
            swalAlertError(event.detail.message);
        });
        function swalAlertError(msg){
            Swal.fire("Error", msg, "error");
        }
        function selectCustomer(e){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('customer_id', e.target.value);
        }
        function selectProduct(e){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('item_id', e.target.value);
            window.livewire.find('<?php echo e($_instance->id); ?>').clickAddItem();
        }
        function clearSelect2(){
            $('#select2-ajax').val(null).trigger('change');
            $('#select3-ajax').val(null).trigger('change');
        }
        function clearSelect3(){
            $('#select3-ajax').val(null).trigger('change');
        }
        window.addEventListener('response_clear_select_products_alert', event => {
            let showmsg = event.detail.showmsg;
            if(showmsg == true){
                swalAlert(event.detail.message)
            }
            clearSelect3();
        });
        window.addEventListener('response_success_document_note', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>¡Enhorabuena!</span>",
                message: "<span><strong><?php echo e(__('labels.lbl_excellent')); ?>... </strong>"+event.detail.message+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        window.addEventListener('response_customer_not_ruc_exists', event => {
            swalAlert(event.detail.message);
        });
        function swalAlert(msg){
            Swal.fire('',msg,"info");
        }
        function openModalPrint(){
            $('#exampleModalprint').modal('show');
        }
        function printPDF(format){
            let external_id = $('#document_external_id').val();
            window.open(`../../../print/document/`+external_id+`/`+format, '_blank');
        }
        window.addEventListener('response_success_customer_store', event => {
           swalAlert(event.detail.message);
           setSelect2(event.detail.idperson,event.detail.nameperson);
        });
        function setSelect2(id,title){
            let html = '<option value="'+title+'" selected="selected">'+title+'</option>';
            $('#select2-ajax').html(html);
            $('#select2-ajax').trigger('change');
            $('#exampleModalClientNew').modal('hide');
            window.livewire.find('<?php echo e($_instance->id); ?>').set('customer_id', id);
        }
        document.addEventListener('livewire:load', function () {
            $("#datepicker-1").datepicker({
                format: 'dd/mm/yyyy',
                language:"<?php echo e(app()->getLocale()); ?>",
                autoclose:true
            }).datepicker('setDate','0');
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/document/note-create.blade.php ENDPATH**/ ?>