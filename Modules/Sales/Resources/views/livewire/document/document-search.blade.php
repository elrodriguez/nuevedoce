<div>
    <div class="page-wrapper auth">
        <div class="page-inner bg-brand-gradient">
            <div class="page-content-wrapper bg-transparent m-0">
                <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                    <div class="d-flex align-items-center container p-0">
                        <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                @if($company)
                                    @if(file_exists(public_path('storage/'.$company->logo)))
                                        <img src="{{ url('storage/'.$company->logo) }}" alt="{{ config('app.name', 'Laravel') }}" aria-roledescription="logo">
                                    @endif
                                    <span class="page-logo-text mr-1">{{ $company->name }}</span>
                                @else
                                    <img src="{{ url('themes/smart-admin/img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" aria-roledescription="logo">
                                    <span class="page-logo-text mr-1">{{ config('app.name', 'Laravel') }}</span>
                                @endif
                            </a>
                        </div>
                        {{-- <span class="text-white opacity-50 ml-auto mr-2 hidden-sm-down">
                            Already a member?
                        </span>
                        <a href="page_login.html" class="btn-link text-white ml-auto ml-sm-0">
                            Secure Login
                        </a> --}}
                    </div>
                </div>
                <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                    Buscar comprobante electrónico
                                    <small class="h3 fw-300 mt-3 mb-5 text-white opacity-70 hidden-sm-down">
                                        Todos los campos son <strong>requeridos</strong> *.
                                    </small>
                                </h2>
                            </div>
                            <div class="col-xl-6 ml-auto mr-auto">
                                <div class="card rounded-plus bg-faded">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-12 col-md-4 mb-3">
                                                <label class="form-label" for="document_type_id">{{ __('labels.document_type') }} <span class="text-danger">*</span> </label>
                                                <select wire:model.defer="document_type_id" class="custom-select">
                                                    <option value="">{{ __('labels.to_select') }}</option>
                                                    @foreach ($document_types as $document_type)
                                                    <option value="{{ $document_type->id }}">{{ $document_type->description }}</option>
                                                    @endforeach
                                                </select>
                                                @error('document_type_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-2 mb-3">
                                                <label class="form-label" for="serie">{{ __('labels.serie') }} <span class="text-danger">*</span> </label>
                                                <input wire:model.defer="serie" type="text" class="form-control" />
                                                @error('serie')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-3 mb-3">
                                                <label class="form-label" for="number">{{ __('labels.number') }} <span class="text-danger">*</span> </label>
                                                <input wire:model.defer="number" type="text" class="form-control" />
                                                @error('number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-3 mb-3">
                                                <label class="form-label" for="date_of_issue">{{ __('labels.broadcast_date') }} <span class="text-danger">*</span> </label>
                                                <input wire:model.defer="date_of_issue" type="text" class="form-control" id="date_of_issue" onchange="this.dispatchEvent(new InputEvent('input'))" />
                                                @error('date_of_issue')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-4 mb-3">
                                                <label class="form-label" for="document_type_id">Número cliente (RUC/DNI)<span class="text-danger">*</span> </label>
                                                <input wire:model.defer="customer_number" type="text" class="form-control" />
                                            </div>
                                            <div class="col-12 col-md-2 mb-3">
                                                <label class="form-label" for="total">Monto Total<span class="text-danger">*</span> </label>
                                                <input wire:model.defer="total" type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted d-flex flex-row" style="border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
                                        <button wire:click="search" wire:loading.attr="disabled" type="button" class="btn btn-primary ml-auto waves-effect waves-themed">
                                            <i class="fal fa-file-search mr-1"></i>{{ __('labels.search') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                        {{ \Carbon\Carbon::now()->format('Y') }} © {{ env('APP_NAME', 'Laravel') }} by&nbsp;<a href='{{ env('DEVELOPER_GITHUB', 'Laravel') }}' class='text-white opacity-40 fw-500' title='{{ env('DEVELOPER_NAME', 'Laravel') }}' target='_blank'>{{ env('DEVELOPER_NAME', 'Laravel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalprintDocument" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Descargar Archivos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row js-list-filter">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center mb-g">
                            <a type="button" href="{{ route('download_sale_document_public',['sales','pdf',$filename]) }}" class="rounded bg-white p-0 m-0 d-flex flex-column w-100 h-100 js-showcase-icon shadow-hover-2">
                                <div class="rounded-top color-fusion-300 w-100 bg-primary-300">
                                    <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-3x hover-bg">
                                        <i class="fal fa-file-pdf"></i>
                                    </div>
                                </div>
                                <div class="rounded-bottom p-1 w-100 d-flex justify-content-center align-items-center text-center">
                                    <span class="d-block text-truncate text-muted">PDF</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center mb-g">
                            <a type="button" href="{{ route('download_sale_document_public',['sales','xml',$filename]) }}" class="rounded bg-white p-0 m-0 d-flex flex-column w-100 h-100 js-showcase-icon shadow-hover-2">
                                <div class="rounded-top color-fusion-300 w-100 bg-primary-300">
                                    <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-3x hover-bg">
                                        <i class="fal fa-file-code"></i>
                                    </div>
                                </div>
                                <div class="rounded-bottom p-1 w-100 d-flex justify-content-center align-items-center text-center">
                                    <span class="d-block text-truncate text-muted">XML</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('labels.close') }}</button>
                </div-->
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('sal-response_success_document_modal', event => {
           $('#exampleModalprintDocument').modal('show')
        });
        document.addEventListener('livewire:load', function () {
            $("#date_of_issue").datepicker({
                format: 'dd/mm/yyyy',
                language:"{{ app()->getLocale() }}",
                autoclose:true
            }).datepicker('setDate','0');
        });
    </script>
</div>
