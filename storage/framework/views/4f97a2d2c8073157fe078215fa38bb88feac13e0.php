<div class="card mb-g">
    <div class="row row-grid no-gutters">
        <div class="col-12">
            <div class="p-3">
                <h2 class="mb-0 fs-xl">
                    Usuarios con sesiones hoy
                </h2>
            </div>
        </div>
        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-4">
            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                <?php if(file_exists(public_path('storage/person/'.$session->person_id.'/'.$session->person_id.'.png'))): ?>
                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('<?php echo e(asset('storage/person/'.$session->person_id.'/'.$session->person_id.'.png')); ?>'); background-size: cover;"></span>
                <?php else: ?>
                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('<?php echo e(ui_avatars_url(auth()->user()->name,32,'none')); ?>'); background-size: cover;"></span>
                <?php endif; ?>
                <span class="d-block text-truncate text-muted fs-xs mt-1"><?php echo e($session->name); ?></span>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Setting\Resources/views/livewire/user/user-sessions.blade.php ENDPATH**/ ?>