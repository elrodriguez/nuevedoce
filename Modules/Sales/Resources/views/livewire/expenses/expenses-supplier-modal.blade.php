<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalSupplierCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSupplierCreateLabel">Nuevo Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6 mb-3"f>
                            <label class="form-label" for="identity_document_type_id">Tipo Doc. Identidad <span class="text-danger">*</span> </label>
                            <select class="custom-select form-control" wire:model="identity_document_type_id">
                                <option value="">{{ __('labels.to_select') }}</option>
                                @foreach ($identity_document_types as $identity_document_type)
                                    <option value="{{ $identity_document_type->id }}">{{ $identity_document_type->description }}</option>
                                @endforeach
                            </select>
                            @error('identity_document_type_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="number_id">{{ __('labels.number') }} <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="number_id" wire:model.defer="number_id">
                            @error('number_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="name">{{ __('labels.name') }} <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="name" wire:model.defer="name">
                            @error('name')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="last_paternal">{{ __('labels.last_paternal') }} <span class="text-danger">*</span> </label>
                            <input {{ $identity_document_type_id == '6' ? 'disabled': '' }} type="text" class="form-control" name="last_paternal" wire:model.defer="last_paternal">
                            @error('last_paternal')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="last_maternal">{{ __('labels.last_maternal') }} <span class="text-danger">*</span> </label>
                            <input {{ $identity_document_type_id == '6' ? 'disabled': '' }} type="text" class="form-control" name="last_maternal" wire:model.defer="last_maternal">
                            @error('last_maternal')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="trade_name">{{ __('labels.trade_name') }}</label>
                            <input type="text" class="form-control" name="trade_name" wire:model.defer="trade_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="department_id">@lang('setting::labels.department') <span class="text-danger">*</span> </label>
                            <select wire:change="getProvinves" wire:model="department_id" id="department_id" class="custom-select" required="">
                                <option value="">Seleccionar</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->description }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="province_id">@lang('setting::labels.province') <span class="text-danger">*</span> </label>
                            <select wire:change="getPDistricts" wire:model="province_id" id="province_id" class="custom-select" required="">
                                <option value="">Seleccionar</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->description }}</option>
                                @endforeach
                            </select>
                            @error('province_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="district_id">@lang('setting::labels.district') <span class="text-danger">*</span> </label>
                            <select wire:model="district_id" id="district_id" class="custom-select" required="">
                                <option value="">Seleccionar</option>
                                @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->description }}</option>
                                @endforeach
                            </select>
                            @error('district_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="sex">@lang('labels.sex')</label>
                            <select class="custom-select form-control" wire:model.defer="sex" id="sex" name="sex" required="">
                                <option>@lang('labels.to_select')</option>
                                <option value="m">Masculino</option>
                                <option value="f">Femenino</option>
                            </select>
                            @error('sex')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                    <button wire:click="storeSupplier" type="button" class="btn btn-primary">{{ __('labels.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-modal-expense-supplier-create', event => {
            $('#modalSupplierCreate').modal('show');
        });
        window.addEventListener('response_success_supplier_store', event => {
            alertSupplier(event.detail.message);
            $('.companiesAutoComplete').autoComplete('set', { value: event.detail.idperson, text: event.detail.nameperson });
            $('#modalSupplierCreate').modal('hide');
        });
        function alertSupplier(msg){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        }
    </script>
</div>
