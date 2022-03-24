<div>
    <div class="px-3 px-sm-5 pt-4">
        <div class="input-group input-group-lg mb-5 shadow-1 rounded">
            <div class="input-group-prepend">
                @if($search)
                    <button wire:click="$set('search', '')" type="button" class="input-group-text bg-transparent border-right-0 py-1 px-3 text-danger">
                        <i class="fal fa-times"></i>
                    </button>
                @else
                    <span class="input-group-text bg-transparent border-right-0 py-1 px-3 text-success">
                        <i wire:target="resetPage" wire:loading.class="spinner-border spinner-border-sm" wire:loading.remove.class="fal fa-search" class="fal fa-search"></i>
                    </span>
                @endif
            </div>
            <input type="text" class="form-control shadow-inset-2" wire:model.defer="search" id="filter-icon" aria-label="type 2 or more letters" >
            <div class="input-group-append">
                <button class="btn btn-primary hidden-sm-down" type="button" wire:click="resetPage" ><i class="fal fa-search mr-lg-2"></i><span class="hidden-md-down">@lang('labels.search')</span></button>
                <button class="btn btn-success hidden-sm-down" type="button" wire:click="$emit('openModelParameterCreate')"><i class="fal fa-plus mr-lg-2"></i><span class="hidden-md-down">@lang('labels.new')</span></button>
            </div>
        </div>
    </div>
    <div class="px-3 px-sm-5 pb-4">
        <div class="card">
            <ul class="list-group list-group-flush">
                @if(count($parameters) > 0)
                @foreach ($parameters as $key => $item)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label class="form-label"><code>{{ $item->id_parameter }}</code> {{ $item->description }}</label>
                                <div class="d-flex flex-row align-items-center">
                                    @if($item->type == 1)
                                        <div class="mr-3">
                                            <input type="text" class="form-control col-4" wire:model.defer="value_default.{{ $key }}">
                                        </div>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed" id="btnsaveparameters{{ $key }}" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('{{ $item->id }}','{{ $key }}')"><i class="fal fa-check"></i></button>
                                    @elseif($item->type == 2)
                                        @php
                                            $arrs = explode('|',$item->code_sql);
                                        @endphp
                                        <div wire:ignore class="col-4 p-0">
                                            <select class="custom-select form-control" wire:model.defer="value_default.{{ $key }}">
                                                @foreach ($arrs as $arr)
                                                    @php
                                                        list($index,$text) = explode(',',$arr);
                                                    @endphp
                                                <option value="{{ $index }}">{{ $text }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed mt-3" id="btnsaveparameters{{ $key }}" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('{{ $item->id }}','{{ $key }}')"><i class="fal fa-check"></i></button>
                                    @elseif($item->type == 3)
                                        @php
                                            try {
                                                $arrs = \Illuminate\Support\Facades\DB::select($item->code_sql);
                                                $msg_mysql = null;
                                            } catch (\Illuminate\Database\QueryException $e) {
                                                $msg_mysql = $e->getMessage();
                                                $arrs = [];
                                            }
                                        @endphp
                                        
                                        @if(count($arrs)>0)
                                            <div wire:ignore class="col-4 p-0">
                                                <select class="custom-select form-control" wire:model.defer="value_default.{{ $key }}">
                                                    @foreach ($arrs as $arr)
                                                    <option value="{{ $arr->id }}">{{ $arr->description }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed mt-3" id="btnsaveparameters{{ $key }}" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('{{ $item->id }}','{{ $key }}')"><i class="fal fa-check"></i></button>
                                        @else
                                            <div wire:ignore class="col-12 p-0">
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $msg_mysql }}
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($item->type == 4)
                                        @php
                                            $arrs = explode('|',$item->code_sql);
                                        @endphp
                                        <div class="demo" wire:ignore>
                                            @foreach ($arrs as $arr)
                                                @php
                                                    list($index,$text) = explode(',',$arr);
                                                @endphp
                                                <div class="custom-control custom-radio">
                                                    <input wire:model.defer="value_default.{{ $key }}" type="radio" class="custom-control-input" id="radio{{ $key.$index}}" name="radio{{ $key.$item->type }}" value="{{ $index }}">
                                                    <label class="custom-control-label" for="radio{{ $key.$index}}">{{ $text }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed mt-3" id="btnsaveparameters{{ $key }}" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('{{ $item->id }}','{{ $key }}')"><i class="fal fa-check"></i></button>
                                    @elseif($item->type == 5)
                                        @php
                                            $arrs_k = explode('|',$item->code_sql);
                                        @endphp
                                        <div class="demo mr-3" wire:ignore>
                                            @foreach ($arrs_k as $k => $arr)
                                                @php
                                                    list($index,$text) = explode(',',$arr);
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked{{ $key.$k.$index }}" wire:model.defer="value_default.{{ $key }}" value="{{ $index }}">
                                                    <label class="custom-control-label" for="defaultUnchecked{{ $key.$k.$index }}">{{ $text }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed mt-3" id="btnsaveparameters{{ $key }}" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('{{ $item->id }}','{{ $key }}')"><i class="fal fa-check"></i></button>
                                    @elseif($item->type == 6)
                                        <div class="demo">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                                                <label class="custom-control-label" for="defaultUnchecked">Unchecked</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="defaultChecked" checked="">
                                                <label class="custom-control-label" for="defaultChecked">Checked</label>
                                            </div>
                                        </div>
                                    @elseif($item->type == 7)
                                        <div class="demo">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                                                <label class="custom-control-label" for="defaultUnchecked">Unchecked</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="defaultChecked" checked="">
                                                <label class="custom-control-label" for="defaultChecked">Checked</label>
                                            </div>
                                        </div>
                                    @elseif($item->type == 8)
                                        <textarea class="form-control mr-3" wire:model.defer="value_default.{{ $key }}"></textarea>
                                        <button class="btn btn-primary btn-sm ml-auto waves-effect waves-themed" id="btnsaveparameters{{ $key }}" type="button" wire:loading.attr="disabled" wire:click="changeValueDefaultSave('{{ $item->id }}','{{ $key }}')"><i class="fal fa-check"></i></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <span onclick="confirmDelete({{ $item->id }})" style="cursor: pointer;" class="badge badge-danger badge-pill float-right">@lang('labels.delete')</span>
                            <span wire:click="$emit('openModelParameterEdit',{{ $item->id }})" style="cursor: pointer;" class="badge badge-primary badge-pill float-right mr-1">@lang('labels.edit')</span>
                        </div>
                    </div>
                </li>
                @endforeach
                @else
                <li class="list-group-item">
                    <div class="alert alert-info text-center" role="alert">
                        {{ __('labels.no_records_to_display') }}
                    </div>
                </li>
                @endif
            </ul>
            <div class="card-footer">
                {{ $parameters->links() }}
            </div>
        </div>

    </div>
    <script>
        window.addEventListener('response_parameter_value_default_update', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.message+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });

        function confirmDelete(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> ¿Desea eliminar estos datos?",
                message: "<span><strong>Advertencia: </strong> ¡Esta acción no se puede deshacer!</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                {
                    confirm:
                    {
                        label: 'Si',
                        className: 'btn-danger shadow-0'
                    },
                    cancel:
                    {
                        label: 'No',
                        className: 'btn-default'
                    }
                },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        @this.deleteparameter(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }

        document.addEventListener('set-parameter-delete', event => {
            let res = event.detail.res;
            if(res == 'success'){
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
                let box = bootbox.alert({
                    title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('inventory::labels.success') }}!</span>",
                    message: "<span><strong>{{ __('inventory::labels.excellent') }}... </strong>{{ __('inventory::labels.msg_delete') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            }else{
                initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_off')
                let box = bootbox.alert({
                    title: "<i class='fal fa-times-hexagon text-warning mr-2'></i> <span class='text-warning fw-500'>{{ __('setting::labels.error') }}!</span>",
                    message: "<span><strong>{{ __('setting::labels.went_wrong') }}... </strong>{{ __('setting::labels.msg_not_peptra') }}</span>",
                    centerVertical: true,
                    className: "modal-alert",
                    closeButton: false
                });
                box.find('.modal-content').css({'background-color': 'rgba(214, 36, 16, 0.5)'});
            }
        });
    </script>
</div>
