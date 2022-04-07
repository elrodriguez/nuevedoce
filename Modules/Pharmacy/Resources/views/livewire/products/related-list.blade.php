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
                            <i wire:target="search" wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    @endif
                </div>
                <input wire:keydown.enter="seriesSearch" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="Escriba aquí...">
                <div class="input-group-append">
                    <button wire:click="seriesSearch" class="btn btn-default waves-effect waves-themed" type="button">Buscar</button>
                    @can('ventas_administration_series_nuevo')
                    <a href="{{ route('pharmacy_administration_products_related_create') }}" class="btn btn-success waves-effect waves-themed" type="button">Nuevo</a>
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
                        <th class="">{{ __('pharmacy::labels.keyword') }}</th>
                        <th class="">{{ __('labels.description') }}</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if(count($relateds)>0)
                        @foreach($relateds as $key => $related)
                        <tr>
                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                            <td class="text-center tdw-50 align-middle">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fal fa-cogs"></i>
                                    </button>
                                    <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                        <a href="{{ route('pharmacy_administration_products_related_edit',$related->id) }}" class="dropdown-item">
                                            <i class="fal fa-pencil-alt mr-1"></i>{{ __('labels.edit') }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <button onclick="confirmDeleteRelated('{{ $related->id }}')" type="button" class="dropdown-item text-danger">
                                            <i class="fal fa-trash-alt mr-1"></i>{{ __('labels.delete') }}
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">{{ $related->keyword }}</td>
                            <td class="align-middle">{{ $related->description }}</td>
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
            <div class="ml-auto">{{ $relateds->links() }}</div>
        </div>
    </div>
    <script type="text/javascript">
        function confirmDeleteRelated(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='{{ env('BOOTBOX_INFO_ICON') }} text-danger mr-2'></i> ¿Desea eliminar estos datos?",
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
                        @this.destroyRelated(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': '{{ env("BOOTBOX_INFO_COLOR") }}'});
        }

        document.addEventListener('phar-related-delete', event => {
            let res = event.detail.res;

            if(res == 'success'){
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='{{ env('BOOTBOX_SUCCESS_ICON') }} text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.success') }}!</span>",
                    message: "<span><strong>{{ __('inventory::labels.excellent') }}... </strong>{{ __('inventory::labels.msg_delete') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': '{{ env("BOOTBOX_SUCCESS_COLOR") }}'});
            }else{
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='{{ env('BOOTBOX_ERROR_ICON') }} text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.error') }}!</span>",
                    message: "<span><strong>{{ __('inventory::labels.went_wrong') }}... </strong>{{ __('inventory::labels.msg_not_peptra') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': '{{ env("BOOTBOX_ERROR_COLOR") }}'});
            }
        });
    </script>
</div>
