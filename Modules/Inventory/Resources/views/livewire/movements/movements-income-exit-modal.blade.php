<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="movementsIncomeExitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $title }} de producto al almacén</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-12 mb-3">
                            <label class="form-label" for="product_id">{{ __('labels.product') }}</label>
                            <div wire:ignore>
                                <input placeholder="@lang('labels.search_product')" data-url="{{ route('inventory_search_products') }}" autocomplete="off" type="text" class="form-control" id="product_id">
                            </div>
                            @error('product_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 mb-3">
                            <label class="form-label" for="warehouse_id">{{ __('labels.warehouse') }}</label>
                            <select wire:model.defer="warehouse_id" class="custom-select" id="warehouse_id">
                                <option value="">{{ __('labels.to_select') }}</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                            @error('warehouse_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="quantity">{{ __('labels.quantity') }}</label>
                                <input wire:model.defer="quantity" type="text" class="form-control" id="quantity">
                                @error('quantity')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 mb-3">
                            <label class="form-label" for="reason_id">{{ __('labels.reason_for_transfer') }}</label>
                            <select wire:model.defer="reason_id" class="custom-select" id="reason_id">
                                <option value="">{{ __('labels.to_select') }}</option>
                                @foreach ($transactions as $transaction)
                                    <option value="{{ $transaction->id }}">{{ $transaction->description }}</option>
                                @endforeach
                            </select>
                            @error('reason_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                    <button wire:target="saveMovement" wire:click="saveMovement" wire:loading.attr="disabled" type="button" class="btn btn-primary">{{ __('labels.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-movements-income-exit-modal', event => {
            $('#movementsIncomeExitModal').modal('show');
        });
        document.addEventListener('livewire:load', function () {
            $('#product_id').autoComplete().on('autocomplete.select', function (evt, item) {
                selectproductM(item.value);
            });
        });   
        document.addEventListener('inv-transaction-save', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='{{ env('BOOTBOX_SUCCESS_ICON') }} text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': '{{ env("BOOTBOX_SUCCESS_COLOR") }}'});
            $('#product_id').autoComplete('clear');
        });
        document.addEventListener('output-transaction-error', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='{{ env('BOOTBOX_ERROR_ICON') }} text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.error') }}!</span>",
                message: "<span><strong>{{ __('inventory::labels.went_wrong') }}... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': '{{ env("BOOTBOX_ERROR_COLOR") }}'});
        });
        function selectproductM(id){
            @this.set('product_id',id);
        }
    </script>
</div>
