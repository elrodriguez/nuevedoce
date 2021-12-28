<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any()?'was-validated':'' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="number">@lang('inventory::labels.lbl_number') <span class="text-danger">*</span> </label>
                        <input wire:model="number" type="text" class="form-control" id="number" disabled="">
                        @error('number')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="description">@lang('inventory::labels.description') <span class="text-danger">*</span> </label>
                        <textarea wire:model="description" type="text" class="form-control" id="description" required=""></textarea>
                        @error('description')
                        <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <table class="table m-0">
                            <thead>
                                <tr class="bg-primary-400">
                                    <th class="text-center">{{ __('labels.actions') }}</th>
                                    <th>@lang('transferservice::labels.lbl_name')</th>
                                    <th>@lang('labels.description')</th>
                                    <th>{{ __('labels.reason') }}</th>
                                    <th width="100px" class="text-center">@lang('labels.quantity')</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach($items as $k => $item)
                                <tr class="{{ $item['edit'] ? 'bg-success-100' : '' }}">
                                    <td class="text-center align-middle">
                                        <div class="custom-control custom-checkbox">
                                            <input wire:model="items.{{ $k }}.edit" type="checkbox" class="custom-control-input" id="defaultChecked{{ $k }}">
                                            <label class="custom-control-label" for="defaultChecked{{ $k }}"></label>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $item['name'] }}</td>
                                    <td>
                                        <textarea wire:model.defer="items.{{ $k }}.description" class="form-control" rows="1" {{ !$item['edit'] ? 'disabled' : '' }}></textarea>
                                        @error('items.'.$k.'.description') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                    </td>
                                    <td class="align-middle">
                                        <select wire:model.defer="items.{{ $k }}.ocurrence_type" class="custom-select" {{ !$item['edit'] ? 'disabled' : '' }}>
                                            <option value="">{{ __('labels.to_select') }}</option>
                                            @foreach ($ocurrence_types as $ocurrence_type)
                                            <option value="{{ $ocurrence_type }}">{{ $ocurrence_type }}</option>
                                            @endforeach
                                        </select>
                                        @error('items.'.$k.'.ocurrence_type') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                    </td>
                                    <td class="text-center align-middle">
                                        <input wire:model.defer="items.{{ $k }}.quantity" type="number" class="form-control text-right" {{ !$item['edit'] ? 'disabled' : '' }}>
                                        @error('items.'.$k.'.quantity') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('service_load_order_ocurrencenote',$oc_id) }}" type="button" class="btn btn-secondary waves-effect waves-themed">{{ __('labels.list') }}</a>
            <button wire:click="save" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">{{ __('labels.to_update') }}</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('ser-load-order-note-occurrence-create', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        });
        document.addEventListener('ser-load-order-note-occurrence-error', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-times-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Error!</span>",
                message: "<span><strong>Salió mal... </strong>"+event.detail.msg+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(218, 9, 22, 0.5)'});
        });
    </script>
</div>
