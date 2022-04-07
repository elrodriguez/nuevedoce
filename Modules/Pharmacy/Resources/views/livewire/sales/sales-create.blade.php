<div>
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card mb-3" wire:ignore>
                <div class="card-header">
                    {{ __('labels.categories') }}
                </div>
                <div class="card-body">
                    <select class="" id="selectCategories" onclick="selectCatagories(event)">
                        <option value="">{{ __('labels.all') }}</option>
                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->description }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="card" wire:ignore>
                <div class="card-header">
                    {{ __('labels.brands') }}
                </div>
                <div class="card-body">
                    <select class="" id="selectBrands" onclick="selectBrands(event)">
                        <option value="">{{ __('labels.all') }}</option>
                        @if(count($brands) > 0)
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->description }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="input-group input-group-lg mb-3 shadow-1 rounded">
                <input wire:model.defer="search" wire:keydown.enter="searchProducts" type="text" class="form-control shadow-inset-2" id="filter-icon" aria-label="type 2 or more letters" placeholder="{{ __('labels.search') }} {{ __('labels.product') }}...">
                <div wire:click="searchProducts" class="input-group-append">
                    <button class="btn btn-primary hidden-sm-down waves-effect waves-themed" type="button"><i class="fal fa-search mr-lg-2"></i><span class="hidden-md-down">{{ __('labels.search') }}</span></button>
                </div>
            </div>
            @if(count($products) > 0)
                <div class="card">
                    <ul class="list-group list-group-flush">
                        @foreach($products as $product)
                            <li class="list-group-item py-4 px-4">
                                <div class="media">
                                    <a wire:click="clickAddItem({{ $product['id'] }})" href="javascript:void(0)" class="mr-2">
                                        @if($product['image'])
                                            @if(file_exists(public_path($product['image'])))
                                                <img src="{{ url($product['image']) }}" alt="producto" width="64">
                                            @else
                                                <img src="{{ ui_avatars_url($product['name'],64,'none',false) }}" alt="producto">
                                            @endif
                                        @else
                                            <img src="{{ ui_avatars_url($product['name'],64,'none',false) }}" alt="producto">
                                        @endif
                                    </a>
                                    <div class="media-body">
                                        <a wire:click="clickAddItem({{ $product['id'] }})" href="javascript:void(0)"><h5 class="mt-0">{{ $product['name'] }}</h5></a>
                                        <p class="text-info">
                                           <b>{{ __('labels.code') }}: </b>{{ $product['patrimonial_code'] }} - <b>{{ __('labels.price') }}: </b>{{ $product['sale_price'] }} - <b>{{ __('labels.stock') }}: </b>{{ $product['stock'] }} - <b>{{ __('labels.brand') }}: </b>{{ $product['description'] }} 
                                        </p>
                                        @if(count($product['related'])>0)
                                            @foreach ($product['related'] as $k => $item)
                                            <div class="media mt-3">
                                                <a wire:click="clickAddItem({{ $item['id'] }})" href="javascript:void(0)" class="mr-2">
                                                    @if($item['image'])
                                                        @if(file_exists(public_path($item['image'])))
                                                            <img src="{{ url($item['image']) }}" alt="producto" width="64">
                                                        @else
                                                            <img src="{{ ui_avatars_url($item['name'],64,'none',false) }}" alt="producto">
                                                        @endif
                                                    @else
                                                        <img src="{{ ui_avatars_url($item['name'],64,'none',false) }}" alt="producto">
                                                    @endif
                                                </a>
                                                <div class="media-body">
                                                    <a wire:click="clickAddItem({{ $item['id'] }})" href="javascript:void(0)">
                                                        <h5 class="mt-0">{{ $item['name'] }}</h5>
                                                    </a>
                                                    <p class="text-info"><b>{{ __('labels.code') }}: </b>{{ $item['patrimonial_code'] }} - <b>{{ __('labels.price') }}: </b>{{ $item['sale_price'] }} - <b>{{ __('labels.stock') }}: </b>{{ $item['stock'] }} - <b>{{ __('labels.brand') }}: </b>{{ $item['description'] }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-12 col-md-4">
            <div class="card border mb-g sticky-top" >
                <!-- notice the additions of utility paddings and display properties on .card-header -->
                <div class="card-header bg-danger-700 pr-3 d-flex align-items-center flex-wrap">
                    <!-- we wrap header title inside a div tag with utility padding -->
                    <div>TOTAL A PAGAR</div>
                    <div class="card-title ml-auto">
                        {{ number_format($total, 2, '.', '') }}
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-sm">
                            <thead class="bg-info-900">
                                <tr>
                                    <th class="text-center"></th>
                                    <th>{{ __('labels.description') }}</th>
                                    <th class="text-center">{{ __('labels.price') }}</th>
                                    <th class="text-center">{{ __('labels.quantity') }}</th>
                                    <th class="text-center">{{ __('labels.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($box_items)>0)
                                    @foreach ($box_items as $key => $box_item)
                                    <tr>
                                        <td class="align-middle text-center" width="10%">
                                            <a href="javascript:void(0);" class="btn btn-dark btn-xs btn-icon waves-effect waves-themed" wire:click="removeItem({{ $key }})">
                                                <i class="fal fa-times"></i>
                                            </a>
                                        </td>
                                        <td width="50%" class="align-middle">{{ json_decode($box_item['item'])->name }}</td>
                                        <td class="align-middle text-right">{{ $box_item['input_unit_price_value'] }}</td>
                                        <td width="10%" class="align-middle text-center">
                                            @if (json_decode($box_item['item'])->item_type_id== '01')
                                                <input type="text" wire:model="box_items.{{ $key }}.quantity" class="form-control text-right form-control-sm" name="box_items[{{ $key }}].quantity">
                                                @error('box_items.'.$key.'.quantity')
                                                <div class="invalid-feedback-2">{{ $message }}</div>
                                                @enderror
                                            @else
                                                <i class="fal fa-times"></i>
                                            @endif
                                        </td>
                                        <td class="align-middle text-right pr-3">{{ number_format($box_item['total'], 2, '.', '') }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="dataTables_empty text-center" valign="top">{{ __('labels.no_records_to_display') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card-footer bg-danger-700">
                    <button {{ count($box_items)>0 ? '' : 'disabled' }} type="button" class="btn btn-default" data-toggle="modal" data-target="#modalPharmacyPaymentsClient"><i class="fal fa-donate mr-1"></i> Pagar</button>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Modal Right -->
    <div wire:ignore.self id="modalPharmacyPaymentsClient" class="modal fade default-example-modal-right" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Datos del Comprobante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="btn-group mb-3">
                        @foreach ($document_types as $document_type)
                            <button wire:click="$set('document_type_id', {{ $document_type->id }})" type="button" class="btn btn-outline-secondary waves-effect waves-themed {{ $document_type->id == $document_type_id ? 'active' : '' }}">{{ $document_type->description }}</button>
                        @endforeach
                    </div>
                    <div class="card border mb-g">
                        <!-- notice the additions of utility paddings and display properties on .card-header -->
                        <div class="card-header bg-danger-700 pr-3 d-flex align-items-center flex-wrap">
                            <!-- we wrap header title inside a div tag with utility padding -->
                            <div class="card-title">
                                Métodos de pago
                            </div>
                            <button wire:click="newPaymentMethodTypes" type="button" class="btn btn-xs btn-info ml-auto waves-effect waves-themed">
                                {{ __('labels.add') }}
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <table class="table m-0 table-sm table-striped">
                                <thead class="bg-info-900">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>{{ __('labels.type') }}</th>
                                        <th class="text-center">Destino</th>
                                        <th class="text-center">Referencia</th>
                                        <th class="text-center">Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($payment_method_types)>0)
                                    @foreach ($payment_method_types as $key => $payment_method_type)
                                        <tr>
                                            <td class="text-center align-middle">
                                                @if ($key > 0)
                                                <a href="javascript:void(0);" class="btn btn-dark btn-xs btn-icon waves-effect waves-themed" wire:click="removePaymentMethodTypes('{{ $key }}')">
                                                    <i class="fal fa-times"></i>
                                                </a>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <div wire:ignore.self>
                                                    <select class="custom-select form-control" wire:model.defer="payment_method_types.{{ $key }}.method">
                                                        @foreach ($cat_payment_method_types as $cat_payment_method_type)
                                                            <option value="{{ $cat_payment_method_type->id }}">{{ $cat_payment_method_type->description }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div wire:ignore.self>
                                                    <select class="custom-select form-control" wire:model.defer="payment_method_types.{{ $key }}.destination">
                                                        @foreach ($cat_expense_method_types as $cat_expense_method_type)
                                                            <option value="{{ $cat_expense_method_type['id'] }}">{{ $cat_expense_method_type['description'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class="form-control" wire:model.defer="payment_method_types.{{ $key }}.reference">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class="form-control text-right" wire:model.defer="payment_method_types.{{ $key }}.amount">
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="dataTables_empty text-center" valign="top">{{ __('labels.no_records_to_display') }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="input-group" wire:ignore>
                                <input class="form-control basicAutoComplete" type="text" placeholder="@lang('labels.search_customer')" data-url="{{ route('pharmacy_customers_search') }}" autocomplete="off" />
                                <div class="input-group-append">
                                    <button class="btn btn-outline-default waves-effect waves-themed" type="button" data-toggle="modal" data-target="#exampleModalClientNew">{{ __('labels.new') }}</button>
                                </div>
                            </div>
                            @error('customer_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fal fa-times-circle mr-1"></i>
                        {{ __('labels.cancel') }}
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="fal fa-donate mr-1"></i>
                        <span class="mr-5">PAGAR</span>
                        <span>{{ $total }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalClientNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('labels.new') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-4 mb-3"f>
                            <label class="form-label" for="identity_document_type_id">Tipo Doc. Identidad <span class="text-danger">*</span> </label>
                            <select class="custom-select form-control" wire:model="identity_document_type_id">
                                @foreach ($identity_document_types as $identity_document_type)
                                    <option value="{{ $identity_document_type->id }}">{{ $identity_document_type->description }}</option>
                                @endforeach
                            </select>
                            @error('identity_document_type_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="number_id">{{ __('labels.number') }} <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="number_id" wire:model.defer="number_id">
                            @error('number_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">{{ __('labels.name') }} <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="name" wire:model.defer="name">
                            @error('name')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="last_paternal">{{ __('labels.last_paternal') }} <span class="text-danger">*</span> </label>
                            <input {{ $identity_document_type_id == '6' ? 'disabled': '' }} type="text" class="form-control" name="last_paternal" wire:model.defer="last_paternal">
                            @error('last_paternal')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="last_maternal">{{ __('labels.last_maternal') }} <span class="text-danger">*</span> </label>
                            <input {{ $identity_document_type_id == '6' ? 'disabled': '' }} type="text" class="form-control" name="last_maternal" wire:model.defer="last_maternal">
                            @error('last_maternal')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3" wire:ignore.self>
                            <label class="form-label" for="trade_name">{{ __('labels.trade_name') }}</label>
                            <input type="text" class="form-control" name="trade_name" wire:model.defer="trade_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="department_id">@lang('setting::labels.department') <span class="text-danger">*</span> </label>
                            <select wire:change="getProvinves" wire:model="department_id" id="department_id" class="custom-select" required="">
                                <option value="">Seleccionar</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->description }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="province_id">@lang('setting::labels.province') <span class="text-danger">*</span> </label>
                            <select wire:change="getPDistricts" wire:model="province_id" id="province_id" class="custom-select" required="">
                                <option value="">Seleccionar</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->description }}</option>
                                @endforeach
                            </select>
                            @error('province_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="district_id">@lang('setting::labels.district') <span class="text-danger">*</span> </label>
                            <select wire:model="district_id" id="district_id" class="custom-select" required="">
                                <option value="">Seleccionar</option>
                                @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->description }}</option>
                                @endforeach
                            </select>
                            @error('district_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="sex">@lang('labels.sex')</label>
                            <select class="custom-select form-control" wire:model.defer="sex" id="sex" name="sex" required="">
                                <option>@lang('labels.to_select')</option>
                                <option value="m">Masculino</option>
                                <option value="f">Femenino</option>
                            </select>
                            @error('sex')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                    <button type="button" class="btn btn-primary" wire:click="storeClient">{{ __('labels.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            let xbody = document.querySelector('body');
            xbody.classList.contains('nav-function-minify');
            xbody.classList.add('nav-function-minify');

            $('#selectCategories').select2();
            $('#selectBrands').select2();

            $('.basicAutoComplete').autoComplete().on('autocomplete.select', function (evt, item) {
                selectCustomer(item.value);
            });

            $('.basicAutoComplete').autoComplete('set', { value: "{{ $xgenerico->value }}", text: "{{ $xgenerico->text }}" });
        });
        function selectCustomer(val){
            @this.set('customer_id', val);
        }
        function selectBrands(event){
            let br = event.target.value;
            @this.set('brand_id',br);
        }
        function selectCatagories(event){
            let ct = event.target.value;
            @this.set('category_id',ct);
        }
        function swalAlert(msg){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>¡Enhorabuena!</span>",
                message: "<span><strong>{{__('labels.lbl_excellent')}}... </strong>"+msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        }
        window.addEventListener('response_clear_select_products_alert', event => {
            let showmsg = event.detail.showmsg;
            if(showmsg == true){
                swalAlert(event.detail.message)
            }
        });
        window.addEventListener('response_success_customer_store', event => {
           swalAlert(event.detail.message);
           setAutocomplet(event.detail.idperson,event.detail.nameperson);
        });
        function setAutocomplet(id,title){
            $('.basicAutoComplete').autoComplete('set', { value: id, text: title });
            $('#exampleModalClientNew').modal('hide');
            @this.set('customer_id', id);
        }
    </script>
</div>
