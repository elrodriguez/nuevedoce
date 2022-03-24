
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
    <li class="breadcrumb-item">Configuraciones</li>
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
    <div class="subheader-block">
        Dashboard
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('setting::company.company-data')->html();
} elseif ($_instance->childHasBeenRendered('aYrDdDV')) {
    $componentId = $_instance->getRenderedChildComponentId('aYrDdDV');
    $componentTag = $_instance->getRenderedChildComponentTagName('aYrDdDV');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('aYrDdDV');
} else {
    $response = \Livewire\Livewire::mount('setting::company.company-data');
    $html = $response->html();
    $_instance->logRenderedChild('aYrDdDV', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <div class="col-sm-6 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('setting::establishment.establishment-quantity')->html();
} elseif ($_instance->childHasBeenRendered('YWHxRjG')) {
    $componentId = $_instance->getRenderedChildComponentId('YWHxRjG');
    $componentTag = $_instance->getRenderedChildComponentTagName('YWHxRjG');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('YWHxRjG');
} else {
    $response = \Livewire\Livewire::mount('setting::establishment.establishment-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('YWHxRjG', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('setting::roles.roles-quantity')->html();
} elseif ($_instance->childHasBeenRendered('hlNMeVY')) {
    $componentId = $_instance->getRenderedChildComponentId('hlNMeVY');
    $componentTag = $_instance->getRenderedChildComponentTagName('hlNMeVY');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('hlNMeVY');
} else {
    $response = \Livewire\Livewire::mount('setting::roles.roles-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('hlNMeVY', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <div class="col-sm-4 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('setting::modules.module-quantity')->html();
} elseif ($_instance->childHasBeenRendered('YN718LM')) {
    $componentId = $_instance->getRenderedChildComponentId('YN718LM');
    $componentTag = $_instance->getRenderedChildComponentTagName('YN718LM');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('YN718LM');
} else {
    $response = \Livewire\Livewire::mount('setting::modules.module-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('YN718LM', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <div class="col-sm-4 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('setting::user.user-quantity')->html();
} elseif ($_instance->childHasBeenRendered('iBqRT9f')) {
    $componentId = $_instance->getRenderedChildComponentId('iBqRT9f');
    $componentTag = $_instance->getRenderedChildComponentTagName('iBqRT9f');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('iBqRT9f');
} else {
    $response = \Livewire\Livewire::mount('setting::user.user-quantity');
    $html = $response->html();
    $_instance->logRenderedChild('iBqRT9f', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('setting::user.user-sessions')->html();
} elseif ($_instance->childHasBeenRendered('86Kxsnx')) {
    $componentId = $_instance->getRenderedChildComponentId('86Kxsnx');
    $componentTag = $_instance->getRenderedChildComponentTagName('86Kxsnx');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('86Kxsnx');
} else {
    $response = \Livewire\Livewire::mount('setting::user.user-sessions');
    $html = $response->html();
    $_instance->logRenderedChild('86Kxsnx', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <div class="col-sm-6 col-xl-3">

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('setting::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nuevedoce\Modules/Setting\Resources/views/index.blade.php ENDPATH**/ ?>