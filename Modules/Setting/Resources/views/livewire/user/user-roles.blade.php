<div>
    <div>
        <div class="card mb-g rounded-top">
            <div class="card-header">
                {{ __('setting::labels.user') }}: {{ $user_name }}
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($roles as $role)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <label class="card d-flex flex-row p-2 mb-2 align-items-stretch">
                                <div class=" pr-2 flex-shrink-0 flex-grow-0" style="max-width: 50px">
                                    <i class="fal fa-2x fa-key" style="color: #A0280F"></i>
                                </div>
                                <div class="d-flex flex-column flex-grow-1 flex-shrink-0 w-50 justify-content-between">
                                    <div class="text-truncate">{{ $role->name }}</div>
                                    <div class="small" wire:ignore>
                                        <b><span class="amount_to_localize">{{ $role->quantity }}</span></b> / {{ __('setting::labels.permissions') }}
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-between align-items-center">
                                    <div class="custom-control custom-checkbox custom-checkbox-circle">
                                        <input wire:change="assignRole({{ $role->id }},'{{ $role->name }}')" wire:model.defer="checked.{{ $role->id }}" type="checkbox" class="custom-control-input" id="checked-{{ $role->id }}">
                                        <label class="custom-control-label" for="checked-{{ $role->id }}"></label>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer d-flex flex-row align-items-center">
                <a href="{{ route('setting_users')}}" type="button" class="btn btn-secondary waves-effect waves-themed">Listado</a>
            </div>
        </div>
    </div>
</div>
