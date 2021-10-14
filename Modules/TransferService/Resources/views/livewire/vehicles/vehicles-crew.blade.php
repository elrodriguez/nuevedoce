<div>
    <div class="card mb-g rounded-top">
        <div class="card-body p-0">
            <form class="needs-validation p-3 {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="employee_id">@lang('transferservice::labels.lbl_worker') <span class="text-danger">*</span> </label>
                        <div wire:ignore>
                            <input class="form-control basicAutoComplete" type="text" placeholder="" data-url="{{ route('service_vehicles_search_employee') }}" autocomplete="off" />
                        </div>
                        @error('employee_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label" for="description">@lang('transferservice::labels.lbl_description') </label>
                        <div class="input-group">
                            <input wire:model.defer="description" class="form-control" type="text" placeholder="" />
                            <div class="input-group-append">
                                <button wire:click="addEmployee" wire:loading.attr="disabled" class="btn btn-primary waves-effect waves-themed" type="button"><i class="fal fa-plus mr-1"></i>Agregar</button>
                            </div>
                        </div>
                        @error('description')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">{{ __('transferservice::labels.lbl_actions') }}</th>
                        <th>{{ __('transferservice::labels.lbl_identification_number') }}</th>
                        <th>{{ __('transferservice::labels.lbl_full_name') }}</th>
                        <th>{{ __('transferservice::labels.lbl_occupation') }}</th>
                        <th>{{ __('transferservice::labels.lbl_description') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($crew)
                        @foreach($crew as $key => $crewmember)
                            <tr>
                                <td class="text-center align-middle">{{ $key + 1 }}</td>
                                <td class="text-center align-middle">
                                    <button onclick="confirmDelete({{ $crewmember->id }})" class="btn btn-danger btn-icon rounded-circle waves-effect waves-themed">
                                        <i class="fal fa-trash-alt"></i>
                                    </button>
                                </td>
                                <td class="align-middle">{{ $crewmember->number }}</td>
                                <td class="align-middle">{{ $crewmember->full_name }}</td>
                                <td class="align-middle">{{ $crewmember->ocupation }}</td>
                                <td class="align-middle">{{ $crewmember->description }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('service_vehicles_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('transferservice::buttons.btn_list')</a>
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
                        @this.deleteEmployee(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('ser-crewman-delete', event => {
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
        document.addEventListener('livewire:load', function () {
            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                @this.set('employee_id',item.value);
            });
        });
    </script>
</div>