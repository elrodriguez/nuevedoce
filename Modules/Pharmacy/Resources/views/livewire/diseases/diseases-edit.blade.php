<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="serie">@lang('labels.name') <span class="text-danger">*</span> </label>
                    <input wire:model="name" type="text" class="form-control" id="name" required="">
                    @error('name')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="number">@lang('labels.description') <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <div class="js-summernote" id="descriptionDisease"></div>
                    </div>
                    @error('description')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3" >
                    <label class="form-label" for="number">@lang('pharmacy::labels.causes') <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <div class="js-summernote" id="causesDisease"></div>
                    </div>
                    @error('causes')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">@lang('pharmacy::labels.disease') <span class="text-danger">*</span> </label>
                    <div class="custom-control custom-checkbox">
                        <input wire:model="fracture" type="checkbox" class="custom-control-input" id="fracture">
                        <label class="custom-control-label" for="fracture">{{ __('labels.yes') }}</label>
                    </div>
                    @error('disease')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer d-flex flex-row align-items-center">
            <a href="{{ route('pharmacy_administration_diseases')}}" type="button" class="btn btn-secondary waves-effect waves-themed">{{ __('labels.list') }}</a>
            <button onclick="saveDiseases()" wire:target="updateDisease" wire:loading.attr="disabled" type="button" class="btn btn-info ml-auto waves-effect waves-themed">{{ __('labels.to_update') }}</button>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('phar-diseases-save', event => {
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
        document.addEventListener('livewire:load', function () {
            $('#descriptionDisease').summernote({
                height: 200,
                tabsize: 2,
                placeholder: "{{ __('pharmacy::labels.write_here') }}",
                dialogsFade: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            $('#causesDisease').summernote({
                height: 200,
                tabsize: 2,
                placeholder: "{{ __('pharmacy::labels.write_here') }}",
                dialogsFade: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('#descriptionDisease').summernote("code", @js($description));
            $('#causesDisease').summernote("code", @js($causes));
        });

        function saveDiseases(){
            let des = $('#descriptionDisease').summernote("code");
            let cau = $('#causesDisease').summernote("code");
            
            @this.set('description',des);
            @this.set('causes',des);

            @this.updateDisease();
        }
    </script>
</div>
