<div>
    <div wire:ignore.self class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="app-list w-auto h-auto p-0 text-left">
                        @if(count($shortcuts) > 0)
                            @foreach($shortcuts as $shortcut)
                                @can($shortcut->permission)
                                    <li>
                                        @can('configuraciones_acceso_directo_eliminar')
                                        <button onclick="confirmDeleteShortCut({{ $shortcut->id }})" class="btn btn-link m-0 p-0 text-center text-light" >{{ __('labels.delete') }}</button>
                                        @endcan
                                        <a href="{{ route($shortcut->route_name) }}" class="app-list-item text-white border-0 m-0">
                                            <div class="icon-stack">
                                                <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                                <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                <i class="{{ $shortcut->icon }} icon-stack-1x opacity-100 color-white"></i>
                                            </div>
                                            <span class="app-list-name">
                                                {{ $shortcut->name }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            @endforeach
                        @endif
                        @can('configuraciones_acceso_directo')
                        <li>
                            <a wire:click="$set('add_show', true)" href="javascript:void(0)" class="app-list-item text-white border-0 m-0">
                                <div class="icon-stack">
                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                    <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                                </div>
                                <span class="app-list-name">
                                    {{ __('setting::labels.add_more') }}
                                </span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                    @if($add_show)
                    <div class="container">
                        <h4 class="text-light">Nuevo Acceso directo</h4>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="icon">{{ __('setting::labels.icon') }} <span class="text-light">*</span> </label>
                                <input wire:model.defer="icon" type="text" class="form-control" id="icon">
                                @error('icon')
                                <div class="invalid-feedback-2 text-light">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="name">{{ __('labels.name') }} <span class="text-light">*</span> </label>
                                <input wire:model.defer="name" type="text" class="form-control" id="name">
                                @error('name')
                                <div class="invalid-feedback-2 text-light">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="route_name">{{ __('setting::labels.route') }}<span class="text-light">*</span> </label>
                                <input wire:model.defer="route_name" type="text" class="form-control" id="route_name">
                                @error('route_name')
                                <div class="invalid-feedback-2 text-light">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3" style="display: none">
                                <label class="form-label text-light" for="role_name">{{ __('setting::labels.role') }} <span class="text-light">*</span> </label>
                                <input wire:model.defer="role_name" type="text" class="form-control" id="role_name" disabled>
                                @error('role_name')
                                <div class="invalid-feedback-2 text-light">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="module_id">{{ __('setting::labels.modules') }} <span class="text-light">*</span> </label>
                                <select wire:model.defer="module_id" wire:change="getPermissions" class="custom-select" id="module_id">
                                    <option value="">{{ __('labels.to_select') }}</option>
                                    @foreach ($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->label }}</option>
                                    @endforeach
                                </select>
                                @error('module_id')
                                <div class="invalid-feedback-2 text-light">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light" for="permission_id">{{ __('setting::labels.permission') }} <span class="text-light">*</span> </label>
                                <select wire:model.defer="permission_id" class="custom-select" id="permission_id">
                                    <option value="">{{ __('labels.to_select') }}</option>
                                    @foreach ($permissions as $row)
                                    <option value="{{ $row->name }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                @error('permission_id')
                                <div class="invalid-feedback-2 text-light">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @if($add_show)
                <div class="modal-footer">
                    <button wire:click="$set('add_show', false)" type="button" class="btn btn-secondary">{{ __('labels.close') }}</button>
                    <button wire:click="saveShortCuts" type="button" class="btn btn-primary">{{ __('labels.save') }}</button>
                  </div>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-short-cut-save', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        function confirmDeleteShortCut(id){
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
                        @this.deleteshortcut(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }

        document.addEventListener('set-short-cut-delete', event => {
            let res = event.detail.res;

            if(res == 'success'){
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.success') }}!</span>",
                    message: "<span><strong>{{ __('inventory::labels.excellent') }}... </strong>{{ __('inventory::labels.msg_delete') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }else{
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-times-hexagon text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('setting::labels.error') }}!</span>",
                    message: "<span><strong>{{ __('setting::labels.went_wrong') }}... </strong>{{ __('setting::labels.msg_not_peptra') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(214, 36, 16, 0.5)'});
            }
        });
    </script>
</div>
