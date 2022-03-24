
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
    <li class="breadcrumb-item"><?php echo e(__('setting::labels.settings')); ?></li>
    <li class="breadcrumb-item active"><?php echo e(__('labels.parameters')); ?></li>
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
        <i class='subheader-icon fal fa-puzzle-piece'></i><?php echo e(__('labels.parameters')); ?> </span> <sup class='badge badge-primary fw-500'><?php echo e(__('labels.list')); ?></sup>
    </h1>
    <div class="subheader-block">
        <?php echo e(__('labels.list')); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('setting::parameters.parameters-list', [])->html();
} elseif ($_instance->childHasBeenRendered('6OAmcAZ')) {
    $componentId = $_instance->getRenderedChildComponentId('6OAmcAZ');
    $componentTag = $_instance->getRenderedChildComponentTagName('6OAmcAZ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('6OAmcAZ');
} else {
    $response = \Livewire\Livewire::mount('setting::parameters.parameters-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('6OAmcAZ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('setting::parameters.parameters-create', [])->html();
} elseif ($_instance->childHasBeenRendered('5zTlN1M')) {
    $componentId = $_instance->getRenderedChildComponentId('5zTlN1M');
    $componentTag = $_instance->getRenderedChildComponentTagName('5zTlN1M');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('5zTlN1M');
} else {
    $response = \Livewire\Livewire::mount('setting::parameters.parameters-create', []);
    $html = $response->html();
    $_instance->logRenderedChild('5zTlN1M', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('setting::parameters.parameters-edit', [])->html();
} elseif ($_instance->childHasBeenRendered('p5CTKtF')) {
    $componentId = $_instance->getRenderedChildComponentId('p5CTKtF');
    $componentTag = $_instance->getRenderedChildComponentTagName('p5CTKtF');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('p5CTKtF');
} else {
    $response = \Livewire\Livewire::mount('setting::parameters.parameters-edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('p5CTKtF', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('setting::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nuevedoce\Modules/Setting\Resources/views/parameters/index.blade.php ENDPATH**/ ?>