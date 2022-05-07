<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <style>
        html {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-spacing: 0;
            border: 1px solid black;
        }

        .celda {
            text-align: center;
            padding: 5px;
            border: 0.1px solid black;
        }

        th {
            padding: 5px;
            text-align: center;
            border-color: #0088cc;
            border: 0.1px solid black;
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
            background: #0088cc;
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
        <p align="center" class="title"><strong>Reporte Punto de Venta</strong></p>
    </div>
    <div style="margin-top:20px; margin-bottom:20px;">
        <table>
            <tr>
                <td class="width-custom">
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
                    <p><strong>Establecimiento: </strong><?php echo e($establishment->address); ?> -
                        <?php echo e($establishment->department->description); ?> - <?php echo e($establishment->district->description); ?>

                    </p>
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong>Vendedor: </strong><?php echo e($cash->user->name); ?></p>
                </td>
                <td class="td-custom">
                    <p><strong>Fecha y hora apertura: </strong><?php echo e($cash->date_opening); ?> <?php echo e($cash->time_opening); ?>

                    </p>
                </td>
            </tr>
            <tr>
                <td class="td-custom">
                    <p><strong>Estado de caja: </strong><?php echo e($cash->state ? 'Aperturada' : 'Cerrada'); ?></p>
                </td>
                <?php if(!$cash->state): ?>
                    <td class="td-custom">
                        <p><strong>Fecha y hora cierre: </strong><?php echo e($cash->date_closed); ?> <?php echo e($cash->time_closed); ?>

                        </p>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <td colspan="2" class="td-custom">
                    <p><strong>Montos de operación: </strong></p>
                </td>
            </tr>


        </table>
    </div>
    <?php if($documents->count()): ?>
        <div class="">
            <div class=" ">
                <table class="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Comprobante</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="celda"><?php echo e($loop->iteration); ?></td>
                                <td class="celda"><?php echo e($item['description']); ?></td>
                                <td class="celda"><?php echo e($item['quantity']); ?></td>
                                <td class="celda"><?php echo e($item['number_full']); ?></td>
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
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/cash/report_product_excel.blade.php ENDPATH**/ ?>