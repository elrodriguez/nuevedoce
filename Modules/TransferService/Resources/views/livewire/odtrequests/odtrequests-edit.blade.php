<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="description">@lang('transferservice::labels.lbl_description') <span class="text-danger">*</span> </label>
                        <input wire:model="description" type="text" class="form-control" id="txt_description" required="">
                        @error('description')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="company_id">@lang('transferservice::labels.lbl_company') <span class="text-danger">*</span> </label>
                        <select wire:model="company_id" id="company_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->number }} - {{ $company->name }}</option>
                            @endforeach
                        </select>
                        @error('company_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3" wire:ingnore>
                        <label class="form-label" for="supervisor_id">@lang('transferservice::labels.lbl_supervisor') <span class="text-danger">*</span> </label>
                        <select wire:model="supervisor_id" id="supervisor_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($supervisors as $supervisor)
                                <option value="{{ $supervisor->id }}">{{ $supervisor->full_name }}</option>
                            @endforeach
                        </select>
                        @error('supervisor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3" wire:ignore>
                        <label class="form-label" for="customer_text">@lang('transferservice::labels.lbl_customer') <span class="text-danger">*</span> </label>
                        <input wire:model="customer_text" id="customer_text" class="form-control basicAutoComplete" type="text" placeholder="" data-url="{{ route('service_odt_requests_search') }}" autocomplete="off" />
                        @error('customer_text')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="local_id">@lang('transferservice::labels.lbl_local') <span class="text-danger">*</span> </label>
                        <select wire:model="local_id" id="local_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($locals as $local)
                                <option value="{{ $local->id }}">{{ $local->name }}</option>
                            @endforeach
                        </select>
                        @error('local_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="wholesaler_id">@lang('transferservice::labels.lbl_wholesaler') <span class="text-danger">*</span> </label>
                        <select wire:model="wholesaler_id" id="wholesaler_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($wholesalers as $wholesaler)
                                <option value="{{ $wholesaler->id }}">{{ $wholesaler->number }} - {{ $wholesaler->full_name }}</option>
                            @endforeach
                        </select>
                        @error('wholesaler_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3" wire:ignore>
                        <label class="form-label" for="event_date">@lang('transferservice::labels.lbl_event_date') <span class="text-danger">*</span> </label>
                        <input wire:model="event_date" type="text" class="form-control" id="txt_event_date" required="" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true">
                        @error('event_date')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="transfer_date">@lang('transferservice::labels.lbl_transfer_date') </label>
                        <input wire:model="transfer_date" type="text" class="form-control" id="txt_transfer_date" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true">
                        @error('transfer_date')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="pick_up_date">@lang('transferservice::labels.lbl_pick_up_date') </label>
                        <input wire:model="pick_up_date" type="text" class="form-control" id="txt_pick_up_date" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true">
                        @error('pick_up_date')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="application_date">@lang('transferservice::labels.lbl_application_date') </label>
                        <input wire:model="application_date" type="text" class="form-control" id="txt_application_date" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true">
                        @error('application_date')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="additional_information">@lang('transferservice::labels.lbl_additional_information') </label>
                        <textarea wire:model="additional_information" type="text" class="form-control" id="additional_information"></textarea>
                        @error('additional_information')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <div id="xyDivUploadFile" wire:ignore>
                            <label class="form-label" for="file">@lang('transferservice::labels.lbl_file') <span class="text-danger">*</span> </label>
                            <div class="custom-file">
                                <input wire:model="file" type="file" class="custom-file-input" id="file">
                                <label class="custom-file-label" for="customFile">@lang('transferservice::labels.lbl_choose_file')</label>
                                @if($file_view)
                                    <a href="{{ $file_view }}" alt="Archivo" target="_blank" class="btn btn-success waves-effect waves-themed" width="150px"><span class="fal fa-download mr-1"></span> @lang('transferservice::labels.lbl_file')</a>
                                @endif
                            </div>
                        </div>
                        @error('file')
                        <div class="invalid-feedback-2" id="xyDivErrorFile">{{ $message }}</div>
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
            @can('serviciodetraslados_solicitudes_odt')
                <a href="{{ route('service_odt_requests_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('transferservice::buttons.btn_list')</a>
            @endcan
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_save')</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('ser-odtrequests-edit', event => {
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
            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
            @this.set('customer_id',item.value);
            @this.set('customer_text',item.text);
            });

            $(":input").inputmask();
            var controls = {
                leftArrow: "<i class='fal fa-angle-left' style='font-size: 1.25rem'></i>",
                rightArrow: "<i class='fal fa-angle-right' style='font-size: 1.25rem'></i>"
            }

            $("#txt_event_date").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
            @this.set('event_date',this.value);
            });

            $("#txt_transfer_date").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
            @this.set('transfer_date', this.value);
            });

            $("#txt_pick_up_date").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
            @this.set('pick_up_date', this.value);
            });

            $("#txt_application_date").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
            @this.set('application_date', this.value);
            });
        });
    </script>
</div>
