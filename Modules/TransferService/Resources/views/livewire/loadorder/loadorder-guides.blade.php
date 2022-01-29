<div class="panel-content">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a id="tabguide1" class="nav-link active" data-toggle="tab" href="#tab-guide-1">@lang('transferservice::labels.lbl_exit_guide')</a></li>
        <li class="nav-item"><a id="tabguide2" class="nav-link" data-toggle="tab" href="#tab-guide-2">@lang('transferservice::labels.lbl_entry_guide')</a></li>
    </ul>
    <div class="tab-content border border-top-0 p-3">
        <div class="tab-pane fade active show" id="tab-guide-1" role="tabpanel">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left col-3">
                            <div class="rounded-top color-fusion-300 w-100">
                                <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-6x">
                                    <i class="fal fa-truck-moving"></i>
                                </div>
                            </div>
                        </div>
                        <div class="float-left col-4">
                            <div class="row">
                                <div class="col-12 text-center text-uppercase"><h4>{{ $name_bussines }}</h4></div>
                                <div class="col-12 text-center">{{ $address_bussines }}</div>
                                <div class="col-12 text-center">{{ $tradename  }}</div>
                                <div class="col-12 text-center">{{ $email_bussines }}</div>
                                <div class="col-12 text-center">{{ $telephone_bussines }}</div>
                                <div class="col-12 text-center">{{ $cell_phone_bussines }}</div>
                            </div>
                        </div>
                        <div class="float-right col-4">
                            <div class="row border border-warning rounded">
                                <div class="col-12 text-center"><h2>@lang('transferservice::labels.lbl_ruc'): {{ $ruc_company }}</h2></div>
                                <div class="col-12 text-center">&nbsp;</div>
                                <div class="col-12 text-center"><h2>{{ $name_document }}</h2></div>
                                <div class="col-12 text-center"><h2>{{ $serie }} - {{ $this->number_format }}</h2></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <fieldset class="border border p-2">
                                    <legend class="w-auto" id="div_titulo_container">@lang('transferservice::labels.lbl_addressee')</legend>
                                    <table class="ml-2" style="width: 95%;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_date_of_issue')</td>
                                                <td style="width: 80%;">: {{ $this->date_of_issue_d }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">@lang('transferservice::labels.lbl_business_name')</td>
                                                <td>: {{ $business_name_d }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">@lang('transferservice::labels.lbl_ruc')</td>
                                                <td>: {{ $ruc_d }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                            <div class="col-sm-12">
                                <fieldset class="border border p-2">
                                    <legend class="w-auto" id="div_titulo_container">@lang('transferservice::labels.lbl_shipment')</legend>
                                    <table class="ml-2" style="width: 95%;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_shipping_type')</td>
                                            <td style="width: 30%;">: {{ $shipping_type }}</td>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_shipping_date')</td>
                                            @if($shipping_date_f == '')
                                                <td style="width: 30%;">: <label class="border border-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                                            @else
                                                <td style="width: 30%;">: <input type="date" wire:model.defer="shipping_date_f"></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_total_gross_weight')</td>
                                            <td style="width: 30%;">: {{ $total_gross_weight }} @lang('transferservice::labels.lbl_kilograms')</td>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_number_of_packages')</td>
                                            <td style="width: 30%;">: {{ $number_of_packages }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">@lang('transferservice::labels.lbl_starting_point')</td>
                                            <td colspan="3">: {{ $starting_point }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">@lang('transferservice::labels.lbl_arrival_point')</td>
                                            <td colspan="3">: {{ $arrival_point }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                            <div class="col-sm-12">
                                <fieldset class="border border p-2">
                                    <legend class="w-auto" id="div_titulo_container">@lang('transferservice::labels.lbl_transport')</legend>
                                    <table class="ml-2" style="width: 95%;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_type_of_transport')</td>
                                            <td style="width: 30%;">: {{ $type_of_transport }}</td>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_license_plate')</td>
                                            <td style="width: 30%;">: {{ $license_plate }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_carrier')</td>
                                            <td style="width: 30%;">: {{ $carrier }}</td>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_dni')</td>
                                            <td style="width: 30%;">: {{ $document_carrier }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        </div>
                        <fieldset class="border border p-2">
                            <legend class="w-auto" id="div_titulo_container"></legend>
                            <div class="table-responsive-sm">
                                <table class="table m-0 table-hover" wire:ignore.self>
                                    <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>@lang('transferservice::labels.lbl_qty')</th>
                                        <th>@lang('transferservice::labels.lbl_unit')</th>
                                        <th>@lang('transferservice::labels.lbl_code')</th>
                                        <th>@lang('transferservice::labels.lbl_description')</th>
                                        <th class="align-middle">{{ __('labels.codes') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($loadorderdetails as $key => $item)
                                        <tr>
                                            <td class="align-middle">{{ $key+1 }}</td>
                                            <td class="align-middle">{{ $item['quantity'] }}</td>
                                            <td class="align-middle">{{ $item['unit'] }}</td>
                                            <td class="align-middle">{{ str_pad($item['code'], 6, '0', STR_PAD_LEFT) }}</td>
                                            @if($id_guide_exit == '')
                                                <td class="align-middle">{{ $item['asset_name'] }} - {{ $item['part_name'] }}</td>
                                            @else
                                                <td class="align-middle">{{ $item['asset_name'] }}</td>
                                            @endif
                                            <td class="align-middle">
                                                @if(count($item['assets']) > 0)
                                                    <div wire:ignore>
                                                        <select onchange="selectCodesAsset({{ $key }})" id="selectma{{ $key }}" data-maximum-selection-length="{{ $item['quantity'] }}" class="selectAsset1" multiple="multiple">
                                                            <option value="">{{ __('labels.to_select') }}</option>
                                                            @foreach($item['assets'] as $asset)
                                                                <option value="{{ $asset['id'] }}"
                                                                    @foreach($item['codes'] as $code)
                                                                        @if($code == $asset['id'])
                                                                        selected
                                                                        @endif
                                                                    @endforeach 
                                                                >
                                                                {{ $asset['patrimonial_code'] }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                    <div class="card-footer d-flex flex-row align-items-center">
                        <a href="{{ route('service_load_order_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('transferservice::buttons.btn_list')</a>
                        @if($id_guide_exit == '')
                        <button wire:click="saveExit" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_save')</button>
                        @else
                            <button onclick="confirmDelete({{ $id_guide_exit }})" type="button" class="btn btn-danger ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_delete')</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-guide-2" role="tabpanel">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left col-3">
                            <div class="rounded-top color-fusion-300 w-100">
                                <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-6x">
                                    <i class="fal fa-truck-moving"></i>
                                </div>
                            </div>
                        </div>
                        <div class="float-left col-4">
                            <div class="row">
                                <div class="col-12 text-center text-uppercase"><h4>{{ $name_bussines }}</h4></div>
                                <div class="col-12 text-center">{{ $address_bussines }}</div>
                                <div class="col-12 text-center">{{ $tradename  }}</div>
                                <div class="col-12 text-center">{{ $email_bussines }}</div>
                                <div class="col-12 text-center">{{ $telephone_bussines }}</div>
                                <div class="col-12 text-center">{{ $cell_phone_bussines }}</div>
                            </div>
                        </div>
                        <div class="float-right col-4">
                            <div class="row border border-warning rounded">
                                <div class="col-12 text-center"><h2>@lang('transferservice::labels.lbl_ruc'): {{ $ruc_company }}</h2></div>
                                <div class="col-12 text-center">&nbsp;</div>
                                <div class="col-12 text-center"><h2>{{ $name_document }}</h2></div>
                                <div class="col-12 text-center"><h2>{{ $serie }} - {{ $this->number_return_format }}</h2></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <fieldset class="border border p-2">
                                    <legend class="w-auto" id="div_titulo_container">@lang('transferservice::labels.lbl_addressee')</legend>
                                    <table class="ml-2" style="width: 95%;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_date_of_issue')</td>
                                            <td style="width: 80%;">: {{ $this->date_of_issue_d }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">@lang('transferservice::labels.lbl_business_name')</td>
                                            <td>: {{ $business_name_d }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">@lang('transferservice::labels.lbl_ruc')</td>
                                            <td>: {{ $ruc_d }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                            <div class="col-sm-12">
                                <fieldset class="border border p-2">
                                    <legend class="w-auto" id="div_titulo_container">@lang('transferservice::labels.lbl_shipment')</legend>
                                    <table class="ml-2" style="width: 95%;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_shipping_type')</td>
                                            <td style="width: 30%;">: {{ $shipping_type }}</td>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_shipping_date')</td>
                                            @if($shipping_date_f == '')
                                                <td style="width: 30%;">: <label class="border border-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                                            @else
                                                <td style="width: 30%;">: {{ $shipping_date_f }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_total_gross_weight')</td>
                                            <td style="width: 30%;">: {{ $total_gross_weight }} @lang('transferservice::labels.lbl_kilograms')</td>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_number_of_packages')</td>
                                            <td style="width: 30%;">: {{ $number_of_packages }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">@lang('transferservice::labels.lbl_starting_point')</td>
                                            <td colspan="3">: {{ $starting_point_r }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">@lang('transferservice::labels.lbl_arrival_point')</td>
                                            <td colspan="3">: {{ $arrival_point_r }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                            <div class="col-sm-12">
                                <fieldset class="border border p-2">
                                    <legend class="w-auto" id="div_titulo_container">@lang('transferservice::labels.lbl_transport')</legend>
                                    <table class="ml-2" style="width: 95%;">
                                        <tbody>
                                        @if($id_guide_exit == '')
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_type_of_transport')</td>
                                            <td style="width: 30%;">: {{ $type_of_transport }}</td>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_vehicle')</td>
                                            <td style="width: 30%; display: ruby;">:
                                                <select wire:model.defer="vehicle_id_r" id="vehicle_id_r" class="custom-select" required="">
                                                    <option value="">@lang('transferservice::labels.lbl_select')</option>
                                                    @foreach($transports as $vehicle)
                                                        <option value="{{ $vehicle->id }}" data-license="{{ $vehicle->license_plate }}" data-carrier="{{ $vehicle->full_name }}" data-doc-carrier="{{ $vehicle->number }}">{{ $vehicle->license_plate.' - '.$vehicle->mark.' - '.$vehicle->model.' - '.$vehicle->color }}</option>
                                                    @endforeach
                                                </select>
                                                @error('vehicle_id')
                                                <div class="invalid-feedback-2">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_license_plate')</td>
                                            <td style="width: 30%;">: {{ $license_plate_r }}</td>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_carrier')</td>
                                            <td style="width: 30%;">: {{ $carrier_r }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_dni')</td>
                                            <td style="width: 30%;">: {{ $document_carrier_r }}</td>
                                        </tr>
                                        @else
                                            <tr>
                                                <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_type_of_transport')</td>
                                                <td style="width: 30%;">: {{ $type_of_transport }}</td>
                                                <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_license_plate')</td>
                                                <td style="width: 30%;">: {{ $license_plate_r }}</td>
                                            </tr>
                                            <tr>

                                                <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_carrier')</td>
                                                <td style="width: 30%;">: {{ $carrier_r }}</td>
                                                <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_dni')</td>
                                                <td style="width: 30%;">: {{ $document_carrier_r }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        </div>
                        <fieldset class="border border p-2">
                            <legend class="w-auto" id="div_titulo_container"></legend>
                            <div class="table-responsive-sm">
                                <table class="table m-0 table-hover" wire:ignore.sefl>
                                    <thead>
                                    <tr>
                                        <th class="align-middle">#</th>
                                        <th class="align-middle">@lang('transferservice::labels.lbl_qty')</th>
                                        <th class="align-middle">@lang('transferservice::labels.lbl_unit')</th>
                                        <th class="align-middle">@lang('transferservice::labels.lbl_code')</th>
                                        <th class="align-middle">@lang('transferservice::labels.lbl_description')</th>
                                        <th class="align-middle">{{ __('labels.codes') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($loadorderdetails as $key => $item)
                                        <tr>
                                            <td class="align-middle">{{ $key+1 }}</td>
                                            <td class="align-middle">{{ $item['quantity'] }}</td>
                                            <td class="align-middle">{{ $item['unit'] }}</td>
                                            <td class="align-middle">{{ str_pad($item['code'], 6, '0', STR_PAD_LEFT) }}</td>
                                            @if($id_guide_exit == '')
                                                <td class="align-middle">{{ $item['asset_name'] }} - {{ $item['part_name'] }}</td>
                                            @else
                                                <td class="align-middle">{{ $item['asset_name'] }}</td>
                                            @endif
                                            <td class="align-middle">
                                                @if(count($item['codes']) > 0)
                                                    @foreach($item['codes'] as $code)
                                                        <code>{{ $code }}</code>
                                                    @endforeach 
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                    <div class="card-footer d-flex flex-row align-items-center">
                        <a href="{{ route('service_load_order_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('transferservice::buttons.btn_list')</a>
                        @if($id_guide_exit == '')
                            <button wire:click="saveExit" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_save')</button>
                        @else
                            <button onclick="confirmDelete({{ $id_guide_exit }})" type="button" class="btn btn-danger ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_delete')</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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
                            label: '{{__('transferservice::buttons.btn_yes')}}',
                            className: 'btn-danger shadow-0'
                        },
                    cancel:
                        {
                            label: '{{__('transferservice::buttons.btn_not')}}',
                            className: 'btn-default'
                        }
                },
            className: "modal-alert",
            closeButton: false,
            callback: function(result)
            {
                if(result){
                @this.deleteGuideExit(id);
                }
            }
        });
        box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
    }
    document.addEventListener('ser-guide-save', event => {
        let result = event.detail.result;
        let sound_msg = 'voice_off';
        let message_a = '{{ __('transferservice::labels.lbl_warning')}}';
        let message_b = '{{ __('transferservice::labels.lbl_error')}}';
        let color_b = 'rgba(243,52,26,0.7)';
        if(result == 'OK'){
            sound_msg = 'voice_on';
            message_a = '{{ __('transferservice::labels.lbl_success')}}';
            message_b = '{{__('transferservice::labels.lbl_excellent')}}';
            color_b = 'rgba(8,187,1,0.5)';
        }
        initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', sound_msg)
        let box = bootbox.alert({
            title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>"+message_a+"!</span>",
            message: "<span><strong>"+message_b+"... </strong>"+event.detail.msg+"</span>",
            centerVertical: true,
            className: "modal-alert",
            closeButton: false,
            callback: function () {
                if(result == 'OK'){
                    location.reload();
                }
            }
        });
        box.find('.modal-content').css({'background-color': color_b});
    });

    document.addEventListener('ser-guide-delete', event => {
        initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
        let box = bootbox.alert({
            title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_success')}}!</span>",
            message: "<span><strong>{{__('transferservice::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
            centerVertical: true,
            className: "modal-alert",
            closeButton: false,
            callback: function () {
                location.reload();
            }
        });
        box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
    });

    document.addEventListener('livewire:load', function () {

        $('.selectAsset1').select2({closeOnSelect: true});

        $('#vehicle_id_r').change(function (){
            let license_r = $(this).find(':selected').attr('data-license');
            let carrier_r  = $(this).find(':selected').attr('data-carrier');
            let doc_carrier_r = $(this).find(':selected').attr('data-doc-carrier');
            @this.set('license_plate_r', license_r);
            @this.set('carrier_r', carrier_r);
            @this.set('document_carrier_r', doc_carrier_r);
            setTimeout(function (){
                $('#tabguide2').click();
            }, 1000);
        });
    });

    document.addEventListener('ser-load-order-select-assets', event => {
        $('.selectAsset').select2({closeOnSelect: true});
    });

    function selectCodesAsset(index){
        let max = $('#selectma'+index).attr('data-maximum-selection-length');
        let sel = $('#selectma'+index);

        if ( sel.val() && sel.val().length > max ) {
            return false;
        }else{
            let selected = document.querySelectorAll('#selectma'+index+' option:checked');
            let values = Array.from(selected).map(el => el.value);
            @this.set(`loadorderdetails.${index}.codes`,values);
        }

    } 
</script>
