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
//dd($invoice);
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
$colspan = 5;
$colspan6 = 6;

//dd($company);

?>
<html>

<head>
    
    
</head>

<body>
    <?php if($document->state_type_id == '11'): ?>
        <div class="company_logo_box" style="position: absolute; text-align: center; top:30%;">
            <img src="data:<?php echo e(mime_content_type(public_path('status_images' . DIRECTORY_SEPARATOR . 'anulado.png'))); ?>;base64, <?php echo e(base64_encode(file_get_contents(public_path('status_images' . DIRECTORY_SEPARATOR . 'anulado.png')))); ?>"
                alt="anulado" class="" style="opacity: 0.6;">
        </div>
    <?php endif; ?>
    <table class="full-width">
        <tr>
            <?php if($company->logo): ?>
                <td width="20%">
                    <div class="company_logo_box">
                        <img src="data:<?php echo e(mime_content_type(public_path("storage/{$company->logo}"))); ?>;base64, <?php echo e(base64_encode(file_get_contents(public_path("storage/{$company->logo}")))); ?>"
                            alt="<?php echo e($company->name); ?>" class="company_logo" style="max-width: 150px;">
                    </div>
                </td>
            <?php else: ?>
                <td width="20%">
                    <img src="<?php echo e(asset('logo/logo.jpg')); ?>" class="company_logo" style="max-width: 150px">
                </td>
            <?php endif; ?>
            <td width="50%" class="pl-3">
                <div class="text-left">
                    <h4 class=""><?php echo e($company->name); ?></h4>
                    <h5><?php echo e('RUC ' . $company->number); ?></h5>
                    <h6>
                        <?php echo e($establishment->address); ?>

                        <?php echo e(', ' . $district->description); ?>

                        <?php echo e(', ' . $province->description); ?>

                        <?php echo e('- ' . $department->description); ?>

                    </h6>

                    <?php if(isset($establishment->trade_address)): ?>
                        <h6><?php echo e($establishment->trade_address !== '-' ? 'D. Comercial: ' . $establishment->trade_address : ''); ?>

                        </h6>
                    <?php endif; ?>

                    <h6><?php echo e($establishment->telephone !== '-' ? 'Central telefónica: ' . $establishment->telephone : ''); ?>

                    </h6>

                    <h6><?php echo e($establishment->email !== '-' ? 'Email: ' . $establishment->email : ''); ?></h6>

                    <?php if(isset($establishment->web_address)): ?>
                        <h6><?php echo e($establishment->web_address !== '-' ? 'Web: ' . $establishment->web_address : ''); ?></h6>
                    <?php endif; ?>

                    <?php if(isset($establishment->aditional_information)): ?>
                        <h6><?php echo e($establishment->aditional_information !== '-' ? $establishment->aditional_information : ''); ?>

                        </h6>
                    <?php endif; ?>
                </div>
            </td>
            <td width="30%" class="border-box py-4 px-2 text-center">
                <h5 class="text-center"><?php echo e($documentType->description); ?></h5>
                <h3 class="text-center"><?php echo e($document_number); ?></h3>
            </td>
        </tr>
    </table>
    <table class="full-width mt-5">
        <tr>
            <td width="120px">FECHA DE EMISIÓN</td>
            <td width="8px">:</td>
            <td><?php echo e($document->date_of_issue); ?></td>

            <?php if($document->detraction): ?>
                <td width="120px">N. CTA DETRACCIONES</td>
                <td width="8px">:</td>
                <td><?php echo e($document->detraction->bank_account); ?></td>
            <?php endif; ?>
        </tr>
        <?php if(isset($invoice)): ?>
            <?php $__currentLoopData = $invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item->date_of_due != $document->date_of_issue): ?>
                    <tr>
                        <td>FECHA DE VENCIMIENTO</td>
                        <td width="8px">:</td>
                        <td><?php echo e($item->date_of_due); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if($document->detraction): ?>
            <td width="140px">B/S SUJETO A DETRACCIÓN</td>
            <td width="8px">:</td>
            <?php $detractionType = app('App\Services\DetractionTypeService'); ?>
            <td width="220px"><?php echo e($document->detraction->detraction_type_id); ?> -
                <?php echo e($detractionType->getDetractionTypeDescription($document->detraction->detraction_type_id)); ?></td>
        <?php endif; ?>
        <tr>
            <td>CLIENTE:</td>
            <td>:</td>
            <td><?php echo e($customer->full_name); ?></td>

            <?php if($document->detraction): ?>
                <td width="120px">MÉTODO DE PAGO</td>
                <td width="8px">:</td>
                <td width="220px">
                    <?php echo e($detractionType->getPaymentMethodTypeDescription($document->detraction->payment_method_id)); ?>

                </td>
            <?php endif; ?>

        </tr>
        <tr>
            <td><?php echo e($identity_document_type->description); ?></td>
            <td>:</td>
            <td><?php echo e($customer->number); ?></td>

            <?php if($document->detraction): ?>
                <td width="120px">P. DETRACCIÓN</td>
                <td width="8px">:</td>
                <td><?php echo e($document->detraction->percentage); ?>%</td>
            <?php endif; ?>
        </tr>
        <?php if($customer->address !== ''): ?>
            <tr>
                <td class="align-top">DIRECCIÓN:</td>
                <td>:</td>
                <td>
                    <?php echo e($customer->address); ?>

                    <?php if($customer_district && $customer_province && $customer_department): ?>
                        <?php echo e(', ' . $customer_district->description); ?>

                        <?php echo e(', ' . $customer_province->description); ?>

                        <?php echo e('- ' . $customer_department->description); ?>

                    <?php endif; ?>
                </td>

                <?php if($document->detraction): ?>
                    <td width="120px">MONTO DETRACCIÓN</td>
                    <td width="8px">:</td>
                    <td><?php echo e($currency_type->symbol); ?> <?php echo e($document->detraction->amount); ?></td>
                <?php endif; ?>
            </tr>
        <?php endif; ?>
        <?php if($document->detraction): ?>
            <?php if($document->detraction->pay_constancy): ?>
                <tr>
                    <td colspan="3">
                    </td>
                    <td width="120px">CONSTANCIA DE PAGO</td>
                    <td width="8px">:</td>
                    <td><?php echo e($document->detraction->pay_constancy); ?></td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>
    </table>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    <?php if($document->guides): ?>
        <br />
        
        <table>
            <?php $__currentLoopData = $document->guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php if(isset($guide->document_type_description)): ?>
                        <td><?php echo e($guide->document_type_description); ?></td>
                    <?php else: ?>
                        <td><?php echo e($guide->document_type_id); ?></td>
                    <?php endif; ?>
                    <td>:</td>
                    <td><?php echo e($guide->number); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    <?php endif; ?>



    <?php if($document->reference_guides): ?>
        <br />
        <strong>Guias de remisión</strong>
        <table>
            <?php $__currentLoopData = $document->reference_guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($guide->series); ?></td>
                    <td>-</td>
                    <td><?php echo e($guide->number); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    <?php endif; ?>


    <table class="full-width mt-3">
        <?php if($document->prepayments): ?>
            <?php $__currentLoopData = $document->prepayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td width="120px">ANTICIPO</td>
                    <td width="8px">:</td>
                    <td><?php echo e($p->number); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if($document->purchase_order): ?>
            <tr>
                <td width="120px">ORDEN DE COMPRA</td>
                <td width="8px">:</td>
                <td><?php echo e($document->purchase_order); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->quotation_id): ?>
            <tr>
                <td width="120px">COTIZACIÓN</td>
                <td width="8px">:</td>
                <td><?php echo e($document->quotation->identifier); ?></td>

                <?php if(isset($document->quotation->delivery_date)): ?>
                    <td width="120px">F. ENTREGA</td>
                    <td width="8px">:</td>
                    <td><?php echo e($document->quotation->delivery_date->format('Y-m-d')); ?></td>
                <?php endif; ?>
            </tr>
        <?php endif; ?>
        <?php if(isset($document->quotation->sale_opportunity)): ?>
            <tr>
                <td width="120px">O. VENTA</td>
                <td width="8px">:</td>
                <td><?php echo e($document->quotation->sale_opportunity->number_full); ?></td>
            </tr>
        <?php endif; ?>
        <?php if(!is_null($document_base)): ?>
            <tr>
                <td width="120px">DOC. AFECTADO</td>
                <td width="8px">:</td>
                <td><?php echo e($affected_document_number); ?></td>
            </tr>
            <tr>
                <td>TIPO DE NOTA</td>
                <td>:</td>
                <td><?php echo e($document_base->note_type->description); ?></td>
            </tr>
            <tr>
                <td>DESCRIPCIÓN</td>
                <td>:</td>
                <td><?php echo e($document_base->note_description); ?></td>
            </tr>
        <?php endif; ?>
    </table>

    
    
    
    
    
    
    
    
    
    
    
    

    <table class="full-width mt-10 mb-10">
        <thead class="">
            <tr class="bg-grey">
                <th class="border-top-bottom text-center py-2" width="8%">CANT.</th>
                <th class="border-top-bottom text-center py-2" width="8%">UNIDAD</th>
                <th class="border-top-bottom text-left py-2">DESCRIPCIÓN</th>
                <!--th class="border-top-bottom text-center py-2" width="8%">LOTE</th-->
                <!--th class="border-top-bottom text-center py-2" width="8%">SERIE</th-->
                <th class="border-top-bottom text-right py-2" width="12%">P.UNIT</th>
                <th class="border-top-bottom text-right py-2" width="8%">DTO.</th>
                <th class="border-top-bottom text-right py-2" width="12%">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $document_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center align-top">
                        <?php if((int) $row->quantity != $row->quantity): ?>
                            <?php echo e($row->quantity); ?>

                        <?php else: ?>
                            <?php echo e(number_format($row->quantity, 0)); ?>

                        <?php endif; ?>
                    </td>
                    <td class="text-center align-top"><?php echo e(json_decode($row->item)->unit_measure_id); ?></td>
                    <td class="text-left align-top">
                        <?php echo e(json_decode($row->item)->description); ?>

                    </td>
                    <!--td class="text-center align-top">
                
            </td>
            <td class="text-center align-top">

                <?php if(isset($row->item->lots)): ?>
    <?php $__currentLoopData = $row->item->lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(isset($lot->has_sale) && $lot->has_sale): ?>
    <span style="font-size: 9px"><?php echo e($lot->series); ?></span><br>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

            </td-->
                    <td class="text-right align-top"><?php echo e(number_format($row->unit_price, 2)); ?></td>
                    <td class="text-right align-top">
                        <?php if($row->discounts): ?>
                            <?php
                                $total_discount_line = 0;
                                foreach ($row->discounts as $disto) {
                                    $total_discount_line = $total_discount_line + $disto->amount;
                                }
                            ?>
                            <?php echo e(number_format($total_discount_line, 2)); ?>

                        <?php else: ?>
                            0
                        <?php endif; ?>
                    </td>
                    <td class="text-right align-top"><?php echo e(number_format($row->total, 2)); ?></td>
                </tr>
                <tr>
                    <td colspan="<?php echo e($colspan6); ?>" class="border-bottom"></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



            <?php if($document->prepayments): ?>
                <?php $__currentLoopData = $document->prepayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center align-top">
                            1
                        </td>
                        <td class="text-center align-top">NIU</td>
                        <td class="text-left align-top">
                            ANTICIPO: <?php echo e($p->document_type_id == '02' ? 'FACTURA' : 'BOLETA'); ?> NRO.
                            <?php echo e($p->number); ?>

                        </td>
                        <td class="text-right align-top">-<?php echo e(number_format($p->total, 2)); ?></td>
                        <td class="text-right align-top">
                            0
                        </td>
                        <td class="text-right align-top">-<?php echo e(number_format($p->total, 2)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="border-bottom"></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if($document->total_exportation > 0): ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">OP. EXPORTACIÓN:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->total_exportation, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_free > 0): ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">OP. GRATUITAS:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->total_free, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_unaffected > 0): ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">OP. INAFECTAS:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->total_unaffected, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_exonerated > 0): ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">OP. EXONERADAS:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->total_exonerated, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_taxed > 0): ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">OP. GRAVADAS:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->total_taxed, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_discount > 0): ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">
                        <?php echo e($document->total_prepayment > 0 ? 'ANTICIPO' : 'DESCUENTO TOTAL'); ?>:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->total_discount, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($document->total_plastic_bag_taxes > 0): ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">ICBPER:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->total_plastic_bag_taxes, 2)); ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">IGV: <?php echo e($currency_type->symbol); ?>

                </td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_igv, 2)); ?></td>
            </tr>

            <?php if($document->perception): ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold"> IMPORTE TOTAL:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->total, 2)); ?></td>
                </tr>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">PERCEPCIÓN:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->perception->amount, 2)); ?></td>
                </tr>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">TOTAL A PAGAR:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold">
                        <?php echo e(number_format($document->total + $document->perception->amount, 2)); ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">TOTAL A PAGAR:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format($document->total, 2)); ?></td>
                </tr>
            <?php endif; ?>

            <?php if($balance < 0): ?>
                <tr>
                    <td colspan="<?php echo e($colspan); ?>" class="text-right font-bold">VUELTO:
                        <?php echo e($currency_type->symbol); ?></td>
                    <td class="text-right font-bold"><?php echo e(number_format(abs($balance), 2, '.', '')); ?></td>
                </tr>
            <?php endif; ?>



        </tbody>
    </table>
    <table class="full-width">
        <tr>
            <td width="65%" style="text-align: top; vertical-align: top;">
                <?php
                    $legend = json_decode($document->legends);
                ?>
                
                <?php if($legend->code == '1000'): ?>
                    <p>Son: <span class="font-bold"><?php echo e($legend->value); ?>

                            <?php echo e($currency_type->description); ?></span></p>
                    <?php if(count((array) $document->legends) > 1): ?>
                        <p><span class="font-bold">Leyendas</span></p>
                    <?php endif; ?>
                <?php else: ?>
                    <p> <?php echo e($legend->code); ?>: <?php echo e($legend->value); ?> </p>
                <?php endif; ?>

                
                <br />
                <?php if($document->detraction): ?>
                    <p>
                        <span class="font-bold">
                            Operación sujeta al Sistema de Pago de Obligaciones Tributarias
                        </span>
                    </p>
                    <br />
                <?php endif; ?>
                <?php if($customer->department_id == 16): ?>
                    <br /><br /><br />
                    <div>
                        <center>
                            Representación impresa del Comprobante de Pago Electrónico.
                            <br />Esta puede ser consultada en:
                            <br /><b><?php echo e(route('micomprobante')); ?></b>
                            <br /> "Bienes transferidos en la Amazonía
                            <br />para ser consumidos en la misma".
                        </center>
                    </div>
                    <br />
                <?php endif; ?>

                <?php if($document->additional_information): ?>
                    <strong>Información adicional</strong>
                    <p><?php echo e($document->additional_information); ?></p>
                <?php endif; ?>

                <br>
                
            </td>
            <td width="35%" class="text-right">
                <img src="data:image/png;base64, <?php echo e($document->qr); ?>" style="margin-right: -10px;" />
                <p style="font-size: 9px">Código Hash: <?php echo e($document->hash); ?></p>
            </td>
        </tr>
    </table>
    <?php if($payments->count()): ?>


        <table class="full-width">
            <tr>
                <td>
                    <strong>PAGOS:</strong>
                </td>
            </tr>
            <?php
                $payment = 0;
            ?>
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>&#8226; <?php echo e($row->description); ?> - <?php echo e($row->reference ? $row->reference . ' - ' : ''); ?>

                        <?php echo e($currency_type->symbol); ?>

                        <?php echo e(number_format($row->payment + $row->change, 2, '.', '')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>

        </table>
    <?php endif; ?>

    <?php if($document->user): ?>
        <br>
        <table class="full-width">
            <tr>
                <td>
                    <strong>Vendedor:</strong>
                </td>
            </tr>
            <tr>
                <td><?php echo e($user->name); ?></td>
            </tr>
        </table>
    <?php endif; ?>
</body>

</html>
<?php /**PATH C:\laragon\www\nuevedoce\app\CoreBilling\Templates/pdf/default/invoice_a4.blade.php ENDPATH**/ ?>