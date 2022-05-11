<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any() ? 'was-validated' : '' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="category_id_new">@lang('restaurant::labels.categories')
                        </label>
                        <div wire:ignore>
                            <input type="text" id="justAnotherInputBox" placeholder="Escriba para filtrar"
                                autocomplete="off" />
                        </div>
                        @error('category_id_new')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="price">@lang('labels.code') <span
                                class="text-danger">*</span> </label>
                        <input wire:model.defer="internal_id" type="text" class="form-control" id="code" required="">
                        @error('internal_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="description">@lang('labels.description') <span
                                class="text-danger">*</span> </label>
                        <input wire:model="description" type="text" class="form-control" id="description" required="">
                        @error('description')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="price">@lang('labels.price') <span
                                class="text-danger">*</span> </label>
                        <input wire:model="price" type="text" class="form-control" id="price" required="">
                        @error('price')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="price">@lang('labels.initial_stock') <span
                                class="text-danger">*</span> </label>
                        <input wire:model="stock" type="text" class="form-control" id="stock" required="">
                        @error('stock')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3"">
                        <label class="               form-label" for="inputGroupFile01">
                        {{ __('labels.image') }}
                        </label>
                        <div class="input-group">
                            <div class="custom-file" wire:ignore>
                                <input wire:model="image" type="file" class="custom-file-input" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02"
                                    aria-describedby="inputGroupFileAddon02">
                                    Elija el archivo
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">@lang('restaurant::labels.show_website')
                        </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="web_show" type="checkbox" class="custom-control-input" id="status"
                                checked="">
                            <label class="custom-control-label" for="web_show">{{ __('labels.yes') }}</label>
                        </div>
                        @error('web_show')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">@lang('restaurant::labels.includes_igv')
                        </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="has_igv" type="checkbox" class="custom-control-input" id="status"
                                checked="">
                            <label class="custom-control-label" for="has_igv">{{ __('labels.yes') }}</label>
                        </div>
                        @error('has_igv')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('restaurant_commands_list') }}" type="button"
                class="btn btn-secondary waves-effect waves-themed">{{ __('labels.list') }}</a>
            <button onclick="saveRestCommand()" wire:target="saveCommand" wire:loading.attr="disabled" type="button"
                class="btn btn-info ml-auto waves-effect waves-themed">{{ __('labels.save') }}</button>
        </div>
    </div>
    <script type="text/javascript">
        var comboTree2 = null;
        document.addEventListener('set-command-save', event => {
            initApp.playSound('{{ url('themes/smart-admin/media/sound') }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='{{ env('BOOTBOX_SUCCESS_ICON') }} text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>" + event.detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });

            box.find('.modal-content').css({
                'background-color': "{{ env('BOOTBOX_SUCCESS_COLOR') }}"
            });

        });

        document.addEventListener('livewire:load', function() {

            let SampleJSONData = @js($categories);
            let CategoryIds = @js($category_id_old);

            comboTree2 = $('#justAnotherInputBox').comboTree({
                source: SampleJSONData,
                isMultiple: true,
                cascadeSelect: true,
                collapse: false,
                selected: CategoryIds
            });

        });

        function saveRestCommand() {
            let cat = comboTree2.getSelectedIds();
            @this.set('category_id_new', cat);
            @this.saveCommand();
        }
    </script>
</div>
