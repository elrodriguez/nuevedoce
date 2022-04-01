<div>
    <div class="row">
        <div class="col-6">
            <div id="panel-70" class="panel">
                <div class="panel-hdr color-success-600">
                    <h2>
                        SOAP <span class="fw-300"><i>configuración</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    </div>
                </div>
                <div class="panel-container collapse show" style="">
                    <div class="panel-content">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="soap_type_id">SOAP Tipo<span class="text-danger">*</span> </label>
                                <select wire:model="soap_type_id" class="custom-select">
                                    @foreach ($soap_types as $soap_type)
                                        <option value="{{ $soap_type->id }}">{{ $soap_type->description }}</option>
                                    @endforeach
                                </select>
                                @error('soap_type_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="soap_send_id">SOAP envio<span class="text-danger">*</span> </label>
                                <select wire:model="soap_send_id" class="custom-select" disabled>
                                    <option value="01">SUNAT</option>
                                </select>
                                @error('soap_send_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="soap_user">SOAP Usuario<span class="text-danger">*</span> </label>
                                <input wire:model.defer="soap_user" type="text" class="form-control" {{ $soap_type_id == '01' ? 'disabled' : '' }}>
                                @error('soap_user')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="soap_password">SOAP Password<span class="text-danger">*</span> </label>
                                <input wire:model.defer="soap_password" type="text" class="form-control" {{ $soap_type_id == '01' ? 'disabled' : '' }}>
                                @error('soap_password')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                        <button wire:click="saveSoap" class="btn btn-primary ml-auto waves-effect waves-themed">{{ __('labels.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div id="panel-90" class="panel">
                <div class="panel-hdr color-success-600">
                    <h2>
                        Certificado <span class="fw-300"><i>pfx</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    </div>
                </div>
                <div class="panel-container collapse show" style="">
                    <div class="panel-content">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="certificate_password">Password<span class="text-danger">*</span> </label>
                                <input wire:model.defer="certificate_password" type="text" class="form-control">
                                @error('certificate_password')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="soap_type_id">Archivo<span class="text-danger">*</span> </label>
                                <div class="custom-file" wire:ignore>
                                    <input wire:model="certificate_file" type="file" class="custom-file-input" name="certificate_file" id="certificate_file" required="">
                                    <label class="custom-file-label" for="certificate">Elija el archivo...</label>
                                </div>
                                @error('certificate_file')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                                @enderror
                            </div>
                            @if($certificate_show)
                            <div class="col-md-12">
                                <div class="alert bg-fusion-400 border-0 fade show">
                                    <button wire:click="deleteCertificate" type="button" class="close">
                                        <span aria-hidden="true"><i class="fal fa-trash-alt"></i></span>
                                    </button>
                                    <div class="d-flex align-items-center">
                                        <div class="alert-icon">
                                            <i class="fal fa-file-certificate text-warning"></i>
                                        </div>
                                        <div class="flex-1">
                                            {{ $certificate_show }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                        <button wire:loading.attr="disabled" wire:click="saveFileCertificate" class="btn btn-primary ml-auto waves-effect waves-themed">{{ __('labels.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('set-company-tools', event => {
            initApp.playSound('themes/smart-admin/media/sound', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-success mr-2'></i> <span class='text-success fw-500'>{{ __('setting::labels.success') }}!</span>",
                message: "<span><strong>{{ __('setting::labels.excellent') }}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('set-company-certificate-upload', event => {
            let success = event.detail.success;
            let message = event.detail.message;
            if(success == true){
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.success') }}!</span>",
                    message: "<span><strong>{{ __('inventory::labels.excellent') }}... </strong>"+message+"</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }else{
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-times-hexagon text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('setting::labels.error') }}!</span>",
                    message: "<span><strong>{{ __('setting::labels.went_wrong') }}... </strong>"+message+"</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(214, 36, 16, 0.5)'});
            }
        });
    </script>
</div>
