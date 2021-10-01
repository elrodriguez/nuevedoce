<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fal fa-times"></i>
                    </span>
                </button>
                <div class="d-flex flex-start w-100">
                    <div class="mr-2 hidden-md-down">
                        <span class="icon-stack icon-stack-lg">
                            <i class="base base-6 icon-stack-3x opacity-100 color-primary-500"></i>
                            <i class="base base-10 icon-stack-2x opacity-100 color-primary-300 fa-flip-vertical"></i>
                            <i class="fal fa-info icon-stack-1x opacity-100 color-white"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-fill">
                        <div class="flex-fill">
                            <span class="h5">{{ __('setting::labels.about') }}</span>
                            <p>Para el acceso al sistema el nombre de usuario sera su numero de identificacion y su clave 12345678 </p>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="names">@lang('setting::labels.names') <span class="text-danger">*</span> </label>
                        <input wire:model="names" type="text" class="form-control" id="names" required="">
                        @error('names')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="last_name_father">@lang('setting::labels.surname_father') <span class="text-danger">*</span> </label>
                        <input wire:model="last_name_father" type="text" class="form-control" id="last_name_father" required="">
                        @error('last_name_father')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="last_name_mother">@lang('setting::labels.surname_mother') <span class="text-danger">*</span> </label>
                        <input wire:model="last_name_mother" type="text" class="form-control" id="last_name_mother" required="">
                        @error('last_name_mother')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- <div class="col-md-3 mb-3">
                        <label class="form-label" for="country_id">@lang('setting::labels.country') <span class="text-danger">*</span> </label>
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
                    <div class="col-md-3 mb-3">
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
                    <div class="col-md-3 mb-3">
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
                    <div class="col-md-2 mb-3">
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
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="address">@lang('setting::labels.address') <span class="text-danger">*</span> </label>
                        <input wire:model="address" type="text" class="form-control" id="address" required="">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="identity_document_type_id">@lang('setting::labels.identity_document_type') <span class="text-danger">*</span> </label>
                        <select wire:model="identity_document_type_id" id="identity_document_type_id" class="custom-select" required="">
                            <option value="">Seleccionar</option>
                            @foreach($document_types as $item)
                            <option value="{{ $item->id }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                        @error('identity_document_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="number">@lang('setting::labels.number') <span class="text-danger">*</span> </label>
                        <input wire:model="number" type="text" class="form-control" id="number" required="">
                        @error('number')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="birth_date">@lang('setting::labels.date_of_birth') <span class="text-danger">*</span> </label>
                        <input wire:model="birth_date" onchange="this.dispatchEvent(new InputEvent('input'))" type="text" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true">
                        @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="email">@lang('setting::labels.email') <span class="text-danger">*</span> </label>
                        <input wire:model="email" type="text" class="form-control" id="email" required="">
                        @error('email')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="telephone">@lang('setting::labels.telephone') </label>
                        <input wire:model="telephone" type="text" class="form-control" id="telephone">
                        @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="sex">@lang('setting::labels.sex') <span class="text-danger">*</span> </label>
                        <div class="frame-wrap">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="man" name="sex" wire:model="sex" value="H">
                                <label class="custom-control-label" for="man">Hombre</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="woman" name="sex" wire:model="sex" value="M" >
                                <label class="custom-control-label" for="woman">Mujer</label>
                            </div>
                        </div>
                        @error('sex')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="photo">@lang('setting::labels.photo') </label>
                        <input wire:model="photo" type="file" id="photo"><br>
                        @if($photo_view)
                        <img src="{{ $photo_view }}" alt="{{ $names }}" class="img-thumbnail" width="150px">
                        @endif
                        @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('setting_users')}}" type="button" class="btn btn-secondary waves-effect waves-themed">Listado</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">Guardar</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-user-save', event => {
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
        document.addEventListener('livewire:load', function () {
            $(":input").inputmask();
        });
    </script>
</div>
