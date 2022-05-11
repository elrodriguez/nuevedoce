<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any() ? 'was-validated' : '' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="xuuid">{{ __('labels.code') }} <span
                                class="text-danger">*</span>
                        </label>
                        <input wire:model.defer="xuuid" type="text" class="form-control" id="xuuid">
                        @error('xuuid')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="logo">@lang('setting::labels.icon') <span
                                class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i
                                        class="{{ $logo ? $logo : 'fal fa-wrench' }} fs-xl"></i></span>
                            </div>
                            <input wire:model="logo" type="text" class="form-control" required>
                            <div class="input-group-append">
                                <button data-toggle="modal" data-target="#modalIconSystem"
                                    class="btn btn-primary waves-effect waves-themed" type="button">Iconos</button>
                            </div>
                        </div>
                        @error('logo')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="label">@lang('setting::labels.name') <span
                                class="text-danger">*</span> </label>
                        <input wire:model="label" type="text" class="form-control" id="label" required="">
                        @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="destination_route">@lang('setting::labels.destination_route')
                            <span class="text-danger">*</span> </label>
                        <input wire:model="destination_route" type="text" class="form-control" id="destination_route"
                            required="">
                        @error('destination_route')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">@lang('setting::labels.state') <span
                                class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="status" type="checkbox" class="custom-control-input" id="status"
                                checked="">
                            <label class="custom-control-label" for="status">Activo</label>
                        </div>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('setting_modules') }}" type="button"
                class="btn btn-secondary waves-effect waves-themed">Listado</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button"
                class="btn btn-info ml-auto waves-effect waves-themed">Guardar</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-modules-save', event => {
            initApp.playSound('{{ url('themes/smart-admin/media/sound') }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('setting::labels.success') }}!</span>",
                message: "<span><strong>{{ __('setting::labels.excellent') }}... </strong>" + event
                    .detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({
                'background-color': 'rgba(122, 85, 7, 0.5)'
            });
        });
    </script>
    @livewire('setting::modal-icon')
</div>
