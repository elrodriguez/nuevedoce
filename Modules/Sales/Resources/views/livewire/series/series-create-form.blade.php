<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="establishment_id">@lang('labels.establishment') <span class="text-danger">*</span> </label>
                    <select wire:model="establishment_id" class="custom-select" id="establishment_id">
                        <option value="">{{ __('labels.to_select') }}</option>
                        @foreach ($establishments as $establishment)
                        <option value="{{ $establishment->id }}">{{ $establishment->name }}</option>
                        @endforeach
                    </select> 
                    @error('establishment_id')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="document_type_id">@lang('labels.voucher_type') <span class="text-danger">*</span> </label>
                    <select wire:model="document_type_id" class="custom-select" id="document_type_id">
                        <option value="">{{ __('labels.to_select') }}</option>
                        @foreach ($document_types as $document_type)
                        <option value="{{ $document_type->id }}">{{ $document_type->description }}</option>
                        @endforeach
                    </select> 
                    @error('document_type_id')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="serie">@lang('labels.serie') <span class="text-danger">*</span> </label>
                    <input wire:model="serie" type="text" class="form-control" id="serie" required="">
                    @error('serie')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="number">@lang('labels.number') <span class="text-danger">*</span> </label>
                    <input wire:model="number" type="text" class="form-control" id="number" required="">
                    @error('number')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">@lang('labels.state') <span class="text-danger">*</span> </label>
                    <div class="custom-control custom-checkbox">
                        <input wire:model="state" type="checkbox" class="custom-control-input" id="state">
                        <label class="custom-control-label" for="state">Activo</label>
                    </div>
                    @error('state')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('sales_administration_series')}}" type="button" class="btn btn-secondary waves-effect waves-themed">Listado</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">Guardar</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-serie-save', event => {
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

    </script>
</div>
