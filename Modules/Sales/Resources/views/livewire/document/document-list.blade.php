<div>
    <button class="btn btn-primary waves-effect waves-themed mb-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
        {{ __('labels.search_filters') }}
    </button>
    @can('ventas_comprobante_nuevo')
        <a href="{{ route('sales_document_create') }}" class="btn btn-success waves-effect waves-themed mb-3" type="button">
            {{ __('labels.new') }}
        </a>
    @endcan
    @can('ventas_comprobante_resumen')
        <button wire:click="$emit('openModalSummaryCancellations')" class="btn btn-dark waves-effect waves-themed mb-3" type="button">
            {{ __('sales::labels.summary_and_cancellations') }}
        </button>
    @endcan
    <div class="collapse mb-3" id="collapseExample" style="">
        <div class="card card-body">
            <div class="form-row">
                <div class="col-md-3 mb-3" wire:ignore>
                    <label class="form-label">{{ __('labels.date_range') }}</label>
                    <input type="text" class="form-control" id="custom-range">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">{{ __('labels.voucher_type') }}</label>
                    <select class="custom-select form-control" wire:model.defer="document_type_id">
                        <option value="">{{ __('labels.all') }}</option>
                        @foreach ($document_types as $document_type)
                        <option value="{{ $document_type->id }}">{{ $document_type->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">{{ __('labels.serie') }}</label>
                    <input type="text" class="form-control" wire:model.defer="serie_id">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">{{ __('labels.number') }}</label>
                    <input type="text" class="form-control" wire:model.defer="number">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">{{ __('labels.state') }}</label>
                    <select class="custom-select form-control" wire:model.defer="state_id">
                        <option value="">{{ __('labels.to_select') }}</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @role('TI|Administrator')
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('labels.users') }}</label>
                    <select class="custom-select form-control" wire:model.defer="user_id">
                        <option value="">{{ __('labels.to_select') }}</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endrole
            <div class="form-row">
                <div class="col-md-12 d-flex flex-row align-items-center">
                    <button type="button" class="btn btn-primary ml-auto waves-effect waves-themed" wire:loading.attr="disabled" wire:click="searchDocument">
                        <span wire:loading wire:target="searchDocument" wire:loading.class="spinner-border spinner-border-sm" wire:loading.class.remove="fal fa-search" class="fal fa-search mr-2" role="status" aria-hidden="true"></span>
                        <span>{{ __('labels.search') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
            <thead class="bg-primary-600">
                <tr>
                    <th class="align-middle">{{ __('labels.actions') }}</th>
                    <th class="text-center align-middle">{{ __('labels.broadcast_date') }}</th>
                    <th class="align-middle">{{ __('labels.customer') }}</th>
                    <th class="text-center align-middle">{{ __('labels.number') }}</th>
                    <th class="align-middle">{{ __('labels.state') }}</th>
                    <th class="align-middle">{{ __('labels.coin') }}</th>
                    <th class="align-middle">{{ __('labels.t_gravado') }}</th>
                    <th class="align-middle">{{ __('labels.t_igv') }}</th>
                    <th class="align-middle">{{ __('labels.total') }}</th>
                </tr>
            </thead>
            <tbody>
                @if(count($collection) > 0)
                    @foreach ($collection as $item)
                        <tr>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <a href="javascript:void(0)" class="btn btn-info rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fal fa-cogs"></i>
                                    </a>
                                    <div class="dropdown-menu" style="">
                                        @can('ventas_comprobante_notas')
                                            <a class="dropdown-item" href="{{ route('sales_notes',$item->external_id) }}" ><i class="fal fa-file-invoice mr-1"></i>{{ __('labels.note') }}</a>
                                        @endcan
                                        <a wire:click="$emit('openModalDocumentPayments',{{ $item->id }})" class="dropdown-item" href="javascript:void(0)','{{ $item->series }} {{ str_pad($item->number, 8, "0", STR_PAD_LEFT) }}')" ><i class="fal fa-money-bill-wave mr-1"></i>{{ __('labels.payments') }}</a>
                                        <a class="dropdown-item" href="{{ route('download_sale_document',['sales','xml',$item->filename]) }}"><i class="fal fa-download mr-1"></i>XML</a>
                                        @if($item->has_cdr)
                                            <a class="dropdown-item" href="{{ route('download_sale_document',['sales','cdr','R-'.$item->filename]) }}"><i class="fal fa-download mr-1"></i>CDR</a>
                                        @endif
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="openModalPrint('{{ $item->external_id }}')"><i class="fal fa-print mr-1"></i>Imprimir</a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center align-middle">{{ $item->document_date }}</td>
                            <td class="align-middle">{{ json_decode($item->customer)->trade_name }}</td>
                            <td class="align-middle">
                                <span class="fw-900">{{ $item->series.'-'.str_pad($item->number, 8, "0", STR_PAD_LEFT) }}</span>
                                <br>
                                <span class="fw-300 font-italic">{{ $item->document_type_description }}</span>
                            </td>
                            <td class="align-middle">
                                @if ($item->state_type_id == '01')
                                    <button class="btn btn-info btn-sm btn-block waves-effect waves-themed"
                                        @if($item->sunat_shipping_status)
                                            data-toggle="popover" 
                                            data-placement="top" 
                                            title="<h4 class='fw-500 width-sm'><i class='fal fa-info mr-2'></i>{{  __('sales::labels.sunat_answer') }}</h4>" 
                                            data-html="true" 
                                            data-content='
                                                <div>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">CODE</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->code  }}</dd>
                                                        <dt class="col-sm-4">DESCRIPTION</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->description  }}</dd>
                                                    </dl>
                                                </div>'
                                        @endif
                                    >{{ $item->description }}</button>
                                @elseif ($item->state_type_id == '03')
                                    <button class="btn btn-success btn-sm btn-block waves-effect waves-themed"
                                        @if($item->sunat_shipping_status)
                                            data-toggle="popover" 
                                            data-placement="top" 
                                            title="<h4 class='fw-500 width-sm'><i class='fal fa-info mr-2'></i>{{  __('sales::labels.sunat_answer') }}</h4>" 
                                            data-html="true" 
                                            data-content='
                                                <div>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">CODE</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->code  }}</dd>
                                                        <dt class="col-sm-4">DESCRIPTION</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->description  }}</dd>
                                                    </dl>
                                                </div>'
                                        @endif
                                    >{{ $item->description }}</button>
                                @elseif ($item->state_type_id == '05')
                                    <button class="btn btn-primary btn-sm btn-block waves-effect waves-themed"
                                        @if($item->sunat_shipping_status)
                                            data-toggle="popover" 
                                            data-placement="top" 
                                            title="<h4 class='fw-500 width-sm'><i class='fal fa-info mr-2'></i>{{  __('sales::labels.sunat_answer') }}</h4>" 
                                            data-html="true" 
                                            data-content='
                                                <div>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">CODE</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->code  }}</dd>
                                                        <dt class="col-sm-4">DESCRIPTION</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->description  }}</dd>
                                                    </dl>
                                                </div>'
                                        @endif
                                    >{{ $item->description }}</button>
                                @elseif ($item->state_type_id == '07')
                                    <button class="btn btn-secondary btn-sm btn-block waves-effect waves-themed"
                                        @if($item->sunat_shipping_status)
                                            data-toggle="popover" 
                                            data-placement="top" 
                                            title="<h4 class='fw-500 width-sm'><i class='fal fa-info mr-2'></i>{{  __('sales::labels.sunat_answer') }}</h4>" 
                                            data-html="true" 
                                            data-content='
                                                <div>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">CODE</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->code  }}</dd>
                                                        <dt class="col-sm-4">DESCRIPTION</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->description  }}</dd>
                                                    </dl>
                                                </div>'
                                        @endif
                                    >{{ $item->description }}</button>
                                @elseif ($item->state_type_id == '09')
                                    <button class="btn btn-danger btn-sm btn-block waves-effect waves-themed"
                                        @if($item->sunat_shipping_status)
                                            data-toggle="popover" 
                                            data-placement="top" 
                                            title="<h4 class='fw-500 width-sm'><i class='fal fa-info mr-2'></i>{{  __('sales::labels.sunat_answer') }}</h4>" 
                                            data-html="true" 
                                            data-content='
                                                <div>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">CODE</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->code  }}</dd>
                                                        <dt class="col-sm-4">DESCRIPTION</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->description  }}</dd>
                                                    </dl>
                                                </div>'
                                        @endif
                                    >{{ $item->description }}</button>
                                @elseif ($item->state_type_id == '11')
                                    <button class="btn btn-dark btn-sm btn-block waves-effect waves-themed"
                                        @if($item->sunat_shipping_status)
                                            data-toggle="popover" 
                                            data-placement="top" 
                                            title="<h4 class='fw-500 width-sm'><i class='fal fa-info mr-2'></i>{{  __('sales::labels.sunat_answer') }}</h4>" 
                                            data-html="true" 
                                            data-content='
                                                <div>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">CODE</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->code  }}</dd>
                                                        <dt class="col-sm-4">DESCRIPTION</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->description  }}</dd>
                                                    </dl>
                                                </div>'
                                        @endif
                                    >{{ $item->description }}</button>
                                @elseif ($item->state_type_id == '13')
                                    <button class="btn btn-warning btn-sm btn-block waves-effect waves-themed"
                                        @if($item->sunat_shipping_status)
                                            data-toggle="popover" 
                                            data-placement="top" 
                                            title="<h4 class='fw-500 width-sm'><i class='fal fa-info mr-2'></i>{{  __('sales::labels.sunat_answer') }}</h4>" 
                                            data-html="true" 
                                            data-content='<div>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">CODE</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->code  }}</dd>
                                                        <dt class="col-sm-4">DESCRIPTION</dt>
                                                        <dd class="col-sm-8">{{ json_decode($item->sunat_shipping_status)->description  }}</dd>
                                                    </dl>
                                                </div>'
                                        @endif
                                    >{{ $item->description }}</button>
                                @endif
                            </td>
                            <td class="align-middle">{{ $item->currency_type_id }}</td>
                            <td class="text-right align-middle">{{ $item->total_taxed }}</td>
                            <td class="text-right align-middle">{{ $item->total_igv }}</td>
                            <td class="text-right align-middle">{{ $item->total }}</td>
                        </tr>
                    @endforeach
                @else
                <tr class="odd"><td valign="top" colspan="10" class="dataTables_empty text-center">{{ __('labels.no_records_to_display') }}</td></tr>
                @endif
            </tbody>
            @if($collection->links())
            <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="row">
                            <div class="col-md-12 d-flex flex-row align-items-center">
                                <div class="ml-auto">{{ $collection->links() }}</div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
    <div class="modal fade" id="exampleModalprint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Imprimir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="document_external_id" value="">
                    <div class="row js-list-filter">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center mb-g">
                            <a type="button" onclick="printPDF('a4')" href="javascript:void(0)" class="rounded bg-white p-0 m-0 d-flex flex-column w-100 h-100 js-showcase-icon shadow-hover-2">
                                <div class="rounded-top color-fusion-300 w-100 bg-primary-300">
                                    <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-3x hover-bg">
                                        <i class="fal fa-file"></i>
                                    </div>
                                </div>
                                <div class="rounded-bottom p-1 w-100 d-flex justify-content-center align-items-center text-center">
                                    <span class="d-block text-truncate text-muted">A4</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center mb-g">
                            <a type="button" onclick="printPDF('ticket')" href="javascript:void(0)" class="rounded bg-white p-0 m-0 d-flex flex-column w-100 h-100 js-showcase-icon shadow-hover-2">
                                <div class="rounded-top color-fusion-300 w-100 bg-primary-300">
                                    <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-3x hover-bg">
                                        <i class="fal fa-receipt"></i>
                                    </div>
                                </div>
                                <div class="rounded-bottom p-1 w-100 d-flex justify-content-center align-items-center text-center">
                                    <span class="d-block text-truncate text-muted">Ticket</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            $("#datepicker-summary").datepicker({
                format: 'dd/mm/yyyy',
                language:"{{ app()->getLocale() }}",
                autoclose:true
            }).datepicker('setDate','0');

            $('#custom-range').daterangepicker({
                "showDropdowns": true,
                "showWeekNumbers": true,
                "showISOWeekNumbers": true,
                "timePicker": true,
                "timePicker24Hour": true,
                "timePickerSeconds": true,
                "autoApply": true,
                "maxSpan":
                {
                    "days": 7
                },
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Aplicar',
                    cancelLabel: 'Limpiar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                    customRangeLabel: 'Seleccionar rango',
                    daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                        'Diciembre'],
                    firstDay: 1
                },
                ranges:{
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Los últimos 7 días': [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                    'Este mes': [moment().startOf('month'), moment().endOf('month')],
                    'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "alwaysShowCalendars": true,
                "applyButtonClasses": "btn-default shadow-0",
                "cancelClass": "btn-success shadow-0"
            }, function(start, end, label){
                setDatesEndStart(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
                //console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });

            $('.cancelBtn').on('click', function(){
                clearEndStart();
            });
        });
        function openPayments(id,number){
            $('#modalPaymentsLabel').html(number);
            @this.paymentsByDocument(id);
            $('#modalPayments').modal('show');
        }
        function setDatesEndStart(start_date,date_end){
            @this.set('start_date',start_date);
            @this.set('date_end',date_end);
        }
        function clearEndStart(){
            @this.set('start_date',null);
            @this.set('date_end',null);
        }
        function openModalPrint(external_id){
            $('#document_external_id').val(external_id)
            $('#exampleModalprint').modal('show');
        }
        function printPDF(format){
            let external_id = $('#document_external_id').val();
            window.open(`print/`+external_id+`/`+format, '_blank');
        }
    </script>
</div>
