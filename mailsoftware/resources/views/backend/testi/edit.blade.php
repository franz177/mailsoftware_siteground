{{-- Extends layout --}}
@extends('backend.default')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
    <script src="https://cdn.tiny.cloud/1/ucpyfql9omtsyar93aialdqe7os76orkw8t2e5eutcwu83ue/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

{{-- Content --}}
@section('content')
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
            <form action="/backend/testi/{{ $text->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">
                                <div class="symbol symbol-40 symbol- mr-5">
                                    <span class="symbol-label">
                                        {{ substr($text->name, 0, 2) }}
                                    </span>
                                </div>
                                {{ $text->name }}
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <div class="dropdown mr-3">
                                <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-ver"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="/backend/flusso_testi/create/{{ $text->id }}" class="dropdown-item"><img src="{{ asset('/media/svg/icons/Navigation/Plus.svg') }}"/> Assegna Flusso </a>
                                    <a href="/backend/testo_utenti/create/{{ $text->id }}" class="dropdown-item"><img src="{{ asset('/media/svg/icons/Navigation/Plus.svg') }}"/> Assegna Utenti </a>
                                    <a href="/backend/flusso_testi" class="dropdown-item">Elenco Testi</a>
                                    <a href="/backend/testi" class="dropdown-item">Elenco Testi Non assegnati</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 "> Aggiorna </button>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="row mb-6">
                                <!--begin::Info-->

                                <div class="col-sm-12 col-md-8">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="name" class="text-muted font-weight-bolder font-size-lg">Nome Testo</label>
                                            <input class="form-control" type="text" value="{{ $text->name }}" id="name" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="priority_id" class="text-muted font-weight-bolder font-size-lg">Priorità</label>
                                            <select class="form-control" name="priority_id" id="priority_id">
                                                @foreach($priorities as $priority)
                                                    <option value="{{ $priority->id }}" {{ $text->priority_id == $priority->id ? 'selected' : '' }}>{{ $priority->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="testo" class="text-muted font-weight-bolder font-size-lg">Testo [IT]</label>
                                            <textarea name="testo" id="testo" class="form-control">{!! $text->testo !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="text" class="text-muted font-weight-bolder font-size-lg">Testo [EN]</label>
                                            <textarea name="text" id="text" class="form-control">{!! $text->text !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!--end::Info-->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(session()->has('message_warning'))
        <div class="alert alert-custom alert-notice alert-light-warning fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{!! session()->get('message_warning') !!}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
                </button>
            </div>
        </div>
    @endif
    @if(session()->has('message_success'))
        <div class="alert alert-custom alert-notice alert-light-success fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{!! session()->get('message_success') !!}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
                </button>
            </div>
        </div>
    @endif
    <div id="success-alert" class="alert alert-custom alert-notice alert-light-success fade mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text" id="message_success"></div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
            </button>
        </div>
    </div>
    <div id="deleted-alert" class="alert alert-custom alert-notice alert-light-danger fade mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text" id="message_delete"></div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
            </button>
        </div>
    </div>


    <div class="row" id="flow_text">
        <div class="col-lg-12 col-xxl-12">

            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Elenco flussi assegnati
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend/flusso_testi/create/{{ $text->id }}" class="btn btn-light-warning btn-sm font-weight-bolder font-size-sm py-3 px-6">Aggiungi</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pb-15">
                    <div class="tab-content">
                        <!--begin::Table-->

                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_15">
                                <thead>
                                    <tr class="text-left text-uppercase">
                                        <th></th>
                                        <th class="text-left ">Tipo Risposta</th>
                                        <th class="text-left">Modello</th>
                                        <th class="text-left">Sito</th>
                                        <th class="text-left">Casa</th>
                                        <th class="text-left" >Blocco</th>
                                        <th class="text-left" >Sezione</th>
                                        <th class="text-center">Azioni</th>
                                        <th class="text-left none">TR_sorting</th>
                                        <th class="text-left none">MD_sorting</th>
                                        <th class="text-left none">flow_text_id</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Body-->
            </div>

        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="ajaxModel" aria-hidden="true" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/backend/testi/{{ $text->id }}" id="flowTextForm" name="flowTextForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <input type="hidden" name="flow_text_id" id="flow_text_id">
                        <div class="row mb-6">
                            <div class="col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="typeanswer_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta <span class="text-danger">*</span></label>
                                        <select class="form-control dynamic" name="typeanswer_id" id="typeanswer_id" disabled>
                                            @foreach($typeanswers as $typeanswer)
                                                <option value="{{ $typeanswer->id }}">{{ $typeanswer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="type_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta <span class="text-danger">*</span></label>
                                        <select class="form-control dynamic" name="type_id" id="type_id" disabled>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
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

                            <div class="col-md-2">
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
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary font-weight-bold" id="saveBtn" value="edit">Salva Modifiche</button>
                </div>
            </div>
        </div>
    </div>



@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables/datatables.js') }}" type="text/javascript"></script>

    <script>

        $(document).ready(function(){
            // Class definition
            tinymce.init({
                selector: '#testo',
                plugins:'lists advlist link code',
                toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link code',
                menubar: false,
                statusbar: false,
                icons: 'material',
                height: 300,
            });

            tinymce.init({
                selector: '#text',
                plugins:'lists advlist link code',
                toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link code',
                menubar: false,
                statusbar: false,
                icons: 'material',
                height: 300,

            });

            $("#success-alert").hide()
            $("#deleted-alert").hide()

            var table = $('#sample_15');
            // $("#sample_15 tbody").html(table_data);

            var text_id = {!! $text->id !!};
            var oTable =table.DataTable({
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": attivare per ordinare la colonna in ordine crescente",
                        "sortDescending": ": attivare per ordinare la colonna decrescente"
                    },
                    "emptyTable": "Nessun dato trovato nella Tabella",
                    "info": "Visualizzati da _START_ a _END_ di _TOTAL_ record",
                    "infoEmpty": "Nessuna voce trovata",
                    "infoFiltered": "(Filtrato 1 di _MAX_ record totali)",
                    "lengthMenu": "_MENU_ Righe",
                    "search": "Cerca:",
                    "zeroRecords": "Nessuna corrispondenza trovata"
                },
                processing: true,
                serverSide: true,

                ajax: {
                    url:"{{ route('flusso_testi.getFlussiTesto') }}",
                    data: {text_id:text_id},
                },

                columns: [
                    {
                        "className":      '',
                        "orderable":      false,
                        "searchable":     false,
                        "data":           null,
                        "defaultContent": '',
                        "cellType": "th"
                    },
                    {data: 'tiporisposta', name: 'flow.typeanswer.name'},
                    {data: 'modello', name: 'flow.type.name'},
                    {data: 'flow.site_uid', name: 'Sito',searchable: false,
                        render: function (data, type, row)
                        {
                            var sites = {!! $sites !!};
                            return sites[data];
                        }
                    },
                    {data: "flow.house_uid", name: 'Casa',searchable: false,
                        render: function (data, type, row)
                        {
                            var houses = {!! $houses !!};
                            return houses[data];
                        }

                    },
                    {data: 'block.name', name: 'Blocco',searchable: false},
                    {data: 'section.name', name: 'Sezione',searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'flow.typeanswer.sorting', name: 'TR_sorting', searchable: false},
                    {data: 'flow.type.sorting', name: 'MD_sorting', searchable: false},
                    {data: 'id', name: 'flow_text_id', searchable: false},
                ],

                buttons: [
                    // { extend: 'print', className: 'btn dark btn-outline' },
                    // { extend: 'pdf', className: 'btn green btn-outline' },
                    // { extend: 'excel', className: 'btn purple btn-outline ' }
                ],

                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [
                    { className: 'control', orderable: false, targets:   0 },
                    { width: '15%', targets: 1},
                    { width: '15%', targets: 2},
                    { width: '5%', targets: 3},
                    { width: '30%', targets: 4},
                    { width: '10%', targets: 5, orderable: false},
                    { width: '10%', targets: 6, orderable: false},
                    { width: '10%', targets: 7, orderable: false}

                ],

                order: [
                ],

                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 10,

                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            });

            var token = '{{csrf_token()}}';

            $('body').on('click', '.editFlowText', function () {
                var flow_text_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('flusso_testi.edit') }}",
                    data: {_method:'POST', _token:token, flow_text_id:flow_text_id},
                    success: function (flow_text) {
                        $('#modelHeading').html("Edit Flusso Testo");
                        $('#saveBtn').val("edit-book");
                        $('#ajaxModel').modal('show');
                        $('#flow_text_id').val(flow_text.id);
                        $("#typeanswer_id option[value=" + flow_text.flow.typeanswer.id +"]").attr("selected","selected");
                        $("#type_id option[value=" + flow_text.flow.type.id +"]").attr("selected","selected");
                        $("#block_id option[value=" + flow_text.block.id +"]").attr("selected","selected");
                        $("#section_id option[value=" + flow_text.section.id +"]").attr("selected","selected");

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Save');

                var flow_text_id = $('#flow_text_id').val();
                var block_id = $('#block_id').val()
                var section_id = $('#section_id').val()

                $.ajax({
                    url: "{{ route('flusso_testi.update') }}",
                    type: "POST",
                    dataType: 'json',
                    data: { _method:'POST', _token:token, flow_text_id:flow_text_id, block_id:block_id, section_id:section_id},
                    success: function (data) {

                        $('#flowTextForm').trigger("reset");
                        $('#ajaxModel').modal('hide');

                        $('#message_success').html(data.message_success);
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#success-alert").slideUp(500);
                        });

                        oTable.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteFlowText', function () {

                var flow_text_id = $(this).data("id");
                var text_id = {!! $text->id !!};

                confirm("Si vuole procedere all'eliminazione del flusso selezionato?");
                $.ajax({
                    type: "POST",
                    url: "{{ route('flusso_testi.destroy') }}",
                    data: { _method:'DELETE', _token:token, flow_text_id:flow_text_id, text_id:text_id},
                    success: function (data) {
                        $('#message_delete').html(data.message_delete);
                        $("#deleted-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#deleted-alert").slideUp(500);
                        });
                        oTable.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });


        });
    </script>

@endsection
