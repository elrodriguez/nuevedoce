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
                <input wire:keydown.enter="updatingSearchSaleexpense" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="Escriba aquí...">
                <div class="input-group-append">
                    <button wire:click="updatingSearchSaleexpense" class="btn btn-default waves-effect waves-themed" type="button">Buscar</button>
                    <a href="{{ route('sales_expenses_create') }}" class="btn btn-success waves-effect waves-themed" type="button">{{ __('labels.new') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">{{ __('labels.actions') }}</th>
                        <th class="text-center">{{ __('labels.broadcast_date') }}</th>
                        <th>{{ __('labels.provider') }}</th>
                        <th class="text-center">{{ __('labels.number') }}</th>
                        <th>{{ __('labels.reason') }}</th>
                        <th class="text-center">{{ __('labels.state') }}</th>
                        <th class="text-center">{{ __('labels.total') }}</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if(count($expenses) > 0)
                        @foreach($expenses as $key => $expense)
                        <tr>
                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                            <td class="text-center tdw-50 align-middle">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fal fa-cogs"></i>
                                    </button>
                                    <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">

                                        @can('ventas_nota_venta_editar')
                                        <a href="{{ route('sales_expenses_edit',$expense->external_id) }}" class="dropdown-item">
                                            <i class="fal fa-pencil-alt mr-1"></i>{{ __('labels.edit') }}
                                        </a>
                                        @endcan
                                        <a wire:click="$emit('modalPayment',{{ $expense->id }})" href="javascript:void(0)" class="dropdown-item">
                                            <i class="fal fa-money-bill-alt mr-1"></i>{{ __('labels.payments') }}
                                        </a>
                                        @can('configuraciones_establecimientos_eliminar')
                                        <div class="dropdown-divider"></div>
                                        <button onclick="confirmCancel({{ $expense->id }})" type="button" class="dropdown-item text-danger">
                                            <i class="fal fa-trash-alt mr-1"></i>{{ __('labels.delete') }}
                                        </button>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center">{{ \Carbon\Carbon::parse($expense->date_of_issue)->format('d/m/Y') }}</td>
                            <td class="align-middle">{{ json_decode($expense->supplier)->full_name }}</td>
                            <td class="align-middle">{{ $expense->number }}</td>
                            <td class="align-middle">{{ $expense->expense_reasons->description }}</td>
                            <td class="align-middle">
                                @if ($expense->state)
                                    <span class="badge badge-success">Pagado</span>
                                @else
                                    <span class="badge badge-danger">Pendiente</span>
                                @endif
                            </td>
                            <td class="align-middle text-right">{{ $expense->total }}</td>
                        </tr>
                        @endforeach
                    @else
                    <tr class="odd"><td valign="top" colspan="10" class="dataTables_empty text-center">{{ __('labels.no_records_to_display') }}</td></tr>
                    @endif
                </tbody>
            </table>
            </div>
        </div>
        <div class="card-footer pb-0 d-flex flex-row align-expenses-center">
            <div class="ml-auto">{{ $expenses->links() }}</div>
        </div>
    </div>
    
    <script type="text/javascript">
        function confirmCancel(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> ¿{{ __('labels.you_want_to_cancel_document') }}?",
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
                        @this.cancelDocument(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('response_anulation_sale_expense', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.message+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
