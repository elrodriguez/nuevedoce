<div>
    <div class="card mb-g rounded-top">
        <div class="card-header py-2 pr-2 d-flex align-items-center flex-wrap">
            @can('serviciodetraslados_nota_ocurrencias_nuevo')
            <div class="d-flex position-relative ml-auto">
                <a href="{{ route('service_load_order_ocurrencenote_create',$oc_id) }}" class="btn btn-success waves-effect waves-themed" type="button">@lang('transferservice::buttons.btn_new')</a>
            </div>
            @endcan
        </div>
        <div class="card-body p-0">
            <div clas="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">@lang('transferservice::labels.lbl_actions')</th>
                        <th>@lang('transferservice::labels.lbl_code')</th>
                        <th>@lang('transferservice::labels.lbl_description')</th>
                        <th>@lang('transferservice::labels.lbl_date')</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($noteoccurrences as $key => $noteoccurrence)
                        <tr>
                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                            <td class="text-center tdw-50 align-middle">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fal fa-cogs"></i>
                                    </button>
                                    <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                        @can('serviciodetraslados_nota_ocurrencias_editar')
                                            <a href="{{ route('service_load_order_ocurrencenote_edit', [$noteoccurrence->load_order_id,$noteoccurrence->id]) }}" class="dropdown-item">
                                                <i class="fal fa-pencil-alt mr-1"></i>@lang('transferservice::buttons.btn_edit')
                                            </a>
                                        @endcan
                                        @can('serviciodetraslados_nota_ocurrencias_eliminar')
                                            <div class="dropdown-divider"></div>
                                            <button onclick="confirmDelete({{ $noteoccurrence->id }})" type="button" class="dropdown-item text-danger">
                                                <i class="fal fa-trash-alt mr-1"></i>@lang('transferservice::buttons.btn_delete')
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">{{ $noteoccurrence->id }}</td>
                            <td class="align-middle">{{ $noteoccurrence->additional_information }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($noteoccurrence->created_at)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> {{__('transferservice::messages.msg_0001')}}",
                message: "<span><strong>{{__('transferservice::labels.lbl_warning')}}: </strong> {{__('transferservice::messages.msg_0002')}}</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                    {
                        confirm:
                            {
                                label: '{{__('transferservice::buttons.btn_yes')}}',
                                className: 'btn-danger shadow-0'
                            },
                        cancel:
                            {
                                label: '{{__('transferservice::buttons.btn_not')}}',
                                className: 'btn-default'
                            }
                    },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        @this.deleteNote(id);
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('ser-load-order-note-occurrence-delete', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('transferservice::labels.lbl_success')}}!</span>",
                message: "<span><strong>{{__('transferservice::labels.lbl_excellent')}}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
    </script>
</div>
