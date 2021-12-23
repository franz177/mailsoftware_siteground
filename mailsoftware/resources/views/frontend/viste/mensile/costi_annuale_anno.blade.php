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
                                Costi Annuale per Anno
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <form action="" method="POST" enctype="multipart/form-data" id="form_flow_text">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-2 d-flex flex-column">
                                        <div class="input-group has-validation">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-home"></i>
                                                </span>
                                            </div>
                                            <select multiple="multiple" class="form-control" id="house" name="house[]" style="min-height: 150px;">
                                                @foreach($houses_typo as $uid => $name)
                                                    <option value="{{ $uid }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-light-instagram" name="removeFilter" id="removeFilter">Rimuovi Filtri</button>
                                        <button type="button" class="btn btn-instagram" name="submit" id="submit">Cerca</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <p class="font-weight-bold font-size-s mb-2 pb-5">
                            I calcoli sono effettuati sulla data di arrivo colore
                            <span class="symbol symbol-20 symbol-warning mx-1">
                                    <span class="symbol-label"></span>
                                </span>
                            Giallo
                        </p>
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_21">
                                <thead class="text-uppercase">
                                <tr>
                                    <th></th>
                                    <th class="all">Anni</th>
                                    <th class="all alert-warning">Check-IN</th>
                                    <th class="all alert-warning">Tot Pulizie</th>
                                    <th class="all alert-warning">Tot Supervisor <br> pulizie</th>
                                    <th class="all alert-warning">Tot Check-Out</th>
                                    <th class="all alert-warning">Tot Op-Cambio</th>
                                    <th class="all alert-warning">Tot sitiweb</th>
                                    <th class="all alert-warning">Tot Biancheria</th>
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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Costi Aziendali Annuali per Anno
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_22">
                                <thead class="text-uppercase">
                                <tr>
                                    <th></th>
                                    <th class="all">Anno</th>
                                    <th class="all">Utenze & Tasse</th>
                                    <th class="all">Partita IVA</th>
                                    <th class="all">Manutenzione</th>
                                    <th class="all">Acquisti fornitura case</th>
                                    <th class="all">GESTIONE ORDINARIA CLIENTI</th>
                                    <th class="all">Promozione</th>
                                    <th class="all">totale</th>
                                </tr>
                                </thead>
                                <tfoot class="total-row">
                                <tr>
                                    <th></th>
                                    <th class="all">Anno</th>
                                    <th class="all">Utenze & Tasse</th>
                                    <th class="all">Partita IVA</th>
                                    <th class="all">Manutenzione</th>
                                    <th class="all">Acquisti fornitura case</th>
                                    <th class="all">GESTIONE ORDINARIA CLIENTI</th>
                                    <th class="all">Promozione</th>
                                    <th class="all">totale</th>
                                </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer justify-content-between">
{{--                    <p class="text-muted font-weight-bold font-size-s mb-2">Per tutte le colonne vengono calcolati i <strong>Costi Extra</strong>.</p>--}}
{{--                    <p class="text-muted font-weight-bold font-size-s mb-2">Cambio biancheria è moltiplicato per il cambio lenzuola.</p>--}}
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
                searching: false,
                lengthChange: false,
                paging:   false,
                ordering: false,
                info:     false,

                ajax: {
                    url:"{{ route('costi_annuale_anno.data') }}",
                    data: function (d) {
                        d.house = $('#house').val();
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
                    {data: 'years'},
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

            var table_22 = $('#sample_22');
            var oTable1 = table_22.DataTable({
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
                searching: false,
                lengthChange: false,
                paging:   false,
                ordering: false,
                info:     false,

                ajax: {
                    url:"{{ route('costi_aziendali_anno.data') }}",
                    // data: function (d) {
                    //     d.house = $('#house').val();
                    // }
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
                    {data: 'year'},                                    // CHECK-IN
                    {data: 'utenze_e_tasse'},                                // CHECK-IN
                    {data: 'promozione'},                           // TOT PULIZIE
                    {data: 'partita_iva'},                                    // CHECK-IN
                    {data: 'manutenzione'},                                // CHECK-IN
                    {data: 'acquisti_fornitura_case'},                           // TOT PULIZIE
                    {data: 'gestione_ordinaria_clienti'},                           // TOT PULIZIE
                    {data: 'total_row'},                           // TOT PULIZIE
                ],

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
                    { className: 'total-column', targets: 8},
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


            $('#submit').on('click', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#removeFilter').on('click', function(e) {
                location.reload();
            });
        });

    </script>
@endsection
