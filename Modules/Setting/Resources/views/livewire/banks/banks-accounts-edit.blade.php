<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="bank_id">@lang('labels.bank') <span class="text-danger">*</span> </label>
                        <select wire:model.defer="bank_id" name="bank_id" id="bank_id" class="custom-select">
                            <option value="">{{ __('labels.to_select') }}</option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->description }}</option>
                            @endforeach
                        </select>
                        @error('bank_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="coin_id">@lang('labels.coin') <span class="text-danger">*</span> </label>
                        <select wire:model.defer="coin_id" name="coin_id" id="coin_id" class="custom-select">
                            <option value="">{{ __('labels.to_select') }}</option>
                            @foreach($currency_types as $currency_type)
                                <option value="{{ $currency_type->id }}">{{ $currency_type->id.' - '.$currency_type->description }}</option>
                            @endforeach
                        </select>
                        @error('coin_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="description">@lang('inventory::labels.description') <span class="text-danger">*</span> </label>
                        <input wire:model="description" type="text" class="form-control" id="description" required="">
                        @error('description')
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
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('setting_banks_accounts')}}" type="button" class="btn btn-secondary waves-effect waves-themed">{{ __('labels.list') }}</a>
            <button wire:click="update" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">{{ __('labels.to_update') }}</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-bank-account-update', event => {
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
