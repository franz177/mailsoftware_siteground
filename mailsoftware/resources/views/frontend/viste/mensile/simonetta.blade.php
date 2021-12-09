@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Costi Annuale per Mesi
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <h3 class="pb-10">Anno 2021</h3>
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_21">
                                <thead class="text-uppercase">
                                <tr>
                                    <th></th>
                                    <th class="all">Mesi</th>
                                    <th class="all">Check-IN</th>
                                    <th class="all">Tot Pulizie</th>
                                    <th class="all">Tot Supervisor <br> pulizie</th>
                                    <th class="all">Tot Check-Out</th>
                                    <th class="all">Tot Op-Cambio</th>
                                    <th class="all">Tot sitiweb</th>
                                    <th class="all">Tot Biancheria</th>
                                    <th class="all font-weight-bolder">Tot Riga</th>
                                </tr>
                                </thead>
                                <tfoot class="total-row">
                                <tr>
                                    <th></th>
                                    <th class="all"></th>
                                    <th class="all">Check-IN</th>
                                    <th class="all">Tot Pulizie</th>
                                    <th class="all">Tot Supervisor <br> pulizie</th>
                                    <th class="all">Tot Check-Out</th>
                                    <th class="all">Tot Op-Cambio</th>
                                    <th class="all">Tot sitiweb</th>
                                    <th class="all">Tot Biancheria</th>
                                    <th class="all">Tot Riga</th>
                                </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer justify-content-between">
                    <p class="text-muted font-weight-bold font-size-s mb-2">Per tutte le colonne vengono calcolati i <strong>Costi Extra</strong>.</p>
                    <p class="text-muted font-weight-bold font-size-s mb-2">Cambio biancheria è moltiplicato per il cambio lenzuola.</p>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <h3 class="py-10">Anno 2020</h3>
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_20">
                                <thead class="text-uppercase">
                                <tr>
                                    <th></th>
                                    <th class="all">Mesi</th>
                                    <th class="all">Check-IN</th>
                                    <th class="all">Tot Pulizie</th>
                                    <th class="all">Tot Supervisor <br> pulizie</th>
                                    <th class="all">Tot Check-Out</th>
                                    <th class="all">Tot Op-Cambio</th>
                                    <th class="all">Tot sitiweb</th>
                                    <th class="all">Tot Biancheria</th>
                                    <th class="all font-weight-bolder">Tot Riga</th>
                                </tr>
                                </thead>
                                <tfoot class="total-row">
                                <tr>
                                    <th></th>
                                    <th class="all"></th>
                                    <th class="all">Check-IN</th>
                                    <th class="all">Tot Pulizie</th>
                                    <th class="all">Tot Supervisor <br> pulizie</th>
                                    <th class="all">Tot Check-Out</th>
                                    <th class="all">Tot Op-Cambio</th>
                                    <th class="all">Tot sitiweb</th>
                                    <th class="all">Tot Biancheria</th>
                                    <th class="all">Tot Riga</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-content">
                        <h3 class="py-10">Anno 2019</h3>
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_19">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th></th>
                                        <th class="all">Mesi</th>
                                        <th class="all">Check-IN</th>
                                        <th class="all">Tot Pulizie</th>
                                        <th class="all">Tot Supervisor <br> pulizie</th>
                                        <th class="all">Tot Check-Out</th>
                                        <th class="all">Tot Op-Cambio</th>
                                        <th class="all">Tot sitiweb</th>
                                        <th class="all">Tot Biancheria</th>
                                        <th class="all font-weight-bolder">Tot Riga</th>
                                    </tr>
                                </thead>
                                <tfoot class="total-row">
                                <tr>
                                    <th></th>
                                    <th class="all"></th>
                                    <th class="all">Check-IN</th>
                                    <th class="all">Tot Pulizie</th>
                                    <th class="all">Tot Supervisor <br> pulizie</th>
                                    <th class="all">Tot Check-Out</th>
                                    <th class="all">Tot Op-Cambio</th>
                                    <th class="all">Tot sitiweb</th>
                                    <th class="all">Tot Biancheria</th>
                                    <th class="all">Tot Riga</th>
                                </tr>
                                </tfoot>
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
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables/datatables.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        let data_search = new Object();

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            var table_21 = $('#sample_21');
            var oTable = table_21.DataTable({
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
                    url:"{{ route('simonetta.data') }}",
                    data: function (d) {
                        d.year = 2021;
                    }
                },

                columns: [
                    {
                        className:      '',
                        orderable:      false,
                        searchable:     false,
                        data:           null,
                        defaultContent: '',
                        cellType: "th",
                        sortable: false
                    },
                    {data: 'month'},
                    {data: 'costo_cin'},                                // CHECK-IN
                    {data: 'totale_pulizie'},                           // TOT PULIZIE
                    {data: 'supervisor_pulizie'},                       // TOT SUPERVISOR PULIZIE
                    {data: 'costo_co'},                                 // TOT COSTO-CO
                    {data: 'costi_costo_operatore_cambio_biancheria'},  // TOT OP-CAMBIO
                    {data: 'tx_mask_p_perc_importo_fisso'},             // TOT COMMISSIONI SITIWEB
                    {data: 'totale_biancheria'},                        // TOT BIANCHERIA
                    {data: 'sum_row'},                                  // TOT RIGA


                ],

                rowCallback: function(row, data, index) {
                    $('td:eq(1)', row).addClass('text-right');     // CHECK-IN
                    $('td:eq(2)', row).addClass('text-right');     // TOT PULIZIE
                    $('td:eq(3)', row).addClass('text-right');     // TOT SUPERVISOR PULIZIE
                    $('td:eq(4)', row).addClass('text-right');     // TOT COSTO-CO
                    $('td:eq(5)', row).addClass('text-right');     // TOT OP-CAMBIO
                    $('td:eq(6)', row).addClass('text-right');     // TOT COMMISSIONI SITIWEB
                    $('td:eq(7)', row).addClass('text-right');     // TOT BIANCHERIA
                    $('td:eq(8)', row).addClass('text-right');     // TOT RIGA
                },

                footerCallback: function(row, data, index) {
                    var api = this.api(), data;
                    var tot = data.length - 1;
                    console.log(tot);
                    $( api.column( 2 ).footer() ).html(data[tot].sum_costo_cin);                  // CHECK-IN
                    $( api.column( 3 ).footer() ).html(data[tot].sum_tot_pulizie);                // TOT PULIZIE
                    $( api.column( 4 ).footer() ).html(data[tot].sum_tot_supervisor_pulizie);     // TOT SUPERVISOR PULIZIE
                    $( api.column( 5 ).footer() ).html(data[tot].sum_tot_costo_co);               // TOT COSTO-CO
                    $( api.column( 6 ).footer() ).html(data[tot].sum_tot_op_cambio);              // TOT OP-CAMBIO
                    $( api.column( 7 ).footer() ).html(data[tot].sum_tot_commissioni_sitiweb);    // TOT COMMISSIONI SITIWEB
                    $( api.column( 8 ).footer() ).html(data[tot].sum_tot_totale_biancheria);      // TOT BIANCHERIA
                    $( api.column( 9 ).footer() ).html(data[tot].sum_tot_totale_row);      // TOT RIGA

                    $( api.column( 2 ).footer() ).addClass('text-right');   // CHECK-IN
                    $( api.column( 3 ).footer() ).addClass('text-right');   // TOT PULIZIE
                    $( api.column( 4 ).footer() ).addClass('text-right');   // TOT SUPERVISOR PULIZIE
                    $( api.column( 5 ).footer() ).addClass('text-right');   // TOT COSTO-CO
                    $( api.column( 6 ).footer() ).addClass('text-right');   // TOT OP-CAMBIO
                    $( api.column( 7 ).footer() ).addClass('text-right');   // TOT COMMISSIONI SITIWEB
                    $( api.column( 8 ).footer() ).addClass('text-right');   // TOT BIANCHERIA
                    $( api.column( 9 ).footer() ).addClass('text-right');   // TOT RIGA
                },

                // setup buttons extentension: http://datatables.net/extensions/buttons/
                buttons: [
                    // { extend: 'print', className: 'btn dark btn-outline' },
                    { extend: 'pdf', className: 'btn green btn-outline' },
                    { extend: 'excel', className: 'btn purple btn-outline ' }
                ],

                // setup responsive extension: http://datatables.net/extensions/responsive/
                // setup responsive extension: http://datatables.net/extensions/responsive/
                responsive: {
                    details: {
                        type: 'column',
                        target: 'th',
                    }
                },
                columnDefs: [
                    { className: 'control', targets:   0, width: '3%' }, //plus
                    { className: 'total-column', targets: 9},
                    { width: '5%', targets: 1}, //house
                ],

                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],

                // set the initial value
                "pageLength": -1,

                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            });

            var table_20 = $('#sample_20');
            var oTable = table_20.DataTable({
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
                    url:"{{ route('simonetta.data') }}",
                    data: function (d) {
                        d.year = 2020;
                    }
                },

                columns: [
                    {
                        className:      '',
                        orderable:      false,
                        searchable:     false,
                        data:           null,
                        defaultContent: '',
                        cellType: "th",
                        sortable: false
                    },
                    {data: 'month'},
                    {data: 'costo_cin'},                                // CHECK-IN
                    {data: 'totale_pulizie'},                           // TOT PULIZIE
                    {data: 'supervisor_pulizie'},                       // TOT SUPERVISOR PULIZIE
                    {data: 'costo_co'},                                 // TOT COSTO-CO
                    {data: 'costi_costo_operatore_cambio_biancheria'},  // TOT OP-CAMBIO
                    {data: 'tx_mask_p_perc_importo_fisso'},             // TOT COMMISSIONI SITIWEB
                    {data: 'totale_biancheria'},                        // TOT BIANCHERIA
                    {data: 'sum_row'},                                  // TOT RIGA


                ],

                rowCallback: function(row, data, index) {
                    $('td:eq(1)', row).addClass('text-right');     // CHECK-IN
                    $('td:eq(2)', row).addClass('text-right');     // TOT PULIZIE
                    $('td:eq(3)', row).addClass('text-right');     // TOT SUPERVISOR PULIZIE
                    $('td:eq(4)', row).addClass('text-right');     // TOT COSTO-CO
                    $('td:eq(5)', row).addClass('text-right');     // TOT OP-CAMBIO
                    $('td:eq(6)', row).addClass('text-right');     // TOT COMMISSIONI SITIWEB
                    $('td:eq(7)', row).addClass('text-right');     // TOT BIANCHERIA
                    $('td:eq(8)', row).addClass('text-right');     // TOT RIGA
                },

                footerCallback: function(row, data, index) {
                    var api = this.api(), data;
                    var tot = data.length - 1;
                    console.log(tot);
                    $( api.column( 2 ).footer() ).html(data[tot].sum_costo_cin);                  // CHECK-IN
                    $( api.column( 3 ).footer() ).html(data[tot].sum_tot_pulizie);                // TOT PULIZIE
                    $( api.column( 4 ).footer() ).html(data[tot].sum_tot_supervisor_pulizie);     // TOT SUPERVISOR PULIZIE
                    $( api.column( 5 ).footer() ).html(data[tot].sum_tot_costo_co);               // TOT COSTO-CO
                    $( api.column( 6 ).footer() ).html(data[tot].sum_tot_op_cambio);              // TOT OP-CAMBIO
                    $( api.column( 7 ).footer() ).html(data[tot].sum_tot_commissioni_sitiweb);    // TOT COMMISSIONI SITIWEB
                    $( api.column( 8 ).footer() ).html(data[tot].sum_tot_totale_biancheria);      // TOT BIANCHERIA
                    $( api.column( 9 ).footer() ).html(data[tot].sum_tot_totale_row);      // TOT RIGA

                    $( api.column( 2 ).footer() ).addClass('text-right');   // CHECK-IN
                    $( api.column( 3 ).footer() ).addClass('text-right');   // TOT PULIZIE
                    $( api.column( 4 ).footer() ).addClass('text-right');   // TOT SUPERVISOR PULIZIE
                    $( api.column( 5 ).footer() ).addClass('text-right');   // TOT COSTO-CO
                    $( api.column( 6 ).footer() ).addClass('text-right');   // TOT OP-CAMBIO
                    $( api.column( 7 ).footer() ).addClass('text-right');   // TOT COMMISSIONI SITIWEB
                    $( api.column( 8 ).footer() ).addClass('text-right');   // TOT BIANCHERIA
                    $( api.column( 9 ).footer() ).addClass('text-right');   // TOT RIGA
                },

                // setup buttons extentension: http://datatables.net/extensions/buttons/
                buttons: [
                    // { extend: 'print', className: 'btn dark btn-outline' },
                    { extend: 'pdf', className: 'btn green btn-outline' },
                    { extend: 'excel', className: 'btn purple btn-outline ' }
                ],

                // setup responsive extension: http://datatables.net/extensions/responsive/
                // setup responsive extension: http://datatables.net/extensions/responsive/
                responsive: {
                    details: {
                        type: 'column',
                        target: 'th',
                    }
                },
                columnDefs: [
                    { className: 'control', targets:   0, width: '3%' }, //plus
                    { className: 'total-column', targets: 9},
                    { width: '5%', targets: 1}, //house
                ],

                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],

                // set the initial value
                "pageLength": -1,

                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            });

            var table_19 = $('#sample_19');
            var oTable = table_19.DataTable({
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
                    url:"{{ route('simonetta.data') }}",
                    data: function (d) {
                        d.year = 2019;
                    }
                },

                columns: [
                    {
                        className:      '',
                        orderable:      false,
                        searchable:     false,
                        data:           null,
                        defaultContent: '',
                        cellType: "th",
                        sortable: false
                    },
                    {data: 'month'},
                    {data: 'costo_cin'},                                // CHECK-IN
                    {data: 'totale_pulizie'},                           // TOT PULIZIE
                    {data: 'supervisor_pulizie'},                       // TOT SUPERVISOR PULIZIE
                    {data: 'costo_co'},                                 // TOT COSTO-CO
                    {data: 'costi_costo_operatore_cambio_biancheria'},  // TOT OP-CAMBIO
                    {data: 'tx_mask_p_perc_importo_fisso'},             // TOT COMMISSIONI SITIWEB
                    {data: 'totale_biancheria'},                        // TOT BIANCHERIA
                    {data: 'sum_row'},                                  // TOT RIGA


                ],

                rowCallback: function(row, data, index) {
                    $('td:eq(1)', row).addClass('text-right');     // CHECK-IN
                    $('td:eq(2)', row).addClass('text-right');     // TOT PULIZIE
                    $('td:eq(3)', row).addClass('text-right');     // TOT SUPERVISOR PULIZIE
                    $('td:eq(4)', row).addClass('text-right');     // TOT COSTO-CO
                    $('td:eq(5)', row).addClass('text-right');     // TOT OP-CAMBIO
                    $('td:eq(6)', row).addClass('text-right');     // TOT COMMISSIONI SITIWEB
                    $('td:eq(7)', row).addClass('text-right');     // TOT BIANCHERIA
                    $('td:eq(8)', row).addClass('text-right');     // TOT RIGA
                },

                footerCallback: function(row, data, index) {
                    var api = this.api(), data;
                    var tot = data.length - 1;
                    console.log(tot);
                    $( api.column( 2 ).footer() ).html(data[tot].sum_costo_cin);                  // CHECK-IN
                    $( api.column( 3 ).footer() ).html(data[tot].sum_tot_pulizie);                // TOT PULIZIE
                    $( api.column( 4 ).footer() ).html(data[tot].sum_tot_supervisor_pulizie);     // TOT SUPERVISOR PULIZIE
                    $( api.column( 5 ).footer() ).html(data[tot].sum_tot_costo_co);               // TOT COSTO-CO
                    $( api.column( 6 ).footer() ).html(data[tot].sum_tot_op_cambio);              // TOT OP-CAMBIO
                    $( api.column( 7 ).footer() ).html(data[tot].sum_tot_commissioni_sitiweb);    // TOT COMMISSIONI SITIWEB
                    $( api.column( 8 ).footer() ).html(data[tot].sum_tot_totale_biancheria);      // TOT BIANCHERIA
                    $( api.column( 9 ).footer() ).html(data[tot].sum_tot_totale_row);             // TOT RIGA

                    $( api.column( 2 ).footer() ).addClass('text-right');   // CHECK-IN
                    $( api.column( 3 ).footer() ).addClass('text-right');   // TOT PULIZIE
                    $( api.column( 4 ).footer() ).addClass('text-right');   // TOT SUPERVISOR PULIZIE
                    $( api.column( 5 ).footer() ).addClass('text-right');   // TOT COSTO-CO
                    $( api.column( 6 ).footer() ).addClass('text-right');   // TOT OP-CAMBIO
                    $( api.column( 7 ).footer() ).addClass('text-right');   // TOT COMMISSIONI SITIWEB
                    $( api.column( 8 ).footer() ).addClass('text-right');   // TOT BIANCHERIA
                    $( api.column( 9 ).footer() ).addClass('text-right');   // TOT RIGA
                },

                // setup buttons extentension: http://datatables.net/extensions/buttons/
                buttons: [
                    // { extend: 'print', className: 'btn dark btn-outline' },
                    { extend: 'pdf', className: 'btn green btn-outline' },
                    { extend: 'excel', className: 'btn purple btn-outline ' }
                ],

                // setup responsive extension: http://datatables.net/extensions/responsive/
                // setup responsive extension: http://datatables.net/extensions/responsive/
                responsive: {
                    details: {
                        type: 'column',
                        target: 'th',
                    }
                },
                columnDefs: [
                    { className: 'control', targets:   0, width: '3%' }, //plus
                    { className: 'total-column', targets: 9},
                    { width: '5%', targets: 1}, //house
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
@endsection
