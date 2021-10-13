<div >
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="datepicker-1" class="form-label">{{ __('setting::labels.user') }}</label>
                    <input class="form-control basicAutoComplete" type="text" placeholder="" data-url="{{ route('setting_users_search') }}" autocomplete="off" />
                </div>
                <div class="col-md-4">
                    <label for="datepicker-1" class="form-label">Seleccionar fechas</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="datepicker-1">
                        <div class="input-group-append">
                            <span class="input-group-text fs-xl">
                                <i class="fal fa-calendar-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="datepicker-1" class="form-label">Sesiones</label>
                    <select class="custom-select" wire:model.defer="session_id">
                        <option value="">Seleccionar</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}">{{ $session->hour_session }}</option>
                        @endforeach
                    </select> 
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
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Tipo</th>
                        <th>{{ __('setting::labels.description') }}</th>
                        <th>Ruta</th>
                        <th>Entidad</th>
                        <th>Tabla</th>
                        <th>Identificador</th>
                        <th>Datos</th>
                        <th>Fecha y hora</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if($activities)
                        @foreach($activities as $key => $activity)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $activity->type_activity}}</td>
                            <td>{{ $activity->description}}</td>
                            <td><a href="{{ $activity->route }}">{{ $activity->route }}</a></td>
                            <td>{{ $activity->model_name }}</td>
                            <td>{{ $activity->table_name }}</td>
                            <td class="text-center">
                                @if($activity->table_column_id)
                                <button onclick="openModalData('{{ $activity->data_json_old }}')" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed">
                                    {{ $activity->table_column_id }}
                                </button>
                                @endif
                            </td>
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->description }}</td>
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
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {

            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                @this.set('user_id',item.value);
                @this.getSessions();
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
                    @this.getSessions();
            });
        });
        function openModalData(old) {
            alert(old)
            $('#staticBackdrop').modal('show');
        }

    </script>
</div>
