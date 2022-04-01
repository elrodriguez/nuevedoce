<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group bg-white shadow-inset-2">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-default dropdown-toggle waves-effect waves-themed" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($show); ?></button>
                    <div class="dropdown-menu" style="">
                        <button class="dropdown-item" wire:click="$set('show', 10)">10</button>
                        <button class="dropdown-item" wire:click="$set('show', 20)">20</button>
                        <button class="dropdown-item" wire:click="$set('show', 50)">50</button>
                        <div role="separator" class="dropdown-divider"></div>
                        <button class="dropdown-item" wire:click="$set('show', 100)">100</button>
                        <button class="dropdown-item" wire:click="$set('show', 500)">500</button>
                    </div>
                </div>
                <div class="input-group-prepend">
                    <?php if($search): ?>
                        <button wire:click="$set('search', '')" type="button" class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    <?php else: ?>
                        <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    <?php endif; ?>
                </div>
                <input wire:keydown.enter="companiesSearch" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="Escriba aquí...">
                <div class="input-group-append">
                    <button wire:click="companiesSearch" class="btn btn-default waves-effect waves-themed" type="button">Buscar</button>
                    <a href="<?php echo e(route('setting_company_create')); ?>" class="btn btn-success waves-effect waves-themed" type="button"><?php echo e(__('setting::buttons.new')); ?></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div style="scroll:auto">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Acciones</th>
                        <th><?php echo e(__('labels.name')); ?></th>
                        <th>RUC</th>
                        <th><?php echo e(__('setting::labels.tradename')); ?></th>
                        <th><?php echo e(__('setting::labels.telephone')); ?></th>
                        <th><?php echo e(__('setting::labels.email')); ?></th>
                        <th>Representante</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo e($key + 1); ?></td>
                        <td class="text-center tdw-50 align-middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fal fa-cogs"></i>
                                </button>
                                <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuraciones_establecimientos_editar')): ?>
                                    <a href="<?php echo e(route('setting_company_edit',$company->id)); ?>" class="dropdown-item">
                                        <i class="fal fa-pencil-alt mr-1"></i><?php echo e(__('labels.edit')); ?>

                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuraciones_empresas_entorno_del_sistema')): ?>
                                    <a href="<?php echo e(route('setting_company_system_environment',$company->id)); ?>" class="dropdown-item">
                                        <i class="fal fa-tools mr-1"></i><?php echo e(__('setting::labels.system_environment')); ?>

                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuraciones_establecimientos_eliminar')): ?>
                                    <div class="dropdown-divider"></div>
                                    <button onclick="confirmDelete(<?php echo e($company->id); ?>)" type="button" class="dropdown-item text-danger">
                                        <i class="fal fa-trash-alt mr-1"></i><?php echo e(__('labels.delete')); ?>

                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle"><?php echo e($company->name); ?></td>
                        <td class="align-middle"><?php echo e($company->number); ?></td>
                        <td class="align-middle"><?php echo e($company->tradename); ?></td>
                        <td class="align-middle"><?php echo e($company->phone); ?></td>
                        <td class="align-middle"><?php echo e($company->email); ?></td>
                        <td class="align-middle"><?php echo e($company->representative_name); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="card-footer  pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto"><?php echo e($companies->links()); ?></div>
        </div>
    </div>
    <script type="text/javascript">
        function confirmDelete(id){
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> ¿Desea eliminar estos datos?",
                message: "<span><strong>Advertencia: </strong> ¡Esta acción no se puede deshacer!</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                {
                    confirm:
                    {
                        label: 'Si',
                        className: 'btn-danger shadow-0'
                    },
                    cancel:
                    {
                        label: 'No',
                        className: 'btn-default'
                    }
                },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        window.livewire.find('<?php echo e($_instance->id); ?>').deleteCompanies(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('set-company-delete', event => {
            let res = event.detail.res;

            if(res == 'success'){
                initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('setting::labels.success')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('setting::labels.excellent')); ?>... </strong><?php echo e(__('setting::labels.msg_delete')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }else{
                initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('setting::labels.error')); ?>!</span>",
                    message: "<span><strong><?php echo e(__('setting::labels.went_wrong')); ?>... </strong><?php echo e(__('setting::labels.msg_not_peptra')); ?></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Setting\Resources/views/livewire/company/company-list.blade.php ENDPATH**/ ?>