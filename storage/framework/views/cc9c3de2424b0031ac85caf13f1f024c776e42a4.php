
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/formplugins/dropzone/dropzone.css')); ?>">
<?php $__env->stopSection(); ?>
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
    <li class="breadcrumb-item"><a href="<?php echo e(route('inventory_item')); ?>"><?php echo app('translator')->get('inventory::labels.lbl_items'); ?></a></li>
    <li class="breadcrumb-item"><?php echo app('translator')->get('inventory::labels.lbl_images'); ?></li>
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
        <i class="ni ni-social-dropbox"></i></i> <?php echo app('translator')->get('inventory::labels.lbl_images'); ?> <span id="spaItemCreate"></span> <sup class='badge badge-primary fw-500'><?php echo app('translator')->get('inventory::labels.lbl_list'); ?></sup>
    </h1>
    <div class="subheader-block">
        <?php echo app('translator')->get('inventory::labels.lbl_images'); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::item.item-file', ['item_id' => $item_id])->html();
} elseif ($_instance->childHasBeenRendered('bySpgNf')) {
    $componentId = $_instance->getRenderedChildComponentId('bySpgNf');
    $componentTag = $_instance->getRenderedChildComponentTagName('bySpgNf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('bySpgNf');
} else {
    $response = \Livewire\Livewire::mount('inventory::item.item-file', ['item_id' => $item_id]);
    $html = $response->html();
    $_instance->logRenderedChild('bySpgNf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inventory::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/item/file.blade.php ENDPATH**/ ?>