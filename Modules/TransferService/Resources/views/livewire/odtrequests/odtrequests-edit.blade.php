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
                <div id="xyzDivAssets">
                    <div class="form-row p-3">
                        <h2 class="fw-700 m-0"><i class="subheader-icon fal fa-boxes"></i> @lang('transferservice::labels.lbl_add_assets'):</h2>
                        <br>
                    </div>
                    <div class="form-row p-3">
                        <div class="col-md-7 mb-3" wire:ignore>
                            <label class="form-label" for="item_text">@lang('transferservice::labels.lbl_asset') </label>
                            <input wire:model="item_text" id="item_text" class="form-control autoCompleteItem" type="text" placeholder="" data-url="{{ route('service_odt_items_search') }}" autocomplete="off" />
                            <input wire:model="item_id" id="item_id" type="hidden" placeholder="" autocomplete="off" />
                            @error('item_text')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="amount">@lang('inventory::labels.lbl_amount') <span class="text-danger">*</span> </label>
                            <input wire:model="amount" wire:ignore type="number" class="form-control" id="amount" min="1" required="">
                            @error('amount')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3" style="margin-top: 23px;">
                            <a onclick="validatesaveItem()" wire:ignore wire:loading.attr="disabled" class="btn btn-primary ml-auto waves-effect waves-themed" style="color: white;"><i class="fal fa-plus"></i> @lang('inventory::labels.lbl_add')</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{ __('labels.actions') }}</th>
                                        <th>{{ __('labels.name') }}</th>
                                        <th class="text-center">@lang('inventory::labels.lbl_amount')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items_data as $key => $item)
                                        <tr>
                                            <td class="text-center align-middle">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fal fa-cogs"></i>
                                                    </button>
                                                    <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                                        <div class="dropdown-divider"></div>
                                                        <button onclick="confirmDeleteItem({{ $item['id'] }})" type="button" class="dropdown-item text-danger">
                                                            <i class="fal fa-trash-alt mr-1"></i> @lang('inventory::labels.lbl_delete')
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">{{ $item['name'] }}</td>
                                            <td class="text-center align-middle">{{ $item['amount'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
        function validatesaveItem(){
            let id_pp = $("#item_id").val();
            if(id_pp > 0){
                $('#item_text').css('color', '');
                $('#item_text').css('border-color', '');
                @this.saveItem();
            }else{
                alert("Busque y seleccione el activo ha agregar.");
                $('#item_text').css('color', 'red');
                $('#item_text').css('border-color', 'red');
            }
        }

        function confirmDeleteItem(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> {{__('inventory::labels.msg_0001')}}",
                message: "<span><strong>{{__('inventory::labels.lbl_warning')}}: </strong> {{__('inventory::labels.msg_0002')}}</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                    {
                        confirm:
                            {
                                label: '{{__('inventory::labels.btn_yes')}}',
                                className: 'btn-danger shadow-0'
                            },
                        cancel:
                            {
                                label: '{{__('inventory::labels.btn_not')}}',
                                className: 'btn-default'
                            }
                    },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        @this.deleteOdtItem(id);
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }

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
        document.addEventListener('inv-item-edit', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_success') }}!</span>",
                message: "<span><strong>{{ __('transferservice::labels.lbl_excellent') }}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('inv-item-edit-not', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_warning') }}!</span>",
                message: "<span>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('set-odt-item-delete', event => {
            let res = event.detail.res;
            if(res == 'success'){
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_success') }}!</span>",
                    message: "<span><strong>{{ __('transferservice::labels.lbl_excellent') }}... </strong>{{ __('transferservice::messages.msg_delete') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }else{
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_error') }}!</span>",
                    message: "<span><strong>{{ __('transferservice::labels.lbl_went_wrong') }}... </strong></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }
        });
        document.addEventListener('livewire:load', function () {
            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                @this.set('customer_id',item.value);
                @this.set('customer_text',item.text);
            });

            $('.autoCompleteItem').autoComplete().on('autocomplete.select', function (evt, item) {
                @this.set('item_id',item.value);
                @this.set('item_text',item.text);
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
