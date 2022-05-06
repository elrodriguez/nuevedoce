<div>
    <!-- Modal -->
    <div class="modal fade" id="modal-products-transfer" tabindex="-1" aria-labelledby="modalProductsTransferLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductsTransferLabel">Productos Trasladados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">{{ __('labels.product') }}</th>
                                <th class="text-center" scope="col">{{ __('labels.quantity') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $xtotalp = 0;
                                $c = 1;
                            @endphp
                            @foreach ($products as $product)
                                @if ($product->quantity > 0)
                                    <tr>
                                        <td class="text-center">{{ $c }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td class="text-right">{{ $product->quantity }}</td>
                                    </tr>
                                    @php
                                        $xtotalp = $xtotalp + $product->quantity;
                                        $c++;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-right" colspan="2">{{ __('labels.total') }}</th>
                                <th class="text-right">{{ number_format($xtotalp, 2, '.', '') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('labels.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-modal-products-transfer', event => {
            $('#modal-products-transfer').modal('show');
        })
    </script>
</div>
