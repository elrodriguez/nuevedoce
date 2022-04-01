<div class="page-logo">
    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
        <?php if($this->company): ?>
            <?php if(file_exists(public_path('storage/'.$this->company->logo))): ?>
                <img src="<?php echo e(url('storage/'.$this->company->logo)); ?>" alt="<?php echo e(config('app.name', 'Laravel')); ?>" aria-roledescription="logo">
            <?php endif; ?>
            <span class="page-logo-text mr-1"><?php echo e($this->company->name); ?></span>
        <?php else: ?>
            <img src="<?php echo e(url('themes/smart-admin/img/logo.png')); ?>" alt="<?php echo e(config('app.name', 'Laravel')); ?>" aria-roledescription="logo">
            <span class="page-logo-text mr-1"><?php echo e(config('app.name', 'Laravel')); ?></span>
        <?php endif; ?>
        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
        <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
    </a>
</div><?php /**PATH C:\laragon\www\nuevedoce\resources\views/components/company-logo.blade.php ENDPATH**/ ?>