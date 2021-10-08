@extends('layouts.template')

@section('styles')
    <script src="https://cdn.tiny.cloud/1/ucpyfql9omtsyar93aialdqe7os76orkw8t2e5eutcwu83ue/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-3">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5 pb-1">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Info Cliente
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <!--begin::Item-->
                                <tr>
                                    <td class="font-weight-bold text-muted  align-middle pb-6">Cliente: </td>
                                    <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->header = preg_replace('/(\([a-zA-Z0-9\s]+\)\s?)/', '', $pren->header) }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-muted  align-middle pb-6">Nazionalità: </td>
                                    <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $country }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-muted  align-middle pb-6">eMail: </td>
                                    <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_t0_email }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-muted  align-middle pb-6">Telefono: </td>
                                    <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_t0_tel }}</td>
                                </tr>
                                <!--end::Item-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5 pb-1">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Info Prenotazione
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                            <!--begin::Item-->
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Data Prenot.: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_p_data_prenotazione }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Canale: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_t5_kross_cod_channel == 'BE' ? $pren->tx_mask_t5_kross_cod_channel.' (MAIL)' : $pren->tx_mask_t5_kross_cod_channel }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Data Arrivo: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_p_data_arrivo }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Data Partenza: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_p_data_partenza }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">N. Notti: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $days }}</td>
                            </tr>
                            <!--end::Item-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5 pb-1">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Info Prenotazione
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                            <!--begin::Item-->
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Ospiti Totali: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_p_tot_ospiti }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Under 12: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_p_under_12 ?: 0 }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Costo Totale: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ number_format($pren->tx_mask_t3_p_stay, 2, ",", ".") .' €'}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Documenti: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_doc_inviati == 0 ? 'Attesa' : 'Inviati' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Caparra: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $caparra  }}</td>
                            </tr>
                            <!--end::Item-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5 pb-1">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Info Check-In / Check-Out
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                            <!--begin::Item-->
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Proprietario: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $gestore }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Gestore Cliente: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $gestore_cliente  }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">CheckIn: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_p_data_arrivo }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">CheckOut: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_p_data_partenza }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted  align-middle pb-6">Note Operatore: </td>
                                <td class="font-size-lg font-weight-bolder text-right text-dark-75 align-middle w-150px pb-6">{{ $pren->tx_mask_t1_op_note  }}</td>
                            </tr>

                            <!--end::Item-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('threads.store') }}" method="POST" enctype="multipart/form-data" id="form_flow_text">
        <input type="hidden" id="pren_uid" name="pren_uid" value="{{ $pren->uid }}">
        <input type="hidden" id="site_uid" name="site_uid" value="{{ $site->uid }}">
        <input type="hidden" id="house_uid" name="house_uid" value="{{ $house_typo->uid }}">
        <input type="hidden" class="form-control" placeholder="Email" id="email_ccn" name="email_ccn" value="{!! $house_typo->tx_mask_t1_casa_gestore_email !!}">
        @csrf
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Scelta Flusso
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="row mb-6">
                                <div class="col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="language" class="text-muted font-weight-bolder font-size-lg">Lingua<span class="text-danger">*</span></label>
                                            <select class="form-control" name="language" id="language">
                                                <option value="" selected> Selezionare Lingua</option>
                                                @foreach($pren->languages as $language)
                                                    <option value="{{ $language }}" {{ $language == $pren->tx_mask_t0_lingua ? 'selected' : '' }}>{{ $language }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="typeanswer_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta <span class="text-danger">*</span></label>
                                            <select class="form-control" name="typeanswer_id" id="typeanswer_id">
                                                <option value="" selected> Selezionare Tipo Risposta</option>
                                                @foreach($typeanswers as $typeanswer)
                                                    <option value="{{ $typeanswer->typeanswer->id }}" data-id="{{ in_array($typeanswer->typeanswer->id, $typeanswers_id) ? $typeanswer->typeanswer->id : 0}}">{{ $typeanswer->typeanswer->name }} {{ in_array($typeanswer->typeanswer->id, $typeanswers_id) ? ' -> Già inviato' : '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="type_id" class="text-muted font-weight-bolder font-size-lg">Modello</label>
                                            <select class="form-control" name="type_id" id="type_id" disabled>
                                                <option value="" > Selezionare Modello</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark text-uppercase">
                                    Crea Risposta
                                </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>

                        <div class="card-toolbar">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="submit" name="mail" id="mail" class="btn btn-light-success font-weight-bolder font-size-sm py-3 px-6"> Invia Mail </button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-light-dark "><i class=" flaticon-refresh"></i></button>
                                <a href="/" class="btn btn-light-danger">Dashboard</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="row mb-6">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Da:</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Email" id="email_from" name="email_from" value="{!! $house_typo->tx_mask_t1_casa_gestore_email !!}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">A:</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Email" id="email_to" name="email_to" value="{!! $pren->tx_mask_t0_email !!}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Oggetto:</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Email" id="subject" name="subject" value="{!! $house_typo->header !!} - {!! $pren->header !!}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group" id="text_answer">
                                            <textarea name="risposta" id="risposta" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="files" name="files[]" multiple>
                                                <label class="custom-file-label" for="files">Scegli File</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5 pb-1">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Testi Secondari
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"> Non associati ai <strong>flussi</strong></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <ul class="nav nav-tabs nav-tabs-line pb-5">
                        @foreach($other_texts_by_priority as $text_priority)

                            <li class="nav-item" data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $text_priority->description }}">
                                <a class="nav-link text-uppercase {{ $text_priority->id == 1 ? 'active' : '' }}" data-toggle="tab" href="#tab-{{ $text_priority->id }}">{{ $text_priority->name }}</a>
                            </li>

                        @endforeach
                    </ul>
                    <div class="tab-content my-5" id="myTabContent">
                        @foreach($other_texts_by_priority as $text_priority)
                            <div class="tab-pane fade {{ $text_priority->id == 1 ? 'show active' : '' }}" id="tab-{{$text_priority->id}}" role="tabpanel" aria-labelledby="tab-{{$text_priority->id}}">
                                @foreach($text_priority->texts as $text)
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $text->id }}" class="btn btn-sm btn-light-primary mr-3 my-3 showText">
                                        <i class="flaticon-file"></i>{{ $text->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer justify-content-between">
                    <p class="text-muted font-weight-bold font-size-sm mb-2">
                        <span class="text-black-50">N.B.:</span>
                        Le categorie <strong>NON visualizzate</strong> nel menù non sono state assegnate ad alcun messaggio.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="ajaxModel" aria-hidden="true" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="example mb-10">
                        <div class="example-code">
                            <span class="example-copy" data-toggle="tooltip" title="" data-original-title="Copia Testo"></span>
                            <div class="example-highlight">
                                <p id="modalTesto"></p>
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <div class="example-code">
                            <span class="example-copy" data-toggle="tooltip" title="" data-original-title="Copy Text"></span>
                            <div class="example-highlight">
                                <p id="modalText"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>


@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $(document).on('change', '#typeanswer_id', function(){
                $('#type_id').html('');
                $('#type_id').prop("disabled", true);
                var typeanswer_id = $(this).val();
                var typeanswer_id_sended = $(this).find(':selected').data("id");
                var pren_uid = {{ $pren->uid }};
                var op="";

                if(typeanswer_id_sended == typeanswer_id){
                    var procedi = confirm("Mail già inviata per questo Tipo di Rispota! Si vuole procedere ugualmente?");
                }

                if(typeanswer_id_sended != typeanswer_id || procedi == true){
                    $.ajax({
                        method: 'get',
                        url: '{{route('flusso_testi.types_answer')}}',
                        data: {typeanswer_id:typeanswer_id, pren_uid:pren_uid},
                        success:function(types) {
                            op += '<option value="0" selected disabled>Scegli Modello</option>';
                            for(var i=0;i<types.length;i++){
                                op+='<option value="'+types[i].type.id+'">'+types[i].type.name+'</option>';
                            }

                            $('#type_id').append(op)
                            $('#type_id').prop("disabled", false);
                        },
                        error:function (data){
                            console.log('Error:', data);
                        }
                    });
                }


            });

            $(document).on('change', '#type_id', function(){
                var typeanswer_id = $('#typeanswer_id').val();
                var language = $('#language').val();
                var type_id = $(this).val();
                var pren_uid = {{ $pren->uid }};

                $.ajax({
                    method: 'get',
                    url: '{{route('threads.get_text')}}',
                    data: {typeanswer_id:typeanswer_id, language:language, type_id:type_id, pren_uid:pren_uid},
                    success:function(preview_text) {
                        // $.each(preview_text, function (key, val) {
                        //     text += '<p>'+ val.text.testo +'</p>'
                        // })

                        $('#risposta').html(preview_text);
                        tinymce.activeEditor.setContent(preview_text);

                    },
                    error:function (data){
                        console.log('Error:', data);
                    }
                });
            });
            var previous;

            $("#language").focus(function(){
                previous = this.value;
            }).change(function(){
                var language = $('#language').val();
                if(language != previous){
                    var typeanswer_id = $('#typeanswer_id').val();
                    var type_id = $('#type_id').val();
                    var pren_uid = {{ $pren->uid }};
                    $.ajax({
                        method: 'get',
                        url: '{{route('threads.get_text')}}',
                        data: {typeanswer_id:typeanswer_id, language:language, type_id:type_id, pren_uid:pren_uid},
                        success:function(preview_text) {
                            // $.each(preview_text, function (key, val) {
                            //     text += '<p>'+ val.text.testo +'</p>'
                            // })

                            $('#risposta').html(preview_text);
                            tinymce.activeEditor.setContent(preview_text);

                        },
                        error:function (data){
                            console.log('Error:', data);
                        }
                    });
                    previous = this.value;
                }
            });

            $("#refresh").on('click', function () {
                var language = $('#language').val();
                var risposta_old = tinymce.activeEditor.getContent();
                var pren_uid = {{ $pren->uid }};

                $.ajax({
                    method: 'get',
                    url: "{{ route('threads.refresh_text') }}",
                    data: {risposta_old:risposta_old, language:language, pren_uid:pren_uid},
                    success: function (refreshed_text) {
                        tinymce.activeEditor.setContent(refreshed_text);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            tinymce.init({
                selector: '#risposta',
                oninit : "setPlainText",
                plugins:'lists advlist link autoresize code paste',
                autoresize_on_init: true,
                toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link code',
                autoresize_bottom_margin: 50,
                menubar: false,
                statusbar: false,
                icons: 'material',
                content_style:
                    "@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap'); body { font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 400; line-height:1.6; }"
            });

            $('body').on('click', '.showText', function () {
                var text_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "/testi/getText/" + text_id,
                    dataType: 'json',
                    success: function (data) {
                        $('#modelHeading').html("Modifica" + data.name);
                        $('#ajaxModel').modal('show');
                        $("#text_id").val(data.id);
                        $("#modalTesto").html(data.testo);
                        $("#modalText").html(data.text);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script>


    </script>
@endsection
