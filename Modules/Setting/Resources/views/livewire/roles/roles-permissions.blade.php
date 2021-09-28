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
                            <div class="card">
                                <div class="card-header bg-warning-100">
                                    {{ $module['label'] }}
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                    @foreach($modules_permissions as $k => $permission)
                                        @if($module['label'] == $permission['label'])
                                            <li class="list-group-item">
                                                <div class="custom-control d-flex custom-switch">
                                                    <input wire:click="changeState({{ $k }},{{ $permission['id'] }})" wire:model="permissions.{{ $k }}.status" id="eventlog-switch-{{ $k }}" type="checkbox" class="custom-control-input">
                                                    <label class="custom-control-label fw-500" for="eventlog-switch-{{ $k }}">{{ $permission['name'] }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    </ul>
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
