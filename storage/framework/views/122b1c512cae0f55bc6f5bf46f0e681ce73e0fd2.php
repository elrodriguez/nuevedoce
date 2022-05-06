<?php

if (count($products) > 0) {
    $date = $products[0]['created_at'];
    $origin = $products[0]['origin_name'];
    $destination = $products[0]['destination_name'];
    $description = $products[0]['description'];
    $transfer_quantity = $products[0]['transfer_quantity'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Traslado - <?php echo e($date); ?></title>
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

        .celda-right {
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

        .td-custom {
            line-height: 0.1em;
        }

        .width-custom {
            width: 50%
        }

    </style>
</head>

<body>
    <div>
        <p align="center" class="title"><strong>Traslados de Productos</strong></p>
    </div>
    <div style="margin-top:20px; margin-bottom:20px;">


        <table>
            <tr>
                <td class="td-custom width-custom">
                    <p><strong>Fecha Traslado: </strong><?php echo e(\Carbon\Carbon::parse($date)->format('d/m/Y')); ?></p>
                </td>
                <td class="td-custom">
                    <p><strong>Productos: </strong><?php echo e($transfer_quantity); ?></p>
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong><?php echo e(__('labels.origin_warehouse')); ?>: </strong><?php echo e($origin); ?></p>
                </td>
                <td class="td-custom">
                    <p>
                        <strong><?php echo e(__('labels.destination_warehouse')); ?>: </strong>
                        <?php echo e($destination); ?>

                    </p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="td-custom">
                    <p><strong><?php echo e(__('labels.description')); ?>: </strong><?php echo e($description); ?></p>
                </td>
            </tr>

        </table>
    </div>
    <?php if(count($products) > 0): ?>
        <div class="">
            <div class=" ">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(__('labels.product')); ?></th>
                            <th><?php echo e(__('labels.quantity')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $xtotalp = 0;
                            $c = 1;
                        ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item['quantity'] > 0): ?>
                                <tr>
                                    <td class="celda"><?php echo e($c); ?></td>
                                    <td class="celda-left"><?php echo e($item['name']); ?></td>
                                    <td class="celda-right">
                                        <?php echo e(number_format($item['quantity'], 2, '.', '')); ?>

                                    </td>
                                </tr>
                                <?php
                                    $xtotalp = $xtotalp + $item['quantity'];
                                    $c++;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="celda-right" colspan="2"><?php echo e(__('labels.total')); ?></th>
                            <th class="celda-right"><?php echo e(number_format($xtotalp, 2, '.', '')); ?></th>
                        </tr>
                    </tfoot>
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
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/transfers/export_pdf.blade.php ENDPATH**/ ?>