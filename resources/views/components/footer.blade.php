<footer class="page-footer" role="contentinfo">
    <div class="d-flex align-items-center flex-1 text-muted">
        <span class="hidden-md-down fw-700">2020 © {{ $company->name }} by&nbsp;<a href='{{ env('DEV_LINK') }}' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>{{ env('DEV_NAME') }}</a></span>
    </div>
    <div>
        <ul class="list-table m-0">
            <li><a href="intel_introduction.html" class="text-secondary fw-700">{{ __('labels.about') }}</a></li>
            <li class="pl-3"><a href="info_app_licensing.html" class="text-secondary fw-700">{{ __('labels.license') }}</a></li>
            <li class="pl-3"><a href="info_app_docs.html" class="text-secondary fw-700">{{ __('labels.documentation') }}</a></li>
            <li class="pl-3 fs-xl"><a href="{{ env('DEV_SALE_LINK') }}" class="text-secondary" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</footer>