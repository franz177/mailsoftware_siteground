{{-- Extends layout --}}
@extends('backend.default')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
@endsection

{{-- Content --}}
@section('content')
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
    <div id="update-alert" class="alert alert-custom alert-notice alert-light-warning fade mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text" id="message_update"></div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
            </button>
        </div>
    </div>
    <div id="destroy-alert" class="alert alert-custom alert-notice alert-light-danger fade mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text" id="message_destroy"></div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xxl-12">

            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Priorità</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Totale {{ count($priorities) }} Priorità</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm font-weight-bolder font-size-sm py-3 px-6" id="createNewPriority" name="createNewPriority">Aggiungi <img src="{{ asset('/media/svg/icons/Navigation/Plus.svg') }}"/></a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_15">
                                <thead>
                                    <tr class="text-left text-uppercase">
                                        <th></th>
                                        <th class="all">Nome</th>
                                        <th class="all">Descrizione</th>
                                        <th class="all">Azioni</th>
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
                    <form id="priorityForm" name="priorityForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="priority_id" id="priority_id">
                        <div class="row mb-6">

                            <div class="col-sm-12 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="name" class="text-muted font-weight-bolder font-size-lg">Nome</label>
                                        <input class="form-control" type="text" value="" id="name" name="name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-8">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="description" class="text-muted font-weight-bolder font-size-lg">Descrizione</label>
                                        <input class="form-control" type="text" value="" id="description" name="description">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary font-weight-bold" id="saveBtn" value="create">Salva</button>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables/datatables.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $("#success-alert").hide();
            $("#update-alert").hide();
            $("#destroy-alert").hide()

            $('#createNewPriority').click(function () {
                $('#saveBtn').val("create-priority");
                $('#book_id').val('');
                $('#priorityForm').trigger("reset");
                $('#modelHeading').html("Crea Nuova Priorità");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editPriority', function () {
                var priority_id = $(this).data('id');
                $.get("{{ route('priorities.index') }}" +'/' + priority_id +'/edit', function (data) {
                    $('#modelHeading').html("Modifica Priorità");
                    $('#saveBtn').val("edit-priority");
                    $('#ajaxModel').modal('show');
                    $("#priority_id").val(data.id);
                    $("#name").val(data.name);
                    $("#description").val(data.description);

                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Save');

                if($(this).val() === "create-priority"){
                    $.ajax({
                        data: $('#priorityForm').serialize(),
                        url: "{{ route('priorities.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {

                            $('#priorityForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            oTable.draw();

                            $('#message_success').html(data.message_success);
                            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                                $("#success-alert").slideUp(500);
                            });

                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Save Changes');
                        }
                    });
                }

                if($(this).val() === "edit-priority"){
                    var priority_id = $('#priority_id').val();
                    $.ajax({
                        url: "/backend/priorities/" + priority_id,
                        data: $('#priorityForm').serialize(),
                        type: "PUT",
                        dataType: 'json',
                        success: function (data) {

                            $('#priorityForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            oTable.draw();

                            $('#message_update').html(data.message_update);
                            $("#update-alert").fadeTo(2000, 500).slideUp(500, function() {
                                $("#update-alert").slideUp(500);
                            });

                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Save Changes');
                        }
                    });
                }
            });

            $('body').on('click', '.deletePriority', function () {

                var priority_id = $(this).data("id");
                var r = confirm("Si è sicuri di voler eliminare la Priorità selezionata?!");

                if(r == true){
                    $.ajax({
                        type: "DELETE",
                        url: "/backend/priorities/" + priority_id,
                        success: function (data) {
                            oTable.draw();

                            $('#message_destroy').html(data.message_destroy);
                            $("#destroy-alert").fadeTo(2000, 500).slideUp(500, function() {
                                $("#destroy-alert").slideUp(500);
                            });
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

            var table = $('#sample_15');
            // $("#sample_15 tbody").html(table_data);

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
                    url:"{{ route('priorities.index') }}"
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
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
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
        });



    </script>


@endsection
