<div>
    <div class="blankpage-form-field">
        <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                @if($company)
                    @if(file_exists(public_path('storage/'.$company->logo)))
                        <img src="{{ url('storage/'.$company->logo) }}" alt="{{ env('APP_NAME', 'Laravel') }}" aria-roledescription="logo">
                    @endif
                    <span class="page-logo-text mr-1">{{ $company->name }}</span>
                @else
                    <img src="{{ url('themes/smart-admin/img/logo.png') }}" alt="{{ env('APP_NAME', 'Laravel') }}" aria-roledescription="logo">
                    <span class="page-logo-text mr-1">{{ env('APP_NAME', 'Laravel') }}</span>
                @endif
                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
            </a>
        </div>
        <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
            <form>
                <div class="form-group">
                    <label class="form-label" for="username">Nombre de usuario</label>
                    <input type="text" id="username" class="form-control" wire:model="username">
                    @error('username') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <input type="password" id="password" class="form-control" wire:model="password">
                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
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
    {{-- <div class="login-footer p-2">
        <div class="row">
            <div class="col col-sm-12 text-center">
                <i><strong>System Message:</strong> You were logged out from 198.164.246.1 on Saturday, March, 2017 at 10.56AM</i>
            </div>
        </div>
    </div> --}}
    <video poster="{{ url('themes/smart-admin/img/backgrounds/clouds.png') }}" id="bgvid" playsinline autoplay muted loop>
        <source src="{{ url('themes/smart-admin/media/video/cc.webm') }}" type="video/webm">
        <source src="{{ url('themes/smart-admin/media/video/cc.mp4') }}" type="video/mp4">
    </video>
    <script type="text/javascript">
        document.addEventListener('login-error', function () {
            initApp.playSound('themes/smart-admin/media/sound', 'voice_on')
            bootbox.alert({
                title: "<i class='fal fa-times text-success mr-2'></i> <span class='text-success fw-500'>{{ __('labels.error') }}</span>",
                message: "<span><strong>{{ __('labels.lcorrect') }}...</strong> {{ __('labels.username_password_incorrect') }}</span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
        })
    </script>
</div>
