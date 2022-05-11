<div>
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-4">
                        <label class="form-label" for="example-select">{{ __('labels.category') }}</label>
                        <div wire:ignore>
                            <input type="text" id="justAnotherInputBox" placeholder="Escriba para filtrar"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label"
                            for="example-select">{{ __('restaurant::labels.commands') }}</label>
                        <input wire:model.defer="search" type="text" class="form-control">
                    </div>
                    <div class="col-4">
                        <button onclick="searchRestCommand()" type="button"
                            class="btn btn-default waves-effect waves-themed">{{ __('labels.search') }}</button>
                        <a href="{{ route('restaurant_commands_create') }}"
                            class="btn btn-success waves-effect waves-themed" type="button">{{ __('labels.new') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-columns">
        @foreach ($commands as $command)
            <div class="card">
                @if ($command->image)
                    <img src="{{ url($command->image) }}" class="card-img-top" alt="Comanda" height="250px">
                @endif
                <div class="card-body">
                    <h4 class="card-title">{{ $command->description }}</h4>
                    <dl class="row">
                        <dt class="col-sm-4">{{ __('labels.code') }}</dt>
                        <dd class="col-sm-8">: {{ $command->internal_id }}</dd>
                        <dt class="col-sm-4">{{ __('labels.stock') }}</dt>
                        <dd class="col-sm-8">: {{ $command->stock }}</dd>
                        <dt class="col-sm-4">{{ __('labels.price') }}</dt>
                        <dd class="col-sm-8">: {{ $command->price }}</dd>
                    </dl>
                </div>
                <div class="card-body">
                    <a href="{{ route('restaurant_commands_edit', $command->id) }}"
                        class="card-link">{{ __('labels.edit') }}
                    </a>
                    <a href="#" class="card-link">{{ __('labels.delete') }}</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mb-3  pb-0 d-flex flex-row align-items-center">
        <div class="ml-auto">{{ $commands->links() }}</div>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {

            let SampleJSONData = @js($categories);

            comboTree2 = $('#justAnotherInputBox').comboTree({
                source: SampleJSONData,
                isMultiple: false,
                collapse: true,
                selectableLastNode: true,
            });

        });

        function searchRestCommand() {
            let cat = comboTree2.getSelectedIds();
            @this.set('category_id', cat);
            @this.searchCommands();
        }
    </script>
</div>
