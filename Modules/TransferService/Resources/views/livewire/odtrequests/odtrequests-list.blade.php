<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group input-group-multi-transition">
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
                    @if($search || $date_start || $date_end)
                        <button wire:click="clearInput" type="button" class="input-group-text text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    @else
                        <span class="input-group-text text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    @endif
                </div>
                <input wire:model="date_start" wire:keydown.enter="odtRequestSearch" type="text" class="form-control" id="date_start" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true" placeholder="Desde">
                <input wire:model="date_end" wire:keydown.enter="odtRequestSearch" type="text" class="form-control" id="date_end" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true" placeholder="Hasta">
                <input wire:keydown.enter="odtRequestSearch" wire:model.defer="search" type="text" class="form-control" placeholder="{{__('transferservice::labels.lbl_type_here')}} {{__('transferservice::labels.lbl_name')}} {{__('transferservice::labels.lbl_event')}}">
                <div class="input-group-append">
                    <button wire:click="odtRequestSearch" class="btn btn-default waves-effect waves-themed" type="button">@lang('transferservice::buttons.btn_search')</button>
                    @can('serviciodetraslados_solicitudes_odt_nuevo')
                        <a href="{{ route('service_odt_requests_create') }}" class="btn btn-success waves-effect waves-themed" type="button">@lang('transferservice::buttons.btn_new')</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">@lang('transferservice::labels.lbl_actions')</th>
                    <th>@lang('transferservice::labels.lbl_description')</th>
                    <th>@lang('transferservice::labels.lbl_company')</th>
                    <th>@lang('transferservice::labels.lbl_supervisor')</th>
                    <th>@lang('transferservice::labels.lbl_customer')</th>
                    <th>@lang('transferservice::labels.lbl_local')</th>
                    <th>@lang('transferservice::labels.lbl_wholesaler')</th>
                    <th>@lang('transferservice::labels.lbl_event_date')</th>
                    <th class="text-center">{{ __('setting::labels.state') }}</th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($odt_requests as $key => $odt_request)
                    <tr>
                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                        <td class="text-center tdw-50 align-middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fal fa-cogs"></i>
                                </button>
                                <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                    @can('serviciodetraslados_solicitudes_odt_editar')
                                        <a href="{{ route('service_odt_requests_edit',$odt_request->id) }}" class="dropdown-item">
                                            <i class="fal fa-pencil-alt mr-1"></i>@lang('transferservice::buttons.btn_edit')
                                        </a>
                                    @endcan
                                    @can('serviciodetraslados_solicitudes_odt_eliminar')
                                        <div class="dropdown-divider"></div>
                                        <button onclick="confirmDelete({{ $odt_request->id }})" type="button" class="dropdown-item text-danger">
                                            <i class="fal fa-trash-alt mr-1"></i>@lang('transferservice::buttons.btn_delete')
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ $odt_request->description }}</td>
                        <td class="align-middle"><a wire:click="openModalDetails({{ $odt_request->id_company }},1)" href="javascript:void(0)" type="button">{{ $odt_request->name_company }}</a></td>
                        <td class="align-middle"><a wire:click="openModalDetails({{ $odt_request->id_employee }},2)" href="javascript:void(0)" type="button">{{ $odt_request->name_employee }}</a></td>
                        <td class="align-middle"><a wire:click="openModalDetails({{ $odt_request->id_customer }},3)" href="javascript:void(0)" type="button">{{ $odt_request->name_customer }}</a></td>
                        <td class="align-middle"><a wire:click="openModalDetails({{ $odt_request->id_local }},4)" href="javascript:void(0)" type="button">{{ $odt_request->name_local }}</a></td>
                        <td class="align-middle"><a wire:click="openModalDetails({{ $odt_request->id_wholesaler }},5)" href="javascript:void(0)" type="button">{{ $odt_request->name_wholesaler }}</a></td>
                        <td class="align-middle text-center">{{ \Carbon\Carbon::parse($odt_request->date_start)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($odt_request->date_end)->format('d/m/Y') }}</td>
                        <td class="text-center align-middle">
                            @if($odt_request->state == 'P')
                                <span class="badge badge-success">{{ __('transferservice::labels.lbl_pending') }}</span>
                            @elseif($odt_request->state == 'A')
                                <span class="badge badge-primary">{{ __('transferservice::labels.lbl_attended') }}</span>
                            @elseif($odt_request->state == 'R')
                                <span class="badge badge-danger">{{ __('transferservice::labels.lbl_rejected') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer  pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto">{{ $odt_requests->links() }}</div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailsLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalDetailsBody">

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
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> {{__('transferservice::messages.msg_0001')}}",
                message: "<span><strong>{{__('transferservice::labels.lbl_warning')}}: </strong> {{__('transferservice::messages.msg_0002')}}</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                    {
                        confirm:
                            {
                                label: '{{ __('transferservice::buttons.btn_yes') }}',
                                className: 'btn-danger shadow-0'
                            },
                        cancel:
                            {
                                label: '{{ __('transferservice::buttons.btn_not') }}',
                                className: 'btn-default'
                            }
                    },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        @this.deleteOdtRequest(id);
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('ser-odtrequests-delete', event => {
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
        document.addEventListener('livewire:load', function () {
            $(":input").inputmask();
            var controls = {
                leftArrow: "<i class='fal fa-angle-left' style='font-size: 1.25rem'></i>",
                rightArrow: "<i class='fal fa-angle-right' style='font-size: 1.25rem'></i>"
            }

            $("#date_start").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
                @this.set('date_start',this.value);
            });

            $("#date_end").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
                @this.set('date_end', this.value);
            });

        });
        document.addEventListener('ser-odtrequests-details', event => {
            $('#modalDetailsLabel').html(event.detail.label)
            $('#modalDetailsBody').html(event.detail.body)
            $('#modalDetails').modal('show');

            if(event.detail.lat){
                initMap(event.detail.lat,event.detail.lng,event.detail.label);
            }
        });

        function initMap(xlat,xlng,label) {

            var myLatLng = {lat: xlat, lng: xlng};

            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                scrollwheel: false,
                zoom: 16,
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: label
            });
        }

    </script>
</div>
