<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group input-group-multi-transition">
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
                <select class="custom-select">
                    <option value="">Seleccionar</option>
                    @foreach($establishments as $establishment)
                    <option value="{{ $establishment->id }}">{{ $establishment->name }}</option>
                    @endforeach
                </select>
                <input wire:keydown.enter="itemPartsSearch" wire:model.defer="search" type="text" class="form-control" placeholder="@lang('inventory::labels.lbl_type_here')">
                <input type="text" class="form-control" id="custom-range" placeholder="Rango de fechas">
                <div class="input-group-append">
                    <button wire:click="itemPartsSearch" class="btn btn-default waves-effect waves-themed" type="button">@lang('inventory::labels.btn_search')</button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table m-0">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>@lang('inventory::labels.name')</th>
                    <th>@lang('inventory::labels.description')</th>
                    <th>@lang('inventory::labels.lbl_amount')</th>
                    <th>@lang('inventory::labels.weight')</th>
                    <th>@lang('inventory::labels.width')</th>
                    <th>@lang('inventory::labels.long')</th>
                    <th>@lang('inventory::labels.high')</th>
                    <th>@lang('inventory::labels.status')</th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($items as $key => $item)
                    <tr>
                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                        <td class="align-middle">{{ $item->name }}</td>
                        <td class="align-middle">{{ $item->description }}</td>
                        <td class="text-center align-middle">{{ $item->amount }}</td>
                        <td class="align-middle">{{ $item->weight }}</td>
                        <td class="align-middle">{{ $item->width }}</td>
                        <td class="align-middle">{{ $item->long }}</td>
                        <td class="align-middle">{{ $item->high }}</td>
                        <td class="align-middle">
                            @if($item->status)
                                <span class="badge badge-success">{{ __('inventory::labels.active') }}</span>
                            @else
                                <span class="badge badge-danger">{{ __('inventory::labels.inactive') }}</span>
                            @endif
                        </td>
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
                @this.set('start',start);
                @this.set('end',end);
        });
    });
    </script>
</div>
