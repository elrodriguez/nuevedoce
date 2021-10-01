<div class="info-card">
    @if(file_exists(public_path('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png')))
    <img src="{{ asset('storage/person/'.auth()->user()->person_id.'/'.auth()->user()->person_id.'.png') }}" class="profile-image rounded-circle" alt="{{ auth()->user()->name }}">
    @else
    <img src="{{ ui_avatars_url(auth()->user()->name,50,'none') }}" class="profile-image rounded-circle" alt="{{ auth()->user()->name }}">
    @endif
    <div class="info-card-text">
        <a href="#" class="d-flex align-items-center text-white">
            <span class="text-truncate text-truncate-sm d-inline-block">
                {{ auth()->user()->name }}
            </span>
        </a>
        <span class="d-inline-block text-truncate text-truncate-sm">{{ auth()->user()->email }}</span>
    </div>
    <img src="{{ url('themes/smart-admin/img/card-backgrounds/cover-2-lg.png') }}" class="cover" alt="cover">
    <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
        <i class="fal fa-angle-down"></i>
    </a>
</div>