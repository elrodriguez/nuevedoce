<div>
    <div class="page-wrapper auth">
        <div class="page-inner bg-brand-gradient">
            <div class="page-content-wrapper bg-transparent m-0">
                <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                    <div class="d-flex align-items-center container p-0">
                        <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                <?php if($company): ?>
                                    <?php if(file_exists(public_path('storage/'.$company->logo))): ?>
                                        <img src="<?php echo e(url('storage/'.$company->logo)); ?>" alt="<?php echo e(env('APP_NAME', 'Laravel')); ?>" aria-roledescription="logo">
                                    <?php endif; ?>
                                    <span class="page-logo-text mr-1"><?php echo e($company->name); ?></span>
                                <?php else: ?>
                                    <img src="<?php echo e(url('themes/smart-admin/img/logo.png')); ?>" alt="<?php echo e(env('APP_NAME', 'Laravel')); ?>" aria-roledescription="logo">
                                    <span class="page-logo-text mr-1"><?php echo e(env('APP_NAME', 'Laravel')); ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                        <?php if(Route::has('login')): ?>
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('dashboard')); ?>" class="btn-link text-white ml-auto">Home</a>
                            <?php else: ?>
                                <span class="text-white opacity-50 ml-auto mr-2 hidden-sm-down">
                                    <?php echo e(__('labels.already_member')); ?>

                                </span>
                                <a href="<?php echo e(route('login')); ?>" class="btn-link text-white ml-auto ml-sm-0">
                                    <?php echo e(__('labels.log_in')); ?>

                                </a>
                                
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex-1" style="background: url(<?php echo e(url('themes/smart-admin/img/svg/pattern-1.svg')); ?>) no-repeat center bottom fixed; background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row">
                            <div class="col col-md-6 col-lg-7 hidden-sm-down">
                                <h2 class="fs-xxl fw-500 mt-4 text-white">
                                    Herramientas de interfaz de usuario más simple
                                    <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                        <?php echo e(env('APP_NAME', 'Laravel')); ?> El conjunto de herramientas más modular disponible con más de 600 permutaciones de diseño. ¡Experimente la simplicidad de <?php echo e(env('APP_NAME', 'Laravel')); ?>, donde quiera que vaya!
                                    </small>
                                </h2>
                                <a href="#" class="fs-lg fw-500 text-white opacity-70">Documentación &gt;&gt;</a>
                                <div class="d-sm-flex flex-column align-items-center justify-content-center d-md-block">
                                    <div class="px-0 py-1 mt-5 text-white fs-nano opacity-50">
                                        Encuéntranos en las redes sociales
                                    </div>
                                    <div class="d-flex flex-row opacity-70">
                                        <a href="#" class="mr-2 fs-xxl text-white">
                                            <i class="fab fa-facebook-square"></i>
                                        </a>
                                        <a href="#" class="mr-2 fs-xxl text-white">
                                            <i class="fab fa-twitter-square"></i>
                                        </a>
                                        <a href="#" class="mr-2 fs-xxl text-white">
                                            <i class="fab fa-google-plus-square"></i>
                                        </a>
                                        <a href="#" class="mr-2 fs-xxl text-white">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-interval="2000">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" style="height: 250px" src="<?php echo e(url('themes/smart-admin/img/carousel/control-gestion-empresa.jpg')); ?>" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" style="height: 250px" src="<?php echo e(url('themes/smart-admin/img/carousel/Gestion-Empresarial.jpg')); ?>" alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" style="height: 250px" src="<?php echo e(url('themes/smart-admin/img/carousel/planificacion.jpg')); ?>" alt="Third slide">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                            <?php echo e(\Carbon\Carbon::now()->format('Y')); ?> © <?php echo e(env('APP_NAME', 'Laravel')); ?> by&nbsp;<a href='<?php echo e(env('DEVELOPER_GITHUB', 'Laravel')); ?>' class='text-white opacity-40 fw-500' title='<?php echo e(env('DEVELOPER_NAME', 'Laravel')); ?>' target='_blank'><?php echo e(env('DEVELOPER_NAME', 'Laravel')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\resources\views/livewire/welcome.blade.php ENDPATH**/ ?>