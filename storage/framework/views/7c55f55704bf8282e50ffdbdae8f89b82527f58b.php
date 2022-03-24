<div class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="<?php echo e(url('themes/smart-admin/img/logo.png')); ?>" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- DOC: nav menu layout change shortcut -->
    <div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>
    <div class="ml-auto d-flex">
        <!-- app settings -->
        <div class="hidden-md-down">
            <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                <i class="fal fa-cog"></i>
            </a>
        </div>
        <!-- app user menu -->
        <div>
            <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="header-icon d-flex align-items-center justify-content-center ml-2">
            <?php if(file_exists(public_path('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png'))): ?>
            <img src="<?php echo e(asset('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png')); ?>" style="width:32px;height: 32px;" class="profile-image rounded-circle" alt="<?php echo e(auth()->user()->name); ?>">
            <?php else: ?>
            <img src="<?php echo e(ui_avatars_url(auth()->user()->name,32,'none')); ?>" style="width:32px;height: 32px;" class="profile-image rounded-circle" alt="<?php echo e(auth()->user()->name); ?>">
            <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2">
                            <?php if(file_exists(public_path('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png'))): ?>
                            <img src="<?php echo e(asset('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png')); ?>" style="width:50px;height: 50px;" class="rounded-circle profile-image" alt="<?php echo e(auth()->user()->name); ?>">
                            <?php else: ?>
                            <img src="<?php echo e(ui_avatars_url(auth()->user()->name,50,'none')); ?>" style="width:50px;height: 50px;" class="rounded-circle profile-image" alt="<?php echo e(auth()->user()->name); ?>">
                            <?php endif; ?>
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg"><?php echo e(auth()->user()->name); ?></div>
                            <span class="text-truncate text-truncate-md opacity-80"><?php echo e(auth()->user()->email); ?></span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider m-0"></div>
                <a data-toggle="modal" data-target="#modalProfile" href="javascript:void(0)" class="dropdown-item">
                    <span><?php echo e(__('labels.user_data')); ?></span>
                </a>
                
                
                <div class="dropdown-divider m-0"></div>
                <form id="logout-form" method="POST" action="<?php echo e(route('logout')); ?>" style="display:none"><?php echo csrf_field(); ?></form>
                <a class="dropdown-item fw-500 pt-3 pb-3" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span data-i18n="drpdwn.page-logout"><?php echo app('translator')->get('buttons.logout'); ?></span>
                    <span class="float-right fw-n">&commat;<?php echo e(config('app.name', 'Laravel')); ?></span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\resources\views/livewire/header-navigation.blade.php ENDPATH**/ ?>