
<?php if($company): ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e($company->name); ?></a></li>
<?php else: ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">SmartAdmin</a></li>
<?php endif; ?><?php /**PATH C:\laragon\www\nuevedoce\resources\views/components/company-name.blade.php ENDPATH**/ ?>