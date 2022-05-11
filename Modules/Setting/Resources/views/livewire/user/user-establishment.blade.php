<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalUserEstablisment" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 wire:ignore class="modal-title" id="modalUserEstablismentLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="establishment">{{ __('labels.establishment') }}</label>
                        <select wire:model.defer="establishment_id" class="custom-select">
                            <option value="">{{ __('labels.to_select') }}</option>
                            @foreach ($establishments as $establisment)
                                <option value="{{ $establisment->id }}">{{ $establisment->name }}</option>
                            @endforeach
                        </select>
                        @error('establishment_id')
                            <div class="invalid-feedback-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" wire:model.defer="main"
                                id="defaultChecked">
                            <label class="custom-control-label" for="defaultChecked">Trabajará aquí hoy?</label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button wire:click="save" type="button"
                            class="btn btn-primary">{{ __('labels.add') }}</button>
                    </div>

                    <div class="mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('labels.actions') }}</th>
                                    <th scope="col">{{ __('labels.establishment') }}</th>
                                    <th scope="col">{{ __('labels.state') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($user_establishments) > 0)
                                    @foreach ($user_establishments as $k => $item)
                                        <tr>
                                            <td class="align-middle text-center" width="10%">
                                                <button
                                                    class="btn btn-default btn-sm btn-icon rounded-circle waves-effect waves-themed"
                                                    wire:click="delete({{ $item->id }})" type="button">
                                                    <i class="fal fa-trash-alt"></i>
                                                </button>
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <div class="custom-control custom-switch">

                                                    @if ($item->main)
                                                        <input wire:change="inactiveMain({{ $item->id }})"
                                                            {{ $item->main ? 'checked' : '' }} type="checkbox"
                                                            class="custom-control-input"
                                                            id="customSwitch2{{ $k }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch2{{ $k }}">{{ __('labels.active') }}</label>
                                                    @else
                                                        <input wire:change="activeMain({{ $item->id }})"
                                                            {{ $item->main ? 'checked' : '' }} type="checkbox"
                                                            class="custom-control-input"
                                                            id="customSwitch2{{ $k }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch2{{ $k }}">{{ __('labels.inactive') }}</label>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">No tiene establesimientos</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('labels.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-modal-user-establishment', event => {
            $('#modalUserEstablismentLabel').html(event.detail.user_name);
            $('#modalUserEstablisment').modal('show');
        });
        document.addEventListener('set-user-establishment-save', event => {
            initApp.playSound('{{ url('themes/smart-admin/media/sound') }}', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'>Éxito!</span>",
                message: "<span><strong>Excelente... </strong>" + event.detail.msg + "</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({
                'background-color': 'rgba(122, 85, 7, 0.5)'
            });
        });
    </script>
</div>
