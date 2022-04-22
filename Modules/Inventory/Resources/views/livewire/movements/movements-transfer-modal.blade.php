<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="movementsTransferModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('inventory::labels.lbl_transfer_between_warehouses') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="location_id">{{ __('labels.origin_warehouse') }}</label>
                            <input disabled value="{{ $location_name }}" class="form-control" type="text">
                            @error('location_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="location_new_id">{{ __('labels.destination_warehouse') }}</label>
                            <select wire:model.defer="location_new_id" class="custom-select" id="location_new_id">
                                <option value="">{{ __('labels.to_select') }}</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                            @error('location_new_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-9 mb-3">
                            <label class="form-label" for="product_id">{{ __('labels.product') }}</label>
                            <input disabled value="{{ $item_name }}" class="form-control" type="text">
                            @error('product_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label class="form-label" for="actual_quantity">{{ __('labels.actual_quantity') }}</label>
                            <input disabled value="{{ $stock }}" class="form-control text-right" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-9 mb-3">
                            <label class="form-label" for="reason_transfer">{{ __('labels.reason_for_transfer') }}</label>
                            <textarea wire:model.defer="reason_transfer" class="form-control" rows="1"></textarea>
                            @error('reason_transfer')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label class="form-label" for="quantity_move">{{ __('labels.amount_to_transfer') }}</label>
                            <input wire:model.defer="quantity_move" class="form-control text-right" type="text">
                            @error('quantity_move')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                    <button wire:target="saveMovementTransfer" wire:click="saveMovementTransfer" wire:loading.attr="disabled" type="button" class="btn btn-primary">{{ __('labels.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-movements-transfer-modal', event => {
            $('#movementsTransferModal').modal('show');
        });
        document.addEventListener('inv-transfer-save', event => {
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
        document.addEventListener('inv-movements-transfer-alert-error', event => {
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
    </script>
</div>
