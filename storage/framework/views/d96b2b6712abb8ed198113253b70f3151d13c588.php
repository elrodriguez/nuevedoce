
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/datagrid/datatables/datatables.bundle.css')); ?>">
    <link rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')); ?>">
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
    <li class="breadcrumb-item"><?php echo app('translator')->get('inventory::labels.lbl_movements'); ?></li>
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
        <i class="fal fa-person-dolly"></i></i> <?php echo app('translator')->get('inventory::labels.lbl_movements'); ?><sup class='badge badge-primary fw-500'><?php echo app('translator')->get('inventory::labels.lbl_list'); ?></sup>
    </h1>
    <div class="subheader-block">
        <?php echo app('translator')->get('inventory::labels.lbl_inventory_list'); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::movements.movements-list', [])->html();
} elseif ($_instance->childHasBeenRendered('DuFAMSl')) {
    $componentId = $_instance->getRenderedChildComponentId('DuFAMSl');
    $componentTag = $_instance->getRenderedChildComponentTagName('DuFAMSl');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('DuFAMSl');
} else {
    $response = \Livewire\Livewire::mount('inventory::movements.movements-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('DuFAMSl', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::movements.movements-income-exit-modal', [])->html();
} elseif ($_instance->childHasBeenRendered('S1ZbZZp')) {
    $componentId = $_instance->getRenderedChildComponentId('S1ZbZZp');
    $componentTag = $_instance->getRenderedChildComponentTagName('S1ZbZZp');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('S1ZbZZp');
} else {
    $response = \Livewire\Livewire::mount('inventory::movements.movements-income-exit-modal', []);
    $html = $response->html();
    $_instance->logRenderedChild('S1ZbZZp', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::movements.movements-transfer-modal', [])->html();
} elseif ($_instance->childHasBeenRendered('WsgKT7z')) {
    $componentId = $_instance->getRenderedChildComponentId('WsgKT7z');
    $componentTag = $_instance->getRenderedChildComponentTagName('WsgKT7z');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('WsgKT7z');
} else {
    $response = \Livewire\Livewire::mount('inventory::movements.movements-transfer-modal', []);
    $html = $response->html();
    $_instance->logRenderedChild('WsgKT7z', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('inventory::movements.movements-remove-modal', [])->html();
} elseif ($_instance->childHasBeenRendered('x9K5ypB')) {
    $componentId = $_instance->getRenderedChildComponentId('x9K5ypB');
    $componentTag = $_instance->getRenderedChildComponentTagName('x9K5ypB');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('x9K5ypB');
} else {
    $response = \Livewire\Livewire::mount('inventory::movements.movements-remove-modal', []);
    $html = $response->html();
    $_instance->logRenderedChild('x9K5ypB', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url('themes/smart-admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(url('themes/smart-admin/js/formplugins/bootstrap-datepicker/locales/bootstrap-datepicker.'.Lang::locale().'.min.js')); ?>"></script>
    <script src="<?php echo e(url('themes/smart-admin/js/formplugins/autocomplete-bootstrap/bootstrap-autocomplete.min.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inventory::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/movements/index.blade.php ENDPATH**/ ?>