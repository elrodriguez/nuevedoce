<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            Rol: {{ $role_name }}
        </div>
        <div class="card-body">
            <div class="card-columns">
                @if($modules_permissions)
                @php
                    $label = '';
                @endphp
                    @foreach($modules_permissions as $key => $module)
                        @if($label != $module['label'])
                            <div class="card" id="card-{{ $module['module_id'] }}">
                                <div class="card-header bg-warning-100 d-flex pr-2 align-items-center flex-wrap">
                                    <div class="d-flex">
                                        <div class="custom-control custom-switch ">
                                            <input wire:change="selectAll({{ $module['module_id'] }})" wire:model.defer="input_all.{{ $module['module_id'] }}" value="{{ $module['module_id'] }}" id="demo-switch-{{ $module['module_id'] }}" type="checkbox" class="custom-control-input">
                                            <label class="custom-control-label fw-500" for="demo-switch-{{ $module['module_id'] }}"></label>
                                        </div>
                                        <button wire:click="savePermission({{ $module['module_id'] }})" class="btn btn-xs btn-info ml-auto waves-effect waves-themed">
                                            {{ __('setting::labels.save') }}
                                        </button>
                                    </div>
                                    <div class="card-title ml-auto">{{ $module['label'] }}</div>
                                </div>
                                <div class="card-body">
                                    @foreach($modules_permissions as $permission)
                                        @if($module['label'] == $permission['label'])
                                            <div class="mb-1">
                                                <div class="custom-control d-flex custom-switch">
                                                    <input wire:model.defer="permissions.{{ $module['module_id'] }}.{{ $permission['name'] }}" value="{{ $permission['id']}}"  id="eventlog-switch-{{ $permission['id']}}" type="checkbox" class="custom-control-input">
                                                    <label class="custom-control-label fw-500" for="eventlog-switch-{{ $permission['id']}}">{{ $permission['name'] }}</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @php
                            $label = $module['label'];
                        @endphp
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
