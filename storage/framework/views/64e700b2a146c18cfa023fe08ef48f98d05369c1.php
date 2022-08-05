<div class="p-3 bg-info-500 rounded overflow-hidden position-relative text-white mb-g">
    <div class="">
        <h3 class="display-4 d-block l-h-n m-0 fw-500">
            <?php echo e($quantity); ?>

            <small class="m-0 l-h-n"><?php echo e(($quantity==1?Lang::get('transferservice::labels.lbl_odt_request'):Lang::get('transferservice::labels.lbl_odt_requests'))); ?></small>
        </h3>
    </div>
    <i class="fal fa-paper-plane position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/TransferService\Resources/views/livewire/odtrequests/odtrequests-quantity.blade.php ENDPATH**/ ?>