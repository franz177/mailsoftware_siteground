{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <form action="/backend/banca/{{ $bank->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">
                                <div class="symbol symbol-40 symbol- mr-5">
                                    <span class="symbol-label">
                                        {{ substr($bank->name, 0, 2) }}
                                    </span>
                                </div>
                                {{ $bank->name .' - ' . $bank->beneficiario }}
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Aggiorna </button>
                            <a href="/backend/banca/{{ $bank->id }}" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Annulla</a>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="card-header border-0 py-5 mb-2 px-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Dati Variabili</span>
                                    <span class="text-muted font-weight-bold font-size-sm"> DB interno</span>
                                </h3>
                            </div>

                            <div class="row mb-6">
                            <!--begin::Info-->

                                <div class="col-sm-12 col-md-3">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="name" class="text-muted font-weight-bolder font-size-lg">Name</label>
                                            <input class="form-control" type="text" value="{{ $bank->name }}" id="name" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="nome_banca" class="text-muted font-weight-bolder font-size-lg">Nome Banca</label>
                                            <input class="form-control" type="text" value="{{ $bank->nome_banca }}" id="nome_banca" name="nome_banca">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="beneficiario" class="text-muted font-weight-bolder font-size-lg">Beneficiario</label>
                                            <input class="form-control" type="text" value="{{ $bank->beneficiario }}" id="beneficiario" name="beneficiario">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="indirizzo" class="text-muted font-weight-bolder font-size-lg">Indirizzo</label>
                                            <input class="form-control" type="text" value="{{ $bank->indirizzo }}" id="indirizzo" name="indirizzo">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="bic" class="text-muted font-weight-bolder font-size-lg">BIC</label>
                                            <input class="form-control" type="text" value="{{ $bank->bic }}" id="bic" name="bic">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="swift" class="text-muted font-weight-bolder font-size-lg">SWIFT</label>
                                            <input class="form-control" type="text" value="{{ $bank->swift }}" id="swift" name="swift">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="iban" class="text-muted font-weight-bolder font-size-lg">IBAN</label>
                                            <input class="form-control" type="text" value="{{ $bank->iban }}" id="iban" name="iban">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="causale" class="text-muted font-weight-bolder font-size-lg">Causale</label>
                                            <input class="form-control" type="text" value="{{ $bank->causale }}" id="causale" name="causale">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
