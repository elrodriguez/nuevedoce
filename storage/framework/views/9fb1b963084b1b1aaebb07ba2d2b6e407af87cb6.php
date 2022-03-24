<div class="info-card">
    <?php if(file_exists(public_path('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png'))): ?>
    <img src="<?php echo e(asset('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png')); ?>" class="profile-image rounded-circle" alt="<?php echo e(auth()->user()->name); ?>">
    <?php else: ?>
    <img src="<?php echo e(ui_avatars_url(auth()->user()->name,50,'none')); ?>" class="profile-image rounded-circle" alt="<?php echo e(auth()->user()->name); ?>">
    <?php endif; ?>
    <div class="info-card-text">
        <a href="#" class="d-flex align-items-center text-white">
            <span class="text-truncate text-truncate-sm d-inline-block">
                <?php echo e(auth()->user()->name); ?>

            </span>
        </a>
        <span class="d-inline-block text-truncate text-truncate-sm"><?php echo e(auth()->user()->email); ?></span>
    </div>
    <img src="<?php echo e(url('themes/smart-admin/img/card-backgrounds/cover-2-lg.png')); ?>" class="cover" alt="cover">
    <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
        <i class="fal fa-angle-down"></i>
    </a>
</div><?php /**PATH C:\laragon\www\nuevedoce\resources\views/components/info-card-user.blade.php ENDPATH**/ ?>