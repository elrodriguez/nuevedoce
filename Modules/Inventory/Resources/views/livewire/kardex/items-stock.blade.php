<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group input-group-multi-transition" wire:ignore>
                <div class="input-group-prepend">
                    <button class="btn btn-outline-default dropdown-toggle waves-effect waves-themed" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $show }}</button>
                    <div class="dropdown-menu" style="">
                        <button class="dropdown-item" wire:click="$set('show', 10)">10</button>
                        <button class="dropdown-item" wire:click="$set('show', 20)">20</button>
                        <button class="dropdown-item" wire:click="$set('show', 50)">50</button>
                        <div role="separator" class="dropdown-divider"></div>
                        <button class="dropdown-item" wire:click="$set('show', 100)">100</button>
                        <button class="dropdown-item" wire:click="$set('show', 500)">500</button>
                    </div>
                </div>
                <div class="input-group-prepend">
                    @if($search)
                        <button wire:click="$set('search', '')" type="button" class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    @else
                        <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    @endif
                </div>
                <select wire:model.defer="location_id" class="custom-select">
                    <option value="">Seleccionar</option>
                    @foreach($establishments as $establishment)
                    <option value="{{ $establishment->id }}">{{ $establishment->description }}</option>
                    @endforeach
                </select>
                <input wire:model.defer="search" type="text" class="form-control autoCompleteItem" data-url="{{ route('inventory_kardex_items_search') }}" autocomplete="off" placeholder="@lang('inventory::labels.lbl_type_here')">
                <input type="text" class="form-control" id="custom-range" placeholder="Rango de fechas">
                <div class="input-group-append">
                    <button wire:click="getItems" class="btn btn-default waves-effect waves-themed" type="button">@lang('inventory::labels.btn_search')</button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('labels.product') }}</th>
                        <th>{{ __('labels.date') }}</th>
                        <th>Tipo transacción</th>
                        <th>{{ __('labels.number') }}</th>
                        <th class="text-center">{{ __('labels.f_issuance') }}</th>
                        <th class="text-center">{{ __('labels.entry_kardex') }}</th>
                        <th class="text-center">{{ __('labels.exit_kardex') }}</th>
                        <th class="text-center">Saldo</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($items as $key => $item)
                    <tr>
                        <td class="align-middle">{{ $key+1 }}</td>
                        <td class="align-middle">{{ $item->name.' '.$item->description }}</td>
                        <td class="align-middle text-center">{{ $item->created_at }}</td>
                        <td class="align-middle">
                            @if($item->inventory_kardexable_type == 'Modules\Inventory\Entities\InvPurchase')
                                @if ($item->quantity>0)
                                    {{ __('Compra') }}
                                @else
                                    {{ __('Anulación Compra') }}
                                @endif
                            @else
                                {{ $item->detail }} 
                            @endif
                        </td>
                        <td class="align-middle">{{ $item->number }}</td>
                        <td class="align-middle text-center">{{ $item->date_of_issue }}</td>
                            @if($item->inventory_kardexable_type == 'Modules\Inventory\Entities\InvPurchase')
                                @if ($item->quantity>0)
                                    <td class="align-middle text-right">{{ $item->quantity }}</td>
                                    <td class="align-middle text-right">-</td>
                                @else
                                    <td class="align-middle text-right">-</td>
                                    <td class="align-middle text-right">{{ $item->quantity }}</td>
                                @endif
                            @else
                                <td class="align-middle text-right">{{ $item->quantity }}</td>
                                <td class="align-middle text-right">-</td>
                            @endif
                            @php
                                $balance = $balance + $item->quantity
                            @endphp
                        <td class="align-middle text-right">{{ number_format($balance, 2, '.', '') }}</td>
                    </tr>
    
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer card-footer-background pb-0 d-flex flex-row align-items-center" style="margin-bottom: 20px;">
            {{-- <div class="ml-auto">{{ $items->links() }}</div> --}}
        </div>
    </div>
    <script type="text/javascript">
    document.addEventListener('livewire:load', function () {
        $('#custom-range').daterangepicker({
                locale:
                    {
                        format: 'DD/MM/YYYY'
                },
                opens: 'left'
            }, function(start, end, label){
                console.log(end.format('YYYY-MM-DD'))
                @this.set('start',start.format('YYYY-MM-DD'));
                @this.set('end',end.format('YYYY-MM-DD'));
        });
    });
    document.addEventListener('livewire:load', function () {
        $('.autoCompleteItem').autoComplete().on('autocomplete.select', function (evt, item) {
            @this.set('item_id',item.value);
        });
    });
    </script>
</div>
