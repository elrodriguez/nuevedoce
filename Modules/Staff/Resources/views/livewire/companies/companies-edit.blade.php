<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="names">@lang('staff::labels.lbl_name') <span class="text-danger">*</span> </label>
                        <input wire:model="names" type="text" class="form-control" id="names" required="">
                        @error('names')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label" for="trade_name">@lang('labels.trade_name') <span class="text-danger">*</span> </label>
                        <input wire:model.defer="trade_name" type="text" class="form-control" id="trade_name" required="">
                        @error('trade_name')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-3 mb-3">
                        <label class="form-label" for="country_id">@lang('staff::labels.lbl_country') <span class="text-danger">*</span> </label>
                        <select wire:model="country_id" id="country_id" class="form-control" wire:ignore>
                            <option value="">Seleccionar</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->description }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="department_id">@lang('staff::labels.lbl_department') <span class="text-danger">*</span> </label>
                        <select wire:change="getProvinves" wire:model="department_id" id="department_id" class="custom-select" required="">
                            <option value="">@lang('staff::labels.lbl_select')</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->description }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="province_id">@lang('staff::labels.lbl_province') <span class="text-danger">*</span> </label>
                        <select wire:change="getPDistricts" wire:model="province_id" id="province_id" class="custom-select" required="">
                            <option value="">@lang('staff::labels.lbl_select')</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->description }}</option>
                            @endforeach
                        </select>
                        @error('province_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="district_id">@lang('staff::labels.lbl_district') <span class="text-danger">*</span> </label>
                        <select wire:model="district_id" id="district_id" class="custom-select" required="">
                            <option value="">@lang('staff::labels.lbl_select')</option>
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
                        <label class="form-label" for="address">@lang('staff::labels.lbl_address') <span class="text-danger">*</span> </label>
                        <input wire:model="address" type="text" class="form-control" id="address" required="">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="identity_document_type_id">@lang('staff::labels.lbl_identity_document_type') <span class="text-danger">*</span> </label>
                        <select wire:model="identity_document_type_id" id="identity_document_type_id" class="custom-select" required="" disabled>
                            <option value="">@lang('staff::labels.lbl_select')</option>
                            @foreach($document_types as $item)
                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                        @error('identity_document_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="number">@lang('staff::labels.lbl_number') <span class="text-danger">*</span> </label>
                        <input wire:model="number" type="text" class="form-control" id="number" required="">
                        @error('number')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="type_person_id">@lang('staff::labels.lbl_type_person') <span class="text-danger">*</span> </label>
                        <select wire:model="type_person_id" id="type_person_id" class="custom-select" required="">
                            <option value="">@lang('staff::labels.lbl_select')</option>
                            @foreach($type_people as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('type_person_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="email">@lang('staff::labels.lbl_email') <span class="text-danger">*</span> </label>
                        <input wire:model="email" type="text" class="form-control" id="email" required="">
                        @error('email')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="telephone">@lang('staff::labels.lbl_telephone') </label>
                        <input wire:model="telephone" type="text" class="form-control" id="telephone">
                        @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('staff_companies_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('staff::labels.lbl_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('staff::labels.btn_update')</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('per-companies-type-edit', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('staff::labels.lbl_success')}}!</span>",
                message: "<span><strong>{{__('staff::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('livewire:load', function () {
            $(":input").inputmask();
        });
    </script>
</div>
