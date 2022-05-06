<?php
$establishment = \Modules\Setting\Entities\SetEstablishment::find($document->establishment_id);
$accounts = \App\Models\BankAccount::all();
$documentType = \App\Models\DocumentType::find($document->document_type_id);
$district = \Illuminate\Support\Facades\DB::table('districts')
    ->where('id', $establishment->district_id)
    ->first();
$province = \Illuminate\Support\Facades\DB::table('provinces')
    ->where('id', $establishment->province_id)
    ->first();
$department = \Illuminate\Support\Facades\DB::table('departments')
    ->where('id', $establishment->department_id)
    ->first();
//dd($district);
$customer = json_decode($document->customer);
$identity_document_type = \App\Models\IdentityDocumentType::find($customer->identity_document_type_id);
$customer_district = \Illuminate\Support\Facades\DB::table('districts')
    ->where('id', $customer->district_id)
    ->first();
$customer_province = \Illuminate\Support\Facades\DB::table('provinces')
    ->where('id', $customer->province_id)
    ->first();
$customer_department = \Illuminate\Support\Facades\DB::table('departments')
    ->where('id', $customer->department_id)
    ->first();

$currency_type = \App\Models\CurrencyType::find($document->currency_type_id);
$user = \App\Models\User::find($document->user_id);

$invoice = $document->invoice;

$document_number = $document->series . '-' . str_pad($document->number, 8, '0', STR_PAD_LEFT);
$accounts = \App\Models\BankAccount::all();
$document_base = $document->note ? $document->note : null;
$payments = $document->payments;
$document_items = \Modules\Sales\Entities\SalDocumentItem::where('document_id', $document->id)->get();

if ($document_base) {
    $affected_document_number = $document_base->affected_document ? $document_base->affected_document->series . '-' . str_pad($document_base->affected_document->number, 8, '0', STR_PAD_LEFT) : $document_base->data_affected_document->series . '-' . str_pad($document_base->data_affected_document->number, 8, '0', STR_PAD_LEFT);
} else {
    $affected_document_number = null;
}
//$document->load('reference_guides');
$payments = \Modules\Sales\Entities\SalDocumentPayment::join('cat_payment_method_types', 'sal_document_payments.payment_method_type_id', 'cat_payment_method_types.id')
    ->select('sal_document_payments.*', 'cat_payment_method_types.description')
    ->where('document_id', $document->id)
    ->get();
$total_payment = $payments->sum('payment');
$balance = $document->total - $total_payment - $payments->sum('change');

?>
<html>

<head>
    
    
</head>

<body>

    <?php if($company->logo): ?>
        <div class="text-center company_logo_box pt-5">
            <img src="data:<?php echo e(mime_content_type(public_path("storage/{$company->logo}"))); ?>;base64, <?php echo e(base64_encode(file_get_contents(public_path("storage/{$company->logo}")))); ?>"
                alt="<?php echo e($company->name); ?>" class="company_logo_ticket contain">
        </div>
        
        
        
        
    <?php endif; ?>

    <?php if($document->state_type_id == '11'): ?>
        <div class="company_logo_box" style="position: absolute; text-align: center; top:500px">
            <img src="data:<?php echo e(mime_content_type(public_path('status_images' . DIRECTORY_SEPARATOR . 'anulado.png'))); ?>;base64, <?php echo e(base64_encode(file_get_contents(public_path('status_images' . DIRECTORY_SEPARATOR . 'anulado.png')))); ?>"
                alt="anulado" class="" style="opacity: 0.6;">
        </div>
    <?php endif; ?>
    <table class="full-width">
        <tr>
            <td class="text-center">
                <h4><?php echo e($company->name); ?></h4>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5><?php echo e($company->trade_name); ?></h5>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5><?php echo e('RUC ' . $company->number); ?></h5>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <?php echo e($establishment->address); ?>

                <?php echo e(', ' . $district->description); ?>

                <?php echo e(', ' . $province->description); ?>

                <?php echo e('- ' . $department->description); ?>

            </td>
        </tr>

        <?php if(isset($establishment->trade_address)): ?>
            <tr>
                <td class="text-center ">
                    <?php echo e($establishment->trade_address !== '-' ? 'D. Comercial: ' . $establishment->trade_address : ''); ?>

                </td>
            </tr>
        <?php endif; ?>
        <tr>
            <td class="text-center ">
                <?php echo e($establishment->telephone !== '-' ? 'Central telefónica: ' . $establishment->telephone : ''); ?></td>
        </tr>
        <tr>
            <td class="text-center"><?php echo e($establishment->email !== '-' ? 'Email: ' . $establishment->email : ''); ?>

            </td>
        </tr>
        <?php if(isset($establishment->web_address)): ?>
            <tr>
                <td class="text-center">
                    <?php echo e($establishment->web_address !== '-' ? 'Web: ' . $establishment->web_address : ''); ?></td>
            </tr>
        <?php endif; ?>

        <?php if(isset($establishment->aditional_information)): ?>
            <tr>
                <td class="text-center pb-3">
                    <?php echo e($establishment->aditional_information !== '-' ? $establishment->aditional_information : ''); ?>

                </td>
            </tr>
        <?php endif; ?>

        <tr>
            <td class="text-center pt-3 border-top">
                <h4><?php echo e($documentType->description); ?></h4>
            </td>
        </tr>
        <tr>
            <td class="text-center pb-3 border-bottom">
                <h3><?php echo e($document_number); ?></h3>
            </td>
        </tr>
    </table>
    <table class="full-width">
        <tr>
            <td width="" class="pt-3">
                <p class="desc">F. Emisión:</p>
            </td>
            <td width="" class="pt-3">
                <p class="desc"><?php echo e($document->date_of_issue); ?></p>
            </td>
        </tr>
        <tr>
            <td width="">
                <p class="desc">H. Emisión:</p>
            </td>
            <td width="">
                <p class="desc"><?php echo e($document->time_of_issue); ?></p>
            </td>
        </tr>
        <?php if(isset($invoice)): ?>
            <?php $__currentLoopData = $invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item->date_of_due != $document->date_of_issue): ?>
                    <tr>
                        <td>
                            <p class="desc">F. Vencimiento:</p>
                        </td>
                        <td>
                            <p class="desc"><?php echo e($item->date_of_due); ?></p>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <tr>
            <td class="align-top">
                <p class="desc">Cliente:</p>
            </td>
            <td>
                <p class="desc"><?php echo e($customer->full_name); ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="desc"><?php echo e($identity_document_type->description); ?>:</p>
            </td>
            <td>
                <p class="desc"><?php echo e($customer->number); ?></p>
            </td>
        </tr>
        <?php if($customer->address !== ''): ?>
            <tr>
                <td class="align-top">
                    <p class="desc">Dirección:</p>
                </td>
                <td>
                    <p class="desc">
                        <?php echo e($customer->address); ?>

                        <?php if($customer_district && $customer_province && $customer_department): ?>
                            <?php echo e(', ' . $customer_district->description); ?>

                            <?php echo e(', ' . $customer_province->description); ?>

                            <?php echo e('- ' . $customer_department->description); ?>

                        <?php endif; ?>
                    </p>
                </td>
            </tr>
        <?php endif; ?>

        <?php if($document->detraction): ?>
            
            <tr>
                <td class="align-top">
                    <p class="desc">N. Cta Detracciones:</p>
                </td>
                <td>
                    <p class="desc"><?php echo e($document->detraction->bank_account); ?></p>
                </td>
            </tr>
            <tr>
                <td class="align-top">
                    <p class="desc">B/S Sujeto a detracción:</p>
                </td>
                <?php $detractionType = app('App\Services\DetractionTypeService'); ?>
                <td>
                    <p class="desc"><?php echo e($document->detraction->detraction_type_id); ?> -
                        <?php echo e($detractionType->getDetractionTypeDescription($document->detraction->detraction_type_id)); ?>

                    </p>
                </td>
            </tr>
            <tr>
                <td class="align-top">
                    <p class="desc">Método de pago:</p>
                </td>
                <td>
                    <p class="desc">
                        <?php echo e($detractionType->getPaymentMethodTypeDescription($document->detraction->payment_method_id)); ?>

                    </p>
                </td>
            </tr>
            <tr>
                <td class="align-top">
                    <p class="desc">Porcentaje detracción:</p>
                </td>
                <td>
                    <p class="desc"><?php echo e($document->detraction->percentage); ?>%</p>
                </td>
            </tr>
            <tr>
                <td class="align-top">
                    <p class="desc">Monto detracción:</p>
                </td>
                <td>
                    <p class="desc"><?php echo e($currency_type->symbol); ?> <?php echo e($document->detraction->amount); ?></p>
                </td>
            </tr>
            <?php if($document->detraction->pay_constancy): ?>
                <tr>
                    <td class="align-top">
                        <p class="desc">Constancia de pago:</p>
                    </td>
                    <td>
                        <p class="desc"><?php echo e($document->detraction->pay_constancy); ?></p>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <?php if($document->prepayments): ?>
            <?php $__currentLoopData = $document->prepayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <p class="desc">Anticipo :</p>
                    </td>
                    <td>
                        <p class="desc"><?php echo e($p->number); ?></p>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if($document->purchase_order): ?>
            <tr>
                <td>
                    <p class="desc">Orden de Compra:</p>
                </td>
                <td>
                    <p class="desc"><?php echo e($document->purchase_order); ?></p>
                </td>
            </tr>
        <?php endif; ?>
        <?php if($document->quotation_id): ?>
            <tr>
                <td>
                    <p class="desc">Cotización:</p>
                </td>
                <td>
                    <p class="desc"><?php echo e($document->quotation->identifier); ?></p>
                </td>
            </tr>
        <?php endif; ?>
        <?php if(isset($document->quotation->delivery_date)): ?>
            <tr>
                <td>
                    <p class="desc">F. Entrega</p>
                </td>
                <td>
                    <p class="desc"><?php echo e($document->quotation->delivery_date->format('Y-m-d')); ?></p>
                </td>
            </tr>
        <?php endif; ?>
        <?php if(isset($document->quotation->sale_opportunity)): ?>
            <tr>
                <td>
                    <p class="desc">O. Venta</p>
                </td>
                <td>
                    <p class="desc"><?php echo e($document->quotation->sale_opportunity->number_full); ?></p>
                </td>
            </tr>
        <?php endif; ?>
    </table>

    <?php if($document->guides): ?>
        
        <table>
            <?php $__currentLoopData = $document->guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php if(isset($guide->document_type_description)): ?>
                        <td class="desc"><?php echo e($guide->document_type_description); ?></td>
                    <?php else: ?>
                        <td class="desc"><?php echo e($guide->document_type_id); ?></td>
                    <?php endif; ?>
                    <td class="desc">:</td>
                    <td class="desc"><?php echo e($guide->number); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    <?php endif; ?>

    

    <?php if(!is_null($document_base)): ?>
        <table>
            <tr>
                <td class="desc">Documento Afectado:</td>
                <td class="desc"><?php echo e($affected_document_number); ?></td>
            </tr>
            <tr>
                <td class="desc">Tipo de nota:</td>
                <td class="desc">
                    <?php echo e($document_base->note_type === 'credit' ? $document_base->note_credit_type->description : $document_base->note_debit_type->description); ?>

                </td>
            </tr>
            <tr>
                <td class="align-top desc">Descripción:</td>
                <td class="text-left desc"><?php echo e($document_base->note_description); ?></td>
            </tr>
        </table>
    <?php endif; ?>

    <table class="full-width mt-10 mb-10">
        <thead class="">
            <tr>
                <th class="border-top-bottom desc-9 text-left">CANT.</th>
                <th class="border-top-bottom desc-9 text-left">UNIDAD</th>
                <th class="border-top-bottom desc-9 text-left">DESCRIPCIÓN</th>
                <th class="border-top-bottom desc-9 text-left">P.UNIT</th>
                <th class="border-top-bottom desc-9 text-left">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $document_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center desc-9 align-top">
                        <?php if((int) $row->quantity != $row->quantity): ?>
                            <?php echo e($row->quantity); ?>

                        <?php else: ?>
                            <?php echo e(number_format($row->quantity, 0)); ?>

                        <?php endif; ?>
                    </td>
                    <td class="text-center desc-9 align-top"><?php echo e(json_decode($row->item)->unit_measure_id); ?></td>
                    <td class="text-left desc-9 align-top">
                        <?php if($row->name_product_pdf): ?>
                            <?php echo $row->name_product_pdf; ?>

                        <?php else: ?>
                            <?php echo e(json_decode($row->item)->description); ?>

                        <?php endif; ?>

                        <?php if(!empty($row->item->presentation)): ?>
                            <?php echo $row->item->presentation->description; ?>

                        <?php endif; ?>

                        
                        <?php if($row->attributes): ?>
                            <?php $__currentLoopData = $row->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <br /><?php echo $attr->description; ?> : <?php echo e($attr->value); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if($row->discounts): ?>
                            <?php $__currentLoopData = $row->discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dtos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <br /><small><?php echo e($dtos->factor * 100); ?>% <?php echo e($dtos->description); ?></small>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if($row->is_set == 1): ?>
                            <br>
                            <?php $itemSet = app('App\Services\ItemSetService'); ?>

                            <?php echo e(join('-', $itemSet->getItemsSet($row->item_id))); ?>

                        <?php endif; ?>

                    </td>
                    <td class="text-right desc-9 align-top"><?php echo e(number_format($row->unit_price, 2)); ?></td>
                    <td class="text-right desc-9 align-top"><?php echo e(number_format($row->total, 2)); ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="border-bottom"></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($document->prepayments): ?>
                <?php $__currentLoopData = $document->prepayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center desc-9 align-top">
                            1
                        </td>
                        <td class="text-center desc-9 align-top">NIU</td>
                        <td class="text-left desc-9 align-top">
                            ANTICIPO: <?php echo e($p->document_type_id == '02' ? 'FACTURA' : 'BOLETA'); ?> NRO.
                            <?php echo e($p->number); ?>

                        </td>
                        <td class="text-right  desc-9 align-top">-<?php echo e(number_format($p->total, 2)); ?></td>
                        <td class="text-right  desc-9 align-top">-<?php echo e(number_format($p->total, 2)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="border-bottom"></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if($document->total_exportation > 0): ?>
                <tr>
                    <td colspan="4" class="text-right font-bold desc">OP. EXPORTACIÓN: <?php echo e($currency_type->symbol); ?>

                    </td>
                    <td class="text-right font-bold desc"><?php echo e(number_format($document->total_exportation, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_free > 0): ?>
                <tr>
                    <td colspan="4" class="text-right font-bold desc">OP. GRATUITAS: <?php echo e($currency_type->symbol); ?>

                    </td>
                    <td class="text-right font-bold desc"><?php echo e(number_format($document->total_free, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_unaffected > 0): ?>
                <tr>
                    <td colspan="4" class="text-right font-bold desc">OP. INAFECTAS: <?php echo e($currency_type->symbol); ?>

                    </td>
                    <td class="text-right font-bold desc"><?php echo e(number_format($document->total_unaffected, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_exonerated > 0): ?>
                <tr>
                    <td colspan="4" class="text-right font-bold desc">OP. EXONERADAS: <?php echo e($currency_type->symbol); ?>

                    </td>
                    <td class="text-right font-bold desc"><?php echo e(number_format($document->total_exonerated, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_taxed > 0): ?>
                <tr>
                    <td colspan="4" class="text-right font-bold desc">OP. GRAVADAS: <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold desc"><?php echo e(number_format($document->total_taxed, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_discount > 0): ?>
                <tr>
                    <td colspan="4" class="text-right font-bold desc">DESCUENTO TOTAL: <?php echo e($currency_type->symbol); ?>

                    </td>
                    <td class="text-right font-bold desc"><?php echo e(number_format($document->total_discount, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_plastic_bag_taxes > 0): ?>
                <tr>
                    <td colspan="4" class="text-right font-bold desc">ICBPER: <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold desc"><?php echo e(number_format($document->total_plastic_bag_taxes, 2)); ?>

                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="4" class="text-right font-bold desc">IGV: <?php echo e($currency_type->symbol); ?></td>
                <td class="text-right font-bold desc"><?php echo e(number_format($document->total_igv, 2)); ?></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right font-bold desc">TOTAL A PAGAR: <?php echo e($currency_type->symbol); ?></td>
                <td class="text-right font-bold desc"><?php echo e(number_format($document->total, 2)); ?></td>
            </tr>
            <?php if($balance < 0): ?>
                <tr>
                    <td colspan="4" class="text-right font-bold desc">VUELTO: <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold desc"><?php echo e(number_format(abs($balance), 2, '.', '')); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <table class="full-width">
        <tr>

            
            <?php
                $legend = json_decode($document->legends);
            ?>
        <tr>
            <?php if($legend->code == '1000'): ?>
                <td class="desc pt-3">Son: <span class="font-bold"><?php echo e($legend->value); ?>

                        <?php echo e($currency_type->description); ?></span></td>
                <?php if(count((array) $document->legends) > 1): ?>
        <tr>
            <td class="desc pt-3"><span class="font-bold">Leyendas</span></td>
        </tr>
        <?php endif; ?>
    <?php else: ?>
        <td class="desc pt-3"><?php echo e($legend->code); ?>: <?php echo e($legend->value); ?></td>
        <?php endif; ?>
        </tr>
        
        </tr>


        <?php if($document->detraction): ?>
            <tr>
                <td class="desc pt-3 font-bold">
                    Operación sujeta al Sistema de Pago de Obligaciones Tributarias
                </td>
            </tr>
        <?php endif; ?>

        <tr>
            <td class="desc pt-3">

                <?php if($document->additional_information): ?>
                    <strong>Información adicional</strong>
                    <p><?php echo e($document->additional_information); ?></p>
                <?php endif; ?>

                <br>
                
            </td>
        </tr>
        <tr>
            <td class="text-center pt-3"><img class="qr_code"
                    src="data:image/png;base64, <?php echo e($document->qr); ?>" /></td>
        </tr>
        <tr>
            <td class="text-center desc">Código Hash: <?php echo e($document->hash); ?></td>
        </tr>

        <?php if($customer->department_id == 16): ?>
            <tr>
                <td class="text-center desc pt-5">
                    Representación impresa del Comprobante de Pago Electrónico.
                    <br />Esta puede ser consultada en:
                    <br /> <b><?php echo url('/buscar'); ?></b>
                    <br /> "Bienes transferidos en la Amazonía
                    <br />para ser consumidos en la misma
                </td>
            </tr>
        <?php endif; ?>

        <?php if($payments->count()): ?>
            <tr>
                <td class="desc pt-5">
                    <strong>PAGOS:</strong>
                </td>
            </tr>
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="desc">&#8226; <?php echo e($row->description); ?> -
                        <?php echo e($row->reference ? $row->reference . ' - ' : ''); ?> <?php echo e($currency_type->symbol); ?>

                        <?php echo e(number_format($row->payment + $row->change, 2, '.', '')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <tr>
            <td class="desc pt-2">
                <strong>Vendedor:</strong>
            </td>
        </tr>
        <tr>
            <td class="desc"><?php echo e($user->name); ?></td>
        </tr>
        <tr>
            <td class="text-center desc pt-5">Para consultar el comprobante ingresar a <?php echo e(route('micomprobante')); ?>

            </td>
        </tr>
    </table>

</body>

</html>
<?php /**PATH C:\laragon\www\nuevedoce\app\CoreBilling\Templates/pdf/default/invoice_ticket.blade.php ENDPATH**/ ?>