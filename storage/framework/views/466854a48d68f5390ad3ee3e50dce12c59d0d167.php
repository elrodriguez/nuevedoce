<div>
    <div class="panel-container show">
        <form class="needs-validation <?php echo e(($errors->any()?'was-validated':'')); ?>" novalidate wire:ignore.self>
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-row">
                            <div class="col-md-7 mb-3">
                                <div wire:ignore>
                                    <label class="form-label">
                                        <?php echo app('translator')->get('labels.customer'); ?>
                                        <span class="ml-1"><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalClientNew">[ +Nuevo ]</a></span>
                                    </label>
                                    <input class="form-control basicAutoComplete" type="text" placeholder="<?php echo app('translator')->get('labels.search_customer'); ?>" data-url="<?php echo e(route('sales_customers_search')); ?>" autocomplete="off" />
                                </div>
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
                            <div class="col-md-5 mb-3">
                                <div wire:ignore>
                                    <label class="form-label">
                                        <?php echo app('translator')->get('labels.establishment'); ?>
                                    </label>
                                    <select id="establishment_id" wire:model.defer="establishment_id" class="custom-select">
                                        <option value=""><?php echo e(__('labels.to_select')); ?></option>
                                        <?php $__currentLoopData = $establishments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $establishment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($establishment->id); ?>" <?php echo e($establishment->main ? '' : 'disabled'); ?>><?php echo e($establishment->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['establishment_id'];
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
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div wire:ignore>
                                    <label class="form-label" for="select3-ajax">
                                        <?php echo app('translator')->get('labels.products'); ?>
                                    </label>
                                    <input class="form-control basicAutoCompleteProduct" type="text" placeholder="Buscar producto" autocomplete="off">
                                </div>
                                <?php $__errorArgs = ['item_id'];
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
                    <div class="col-md-6 mb-3">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
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
                            <div class="col-md-6 mb-3">
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
                                <?php $__errorArgs = ['correlative'];
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
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
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
                            <div class="col-md-6 mb-3" style="display: none">
                                <label class="form-label" for="f_expiration"><?php echo app('translator')->get('labels.f_expiration'); ?> <span class="text-danger">*</span> </label>
                                <div class="input-group">
                                    <input type="text" disabled class="form-control " name="f_expiration" wire:model="f_expiration" onchange="this.dispatchEvent(new InputEvent('input'))" id="datepicker-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text fs-xl">
                                            <i class="fal fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="example-textarea"><?php echo e(__('labels.additional_information')); ?></label>
                                <textarea class="form-control" id="example-textarea" rows="2" name="additional_information" wire:model.defer="additional_information"></textarea>
                            </div>
                        </div>
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
                                            <td colspan="10" class="dataTables_empty text-center" valign="top"><?php echo e(__('labels.no_records_to_display')); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <?php if(count($payment_method_types)>0): ?>
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
                    <div class="col-md-12 mb-3">
                        <h3>Métodos de pago
                            <span class="ml-1"><a href="javascript:void(0)" wire:click="newPaymentMethodTypes">[ +<?php echo e(__('labels.add')); ?> ]</a></span>
                        </h3>
                        <?php $__currentLoopData = $payment_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-row">

                                <div class="col-md-1 mb-3 align-middle">
                                    <?php if($key > 0): ?>
                                    <a href="javascript:void(0);" class="btn btn-dark btn-sm btn-icon waves-effect waves-themed" wire:click="removePaymentMethodTypes('<?php echo e($key); ?>')">
                                        <i class="fal fa-times"></i>
                                    </a>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-3 mb-3" wire:ignore.self>
                                    <label class="form-label" for="validationCustom01">Método de pago <span class="text-danger">*</span> </label>
                                    <select class="custom-select form-control" wire:model.defer="payment_method_types.<?php echo e($key); ?>.method">
                                        <?php $__currentLoopData = $cat_payment_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_payment_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat_payment_method_type->id); ?>"><?php echo e($cat_payment_method_type->description); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3" wire:ignore.self>
                                    <label class="form-label" for="validationCustom01">Destino <span class="text-danger">*</span> </label>
                                    <select class="custom-select form-control" wire:model.defer="payment_method_types.<?php echo e($key); ?>.destination">
                                        <?php $__currentLoopData = $cat_expense_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_expense_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat_expense_method_type['id']); ?>"><?php echo e($cat_expense_method_type['description']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Referencia <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" wire:model.defer="payment_method_types.<?php echo e($key); ?>.reference">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Monto <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control text-right" wire:model.defer="payment_method_types.<?php echo e($key); ?>.amount">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-md-9">
                        <button type="button" class="btn btn-primary btn-block waves-effect waves-themed" wire:loading.attr="disabled" wire:click="validateForm()">
                            <span wire:loading wire:target="validateForm" wire:loading.class="spinner-border spinner-border-sm" wire:loading.class.remove="fal fa-check" class="fal fa-check mr-2" role="status" aria-hidden="true"></span>
                            <span><?php echo e(__('sales::labels.generate')); ?></span>
                        </button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </form>
        
        <div class="modal fade" id="exampleModalClientNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('labels.new')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3"f>
                                <label class="form-label" for="identity_document_type_id">Tipo Doc. Identidad <span class="text-danger">*</span> </label>
                                <select class="custom-select form-control" wire:model="identity_document_type_id">
                                    <?php $__currentLoopData = $identity_document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $identity_document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($identity_document_type->id); ?>"><?php echo e($identity_document_type->description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['identity_document_type_id'];
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
                                <label class="form-label" for="number_id"><?php echo e(__('labels.number')); ?> <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="number_id" wire:model.defer="number_id">
                                <?php $__errorArgs = ['number_id'];
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
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="name"><?php echo e(__('labels.name')); ?> <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="name" wire:model.defer="name">
                                <?php $__errorArgs = ['name'];
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
                                <label class="form-label" for="last_paternal"><?php echo e(__('labels.last_paternal')); ?> <span class="text-danger">*</span> </label>
                                <input <?php echo e($identity_document_type_id == '6' ? 'disabled': ''); ?> type="text" class="form-control" name="last_paternal" wire:model.defer="last_paternal">
                                <?php $__errorArgs = ['last_paternal'];
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
                                <label class="form-label" for="last_maternal"><?php echo e(__('labels.last_maternal')); ?> <span class="text-danger">*</span> </label>
                                <input <?php echo e($identity_document_type_id == '6' ? 'disabled': ''); ?> type="text" class="form-control" name="last_maternal" wire:model.defer="last_maternal">
                                <?php $__errorArgs = ['last_maternal'];
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
                        <div class="form-row">
                            <div class="col-md-12 mb-3" wire:ignore.self>
                                <label class="form-label" for="trade_name"><?php echo e(__('labels.trade_name')); ?></label>
                                <input type="text" class="form-control" name="trade_name" wire:model.defer="trade_name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="department_id"><?php echo app('translator')->get('setting::labels.department'); ?> <span class="text-danger">*</span> </label>
                                <select wire:change="getProvinves" wire:model="department_id" id="department_id" class="custom-select" required="">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($department->id); ?>"><?php echo e($department->description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="province_id"><?php echo app('translator')->get('setting::labels.province'); ?> <span class="text-danger">*</span> </label>
                                <select wire:change="getPDistricts" wire:model="province_id" id="province_id" class="custom-select" required="">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($province->id); ?>"><?php echo e($province->description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['province_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="district_id"><?php echo app('translator')->get('setting::labels.district'); ?> <span class="text-danger">*</span> </label>
                                <select wire:model="district_id" id="district_id" class="custom-select" required="">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($district->id); ?>"><?php echo e($district->description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['district_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="sex"><?php echo app('translator')->get('labels.sex'); ?></label>
                                <select class="custom-select form-control" wire:model.defer="sex" id="sex" name="sex" required="">
                                    <option><?php echo app('translator')->get('labels.to_select'); ?></option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                                <?php $__errorArgs = ['sex'];
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('labels.close')); ?></button>
                        <button type="button" class="btn btn-primary" wire:click="storeClient"><?php echo e(__('labels.save')); ?></button>
                    </div>
                </div>
            </div>
        </div>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('labels.close')); ?></button>
                    <a href="<?php echo e(route('sales_document_list')); ?>" type="button" class="btn btn-primary"><?php echo e(__('labels.list')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {

            $("#datepicker-1").datepicker({
                format: 'dd/mm/yyyy',
                language:"<?php echo e(app()->getLocale()); ?>",
                autoclose:true
            }).datepicker('setDate','0');

            $("#datepicker-2").datepicker({
                format: 'dd/mm/yyyy',
                language:"<?php echo e(app()->getLocale()); ?>",
                autoclose:true
            }).datepicker('setDate','0');

            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                //console.log(item.value)
                selectCustomer(item.value);
            });

            $('.basicAutoComplete').autoComplete('set', { value: "<?php echo e($xgenerico->value); ?>", text: "<?php echo e($xgenerico->text); ?>" });

            $('.basicAutoCompleteProduct').autoComplete({
                resolver: 'custom',
                events: {
                    search: function (qry, callback) {
                        $.ajax(
                            "<?php echo e(route('sales_products_search')); ?>",
                            {
                                data: { 'qry': qry,'est':$('#establishment_id').val()}
                            }
                        ).done(function (res) {
                            callback(res)
                        });
                    }
                }
            }).on('autocomplete.select', function (evt, item) {
                selectProduct(item.value);
                $('.basicAutoCompleteProduct').autoComplete('clear');
            });

        });

        window.addEventListener('response_payment_total_different', event => {
            swalAlertError(event.detail.message);
        });
        function swalAlertError(msg){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-times-hexagon text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('setting::labels.error')); ?>!</span>",
                message: "<span><strong><?php echo e(__('setting::labels.went_wrong')); ?>... </strong>"+msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(214, 36, 16, 0.5)'});
        }
        function selectCustomer(val){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('customer_id', val);
        }
        function selectProduct(id){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('item_id', id);
            window.livewire.find('<?php echo e($_instance->id); ?>').clickAddItem();
        }
        function clearSelect2(){
            $('.basicAutoComplete').autoComplete('set', { value: "<?php echo e($xgenerico->value); ?>", text: "<?php echo e($xgenerico->text); ?>" });

        }

        window.addEventListener('response_clear_select_products_alert', event => {
            let showmsg = event.detail.showmsg;
            if(showmsg == true){
                swalAlert(event.detail.message)
            }
        });
        window.addEventListener('response_success_document_charges_store', event => {
           openModalPrint();
           clearSelect2();
        });
        window.addEventListener('response_customer_not_ruc_exists', event => {
            let msg = event.detail.message;
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>¡Error!</span>",
                message: "<span><strong>No se puede continuar... </strong>"+msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(206, 77, 62, 0.5)'});
        });
        function swalAlert(msg){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>¡Enhorabuena!</span>",
                message: "<span><strong><?php echo e(__('labels.lbl_excellent')); ?>... </strong>"+msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        }
        function openModalPrint(){
            $('#exampleModalprint').modal('show');
        }
        function printPDF(format){
            let external_id = $('#document_external_id').val();
            window.open(`print/`+external_id+`/`+format, '_blank');
        }
        window.addEventListener('response_success_customer_store', event => {
           swalAlert(event.detail.message);
           setSelect2(event.detail.idperson,event.detail.nameperson);
        });
        function setSelect2(id,title){
            $('.basicAutoComplete').autoComplete('set', { value: id, text: title });
            $('#exampleModalClientNew').modal('hide');
            window.livewire.find('<?php echo e($_instance->id); ?>').set('customer_id', id);
        }

    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/document/document-create-form.blade.php ENDPATH**/ ?>