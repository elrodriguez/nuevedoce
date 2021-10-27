<div>
    <div class="card mb-g rounded-top">
        <div class="card-body p-0">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row p-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="vehicle_type_id">@lang('transferservice::labels.lbl_vehicle') <span class="text-danger">*</span> </label>
                        <select wire:model="vehicle_id" wire:change="selWeight" id="vehicle_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->license_plate.' - '.$vehicle->mark.' - '.$vehicle->model.' - '.$vehicle->color }}</option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="vehicle_type_id">@lang('transferservice::labels.lbl_maximum_vehicle_load') <span class="text-danger">*</span> </label>
                        <input wire:model="vehicle_load" type="text" class="form-control" readonly />
                        @error('vehicle_load')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('labels.actions') }}</th>
                                        <th class="text-center">{{ __('transferservice::labels.lbl_event') }}</th>
                                        <th class="text-center">{{ __('transferservice::labels.lbl_event_date') }}</th>
                                        <th class="text-center">{{ __('transferservice::labels.lbl_event_date') }}</th>
                                        <th class="text-center">{{ __('transferservice::labels.lbl_event_date') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
