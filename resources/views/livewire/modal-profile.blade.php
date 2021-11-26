<div>
    <div wire:ignore.self id="modalProfile" class="modal fade default-example-modal-right" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">{{ __('labels.user_data') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{{ __('labels.username') }}</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $username }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{{ __('labels.name') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" wire:model.defer="name">
                            @error('name')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{{ __('labels.email') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" wire:model.defer="email">
                            @error('email')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{{ __('labels.password') }}</label>
                        <div class="col-sm-8">
                            <input wire:model.defer="password" type="password" class="form-control">
                            @error('password')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                    <button wire:click="save" type="button" class="btn btn-primary">{{ __('labels.save') }}</button>
                </div>
            </div>
        </div>
        
    </div>
    <script type="text/javascript">
        document.addEventListener('save-changes-user', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('setting::labels.success') }}!</span>",
                message: "<span><strong>{{ __('setting::labels.excellent') }}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });

    </script>
</div>
