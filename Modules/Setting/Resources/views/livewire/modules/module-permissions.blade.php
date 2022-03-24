<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="button-addon5">Permiso</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ $module_name }}</span>
                            </div>
                            <input wire:model.defer="name" type="text" class="form-control" aria-describedby="button-addon5">
                            <div class="input-group-append">
                                <button wire:click="addPermission" class="btn btn-primary waves-effect waves-themed" type="button" id="button-addon5"><i class="fal fa-plus mr-2"></i> Agregar</button>
                            </div>
                        </div>
                    </div>
                    @error('permission_name')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fal fa-times"></i>
                    </span>
                </button>
                <div class="d-flex flex-start w-100">
                    <div class="mr-2 d-sm-none d-md-block">
                        <span class="icon-stack icon-stack-lg">
                            <i class="base base-6 icon-stack-3x opacity-100 color-primary-500"></i>
                            <i class="base base-10 icon-stack-2x opacity-100 color-primary-300 fa-flip-vertical"></i>
                            <i class="fal fa-info icon-stack-1x opacity-100 color-white"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-fill">
                        <div class="flex-fill">
                            <span class="h5">{{ __('setting::labels.about') }} {{ __('setting::labels.the') }} {{ __('setting::labels.permissions') }}</span>
                            <p>para poder usar los permisos debe de ser agregado en el middleware al momento de crear las rutas.</p>
                            <p>Ejemplo:</p> 
                            <code class="code-kbd">
                            Route::middleware(['middleware' => 'role_or_permission:conf_usuarios'])->get('list', 'UsersController@index')->name('setting_users');
                            </code>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($permissions)
                    @foreach($permissions as $k => $permission)
                        <div class="col-4 mt-2">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <div class="custom-control d-flex custom-switch">
                                            <input wire:click="changeState({{ $k }},{{ $permission['id'] }})" wire:model="permissions.{{ $k }}.status" id="eventlog-switch-{{ $k }}" type="checkbox" class="custom-control-input">
                                            <label class="custom-control-label fw-500" for="eventlog-switch-{{ $k }}">{{ $permission['name'] }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group-append">
                                    <button onclick="confirmDelete({{ $k }},{{ $permission['id'] }},{{ $permission['permission_id'] }})" class="btn btn-outline-default waves-effect waves-themed" type="button"><i class="fal fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('setting_modules')}}" type="button" class="btn btn-secondary waves-effect waves-themed">Listado</a>
        </div>
    </div>
    <script type="text/javascript">
        function confirmDelete(index,id,permission_id){
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
                        @this.removePermission(index,id,permission_id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('set-module-permission-delete', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('setting::labels.success') }}!</span>",
                message: "<span><strong>{{ __('setting::labels.excellent') }}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
