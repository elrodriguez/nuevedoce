<?php

$establishment = $cash->user->establishment;

$final_balance = 0;
$cash_income = 0;
$cash_egress = 0;
$cash_final_balance = 0;

$cash_documents = $cash->cash_documents;

foreach ($cash_documents as $cash_document) {
    if($cash_document->sale_note){

        if($cash_document->sale_note->currency_type_id == 'PEN'){

            if(in_array($cash_document->sale_note->state_type_id, ['01','03','05','07','13'])){

                $cash_income += $cash_document->sale_note->total;
                $final_balance += $cash_document->sale_note->total;

            }

        }else{

            if(in_array($cash_document->sale_note->state_type_id, ['01','03','05','07','13'])){

                $cash_income += $cash_document->sale_note->total * $cash_document->sale_note->exchange_rate_sale;
                $final_balance += $cash_document->sale_note->total * $cash_document->sale_note->exchange_rate_sale;

            }

        }

        if(in_array($cash_document->sale_note->state_type_id, ['01','03','05','07','13'])){

            if( count($cash_document->sale_note->payments) > 0)
            {
                $pays = $cash_document->sale_note->payments;

                foreach ($methods_payment as $record) {

                    $record->sum = ($record->sum + $pays->where('payment_method_type_id', $record->id)->sum('payment') );
                }

            }
        }


    }
    else if($cash_document->document){
        if($cash_document->document->currency_type_id == 'PEN'){

            if(in_array($cash_document->document->state_type_id, ['01','03','05','07','13'])){

                $cash_income += $cash_document->document->total;
                $final_balance += $cash_document->document->total;

            }

        }else{

            if(in_array($cash_document->document->state_type_id, ['01','03','05','07','13'])){

                $cash_income += $cash_document->document->total * $cash_document->document->exchange_rate_sale;
                $final_balance += $cash_document->document->total * $cash_document->document->exchange_rate_sale;

            }

        }
        $payment_condition_id = $cash_document->document->payment_condition_id;
        if (in_array($cash_document->document->state_type_id, ['01','03','05','07','13']) && $payment_condition_id === '01') {
            if( count($cash_document->document->payments) > 0) {
                $pays = $cash_document->document->payments;

                foreach ($methods_payment as $record) {
                    $record->sum = ($record->sum + $pays->where('payment_method_type_id', $record->id)->whereIn('document.state_type_id', ['01','03','05','07','13'])->sum('payment'));
                }

            }
        } else {
            foreach ($methods_payment as $record) {
                if ($record->id === '09') {
                    $record->sum += $cash_document->document->total;
                }
            }
        }




    }
    else if($cash_document->expense_payment){

        if($cash_document->expense_payment->expense->state_type_id == '05'){

            if($cash_document->expense_payment->expense->currency_type_id == 'PEN'){

                $cash_egress += $cash_document->expense_payment->payment;
                $final_balance -= $cash_document->expense_payment->payment;

            }else{

                $cash_egress += $cash_document->expense_payment->payment  * $cash_document->expense_payment->expense->exchange_rate_sale;
                $final_balance -= $cash_document->expense_payment->payment  * $cash_document->expense_payment->expense->exchange_rate_sale;
            }

        }
    }

}

$cash_final_balance = $final_balance + $cash->beginning_balance;
//$cash_income = ($final_balance > 0) ? ($cash_final_balance - $cash->beginning_balance) : 0;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reporte - <?php echo e($cash->user->name); ?> - <?php echo e($cash->date_opening); ?> <?php echo e($cash->time_opening); ?></title>
        <style>
            html {
                font-family: sans-serif;
                font-size: 12px;
            }

            table {
                width: 100%;
                border-spacing: 0;
                border: 1px solid #e9e9e9;
            }

            .celda {
                text-align: center;
                padding: 5px;
                border: 0.1px solid #e9e9e9;
            }
            .celda-left {
                text-align: left;
                padding: 5px;
                border: 0.1px solid #e9e9e9;
            }
            .celda-right{
                text-align: right;
                padding: 5px;
                border: 0.1px solid #e9e9e9;
            }
            th {
                padding: 5px;
                text-align: center;
                border-color: #7a59ad;
                border: 0.1px solid rgba(0, 0, 0, 0.1)
            }

            .title {
                font-weight: bold;
                padding: 5px;
                font-size: 20px !important;
                text-decoration: underline;
            }

            p>strong {
                margin-left: 5px;
                font-size: 12px;
            }

            thead {
                font-weight: bold;
                background: #7a59ad;
                color: white;
                text-align: center;
            }
            .td-custom { line-height: 0.1em; }

            .width-custom { width: 50% }
        </style>
    </head>
    <body>
        <div>
            <p align="center" class="title"><strong>Reporte Punto de Venta</strong></p>
        </div>
        <div style="margin-top:20px; margin-bottom:20px;">


            <table>
                <tr>
                    <td class="td-custom width-custom">
                        <p><strong>Empresa: </strong><?php echo e($company->name); ?></p>
                    </td>
                    <td class="td-custom">
                        <p><strong>Fecha reporte: </strong><?php echo e(date('Y-m-d')); ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="td-custom">
                        <p><strong>Ruc: </strong><?php echo e($company->number); ?></p>
                    </td>
                    <td class="width-custom">
                        <?php if($establishment): ?>
                        <p><strong>Establecimiento: </strong><?php echo e($establishment->address); ?> - <?php echo e($establishment->department->description); ?> - <?php echo e($establishment->district->description); ?></p>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="td-custom">
                        <p><strong>Vendedor: </strong><?php echo e($cash->user->name); ?></p>
                    </td>
                    <td class="td-custom">
                        <p><strong>Fecha y hora apertura: </strong><?php echo e($cash->date_opening); ?> <?php echo e($cash->time_opening); ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="td-custom">
                        <p><strong>Estado de caja: </strong><?php echo e(($cash->state) ? 'Aperturada':'Cerrada'); ?></p>
                    </td>
                    <?php if(!$cash->state): ?>
                    <td class="td-custom">
                        <p><strong>Fecha y hora cierre: </strong><?php echo e($cash->date_closed); ?> <?php echo e($cash->time_closed); ?></p>
                    </td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td colspan="2" class="td-custom">
                        <p><strong>Montos de operación: </strong></p>
                    </td>
                </tr>
                <tr>
                    <td class="td-custom">
                        <p><strong>Saldo inicial: </strong>S/. <?php echo e(number_format($cash->beginning_balance, 2, ".", "")); ?></p>
                    </td>
                    <td  class="td-custom">
                        <p><strong>Ingreso: </strong>S/. <?php echo e(number_format($cash_income, 2, ".", "")); ?> </p>
                    </td>
                </tr>
                <tr>
                    <td  class="td-custom">
                        <p><strong>Saldo final: </strong>S/. <?php echo e(number_format($cash_final_balance, 2, ".", "")); ?> </p>
                    </td>
                    <td  class="td-custom">
                        <p><strong>Egreso: </strong>S/. <?php echo e(number_format($cash_egress, 2, ".", "")); ?> </p>
                    </td>
                </tr>
            </table>
        </div>
        <?php if($cash_documents->count()): ?>
            <div class="">
                <div class=" ">

                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descripcion</th>
                                <th>Suma</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $methods_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td class="celda"><?php echo e($loop->iteration); ?></td>
                                    <td class="celda-left"><?php echo e($item->name); ?></td>
                                    <td class="celda-right"><?php echo e(number_format($item->payment_sum, 2, ".", "")); ?></td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table> <br>

                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tipo transacción</th>
                                <th>Tipo documento</th>
                                <th>Documento</th>
                                <th>Fecha emisión</th>
                                <th>Cliente/Proveedor</th>
                                <th>N° Documento</th>
                                <th>Moneda</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $all_documents = [];
                                foreach ($cash_documents as $key => $value) {
                                    if($value->sale_note){
                                        $all_documents[] = $value;
                                    }else if($value->document){
                                        $all_documents[] = $value;
                                    }else if($value->expense_payment){
                                        if($value->expense_payment->expense->state_type_id == '05'){
                                            $all_documents[] = $value;
                                        }
                                    }
                                }
                            ?>
                            <?php $__currentLoopData = $all_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php

                                        $type_transaction =  null;
                                        $document_type_description = null;
                                        $number = null;
                                        $date_of_issue = null;
                                        $customer_name = null;
                                        $customer_number = null;
                                        $currency_type_id = null;
                                        $total = null;

                                        if($value->sale_note){
                                            
                                            $type_transaction =  'Venta';
                                            $document_type_description =  'NOTA DE VENTA';
                                            $number = $value->sale_note->series.'-'.$value->sale_note->number;
                                            $date_of_issue = $value->sale_note->date_of_issue->format('Y-m-d');
                                            $customer_name = $value->sale_note->customer->full_name;
                                            $customer_number = $value->sale_note->customer->number;

                                            $total = $value->sale_note->total;

                                            if(!in_array($value->sale_note->state_type_id, ['01','03','05','07','13'])){
                                                $total = 0;
                                            }

                                            $currency_type_id = $value->sale_note->currency_type_id;

                                        }
                                        else if($value->document){

                                            $type_transaction =  'Venta';
                                            $document_type_description =  $value->document->document_type->description;
                                            $number = $value->document->series.'-'.$value->document->number;
                                            $date_of_issue = \Carbon\Carbon::parse($value->document->date_of_issue)->format('Y-m-d');
                                            $customer_name = json_decode($value->document->customer)->full_name;
                                            $customer_number = json_decode($value->document->customer)->number;
                                            $total = $value->document->total;

                                            if(!in_array($value->document->state_type_id, ['01','03','05','07','13'])){
                                                $total = 0;
                                            }

                                            $currency_type_id = $value->document->currency_type_id;

                                        }
                                        else if($value->expense_payment){

                                            $type_transaction =  'Gasto';
                                            $document_type_description =  $value->expense_payment->expense->expense_type->description;
                                            $number = $value->expense_payment->expense->number;
                                            $date_of_issue = $value->expense_payment->expense->date_of_issue->format('Y-m-d');
                                            $customer_name = $value->expense_payment->expense->supplier->name;
                                            $customer_number = $value->expense_payment->expense->supplier->number;
                                            $total = -$value->expense_payment->payment;
                                            $currency_type_id = $value->expense_payment->expense->currency_type_id;

                                        }

                                    ?>


                                    <td class="celda"><?php echo e($loop->iteration); ?></td>
                                    <td class="celda"><?php echo e($type_transaction); ?></td>
                                    <td class="celda-left"><?php echo e($document_type_description); ?></td>
                                    <td class="celda"><?php echo e($number); ?></td>
                                    <td class="celda"><?php echo e($date_of_issue); ?></td>
                                    <td class="celda-left"><?php echo e($customer_name); ?></td>
                                    <td class="celda"><?php echo e($customer_number); ?></td>
                                    <td class="celda"><?php echo e($currency_type_id); ?></td>
                                    <td class="celda-right"><?php echo e(number_format($total,2, ".", "")); ?></td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="callout callout-info">
                <p>No se encontraron registros.</p>
            </div>
        <?php endif; ?>
    </body>
</html>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/cash/report_pdf.blade.php ENDPATH**/ ?>