<div>
    <div class="blankpage-form-field">
        <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
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
                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
            </a>
        </div>
        <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
            <form>
                <div class="form-group">
                    <label class="form-label" for="username">Nombre de usuario</label>
                    <input type="text" id="username" class="form-control" wire:model="username">
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <input type="password" id="password" class="form-control" wire:model="password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rememberme" wire:model="rememberme">
                        <label class="custom-control-label" for="rememberme"> Recuérdame</label>
                    </div>
                </div>
                <button wire:click="login" type="button" class="btn btn-default float-right">Iniciar sesión</button>
            </form>
        </div>
        <div class="blankpage-footer text-center">
            <a href="#"><strong>Recuperar contraseña</strong></a>
        </div>
    </div>
    
    <video poster="<?php echo e(url('themes/smart-admin/img/backgrounds/clouds.png')); ?>" id="bgvid" playsinline autoplay muted loop>
        <source src="<?php echo e(url('themes/smart-admin/media/video/cc.webm')); ?>" type="video/webm">
        <source src="<?php echo e(url('themes/smart-admin/media/video/cc.mp4')); ?>" type="video/mp4">
    </video>
    <script type="text/javascript">
        document.addEventListener('login-error', function () {
            initApp.playSound('themes/smart-admin/media/sound', 'voice_on')
            bootbox.alert({
                title: "<i class='fal fa-times text-success mr-2'></i> <span class='text-success fw-500'><?php echo e(__('labels.error')); ?></span>",
                message: "<span><strong><?php echo e(__('labels.lcorrect')); ?>...</strong> <?php echo e(__('labels.username_password_incorrect')); ?></span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
        })
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\resources\views/livewire/login-form.blade.php ENDPATH**/ ?>