{{-- Extends layout --}}
@extends('backend.default')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
@endsection
{{-- Content --}}
@section('content')
    <form action="{{ route('flusso_testi.retrive') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="turn" name="turn" value="{{ $turn }}">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Elenco Testi tramite Flusso
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">
{{--                        <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Cerca </button>--}}
                        <a href="/backend/flusso_testi" class="btn btn-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Reset</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="row mb-6">
                            <div class="col-sm-3 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="typeanswer_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta</label>
                                        <select class="form-control dynamic" name="typeanswer_id" id="typeanswer_id">
                                            <option value="" selected> Selezionare Tipo Risposta</option>
                                            @foreach($typeanswers as $typeanswer)
                                                <option value="{{ $typeanswer->id }}" {{ $typeanswer_id == $typeanswer->id ? 'selected' : '' }}>{{ $typeanswer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="type_id" class="text-muted font-weight-bolder font-size-lg">Modelli </label>
                                        <select class="form-control dynamic" name="type_id" id="type_id">
                                            <option value="" readonly="readonly" > Selezionare Modello</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}" {{ $type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="site_uid" class="text-muted font-weight-bolder font-size-lg">Canali</label>
                                        <select class="form-control dynamic" name="site_uid" id="site_uid">
                                            <option value="" readonly="readonly"> Selezionare Canale</option>
                                            @foreach($sites as $site)
                                                <option value="{{ $site->uid }}" {{ $site_uid == $site->uid ? 'selected' : '' }}>{{ $site->name . ' ' . $site->percentuale.'%' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="house_uid" class="text-muted font-weight-bolder font-size-lg">Case</label>
                                        <select class="form-control dynamic" name="house_uid" id="house_uid">
                                            <option value="" readonly="readonly"> Selezionare Casa</option>
                                            @foreach($houses as $house)
                                                <option value="{{ $house->uid }}" {{ $house_uid == $house->uid ? 'selected' : '' }}>{{ $house->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if($flow_texts !== NULL)
    <div class="row">
        <div class="col-lg-12 col-xxl-12">

            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->

                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-15">
                    <div class="tab-content">
                        <!--begin::Table-->

                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_15">
                                <thead>
                                    <tr class="text-left text-uppercase">
                                        <th></th>
                                        <th class="text-left" >BLK</th>
                                        <th class="text-left" >SEZ</th>
                                        <th class="text-left ">Nome testo</th>
                                        <th class="text-left" style="min-width: 200px">Testo</th>
                                        <th class="text-left none">Text</th>
                                        <th class="text-left none">Priorità</th>
                                        <th class="text-center">Azioni</th>
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
    @endif
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        $(document).ready(function(){

            var turn = $('input#turn').attr('value');
            turn = parseInt(turn);

            $('body').on('click', '.editBlockSection', function () {
                alert('ciao sono click');
            });

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

                var op=" ";

                $.ajax({
                    method: 'get',
                    url: '{{route('flusso_testi.sites')}}',
                    data: {typeanswer_id:typeanswer_id, type_id:type_id},
                    success:function(sites) {
                        // console.log(sites);
                        op += '<option value="0" selected disabled>Scegli Canale</option>';
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

                var op=" ";

                $.ajax({
                    method: 'get',
                    url: '{{route('flusso_testi.houses')}}',
                    data: {typeanswer_id:typeanswer_id, type_id:type_id, site_uid:site_uid},
                    success:function(houses) {
                        op += '<option value="0" selected disabled>Scegli Casa</option>';
                        for(var i=0;i<houses.length;i++){
                            op+='<option value="'+houses[i].uid+'">'+houses[i].name+'</option>';
                        }

                        $('#house_uid').prop("disabled", false);
                        $('#house_uid').html(op)


                    },
                    error:function (){

                    }
                });
            });

            $(document).on('change','#house_uid', function(){
                var typeanswer_id = $('#typeanswer_id').val();
                var type_id = $('#type_id').val();
                var site_uid = $('#site_uid').val();
                var house_uid = $(this).val();

                oTable.clear().destroy();
                oTable = table.DataTable({
                    destroy: true,
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
                        url:"{{ route('flusso_testi.getFlowTextIndex') }}",
                        data: {typeanswer_id:typeanswer_id, type_id:type_id, site_uid:site_uid, house_uid:house_uid},
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
                        {data: 'block.name', name: 'Blocco', searchable: false},
                        {data: 'section.name', name: 'Sezione', searchable: false},
                        {data: 'testo_name', name: 'testo_name', orderable: false, searchable: false},
                        {data: 'text.testo', name: 'Testo'},
                        {data: 'text.text', name: 'Text'},
                        {data: 'text.priority.name', name: 'Priorità'},
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
                        { className: 'control', orderable: false, width: '5%', targets:   0 },
                        { width: '5%', targets: 1, orderable: false},
                        { width: '5%', targets: 2, orderable: false},
                        { width: '20%', targets: 3, orderable: false},
                        { width: '50%', targets: 4, orderable: false},
                        { width: '15%', targets: 5, orderable: false}

                    ],

                    order: [
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": -1,

                    "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
                });

                $('#type_id').prop("disabled", true);
                $('#site_uid').prop("disabled", true);
                $('#house_uid').prop("disabled", true);
            });

            var table = $('#sample_15');
            var oTable = table.DataTable({
                destroy: true,
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
                    url:"{{ route('flusso_testi.getFlowTextIndex') }}",
                    data: {},
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
                    {data: 'block.name', name: 'Blocco', searchable: false},
                    {data: 'section.name', name: 'Sezione', searchable: false},
                    {data: 'testo_name', name: 'testo_name', orderable: false, searchable: false},
                    {data: 'text.testo', name: 'Testo'},
                    {data: 'text.text', name: 'Text'},
                    {data: 'text.priority.name', name: 'Priorità'},
                    {className: "ciccio", data: 'action', name: 'action', orderable: false, searchable: false},

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
                    { className: 'control', orderable: false, width: '5%', targets:   0 },
                    { width: '5%', targets: 1, orderable: false},
                    { width: '5%', targets: 2, orderable: false},
                    { width: '20%', targets: 3, orderable: false},
                    { width: '50%', targets: 4, orderable: false},
                    { width: '15%', targets: 5, orderable: false}

                ],

                order: [
                ],

                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": -1,

                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            });


        });
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables/datatables.js') }}" type="text/javascript"></script>


@endsection
