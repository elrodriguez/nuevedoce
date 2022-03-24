
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
    <li class="breadcrumb-item"><?php echo e(__('inventory::labels.module_name')); ?></li>
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
    $html = \Livewire\Livewire::mount('inventory::item.item-number-movements')->html();
} elseif ($_instance->childHasBeenRendered('4ziHNbp')) {
    $componentId = $_instance->getRenderedChildComponentId('4ziHNbp');
    $componentTag = $_instance->getRenderedChildComponentTagName('4ziHNbp');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('4ziHNbp');
} else {
    $response = \Livewire\Livewire::mount('inventory::item.item-number-movements');
    $html = $response->html();
    $_instance->logRenderedChild('4ziHNbp', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-4 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::location.location-quantity')->html();
} elseif ($_instance->childHasBeenRendered('9Fqr3bz')) {
    $componentId = $_instance->getRenderedChildComponentId('9Fqr3bz');
    $componentTag = $_instance->getRenderedChildComponentTagName('9Fqr3bz');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('9Fqr3bz');
} else {
    $response = \Livewire\Livewire::mount('inventory::location.location-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('9Fqr3bz', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <div class="col-sm-4 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::category.category-quantity')->html();
} elseif ($_instance->childHasBeenRendered('9oHm8fx')) {
    $componentId = $_instance->getRenderedChildComponentId('9oHm8fx');
    $componentTag = $_instance->getRenderedChildComponentTagName('9oHm8fx');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('9oHm8fx');
} else {
    $response = \Livewire\Livewire::mount('inventory::category.category-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('9oHm8fx', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <div class="col-sm-4 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::brand.brand-quantity')->html();
} elseif ($_instance->childHasBeenRendered('mYbn1Fx')) {
    $componentId = $_instance->getRenderedChildComponentId('mYbn1Fx');
    $componentTag = $_instance->getRenderedChildComponentTagName('mYbn1Fx');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('mYbn1Fx');
} else {
    $response = \Livewire\Livewire::mount('inventory::brand.brand-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('mYbn1Fx', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::item.item-quantity')->html();
} elseif ($_instance->childHasBeenRendered('DuNmc1W')) {
    $componentId = $_instance->getRenderedChildComponentId('DuNmc1W');
    $componentTag = $_instance->getRenderedChildComponentTagName('DuNmc1W');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('DuNmc1W');
} else {
    $response = \Livewire\Livewire::mount('inventory::item.item-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('DuNmc1W', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <div class="col-sm-4 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::asset.asset-quantity')->html();
} elseif ($_instance->childHasBeenRendered('dTKo1fG')) {
    $componentId = $_instance->getRenderedChildComponentId('dTKo1fG');
    $componentTag = $_instance->getRenderedChildComponentTagName('dTKo1fG');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('dTKo1fG');
} else {
    $response = \Livewire\Livewire::mount('inventory::asset.asset-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('dTKo1fG', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <div class="col-sm-4 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::purchase.purchase-quantity')->html();
} elseif ($_instance->childHasBeenRendered('AZBB1xd')) {
    $componentId = $_instance->getRenderedChildComponentId('AZBB1xd');
    $componentTag = $_instance->getRenderedChildComponentTagName('AZBB1xd');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('AZBB1xd');
} else {
    $response = \Livewire\Livewire::mount('inventory::purchase.purchase-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('AZBB1xd', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inventory::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/index.blade.php ENDPATH**/ ?>