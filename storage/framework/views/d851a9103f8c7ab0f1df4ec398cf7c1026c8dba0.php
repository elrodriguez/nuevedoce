<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/vendors.bundle.css')); ?>">
        <link rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/app.bundle.css')); ?>">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(url('themes/smart-admin/img/favicon/apple-touch-icon.png')); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(url('themes/smart-admin/img/favicon/favicon-32x32.png')); ?>">
        <link rel="mask-icon" href="<?php echo e(url('themes/smart-admin/img/favicon/safari-pinned-tab.svg')); ?>" color="#5bbad5">
        <!-- Optional: page related CSS-->
        <link rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/page-login.css')); ?>">
    </head>
    <body>

        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('login-form')->html();
} elseif ($_instance->childHasBeenRendered('dAvywQw')) {
    $componentId = $_instance->getRenderedChildComponentId('dAvywQw');
    $componentTag = $_instance->getRenderedChildComponentTagName('dAvywQw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('dAvywQw');
} else {
    $response = \Livewire\Livewire::mount('login-form');
    $html = $response->html();
    $_instance->logRenderedChild('dAvywQw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

        <script src="<?php echo e(url('themes/smart-admin/js/vendors.bundle.js')); ?>"></script>
        <script src="<?php echo e(url('themes/smart-admin/js/app.bundle.js')); ?>"></script>
        <?php echo \Livewire\Livewire::scripts(); ?>

    </body>
</html>
<?php /**PATH C:\laragon\www\nuevedoce\resources\views/page_login.blade.php ENDPATH**/ ?>