<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo e(env('APP_NAME', 'Laravel')); ?>

        </title>
        <meta name="description" content="Page Title">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/vendors.bundle.css')); ?>">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/app.bundle.css')); ?>">
        <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
        <link id="myskin" rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/skins/skin-master.css')); ?>">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(url('themes/smart-admin/img/favicon/apple-touch-icon.png')); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(url('themes/smart-admin/img/favicon/favicon-32x32.png')); ?>">
        <link rel="mask-icon" href="<?php echo e(url('themes/smart-admin/img/favicon/safari-pinned-tab.svg')); ?>" color="#5bbad5">
        <!-- You can add your own stylesheet here to override any styles that comes before it -->
		<link rel="stylesheet" media="screen, print" href="<?php echo e(url('themes/smart-admin/css/your_styles.css')); ?>">
        <?php echo $__env->yieldContent('styles'); ?>
    </head>
    <body class="mod-bg-1 ">
     
        <script>

            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);

            }
            else if (themeSettings.themeURL && document.getElementById('mytheme'))
            {
                document.getElementById('mytheme').href = themeSettings.themeURL;
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|footer|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <?php $__env->startSection('sidebar'); ?>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('sidebar')->html();
} elseif ($_instance->childHasBeenRendered('Z8izX12')) {
    $componentId = $_instance->getRenderedChildComponentId('Z8izX12');
    $componentTag = $_instance->getRenderedChildComponentTagName('Z8izX12');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Z8izX12');
} else {
    $response = \Livewire\Livewire::mount('sidebar');
    $html = $response->html();
    $_instance->logRenderedChild('Z8izX12', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php echo $__env->yieldSection(); ?>
               
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('header-navigation')->html();
} elseif ($_instance->childHasBeenRendered('I4s1dmq')) {
    $componentId = $_instance->getRenderedChildComponentId('I4s1dmq');
    $componentTag = $_instance->getRenderedChildComponentTagName('I4s1dmq');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('I4s1dmq');
} else {
    $response = \Livewire\Livewire::mount('header-navigation');
    $html = $response->html();
    $_instance->logRenderedChild('I4s1dmq', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <?php echo $__env->yieldContent('breadcrumb'); ?>
                        </ol>
                        <div class="subheader">
                            <?php echo $__env->yieldContent('subheader'); ?>
                        </div>
                        <?php echo $__env->yieldContent('content'); ?>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <?php if (isset($component)) { $__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Footer::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Footer::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf)): ?>
<?php $component = $__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf; ?>
<?php unset($__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf); ?>
<?php endif; ?>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shortcuts')->html();
} elseif ($_instance->childHasBeenRendered('v0GBU9H')) {
    $componentId = $_instance->getRenderedChildComponentId('v0GBU9H');
    $componentTag = $_instance->getRenderedChildComponentTagName('v0GBU9H');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('v0GBU9H');
} else {
    $response = \Livewire\Livewire::mount('shortcuts');
    $html = $response->html();
    $_instance->logRenderedChild('v0GBU9H', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    <!-- END Shortcuts -->
                    <!-- BEGIN Color profile -->
                    <!-- this area is hidden and will not be seen on screens or screen readers -->
                    <!-- we use this only for CSS color refernce for JS stuff -->
                    <p id="js-color-profile" class="d-none">
                        <span class="color-primary-50"></span>
                        <span class="color-primary-100"></span>
                        <span class="color-primary-200"></span>
                        <span class="color-primary-300"></span>
                        <span class="color-primary-400"></span>
                        <span class="color-primary-500"></span>
                        <span class="color-primary-600"></span>
                        <span class="color-primary-700"></span>
                        <span class="color-primary-800"></span>
                        <span class="color-primary-900"></span>
                        <span class="color-info-50"></span>
                        <span class="color-info-100"></span>
                        <span class="color-info-200"></span>
                        <span class="color-info-300"></span>
                        <span class="color-info-400"></span>
                        <span class="color-info-500"></span>
                        <span class="color-info-600"></span>
                        <span class="color-info-700"></span>
                        <span class="color-info-800"></span>
                        <span class="color-info-900"></span>
                        <span class="color-danger-50"></span>
                        <span class="color-danger-100"></span>
                        <span class="color-danger-200"></span>
                        <span class="color-danger-300"></span>
                        <span class="color-danger-400"></span>
                        <span class="color-danger-500"></span>
                        <span class="color-danger-600"></span>
                        <span class="color-danger-700"></span>
                        <span class="color-danger-800"></span>
                        <span class="color-danger-900"></span>
                        <span class="color-warning-50"></span>
                        <span class="color-warning-100"></span>
                        <span class="color-warning-200"></span>
                        <span class="color-warning-300"></span>
                        <span class="color-warning-400"></span>
                        <span class="color-warning-500"></span>
                        <span class="color-warning-600"></span>
                        <span class="color-warning-700"></span>
                        <span class="color-warning-800"></span>
                        <span class="color-warning-900"></span>
                        <span class="color-success-50"></span>
                        <span class="color-success-100"></span>
                        <span class="color-success-200"></span>
                        <span class="color-success-300"></span>
                        <span class="color-success-400"></span>
                        <span class="color-success-500"></span>
                        <span class="color-success-600"></span>
                        <span class="color-success-700"></span>
                        <span class="color-success-800"></span>
                        <span class="color-success-900"></span>
                        <span class="color-fusion-50"></span>
                        <span class="color-fusion-100"></span>
                        <span class="color-fusion-200"></span>
                        <span class="color-fusion-300"></span>
                        <span class="color-fusion-400"></span>
                        <span class="color-fusion-500"></span>
                        <span class="color-fusion-600"></span>
                        <span class="color-fusion-700"></span>
                        <span class="color-fusion-800"></span>
                        <span class="color-fusion-900"></span>
                    </p>
                    <!-- END Color profile -->
                </div>
            </div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modal-profile')->html();
} elseif ($_instance->childHasBeenRendered('lersLfU')) {
    $componentId = $_instance->getRenderedChildComponentId('lersLfU');
    $componentTag = $_instance->getRenderedChildComponentTagName('lersLfU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('lersLfU');
} else {
    $response = \Livewire\Livewire::mount('modal-profile');
    $html = $response->html();
    $_instance->logRenderedChild('lersLfU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
        <?php if (isset($component)) { $__componentOriginal45100493d9a5554377f475543ae8f0ecd1b1f5a7 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\ThemeSetting::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('theme-setting'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\ThemeSetting::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal45100493d9a5554377f475543ae8f0ecd1b1f5a7)): ?>
<?php $component = $__componentOriginal45100493d9a5554377f475543ae8f0ecd1b1f5a7; ?>
<?php unset($__componentOriginal45100493d9a5554377f475543ae8f0ecd1b1f5a7); ?>
<?php endif; ?>
        <script src="<?php echo e(url('themes/smart-admin/js/vendors.bundle.js')); ?>"></script>
        <script src="<?php echo e(url('themes/smart-admin/js/app.bundle.js')); ?>"></script>
        <?php echo $__env->yieldContent('script'); ?>
        <!--This page contains the basic JS and CSS files to get started on your project. If you need aditional addon's or plugins please see scripts located at the bottom of each page in order to find out which JS/CSS files to add.-->
        <?php echo \Livewire\Livewire::scripts(); ?>

    </body>
</html>
<?php /**PATH C:\laragon\www\nuevedoce\resources\views/components/app-layout.blade.php ENDPATH**/ ?>