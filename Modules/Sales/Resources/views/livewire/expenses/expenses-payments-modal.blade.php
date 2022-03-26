<div>
    <!-- Modal -->
    <div class="modal fade" id="modalExpensesPayments" tabindex="-1" aria-labelledby="modalExpensesPaymentsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExpensesPaymentsLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">{{ __('labels.date_payment') }}</th>
                                    <th scope="col">{{ __('sales::labels.payment_methods') }}</th>
                                    <th scope="col">{{ __('sales::labels.destination') }}</th>
                                    <th scope="col">{{ __('sales::labels.reference') }}</th>
                                    <th scope="col" class="text-center">{{ __('labels.amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($payment->date_of_payment)->format('d/m/Y') }}</td>
                                        <td>{{ $payment->description }}</td>
                                        <td>
                                            @php
                                                $destination_type = \App\Models\BankAccount::class;
                                            @endphp
                                            @if($payment->destination_type == $destination_type)
                                            {{ $payment->banck_name }}
                                            @else
                                            {{ $payment->cash_name }}
                                            @endif
                                        </td>
                                        <td>{{ $payment->reference }}</td>
                                        <td class="text-right">{{ number_format($payment->payment, 2, '.', '') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right">TOTAL PAGADO</td>
                                    <td class="text-right">{{ number_format($total_payments, 2, '.', '') }}</td>
                                </tr>
                                {{-- <tr>
                                    <td colspan="5" class="text-right">TOTAL A PAGAR</td>
                                    <td class="text-right">{{ number_format($total_expenses, 2, '.', '') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">PENDIENTE DE PAGO</td>
                                    <td class="text-right">{{ number_format(($total_expenses - $total_payments), 2, '.', '')}}</td>
                                </tr> --}}
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-modal-expense-payments-1', event => {
            $('#modalExpensesPaymentsLabel').html(event.detail.title);
            $('#modalExpensesPayments').modal('show');
        });
    </script>
</div>
