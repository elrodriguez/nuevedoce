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
                            <i wire:target="contractsSearch" wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    @endif
                </div>
                <input wire:keydown.enter="contractsSearch" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent pl-0" placeholder="{{__('lend::labels.lbl_type_here')}}">
                <div class="input-group-append">
                    <button wire:click="contractsSearch" class="btn btn-default waves-effect waves-themed" type="button">@lang('lend::buttons.btn_search')</button>
                    @can('prestamos_intereses_nuevo')
                        <a href="{{ route('lend_contract_create') }}" class="btn btn-success waves-effect waves-themed" type="button">@lang('lend::buttons.btn_new')</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">@lang('labels.actions')</th>
                        <th>@lang('labels.customer')</th>
                        <th>@lang('lend::labels.lbl_referred')</th>
                        <th>@lang('lend::labels.lbl_interest')</th>
                        <th>@lang('lend::labels.lbl_payment_method')</th>
                        <th>@lang('lend::labels.lbl_quotas')</th>
                        <th class="text-center">@lang('labels.date_start')</th>
                        <th class="text-center">@lang('labels.date_end')</th>
                        <th class="text-center">@lang('lend::labels.lbl_principal_amount')</th>
                        <th class="text-center">@lang('lend::labels.lbl_interest_amount')</th>
                        <th class="text-center">@lang('lend::labels.lbl_total_amount')</th>
                        <th class="text-center">@lang('lend::labels.lbl_penalty_applies')</th>
                        <th class="text-center">@lang('lend::labels.lbl_penalty_amount_day')</th>
                        <th>@lang('labels.information')</th>
                        <th class="text-center">{{ __('setting::labels.state') }}</th>
                    </tr>
                    </thead>
                    <tbody class="">
                        @if(count($contracts) > 0)
                            @foreach($contracts as $key => $contract)
                                <tr>
                                    <td class="text-center align-middle">{{ $key + 1 }}</td>
                                    <td class="text-center tdw-50 align-middle">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fal fa-cogs"></i>
                                            </button>
                                            <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                                @can('prestamos_contrato_editar')
                                                    <a href="{{ route('lend_contract_edit', $contract->id) }}" class="dropdown-item">
                                                        <i class="fal fa-pencil-alt mr-1"></i>@lang('lend::buttons.btn_edit')
                                                    </a>
                                                @endcan
                                                <a wire:click="openModalDetails({{ $contract->id }})" href="javascript:void(0)')" type="button" class="dropdown-item text-info">
                                                    <i class="fal fa-table mr-1"></i>{{__('lend::labels.lbl_payment_schedule')}}
                                                </a>
                                                @can('prestamos_contrato_imprimir')
                                                    <a href="javascript:printContract('{{ route('lend_contract_print', $contract->id) }}')" type="button" class="dropdown-item text-info">
                                                        <i class="fal fa-print mr-1"></i>@lang('labels.to_print')
                                                    </a>
                                                @endcan
                                                @can('prestamos_contrato_eliminar')
                                                    <div class="dropdown-divider"></div>
                                                    <button onclick="confirmDelete({{ $contract->id }})" type="button" class="dropdown-item text-danger">
                                                        <i class="fal fa-trash-alt mr-1"></i>@lang('lend::buttons.btn_delete')
                                                    </button>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $contract->customer_number.' '.$contract->customer_name }}</td>
                                    <td class="align-middle">{{ $contract->referred_name.' '.$contract->referred_number }}</td>
                                    <td class="align-middle">{{ $contract->interest_description }}</td>
                                    <td class="align-middle">{{ $contract->payment_method_description }}</td>
                                    <td class="align-middle">{{ $contract->quota_amount }}</td>
                                    <td class="text-center align-middle">{{ \Carbon\Carbon::parse($contract->date_start)->format('d/m/Y') }}</td>
                                    <td class="text-center align-middle">{{ \Carbon\Carbon::parse($contract->date_end)->format('d/m/Y') }}</td>
                                    <td class="text-right align-middle">{{ $contract->amount_capital }}</td>
                                    <td class="text-right align-middle">{{ $contract->amount_interest }}</td>
                                    <td class="text-right align-middle">{{ $contract->amount_total }}</td>
                                    <td class="text-center align-middle">
                                        @if($contract->penalty)
                                            <span class="badge badge-info">{{ __('labels.yes') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('labels.no') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-right align-middle">{{ $contract->amount_penalty_day }}</td>
                                    <td class="align-middle">{{ $contract->additional_information }}</td>
                                    <td class="text-center align-middle">
                                        @if($contract->state == 'A')
                                            <span class="badge badge-success">{{ __('lend::labels.lbl_con_active') }}</span>
                                        @elseif($contract->state  == 'T')
                                            <span class="badge badge-danger">{{ __('lend::labels.lbl_con_finished') }}</span>
                                        @elseif($contract->state  == 'D')
                                            <span class="badge badge-danger">{{ __('lend::labels.lbl_con_stop_paying') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="16" class="text-center">
                                    <div class="alert alert-info" role="alert">
                                        {{ __('labels.no_data_available_in_the_table') }}
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer card-footer-background pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto">{{ $contracts->links() }}</div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailsLabel">{{__('lend::labels.lbl_payment_schedule')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalDetailsBody">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            @can('prestamos_contrato_pagar_cuota')
                            <th class="text-center">{{ __('labels.actions') }}</th>
                            @endcan
                            <th class="text-center">@lang('lend::labels.lbl_date_to_pay')</th>
                            <th class="text-center">@lang('lend::labels.lbl_principal_amount')</th>
                            <th class="text-center">@lang('lend::labels.lbl_interest_amount')</th>
                            <th class="text-center">@lang('lend::labels.lbl_amount_to_pay')</th>
                            <th class="text-center">{{ __('setting::labels.state') }}</th>
                        </tr>
                        </thead>
                        <tbody class="">
                            @php
                                $current_date = \Carbon\Carbon::now();
                            @endphp
                            @foreach($detail_lists as $key => $detail_list)
                                <tr>
                                    <td class="text-center align-middle">{{ $key + 1 }}</td>
                                    @can('prestamos_contrato_estado_cuotas')
                                    <td class="text-center align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button wire:click="statusChange({{ $detail_list->id }},'A')" title="Pagado" type="button" class="btn btn-primary waves-effect waves-themed"><i class="fal fa-check"></i></button>
                                            <button wire:click="statusChange({{ $detail_list->id }},'P')" title="No pago" type="button" class="btn btn-danger waves-effect waves-themed"><i class="fal fa-times"></i></button>
                                        </div>
                                    </td>
                                    @endcan
                                    <td class="text-center align-middle">{{ \Carbon\Carbon::parse($detail_list->date_to_pay)->format('d/m/Y') }}</td>
                                    <td class="text-right align-middle">{{ $detail_list->capital }}</td>
                                    <td class="text-right align-middle">{{ $detail_list->interest }}</td>
                                    <td class="text-right align-middle">{{ $detail_list->amount_to_pay }}</td>
                                    <td class="text-center align-middle">
                                        @if($detail_list->state == 'P')
                                            @if($current_date->gt($detail_list->date_to_pay))
                                                <span class="badge badge-danger">{{ __('lend::labels.lbl_defeated') }}</span>
                                            @else
                                                <span class="badge badge-primary">{{ __('lend::labels.lbl_pending') }}</span>
                                            @endif
                                        @elseif($detail_list->state  == 'A')
                                            <span class="badge badge-success">{{ __('lend::labels.lbl_paid') }}</span>
                                        @endif
                                    </td>
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
        function confirmDelete(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> {{__('lend::messages.msg_0001')}}",
                message: "<span><strong>{{__('lend::labels.lbl_warning')}}: </strong> {{__('lend::messages.msg_0002')}}</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                    {
                        confirm:
                            {
                                label: '{{__('lend::labels.lbl_yes')}}',
                                className: 'btn-danger shadow-0'
                            },
                        cancel:
                            {
                                label: '{{__('lend::labels.lbl_not')}}',
                                className: 'btn-default'
                            }
                    },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                    @this.deleteContract(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('len-contract-delete', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('lend::labels.lbl_success')}}!</span>",
                message: "<span><strong>{{__('lend::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });

        document.addEventListener('len-contract-details', event => {
            $('#modalDetailsLabel').html(event.detail.label);
            $('#modalDetails').modal('show');
        });

        function printContract(url){
            window.open(url, '_blank');
        }

    </script>
</div>
