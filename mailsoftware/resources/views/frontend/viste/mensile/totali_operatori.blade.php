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
                                Totali Operatori
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
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                            </div>
                                            <select class="form-control" id="year" name="year">
                                                @foreach($years as $year)
                                                    <option value="{{ $year->year }}" {{ $year->year == now()->year ? 'selected' : '' }}>{{ $year->year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-2 d-flex flex-column">
                                        <div class="input-group has-validation">
                                            <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                            </div>
                                            <select class="form-control" id="month" name="month">
                                                @foreach($months as $month => $name)
                                                    <option value="{{ $month }}" {{ $month == now()->month ? 'selected' : '' }}>{{ $name }}</option>
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
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_21">
                                <thead>
                                <tr>
                                    <th class="none"></th>
                                    <th class="all">OPERATORE</th>
                                    <th class="all">TOTALE <br>CHECK-IN</th>
                                    <th class="all">TOTALE <br>PULIZIE</th>
                                    <th class="all">SUPERVISOR <br>PULIZIE</th>
                                    <th class="all">COSTO <br>C-OUT</th>
                                    <th class="all">COSTO EXTRA <br>C-OUT</th>
                                    <th class="all">CASH OP. <br>C-OUT</th>
                                    <th class="all">COSTO <br>OP. CAMBIO</th>

                                </tr>
                                </thead>

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

            var tables = $('#sample_21');

            var oTable = tables.DataTable({
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
                    url:"{{ route('viste.totali_operatori') }}",
                    data: function (d) {
                        d.year = $('select[name=year] option').filter(':selected').val();
                        d.month = $('select[name=month] option').filter(':selected').val();
                    }
                },

                columns: [
                    {
                        className:      'hidden',
                        orderable:      false,
                        searchable:     false,
                        data:           null,
                        defaultContent: '',
                        cellType: "th",
                        sortable: false
                    },

                    {data: 'uid'},                                      //td:eq(1)
                    {data: 'costi_cin'},                                      //td:eq(2)
                    {data: 'totale_pulizie'},                                      //td:eq(2)
                    {data: 'supervisor_pulizie'},                                      //td:eq(3)
                    {data: 'costo_co'},                                      //td:eq(4)
                    {data: 'extra_co'},                                      //td:eq(5)
                    {data: 'cash_op_co'},                                      //td:eq(6)
                    {data: 'costi_costo_operatore_cambio_biancheria'},                                      //td:eq(7)



                ],

                rowCallback: function(row, data, index) {
                    $('td:eq(1)', row).addClass('alert-success');   // TOTALE CHECK-IN
                    $('td:eq(2)', row).addClass('alert-warning');   // TOTALE PULIZIE
                    $('td:eq(3)', row).addClass('alert-warning');   // SUPERVISOR PULIZIE
                    $('td:eq(4)', row).addClass('alert-danger');    // COSTO C-OUT
                    $('td:eq(5)', row).addClass('alert-danger');    // COSTO EXTRA C-OUT
                    $('td:eq(6)', row).addClass('alert-danger');    // CASH OP. C-OUT
                    $('td:eq(7)', row).addClass('alert-info');    // COSTO OP. CAMBIO
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
                        target: 'tr',
                    }
                },
                columnDefs: [
                    { className: 'control', targets:   0, width: '3%' }, //plus
                    { width: '11%', targets: 1},         //house
                    { width: '11%', targets: 2},        //data-arrivo
                    { width: '11%', targets: 3},        //data-arrivo
                    { width: '11%', targets: 4},        //OP.PULIZIE
                    { width: '11%', targets: 5},        //KIT BASE
                    { width: '11%', targets: 6},       //data-partenza
                    { width: '11%', targets: 7},       //OP.C-OUT
                    { width: '11%', targets: 8},       //CASH

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
