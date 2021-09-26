<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="name">@lang('setting::labels.name_short') <span class="text-danger">*</span> </label>
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
                        <label class="form-label" for="tradename">@lang('setting::labels.tradename') <span class="text-danger">*</span> </label>
                        <input wire:model="tradename" type="text" class="form-control" id="tradename" required="">
                        @error('tradename')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="phone">Teléfono fijo <span class="text-danger">*</span> </label>
                        <input wire:model="phone" type="text" class="form-control" id="phone" required="">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="phone_mobile">Teléfono móvil <span class="text-danger">*</span> </label>
                        <input wire:model="phone_mobile" type="text" class="form-control" id="phone_mobile" required="">
                        @error('phone_mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="representative_name">Nombre del representante <span class="text-danger">*</span> </label>
                        <input wire:model="representative_name" type="text" class="form-control" id="representative_name" required="">
                        @error('representative_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="representative_number">Número de identificación <span class="text-danger">*</span> </label>
                        <input wire:model="representative_number" type="text" class="form-control" id="representative_number" required="">
                        @error('representative_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="logo">Logo Sistema<span class="text-danger">*</span> </label>
                        <input wire:model="logo" type="file" id="logo" required="">
                        @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if ($logo_view)
                            <img class="img-thumbnail mt-5" width="100%" src="{{ url('storage/'.$this->logo_view) }}">
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="logo_store">Logo Documentos <span class="text-danger">*</span> </label>
                        <input wire:model="logo_store" type="file" id="logo_store" required="">
                        @error('logo_store')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if ($logo_store_view)
                            <img class="img-thumbnail mt-5" width="100%" src="{{ url('storage/'.$this->logo_store_view) }}">
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-right">
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info waves-effect waves-themed">Guardar</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-company-save', event => {
            initApp.playSound('themes/smart-admin/media/sound', 'voice_on')
            bootbox.alert({
                title: "<i class='fal fa-check-circle text-success mr-2'></i> <span class='text-success fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
        })
    </script>
</div>
