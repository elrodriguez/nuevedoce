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
                    @if($search || $date_upload || $license_plate)
                        <button wire:click="clearInput" type="button" class="input-group-text text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    @else
                        <span class="input-group-text text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    @endif
                </div>
                <input wire:model="date_upload" wire:keydown.enter="loadOrderSearch" type="text" class="form-control" id="date_upload" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" class="form-control" im-insert="true" placeholder="{{__('transferservice::labels.lbl_upload_date')}}">
                <input wire:model="license_plate" wire:keydown.enter="loadOrderSearch" type="text" class="form-control" id="license_plate" onchange="this.dispatchEvent(new InputEvent('input'))" class="form-control" placeholder="{{__('transferservice::labels.lbl_license_plate')}}">
                <input wire:keydown.enter="loadOrderSearch" wire:model.defer="search" type="text" class="form-control" placeholder="{{__('transferservice::labels.lbl_load_order')}}">
                <div class="input-group-append">
                    <button wire:click="loadOrderSearch" id="loadOrderSearch" class="btn btn-default waves-effect waves-themed" type="button">@lang('transferservice::buttons.btn_search')</button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">@lang('transferservice::labels.lbl_actions')</th>
                    <th>@lang('transferservice::labels.lbl_code')</th>
                    <th>@lang('transferservice::labels.lbl_upload_date')</th>
                    <th>@lang('transferservice::labels.lbl_charging_time')</th>
                    <th>@lang('transferservice::labels.lbl_vehicle')</th>
                    <th>@lang('transferservice::labels.lbl_license_plate')</th>
                    <th>@lang('transferservice::labels.lbl_state')</th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($load_orders as $key => $item)
                    <tr>
                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                        <td class="text-center tdw-50 align-middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fal fa-cogs"></i>
                                </button>
                                <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                    @can('serviciodetraslados_orden_carga_aceptar_salida')
                                        @if($item->state == 'P')
                                        <a onclick="confirmExit('{{$item->id}}')" class="dropdown-item">
                                            <i class="fal fa-check mr-1"></i>@lang('transferservice::labels.lbl_accept_exit')
                                        </a>
                                        <a class="dropdown-item" wire:click="openModalDetails({{ $item->id }}, {{ $item->telephone }})" href="javascript:void(0)" type="button">
                                            <i class="fal fa-map-marked-alt"></i> @lang('transferservice::labels.lbl_print_map')
                                        </a>
                                        @else
                                            <button class="dropdown-item" disabled>
                                                <i class="fal fa-check mr-1"></i>@lang('transferservice::labels.lbl_accept_exit')
                                            </button>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ $item->uuid }}</td>
                        <td class="align-middle">{{ date('d/m/Y', strtotime($item->upload_date)) }}</td>
                        <td class="align-middle">{{ $item->charging_time }}</td>
                        <td class="align-middle">{{ $item->name }}</td>
                        <td class="align-middle">{{ $item->license_plate }}</td>
                        <td class="align-middle">
                            @if($item->state == 'P')
                                <span class="badge badge-secondary">{{ __('transferservice::labels.lbl_slope_load') }}</span>
                            @elseif($item->state == 'E')
                                <span class="badge badge-success">{{ __('transferservice::labels.lbl_in_service') }}</span>
                            @elseif($item->state == 'A')
                                <span class="badge badge-primary">{{ __('transferservice::labels.lbl_returned') }}</span>
                            @elseif($item->state == 'B')
                                <span class="badge badge-info">{{ __('transferservice::labels.lbl_pending_return') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer card-footer-background pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto">{{ $load_orders->links() }}</div>
        </div>
    </div>
    <!-- Modal Mapa -->
    <div class="modal fade" id="modalDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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
                    <a id="btnWhatsapp" class="dropdown-item" href="" target="_blank" style="display: none;">
                        <i class="fal fa-comment-lines"></i> {{__('transferservice::labels.lbl_share_to_whatsApp')}}
                    </a>
                    <button type="button" class="btn btn-success map-print">{{__('transferservice::labels.lbl_print')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function confirmExit(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-success mr-2'></i> {{__('transferservice::labels.lbl_attention')}}",
                message: "<span><strong>{{__('transferservice::messages.msg_0007')}}: </strong></span>",
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
                        @this.acceptExit(id);
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(19,190,0,0.5)'});
            box.find('.modal-content').css({'background-color': 'rgba(24,236,9,0.5)'});
        }
        document.addEventListener('ser-load-order-accept', event => {
            $('#loadOrderSearch').unbind().click();
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

            $("#date_upload").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
                @this.set('date_upload',this.value);
            });
        });

        //
        document.addEventListener('ser-load-exit-details', event => {
            let map_whatsapp = event.detail.whatsapp;
            //btnWhatsapp
            if(map_whatsapp != ''){
                $('#btnWhatsapp').css('display', 'block');
                $('#btnWhatsapp').attr('href', map_whatsapp);
            }else{
                $('#btnWhatsapp').css('href', '');
            }
            let data_m = event.detail.data;

            $('#modalDetailsLabel').html(event.detail.label)
            $('#modalDetailsBody').html(event.detail.body)
            $('#modalDetails').modal('show');

            if(event.detail.lat){
                initMap(event.detail.lat, event.detail.lng, event.detail.label, data_m);
            }
            //function
            function printAnyMaps() {
                const $body = $('body');
                const $mapContainer = $('#map');
                const $mapContainerParent = $mapContainer.parent();
                const $printContainer = $('<div style="position:relative;">');

                $printContainer
                    .height($mapContainer.height())
                    .append($mapContainer)
                    .prependTo($body);

                const $content = $body
                    .children()
                    .not($printContainer)
                    .not('script')
                    .detach();

                /**
                 * Needed for those who use Bootstrap 3.x, because some of
                 * its `@media print` styles ain't play nicely when printing.
                 */
                const $patchedStyle = $('<style media="print">')
                    .text(`
                          img { max-width: none !important; }
                          a[href]:after { content: ""; }
                        `)
                    .appendTo('head');

                window.print();

                $body.prepend($content);
                $mapContainerParent.prepend($mapContainer);

                $printContainer.remove();
                $patchedStyle.remove();
            }

            $('.map-print').unbind().click(function (){
                printAnyMaps();
            });
        });
        function initMap(xlat,xlng,label, data_m) {
            var myLatLng = {lat: xlat, lng: xlng};
            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                scrollwheel: false,
                zoom: 8,
            });

            data_m.forEach(function(row, index) {
                var marker = new google.maps.Marker({
                    position: {lat:row.lat, lng:row.lon},
                    map: map,
                    title: row.title
                });
            });

        }
    </script>
</div>
