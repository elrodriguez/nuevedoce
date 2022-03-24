<?php
    $establishment = json_decode($document->establishment);
    $customer = json_decode($document->customer);

    $district = \Illuminate\Support\Facades\DB::table('districts')->where('id',$establishment->district_id)->first();
    $province = \Illuminate\Support\Facades\DB::table('provinces')->where('id',$establishment->province_id)->first();
    $department = \Illuminate\Support\Facades\DB::table('departments')->where('id',$establishment->department_id)->first();

    $customer_district = \Illuminate\Support\Facades\DB::table('districts')->where('id',$customer->district_id)->first();
    $customer_province = \Illuminate\Support\Facades\DB::table('provinces')->where('id',$customer->province_id)->first();
    $customer_department = \Illuminate\Support\Facades\DB::table('departments')->where('id',$customer->department_id)->first();

    $identity_document_type = \App\Models\IdentityDocumentType::find($customer->identity_document_type_id);
    $documentType = \App\Models\DocumentType::find($document->document_type_id);

    $document_base = $document->note;
    $document_number = $document->series.'-'.str_pad($document->number, 8, '0', STR_PAD_LEFT);
    $currency_type = \App\Models\CurrencyType::find($document->currency_type_id);

    $note_type = \Modules\Sales\Entities\SalNoteTypes::find($document_base->note_type_id);

    $document_type_description_array = [
        '01' => 'FACTURA',
        '03' => 'BOLETA DE VENTA',
        '07' => 'NOTA DE CREDITO',
        '08' => 'NOTA DE DEBITO',
    ];
    $identity_document_type_description_array = [
        '-' => 'S/D',
        '0' => 'S/D',
        '1' => 'DNI',
        '6' => 'RUC',
    ];

    $affected_document_number = ($document_base->affected_document) ? $document_base->affected_document->series.'-'.str_pad($document_base->affected_document->number, 8, '0', STR_PAD_LEFT) : $document_base->data_affected_document->series.'-'.str_pad($document_base->data_affected_document->number, 8, '0', STR_PAD_LEFT);

    //$affected_document_number = $document_base->affected_document->series.'-'.str_pad($document_base->affected_document->number, 8, '0', STR_PAD_LEFT);
    //$path_style = app_path('CoreFacturalo'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style.css');
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
                <img src="<?php echo e(asset('logo/logo.jpg')); ?>" class="company_logo" style="max-width: 150px">
            </td>
        <?php endif; ?>
        <td width="50%" class="pl-3">
            <div class="text-left">
                <h4 class=""><?php echo e($company->name); ?></h4>
                <h5><?php echo e('RUC '.$company->number); ?></h5>
                <h6>
                    <?php echo e(($establishment->address !== '-')? $establishment->address : ''); ?>

                    <?php echo e(($establishment->district_id !== '-')? ', '.$district->description : ''); ?>

                    <?php echo e(($establishment->province_id !== '-')? ', '.$province->description : ''); ?>

                    <?php echo e(($establishment->department_id !== '-')? '- '.$department->description : ''); ?>

                </h6>
                <h6><?php echo e(($establishment->email !== '-')? $establishment->email : ''); ?></h6>
                <h6><?php echo e(($establishment->phone !== '-')? $establishment->phone : ''); ?></h6>
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
        <td width="5px">:</td>
        <td><?php echo e($document->date_of_issue); ?></td>
    </tr>
    <tr>
        <td>CLIENTE</td>
        <td>:</td>
        <td><?php echo e($customer->full_name); ?></td>
    </tr>
    <tr>
        
        <td><?php echo e($identity_document_type->description); ?></td>
        <td>:</td>
        <td><?php echo e($customer->number); ?></td>
        
            
            
        
    </tr>

    <?php if($customer->address !== ''): ?>
    <tr>
        <td class="align-top">DIRECCIÓN</td>
        <td>:</td>
        <td>
            <?php echo e($customer->address); ?>

            <?php if($customer_district && $customer_province && $customer_department): ?>
                <?php echo e(($customer->district_id !== '-')? ', '.$customer_district->description : ''); ?>

                <?php echo e(($customer->province_id !== '-')? ', '.$customer_province->description : ''); ?>

                <?php echo e(($customer->department_id !== '-')? '- '.$customer_department->description : ''); ?>

            <?php endif; ?>
            
        </td>
    </tr>
    <?php endif; ?>
</table>

<?php if($document->guides): ?>
<table class="full-width mt-3">
<?php $__currentLoopData = $document->guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($guide->document_type_id); ?></td>
        <td><?php echo e($guide->number); ?></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php endif; ?>

<table class="full-width mt-3">
    <?php if($document->purchase_order): ?>
    <tr>
        <td>ORDEN DE COMPRA</td>
        <td>:</td>
        <td><?php echo e($document->purchase_order); ?></td>
    </tr>
    <?php endif; ?>
    <tr>
        <td width="120px">DOC. AFECTADO</td>
        <td width="5px">:</td>
        <td><?php echo e($affected_document_number); ?></td>
    </tr>
    <tr>
        <td>TIPO DE NOTA</td>
        <td>:</td>
        <td><?php echo e($note_type->description); ?></td>
    </tr>
    <tr>
        <td>DESCRIPCIÓN</td>
        <td>:</td>
        <td><?php echo e($document_base->note_description); ?></td>
    </tr>
</table>

<table class="full-width mt-10 mb-10">
    <thead class="">
    <tr class="bg-grey">
        <th class="border-top-bottom text-center py-2" width="8%">CANT.</th>
        <th class="border-top-bottom text-center py-2" width="8%">UNIDAD</th>
        <th class="border-top-bottom text-left py-2">DESCRIPCIÓN</th>
        <th class="border-top-bottom text-right py-2" width="12%">P.UNIT</th>
        <th class="border-top-bottom text-right py-2" width="8%">DTO.</th>
        <th class="border-top-bottom text-right py-2" width="12%">TOTAL</th>
    </tr>
    </thead>
    <tbody>
        
    <?php $__currentLoopData = $document->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <?php if(((int)$row->quantity != $row->quantity)): ?>
                    <?php echo e($row->quantity); ?>

                <?php else: ?>
                    <?php echo e(number_format($row->quantity, 0)); ?>

                <?php endif; ?>
            </td>
            <td class="text-center"><?php echo e($row->unit_type_id); ?></td>
            <td class="text-left">
                <?php echo $row->name; ?>

                <?php if($row->attributes): ?>
                    <?php $__currentLoopData = $row->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <br/><span style="font-size: 9px"><?php echo $attr->name; ?> : <?php echo e($attr->value); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if($row->discounts): ?>
                    <?php $__currentLoopData = $row->discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dtos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <br/><span style="font-size: 9px"><?php echo e($dtos->factor * 100); ?>% <?php echo e($dtos->description); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </td>
            <td class="text-right"><?php echo e(number_format($row->unit_price, 2)); ?></td>
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
            <td class="text-right"><?php echo e(number_format($row->total, 2)); ?></td>
        </tr>
        <tr>
            <td colspan="6" class="border-bottom"></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($document->total_exportation > 0): ?>
            <tr>
                <td colspan="5" class="text-right font-bold">OP. EXPORTACIÓN: <?php echo e($currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_exportation, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_free > 0): ?>
            <tr>
                <td colspan="5" class="text-right font-bold">OP. GRATUITAS: <?php echo e($currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_free, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_unaffected > 0): ?>
            <tr>
                <td colspan="5" class="text-right font-bold">OP. INAFECTAS: <?php echo e($currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_unaffected, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_exonerated > 0): ?>
            <tr>
                <td colspan="5" class="text-right font-bold">OP. EXONERADAS: <?php echo e($currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_exonerated, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_taxed > 0): ?>
            <tr>
                <td colspan="5" class="text-right font-bold">OP. GRAVADAS: <?php echo e($currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_taxed, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_discount > 0): ?>
            <tr>
                <td colspan="5" class="text-right font-bold"><?php echo e((($document->total_prepayment > 0) ? 'ANTICIPO':'DESCUENTO TOTAL')); ?>: <?php echo e($currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_discount, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="5" class="text-right font-bold">IGV: <?php echo e($currency_type->symbol); ?></td>
            <td class="text-right font-bold"><?php echo e(number_format($document->total_igv, 2)); ?></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right font-bold">TOTAL A PAGAR: <?php echo e($currency_type->symbol); ?></td>
            <td class="text-right font-bold"><?php echo e(number_format($document->total, 2)); ?></td>
        </tr>
    </tbody>
    <tfoot style="border-top: 1px solid #333;">
    <tr>
        <td colspan="5" class="font-lg"  style="padding-top: 2rem;">Son: <span class="font-bold"><?php echo e($document->number_to_letter); ?> <?php echo e($currency_type->description); ?></span></td>
    </tr>
    <?php if(isset($document->optional->observations)): ?>
        <tr>
            <td colspan="3"><b>Obsevaciones</b></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="3"><?php echo e($document->optional->observations); ?></td>
            <td colspan="2"></td>
        </tr>
    <?php endif; ?>
    </tfoot>
</table>

<table class="full-width">
    <tr>
        <td width="65%">
            <div class="text-left"><img class="qr_code" src="data:image/png;base64, <?php echo e($document->qr); ?>" /></div>
            <p>Código Hash: <?php echo e($document->hash); ?></p>
        </td>
    </tr>
</table>
</body>
</html><?php /**PATH C:\laragon\www\nuevedoce\app\CoreBilling\Templates/pdf/default/note_a4.blade.php ENDPATH**/ ?>