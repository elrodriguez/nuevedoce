<div >
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4" wire:ignore>
                    <label for="datepicker-1" class="form-label">{{ __('setting::labels.user') }}</label>
                    <input class="form-control basicAutoComplete" type="text" placeholder="" data-url="{{ route('setting_users_search') }}" autocomplete="off" />
                </div>
                <div class="col-md-4">
                    <label for="datepicker-1" class="form-label">Seleccionar fechas</label>
                    <div class="input-group" wire:ignore>
                        <input type="text" class="form-control" id="datepicker-1">
                        <div class="input-group-append">
                            <span class="input-group-text fs-xl">
                                <i class="fal fa-calendar-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            @if($this->user['id'])
            <a href="{{ route('setting_users')}}" type="button" class="btn btn-secondary waves-effect waves-themed">Listado</a>
            @endif
            <button wire:click="getActivities" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">Buscar</button>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body p-0">
            <div class="table-responsive">
            <table role="grid" class="table m-0" id="table-activities">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Tipo</th>
                        <th>{{ __('setting::labels.description') }}</th>
                        <th>Ruta</th>
                        <th>Entidad</th>
                        <th>Tabla</th>
                        <th>Identificador</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if($activities)
                        @foreach($activities as $key => $activity)
                        <tr role="row" class="odd">
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td><span class="badge badge-secondary">{{ $activity->type_activity}}</span></td>
                            <td>{{ $activity->description}}</td>
                            <td><a href="{{ $activity->route }}">{{ $activity->route }}</a></td>
                            <td><code>{{ $activity->model_name }}</code></td>
                            <td><code>{{ $activity->table_name }}</code></td>
                            <td>
                                @if($activity->table_column_id)
                                    <button data-toggle="modal" data-target="#data-modal-transparent-{{ $key }}" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" title="Ver datalles">
                                        {{ $activity->table_column_id }}
                                    </button>
                                    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="data-modal-transparent-{{ $key }}">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        Datos de la tabla
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label>Datos registrados</label>
                                                    <code class="code-kbd">{{ $activity->data_json_old }}</code>
                                                    <br>
                                                    <label>Datos modificados</label>
                                                    <code class="code-kbd">{{ $activity->data_json_updated }}</code>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect waves-themed" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">No hay datos</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            
            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                @this.set('user_id',item.value);
            });

            $('#datepicker-1').daterangepicker({
                    opens: 'left',
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
                            'Diciembre']
                    },
                }, function(start, end, label){
                    @this.set('start',start.format('YYYY-MM-DD'));
                    @this.set('end',end.format('YYYY-MM-DD'));
            });
        });
       
    </script>
</div>
