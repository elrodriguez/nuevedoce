<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <form class="needs-validation {{ $errors->any() ? 'was-validated' : '' }}" novalidate="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="category_id">@lang('restaurant::labels.categories') </label>
                        <div wire:ignore>
                            <input type="text" id="justAnotherInputBox" placeholder="Escriba para filtrar"
                                autocomplete="off" />
                        </div>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="description">@lang('labels.description') <span
                                class="text-danger">*</span> </label>
                        <input wire:model="description" type="text" class="form-control" id="description" required="">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">@lang('labels.state') <span class="text-danger">*</span>
                        </label>
                        <div class="custom-control custom-checkbox">
                            <input wire:model="status" type="checkbox" class="custom-control-input" id="status"
                                checked="">
                            <label class="custom-control-label" for="status">Activo</label>
                        </div>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('restaurant_categories_list') }}" type="button"
                class="btn btn-secondary waves-effect waves-themed">{{ __('labels.list') }}</a>
            <button onclick="saveRestCategories()" wire:target="saveCategories" wire:loading.attr="disabled"
                type="button" class="btn btn-info ml-auto waves-effect waves-themed">{{ __('labels.save') }}</button>
        </div>
    </div>
    <script type="text/javascript">
        var comboTree2 = null;
        document.addEventListener('set-category-save', event => {
            initApp.playSound('{{ url('themes/smart-admin/media/sound') }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='{{ env('BOOTBOX_SUCCESS_ICON') }} text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>" + event.detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false,
                callback: function() {
                    location.reload();
                }
            });

            box.find('.modal-content').css({
                'background-color': "{{ env('BOOTBOX_SUCCESS_COLOR') }}"
            });

        });

        document.addEventListener('livewire:load', function() {

            let SampleJSONData = @js($categories);

            comboTree2 = $('#justAnotherInputBox').comboTree({
                source: SampleJSONData,
                isMultiple: false,
                collapse: true,
                selectableLastNode: true,
            });

        });

        function saveRestCategories() {
            let cat = comboTree2.getSelectedIds();
            @this.set('category_id', cat);
            @this.saveCategories();
        }
    </script>
</div>
