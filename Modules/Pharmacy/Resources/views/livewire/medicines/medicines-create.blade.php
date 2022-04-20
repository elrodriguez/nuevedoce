<div>
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="product_id">@lang('labels.products') <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <input data-url="{{ route('pharmacy_products_search') }}" class="form-control" id="product_id" type="text" placeholder="Buscar producto" autocomplete="off" />
                    </div>
                    @error('product_id')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="disease_id">@lang('pharmacy::labels.diseases') <span class="text-danger">*</span> </label>
                    <div wire:ignore>
                        <input data-url="{{ route('pharmacy_diseases_search') }}" type="text" class="form-control" id="disease_id" placeholder="Buscar enfermedad" autocomplete="off" >
                    </div>
                    @error('disease_id')
                    <div class="invalid-feedback-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('labels.description') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($symptoms)>0)
                                @foreach ($symptoms as $symptom)
                                    <tr>
                                        <td>{{ $k }}</td>
                                        <td>{{ $symptom->description }}</td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="2" class="text-center"></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            $('#product_id').autoComplete().on('autocomplete.select', function (evt, item) {
                selectProductId(item.value);
            });
            $('#disease_id').autoComplete().on('autocomplete.select', function (evt, item) {
                selectDiseaseId(item.value);
            });
        });
        function selectProductId(id){
            @this.set('product_id',id);
            //$('#product_id').autoComplete('clear');
        }
        function selectDiseaseId(id){
            @this.set('disease_id',id);
        }
    </script>
</div>
