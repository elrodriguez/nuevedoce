<div>
    <div class="modal" tabindex="-1" id="create-parameters-edit" wire:ignore.self >
        <form class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('labels.edit') @lang('labels.parameter')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="example-select">@lang('labels.type')</label>
                                <select wire:model.defer="id_type" class="form-control" id="example-select" wire:change="changeType()">
                                    <option value="">Seleccionar</option>
                                    @foreach($types as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('id_type'))
                                    <div class="invalid-feedback-2">{{ $errors->first('id_type') }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="parameter">@lang('labels.parameter')</label>
                                <input type="text" wire:model.defer="id_parameter" class="form-control" id="parameter" disabled>
                            </div>
                            @if($errors->has('id_parameter'))
                                <div class="invalid-feedback-2">{{ $errors->first('id_parameter') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label" for="value_default_1">@lang('labels.value_default')</label>
                        @if($id_type == 8)
                            <textarea wire:model.defer="value_default" class="form-control" id="value_default_1" maxlength="255"></textarea>
                            @if($errors->has('value_default'))
                                <div class="invalid-feedback-2">{{ $errors->first('value_default') }}</div>
                            @enderror
                        @else
                            <input type="text" wire:model.defer="value_default" class="form-control" id="value_default_1">
                            @if($errors->has('value_default'))
                                <div class="invalid-feedback-2">{{ $errors->first('value_default') }}</div>
                            @enderror
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="description">@lang('labels.description')</label>
                        <textarea type="text" wire:model.defer="description" class="form-control" id="description"></textarea>
                        @if($errors->has('description'))
                            <div class="invalid-feedback-2">{{ $errors->first('description') }}</div>
                        @enderror
                    </div>
                    @if($display)
                        <div class="form-group">
                            <label class="form-label" for="code_sql">@lang('labels.value_array_sql')</label>
                            <textarea type="text" wire:model.defer="code_sql" class="form-control mb-2" id="code_sql"></textarea>
                            @if($id_type == 2 || $id_type == 5 || $id_type == 6)
                            Ejemplo: <code class="mb-2">1,text1|2,text2|3,text3</code>
                            @elseif($id_type == 3 || $id_type == 7)
                            Ejemplo: <code>SELECT id,description FROM My_Table</code>
                            @elseif($id_type == 4)
                            Ejemplo: <code class="mb-2">1,text1|2,text2</code>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.cancel')</button>
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click="update">@lang('labels.to_update')</button>
                </div>
            </div>
        </form>
    </div>
    <script defer>
        window.addEventListener('message-confir-modal-paramter-edit', event => {
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>"+event.detail.message+"</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
            $('#create-parameters').modal('hide');
        });
        window.addEventListener('open-modal-paramter-edit', event => {
            $('#create-parameters-edit').modal('show');
        });
    </script>
</div>
