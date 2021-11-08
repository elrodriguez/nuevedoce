<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="company_id">@lang('setting::labels.company') <span class="text-danger">*</span> </label>
                        <select wire:model="company_id" class="custom-select" id="company_id" required="">
                            <option value="">Seleccionar</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ $company->main ? 'selected' : '' }} >{{ $company->name }}</option>
                            @endforeach
                        </select>
                        @error('company_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
                    <div class="col-md-3 mb-3">
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
                        <label class="form-label" for="address">@lang('labels.name') <span class="text-danger">*</span> </label>
                        <input wire:model="name" type="text" class="form-control" id="name" required="">
                        @error('name')
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
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="email">@lang('setting::labels.email') <span class="text-danger">*</span> </label>
                        <input wire:model="email" type="text" class="form-control" id="email" required="">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="web_page">@lang('setting::labels.web_page') </label>
                        <input wire:model="web_page" type="text" class="form-control" id="web_page" required="">
                        @error('web_page')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="phone">@lang('setting::labels.phone') <span class="text-danger">*</span> </label>
                        <input wire:model="phone" type="text" class="form-control" id="phone" required="">
                        @error('phone')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="latitude">@lang('setting::labels.latitude') </label>
                        <input wire:model="latitude" type="text" class="form-control" id="latitude" required="">
                        @error('latitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="longitude">@lang('setting::labels.longitude') </label>
                        <input wire:model="longitude" type="text" class="form-control" id="longitude" required="">
                        @error('longitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="state">@lang('setting::labels.state') </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="state" type="checkbox" class="custom-control-input" id="defaultChecked">
                            <label class="custom-control-label" for="defaultChecked">@lang('setting::labels.active')</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="observation">@lang('setting::labels.observation') </label>
                        <textarea wire:model="observation" class="form-control" id="observation" required=""></textarea>
                        
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="observation">@lang('setting::labels.map') </label>
                        <textarea wire:model="map" class="form-control" id="map" required=""></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="observation">@lang('setting::labels.observation') </label>
                        <div wire:ignore>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('setting_establishment')}}" type="button" class="btn btn-secondary waves-effect waves-themed">Listado</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">Guardar</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-establishmente-update', event => {
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
