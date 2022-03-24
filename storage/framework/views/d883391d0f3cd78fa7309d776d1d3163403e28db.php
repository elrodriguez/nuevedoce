<div class="">
    <div id="icon-list" class="row js-list-filter">
        <?php if($modules): ?>
            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 d-flex justify-content-center align-items-center mb-g">                                            
                    <?php if($module->destination_route): ?>
                    <a href="<?php echo e(route($module->destination_route)); ?>" class="border rounded bg-white p-0 m-0 d-flex flex-column w-100 h-200 js-showcase-icon shadow-hover-2">                                                
                        <div class="rounded-top color-fusion-300 w-100 bg-primary-300">
                            <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-3x hover-bg">                                                        
                                <i class="<?php echo e($module->logo); ?>"></i>                                                    
                            </div>                                                
                        </div>                                                
                        <div class="rounded-bottom p-1 w-100 d-flex justify-content-center align-items-center text-center">                                                    
                            <span class="d-block text-truncate text-muted"><?php echo e($module->label); ?></span>     
                        </div>                                         
                    </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\resources\views/livewire/dashboard.blade.php ENDPATH**/ ?>