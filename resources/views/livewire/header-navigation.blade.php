<div class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{ url('themes/smart-admin/img/logo.png') }}" alt="SmartAdmin WebApp" aria-roledescription="logo">
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
            @if(file_exists(public_path('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png')))
            <img src="{{ asset('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png') }}" style="width:32px;height: 32px;" class="profile-image rounded-circle" alt="{{ auth()->user()->name }}">
            @else
            <img src="{{ ui_avatars_url(auth()->user()->name,32,'none') }}" style="width:32px;height: 32px;" class="profile-image rounded-circle" alt="{{ auth()->user()->name }}">
            @endif
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2">
                            @if(file_exists(public_path('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png')))
                            <img src="{{ asset('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png') }}" style="width:50px;height: 50px;" class="rounded-circle profile-image" alt="{{ auth()->user()->name }}">
                            @else
                            <img src="{{ ui_avatars_url(auth()->user()->name,50,'none') }}" style="width:50px;height: 50px;" class="rounded-circle profile-image" alt="{{ auth()->user()->name }}">
                            @endif
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg">{{ auth()->user()->name }}</div>
                            <span class="text-truncate text-truncate-md opacity-80">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider m-0"></div>
                <a data-toggle="modal" data-target="#modalProfile" href="javascript:void(0)" class="dropdown-item">
                    <span>{{ __('labels.user_data') }}</span>
                </a>
                {{--<a href="#" class="dropdown-item" data-action="app-reset">
                    <span data-i18n="drpdwn.reset_layout">Reset Layout</span>
                </a>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                    <span data-i18n="drpdwn.settings">Settings</span>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a href="#" class="dropdown-item" data-action="app-fullscreen">
                    <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                    <i class="float-right text-muted fw-n">F11</i>
                </a>
                <a href="#" class="dropdown-item" data-action="app-print">
                    <span data-i18n="drpdwn.print">Print</span>
                    <i class="float-right text-muted fw-n">Ctrl + P</i>
                </a> --}}
                {{-- <div class="dropdown-multilevel dropdown-multilevel-left">
                    <div class="dropdown-item">
                        Language
                    </div>
                    <div class="dropdown-menu">
                        <a href="#?lang=fr" class="dropdown-item" data-action="lang" data-lang="fr">Français</a>
                        <a href="#?lang=en" class="dropdown-item active" data-action="lang" data-lang="en">English (US)</a>
                        <a href="#?lang=es" class="dropdown-item" data-action="lang" data-lang="es">Español</a>
                        <a href="#?lang=ru" class="dropdown-item" data-action="lang" data-lang="ru">Русский язык</a>
                        <a href="#?lang=jp" class="dropdown-item" data-action="lang" data-lang="jp">日本語</a>
                        <a href="#?lang=ch" class="dropdown-item" data-action="lang" data-lang="ch">中文</a>
                    </div>
                </div> --}}
                <div class="dropdown-divider m-0"></div>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none">@csrf</form>
                <a class="dropdown-item fw-500 pt-3 pb-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span data-i18n="drpdwn.page-logout">@lang('buttons.logout')</span>
                    <span class="float-right fw-n">&commat;{{ config('app.name', 'Laravel') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
