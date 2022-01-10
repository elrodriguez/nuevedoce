<div>
    <div class="card mb-g rounded-top">
        <div class="card-header">
            <div class="input-group input-group-multi-transition bg-white shadow-inset-2" >
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
                    @if($search || $date_start || $date_end)
                        <button wire:click="clearInput" type="button" class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                            <i class="fal fa-times"></i>
                        </button>
                    @else
                        <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                            <i wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                        </span>
                    @endif
                </div>
                <input wire:model="date_start" id="date_start" type="text" class="form-control" aria-label="Desde" placeholder="Desde" onchange="this.dispatchEvent(new InputEvent('input'))">
                <input wire:model="date_end" id="date_end" type="text" class="form-control" aria-label="Hasta" placeholder="Hasta" onchange="this.dispatchEvent(new InputEvent('input'))">
                <input wire:keydown.enter="odtRequestsSearch" wire:model.defer="search" type="text" class="form-control border-left-0 bg-transparent" placeholder="{{__('transferservice::labels.lbl_type_here')}}">
                <div class="input-group-append">
                    <button wire:click="odtRequestsSearch" class="btn btn-default waves-effect waves-themed" type="button">@lang('transferservice::buttons.btn_search')</button>
                    <button wire:click="downloadExcel" class="btn btn-success waves-effect waves-themed" type="button">@lang('labels.excel')</button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>@lang('transferservice::labels.lbl_company')</th>
                        <th>@lang('transferservice::labels.lbl_customer')</th>
                        <th>@lang('transferservice::labels.lbl_local')</th>
                        <th>@lang('transferservice::labels.lbl_address')</th>
                        <th>@lang('transferservice::labels.lbl_reference')</th>
                        <th>@lang('transferservice::labels.lbl_supervisor')</th>
                        <th>@lang('transferservice::labels.lbl_wholesaler')</th>
                        <th>@lang('transferservice::labels.lbl_event_date')</th>
                        <th>@lang('transferservice::labels.lbl_event')</th>
                        <th>@lang('labels.code')</th>
                        <th class="text-center">{{ __('setting::labels.state') }}</th>
                    </tr>
                    </thead>
                    <tbody class="">
                        @foreach($odt_requests as $key => $odt_request)
                            <tr>
                                <td class="text-center align-middle">{{ $odt_request->internal_id }}</td>
                                <td class="align-middle">{{ $odt_request->company_name }}</td>
                                <td class="align-middle">{{ $odt_request->customer_name }}</td>
                                <td class="align-middle">{{ $odt_request->local_name }}</td>
                                <td class="align-middle">{{ $odt_request->address }}</td>
                                <td class="align-middle">{{ $odt_request->reference }}</td>
                                <td class="align-middle">{{ $odt_request->supervisor_name }}</td>
                                <td class="align-middle">{{ $odt_request->wholesaler_name }}</td>
                                <td class="align-middle text-center">{{ $odt_request->date_start }} HASTA {{ $odt_request->date_end }}</td>
                                <td class="align-middle">{{ $odt_request->description }}</td>
                                <td class="align-middle">{{ $odt_request->backus_id }}</td>
                                <td class="text-center align-middle">
                                    @if($odt_request->state)
                                        <span class="badge badge-success">{{ __('transferservice::labels.lbl_active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('transferservice::labels.lbl_inactive') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer  pb-0 d-flex flex-row align-items-center">
            <div class="ml-auto">{{ $odt_requests->links() }}</div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('livewire:load', function () {
            $('#date_start').datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                language: "es",
                autoclose: true
            });
            $('#date_end').datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                language: "es",
                autoclose: true
            });
        });
    </script>
</div>
