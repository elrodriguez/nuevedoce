<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="name">@lang('transferservice::labels.lbl_name') <span class="text-danger">*</span> </label>
                        <input wire:model="name" type="text" class="form-control" id="name" required="">
                        @error('name')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="address">@lang('transferservice::labels.lbl_address') <span class="text-danger">*</span> </label>
                        <input wire:model="address" type="text" class="form-control" id="address" required="">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="reference">@lang('transferservice::labels.lbl_reference') <span class="text-danger">*</span> </label>
                        <input wire:model="reference" type="text" class="form-control" id="reference" required="">
                        @error('reference')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3" wire:ignore>
                        <label class="form-label" for="latitude">@lang('transferservice::labels.lbl_latitude')</label>
                        <input wire:model="latitude" type="text" class="form-control" id="latitude" readonly>
                        @error('latitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3" wire:ignore>
                        <label class="form-label" for="longitude">@lang('transferservice::labels.lbl_longitude') </label>
                        <input wire:model="longitude" type="text" class="form-control" id="longitude" readonly>
                        @error('longitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">@lang('transferservice::labels.lbl_state') <span class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="state" type="checkbox" class="custom-control-input" id="state" checked="">
                            <label class="custom-control-label" for="state">@lang('transferservice::labels.lbl_active')</label>
                        </div>
                        @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div id="map" style="height: 400px;" wire:ignore></div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('service_locals_index')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('transferservice::buttons.btn_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('transferservice::buttons.btn_save')</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('ser-locals-save', event => {
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

        });

        function initMap() {
            const myLatlng = { lat: -9.189967, lng: -75.015152 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                mapTypeControl: true,
                mapTypeId: 'satellite',
                center: myLatlng,
            });
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "Haga clic en el mapa para obtener Lat / Lng!",
                position: myLatlng,
            });

            infoWindow.open(map);
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();
                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng,
                });
                infoWindow.setContent(
                    JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                );
                let valores = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                let latitudeLongitude = JSON.parse(valores);
                @this.set('latitude', latitudeLongitude.lat);
                @this.set('longitude', latitudeLongitude.lng);
                infoWindow.open(map);
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMtl5gJVvCZucrsOuDomP9wJog5qopRiI&callback=initMap&v=weekly&channel=2" async></script>
</div>
