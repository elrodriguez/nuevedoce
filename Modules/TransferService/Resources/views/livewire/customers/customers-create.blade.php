<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <h4 class="panel-hdr">
                    <i class="fal fa-address-book"></i> @lang('transferservice::labels.lbl_data_person')
                </h4>
                <hr class="mb-0 mt-4">
                <div class="form-row">
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="names">@lang('transferservice::labels.lbl_names') <span class="text-danger">*</span> </label>
                        <input wire:model="names" type="text" class="form-control" id="names" required="">
                        @error('names')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="last_name_father">@lang('transferservice::labels.lbl_surname_father') <span class="text-danger">*</span> </label>
                        <input wire:model="last_name_father" type="text" class="form-control" id="last_name_father" required="">
                        @error('last_name_father')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="last_name_mother">@lang('transferservice::labels.lbl_surname_mother') <span class="text-danger">*</span> </label>
                        <input wire:model="last_name_mother" type="text" class="form-control" id="last_name_mother" required="">
                        @error('last_name_mother')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="department_id">@lang('transferservice::labels.lbl_department') <span class="text-danger">*</span> </label>
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
                        <label class="form-label" for="province_id">@lang('transferservice::labels.lbl_province') <span class="text-danger">*</span> </label>
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
                        <label class="form-label" for="district_id">@lang('transferservice::labels.lbl_district') <span class="text-danger">*</span> </label>
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
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="address">@lang('transferservice::labels.lbl_address') <span class="text-danger">*</span> </label>
                        <input wire:model="address" type="text" class="form-control" id="address" required="">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="identity_document_type_id">@lang('transferservice::labels.lbl_identity_document_type') <span class="text-danger">*</span> </label>
                        <select wire:model="identity_document_type_id" id="identity_document_type_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($document_types as $item)
                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                        @error('identity_document_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="number">@lang('transferservice::labels.lbl_number') <span class="text-danger">*</span> </label>
                        <input wire:model="number" type="text" class="form-control" id="number" required="" {{ $this->person_id ? 'readonly' : '' }}>
                        @error('number')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- <div class="col-md-3 mb-3">
                        <label class="form-label" for="country_id">@lang('transferservice::labels.lbl_country') <span class="text-danger">*</span> </label>
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
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="telephone">@lang('transferservice::labels.lbl_telephone') </label>
                        <input wire:model="telephone" type="text" class="form-control" id="telephone">
                        @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="birth_date">@lang('transferservice::labels.lbl_date_of_birth') <span class="text-danger">*</span> </label>
                        <input wire:model="birth_date" required="" onchange="this.dispatchEvent(new InputEvent('input'))" type="text" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true" id="txtDate_of_birth">
                        @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="email">@lang('transferservice::labels.lbl_email') <span class="text-danger">*</span> </label>
                        <input wire:model="email" type="text" class="form-control" id="email" required="">
                        @error('email')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <div id="xyDivUploadPhoto" wire:ignore>
                            <label class="form-label" for="photo">@lang('transferservice::labels.lbl_photo') <span class="text-danger">*</span> </label>
                            <div class="custom-file">
                                <input wire:model="photo" type="file" class="custom-file-input" id="photo">
                                <label class="custom-file-label" for="customFile">@lang('transferservice::labels.lbl_choose_file')</label>
                            </div>
                        </div>
                        @error('photo')
                        <div class="invalid-feedback-2" id="xyDivErrorPhoto">{{ $message }}</div>
                        @enderror
                        <div class="d-flex flex-column align-items-center justify-content-center" wire:ignore style="display: none !important;" id="xyDivPreviewPhoto">
                            <img src="" id="preview-image-before-upload" class="rounded-circle shadow-2 img-thumbnail" style="width: 80px;height: 70px" alt="">
                            <a href="javascript:void(0);" onclick="deletePhoto()" class="btn btn-outline-danger btn-xs btn-icon rounded-circle waves-effect waves-themed">
                                <i class="fal fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">@lang('transferservice::labels.lbl_state') <span class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="state" type="checkbox" class="custom-control-input" id="state" checked="">
                            <label class="custom-control-label" for="state">@lang('transferservice::labels.lbl_active')</label>
                        </div>
                        @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="sex">@lang('transferservice::labels.lbl_sex') <span class="text-danger">*</span> </label>
                        <div class="frame-wrap">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="man" name="sex" wire:model="sex" value="H">
                                <label class="custom-control-label" for="man">@lang('transferservice::labels.lbl_man')</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="woman" name="sex" wire:model="sex" value="M" >
                                <label class="custom-control-label" for="woman">@lang('transferservice::labels.lbl_woman')</label>
                            </div>
                        </div>
                        @error('sex')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h4 class="panel-hdr">
                    <i class="fal fa-user-cog"></i> @lang('transferservice::labels.lbl_data_customer')
                </h4>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">@lang('transferservice::labels.lbl_direct') </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="direct" type="checkbox" class="custom-control-input" id="direct" checked="">
                            <label class="custom-control-label" for="direct">@lang('transferservice::labels.lbl_direct')</label>
                        </div>
                        @error('direct')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('service_customers_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('transferservice::buttons.btn_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_save')</button>
        </div>
    </div>
    <script type="text/javascript">
        function deletePhoto(){
            $('#xyDivPreviewPhoto').attr('style', 'display: none !important');
            $("#xyDivUploadPhoto").css('display', 'block');
            $("xyDivErrorPhoto").html("");
        }

        document.addEventListener('ser-customers-type-save', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_success')}}!</span>",
                message: "<span><strong>{{__('transferservice::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false,
                callback: function () {
                    let url = "{{ route('service_customers_search') }}";
                    window.location.href = url;
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('livewire:load', function () {
            $('#photo').change(function(e){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                    $("#xyDivPreviewPhoto").css('display', 'block');
                    $("#xyDivUploadPhoto").css('display', 'none');
                }
                reader.readAsDataURL(this.files[0]);
            });

            $(":input").inputmask();
            var controls = {
                leftArrow: "<i class='fal fa-angle-left' style='font-size: 1.25rem'></i>",
                rightArrow: "<i class='fal fa-angle-right' style='font-size: 1.25rem'></i>"
            }

            $("#txtDate_of_birth").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            });
        });
    </script>
</div>
