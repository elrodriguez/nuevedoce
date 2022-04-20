<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="serie"><?php echo app('translator')->get('labels.name'); ?> <span class="text-danger">*</span> </label>
                    <input wire:model="name" type="text" class="form-control" id="name" required="">
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
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="number"><?php echo app('translator')->get('labels.description'); ?> <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <div class="js-summernote" id="descriptionDisease"></div>
                    </div>
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
                <div class="col-md-12 mb-3" >
                    <label class="form-label" for="number"><?php echo app('translator')->get('pharmacy::labels.causes'); ?> <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <div class="js-summernote" id="causesDisease"></div>
                    </div>
                    <?php $__errorArgs = ['causes'];
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
                <div class="col-md-12 mb-3">
                    <label class="form-label"><?php echo app('translator')->get('pharmacy::labels.disease'); ?> <span class="text-danger">*</span> </label>
                    <div class="custom-control custom-checkbox">
                        <input wire:model="fracture" type="checkbox" class="custom-control-input" id="fracture">
                        <label class="custom-control-label" for="fracture"><?php echo e(__('labels.yes')); ?></label>
                    </div>
                    <?php $__errorArgs = ['disease'];
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
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="<?php echo e(route('pharmacy_administration_diseases')); ?>" type="button" class="btn btn-secondary waves-effect waves-themed">Listado</a>
            <button onclick="saveDiseases()"  wire:target="updateDisease" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">Guardar</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('phar-diseases-save', event => {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});

            $('#descriptionDisease').summernote('reset');
            $('#causesDisease').summernote('reset');
        });
        document.addEventListener('livewire:load', function () {
            $('#descriptionDisease').summernote({
                height: 200,
                tabsize: 2,
                placeholder: "<?php echo e(__('pharmacy::labels.write_here')); ?>",
                dialogsFade: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            $('#causesDisease').summernote({
                height: 200,
                tabsize: 2,
                placeholder: "<?php echo e(__('pharmacy::labels.write_here')); ?>",
                dialogsFade: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        function saveDiseases(){
            let des = $('#descriptionDisease').summernote("code");
            let cau = $('#causesDisease').summernote("code");
            
            window.livewire.find('<?php echo e($_instance->id); ?>').set('description',des);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('causes',des);

            window.livewire.find('<?php echo e($_instance->id); ?>').saveDisease();
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Pharmacy\Resources/views/livewire/diseases/diseases-create.blade.php ENDPATH**/ ?>