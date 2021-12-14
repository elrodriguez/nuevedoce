<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group input-group-multi-transition">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-default dropdown-toggle waves-effect waves-themed" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $show }}</button>
                    <div class="dropdown-menu" style="">
                        <button class="dropdown-item" wire:click="$set('show', 10)">10</button>
                        <button class="dropdown-item" wire:click="$set('show', 20)">20</button>
                        <button class="dropdown-item" wire:click="$set('show', 50)">50</button>
                        <div role="separator" class="dropdown-divider"></div>
                        <button class="dropdown-item" wire:click="$set('show', 100)">100</button>
                        <button class="dropdown-item" wire:click="$set('show', 500)">500</button>
                    </div>
                </div>
                <div class="input-group-prepend">
                    @if($search || $date_upload || $license_plate)
                        <button wire:click="clearInput" type="button" class="input-group-text text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    @else
                        <span class="input-group-text text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    @endif
                </div>
                <input wire:model="date_upload" wire:keydown.enter="loadOrderSearch" type="text" class="form-control" id="date_upload" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true" placeholder="{{__('transferservice::labels.lbl_upload_date')}}">
                <input wire:model="license_plate" wire:keydown.enter="loadOrderSearch" type="text" class="form-control" id="license_plate" onchange="this.dispatchEvent(new InputEvent('input'))" class="form-control" placeholder="{{__('transferservice::labels.lbl_license_plate')}}">
                <input wire:keydown.enter="loadOrderSearch" wire:model.defer="search" type="text" class="form-control" placeholder="{{__('transferservice::labels.lbl_load_order')}}">
                <div class="input-group-append">
                    <button wire:click="loadOrderSearch" id="loadOrderSearch" class="btn btn-default waves-effect waves-themed" type="button">@lang('transferservice::buttons.btn_search')</button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">@lang('transferservice::labels.lbl_actions')</th>
                    <th>@lang('transferservice::labels.lbl_code')</th>
                    <th>@lang('transferservice::labels.lbl_upload_date')</th>
                    <th>@lang('transferservice::labels.lbl_charging_time')</th>
                    <th>@lang('transferservice::labels.lbl_vehicle')</th>
                    <th>@lang('transferservice::labels.lbl_license_plate')</th>
                    <th>@lang('transferservice::labels.lbl_state')</th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($load_orders as $key => $item)
                    <tr>
                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                        <td class="text-center tdw-50 align-middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fal fa-cogs"></i>
                                </button>
                                <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                    @can('serviciodetraslados_orden_carga_aceptar_salida')
                                        @if($item->state == 'E')
                                            <a onclick="confirmReturn('{{$item->id}}')" class="dropdown-item">
                                                <i class="fal fa-check mr-1"></i>@lang('transferservice::labels.lbl_return')
                                            </a>
                                        @else
                                            <button class="dropdown-item" disabled>
                                                <i class="fal fa-check mr-1"></i>@lang('transferservice::labels.lbl_return')
                                            </button>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ $item->uuid }}</td>
                        <td class="align-middle">{{ date('d/m/Y', strtotime($item->upload_date)) }}</td>
                        <td class="align-middle">{{ $item->charging_time }}</td>
                        <td class="align-middle">{{ $item->name }}</td>
                        <td class="align-middle">{{ $item->license_plate }}</td>
                        <td class="align-middle">
                            @if($item->state == 'P')
                                <span class="badge badge-secondary">{{ __('transferservice::labels.lbl_slope_load') }}</span>
                            @elseif($item->state == 'E')
                                <span class="badge badge-success">{{ __('transferservice::labels.lbl_in_service') }}</span>
                            @elseif($item->state == 'A')
                                <span class="badge badge-primary">{{ __('transferservice::labels.lbl_returned') }}</span>
                            @elseif($item->state == 'B')
                                <span class="badge badge-info">{{ __('transferservice::labels.lbl_pending_return') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer card-footer-background pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto">{{ $load_orders->links() }}</div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalLoadOrderDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('labels.details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('labels.category') }}</th>
                            <th scope="col">{{ __('labels.subcategory') }}</th>
                            <th scope="col">{{ __('labels.description') }}</th>
                            <th scope="col">{{ __('transferservice::labels.lbl_accessories') }}</th>
                            <th scope="col">{{ __('labels.quantity') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loadorderdetails as $key => $loadorderdetail)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $loadorderdetail->category_name }}</td>
                                <td>{{ $loadorderdetail->asset_name }}</td>
                                <td>{{ $loadorderdetail->asset_description }}</td>
                                <td>{{ $loadorderdetail->part_name }}</td>
                                <td>{{ $loadorderdetail->quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function confirmReturn(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-success mr-2'></i> {{__('transferservice::labels.lbl_attention')}}",
                message: "<span><strong>{{__('transferservice::messages.msg_0008')}} </strong></span>",
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
                callback: function(result)
                {
                    if(result){
                    @this.acceptReturn(id);
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(19,190,0,0.5)'});
            box.find('.modal-content').css({'background-color': 'rgba(24,236,9,0.5)'});
        }
        document.addEventListener('ser-load-order-return', event => {
            $('#loadOrderSearch').unbind().click();
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
            $(":input").inputmask();
            var controls = {
                leftArrow: "<i class='fal fa-angle-left' style='font-size: 1.25rem'></i>",
                rightArrow: "<i class='fal fa-angle-right' style='font-size: 1.25rem'></i>"
            }

            $("#date_upload").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
                @this.set('date_upload',this.value);
            });
        });

        document.addEventListener('ser-load-order-details', event => {
            $('#modalLoadOrderDetails').modal('show');
        });
    </script>
</div>
