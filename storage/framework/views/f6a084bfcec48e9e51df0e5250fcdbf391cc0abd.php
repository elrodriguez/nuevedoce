<div class="subheader-block d-lg-flex align-items-center">
    <div class="d-inline-flex flex-column justify-content-center">
        <span class="fw-300 fs-xs d-block opacity-50">
            <small>Total Gastos</small>
        </span>
        <span class="fw-500 fs-xl d-block color-danger-500">
            S/. <?php echo e(number_format($total, 2, '.', '')); ?>

        </span>
    </div>
    <span class="sparklines hidden-lg-down" sparktype="bar" sparkbarcolor="#fe6bb0" sparkheight="32px" sparkbarwidth="5px" values="1,4,3,6,5,3,9,6,5,9,7"><canvas width="85" height="32" style="display: inline-block; width: 85px; height: 32px; vertical-align: top;"></canvas></span>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/dashboard/total-expense.blade.php ENDPATH**/ ?>