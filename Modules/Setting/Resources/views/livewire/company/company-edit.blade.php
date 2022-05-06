<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="name">@lang('setting::labels.name_short') <span
                            class="text-danger">*</span> </label>
                    <input wire:model="name" type="text" class="form-control" id="name" required="">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="number">Ruc <span class="text-danger">*</span> </label>
                    <input wire:model="number" type="text" class="form-control" id="number" required="">
                    @error('number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="email">Email <span class="text-danger">*</span> </label>
                    <input wire:model="email" type="text" class="form-control" id="email" required="">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="tradename">@lang('setting::labels.tradename') <span
                            class="text-danger">*</span> </label>
                    <input wire:model="tradename" type="text" class="form-control" id="tradename" required="">
                    @error('tradename')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="phone">Teléfono fijo <span class="text-danger">*</span>
                    </label>
                    <input wire:model="phone" type="text" class="form-control" id="phone" required="">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="phone_mobile">Teléfono móvil <span
                            class="text-danger">*</span> </label>
                    <input wire:model="phone_mobile" type="text" class="form-control" id="phone_mobile" required="">
                    @error('phone_mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="representative_name">Nombre del representante <span
                            class="text-danger">*</span> </label>
                    <input wire:model="representative_name" type="text" class="form-control" id="representative_name"
                        required="">
                    @error('representative_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="representative_number">Número de identificación <span
                            class="text-danger">*</span> </label>
                    <input wire:model="representative_number" type="text" class="form-control"
                        id="representative_number" required="">
                    @error('representative_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="logo">Logo Sistema</label>
                    <input wire:model="logo" type="file" id="logo">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($logo_view)
                        <img class="img-thumbnail mt-5" width="100%" src="{{ url('storage/' . $this->logo_view) }}">
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="logo_store">Logo Documentos </label>
                    <input wire:model="logo_store" type="file" id="logo_store">
                    @error('logo_store')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($logo_store_view)
                        <img class="img-thumbnail mt-5" width="100%"
                            src="{{ url('storage/' . $this->logo_store_view) }}">
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="logo">Esta es la empresa principal</label>
                    <div class="custom-control custom-checkbox">
                        <input wire:model="main" type="checkbox" class="custom-control-input" id="maincompany">
                        <label class="custom-control-label" for="maincompany">si</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('setting_company') }}" type="button"
                class="btn btn-secondary waves-effect waves-themed">{{ __('setting::buttons.list') }}</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button"
                class="btn btn-info ml-auto waves-effect waves-themed">{{ __('setting::buttons.save') }}</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-company-update', event => {
            initApp.playSound('{{ URL('themes/smart-admin/media/sound') }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-success mr-2'></i> <span class='text-success fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>" + event.detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({
                'background-color': 'rgba(122, 85, 7, 0.5)'
            });
        })
    </script>
</div>
