<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="description">@lang('labels.description') <span class="text-danger">*</span> </label>
                    <textarea wire:model="description" class="form-control" id="description"></textarea>
                    @error('description')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('pharmacy_administration_symptom')}}" type="button" class="btn btn-secondary waves-effect waves-themed">{{ __('labels.list') }}</a>
            <button wire:click="updateSymptom" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">{{ __('labels.to_update') }}</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('phar-symptom-update', event => {
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
