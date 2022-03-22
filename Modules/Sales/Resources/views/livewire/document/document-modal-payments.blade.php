<div>
    <div class="modal fade" id="modalDocumentPayments" tabindex="-1" aria-labelledby="modalPaymentsLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pagos del comprobante: <span id="modalDocumentePaymentsLabel" wire:ignore></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <tr >
                            <th scope="col" class="border-top-0">#</th>
                            <th scope="col" class="border-top-0">Fecha de pago</th>
                            <th scope="col" class="border-top-0">Método de pago</th>
                            <th scope="col" class="border-top-0">Destino</th>
                            <th scope="col" class="border-top-0">Referencia</th>
                            <th scope="col" class="border-top-0">Monto</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $key => $payment)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ \Carbon\Carbon::parse($payment->date_of_payment)->format('d/m/Y') }}</td>
                                <td>{{ $payment->description }}</td>
                                <td>
                                    @if($payment->user_id)
                                    {{ 'CAJA CHICA'.($payment->reference_number?' - '.$payment->reference_number:'') }}
                                    @else
                                    {{ $payment->bank_name.' - '.$payment->back_account_description }}
                                    @endif
                                </td>
                                <td>{{ $payment->reference }}</td>
                                <td>{{ $payment->payment }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('modal-sales-vaucher-payments', event => {
            $('#modalDocumentePaymentsLabel').html(event.detail.vaucher);
            $('#modalDocumentPayments').modal('show');
        });
    </script>
</div>