{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Assegna Testo a Operatore
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend/testi/{{ $text->id }}" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Annulla</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="card-header border-0 py-5 mb-2 px-0">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Dettagli Testo</span>
                                <span class="text-muted font-weight-bold font-size-sm"> {{ $text->name }}</span>
                            </h3>
                        </div>

                        <div class="row mb-6">

                            <div class="col-sm-12 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Nome Testo</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $text->name }}</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-9">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Testo</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $text->testo }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('message_warning'))
        <div class="alert alert-custom alert-notice alert-light-warning fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{{ session()->get('message_warning') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
                </button>
            </div>
        </div>
    @elseif(session()->has('message_success'))
        <div class="alert alert-custom alert-notice alert-light-success fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{{ session()->get('message_success') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
                </button>
            </div>
        </div>
    @elseif(session()->has('message_danger'))
        <div class="alert alert-custom alert-notice alert-light-danger fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{{ session()->get('message_danger') }}</div>
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
        <div class="col-lg-12">
            <form action="{{ route('testo_utenti.store') }}" method="POST" enctype="multipart/form-data" id="form_flow_text">
                <input type="hidden" id="text_id" name="text_id" value="{{ $text->id }}">
                @csrf
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Assegna Operatore
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" name="single" id="single" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Assegna Operatore </button>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="typeanswer_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta <span class="text-danger">*</span></label>
                                            <select multiple="multiple" class="form-control" name="users[]" id="users[]" style="min-height: 350px;">
                                                @foreach($operatori_typo as $operatore)
                                                    @if($typo_user->matchGroup($operatore->uidg) === FALSE)
                                                        <option value="" disabled class="bg-dark-o-25"> {{ $operatore->title }} </option>
                                                        @foreach($operatori_typo as $staff)
                                                            @if($typo_user->uidg_old === $staff->uidg)
                                                                <option value="{{ $staff->uid }}">{{ $staff->name .' - '. $staff->excel}} </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer justify-content-between">
                        <h6>ASSEGNAMENTO SINGOLO </h6>
                        <ul>
                            <li>
                                <p class="text-muted font-weight-bold font-size-sm mb-5">Per associare il testo ad un flusso <strong>specifico</strong> selezionare una scelta per ogni menù a tendina. E il testo verrà associato solo ad 1 Flusso</p>
                            </li>
                        </ul>

                        <h6>ASSEGNAMENTO MULTIPLO </h6>
                        <p class="text-muted font-weight-bold font-size-sm mb-2">Per effettuare un assegnamento multiplo procedere come segue: </p>
                        <ul>
                            <li>
                                <p class="text-muted font-weight-bold font-size-sm mb-2">per assegnare il testo a tutti i <span class="text-black-50">modelli ed i rispettivi canali e case assegnati</span> selezionare una scelta solo per il <span class="text-black-50">Tipo Risposta, Blocco e Sezione</span></p>
                            </li>
                            <li>
                                <p class="text-muted font-weight-bold font-size-sm mb-2">per assegnare il testo a tutti i <span class="text-black-50">canali e le rispettive case assegnate</span> selezionare una scelta solo per il <span class="text-black-50">Tipo Risposta, Modello, Blocco e Sezione</span></p>
                            </li>
                            <li>
                                <p class="text-muted font-weight-bold font-size-sm mb-2">per assegnare il testo a tutte le <span class="text-black-50">case</span> selezionare una scelta solo per il <span class="text-black-50">Tipo Risposta, Modello, Canale, Blocco e Sezione</span></p>
                            </li>
                        </ul>

                        <p class="text-muted font-weight-bold font-size-sm mb-2"><span class="text-black-50">N.B.:</span> Per l'assegnamento multiplo il Blocco e la Sezione saranno uguali per tutti i flussi. Sarà poi possibile effettuare la modifica tornando alla schermata per la modifica del testo e variare il blocco o la sezione del flusso specifico. </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script>
        FormValidation.formValidation(
            document.getElementById('form_flow_text'),
            {
                fields: {
                    users_id: {
                        validators: {
                            notEmpty: {
                                message: 'Selezionare almeno un operatore'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                }
            }
        );
    </script>
@endsection
