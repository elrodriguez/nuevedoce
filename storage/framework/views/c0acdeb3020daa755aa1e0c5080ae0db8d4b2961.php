
<?php if($items_input ): ?>
<div class="subheader-block d-lg-flex align-items-center">
    <div class="d-inline-flex flex-column justify-content-center mr-3">
        <span class="fw-300 fs-xs d-block opacity-50">
            <small>Total Items</small>
        </span>
        <span class="fw-500 fs-xl d-block color-primary-500">
            <?php echo e($items_input); ?>

        </span>
    </div>
    <span class="sparklines hidden-lg-down" sparktype="bar" sparkbarcolor="#886ab5" sparkheight="32px" sparkbarwidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"><canvas width="85" height="32" style="display: inline-block; width: 85px; height: 32px; vertical-align: top;"></canvas></span>
</div>
<?php endif; ?>
<?php if($items_output): ?>
<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
    <div class="d-inline-flex flex-column justify-content-center mr-3">
        <span class="fw-300 fs-xs d-block opacity-50">
            <small>Total Salida Items</small>
        </span>
        <span class="fw-500 fs-xl d-block color-danger-500">
            <?php echo e($items_output); ?>

        </span>
    </div>
    <span class="sparklines hidden-lg-down" sparktype="bar" sparkbarcolor="#fe6bb0" sparkheight="32px" sparkbarwidth="5px" values="1,4,3,6,5,3,9,6,5,9,7"><canvas width="85" height="32" style="display: inline-block; width: 85px; height: 32px; vertical-align: top;"></canvas></span>
</div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/item/item-number-movements.blade.php ENDPATH**/ ?>