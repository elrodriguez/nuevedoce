<?php
$path_style = app_path('CoreFacturalo' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . 'style.css');
?>

<head>
    <link href="<?php echo e($path_style); ?>" rel="stylesheet" />
</head>

<body>
    <table class="full-width">
        <tr>
            <td class="text-center desc font-bold">Para consultar el comprobante ingresar a
                <?php echo e(route('micomprobante')); ?>

            </td>
        </tr>
    </table>
</body>
<?php /**PATH C:\laragon\www\nuevedoce\app\CoreBilling\Templates/pdf/default/partials/footer.blade.php ENDPATH**/ ?>