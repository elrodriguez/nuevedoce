<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation <?php echo e($errors->any() ? 'was-validated' : ''); ?>" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="category_id"><?php echo app('translator')->get('restaurant::labels.categories'); ?> </label>
                        <div wire:ignore>
                            <input type="text" id="justAnotherInputBox" placeholder="Escriba para filtrar"
                                autocomplete="off" />
                        </div>
                        <?php $__errorArgs = ['category_id'];
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
                        <label class="form-label" for="description"><?php echo app('translator')->get('labels.description'); ?> <span
                                class="text-danger">*</span> </label>
                        <input wire:model="description" type="text" class="form-control" id="description" required="">
                        <?php $__errorArgs = ['description'];
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
                        <label class="form-label"><?php echo app('translator')->get('labels.state'); ?> <span class="text-danger">*</span>
                        </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="status" type="checkbox" class="custom-control-input" id="status"
                                checked="">
                            <label class="custom-control-label" for="status">Activo</label>
                        </div>
                        <?php $__errorArgs = ['status'];
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

            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="<?php echo e(route('restaurant_categories_list')); ?>" type="button"
                class="btn btn-secondary waves-effect waves-themed"><?php echo e(__('labels.list')); ?></a>
            <button onclick="saveRestCategories()" wire:target="saveCategories" wire:loading.attr="disabled"
                type="button" class="btn btn-info ml-auto waves-effect waves-themed"><?php echo e(__('labels.save')); ?></button>
        </div>
    </div>
    <script type="text/javascript">
        var comboTree2 = null;
        document.addEventListener('set-category-save', event => {
            initApp.playSound('<?php echo e(url('themes/smart-admin/media/sound')); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='<?php echo e(env('BOOTBOX_SUCCESS_ICON')); ?> text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>" + event.detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false,
                callback: function() {
                    location.reload();
                }
            });

            box.find('.modal-content').css({
                'background-color': "<?php echo e(env('BOOTBOX_SUCCESS_COLOR')); ?>"
            });

        });

        document.addEventListener('livewire:load', function() {

            let SampleJSONData = <?php
    if (is_object($categories) || is_array($categories)) {
        echo "JSON.parse(atob('".base64_encode(json_encode($categories))."'))";
    } elseif (is_string($categories)) {
        echo "'".str_replace("'", "\'", $categories)."'";
    } else {
        echo json_encode($categories);
    }
?>;

            comboTree2 = $('#justAnotherInputBox').comboTree({
                source: SampleJSONData,
                isMultiple: false,
                collapse: true,
                selectableLastNode: true,
            });

        });

        function saveRestCategories() {
            let cat = comboTree2.getSelectedIds();
            window.livewire.find('<?php echo e($_instance->id); ?>').set('category_id', cat);
            window.livewire.find('<?php echo e($_instance->id); ?>').saveCategories();
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Restaurant\Resources/views/livewire/categories/categories-create.blade.php ENDPATH**/ ?>