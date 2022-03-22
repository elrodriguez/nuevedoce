<div>
    <!-- Modal Right Large -->
    <div id="modalDocumentSummaryCancellations" wire:ignore.self class="modal fade default-example-modal-right-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-right modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">{{ __('sales::labels.summary_and_cancellations') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ $tevent == 'SL' || $tevent == 'SN' ? 'active' : '' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fal fa-object-group mr-1"></i>{{ __('sales::labels.summaries') }}</a>
                            <div class="dropdown-menu">
                                <a wire:click="$set('tevent','SL')" class="dropdown-item {{ $tevent == 'SL' ? 'active' : '' }}">{{ __('labels.list') }}</a>
                                <a wire:click="$set('tevent','SN')" class="dropdown-item {{ $tevent == 'SN' ? 'active' : '' }}">{{ __('labels.new') }}</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-cancellations" role="tab"><i class="fal fa-times-hexagon mr-1"></i>{{ __('sales::labels.cancellations') }}</a></li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade {{ $tevent == 'SL' ? 'active show' : '' }}" id="tab-summaries-list" role="tabpanel" aria-labelledby="tab-summaries-list">
                            <h5>Listado de resúmenes</h5>
                            <div class="form-group row">
                                <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">{{ __('labels.broadcast_date') }}</label>
                                <div class="col-12 col-lg-3">
                                    <div class="input-group">
                                        <input wire:model.defer="date_summary_search" onchange="this.dispatchEvent(new InputEvent('input'))" type="text" class="form-control" readonly=""  id="datepicker-summary">
                                        <div class="input-group-append">
                                            <span class="input-group-text fs-xl">
                                                <i class="fal fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 text-lg-left">
                                    <button wire:loading.attr="disabled" wire:click="getSummaries" type="button" class="btn btn-default waves-effect waves-themed">{{ __('labels.search') }}</button>
                                </div>
                            </div>
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr slot="heading">
                                            <th class="text-center">Acciones</th>
                                            <th class="text-center">Fecha Emisión</th>
                                            <th class="text-center">Fecha Referencia</th>
                                            <th>Identificador</th>
                                            <th>Ticket</th>
                                            <th>Estado</th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        @if(count($summaries) > 0)
                                            @foreach($summaries as $summary)
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="btn btn-info rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fal fa-cogs"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('download_sale_summaries',['summary','xml',$summary->filename]) }}"><i class="fal fa-download mr-1"></i>XML</a>
                                                                @if($summary->has_cdr)
                                                                    <a class="dropdown-item" href="{{ route('download_sale_summaries',['summary','cdr','R-'.$summary->filename]) }}"><i class="fal fa-download mr-1"></i>CDR</a>
                                                                @endif
                                                                <a wire:click="checkStatus({{ $summary->id }})" class="dropdown-item" href="javascript:void(0)"><i class="fal fa-undo mr-1"></i>Consultar</a>
                                                                <a wire:click="destroy({{ $summary->id }})" class="dropdown-item" href="javascript:void(0)"><i class="fal fa-trash-alt mr-1"></i>Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center align-middle">{{ \Carbon\Carbon::parse($summary->date_of_issue)->format('d/m/Y') }}</td>
                                                    <td class="text-center align-middle">{{ \Carbon\Carbon::parse($summary->date_of_reference)->format('d/m/Y') }}</td>
                                                    <td class="align-middle">{{ $summary->identifier }}</td>
                                                    <td class="align-middle">{{ $summary->ticket }}</td>
                                                    <td class="align-middle">
                                                        @if ($summary->state_type_id == '01')
                                                            <span class="badge badge-info">{{ $summary->state_type->description }}</span>
                                                        @elseif ($summary->state_type_id == '03')
                                                            <span class="badge badge-success">{{ $summary->state_type->description }}</span>
                                                        @elseif ($summary->state_type_id == '05')
                                                            <span class="badge badge-primary">{{ $summary->state_type->description }}</span>
                                                        @elseif ($summary->state_type_id == '07')
                                                            <span class="badge badge-secondary">{{ $summary->state_type->description }}</span>
                                                        @elseif ($summary->state_type_id == '09')
                                                            <span class="badge badge-danger">{{ $summary->state_type->description }}</span>
                                                        @elseif ($summary->state_type_id == '11')
                                                            <span class="badge badge-dark">{{ $summary->state_type->description }}</span>
                                                        @elseif ($summary->state_type_id == '13')
                                                            <span class="badge badge-warning">{{ $summary->state_type->description }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="odd"><td valign="top" colspan="10" class="dataTables_empty text-center">{{ __('labels.no_records_to_display') }}</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $tevent == 'SN' ? 'active show' : '' }}" id="tab-summaries-new" role="tabpanel" aria-labelledby="tab-summaries-new">
                            <h5>Registrar Resumen</h5>
                            <div class="form-group row">
                                <label class="col-form-label col-12 col-lg-3 form-label text-lg-right">{{ __('labels.broadcast_date') }}</label>
                                <div class="col-12 col-lg-3">
                                    <div class="input-group">
                                        <input wire:model.defer="date_summary_new" onchange="this.dispatchEvent(new InputEvent('input'))" type="text" class="form-control" readonly=""  id="datepicker-summary-new">
                                        <div class="input-group-append">
                                            <span class="input-group-text fs-xl">
                                                <i class="fal fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('date_summary_new')
                                    <div class="invalid-feedback-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-3 text-lg-left">
                                    <button wire:click="getDocuments" type="button" class="btn btn-default waves-effect waves-themed">{{ __('labels.search') }}</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Número</th>
                                        <th class="text-center">Moneda</th>
                                        <th class="text-right">T.Exportación</th>
                                        <th class="text-right">T.Gratuita</th>
                                        <th class="text-right">T.Inafecta</th>
                                        <th class="text-right">T.Exonerado</th>
                                        <th class="text-right">T.Gravado</th>
                                        <th class="text-right">T.Igv</th>
                                        <th class="text-right">Total</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($documents) > 0)
                                            @foreach($documents as $k => $document)
                                                <tr>
                                                    <td class="align-middle">{{ $document['series'].'-'.$document['number'] }}</td>
                                                    <td class="align-middle text-center">{{ $document['currency_type_id'] }}</td>
                                                    <td class="align-middle text-right">{{ $document['total_exportation'] }}</td>
                                                    <td class="align-middle text-right">{{ $document['total_free'] }}</td>
                                                    <td class="align-middle text-right">{{ $document['total_unaffected'] }}</td>
                                                    <td class="align-middle text-right">{{ $document['total_exonerated'] }}</td>
                                                    <td class="align-middle text-right">{{ $document['total_taxed'] }}</td>
                                                    <td class="align-middle text-right">{{ $document['total_igv'] }}</td>
                                                    <td class="align-middle text-right">{{ $document['total'] }}</td>
                                                    <td class="align-middle text-right">
                                                        <button type="button" class="btn btn-danger btn-icon waves-effect waves-themedr" wire:click="removeDocument({{ $k }})"><i class="fal fa-times"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="odd"><td valign="top" colspan="10" class="dataTables_empty text-center">{{ __('labels.no_records_to_display') }}</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-cancellations" role="tabpanel" aria-labelledby="tab-cancellations">Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic. </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                    @if($tevent != 'SL')
                        <button type="button" class="btn btn-primary waves-effect waves-themed" wire:loading.attr="disabled" wire:click="save">
                            <span wire:loading wire:target="save" wire:loading.class="spinner-border spinner-border-sm" wire:loading.class.remove="fal fa-check" class="fal fa-check mr-2" role="status" aria-hidden="true"></span>
                            <span>{{ __('sales::labels.generate') }}</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('modal-sales-vaucher-summary-cancellations', event => {
            $('#modalDocumentSummaryCancellations').modal('show');
        });
        document.addEventListener('livewire:load', function () {
            $("#datepicker-summary").datepicker({
                format: 'dd/mm/yyyy',
                language:"{{ app()->getLocale() }}",
                autoclose:true
            }).datepicker('setDate','0');
            $("#datepicker-summary-new").datepicker({
                format: 'dd/mm/yyyy',
                language:"{{ app()->getLocale() }}",
                autoclose:true
            }).datepicker('setDate','0');
        });
        document.addEventListener('sales-summary-create', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('sales::labels.lbl_success')}}!</span>",
                message: "<span><strong>{{__('sales::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('sales-summary-not-documents', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-times-square text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('sales::labels.lbl_error')}}!</span>",
                message: "<span><strong>{{__('sales::labels.cannot_continue_process')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(214, 36, 16, 0.5)'});
        });
    </script>
</div>
