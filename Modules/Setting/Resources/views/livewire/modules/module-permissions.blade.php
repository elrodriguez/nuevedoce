<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
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
                                    <button wire:click="removePermission({{ $k }},{{ $permission['id'] }},{{ $permission['permission_id'] }})" class="btn btn-outline-default waves-effect waves-themed" type="button"><i class="fal fa-times"></i></button>
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
</div>
