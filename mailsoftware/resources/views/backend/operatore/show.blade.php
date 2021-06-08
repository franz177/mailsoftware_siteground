{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">
                            <div class="symbol symbol-40 symbol- mr-5">
                                <span class="symbol-label">
                                    {{ substr($operatore_typo->nominativo, 0, 1) }}
                                </span>
                            </div>
                            {{ $operatore_typo->nominativo }}
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"> | {{ $operatore_typo->gruppo }}</span>
                        </span>

                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend/operatore" class="btn btn-light-primary btn-sm font-weight-bolder font-size-sm py-3 px-6">Elenco</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Dati Fissi</span>
                            <span class="text-muted font-weight-bold font-size-sm">Provenienti da DB <strong>NewtVisions</strong></span>
                        </h3>
                        <div class="row mb-6">
                            <!--begin::Info-->

                            <div class="col-sm-12 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Nome Abb.</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $operatore_typo->name }}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Telefono</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $operatore_typo->telephone }}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Email</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $operatore_typo->email }}</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Cod. Op. Excel</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $operatore_typo->excel }}</span>
                                </div>
                            </div>

                            <!--end::Info-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-custom alert-notice alert-light-success fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{{ session()->get('message') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="ki ki-close"></i>
                    </span>
                </button>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column"  style="display: inline;">
                        <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3"> Dati Variabili </span>
                        <span class="text-muted font-weight-bold font-size-sm">DB interno</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend/operatore/{{ $operatore_typo->uid }}/edit" class="btn btn-light-info btn-sm font-weight-bolder font-size-sm py-3 px-6">Edit</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="row mb-6">
                            <!--begin::Info-->

                            <div class="col-sm-12 col-md-2">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Città Assegnate</span>
                                    <span class="text-dark font-weight-bold mb-4">
                                        {{ count($operatore->cities) > 0 ? $operatore->cities->pluck('city')->implode(', ') : 'Nessuna Città Assegnata' }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Sesso</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $operatore->gender_list[$operatore->gender] }}</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Transfer Aeroporto</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $operatore->transfer_list[$operatore->transfer] }}</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Dalle ore</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $operatore->dalle }}</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Alle ore</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $operatore->alle }}</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Costo</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $operatore->debit }} €</span>
                                </div>
                            </div>

                            <!--end::Info-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
