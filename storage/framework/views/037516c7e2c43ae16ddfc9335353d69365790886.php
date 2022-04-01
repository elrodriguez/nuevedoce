<footer class="page-footer" role="contentinfo">
    <div class="d-flex align-items-center flex-1 text-muted">
        <span class="hidden-md-down fw-700"><?php echo e(\Carbon\Carbon::now()->format('Y')); ?> © <?php echo e(env('APP_NAME', 'Laravel')); ?> by&nbsp;<a href='<?php echo e(env('DEVELOPER_GITHUB', 'Laravel')); ?>' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'><?php echo e(env('DEVELOPER_NAME', 'Laravel')); ?></a></span>
    </div>
    <div>
        <ul class="list-table m-0">
            <li><a href="intel_introduction.html" class="text-secondary fw-700"><?php echo e(__('labels.about')); ?></a></li>
            <li class="pl-3"><a href="info_app_licensing.html" class="text-secondary fw-700"><?php echo e(__('labels.license')); ?></a></li>
            <li class="pl-3"><a href="info_app_docs.html" class="text-secondary fw-700"><?php echo e(__('labels.documentation')); ?></a></li>
            <li class="pl-3 fs-xl"><a href="<?php echo e(env('DEV_SALE_LINK')); ?>" class="text-secondary" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</footer><?php /**PATH C:\laragon\www\nuevedoce\resources\views/components/footer.blade.php ENDPATH**/ ?>