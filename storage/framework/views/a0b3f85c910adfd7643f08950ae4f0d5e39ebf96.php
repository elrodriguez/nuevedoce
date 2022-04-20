<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="product_id"><?php echo app('translator')->get('labels.products'); ?> <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <input data-url="<?php echo e(route('pharmacy_products_search')); ?>" class="form-control" id="product_id" type="text" placeholder="Buscar producto" autocomplete="off" />
                    </div>
                    <?php $__errorArgs = ['product_id'];
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
                    <label class="form-label" for="disease_id"><?php echo app('translator')->get('pharmacy::labels.diseases'); ?> <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <input data-url="<?php echo e(route('pharmacy_diseases_search')); ?>" type="text" class="form-control" id="disease_id" placeholder="Buscar enfermedad" autocomplete="off" >
                    </div>
                    <?php $__errorArgs = ['disease_id'];
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('labels.description')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($symptoms)>0): ?>
                                <?php $__currentLoopData = $symptoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symptom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($k); ?></td>
                                        <td><?php echo e($symptom->description); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="2" class="text-center"></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            $('#product_id').autoComplete().on('autocomplete.select', function (evt, item) {
                selectProductId(item.value);
            });
            $('#disease_id').autoComplete().on('autocomplete.select', function (evt, item) {
                selectDiseaseId(item.value);
            });
        });
        function selectProductId(id){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('product_id',id);
            $('#product_id').autoComplete('clear');
        }
        function selectDiseaseId(id){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('disease_id',id);
            $('#disease_id').autoComplete('clear');
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Pharmacy\Resources/views/livewire/medicines/medicines-create.blade.php ENDPATH**/ ?>