<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="name">@lang('inventory::labels.name') <span class="text-danger">*</span> </label>
                        <input wire:model="name" type="text" class="form-control" id="name" required="">
                        @error('name')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label" for="name">@lang('labels.description') </label>
                        <input wire:model="description" type="text" class="form-control" id="description" required="">
                        @error('description')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="name">@lang('inventory::labels.lbl_price_sale') <span class="text-danger">*</span> </label>
                        <input wire:model="price" type="text" class="form-control" id="price" required="">
                        @error('price')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="name">@lang('inventory::labels.lbl_internal_code') <span class="text-danger">*</span> </label>
                        <input wire:model="internal_id" type="text" class="form-control" id="internal_id" required="">
                        @error('internal_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="name">@lang('inventory::labels.lbl_sunat_code') </label>
                        <input wire:model="sunat_code" type="text" class="form-control" id="sunat_code" required="">
                        @error('sunat_code')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">@lang('inventory::labels.lbl_initial_stock') <span class="text-danger">*</span> </label>
                        <input wire:model.defer="stock" type="text" class="form-control" required>
                        @error('stock')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">@lang('labels.stock_min') <span class="text-danger">*</span> </label>
                        <input wire:model.defer="stock_min" type="text" class="form-control" required>
                        @error('stock_min')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">@lang('labels.digemid')</label>
                        <input wire:model.defer="digemid" type="text" class="form-control" required>
                        @error('digemid')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="category_id">@lang('inventory::labels.category') </label>
                        <select wire:model="category_id" id="category_id" class="custom-select">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="brand_id">@lang('inventory::labels.brand') </label>
                        <select wire:model="brand_id" id="brand_id" class="custom-select">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($brands as $item)
                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="unit_measure_id">@lang('inventory::labels.lbl_unit_measure') <span class="text-danger">*</span></label>
                        <select wire:model="unit_measure_id" id="unit_measure_id" class="custom-select" required="">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($unit_measures as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('unit_measure_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">@lang('labels.price_purchase')</label>
                        <input wire:model.defer="purchase_price" type="text" class="form-control" required>
                        @error('purchase_price')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">@lang('inventory::labels.status') <span class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="status" type="checkbox" class="custom-control-input" id="status" checked="">
                            <label class="custom-control-label" for="status">@lang('inventory::labels.active')</label>
                        </div>
                        @error('status')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-8">
                        <input type="file" wire:model="image">
                        @error('image')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        @if ($image)
                            Vista previa:
                            <img class="img-thumbnail" src="{{ $image->temporaryUrl() }}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('inventory_item')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('inventory::labels.lbl_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('inventory::labels.btn_save')</button>
        </div>
    </div>
    <script>
        document.addEventListener('set-item-save', event => {
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
    </script>
</div>
