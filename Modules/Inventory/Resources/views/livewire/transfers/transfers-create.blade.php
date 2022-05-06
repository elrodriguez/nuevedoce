<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label class="form-label" for="simpleinput">{{ __('labels.origin_warehouse') }}</label>
                        <select wire:model="warehouse_id" class="custom-select form-control">
                            <option value="">{{ __('labels.to_select') }}</option>
                            @foreach ($warehouses as $warehouse)
                                <option {{ $warehouse->id == $destination_warehouse_id ? 'disabled' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->description }}</option>
                            @endforeach
                        </select>
                        @error('warehouse_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"
                            for="simpleinput">{{ __('labels.destination_warehouse') }}</label>
                        <select wire:model="destination_warehouse_id" class="custom-select form-control">
                            <option value="">{{ __('labels.to_select') }}</option>
                            @foreach ($warehouses as $warehouse)
                                <option {{ $warehouse->id == $warehouse_id ? 'disabled' : '' }}
                                    value="{{ $warehouse->id }}">{{ $warehouse->description }}</option>
                            @endforeach
                        </select>
                        @error('destination_warehouse_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label class="form-label" for="simpleinput">{{ __('labels.details') }}</label>
                        <textarea wire:model.defer="detail" rows="1" class="form-control"></textarea>
                        @error('detail')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <label class="form-label" for="simpleinput">{{ __('labels.product') }}</label>
                        <div wire:ignore>
                            <input class="form-control basicAutoComplete" type="text"
                                data-url="{{ route('inventory_transfers_search') }}" autocomplete="off">
                        </div>
                        <div>
                            @error('product_id')
                                <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                <thead class="bg-primary-600">
                    <tr>
                        <th class="text-center">{{ __('labels.actions') }}</th>
                        <th class="text-center">{{ __('labels.product') }}</th>
                        <th class="text-right">{{ __('labels.actual_quantity') }}</th>
                        <th class="text-right">{{ __('labels.amount_to_transfer') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $key => $product)
                            <tr>
                                <td class="text-center align-middle">
                                    <button wire:click="removeProduct({{ $key }})"
                                        class="btn btn-danger btn-sm btn-icon waves-effect waves-themed">
                                        <i class="fal fa-times"></i>
                                    </button>
                                </td>
                                <td class="align-middle">{{ $product['description'] }}</td>
                                <td class="text-right align-middle">{{ $product['stock'] }}</td>
                                <td class="text-right align-middle">
                                    <input class="form-control text-right" type="text"
                                        wire:model.defer="products.{{ $key }}.quantity"
                                        name="products[{{ $key }}].quantity">
                                    @error('products.' . $key . '.quantity')
                                        <div class="invalid-feedback-2">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="odd">
                            <td colspan="12" class="dataTables_empty text-center" valign="top">
                                {{ __('labels.no_data_available_in_the_table') }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('inventory_transfers') }}" type="button"
                class="btn btn-secondary waves-effect waves-themed">
                @lang('labels.back')
            </a>
            <button wire:click="store" wire:loading.attr="disabled"
                class="btn btn-primary ml-auto waves-effect waves-themed" type="button">
                @lang('labels.save')
            </button>
        </div>
    </div>
    <script>
        window.addEventListener('response_transfer_store', event => {
            swalAlert(event.detail.title, event.detail.message, event.detail.icon);
        });

        function swalAlert(title, msg, icon) {
            Swal.fire(title, msg, icon);
        }

        document.addEventListener('livewire:load', function() {
            $('.basicAutoComplete').autoComplete({
                autoSelect: true,
            }).on('autocomplete.select', function(evt, item) {
                @this.addProduct(item.value);
            });
        });
    </script>
</div>
