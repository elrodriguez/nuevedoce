<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="description">@lang('transferservice::labels.lbl_code_internal') <span class="text-danger">*</span> </label>
                        <input wire:model="internal_id" disabled type="text" class="form-control" id="internal_id" required="">
                        @error('internal_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="description">@lang('transferservice::labels.lbl_code_backus') <span class="text-danger">*</span> </label>
                        <input wire:model="backus_id" type="text" class="form-control" id="backus_id" required="">
                        @error('backus_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label" for="description">@lang('transferservice::labels.lbl_event') <span class="text-danger">*</span> </label>
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
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3" wire:ignore>
                        <label class="form-label" for="customer_text">@lang('transferservice::labels.lbl_customer') <span class="text-danger">*</span> </label>
                        <input wire:model="customer_text" id="customer_text" class="form-control basicAutoComplete" type="text" placeholder="" data-url="{{ route('service_odt_requests_search') }}" autocomplete="off" />
                        @error('customer_text')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="wholesaler_id">@lang('transferservice::labels.lbl_wholesaler') <span class="text-danger">*</span> </label>
                        <select wire:model="wholesaler_id" id="wholesaler_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($wholesalers as $wholesaler)
                                <option value="{{ $wholesaler->id }}">{{ $wholesaler->number }} - {{ $wholesaler->full_name }}</option>
                            @endforeach
                        </select>
                        @error('wholesaler_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3" wire:ingnore>
                        <label class="form-label" for="supervisor_id">@lang('transferservice::labels.lbl_supervisor') <span class="text-danger">*</span> </label>
                        <select wire:model="supervisor_id" id="supervisor_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($supervisors as $supervisor)
                                <option value="{{ $supervisor->id }}">{{ $supervisor->full_name }}</option>
                            @endforeach
                        </select>
                        @error('supervisor_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="local_id">@lang('transferservice::labels.lbl_local') <span class="text-danger">*</span> </label>
                        <select wire:model="local_id" id="local_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($locals as $local)
                                <option value="{{ $local->id }}">{{ $local->name }}</option>
                            @endforeach
                        </select>
                        @error('local_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="date_start">@lang('transferservice::labels.lbl_date_start') </label>
                        <input wire:model="date_start" type="text" class="form-control" id="date_start" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true">
                        @error('date_start')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="date_end">@lang('transferservice::labels.lbl_date_end') </label>
                        <input wire:model="date_end" type="text" class="form-control" id="date_end" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true">
                        @error('date_end')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <div id="xyDivUploadFile" wire:ignore>
                            <label class="form-label" for="file">@lang('transferservice::labels.lbl_file') <span class="text-danger">*</span> </label>
                            <div class="custom-file">
                                <input wire:model="file" type="file" class="custom-file-input" id="file">
                                <label class="custom-file-label" for="customFile">@lang('transferservice::labels.lbl_choose_file')</label>
                            </div>
                        </div>
                        @error('file')
                        <div class="invalid-feedback-2" id="xyDivErrorFile">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="additional_information">@lang('transferservice::labels.lbl_additional_information') </label>
                        <textarea wire:model="additional_information" type="text" class="form-control" id="additional_information"></textarea>
                        @error('additional_information')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- <div class="col-md-4 mb-3">
                        <label class="form-label">@lang('transferservice::labels.lbl_state') <span class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="state" type="checkbox" class="custom-control-input" id="state" checked="">
                            <label class="custom-control-label" for="state">@lang('transferservice::labels.lbl_active')</label>
                        </div>
                        @error('state')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div> --}}
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
                closeButton: false,
                callback: function () {
                }
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

            $("#date_start").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
                @this.set('date_start',this.value);
            });

            $("#date_end").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
                @this.set('date_end', this.value);
            });

        });
    </script>
</div>
