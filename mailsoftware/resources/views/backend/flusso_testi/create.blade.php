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
                                Assegna Testo a flusso
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
        <div class="col-lg-6">
            <form action="{{ route('flusso_testi.store') }}" method="POST" enctype="multipart/form-data" id="form_flow_text">
                <input type="hidden" id="text_id" name="text_id" value="{{ $text->id }}">
                @csrf
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Assegna Flusso/i
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" name="single" id="single" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Crea Flusso </button>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="typeanswer_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta <span class="text-danger">*</span></label>
                                            <select class="form-control dynamic" name="typeanswer_id" id="typeanswer_id">
                                                <option value="" selected> Selezionare Tipo Risposta</option>
                                                @foreach($typeanswers as $typeanswer)
                                                    <option value="{{ $typeanswer->id }}">{{ $typeanswer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="type_id" class="text-muted font-weight-bolder font-size-lg">Modello</label>
                                            <select class="form-control dynamic" name="type_id" id="type_id">
                                                <option value="" disabled> Selezionare Modello</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="block_id" class="text-muted font-weight-bolder font-size-lg">Blocco <span class="text-danger">*</span></label>
                                            <select class="form-control dynamic" name="block_id" id="block_id">
                                                <option value=""> Selezionare Blocco</option>
                                                @foreach($blocks as $block)
                                                    <option value="{{ $block->id }}">{{ $block->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="section_id" class="text-muted font-weight-bolder font-size-lg">Sezione <span class="text-danger">*</span></label>
                                            <select class="form-control dynamic" name="section_id" id="section_id">
                                                <option value="" selected> Selezionare Sezione</option>
                                                @foreach($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="site_uid" class="text-muted font-weight-bolder font-size-lg">Siti</label>
                                            <select multiple="multiple" class="form-control" id="site_uid" name="site_uid[]" style="min-height: 190px;">
                                                @foreach($sites as $site)
                                                    <option value="{{ $site->uid }}">{{ $site->sito . ' ' . $site->header }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="house_uid" class="text-muted font-weight-bolder font-size-lg">Case</label>
                                            <select multiple="multiple" class="form-control" id="house_uid" name="house_uid[]" style="min-height: 190px;">
                                                @foreach($houses as $house)
                                                    <option value="{{ $house->uid }}">{{ $house->name }}</option>
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
        <div class="col-lg-6">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Preview Testo
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                <tbody id="preview_text">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        $(document).ready(function(){

            var turn = $('input#turn').attr('value');
            turn = parseInt(turn);

            if(turn != 0){
                $('#type_id').prop("disabled", true);
                $('#site_uid').prop("disabled", true);
                $('#house_uid').prop("disabled", true);
            }

            $(document).on('change', '#typeanswer_id', function(){
                var typeanswer_id = $(this).val();
                var op=" ";

                $.ajax({
                    method: 'get',
                    url: '{{route('flusso_testi.types')}}',
                    data: {typeanswer_id:typeanswer_id},
                    success:function(types) {
                        // console.log('success');
                        // console.log(typeanswer_id);
                        // console.log(types);

                        op += '<option value="0" selected disabled>Scegli Modello</option>';
                        for(var i=0;i<types.length;i++){
                            op+='<option value="'+types[i].id+'">'+types[i].name+'</option>';
                        }

                        $('#type_id').prop("disabled", false);
                        $('#type_id').html(op)


                    },
                    error:function (){

                    }
                });
            });

            $(document).on('change', '#type_id', function(){
                var typeanswer_id = $('#typeanswer_id').val();
                var type_id = $(this).val();

                $.ajax({
                    method: 'get',
                    url: '{{route('flusso_testi.preview_text')}}',
                    data: {typeanswer_id:typeanswer_id, type_id:type_id},
                    success:function(preview_text) {
                        $('#preview_text').html("");
                        $.each(preview_text, function (key, val) {
                            $('#preview_text').append(
                                '<tr>'+
                                    '<td class="text-uppercase">'+val.block.name+'</td>'+
                                    '<td class="text-uppercase">'+val.section.name+'</td>'+
                                    '<td>'+val.text.testo+'</td>'+
                                '</tr>'

                            )
                        })
                    },
                    error:function (){

                    }
                });

                var op=" ";

                $.ajax({
                    method: 'get',
                    url: '{{route('flusso_testi.sites')}}',
                    data: {typeanswer_id:typeanswer_id, type_id:type_id},
                    success:function(sites) {
                        for(var i=0;i<sites.length;i++){
                            op+='<option value="'+sites[i].uid+'">'+sites[i].name+' '+sites[i].percentuale +'%</option>';
                        }

                        $('#site_uid').prop("disabled", false);
                        $('#site_uid').html(op)


                    },
                    error:function (){

                    }
                });

            });

            $(document).on('change', '#site_uid', function(){
                var typeanswer_id = $('#typeanswer_id').val();
                var type_id = $('#type_id').val();
                var site_uid = $(this).val();

                $('#house_uid').prop("disabled", false);


            });

        });
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script>
        FormValidation.formValidation(
            document.getElementById('form_flow_text'),
            {
                fields: {
                    typeanswer_id: {
                        validators: {
                            notEmpty: {
                                message: 'Tipo Risposta richiesto'
                            }
                        }
                    },
                    block_id: {
                        validators: {
                            notEmpty: {
                                message: 'Blocco richiesto'
                            }
                        }
                    },
                    section_id: {
                        validators: {
                            notEmpty: {
                                message: 'Sezione richiesta'
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
