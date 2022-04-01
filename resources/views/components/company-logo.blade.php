<div class="page-logo">
    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
        @if($this->company)
            @if(file_exists(public_path('storage/'.$this->company->logo)))
                <img src="{{ url('storage/'.$this->company->logo) }}" alt="{{ config('app.name', 'Laravel') }}" aria-roledescription="logo">
            @endif
            <span class="page-logo-text mr-1">{{ $this->company->name }}</span>
        @else
            <img src="{{ url('themes/smart-admin/img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" aria-roledescription="logo">
            <span class="page-logo-text mr-1">{{ config('app.name', 'Laravel') }}</span>
        @endif
        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
        <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
    </a>
</div>