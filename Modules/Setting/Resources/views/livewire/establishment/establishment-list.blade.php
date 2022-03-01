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
                <input wire:keydown.enter="establishmentSearch" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="Escriba aquí...">
                <div class="input-group-append">
                    <button wire:click="establishmentSearch" class="btn btn-default waves-effect waves-themed" type="button">Buscar</button>
                    <a href="{{ route('setting_establishment_create') }}" class="btn btn-success waves-effect waves-themed" type="button">Nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">{{ __('labels.actions') }}</th>
                        <th>{{ __('labels.name') }}</th>
                        <th>{{ __('setting::labels.address') }}</th>
                        <th>{{ __('setting::labels.telephone') }}</th>
                        <th>{{ __('labels.email') }}</th>
                        <th>{{ __('labels.state') }}</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach($establishments as $key => $establishment)
                    <tr>
                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                        <td class="text-center tdw-50 align-middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fal fa-cogs"></i>
                                </button>
                                <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                    @can('configuraciones_establecimientos_editar')
                                    <a href="{{ route('setting_establishment_edit',$establishment->id) }}" class="dropdown-item">
                                        <i class="fal fa-pencil-alt mr-1"></i>{{ __('labels.edit') }}
                                    </a>
                                    @endcan
                                    @can('configuraciones_establecimientos_series')
                                    <a wire:click="$emit('openModalEstablismentSeries',{{ $establishment->id }})" href="javascript:void(0)" class="dropdown-item">
                                        <i class="fal fa-hashtag mr-1"></i>{{ __('labels.series') }}
                                    </a>
                                    @endcan
                                    @can('configuraciones_establecimientos_eliminar')
                                    <div class="dropdown-divider"></div>
                                    <button onclick="confirmDelete({{ $establishment->id }})" type="button" class="dropdown-item text-danger">
                                        <i class="fal fa-trash-alt mr-1"></i>{{ __('labels.delete') }}
                                    </button>
                                    @endcan
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ $establishment->name }}</td>
                        <td class="align-middle">{{ $establishment->address }}</td>
                        <td class="align-middle">{{ $establishment->phone }}</td>
                        <td class="align-middle">{{ $establishment->email }}</td>
                        <td class="align-middle">
                            @if($establishment->state)
                            <span class="badge badge-warning">{{ __('labels.active') }}</span>
                            @else
                            <span class="badge badge-danger">{{ __('labels.inactive') }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer  pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto">{{ $establishments->links() }}</div>
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
                        @this.deleteEstablishment(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('set-establishment-delete', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
