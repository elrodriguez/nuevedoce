<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any() ? 'was-validated' : '' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="floor">
                            @lang('restaurant::labels.floor')
                            <span class="text-danger">*</span>
                            <span class="ml-1">
                                <a href="javascript:void(0)" wire:click="$emit('openModalFloorForm')">[
                                    +Nuevo ]</a>
                            </span>
                        </label>
                        <select wire:model.defer="floor_id" class="custom-select">
                            <option value="">{{ __('labels.to_select') }}</option>
                            @foreach ($floors as $floor)
                                <option value="{{ $floor->id }}">{{ $floor->name }}</option>
                            @endforeach
                        </select>
                        @error('floor_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="name">@lang('labels.name') <span
                                class="text-danger">*</span> </label>
                        <input wire:model.defer="name" type="text" class="form-control">
                        @error('name')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="description">
                            @lang('labels.description')
                            <span class="text-danger">*</span>
                        </label>
                        <input wire:model.defer="description" type="text" class="form-control">
                        @error('description')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="chairs">
                            @lang('restaurant::labels.chairs')
                            <span class="text-danger">*</span>
                        </label>
                        <input wire:model.defer="chairs" class="form-control" id="chairs" type="number" min="1"
                            max="20" value="2">
                        @error('chairs')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">
                            @lang('restaurant::labels.occupied')
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model.defer="occupied" type="checkbox" class="custom-control-input" id="status">
                            <label class="custom-control-label" for="occupied">{{ __('labels.yes') }}</label>
                        </div>
                        @error('occupied')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">
                            @lang('labels.state')
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model.defer="state" type="checkbox" class="custom-control-input" id="status">
                            <label class="custom-control-label" for="status">Activo</label>
                        </div>
                        @error('state')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('restaurant_tables_list') }}" type="button"
                class="btn btn-secondary waves-effect waves-themed">{{ __('labels.list') }}</a>
            <button wire:target="save" wire:click="save" wire:loading.attr="disabled" type="button"
                class="btn btn-info ml-auto waves-effect waves-themed">{{ __('labels.save') }}</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-tables-save', event => {
            initApp.playSound('{{ url('themes/smart-admin/media/sound') }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='{{ env('BOOTBOX_SUCCESS_ICON') }} text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>" + event.detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({
                'background-color': "{{ env('BOOTBOX_SUCCESS_COLOR') }}"
            });
        });
    </script>
</div>
