<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation <?php echo e($errors->any() ? 'was-validated' : ''); ?>" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="supplier_id"><?php echo app('translator')->get('inventory::labels.lbl_supplier'); ?> </label>
                        <select wire:model="supplier_id" id="supplier_id" class="custom-select" required="">
                            <option value=""><?php echo app('translator')->get('inventory::labels.lbl_select'); ?></option>
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->full_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['supplier_id'];
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
                        <label class="form-label" for="document_type_id"><?php echo app('translator')->get('inventory::labels.lbl_document_type'); ?>
                        </label>
                        <select wire:model="document_type_id" id="document_type_id" class="custom-select" required="">
                            <option value=""><?php echo app('translator')->get('inventory::labels.lbl_select'); ?></option>
                            <?php $__currentLoopData = $document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->description); ?></option>
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
                        <label class="form-label" for="date_of_issue"><?php echo app('translator')->get('inventory::labels.lbl_date_of_issue'); ?>
                            <span class="text-danger">*</span> </label>
                        <input wire:model="date_of_issue" type="text" class="form-control" id="date_of_issue"
                            required="" onchange="this.dispatchEvent(new InputEvent('input'))"
                            data-inputmask="'mask': '99/99/9999'" im-insert="true">
                        <?php $__errorArgs = ['date_of_issue'];
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
                        <label class="form-label" for="serie"><?php echo app('translator')->get('inventory::labels.lbl_serie'); ?> <span
                                class="text-danger">*</span> </label>
                        <input wire:model="serie" type="text" id="serie" class="form-control" required>
                        <?php $__errorArgs = ['serie'];
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
                        <label class="form-label" for="number"><?php echo app('translator')->get('inventory::labels.lbl_number'); ?> <span
                                class="text-danger">*</span> </label>
                        <input wire:model="number" type="number" id="number" class="form-control" required>
                        <?php $__errorArgs = ['number'];
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
                    <div class="col-md-3 mb-3" wire:ignore>
                        <label class="form-label" for="total"><?php echo app('translator')->get('inventory::labels.lbl_total'); ?> <span
                                class="text-danger">*</span> </label>
                        <input wire:model="total" type="number" class="form-control" id="total" required="">
                        <?php $__errorArgs = ['total'];
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
                        <label class="form-label"
                            for="establishment_id"><?php echo app('translator')->get('inventory::labels.lbl_establishment'); ?> </label>
                        <select wire:change="getStores" wire:model="establishment_id" id="establishment_id"
                            class="custom-select" required="">
                            <option value=""><?php echo app('translator')->get('inventory::labels.lbl_select'); ?></option>
                            <?php $__currentLoopData = $establishments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="store_id"><?php echo app('translator')->get('inventory::labels.lbl_store'); ?> </label>
                        <select wire:model="store_id" id="store_id" class="custom-select" required="">
                            <option value=""><?php echo app('translator')->get('inventory::labels.lbl_select'); ?></option>
                            <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['store_id'];
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
                <br>
                <div id="xyzDivPartesItems" wire:ignore.self>
                    <h2 class="fw-700 m-0"><i class="subheader-icon fal fa-wrench"></i>
                        <?php echo app('translator')->get('inventory::labels.lbl_add'); ?> <?php echo app('translator')->get('inventory::labels.lbl_items'); ?>:</h2>
                    <br>
                    <div class="form-row">
                        <div class="col-md-4 mb-3" wire:ignore>
                            <label class="form-label" for="item_text"><?php echo app('translator')->get('inventory::labels.lbl_item'); ?> <span
                                    class="text-danger">*</span> </label>
                            <input wire:model="item_text" id="item_text" required=""
                                class="form-control basicAutoComplete" type="text"
                                placeholder="Ingrese la parte a buscar y luego seleccione."
                                data-url="<?php echo e(route('inventory_purchase_search')); ?>" autocomplete="off" />
                            <input wire:model="item_id" id="item_id" type="hidden" placeholder="" autocomplete="off" />
                            <?php $__errorArgs = ['part_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php $__errorArgs = ['item_text'];
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
                        <div class="col-md-2 mb-3">
                            <label class="form-label" for="item_amount"><?php echo app('translator')->get('inventory::labels.lbl_amount'); ?> <span
                                    class="text-danger">*</span> </label>
                            <input wire:model="item_amount" type="item_amount" class="form-control" id="amount"
                                min="1" required="">
                            <?php $__errorArgs = ['item_amount'];
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
                            <label class="form-label" for="item_price"><?php echo app('translator')->get('inventory::labels.lbl_purchase_price'); ?>
                            </label>
                            <input wire:model="item_price" type="number" class="form-control" id="item_price" min="1">
                            <?php $__errorArgs = ['item_price'];
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
                        <div class="col-md-2 mb-3" style="margin-top: 23px;">
                            <a onclick="validateSaveItem()" wire:loading.attr="disabled"
                                class="btn btn-primary ml-auto waves-effect waves-themed" style="color: white;"><i
                                    class="fal fa-plus"></i> <?php echo app('translator')->get('inventory::labels.lbl_add'); ?></a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?php echo e(__('labels.actions')); ?></th>
                                            <th><?php echo e(__('labels.name')); ?></th>
                                            <th class="text-center"><?php echo e(__('labels.quantity')); ?></th>
                                            <th class="text-center">
                                                <?php echo e(__('inventory::labels.lbl_purchase_price')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <button wire:click="deleteItem(<?php echo e($item['item_id']); ?>)"
                                                        type="button"
                                                        class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed">
                                                        <i class="fal fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                <td class="align-middle"><?php echo e($item['item_text']); ?></td>
                                                <td class="text-center align-middle"><?php echo e($item['amount']); ?></td>
                                                <td class="align-middle text-right">
                                                    <?php echo e(number_format($item['price'], 2, '.', ' ')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="<?php echo e(route('inventory_purchase')); ?>" type="button"
                class="btn btn-secondary waves-effect waves-themed"><?php echo app('translator')->get('inventory::labels.lbl_list'); ?></a>
            <button wire:click="save" wire:loading.attr="disabled" type="button"
                class="btn btn-info ml-auto waves-effect waves-themed"><?php echo app('translator')->get('inventory::labels.btn_save'); ?></button>
        </div>
    </div>
    <script type="text/javascript">
        function validateSaveItem() {
            let id_pp = $("#item_id").val();
            if (id_pp > 0) {
                $('#item_text').css('color', '');
                $('#item_text').css('border-color', '');
                window.livewire.find('<?php echo e($_instance->id); ?>').saveItem();
            } else {
                alert("Busque y seleccione el Item ha agregar.");
                $('#item_text').css('color', 'red');
                $('#item_text').css('border-color', 'red');
            }
        }

        document.addEventListener('inv-purchase-save', event => {
            initApp.playSound('<?php echo e(url('themes/smart-admin/media/sound')); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.success')); ?>!</span>",
                message: "<span><strong><?php echo e(__('inventory::labels.excellent')); ?>... </strong>" + event
                    .detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({
                'background-color': 'rgba(122, 85, 7, 0.5)'
            });
        });

        document.addEventListener('inv-purchase-save-not', event => {
            initApp.playSound('<?php echo e(url('themes/smart-admin/media/sound')); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.lbl_warning')); ?>!</span>",
                message: "<span>" + event.detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({
                'background-color': 'rgba(122, 85, 7, 0.5)'
            });
        });

        document.addEventListener('livewire:load', function() {
            $(":input").inputmask();
            var controls = {
                leftArrow: "<i class='fal fa-angle-left' style='font-size: 1.25rem'></i>",
                rightArrow: "<i class='fal fa-angle-right' style='font-size: 1.25rem'></i>"
            }

            $("#date_of_issue").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e) {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('date_of_issue', this.value);
            });

            //Autocomplete
            $('.basicAutoComplete').autoComplete({
                autoSelect: true,
            }).on('autocomplete.select', function(evt, item) {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('item_id', item.value);
                window.livewire.find('<?php echo e($_instance->id); ?>').set('item_text', item.text);
            });
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/purchase/purchase-create.blade.php ENDPATH**/ ?>