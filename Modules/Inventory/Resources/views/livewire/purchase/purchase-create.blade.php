<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="supplier_id">@lang('inventory::labels.lbl_supplier') </label>
                        <select wire:model="supplier_id" id="supplier_id" class="custom-select" required="">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($suppliers as $item)
                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="document_type_id">@lang('inventory::labels.lbl_document_type') </label>
                        <select wire:model="document_type_id" id="document_type_id" class="custom-select" required="">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($document_types as $item)
                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                        @error('document_type_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="date_of_issue">@lang('inventory::labels.lbl_date_of_issue') <span class="text-danger">*</span> </label>
                        <input wire:model="date_of_issue" type="text" class="form-control" id="date_of_issue" required="" onchange="this.dispatchEvent(new InputEvent('input'))" data-inputmask="'mask': '99/99/9999'" im-insert="true">
                        @error('date_of_issue')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="serie">@lang('inventory::labels.lbl_serie') <span class="text-danger">*</span> </label>
                        <input wire:model="serie" type="text" id="serie" class="form-control" required>
                        @error('serie')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="number">@lang('inventory::labels.lbl_number') <span class="text-danger">*</span> </label>
                        <input wire:model="number" type="number" id="number" class="form-control" required>
                        @error('number')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3" wire:ignore>
                        <label class="form-label" for="total">@lang('inventory::labels.lbl_total') <span class="text-danger">*</span> </label>
                        <input wire:model="total" type="number" class="form-control" id="total" required="">
                        @error('total')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="establishment_id">@lang('inventory::labels.lbl_establishment') </label>
                        <select wire:change="getStores" wire:model="establishment_id" id="establishment_id" class="custom-select" required="">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($establishments as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('establishment_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="store_id">@lang('inventory::labels.lbl_store') </label>
                        <select wire:model="store_id" id="store_id" class="custom-select" required="">
                            <option value="">@lang('inventory::labels.lbl_select')</option>
                            @foreach($stores as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('store_id')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <br>
                <div id="xyzDivPartesItems" wire:ignore.self>
                    <h2 class="fw-700 m-0"><i class="subheader-icon fal fa-wrench"></i> @lang('inventory::labels.lbl_add') @lang('inventory::labels.lbl_items'):</h2>
                    <br>
                    <div class="form-row">
                        <div class="col-md-4 mb-3" wire:ignore>
                            <label class="form-label" for="item_text">@lang('inventory::labels.lbl_item') <span class="text-danger">*</span> </label>
                            <input wire:model="item_text" id="item_text" required="" class="form-control basicAutoComplete" type="text" placeholder="Ingrese la parte a buscar y luego seleccione." data-url="{{ route('inventory_purchase_search') }}" autocomplete="off" />
                            <input wire:model="item_id" id="item_id" type="hidden" placeholder="" autocomplete="off" />
                            @error('part_text')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                            @error('item_text')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label" for="item_amount">@lang('inventory::labels.lbl_amount') <span class="text-danger">*</span> </label>
                            <input wire:model="item_amount" type="item_amount" class="form-control" id="amount" min="1" required="">
                            @error('item_amount')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="item_price">@lang('inventory::labels.lbl_purchase_price') </label>
                            <input wire:model="item_price" type="number" class="form-control" id="item_price" min="1">
                            @error('item_price')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3" style="margin-top: 23px;">
                            <a onclick="validateSaveItem()" wire:loading.attr="disabled" class="btn btn-primary ml-auto waves-effect waves-themed" style="color: white;"><i class="fal fa-plus"></i> @lang('inventory::labels.lbl_add')</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{ __('labels.actions') }}</th>
                                        <th>{{ __('labels.name') }}</th>
                                        <th class="text-center">{{ __('labels.quantity') }}</th>
                                        <th class="text-center">{{ __('inventory::labels.lbl_purchase_price') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $key => $item)
                                        <tr>
                                            <td class="text-center align-middle">
                                                <button wire:click="deleteItem({{ $item['item_id'] }})" type="button" class="btn btn-secondary rounded-circle btn-icon waves-effect waves-themed">
                                                    <i class="fal fa-trash-alt mr-1"></i>
                                                </button>
                                            </td>
                                            <td class="align-middle">{{ $item['item_text'] }}</td>
                                            <td class="text-center align-middle">{{ $item['amount'] }}</td>
                                            <td class="align-middle text-right">{{ number_format($item['price'], 2, '.', ' ') }}</td>
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
            <a href="{{ route('inventory_purchase')}}" type="button" class="btn btn-secondary waves-effect waves-themed">@lang('inventory::labels.lbl_list')</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">@lang('inventory::labels.btn_save')</button>
        </div>
    </div>
    <script type="text/javascript">
        function validateSaveItem(){
            let id_pp = $("#item_id").val();
            if(id_pp > 0){
                $('#item_text').css('color', '');
                $('#item_text').css('border-color', '');
                @this.saveItem();
            }else{
                alert("Busque y seleccione el Item ha agregar.");
                $('#item_text').css('color', 'red');
                $('#item_text').css('border-color', 'red');
            }
        }

        document.addEventListener('inv-purchase-save', event => {
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

        document.addEventListener('inv-purchase-save-not', event => {
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
            var controls = {
                leftArrow: "<i class='fal fa-angle-left' style='font-size: 1.25rem'></i>",
                rightArrow: "<i class='fal fa-angle-right' style='font-size: 1.25rem'></i>"
            }

            $("#date_of_issue").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls,
                language: "es",
                autoclose: true
            }).on('hide', function(e){
                @this.set('date_of_issue',this.value);
            });

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
