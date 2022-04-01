<?php
    $establishment = \Modules\Setting\Entities\SetEstablishment::find($document->establishment_id);
    $accounts = \App\Models\BankAccount::all();
    $documentType = \App\Models\DocumentType::find($document->document_type_id);
    $district = \Illuminate\Support\Facades\DB::table('districts')->where('id',$establishment->district_id)->first();
    $province = \Illuminate\Support\Facades\DB::table('provinces')->where('id',$establishment->province_id)->first();
    $department = \Illuminate\Support\Facades\DB::table('departments')->where('id',$establishment->department_id)->first();
    //dd($document);
    $customer = $document->customer;
    $identity_document_type = \App\Models\IdentityDocumentType::find($customer->identity_document_type_id);
    $customer_district = \Illuminate\Support\Facades\DB::table('districts')->where('id',$customer->district_id)->first();
    $customer_province = \Illuminate\Support\Facades\DB::table('provinces')->where('id',$customer->province_id)->first();
    $customer_department = \Illuminate\Support\Facades\DB::table('departments')->where('id',$customer->department_id)->first();

    $currency_type = \App\Models\CurrencyType::find($document->currency_type_id);
    $user = \App\Models\User::find($document->user_id);

    $left =  ($document->series) ? $document->series : $document->prefix;
    $tittle = $left.'-'.str_pad($document->number, 8, '0', STR_PAD_LEFT);
    $payments = $document->payments;

?>
<html>
<head>
    
    
</head>
<body>
<table class="full-width">
    <tr>
        <?php if($company->logo): ?>
            <td width="20%">
                <div class="company_logo_box">
                    <img src="data:<?php echo e(mime_content_type(public_path("storage/{$company->logo}"))); ?>;base64, <?php echo e(base64_encode(file_get_contents(public_path("storage/{$company->logo}")))); ?>" alt="<?php echo e($company->name); ?>" class="company_logo" style="max-width: 150px;">
                </div>
            </td>
        <?php else: ?>
            <td width="20%">
            </td>
        <?php endif; ?>
        <td width="50%" class="pl-3">
            <div class="text-left">
                <h4 class=""><?php echo e($company->name); ?></h4>
                <h5><?php echo e('RUC '.$company->number); ?></h5>
                <h6>
                    <?php echo e($establishment->address); ?>

                    <?php echo e(', '.$district->description); ?>

                    <?php echo e(', '.$province->description); ?>

                    <?php echo e('- '.$department->description); ?>

                </h6>
                <h6><?php echo e(($establishment->email !== '-')? $establishment->email : ''); ?></h6>
                <h6><?php echo e(($establishment->telephone !== '-')? $establishment->telephone : ''); ?></h6>
            </div>
        </td>
        <td width="30%" class="border-box py-4 px-2 text-center">
            <h5 class="text-center">NOTA DE VENTA</h5>
            <h3 class="text-center"><?php echo e($tittle); ?></h3>
        </td>
    </tr>
</table>
<table class="full-width mt-5">
    <tr>
        <td width="15%">Cliente:</td>
        <td width="45%"><?php echo e($customer->full_name); ?></td>
        <td width="25%">Fecha de emisión:</td>
        <td width="15%"><?php echo e($document->date_of_issue->format('Y-m-d')); ?></td>
    </tr>
    <tr>
        <td><?php echo e($identity_document_type->description); ?>:</td>
        <td><?php echo e($customer->number); ?></td>
    </tr>
    <?php if($customer->address !== ''): ?>
    <tr>
        <td class="align-top">Dirección:</td>
        <td colspan="3">
            <?php echo e($customer->address); ?>

            <?php if($customer_district && $customer_province && $customer_department): ?>
                <?php echo e(', '.$customer_district->description); ?>

                <?php echo e(', '.$customer_province->description); ?>

                <?php echo e('- '.$customer_department->description); ?>

            <?php endif; ?>
        </td>
    </tr>
    <?php endif; ?>
    <?php if($document->plate_number !== null): ?>
    <tr>
        <td width="15%">N° Placa:</td>
        <td width="85%"><?php echo e($document->plate_number); ?></td>
    </tr>
    <?php endif; ?>
    <?php if($document->total_canceled): ?>
    <tr>
        <td class="align-top">Estado:</td>
        <td colspan="3">CANCELADO</td>
    </tr>
    <?php else: ?>
    <tr>
        <td class="align-top">Estado:</td>
        <td colspan="3">PENDIENTE DE PAGO</td>
    </tr>
    <?php endif; ?>
</table>

<?php if($document->guides): ?>
<br/>

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

<table class="full-width mt-10 mb-10">
    <thead class="">
    <tr class="bg-grey">
        <th class="border-top-bottom text-center py-2" width="8%">CANT.</th>
        <th class="border-top-bottom text-center py-2" width="8%">UNIDAD</th>
        <th class="border-top-bottom text-left py-2">DESCRIPCIÓN</th>
        <th class="border-top-bottom text-center py-2" width="8%">LOTE</th>
        <th class="border-top-bottom text-center py-2" width="8%">SERIE</th>
        <th class="border-top-bottom text-right py-2" width="12%">P.UNIT</th>
        <th class="border-top-bottom text-right py-2" width="8%">DTO.</th>
        <th class="border-top-bottom text-right py-2" width="12%">TOTAL</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $document->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center align-top">
                <?php if(((int)$row->quantity != $row->quantity)): ?>
                    <?php echo e($row->quantity); ?>

                <?php else: ?>
                    <?php echo e(number_format($row->quantity, 0)); ?>

                <?php endif; ?>
            </td>
            <td class="text-center align-top"><?php echo e(json_decode($row->item)->unit_measure_id); ?></td>
            <td class="text-left">
                <?php echo e(json_decode($row->item)->name); ?> <?php if(!empty($row->item->presentation)): ?> <?php echo $row->item->presentation->description; ?> <?php endif; ?>

                <?php if($row->attributes): ?>
                    <?php $__currentLoopData = $row->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <br/><span style="font-size: 9px"><?php echo $attr->description; ?> : <?php echo e($attr->value); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if($row->discounts): ?>
                    <?php $__currentLoopData = $row->discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dtos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <br/><span style="font-size: 9px"><?php echo e($dtos->factor * 100); ?>% <?php echo e($dtos->description); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                

            </td>
            <td class="text-center align-top">
                

            </td>
            <td class="text-center align-top">

                <?php if(isset($row->item->lots)): ?>
                    <?php $__currentLoopData = $row->item->lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <span style="font-size: 9px"><?php echo e($lot->series); ?></span><br>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </td>
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
            <td colspan="8" class="border-bottom"></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($document->total_exportation > 0): ?>
            <tr>
                <td colspan="7" class="text-right font-bold">OP. EXPORTACIÓN: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_exportation, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_free > 0): ?>
            <tr>
                <td colspan="7" class="text-right font-bold">OP. GRATUITAS: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_free, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_unaffected > 0): ?>
            <tr>
                <td colspan="7" class="text-right font-bold">OP. INAFECTAS: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_unaffected, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_exonerated > 0): ?>
            <tr>
                <td colspan="7" class="text-right font-bold">OP. EXONERADAS: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_exonerated, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_taxed > 0): ?>
            <tr>
                <td colspan="7" class="text-right font-bold">OP. GRAVADAS: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_taxed, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_discount > 0): ?>
            <tr>
                <td colspan="7" class="text-right font-bold"><?php echo e((($document->total_prepayment > 0) ? 'ANTICIPO':'DESCUENTO TOTAL')); ?>: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_discount, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="7" class="text-right font-bold">IGV: <?php echo e($document->currency_type->symbol); ?></td>
            <td class="text-right font-bold"><?php echo e(number_format($document->total_igv, 2)); ?></td>
        </tr>
        <tr>
            <td colspan="7" class="text-right font-bold">TOTAL A PAGAR: <?php echo e($document->currency_type->symbol); ?></td>
            <td class="text-right font-bold"><?php echo e(number_format($document->total, 2)); ?></td>
        </tr>
    </tbody>
</table>
<table class="full-width">
<tr>
    <td>
    <strong>PAGOS:</strong> </td></tr>
        <?php
            $payment = 0;
        ?>
        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr><td>- <?php echo e($row->date_of_payment->format('d/m/Y')); ?> - <?php echo e($row->payment_method_type->description); ?> - <?php echo e($row->reference ? $row->reference.' - ':''); ?> <?php echo e($document->currency_type->symbol); ?> <?php echo e($row->payment); ?></td></tr>
            <?php
                $payment += (float) $row->payment;
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr><td><strong>SALDO:</strong> <?php echo e($document->currency_type->symbol); ?> <?php echo e(number_format($document->total - $payment, 2)); ?></td>
    </tr>
</table>
</body>
</html>
<?php /**PATH C:\laragon\www\nuevedoce\app\CoreBilling\Templates/pdf/default/sale_note_a4.blade.php ENDPATH**/ ?>