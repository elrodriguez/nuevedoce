<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="name">@lang('inventory::labels.name') <span class="text-danger">*</span> </label>
                        <input wire:model="name" type="text" class="form-control" id="name" required="">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="category_id">@lang('inventory::labels.category') <span class="text-danger">*</span> </label>
                        <select wire:model="category_id" id="category_id" class="custom-select" required="">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="brand_id">@lang('inventory::labels.brand') <span class="text-danger">*</span> </label>
                        <select wire:model="brand_id" id="brand_id" class="custom-select" required="">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($brands as $item)
                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="description">@lang('inventory::labels.description') <span class="text-danger">*</span> </label>
                        <input wire:model="description" type="text" class="form-control" id="description" required="">
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3" wire:ignore>
                        <label class="form-label" for="amount">@lang('inventory::labels.lbl_amount') <span class="text-danger">*</span> </label>
                        <input wire:model="amount" type="number" class="form-control" id="amount" required="" min="1">
                        @error('amount')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="image">@lang('inventory::labels.lbl_image') <span class="text-danger">*</span> </label>
                        <div class="custom-file" wire:ignore>
                            <input wire:model="image" type="file" class="custom-file-input" id="image" >
                            <label class="custom-file-label" for="customFile">@lang('inventory::labels.lbl_choose_file')</label>
                        </div>
                        @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">@lang('inventory::labels.status') <span class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="status" type="checkbox" class="custom-control-input" id="status" checked="">
                            <label class="custom-control-label" for="status">@lang('inventory::labels.active')</label>
                        </div>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row" wire:ignore>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="weight">@lang('inventory::labels.weight') (@lang('inventory::labels.lbl_kg')) <span class="text-danger">*</span> </label>
                        <input wire:model="weight" type="number" class="form-control" id="weight" required="">
                        @error('weight')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="width">@lang('inventory::labels.width') (@lang('inventory::labels.lbl_meters')) <span class="text-danger">*</span> </label>
                        <input wire:model="width" type="number" class="form-control" id="width" required="">
                        @error('width')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="high">@lang('inventory::labels.high') (@lang('inventory::labels.lbl_meters'))<span class="text-danger">*</span> </label>
                        <input wire:model="high" type="number" class="form-control" id="high" required="">
                        @error('high')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="long">@lang('inventory::labels.long') (@lang('inventory::labels.lbl_meters'))<span class="text-danger">*</span> </label>
                        <input wire:model="long" type="number" class="form-control" id="long" required="">
                        @error('long')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('inventory_item_part', $id_item)}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('inventory::labels.lbl_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('inventory::labels.btn_save')</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('set-item-save', event => {
            let id_item_jj = event.detail.id_item_jj;
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false,
                callback: function () {
                    let url = "{{ route('inventory_item_part', $id_item) }}";
                    window.location.href = url;
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('livewire:load', function () {
            $(":input").inputmask();
            $("#spaItemCreate").html(':: {{ $name_item }}');
        });
    </script>
</div>
