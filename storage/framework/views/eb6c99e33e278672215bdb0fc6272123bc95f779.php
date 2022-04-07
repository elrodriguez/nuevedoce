
<?php $__env->startSection('breadcrumb'); ?>
    <?php if (isset($component)) { $__componentOriginalffde9e6d15fb644ab927a95d1432ec09268242d9 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\CompanyName::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('company-name'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\CompanyName::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalffde9e6d15fb644ab927a95d1432ec09268242d9)): ?>
<?php $component = $__componentOriginalffde9e6d15fb644ab927a95d1432ec09268242d9; ?>
<?php unset($__componentOriginalffde9e6d15fb644ab927a95d1432ec09268242d9); ?>
<?php endif; ?>
    <li class="breadcrumb-item"><?php echo e(__('lend::labels.module_name')); ?></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><?php if (isset($component)) { $__componentOriginalab70499045def3ea46a51a0c5d10e7b6f1952525 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\JsGetDate::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('js-get-date'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\JsGetDate::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab70499045def3ea46a51a0c5d10e7b6f1952525)): ?>
<?php $component = $__componentOriginalab70499045def3ea46a51a0c5d10e7b6f1952525; ?>
<?php unset($__componentOriginalab70499045def3ea46a51a0c5d10e7b6f1952525); ?>
<?php endif; ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('subheader'); ?>
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-tachometer-alt-fast'></i>Tablero <span class='fw-300'>de resumen</span> <sup class='badge badge-primary fw-500'>New</sup>
        <small>Disponibles para el usuario</small>
    </h1>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('sales::dashboard.total-expense', [])->html();
} elseif ($_instance->childHasBeenRendered('l3qZmt6')) {
    $componentId = $_instance->getRenderedChildComponentId('l3qZmt6');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3qZmt6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3qZmt6');
} else {
    $response = \Livewire\Livewire::mount('sales::dashboard.total-expense', []);
    $html = $response->html();
    $_instance->logRenderedChild('l3qZmt6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('sales::dashboard.total-sales', [])->html();
} elseif ($_instance->childHasBeenRendered('pxEXJQy')) {
    $componentId = $_instance->getRenderedChildComponentId('pxEXJQy');
    $componentTag = $_instance->getRenderedChildComponentTagName('pxEXJQy');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('pxEXJQy');
} else {
    $response = \Livewire\Livewire::mount('sales::dashboard.total-sales', []);
    $html = $response->html();
    $_instance->logRenderedChild('pxEXJQy', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12 col-sm-6">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('sales::dashboard.total-document', [])->html();
} elseif ($_instance->childHasBeenRendered('KmxD05j')) {
    $componentId = $_instance->getRenderedChildComponentId('KmxD05j');
    $componentTag = $_instance->getRenderedChildComponentTagName('KmxD05j');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('KmxD05j');
} else {
    $response = \Livewire\Livewire::mount('sales::dashboard.total-document', []);
    $html = $response->html();
    $_instance->logRenderedChild('KmxD05j', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
        <div class="col-12 col-sm-6">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('sales::dashboard.series', [])->html();
} elseif ($_instance->childHasBeenRendered('cmiCZDN')) {
    $componentId = $_instance->getRenderedChildComponentId('cmiCZDN');
    $componentTag = $_instance->getRenderedChildComponentTagName('cmiCZDN');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('cmiCZDN');
} else {
    $response = \Livewire\Livewire::mount('sales::dashboard.series', []);
    $html = $response->html();
    $_instance->logRenderedChild('cmiCZDN', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script src="<?php echo e(url('themes/smart-admin/js/statistics/flot/flot.bundle.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sales::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/index.blade.php ENDPATH**/ ?>