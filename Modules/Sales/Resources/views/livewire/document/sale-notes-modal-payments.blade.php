<div>
    <div wire:ignore.self class="modal fade" id="modalSaleNotePayments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nota de Venta: <span id="modalSaleNotePaymentsLabel"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">{{ __('labels.actions') }}</th>
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
                                    <td class="text-center">
                                        <button onclick="confirmDelete({{ $payment->id }})" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed">
                                            <i class="fal fa-times"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($payment->date_of_payment)->format('d/m/Y') }}</td>
                                    <td>{{ $payment->description }}</td>
                                    <td>{{ $payment->cash_name ? $payment->cash_name : $payment->banck_name }}</td>
                                    <td>{{ $payment->reference }}</td>
                                    <td class="text-right">{{ number_format($payment->payment, 2, '.', '') }}</td>
                                </tr>
                            @endforeach
                            @if(!$paid)
                                <tr>
                                    <td>

                                    </td>
                                    <td class="text-center">
                                        <input wire:model.defer="date_of_payment" onchange="this.dispatchEvent(new InputEvent('input'))" class="form-control" type="text" id="inputDatePayment">
                                        @error('date_of_payment')
                                        <div class="invalid-feedback-2">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="text-center">
                                        <select wire:model.defer="method_type_id" class="custom-select form-control">
                                            @foreach ($cat_payment_method_types as $cat_payment_method_type)
                                                <option value="{{ $cat_payment_method_type->id }}">{{ $cat_payment_method_type->description }}</option>
                                            @endforeach
                                        </select>
                                        @error('method_type_id')
                                        <div class="invalid-feedback-2">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="text-center">
                                        <select wire:model.defer="destination_id" class="custom-select form-control" >
                                            @foreach ($cat_expense_method_types as $cat_expense_method_type)
                                                <option value="{{ $cat_expense_method_type['id'] }}">{{ $cat_expense_method_type['description'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('destination_id')
                                        <div class="invalid-feedback-2">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="text-center">
                                        <input wire:model.defer="reference" class="form-control" type="text">
                                        @error('reference')
                                        <div class="invalid-feedback-2">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="text-right pr-0">
                                        <input wire:model.defer="payment" class="form-control text-right" type="text">
                                        @error('payment')
                                        <div class="invalid-feedback-2">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right">TOTAL PAGADO</td>
                                <td class="text-right">{{ number_format($total_payments, 2, '.', '') }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">TOTAL A PAGAR</td>
                                <td class="text-right">{{ number_format($total_note, 2, '.', '') }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">PENDIENTE DE PAGO</td>
                                <td class="text-right">{{ number_format(($total_note - $total_payments), 2, '.', '')}}</td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                    @if(!$paid)
                        <button wire:click="storePayment" type="button" class="btn btn-primary">{{ __('labels.save') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('modal-sales-note-payments', event => {
            $('#modalSaleNotePaymentsLabel').html(event.detail.vaucher);
            $('#modalSaleNotePayments').modal('show');
        })
        document.addEventListener('livewire:load', function () {
            $("#inputDatePayment").datepicker({
                format: 'dd/mm/yyyy',
                language:"{{ app()->getLocale() }}",
                autoclose:true
            }).datepicker('setDate','0');
        });
        function confirmDelete(id){
            initApp.playSound('{{ url("themes/smart-admin/media/sound") }}', 'bigbox')
            let box = bootbox.confirm({
                title: "<i class='fal fa-times-circle text-danger mr-2'></i> ¿Desea eliminar estos datos?",
                message: "<span><strong>Advertencia: </strong> ¡Esta acción no se puede deshacer!</span>",
                centerVertical: true,
                swapButtonOrder: true,
                buttons:
                {
                    confirm:
                    {
                        label: 'Si',
                        className: 'btn-danger shadow-0'
                    },
                    cancel:
                    {
                        label: 'No',
                        className: 'btn-default'
                    }
                },
                className: "modal-alert",
                closeButton: false,
                callback: function(result)
                {
                    if(result){
                        @this.deletePayment(id)
                    }
                }
            });
            box.find('.modal-content').css({'background-color': 'rgba(255, 0, 0, 0.5)'});
        }
        document.addEventListener('actions-sales-note-payments', event => {
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
    </script>
</div>
