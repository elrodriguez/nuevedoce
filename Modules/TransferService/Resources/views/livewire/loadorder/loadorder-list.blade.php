<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group bg-white shadow-inset-2">
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
                    @if($search)
                        <button wire:click="$set('search', '')" type="button" class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    @else
                        <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    @endif
                </div>
                <input wire:keydown.enter="loadorderSearch" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="{{__('transferservice::labels.lbl_type_here')}}">
                <div class="input-group-append">
                    <button wire:click="loadorderSearch" class="btn btn-default waves-effect waves-themed" type="button">@lang('transferservice::buttons.btn_search')</button>
                    @can('serviciodetraslados_orden_carga_nuevo')
                        <a href="{{ route('service_load_order_create') }}" class="btn btn-success waves-effect waves-themed" type="button">@lang('transferservice::buttons.btn_new')</a>
                    @endcan
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
                    <th>@lang('labels.state')</th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($loadorders as $key => $loadorder)
                    <tr>
                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                        <td class="text-center tdw-50 align-middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fal fa-cogs"></i>
                                </button>
                                <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                    @can('serviciodetraslados_orden_carga')
                                        <a href="{{ route('service_load_order_edit', $loadorder->id) }}" class="dropdown-item">
                                            <i class="fal fa-pencil-alt mr-1"></i>@lang('transferservice::buttons.btn_edit')
                                        </a>
                                    @endcan
                                    <a wire:click="getLoadOrderDetails({{ $loadorder->id }})" href="javascript:void(0)" class="dropdown-item text-info">
                                        <i class="fal fa-list-ol mr-1"></i>@lang('labels.see_details')
                                    </a>
                                    <a href="{{ route('service_load_order_pdf', $loadorder->id) }}" class="dropdown-item text-success">
                                        <i class="fal fa-print mr-1"></i>@lang('transferservice::buttons.btn_print_oc')
                                    </a>
                                    @can('serviciodetraslados_orden_carga_guias')
                                    <a href="{{ route('service_load_order_guide', $loadorder->id) }}" class="dropdown-item text-warning">
                                        <i class="fal fa-clone mr-1"></i>@lang('transferservice::labels.lbl_generate_guides')
                                    </a>
                                    @endcan
                                    @can('serviciodetraslados_orden_carga_eliminar')
                                        <div class="dropdown-divider"></div>
                                        @if($loadorder->departure_date == null or $loadorder->departure_date == '')
                                        <button onclick="confirmDelete({{ $loadorder->id }})" type="button" class="dropdown-item text-danger">
                                            <i class="fal fa-trash-alt mr-1"></i>@lang('transferservice::buttons.btn_delete')
                                        </button>
                                        @else
                                        <button onclick="confirmNoDelete({{ $loadorder->id }})" type="button" class="dropdown-item text-danger">
                                            <i class="fal fa-trash-alt mr-1"></i>@lang('transferservice::buttons.btn_delete')
                                        </button>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ $loadorder->uuid }}</td>
                        <td class="align-middle">{{ date('d/m/Y', strtotime($loadorder->upload_date)) }}</td>
                        <td class="align-middle">{{ $loadorder->charging_time }}</td>
                        <td class="align-middle">{{ $loadorder->name }}</td>
                        <td class="align-middle">{{ $loadorder->license_plate }}</td>
                        <td class="align-middle">
                            @if($loadorder->state == 'P')
                                <span class="badge badge-secondary">{{ __('transferservice::labels.lbl_slope_load') }}</span>
                            @elseif($loadorder->state == 'E')
                                <span class="badge badge-success">{{ __('transferservice::labels.lbl_in_service') }}</span>
                            @elseif($loadorder->state == 'A')
                                <span class="badge badge-primary">{{ __('transferservice::labels.lbl_returned') }}</span>
                            @elseif($loadorder->state == 'B')
                                <span class="badge badge-info">{{ __('transferservice::labels.lbl_pending_return') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer card-footer-background pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto">{{ $loadorders->links() }}</div>
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
        function confirmNoDelete(){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_error')}}!</span>",
                message: "<span><strong>{{__('transferservice::labels.lbl_warning')}}... </strong>{{__('transferservice::messages.msg_no_delete')}}</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        }
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
                        @this.deleteLoadOrder(id);
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('ser-load-order-delete', event => {
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
        document.addEventListener('ser-load-order-details', event => {
            $('#modalLoadOrderDetails').modal('show');
        });
    </script>
</div>
