<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label" for="button-addon5">Rol</label>
                        <div class="input-group">
                            <input wire:model.defer="name" type="text" class="form-control" aria-describedby="button-addon5">
                            <div class="input-group-append">
                                <button wire:click="addRole" class="btn btn-primary waves-effect waves-themed" type="button" id="button-addon5"><i class="fal fa-plus mr-2"></i> Agregar</button>
                            </div>
                        </div>
                    </div>
                    @error('name')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">{{ __('setting::labels.actions') }}</th>
                        <th>{{ __('setting::labels.name') }}</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach($roles as $key => $role)
                    <tr>
                        <td class="text-center tdw-50 align-middle">{{ $key + 1 }}</td>
                        <td class="text-center tdw-50 align-middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fal fa-cogs"></i>
                                </button>
                                <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                    @can('configuraciones_roles_permisos')
                                    <a href="{{ route('setting_roles_permissions',$role->id) }}" class="dropdown-item">
                                        <i class="fal fa-lock-open-alt mr-1"></i>{{ __('setting::labels.permissions') }}
                                    </a>
                                    @endcan
                                    @can('configuraciones_roles_eliminar')
                                    <div class="dropdown-divider"></div>
                                    <button onclick="confirmDelete({{ $role->id }})" type="button" class="dropdown-item text-danger">
                                        <i class="fal fa-trash-alt mr-1"></i>{{ __('setting::labels.delete') }}
                                    </button>
                                    @endcan
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ $role->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        function confirmDelete(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
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
                        @this.removeRole(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('set-role-delete', event => {
            let res = event.detail.res;

            if(res == 'success'){
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('setting::labels.success') }}!</span>",
                    message: "<span><strong>{{ __('setting::labels.excellent') }}... </strong>{{ __('setting::labels.msg_delete') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }else{
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('setting::labels.error') }}!</span>",
                    message: "<span><strong>{{ __('setting::labels.went_wrong') }}... </strong>{{ __('setting::labels.msg_not_peptra') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }
            
        });
        document.addEventListener('set-role-save-add', event => {
            initApp.playSound('themes/smart-admin/media/sound', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-success mr-2'></i> <span class='text-success fw-500'>{{ __('setting::labels.success') }}!</span>",
                message: "<span><strong>{{ __('setting::labels.excellent') }}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
