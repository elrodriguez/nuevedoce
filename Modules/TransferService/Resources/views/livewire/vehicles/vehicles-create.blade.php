<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="vehicle_type_id">@lang('transferservice::labels.lbl_vehicle_type') <span class="text-danger">*</span> </label>
                        <select wire:model="vehicle_type_id" id="vehicle_type_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($vehicle_types as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('vehicle_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="license_plate">@lang('transferservice::labels.lbl_license_plate') <span class="text-danger">*</span> </label>
                        <input wire:model="license_plate" type="text" class="form-control" id="license_plate" required="">
                        @error('license_plate')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="mark">@lang('transferservice::labels.lbl_mark') <span class="text-danger">*</span> </label>
                        <input wire:model="mark" type="text" class="form-control" id="mark" required="">
                        @error('mark')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="model">@lang('transferservice::labels.lbl_model') <span class="text-danger">*</span> </label>
                        <input wire:model="model" type="text" class="form-control" id="model" required="">
                        @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="year">@lang('transferservice::labels.lbl_year') <span class="text-danger">*</span></label>
                        <input wire:model="year" type="text" class="form-control" id="year" required="">
                        @error('year')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="length">@lang('transferservice::labels.lbl_length') <span class="text-danger">*</span></label>
                        <input wire:model="length" type="text" class="form-control" id="length" required="">
                        @error('length')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="width">@lang('transferservice::labels.lbl_width') <span class="text-danger">*</span></label>
                        <input wire:model="width" type="text" class="form-control" id="width" required="">
                        @error('width')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="high">@lang('transferservice::labels.lbl_high') <span class="text-danger">*</span></label>
                        <input wire:model="high" type="text" class="form-control" id="high" required="">
                        @error('high')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="color">@lang('transferservice::labels.lbl_color') <span class="text-danger">*</span></label>
                        <input wire:model="color" type="text" class="form-control" id="color" required="">
                        @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="features">@lang('transferservice::labels.lbl_features') <span class="text-danger">*</span></label>
                        <input wire:model="features" type="text" class="form-control" id="features" required="">
                        @error('features')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="tare_weight">@lang('transferservice::labels.lbl_tare_weight') <span class="text-danger">*</span></label>
                        <input wire:model="tare_weight" type="text" class="form-control" id="tare_weight" required="">
                        @error('tare_weight')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="net_weight">@lang('transferservice::labels.lbl_net_weight') <span class="text-danger">*</span></label>
                        <input wire:model="net_weight" type="text" class="form-control" id="net_weight" required="">
                        @error('net_weight')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="gross_weight">@lang('transferservice::labels.lbl_gross_weight') <span class="text-danger">*</span></label>
                        <input wire:model="gross_weight" type="text" class="form-control" id="gross_weight" required="">
                        @error('gross_weight')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
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
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('service_vehicles_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('transferservice::buttons.btn_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_save')</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('ser-vehicles-save', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_success')}}!</span>",
                message: "<span><strong>{{__('transferservice::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('livewire:load', function () {

        });
    </script>
</div>
