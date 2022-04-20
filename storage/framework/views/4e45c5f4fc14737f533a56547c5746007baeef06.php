<div>
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card mb-3" wire:ignore>
                <div class="card-header">
                    <?php echo e(__('labels.categories')); ?>

                </div>
                <div class="card-body">
                    <select class="" id="selectCategories" onclick="selectCatagories(event)">
                        <option value=""><?php echo e(__('labels.all')); ?></option>
                        <?php if(count($categories) > 0): ?>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="card" wire:ignore>
                <div class="card-header">
                    <?php echo e(__('labels.brands')); ?>

                </div>
                <div class="card-body">
                    <select class="" id="selectBrands" onclick="selectBrands(event)">
                        <option value=""><?php echo e(__('labels.all')); ?></option>
                        <?php if(count($brands) > 0): ?>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="input-group input-group-lg mb-3 shadow-1 rounded">
                <input wire:model.defer="search" wire:keydown.enter="searchProducts" type="text" class="form-control shadow-inset-2" id="filter-icon" aria-label="type 2 or more letters" placeholder="<?php echo e(__('labels.search')); ?> <?php echo e(__('labels.product')); ?>...">
                <div wire:click="searchProducts" class="input-group-append">
                    <button class="btn btn-primary hidden-sm-down waves-effect waves-themed" type="button"><i class="fal fa-search mr-lg-2"></i><span class="hidden-md-down"><?php echo e(__('labels.search')); ?></span></button>
                </div>
            </div>
            <?php if(count($products) > 0): ?>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item py-4 px-4">
                                <div class="media">
                                    <a wire:click="clickAddItem(<?php echo e($product['id']); ?>)" href="javascript:void(0)" class="mr-2">
                                        <?php if($product['image']): ?>
                                            <?php if(file_exists(public_path($product['image']))): ?>
                                                <img src="<?php echo e(url($product['image'])); ?>" alt="producto" width="64">
                                            <?php else: ?>
                                                <img src="<?php echo e(ui_avatars_url($product['name'],64,'none',false)); ?>" alt="producto">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <img src="<?php echo e(ui_avatars_url($product['name'],64,'none',false)); ?>" alt="producto">
                                        <?php endif; ?>
                                    </a>
                                    <div class="media-body">
                                        <a wire:click="clickAddItem(<?php echo e($product['id']); ?>)" href="javascript:void(0)"><h5 class="mt-0"><?php echo e($product['name']); ?></h5></a>
                                        <p class="text-info">
                                           <b><?php echo e(__('labels.code')); ?>: </b><?php echo e($product['patrimonial_code']); ?> - <b><?php echo e(__('labels.price')); ?>: </b><?php echo e($product['sale_price']); ?> - <b><?php echo e(__('labels.stock')); ?>: </b><?php echo e($product['stock']); ?> - <b><?php echo e(__('labels.brand')); ?>: </b><?php echo e($product['description']); ?> 
                                        </p>
                                        <?php if(count($product['related'])>0): ?>
                                            <?php $__currentLoopData = $product['related']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="media mt-3">
                                                <a wire:click="clickAddItem(<?php echo e($item['id']); ?>)" href="javascript:void(0)" class="mr-2">
                                                    <?php if($item['image']): ?>
                                                        <?php if(file_exists(public_path($item['image']))): ?>
                                                            <img src="<?php echo e(url($item['image'])); ?>" alt="producto" width="64">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(ui_avatars_url($item['name'],64,'none',false)); ?>" alt="producto">
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <img src="<?php echo e(ui_avatars_url($item['name'],64,'none',false)); ?>" alt="producto">
                                                    <?php endif; ?>
                                                </a>
                                                <div class="media-body">
                                                    <a wire:click="clickAddItem(<?php echo e($item['id']); ?>)" href="javascript:void(0)">
                                                        <h5 class="mt-0"><?php echo e($item['name']); ?></h5>
                                                    </a>
                                                    <p class="text-info"><b><?php echo e(__('labels.code')); ?>: </b><?php echo e($item['patrimonial_code']); ?> - <b><?php echo e(__('labels.price')); ?>: </b><?php echo e($item['sale_price']); ?> - <b><?php echo e(__('labels.stock')); ?>: </b><?php echo e($item['stock']); ?> - <b><?php echo e(__('labels.brand')); ?>: </b><?php echo e($item['description']); ?></p>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border mb-g sticky-top" >
                <!-- notice the additions of utility paddings and display properties on .card-header -->
                <div class="card-header bg-danger-700 pr-3 d-flex align-items-center flex-wrap">
                    <!-- we wrap header title inside a div tag with utility padding -->
                    <div>TOTAL A PAGAR</div>
                    <div class="card-title ml-auto">
                        <?php echo e(number_format($total, 2, '.', '')); ?>

                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-sm">
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
                                            <a href="javascript:void(0);" class="btn btn-dark btn-xs btn-icon waves-effect waves-themed" wire:click="removeItem(<?php echo e($key); ?>)">
                                                <i class="fal fa-times"></i>
                                            </a>
                                        </td>
                                        <td width="50%" class="align-middle"><?php echo e(json_decode($box_item['item'])->name); ?></td>
                                        <td class="align-middle text-right"><?php echo e($box_item['input_unit_price_value']); ?></td>
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
                <div class="card-footer bg-danger-700">
                    <button <?php echo e(count($box_items)>0 ? '' : 'disabled'); ?> type="button" class="btn btn-default" data-toggle="modal" data-target="#modalPharmacyPaymentsClient"><i class="fal fa-donate mr-1"></i> Pagar</button>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Modal Right -->
    <div wire:ignore.self id="modalPharmacyPaymentsClient" class="modal fade default-example-modal-right" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Datos del Comprobante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
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
                    <div class="card border mb-g">
                        <!-- notice the additions of utility paddings and display properties on .card-header -->
                        <div class="card-header bg-danger-700 pr-3 d-flex align-items-center flex-wrap">
                            <!-- we wrap header title inside a div tag with utility padding -->
                            <div class="card-title">
                                Métodos de pago
                            </div>
                            <button wire:click="newPaymentMethodTypes" type="button" class="btn btn-xs btn-info ml-auto waves-effect waves-themed">
                                <?php echo e(__('labels.add')); ?>

                            </button>
                        </div>
                        <div class="card-body p-0">
                            <table class="table m-0 table-sm table-striped">
                                <thead class="bg-info-900">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th><?php echo e(__('labels.type')); ?></th>
                                        <th class="text-center">Destino</th>
                                        <th class="text-center">Referencia</th>
                                        <th class="text-center">Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(count($payment_method_types)>0): ?>
                                    <?php $__currentLoopData = $payment_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center align-middle">
                                                <?php if($key > 0): ?>
                                                <a href="javascript:void(0);" class="btn btn-dark btn-xs btn-icon waves-effect waves-themed" wire:click="removePaymentMethodTypes('<?php echo e($key); ?>')">
                                                    <i class="fal fa-times"></i>
                                                </a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div wire:ignore.self>
                                                    <select class="custom-select form-control" wire:model.defer="payment_method_types.<?php echo e($key); ?>.method">
                                                        <?php $__currentLoopData = $cat_payment_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_payment_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($cat_payment_method_type->id); ?>"><?php echo e($cat_payment_method_type->description); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div wire:ignore.self>
                                                    <select class="custom-select form-control" wire:model.defer="payment_method_types.<?php echo e($key); ?>.destination">
                                                        <?php $__currentLoopData = $cat_expense_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_expense_method_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($cat_expense_method_type['id']); ?>"><?php echo e($cat_expense_method_type['description']); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class="form-control" wire:model.defer="payment_method_types.<?php echo e($key); ?>.reference">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class="form-control text-right" wire:model.defer="payment_method_types.<?php echo e($key); ?>.amount">
                                            </td>
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
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="input-group" wire:ignore>
                                <input class="form-control basicAutoComplete" type="text" placeholder="<?php echo app('translator')->get('labels.search_customer'); ?>" data-url="<?php echo e(route('pharmacy_customers_search')); ?>" autocomplete="off" />
                                <div class="input-group-append">
                                    <button class="btn btn-outline-default waves-effect waves-themed" type="button" data-toggle="modal" data-target="#exampleModalClientNew"><?php echo e(__('labels.new')); ?></button>
                                </div>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fal fa-times-circle mr-1"></i>
                        <?php echo e(__('labels.cancel')); ?>

                    </button>
                    <button type="button" class="btn btn-primary waves-effect waves-themed" wire:loading.attr="disabled" wire:click="validateForm">
                        <span wire:loading wire:target="validateForm" wire:loading.class="spinner-border spinner-border-sm" wire:loading.class.remove="fal fa-check" class="fal fa-check mr-1" role="status" aria-hidden="true"></span>
                        <span class="mr-5">PAGAR</span>
                        <span><?php echo e($total); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalClientNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('labels.new')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-4 mb-3"f>
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
                        <div class="col-md-4 mb-3">
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
                        <div class="col-md-6 mb-3">
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
                        <div class="col-md-3 mb-3">
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
                        <div class="col-md-3 mb-3">
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
                        <div class="col-md-3 mb-3">
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
                        <div class="col-md-3 mb-3">
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
                        <div class="col-md-3 mb-3">
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
                        <div class="col-md-3 mb-3">
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
                    <input type="hidden" id="document_type_print" value="<?php echo e($typePRINT); ?>">
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
            let xbody = document.querySelector('body');
            xbody.classList.contains('nav-function-minify');
            xbody.classList.add('nav-function-minify');

            $('#selectCategories').select2();
            $('#selectBrands').select2();

            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                selectCustomer(item.value);
            });

            $('.basicAutoComplete').autoComplete('set', { value: "<?php echo e($xgenerico->value); ?>", text: "<?php echo e($xgenerico->text); ?>" });
        });
        function selectCustomer(val){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('customer_id', val);
        }
        function selectBrands(event){
            let br = event.target.value;
            window.livewire.find('<?php echo e($_instance->id); ?>').set('brand_id',br);
        }
        function selectCatagories(event){
            let ct = event.target.value;
            window.livewire.find('<?php echo e($_instance->id); ?>').set('category_id',ct);
        }
        function swalAlert(msg){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='<?php echo e(env('BOOTBOX_SUCCESS_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'>¡Enhorabuena!</span>",
                message: "<span><strong><?php echo e(__('labels.lbl_excellent')); ?>... </strong>"+msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': '<?php echo e(env("BOOTBOX_SUCCESS_COLOR")); ?>'});
        }
        window.addEventListener('response_clear_select_products_alert', event => {
            let showmsg = event.detail.showmsg;
            if(showmsg == true){
                swalAlert(event.detail.message)
            }
        });
        window.addEventListener('response_success_customer_store', event => {
           swalAlert(event.detail.message);
           setAutocomplet(event.detail.idperson,event.detail.nameperson);
        });
        function setAutocomplet(id,title){
            $('.basicAutoComplete').autoComplete('set', { value: id, text: title });
            $('#exampleModalClientNew').modal('hide');
            window.livewire.find('<?php echo e($_instance->id); ?>').set('customer_id', id);
        }
        window.addEventListener('response_success_document_charges_store', event => {
           openModalPrint();
           $('.basicAutoComplete').autoComplete('set', { value: "<?php echo e($xgenerico->value); ?>", text: "<?php echo e($xgenerico->text); ?>" });
        });
        function openModalPrint(){
            $('#exampleModalprint').modal('show');
        }
        function printPDF(format){
            let external_id = $('#document_external_id').val();
            let typePRINT = $('#document_type_print').val();
            window.open(`print/`+external_id+`/`+format+`/`+typePRINT, '_blank');
        }
        window.addEventListener('response_customer_not_ruc_exists', event => {
            let msg = event.detail.message;
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='<?php echo e(env('BOOTBOX_ERROR_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'>¡Error!</span>",
                message: "<span><strong>No se puede continuar... </strong>"+msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': '<?php echo e(env("BOOTBOX_ERROR_COLOR")); ?>'});
        });
        window.addEventListener('response_payment_total_different', event => {
            swalAlertError(event.detail.message);
        });
        function swalAlertError(msg){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='<?php echo e(env('BOOTBOX_ERROR_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('setting::labels.error')); ?>!</span>",
                message: "<span><strong><?php echo e(__('setting::labels.went_wrong')); ?>... </strong>"+msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': '<?php echo e(env("BOOTBOX_ERROR_COLOR")); ?>'});
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Pharmacy\Resources/views/livewire/sales/sales-create.blade.php ENDPATH**/ ?>