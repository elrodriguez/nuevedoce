<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="description">@lang('lend::labels.lbl_description') </label>
                        <input wire:model="description" type="text" class="form-control" id="description" required="">
                        @error('description')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">@lang('lend::labels.lbl_state') <span class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="state" type="checkbox" class="custom-control-input" id="state" checked="">
                            <label class="custom-control-label" for="state">@lang('lend::labels.lbl_active')</label>
                        </div>
                        @error('state')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('lend_paymentmethod_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('lend::labels.lbl_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('lend::buttons.btn_save')</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('len-payment-method-save', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('lend::labels.lbl_success')}}!</span>",
                message: "<span><strong>{{__('lend::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
