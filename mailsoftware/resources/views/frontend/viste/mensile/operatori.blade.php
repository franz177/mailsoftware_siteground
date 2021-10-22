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
                                Operatori
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
                                    <th class="all text-center">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
                                                    </g>
                                                </svg>
                                            </span>
                                    </th>
                                    <th class="all">Arrivo</th>
                                    <th class="all">Op. Pulizie</th>
                                    <th class="all">kit base</th>
                                    <th class="all">Partenza</th>
                                    <th class="all">Op. <br> C-OUT</th>
                                    <th class="all">Cash <br> Op. C-OUT</th>

                                    <th class="none">Note</th>
                                    <th class="none">CityTax</th>
                                    <th class="none">Extra Cash dell'ospite al C-OUT</th>
                                    <th class="none">Ore Pulizie</th>
                                    <th class="none">Supervisor Pulizie</th>
                                    <th class="none">Costo Extra C-OUT</th>
                                    <th class="none">Costo Op.Cambio</th>
                                    <th class="none">Extra Mondezza</th>
                                    <th class="none">Operatore C-IN</th>
                                    <th class="none">Cash Preso da Simo C-OUT</th>
                                    <th class="none">Sito</th>
                                    <th class="none text-uppercase">Cliente</th>
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

            var houses_color = {!! $houses_color !!};
            var houses_typo = {!! $houses_typo !!};
            var sites_kross = {!! $sites_kross !!};
            var sites_array = {!! $sites_array !!};
            var op_check_out = {!! $op_check_out !!};

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
                    url:"{{ route('viste.operatori') }}",
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
                    {
                        data: null,                                             //td:eq(0)
                        render: function (data, type, row)
                        {
                            var houses = houses_typo[row.tx_mask_p_casa];
                            return houses + '</br>' + row.note_alert;
                        },
                        sortable: false,
                    },
                    {data: 'data_arrivo'},                                      //td:eq(1)
                    {data: 'tx_mask_t1_op_pulizie',                             //td:eq(2)
                        render: function (data, type, row)
                        {
                            if(data in op_check_out) {
                                var operatore = op_check_out[data] + ' '+ row.totale_pulizie;
                            } else {
                                var operatore = 'NaN';
                            }
                            return operatore;
                        },
                    },
                    {data: 'kit_base'},                                         //td:eq(3)
                    {data: 'data_partenza'},                                    //td:eq(4)
                    {data: 'tx_mask_t1_op_checkout',                            //td:eq(5)
                        render: function (data, type, row)
                        {
                            if(data in op_check_out) {
                                var operatore = op_check_out[data] + ' ' + row.costo_co;
                            } else {
                                var operatore = 'NaN';
                            }
                            return operatore;
                        },
                    },
                    {data: 'cash_operatore_co'},                                //td:eq(6)


                    {data: 'tx_mask_t1_op_note'},                               //td:eq(7)
                    {data: 'city_tax'},                                         //td:eq(8)
                    {data: 'extra_cash_ospite'},                                //td:eq(9)
                    {data: 'costo_orario'},                                     //td:eq(11)
                    {data: null,                                                //td:eq(12)
                        render: function (data, type, row)
                        {
                            if(row.tx_mask_t0_fattura) {
                                return row.tx_mask_t0_fattura + '<br><span class="font-weight-bolder">&euro; ' + row.tx_mask_t3_p_extra_p + '</span>';
                            }
                            return '<span class="font-weight-bolder">&euro; ' + row.tx_mask_t3_p_extra_p + '</span>';
                        }
                    },
                    {data: 'costo_ex_co'},                                      //td:eq(13)
                    {data: 'costi_costo_operatore_cambio_biancheria'},          //td:eq(14)
                    {data: 'extra_mondezza'},                                   //td:eq(15)
                    {data: 'tx_mask_t1_op_chechin',                            //td:eq(5)
                        render: function (data, type, row)
                        {
                            if(data in op_check_out) {
                                var operatore = '<span class="text-dark font-weight-bolder">' + op_check_out[data] + ' € ' + row.costi_check_in_self_check_in +'</span> Costo Extra C-IN <span class="text-dark font-weight-bolder">€ ' + row.tx_mask_t3_p_s_extra_checkin + '</span>';
                            } else {
                                var operatore = 'NaN' ;
                            }
                            return operatore;
                        },
                    },                            //td:eq(15)
                    {data: 'cash_simo_co'},                                     //td:eq(16)


                    {data: 'tx_mask_p_sito',                                    //td:eq(17)
                        render: function (data, type, row)
                        {
                            if(data in sites_array){
                                var sites = sites_array[data];
                                // var sites = sites_kross[data];
                            } else {
                                var sites = data;
                            }
                            return sites;
                        }, className:'text-left', sortable: false,
                    },
                    {data: 'header', className: 'text-capitalize'},             //td:eq(18)


                ],

                rowCallback: function(row, data, index) {
                    $('td:eq(0)', row).addClass('bg-'+houses_color[data.tx_mask_p_casa]);   //CASA
                    $('td:eq(0)', row).addClass('text-center');                             //CASA
                    $('td:eq(1)', row).addClass('alert-warning');                           //DATA-ARRIVO
                    $('td:eq(2)', row).addClass('alert-warning');                           //OP. PULIZIE
                    $('td:eq(3)', row).addClass('alert-warning');                           //KIT BASE
                    $('td:eq(4)', row).addClass('alert-danger');                           //DATA-PARTENZA
                    $('td:eq(5)', row).addClass('alert-danger');                           //OP. C-OUT

                    // if(data.mancia_cli_or < 0){
                    //     $('td:eq(17)', row).addClass('text-danger');
                    // }
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
                    { width: '5%', targets: 1},         //house
                    { width: '10%', targets: 2},        //data-arrivo
                    { width: '17%', targets: 3},        //OP.PULIZIE
                    { width: '31%', targets: 4},        //KIT BASE
                    { width: '10%', targets: 5},       //data-partenza
                    { width: '17%', targets: 6},       //OP.C-OUT
                    { width: '10%', targets: 7},       //CASH

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
