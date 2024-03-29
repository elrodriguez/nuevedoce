
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
    <li class="breadcrumb-item"><?php echo app('translator')->get('inventory::labels.lbl_inventory'); ?></li>
    <li class="breadcrumb-item"><?php echo app('translator')->get('inventory::labels.assents'); ?></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block">
        <?php if (isset($component)) { $__componentOriginalab70499045def3ea46a51a0c5d10e7b6f1952525 = $component; } ?>
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
<?php endif; ?>
    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('subheader'); ?>
    <?php if($interfaz == '8'): ?>
        <h1 class="subheader-title">
            <i class="fal fa-barcode-alt"></i></i> <?php echo app('translator')->get('inventory::labels.assents'); ?><sup
                class='badge badge-primary fw-500'><?php echo app('translator')->get('inventory::labels.lbl_list'); ?></sup>
        </h1>
        <div class="subheader-block">
            <?php echo app('translator')->get('inventory::labels.lbl_list'); ?>
        </div>
    <?php else: ?>
        <h1 class="subheader-title">
            <i class="fal fa-garage"></i></i> Producto almacén<sup
                class='badge badge-primary fw-500'><?php echo app('translator')->get('inventory::labels.lbl_list'); ?></sup>
        </h1>
        <div class="subheader-block">
            <?php echo app('translator')->get('inventory::labels.lbl_list'); ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::asset.asset-list')->html();
} elseif ($_instance->childHasBeenRendered('C1U2CS6')) {
    $componentId = $_instance->getRenderedChildComponentId('C1U2CS6');
    $componentTag = $_instance->getRenderedChildComponentTagName('C1U2CS6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('C1U2CS6');
} else {
    $response = \Livewire\Livewire::mount('inventory::asset.asset-list');
    $html = $response->html();
    $_instance->logRenderedChild('C1U2CS6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inventory::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/asset/index.blade.php ENDPATH**/ ?>