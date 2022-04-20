<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label class="form-label">@lang('pharmacy::labels.diseases') <span class="text-danger">*</span> </label>
                    <input disabled class="form-control"  type="text" value="{{ $disease_name }}" />
                </div>
                <div class="col-md-4">
                    <label class="form-label">@lang('pharmacy::labels.symptom') <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <input id="symptom_id" data-url="{{ route('pharmacy_symptoms_search') }}" class="form-control"  type="text" placeholder="Buscar {{ __('pharmacy::labels.symptom') }}" autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-4">
                    <button wire:target="addSymptoms" wire:loading.attr="disabled" wire:click="addSymptoms" type="button" class="btn btn-primary">
                        {{ __('labels.add') }}
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                </div>
                <div class="col-md-4 mb-3">
                    @error('symptom_id')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3 ">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th class="text-center ">{{ __('labels.actions') }}</th>
                                <th>{{ __('labels.description') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($symptoms)>0)
                                @foreach($symptoms as $k => $symptom)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td class="text-center">
                                            <button onclick="confirmDeleteSymptoms({{ $symptom->symptom_id }})" type="button" class="btn btn-danger btn-sm btn-icon rounded-circle waves-effect waves-themed">
                                                <i class="fal fa-times"></i>
                                            </button>
                                        </td>
                                        <td>{{ $symptom->description }}</td>
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
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            $('#symptom_id').autoComplete().on('autocomplete.select', function (evt, item) {
                selectSymptomId(item.value);
            });
        });
        function selectSymptomId(id){
            @this.set('symptom_id',id);
        }
        document.addEventListener('phar-diseases-symptoms-save', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='{{ env('BOOTBOX_SUCCESS_ICON') }} text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': '{{ env("BOOTBOX_SUCCESS_COLOR") }}'});
            $('#symptom_id').autoComplete('clear');
        });

        function confirmDeleteSymptoms(id){
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
                        //console.log(id)
                        @this.deleteSymptoms(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': '{{ env("BOOTBOX_INFO_COLOR") }}'});
        }

        document.addEventListener('phar-diseases-symptoms-delete', event => {
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
