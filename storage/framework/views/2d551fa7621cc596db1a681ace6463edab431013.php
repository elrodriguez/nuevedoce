<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="form-row" wire:ignore.self>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?php echo app('translator')->get('labels.product'); ?> <span class="text-danger">*</span> </label>
                    <input disabled data-url="<?php echo e(route('pharmacy_products_search')); ?>" class="form-control basicAutoComplete"  type="text" placeholder="Buscar producto" autocomplete="off" />
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
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="keyword"><?php echo app('translator')->get('pharmacy::labels.keyword'); ?> <span class="text-danger">*</span> </label>
                    <input wire:model.defer="keyword" type="text" class="form-control" id="keyword" required="">
                    <?php $__errorArgs = ['keyword'];
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
                    <label class="form-label" for="number"><?php echo app('translator')->get('labels.description'); ?> <span class="text-danger">*</span> </label>
                    <textarea wire:model.defer="description" type="text" class="form-control" id="description" required=""></textarea>
                    <?php $__errorArgs = ['description'];
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
        <div class="card-body border-top">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Productos</h4>
                    <div class="bg-warning-100 border border-warning rounded">
                        <div class="input-group p-2 mb-0">
                            <input wire:model.defer="search_item" wire:keydown.enter="searchItemsTwo" type="text" class="form-control shadow-inset-2 bg-warning-50 border-warning" id="js-list-msg-filter" placeholder="Filtrar lista">
                            <div class="input-group-append">
                                <div class="input-group-text bg-warning-500 border-warning">
                                    <i class="fal fa-search fs-xl"></i>
                                </div>
                            </div>
                        </div>
                        <!-- nav-menu-reset will reset the font colors -->
                        <ul id="js-list-msg" class="list-group px-2 pb-2 js-list-filter">
                            <?php $__currentLoopData = $xitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $xitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <?php echo e($xitem->name); ?>

                                        <div class="text-muted">
                                            <button wire:click="addItemRelated(<?php echo e($xitem->id); ?>,'<?php echo e($xitem->name); ?>')" type="button" class="btn btn-danger btn-sm btn-icon rounded-circle waves-effect waves-themed">
                                                <i class="fal fa-arrow-alt-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="text-center">
                            <?php echo e($xitems->links()); ?>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Productos Relacionados</h4>
                    <?php if(count($products) > 0): ?>
                        <div class="bg-warning-100 border border-warning rounded">
                            <ul class="list-group p-2">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <?php echo e($product['name']); ?>

                                            <div class="text-muted">
                                                <button wire:click="removeItemRelated(<?php echo e($k); ?>)" class="btn btn-danger btn-sm btn-icon rounded-circle waves-effect waves-themed">
                                                    <i class="fal fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                            <strong>Hacer click en</strong> &nbsp;
                            <button type="button" class="btn btn-dark btn-sm ml-auto btn-icon rounded-circle waves-effect waves-themed">
                                <i class="fal fa-arrow-alt-right"></i>
                            </button>&nbsp;
                            para agregar productos
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="<?php echo e(route('pharmacy_administration_products_related')); ?>" type="button" class="btn btn-secondary waves-effect waves-themed">Listado</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">Guardar</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('phar-related-save', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('livewire:load', function () {
            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                selectItemId(item.value);
            });
            $('.basicAutoComplete').autoComplete('set', { value: "<?php echo e($item_id); ?>", text: "<?php echo e($item_name); ?>" });
        });
        function selectItemId(id){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('item_id',id);
        }
        document.addEventListener('phar-related-exists', event => {
            Command: toastr["error"]("El producto ya fue agregado")

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 100,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Pharmacy\Resources/views/livewire/products/related-edit.blade.php ENDPATH**/ ?>