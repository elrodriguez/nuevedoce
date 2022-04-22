<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="movementsRemoveModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('inventory::labels.lbl_remove_product_from_warehouse') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-9 mb-3">
                            <label class="form-label" for="product_id">{{ __('labels.product') }}</label>
                            <input disabled value="{{ $item_name }}" class="form-control" type="text">
                            @error('product_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label class="form-label" for="current_amount">{{ __('labels.actual_quantity') }}</label>
                            <input disabled value="{{ $current_amount }}" class="form-control text-right" type="text">
                            @error('current_amount')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-9 mb-3">
                            <label class="form-label" for="location_id">{{ __('labels.origin_warehouse') }}</label>
                            <input disabled value="{{ $location_name }}" class="form-control" type="text">
                            @error('location_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label class="form-label" for="quantity_remove">{{ __('labels.amount_to_withdraw') }}</label>
                            <input wire:model.defer="quantity_remove" class="form-control text-right" type="text">
                            @error('quantity_remove')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                    <button wire:target="saveMovementRemove" wire:click="saveMovementRemove" wire:loading.attr="disabled" type="button" class="btn btn-primary">{{ __('labels.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-movements-remove-modal', event => {
            $('#movementsRemoveModal').modal('show');
        });
        document.addEventListener('inv-remove-save', event => {
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
        document.addEventListener('inv-movements-remove-alert-error', event => {
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
