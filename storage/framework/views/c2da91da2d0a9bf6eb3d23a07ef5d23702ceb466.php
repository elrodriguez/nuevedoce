<div>
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-4">
                        <label class="form-label" for="example-select"><?php echo e(__('labels.category')); ?></label>
                        <div wire:ignore>
                            <input type="text" id="justAnotherInputBox" placeholder="Escriba para filtrar"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label"
                            for="example-select"><?php echo e(__('restaurant::labels.commands')); ?></label>
                        <input wire:model.defer="search" type="text" class="form-control">
                    </div>
                    <div class="col-4">
                        <button onclick="searchRestCommand()" type="button"
                            class="btn btn-default waves-effect waves-themed"><?php echo e(__('labels.search')); ?></button>
                        <a href="<?php echo e(route('restaurant_commands_create')); ?>"
                            class="btn btn-success waves-effect waves-themed" type="button"><?php echo e(__('labels.new')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-columns">
        <?php $__currentLoopData = $commands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card">
                <?php if($command->image): ?>
                    <img src="<?php echo e(url($command->image)); ?>" class="card-img-top" alt="Comanda" height="250px">
                <?php endif; ?>
                <div class="card-body">
                    <h4 class="card-title"><?php echo e($command->description); ?></h4>
                    <dl class="row">
                        <dt class="col-sm-4"><?php echo e(__('labels.code')); ?></dt>
                        <dd class="col-sm-8">: <?php echo e($command->internal_id); ?></dd>
                        <dt class="col-sm-4"><?php echo e(__('labels.stock')); ?></dt>
                        <dd class="col-sm-8">: <?php echo e($command->stock); ?></dd>
                        <dt class="col-sm-4"><?php echo e(__('labels.price')); ?></dt>
                        <dd class="col-sm-8">: <?php echo e($command->price); ?></dd>
                    </dl>
                </div>
                <div class="card-body">
                    <a href="<?php echo e(route('restaurant_commands_edit', $command->id)); ?>"
                        class="card-link"><?php echo e(__('labels.edit')); ?>

                    </a>
                    <a href="#" class="card-link"><?php echo e(__('labels.delete')); ?></a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mb-3  pb-0 d-flex flex-row align-items-center">
        <div class="ml-auto"><?php echo e($commands->links()); ?></div>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {

            let SampleJSONData = <?php
    if (is_object($categories) || is_array($categories)) {
        echo "JSON.parse(atob('".base64_encode(json_encode($categories))."'))";
    } elseif (is_string($categories)) {
        echo "'".str_replace("'", "\'", $categories)."'";
    } else {
        echo json_encode($categories);
    }
?>;

            comboTree2 = $('#justAnotherInputBox').comboTree({
                source: SampleJSONData,
                isMultiple: false,
                collapse: true,
                selectableLastNode: true,
            });

        });

        function searchRestCommand() {
            let cat = comboTree2.getSelectedIds();
            window.livewire.find('<?php echo e($_instance->id); ?>').set('category_id', cat);
            window.livewire.find('<?php echo e($_instance->id); ?>').searchCommands();
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Restaurant\Resources/views/livewire/commands/commands-list.blade.php ENDPATH**/ ?>