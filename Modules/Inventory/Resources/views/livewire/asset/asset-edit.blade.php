<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="asset_type_id">@lang('inventory::labels.lbl_asset_type') <span class="text-danger">*</span> </label>
                        <select wire:model="asset_type_id" id="asset_type_id" class="custom-select" required="">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($asset_types as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('asset_type_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="patrimonial_code">@lang('inventory::labels.lbl_patrimonial_code') <span class="text-danger">*</span> </label>
                        <input wire:model="patrimonial_code" type="text" class="form-control" id="patrimonial_code" required="">
                        @error('patrimonial_code')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3" wire:ignore>
                        <label class="form-label" for="item_id">@lang('inventory::labels.lbl_item') <span class="text-danger">*</span> </label>
                        <input wire:model="item_text" id="item_text" required="" class="form-control basicAutoComplete" type="text" placeholder="Ingrese el item a buscar y luego seleccione." data-url="{{ route('inventory_asset_search') }}" autocomplete="off" readonly />
                        <input wire:model="item_id" id="item_id" type="hidden" placeholder="" autocomplete="off" />
                        @error('item_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="lbl_location">@lang('inventory::labels.lbl_location') <span class="text-danger">*</span> </label>
                        <select wire:model="location_id" id="lbl_location" class="custom-select" required="">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('asset_type_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">@lang('inventory::labels.status') <span class="text-danger">*</span> </label>
                        <select wire:model="status" class="form-control">
                            <option value="00">Inactivo</option>
                            <option value="01">Activo</option>
                            <option value="02">En reparación</option>
                            <option value="03">En evento</option>
                            <option value="04">Perdido</option>
                            <option value="05">De baja</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('inventory_asset')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('inventory::labels.lbl_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('labels.to_update')</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-asset-save', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.success') }}!</span>",
                message: "<span><strong>{{ __('inventory::labels.excellent') }}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('livewire:load', function () {
            //Autocomplete
            $('.basicAutoComplete').autoComplete({
                autoSelect: true,
            }).on('autocomplete.select', function (evt, item) {
            @this.set('item_id',item.value);
            @this.set('item_text',item.text);
            });
        });
    </script>
</div>
