<div class="row">
    <?php if(count($series) > 0): ?>
        <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-6 col-xl-3">
            <div style="background: <?php echo e($serie['color']); ?>" class="p-3 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php echo e($serie['id'].'-'.$serie['correlative']); ?>

                        <small class="m-0 l-h-n"><?php echo e($serie['description']); ?></small>
                    </h3>
                </div>
                <i class="fal fa-file-invoice-dollar position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/dashboard/series.blade.php ENDPATH**/ ?>