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

<?php if($company->logo): ?>
    <div class="text-center company_logo_box pt-5">
        <img src="data:<?php echo e(mime_content_type(public_path("storage/{$company->logo}"))); ?>;base64, <?php echo e(base64_encode(file_get_contents(public_path("storage/{$company->logo}")))); ?>" alt="<?php echo e($company->name); ?>" class="company_logo_ticket contain">
    </div>
<?php else: ?>
    <div class="text-center company_logo_box pt-5">--}}
        <img src="<?php echo e(asset('logo/logo.jpg')); ?>" class="company_logo_ticket contain">
    </div>
<?php endif; ?>
<table class="full-width">
    <tr>
        <td class="text-center"><h4><?php echo e($company->name); ?></h4></td>
    </tr>
    <tr>
        <td class="text-center"><h5><?php echo e('RUC '.$company->number); ?></h5></td>
    </tr>
    <tr>
        <td class="text-center">
            <?php echo e(($establishment->address !== '-')? $establishment->address : ''); ?>

            <?php echo e(($establishment->district_id !== '-')? ', '.$establishment->district->description : ''); ?>

            <?php echo e(($establishment->province_id !== '-')? ', '.$establishment->province->description : ''); ?>

            <?php echo e(($establishment->department_id !== '-')? '- '.$establishment->department->description : ''); ?>

        </td>
    </tr>
    <tr>
        <td class="text-center"><?php echo e(($establishment->email !== '-')? $establishment->email : ''); ?></td>
    </tr>
    <tr>
        <td class="text-center pb-3"><?php echo e(($establishment->telephone !== '-')? $establishment->telephone : ''); ?></td>
    </tr>
    <tr>
        <td class="text-center pt-3 border-top"><h4>NOTA DE VENTA</h4></td>
    </tr>
    <tr>
        <td class="text-center pb-3 border-bottom"><h3><?php echo e($tittle); ?></h3></td>
    </tr>
</table>
<table class="full-width">
    <tr>
        <td width="" class="pt-3"><p class="desc">F. Emisión:</p></td>
        <td width="" class="pt-3"><p class="desc"><?php echo e($document->date_of_issue->format('Y-m-d')); ?></p></td>
    </tr>


    <tr>
        <td class="align-top"><p class="desc">Cliente:</p></td>
        <td><p class="desc"><?php echo e($customer->full_name); ?></p></td>
    </tr>
    <tr>
        <td><p class="desc"><?php echo e($identity_document_type->description); ?>:</p></td>
        <td><p class="desc"><?php echo e($customer->number); ?></p></td>
    </tr>
    <?php if($customer->address !== ''): ?>
        <tr>
            <td class="align-top"><p class="desc">Dirección:</p></td>
            <td>
                <p class="desc">
                    <?php echo e($customer->address); ?>

                    <?php if($customer_district && $customer_province && $customer_department): ?>
                        <?php echo e(', '.$customer_district->description); ?>

                        <?php echo e(', '.$customer_province->description); ?>

                        <?php echo e('- '.$customer_department->description); ?>

                    <?php endif; ?>
                </p>
            </td>
        </tr>
    <?php endif; ?>
    <?php if($document->plate_number !== null): ?>
    <tr>
        <td class="align-top"><p class="desc">N° Placa:</p></td>
        <td><p class="desc"><?php echo e($document->plate_number); ?></p></td>
    </tr>
    <?php endif; ?>
    <?php if($document->purchase_order): ?>
        <tr>
            <td><p class="desc">Orden de Compra:</p></td>
            <td><p class="desc"><?php echo e($document->purchase_order); ?></p></td>
        </tr>
    <?php endif; ?>
</table>

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
    <?php $__currentLoopData = $document->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center desc-9 align-top">
                <?php if(((int)$row->quantity != $row->quantity)): ?>
                    <?php echo e($row->quantity); ?>

                <?php else: ?>
                    <?php echo e(number_format($row->quantity, 0)); ?>

                <?php endif; ?>
            </td>
            <td class="text-center desc-9 align-top"><?php echo e(json_decode($row->item)->unit_measure_id); ?></td>
            <td class="text-left desc-9 align-top">
                <?php echo json_decode($row->item)->description; ?> <?php if(!empty($row->item->presentation)): ?> <?php echo $row->item->presentation->description; ?> <?php endif; ?>
                <?php if($row->attributes): ?>
                    <?php $__currentLoopData = $row->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <br/><?php echo $attr->description; ?> : <?php echo e($attr->value); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if($row->discounts): ?>
                    <?php $__currentLoopData = $row->discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dtos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <br/><small><?php echo e($dtos->factor * 100); ?>% <?php echo e($dtos->description); ?></small>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </td>
            <td class="text-right desc-9 align-top"><?php echo e(number_format($row->unit_price, 2)); ?></td>
            <td class="text-right desc-9 align-top"><?php echo e(number_format($row->total, 2)); ?></td>
        </tr>
        <tr>
            <td colspan="5" class="border-bottom"></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($document->total_exportation > 0): ?>
            <tr>
                <td colspan="4" class="text-right font-bold desc">OP. EXPORTACIÓN: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold desc"><?php echo e(number_format($document->total_exportation, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_free > 0): ?>
            <tr>
                <td colspan="4" class="text-right font-bold desc">OP. GRATUITAS: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold desc"><?php echo e(number_format($document->total_free, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_unaffected > 0): ?>
            <tr>
                <td colspan="4" class="text-right font-bold desc">OP. INAFECTAS: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold desc"><?php echo e(number_format($document->total_unaffected, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_exonerated > 0): ?>
            <tr>
                <td colspan="4" class="text-right font-bold desc">OP. EXONERADAS: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold desc"><?php echo e(number_format($document->total_exonerated, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($document->total_taxed > 0): ?>
            <tr>
                <td colspan="4" class="text-right font-bold desc">OP. GRAVADAS: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold desc"><?php echo e(number_format($document->total_taxed, 2)); ?></td>
            </tr>
        <?php endif; ?>
         <?php if($document->total_discount > 0): ?>
            <tr>
                <td colspan="5" class="text-right font-bold"><?php echo e((($document->total_prepayment > 0) ? 'ANTICIPO':'DESCUENTO TOTAL')); ?>: <?php echo e($document->currency_type->symbol); ?></td>
                <td class="text-right font-bold"><?php echo e(number_format($document->total_discount, 2)); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="4" class="text-right font-bold desc">IGV: <?php echo e($document->currency_type->symbol); ?></td>
            <td class="text-right font-bold desc"><?php echo e(number_format($document->total_igv, 2)); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="text-right font-bold desc">TOTAL A PAGAR: <?php echo e($document->currency_type->symbol); ?></td>
            <td class="text-right font-bold desc"><?php echo e(number_format($document->total, 2)); ?></td>
        </tr>
    </tbody>
</table>
<table class="full-width">
    <tr>

        
            <?php
                $legend = $document->legends;
            ?>
            <tr>
                <?php if($legend->code == "1000"): ?>
                    <td class="desc pt-3">Son: <span class="font-bold"><?php echo e($legend ->value); ?> <?php echo e($currency_type->description); ?></span></td>
                    <?php if(count((array) $document->legends)>1): ?>
                    <tr><td class="desc pt-3"><span class="font-bold">Leyendas</span></td></tr>
                    <?php endif; ?>
                <?php else: ?>
                    <td class="desc pt-3"><?php echo e($legend->code); ?>: <?php echo e($legend->value); ?></td>
                <?php endif; ?>
            </tr>
        
    </tr>


</table>
<table class="full-width">
    <tr><td><strong>PAGOS:</strong> </td></tr>
    <?php
        $payment = 0;
    ?>
    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr><td>- <?php echo e($row->date_of_payment->format('d/m/Y')); ?> - <?php echo e($row->payment_method_type->description); ?> - <?php echo e($row->reference ? $row->reference.' - ':''); ?> <?php echo e($document->currency_type->symbol); ?> <?php echo e($row->payment); ?></td></tr>
        <?php
            $payment += (float) $row->payment;
        ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr><td><strong>SALDO:</strong> <?php echo e($document->currency_type->symbol); ?> <?php echo e(number_format($document->total - $payment, 2)); ?></td></tr>
</table>
</body>
</html>
<?php /**PATH C:\laragon\www\nuevedoce\app\CoreBilling\Templates/pdf/default/sale_note_ticket.blade.php ENDPATH**/ ?>