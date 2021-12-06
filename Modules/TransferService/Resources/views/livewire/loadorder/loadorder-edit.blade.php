<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <h2 class="fw-700 m-0"><i class="subheader-icon fal fa-paper-plane"></i> @lang('transferservice::labels.lbl_odtlisting_detail'):</h2>
        </div>
        <div class="card-body p-0">
            @if($this->departure_date == null or $this->departure_date == '')
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <div class="table-responsive">
                        <table class="table m-0" id="tbl_odtpending">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input pending_item_odt" id="chkPending" onclick="checkAllMaestro($(this), 'tbl_odtpending', 1); ">
                                        <label class="custom-control-label" for="chkPending"></label>
                                    </div>
                                </th>
                                <th class="text-center">{{ __('transferservice::labels.lbl_code') }}</th>
                                <th class="">{{ __('transferservice::labels.lbl_event') }}</th>
                                <th class="">{{ __('transferservice::labels.lbl_customer') }}</th>
                                <th class="text-center">{{ __('transferservice::labels.lbl_event_date') }}</th>
                                <th class="">{{ __('transferservice::labels.lbl_item') }}</th>
                                <th class="text-center">{{ __('transferservice::labels.lbl_requested_amount') }}</th>
                                <th class="text-center">{{ __('transferservice::labels.lbl_quantity_served') }}</th>
                                <th class="text-center">{{ __('transferservice::labels.lbl_pending_quantity') }}</th>
                                <th class="text-center">{{ __('transferservice::labels.lbl_amount') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($odt_pending as $key => $odt)
                                @if($odt_number_aux != $odt->internal_id)
                                    <tr style="font-weight: bold;">
                                        <td colspan="8">{{$odt_number_aux = $odt->internal_id }}: {{ $odt->name_evento }} ( {{ \Carbon\Carbon::parse($odt->date_start)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($odt->date_end)->format('d/m/Y') }} )</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="text-center align-middle">{{ $key + 1 }}</td>
                                    <td class="text-center tdw-50 align-middle">
                                        <div class="btn-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input pending_item_odt" value="{{$odt->id}}" data-amount="{{$odt->amount}}" id="chkPending{{$key}}">
                                                <label class="custom-control-label" for="chkPending{{$key}}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $odt->internal_id }}</td>
                                    <td class="align-middle">{{ $odt->name_evento }}</td>
                                    <td class="align-middle">{{ $odt->name_customer }}</td>
                                    <td class="align-middle text-center">{{ \Carbon\Carbon::parse($odt->date_start)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($odt->date_end)->format('d/m/Y') }}</td>
                                    <td class="align-middle">{{ $odt->name_item }}</td>
                                    <td class="align-middle text-center">{{ $odt['amount'] }}</td>
                                    <td class="align-middle text-center">{{ $odt['quantity_served'] }}</td>
                                    <td class="align-middle text-center">{{ $odt['amount_pending'] }}</td>
                                    <td class="align-middle text-center"><input name="quantity[]" class="col-6" type="number" min="1" max="{{ $odt['amount_pending'] }}" id="quantity{{$key}}" style="height: 30px;" value="{{ $odt['amount_pending'] }}"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 mb-3 text-center">
                    <button onclick="saveItemsODT()" wire:loading.attr="disabled" type="button" class="btn btn-primary ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_add_items_odt')</button>
                    <br>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <h2 class="fw-700 m-0"><i class="subheader-icon fal fa-people-carry"></i> @lang('transferservice::labels.lbl_load_order'):</h2>
        </div>
        <div class="card-body p-0">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row p-3">
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="uuid">@lang('transferservice::labels.lbl_code') <span class="text-danger">*</span> </label>
                        <input wire:model.defer="uuid" id="uuid" type="text" class="form-control" readonly />
                        @error('uuid')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="vehicle_type_id">@lang('transferservice::labels.lbl_vehicle') <span class="text-danger">*</span> </label>
                        <select wire:model="vehicle_id" wire:model.defer wire:change="selWeight" id="vehicle_id" class="custom-select" required="">
                            <option value="">@lang('transferservice::labels.lbl_select')</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->license_plate.' - '.$vehicle->mark.' - '.$vehicle->model.' - '.$vehicle->color }}</option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="charge_maximum">@lang('transferservice::labels.lbl_maximum_vehicle_load') <span class="text-danger">*</span> </label>
                        <input wire:model.defer="charge_maximum" id="charge_maximum" type="text" class="form-control" readonly />
                        @error('charge_maximum')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="charge_weight">@lang('transferservice::labels.lbl_charge_weight') <span class="text-danger">*</span> </label>
                        <input wire:model.defer="charge_weight" id="charge_weight" type="text" class="form-control" readonly />
                        @error('charge_weight')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="upload_date">@lang('transferservice::labels.lbl_upload_date') <span class="text-danger">*</span> </label>
                        <input wire:model="upload_date" type="text" class="form-control" id="upload_date" required="" />
                        @error('upload_date')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="charging_time">@lang('transferservice::labels.lbl_charging_time')</label>
                        <input wire:model="charging_time" type="text" class="form-control datetime" id="charging_time" />
                        @error('charging_time')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="count_items">@lang('transferservice::labels.lbl_amount') @lang('transferservice::labels.lbl_item') <span class="text-danger">*</span> </label>
                        <input wire:model.defer="count_items" type="text" class="form-control" id="count_items" readonly />
                        @error('count_items')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="additional_information">@lang('transferservice::labels.lbl_additional_information') </label>
                        <textarea wire:model.defer="additional_information" class="form-control" id="additional_information"></textarea>
                        @error('additional_information')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div class="table-responsive">
                            <table class="table m-0" id="tbl_addOdtPending">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">{{ __('transferservice::labels.lbl_actions') }}</th>
                                    <th class="text-center">{{ __('transferservice::labels.lbl_code') }}</th>
                                    <th class="">{{ __('transferservice::labels.lbl_event') }}</th>
                                    <th class="">{{ __('transferservice::labels.lbl_customer') }}</th>
                                    <th class="text-center">{{ __('transferservice::labels.lbl_event_date') }}</th>
                                    <th class="">{{ __('transferservice::labels.lbl_item') }}</th>
                                    <th class="text-center">{{ __('transferservice::labels.lbl_amount') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oc_registers as $key => $oc_register)
                                    @if($odt_add_aux != $oc_register->internal_id)
                                        <tr style="font-weight: bold;">
                                            <td colspan="8">{{$odt_add_aux = $oc_register->internal_id }}: {{ $oc_register->name_evento }} ( {{ \Carbon\Carbon::parse($oc_register->date_start)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($oc_register->date_end)->format('d/m/Y') }} )</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                                        <td class="text-center tdw-50 align-middle">
                                            <div class="btn-group">
                                                @if($this->departure_date == null or $this->departure_date == '')
                                                <button onclick="confirmDelete({{ $oc_register->id }})" type="button" class="dropdown-item text-danger">
                                                    <i class="fal fa-trash-alt mr-1"></i>
                                                </button>
                                                @else
                                                <button type="button" class="dropdown-item text-danger">
                                                    <i class="fal fa-trash-alt mr-1"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $oc_register->internal_id }}</td>
                                        <td class="align-middle">{{ $oc_register->name_evento }}</td>
                                        <td class="align-middle">{{ $oc_register->name_customer }}</td>
                                        <td class="align-middle text-center">{{ \Carbon\Carbon::parse($oc_register->date_start)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($oc_register->date_end)->format('d/m/Y') }}</td>
                                        <td class="align-middle">{{ $oc_register->name_item }}</td>
                                        <td class="align-middle text-center">{{ $oc_register->amount }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('service_load_order_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('transferservice::buttons.btn_list')</a>
            @if($this->departure_date == null or $this->departure_date == '')
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_save')</button>
            @endif
        </div>
    </div>
    <script type="text/javascript">
        function saveItemsODT(){
            let cantidad = 0;
            let registros = "";
            let errors = 0;
            $("#tbl_odtpending > tbody > tr").each(function(i, e) {
                let elemento = $(e);
                let celdasTD = elemento.children("td").eq(1).find("input").eq(0);
                let celdasCant = elemento.children("td").eq(10).find("input").eq(0);
                let cantidad_aux = parseInt(celdasTD.attr('data-amount'));
                celdasCant.css({'color':'', 'border-color':''});
                if (celdasTD.is(":checked")) {
                    if(parseInt(celdasCant.val()) <= cantidad_aux && parseInt(celdasCant.val()) > 0) {
                        if (cantidad == 0) {
                            registros = celdasTD.val()+'#'+cantidad_aux+'#'+parseInt(celdasCant.val());
                        } else {
                            registros = registros + '|' + celdasTD.val() +'#'+cantidad_aux+ '#'+parseInt(celdasCant.val());
                        }
                        cantidad++;
                    }else{
                        celdasCant.css({'color':'#cd0e0e', 'border-color':'#cd0e0e'});
                        errors++;
                    }
                }
            })
            if(cantidad == 0 || errors > 0){
                let message_error = errors >0?'{{__('transferservice::messages.msg_0009')}}':'{{__('transferservice::messages.msg_0005')}}';
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_attention')}}!</span>",
                    message: "<span><strong>"+message_error+"... </strong></span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(239,56,32,0.5)'});
            }else{
                @this.saveItemsODT(registros);
                $('.pending_item_odt').prop('checked', false);
            }
        }

        function checkAllMaestro(obj, grid, posicion = 1){
            var xfaltantes = 0;
            if(obj.is(":checked")){
                $("#"+grid+" > tbody > tr").each(function(){
                    var i = $(this).css("display");
                    if(i !== "none"){
                        let estado = $(this).find("td:eq(" + posicion + ")").find(":checkbox").attr('disabled');
                        if(estado == undefined) {
                            $(this).find("td:eq(" + posicion + ")").find(":checkbox").prop("checked", true);
                        }
                    }else{
                        xfaltantes++;
                    }
                });

                if(xfaltantes > 0)
                    obj.prop("checked", false);
            }else{
                $($("#"+grid+" > tbody > tr").get().reverse()).each(function(){
                    var i = $(this).css("display");
                    if(i !== "none"){
                        $(this).find("td:eq("+posicion+")").find(":checkbox").prop("checked", false);
                    }
                });
            }
        }

        document.addEventListener('ser-load-order-save', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_success')}}!</span>",
                message: "<span><strong>{{__('transferservice::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(8,187,1,0.5)'});
        });
        //Para Eliminar
        function confirmDelete(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> {{__('transferservice::messages.msg_0001')}}",
                message: "<span><strong>{{__('transferservice::labels.lbl_warning')}}: </strong> {{__('transferservice::messages.msg_0002')}}</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                    {
                        confirm:
                            {
                                label: '{{ __('transferservice::buttons.btn_yes') }}',
                                className: 'btn-danger shadow-0'
                            },
                        cancel:
                            {
                                label: '{{ __('transferservice::buttons.btn_not') }}',
                                className: 'btn-default'
                            }
                    },
                className: "modal-alert",
                closeButton: false,
                callback: function(result) {
                    if(result){
                        @this.deleteItemODT(id);
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('ser-load-order-item-delete', event => {
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
        //Fin Eliminar

        document.addEventListener('livewire:load', function () {
            $('.pending_item_odt').prop('checked', false);
            $("#upload_date").inputmask('99/99/9999');
            $("#charging_time").inputmask("99:99",{
                "onincomplete": function(){

                },
                "oncomplete": function (){
                @this.set('charging_time',this.value);
                }
            });

            var controls = {
                leftArrow: "<i class='fal fa-angle-left' style='font-size: 1.25rem'></i>",
                rightArrow: "<i class='fal fa-angle-right' style='font-size: 1.25rem'></i>"
            }

            $("#upload_date").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
            @this.set('upload_date',this.value);
            });
        });
    </script>
</div>
