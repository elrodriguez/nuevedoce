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
                    <div class="col-md-3 mb-3">
                        <label class="form-label">@lang('inventory::labels.parts') <span class="text-danger">*</span> </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="part" type="checkbox" class="custom-control-input" id="part" checked="" wire:ignore>
                            <label class="custom-control-label" for="part">@lang('inventory::labels.active')</label>
                        </div>
                        @error('part')
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
                        <label class="form-label" for="number_parts">@lang('inventory::labels.number_parts') <span class="text-danger">*</span> </label>
                        <input wire:model="number_parts" type="number" class="form-control" id="number_parts" required="">
                        @error('number_parts')
                        <div class="invalid-feedback">{{ $message }}</div>
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
                <br>
                <div id="xyzDivPartesItems">
                    <h2 class="fw-700 m-0"><i class="subheader-icon fal fa-wrench"></i> @lang('inventory::labels.lbl_add_parts'):</h2>
                    <br>
                    <div class="form-row">
                        <div class="col-md-7 mb-3" wire:ignore>
                            <label class="form-label" for="part_text">@lang('inventory::labels.lbl_part') <span class="text-danger">*</span> </label>
                            <input wire:model="part_text" id="part_text" required="" class="form-control basicAutoComplete" type="text" placeholder="Ingrese la parte a buscar y luego seleccione." data-url="{{ route('inventory_item_search') }}" autocomplete="off" />
                            <input wire:model="part_id" id="part_id" type="hidden" placeholder="" autocomplete="off" />
                            <input wire:model="part_weight" id="part_weight" type="hidden" placeholder="" autocomplete="off" />
                            @error('part_text')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                            @error('part_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="amount">@lang('inventory::labels.lbl_amount') <span class="text-danger">*</span> </label>
                            <input wire:model="amount" type="number" class="form-control" id="amount" min="1" required="">
                            @error('amount')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3" style="margin-top: 23px;">
                            <a onclick="validateSavePart()" wire:loading.attr="disabled" class="btn btn-primary ml-auto waves-effect waves-themed" style="color: white;"><i class="fal fa-plus"></i> @lang('inventory::labels.lbl_add')</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{ __('labels.actions') }}</th>
                                        <th class="text-center">{{ __('labels.name') }}</th>
                                        <th class="text-center">{{ __('labels.quantity') }}</th>
                                        <th class="text-center">{{ __('inventory::labels.weight') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($parts_item as $key => $item)
                                        <tr>
                                            <td class="text-center align-middle">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fal fa-cogs"></i>
                                                    </button>
                                                    <div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 35px; left: 0px;" x-placement="bottom-start">
                                                        <div class="dropdown-divider"></div>
                                                            <button wire:click="deletePart({{ $item['id'] }})" type="button" class="dropdown-item text-danger">
                                                                <i class="fal fa-trash-alt mr-1"></i> @lang('inventory::labels.lbl_delete')
                                                            </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">{{ $item['name'] }}</td>
                                            <td class="text-center align-middle">{{ $item['amount'] }}</td>
                                            <td class="text-center align-middle">{{ $item['weight'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('inventory_item')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('inventory::labels.lbl_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('inventory::labels.btn_save')</button>
        </div>
    </div>
    <script type="text/javascript">
        function validateSavePart(){
            let id_pp = $("#part_id").val();
            if(id_pp > 0){
                $('#part_text').css('color', '');
                $('#part_text').css('border-color', '');
                @this.savePart();
            }else{
                alert("Busque y seleccione la parte ha agregar.");
                $('#part_text').css('color', 'red');
                $('#part_text').css('border-color', 'red');
            }
        }

        document.addEventListener('set-item-save', event => {
            let part_count = event.detail.part_count;
            if(part_count > 0){
                $('#part').prop('disabled', true);
            }else{
                $('#part').prop('disabled', false);
            }
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
        document.addEventListener('set-item-save-not', event => {
            let part_count = event.detail.part_count;
            if(part_count > 0){
                $('#part').prop('disabled', true);
            }else{
                $('#part').prop('disabled', false);
            }
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.lbl_warning') }}!</span>",
                message: "<span>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });

        document.addEventListener('livewire:load', function () {
            $(":input").inputmask();
            $("#weight").prop('disabled', true);
            $('#part').click(function (){
                $(this).off('change');
                $(this).off('input');
                if ($(this).is(':checked')) {
                    $("#number_parts").prop('disabled', true);
                    $("#weight").prop('disabled', false);
                    $("#xyzDivPartesItems").css('display', 'none');
                } else {
                    $("#number_parts").prop('disabled', false);
                    $("#weight").prop('disabled', true);
                    $("#xyzDivPartesItems").css('display', 'block');
                }
            });

            //Autocomplete
            $('.basicAutoComplete').autoComplete({
                autoSelect: true,
            }).on('autocomplete.select', function (evt, item) {
                @this.set('part_id',item.value);
                @this.set('part_text',item.text);
                @this.set('part_weight',item.weight);
            });
        });
    </script>
</div>
