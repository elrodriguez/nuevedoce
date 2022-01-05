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
                <input wire:keydown.enter="itemPartsSearch" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="@lang('inventory::labels.lbl_type_here')">
                <div class="input-group-append">
                    <button wire:click="itemPartsSearch" class="btn btn-default waves-effect waves-themed" type="button">@lang('inventory::labels.btn_search')</button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">@lang('inventory::labels.lbl_actions')</th>
                    <th>@lang('inventory::labels.name')</th>
                    <th>@lang('inventory::labels.description')</th>
                    <th>@lang('inventory::labels.lbl_amount')</th>
                    <th>@lang('inventory::labels.weight')</th>
                    <th>@lang('inventory::labels.width')</th>
                    <th>@lang('inventory::labels.long')</th>
                    <th>@lang('inventory::labels.high')</th>
                    <th>@lang('inventory::labels.status')</th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($item_parts as $key => $item_part)
                    <tr>
                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                        <td class="text-center tdw-50 align-middle">
                            @can('inventario_items_parte_agregar_codigo')
                                <button wire:click="openModalCodes('{{ $item_part->name }}',{{ $item_part->part_id }},{{ $item_part->quantity }},{{ $item_part->item_part_id }},{{ $item_part->asset_id }})" type="button" class="btn btn-default btn-icon rounded-circle waves-effect waves-themed btntooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('inventory::labels.lbl_setting_codes')">
                                    <i class="fal fa-barcode-alt"></i>
                                </button>
                            @endcan
                        </td>
                        <td class="align-middle">{{ $item_part->name }}</td>
                        <td class="align-middle">{{ $item_part->description }}</td>
                        <td class="text-center align-middle">{{ $item_part->quantity }}</td>
                        <td class="align-middle">{{ $item_part->weight }}</td>
                        <td class="align-middle">{{ $item_part->width }}</td>
                        <td class="align-middle">{{ $item_part->long }}</td>
                        <td class="align-middle">{{ $item_part->high }}</td>
                        <td class="align-middle">
                            @if($item_part->status)
                                <span class="badge badge-success">{{ __('inventory::labels.active') }}</span>
                            @else
                                <span class="badge badge-danger">{{ __('inventory::labels.inactive') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer pb-0 d-flex flex-row align-items-center" style="margin-bottom: 20px;">
            <a href="{{ route('inventory_asset')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('inventory::labels.assents')</a>
            <div class="ml-auto">{{ $item_parts->links() }}</div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalArrayCodes" tabindex="-1" aria-labelledby="modalArrayCodes" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalArrayCodes"><b>{{ $modal_title }}</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('labels.actions') }}</th>
                                <th>{{ __('labels.code') }}</th>
                                <th>{{ __('labels.state') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($array_codes)
                                @foreach($array_codes as $array_code)
                                    <tr class="{{ $array_code['used'] > 0 ? 'bg-warning-500' : ''}}">
                                        <td class="text-center align-middle">
                                            @if($array_code['used'] > 0)
                                                <button 
                                                    wire:click="removeItemPartAsset({{ $array_code['id'] }},{{ $array_code['item_id'] }})"
                                                    type="button" 
                                                    class="btn btn-danger btn-sm btn-icon rounded-circle waves-effect waves-themed" 
                                                    title="Quitar Código"
                                                >
                                                    <i class="fal fa-times"></i>
                                                </button>
                                            @else
                                                <button 
                                                    wire:click="saveItemPartAsset({{ $array_code['id'] }},{{ $array_code['item_id'] }})" 
                                                    type="button" 
                                                    class="btn btn-default btn-sm btn-icon rounded-circle waves-effect waves-themed"
                                                    title="Agregar Código"
                                                >
                                                    <i class="fal fa-check"></i>
                                                </button>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $array_code['patrimonial_code'] }}</td>
                                        <td class="align-middle">
                                            @if($array_code['state'] == '00')
                                                <span class="badge badge-warning">Inactivo</span>
                                            @elseif($array_code['state'] == '01')
                                                <span class="badge badge-primary">Activo</span>
                                            @elseif($array_code['state'] == '02')
                                                <span class="badge badge-info">En reparación</span>
                                            @elseif($array_code['state'] == '03')
                                                <span class="badge badge-success">En evento</span>
                                            @elseif($array_code['state'] == '04')
                                                <span class="badge badge-danger">Perdido</span>
                                            @elseif($array_code['state'] == '05')
                                                <span class="badge badge-dark">De baja</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center align-middle" colspan="3">
                                        <div class="alert alert-danger" role="alert">
                                            No existen <strong>códigos</strong> registrados.
                                        </div>
                                    </td>
                                </tr>
                            @endif
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
        function confirmDelete(id){
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
                        @this.deleteItemPart(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }

        document.addEventListener('set-item-part-delete', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.lbl_success')}}!</span>",
                message: "<span><strong>{{__('inventory::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });

        document.addEventListener('livewire:load', function () {
            $("#spaItemName").html(':: {{ $item_name }}');
            $('.btntooltip').tooltip();
        });

        document.addEventListener('set-item-part-open-model', event => {
            $('#modalArrayCodes').modal('show');
        });

        document.addEventListener('set-item-part-asset-save', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('setting::labels.error') }}!</span>",
                message: "<span><strong>{{ __('setting::labels.went_wrong') }}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
