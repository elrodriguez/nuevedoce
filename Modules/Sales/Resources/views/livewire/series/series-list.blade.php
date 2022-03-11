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
                <input wire:keydown.enter="seriesSearch" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="Escriba aquí...">
                <div class="input-group-append">
                    <button wire:click="seriesSearch" class="btn btn-default waves-effect waves-themed" type="button">Buscar</button>
                    @can('ventas_administration_series_nuevo')
                    <a href="{{ route('sales_administration_series_create') }}" class="btn btn-success waves-effect waves-themed" type="button">Nuevo</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">{{ __('labels.actions') }}</th>
                        <th class="text-center">{{ __('labels.serie') }}</th>
                        <th class="text-center">{{ __('labels.number') }}</th>
                        <th>{{ __('labels.establishment') }}</th>
                        <th>{{ __('labels.voucher_type') }}</th>
                        <th class="text-center">{{ __('labels.state') }}</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if(count($series)>0)
                        @foreach($series as $key => $serie)
                        <tr>
                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                            <td class="text-center tdw-50 align-middle">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fal fa-cogs"></i>
                                    </button>
                                    <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                        @can('ventas_administration_series_editar')
                                        <a href="{{ route('sales_administration_serie_edit',$serie->id) }}" class="dropdown-item">
                                            <i class="fal fa-pencil-alt mr-1"></i>{{ __('labels.edit') }}
                                        </a>
                                        @endcan
                                        <div class="dropdown-divider"></div>
                                        @can('ventas_administration_series_eliminar')
                                        <button onclick="confirmDelete('{{ $serie->id }}')" type="button" class="dropdown-item text-danger">
                                            <i class="fal fa-trash-alt mr-1"></i>{{ __('labels.delete') }}
                                        </button>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center">{{ $serie->id }}</td>
                            <td class="align-middle text-right">{{ $serie->correlative }}</td>
                            <td class="align-middle">{{ $serie->name }}</td>
                            <td class="align-middle">{{ $serie->description }}</td>
                            <td class="align-middle">
                                @if($serie->status)
                                <span class="badge badge-warning">{{ __('inventory::labels.active') }}</span>
                                @else
                                <span class="badge badge-danger">{{ __('inventory::labels.inactive') }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="dataTables_empty text-center" valign="top">{{ __('labels.no_records_to_display') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer  pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto">{{ $series->links() }}</div>
        </div>
    </div>
    <script type="text/javascript">
        function confirmDelete(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> ¿Desea eliminar estos datos?",
                message: "<span><strong>Advertencia: </strong> ¡Esta acción no se puede deshacer!</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                {
                    confirm:
                    {
                        label: 'Si',
                        className: 'btn-danger shadow-0'
                    },
                    cancel:
                    {
                        label: 'No',
                        className: 'btn-default'
                    }
                },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        @this.deleteserie(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }

        document.addEventListener('set-serie-delete', event => {
            let res = event.detail.res;

            if(res == 'success'){
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.success') }}!</span>",
                    message: "<span><strong>{{ __('inventory::labels.excellent') }}... </strong>{{ __('inventory::labels.msg_delete') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }else{
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.error') }}!</span>",
                    message: "<span><strong>{{ __('inventory::labels.went_wrong') }}... </strong>{{ __('inventory::labels.msg_not_peptra') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(206, 77, 62, 0.5)'});
            }
        });
    </script>
</div>
