<x-base-layout>
    @section('content')
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper alt">
            <!-- BEGIN Page Content -->
            <!-- the #js-page-content id is needed for some plugins to initialize -->
            <main id="js-page-content" role="main" class="page-content">
                <div class="h-alt-f d-flex flex-column align-items-center justify-content-center text-center">
                    <h1 class="page-error color-fusion-500">
                        ERROR <span class="text-gradient">500</span>
                        <small class="fw-500">
                            ¡Algo <u>salió</u> mal!
                        </small>
                    </h1>
                    <h3 class="fw-500 mb-5">
                        Ha experimentado un error técnico. Pedimos disculpas.
                    </h3>
                    <h4>
                        Estamos trabajando arduamente para corregir este problema. Espere unos momentos y vuelva a intentar la búsqueda.
                        <br>Mientras tanto, consulte las novedades de {{ env('APP_NAME') }} WebApp:
                    </h4>
                    <div class="mt-4">
                        <a href="javascript:history.back()" class="btn btn-outline-default bg-fusion-800 waves-effect waves-themed">
                            <span class="fw-700">{{ __('labels.back') }}</span>
                        </a>
                        {{-- <a href="#" class="btn btn-primary waves-effect waves-themed">
                            <span class="fw-700">Continue</span>
                        </a> --}}
                    </div>
                </div>
            </main>
            <!-- END Page Content -->
        </div>

    @stop
</x-base-layout>
