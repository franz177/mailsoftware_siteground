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
                                Mensile Generale Costi
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
                            sulla data di partenza colore
                            <span class="symbol symbol-20 symbol-danger mx-1">
                                    <span class="symbol-label"></span>
                                </span>
                            Rosa
                        </p>
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
                                    <th class="none text-left">Sito</th>
                                    <th class="all text-uppercase">Cliente</th>
                                    <th class="all alert-warning">Arrivo</th>
                                    <th class="none">Note Operatore</th>
                                    <th class="none">CityTax</th>
                                    <th class="all alert-warning">Op. Pulizie</th>
                                    <th class="none">Ore Pulizie</th>
                                    <th class="none">Costo Ore Pulizie</th>
                                    <th class="all alert-warning">TOT Costo <br> C-IN</th>
                                    <th class="all alert-warning">Tot <br> Pulizie</th>
                                    <th class="all alert-warning">Supervisor <br> Pulizie</th>
                                    <th class="all alert-danger">Partenza</th>
                                    <th class="all alert-danger">Op. <br> C-OUT</th>
                                    <th class="all alert-danger">Costo <br> C-OUT</th>
                                    <th class="all alert-danger">Costo <br> Extra <br> C-OUT</th>
                                    <th class="all alert-danger">Cash <br> Op. C-OUT</th>
                                    <th class="all alert-danger">Cash <br> Simo <br> C-OUT</th>
                                    <th class="all">Mancia Cliente</th>
                                    <th class="none">Extra Cash dell'ospite al C-OUT</th>
                                    <th class="all alert-danger">Costo Op.Cambio</th>
                                    <th class="none">Extra Mondezza</th>
                                    <th class="none">Costi Extra Op Bi</th>
                                    <th class="all">Totale Prenotazione</th>
                                    <th class="none">Costo KIT</th>
                                    <th class="none">Costo Cambio</th>
                                    <th class="none">Costo CI</th>
                                    <th class="none">Costo Extra CI</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="all text-center"></th>
                                    <th class="none text-left"></th>
                                    <th class="all text-uppercase"></th>
                                    <th class="all"></th>
                                    <th class="none"></th>
                                    <th class="none"></th>
                                    <th class="all"></th>
                                    <th class="none">Ore Pulizie</th>
                                    <th class="none">Costo Ore Pulizie</th>
                                    <th class="all">Tot Costo <br> C-IN</th>
                                    <th class="all">Tot <br> Pulizie</th>
                                    <th class="all">Supervisor <br> Pulizie</th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all">Costo <br> C-OUT</th>
                                    <th class="all">Costo <br> Extra <br> C-OUT</th>
                                    <th class="all">Cash <br> Op. C-OUT</th>
                                    <th class="all">Cash <br> Simo <br> C-OUT</th>
                                    <th class="all">Mancia Cliente</th>
                                    <th class="all"></th>
                                    <th class="all">Costo Op.Cambio</th>
                                    <th class="none">Extra Mondezza</th>
                                    <th class="none">Costi Extra Op Bi</th>
                                    <th class="all">Totale Prenotazione</th>
                                    <th class="none">Costo KIT</th>
                                    <th class="none">Costo Cambio</th>
                                    <th class="none">Costo CI</th>
                                    <th class="none">Costo Extra CI</th>
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
                fixedHeader: true,

                ajax: {
                    url:"{{ route('viste.datas') }}",
                    data: function (d) {
                        d.year = $('select[name=year] option').filter(':selected').val();
                        d.month = $('select[name=month] option').filter(':selected').val();
                        d.house = $('#house').val();
                    }
                },

                columns: [
                    {
                        className:      'hidden',
                        orderable:      false,
                        searchable:     false,
                        data:           null,
                        defaultContent: '',
                        cellType:       "th",
                        sortable:       false
                    },
                    {
                        data: null,                               //td:eq(0)
                        render: function (data, type, row)
                        {
                            var houses = houses_typo[row.tx_mask_p_casa];
                            return houses +'</br>' + row.note_alert;
                        },
                        sortable: false,
                    },
                    {data: 'tx_mask_p_sito',                                  //td:eq(1)
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
                    {data: 'header', className: 'text-capitalize'}, //td:eq(2)
                    {data: 'data_arrivo'},                //td:eq(3)
                    {data: 'tx_mask_t1_op_note'},                   //td:eq(4)
                    {data: 'city_tax'},                             //td:eq(5)
                    {data: 'tx_mask_t1_op_pulizie',                 //td:eq(6)
                        render: function (data, type, row)
                        {
                            if(data in op_check_out) {
                                var operatore = op_check_out[data]+ ' ['+data+']';
                            } else {
                                var operatore = 'NaN';
                            }
                            return operatore;
                        },
                    },
                    {data: 'tx_mask_t1_ore_pulizie'},               //td:eq(7)
                    {data: 'costo_orario'},                         //td:eq(8)
                    {data: 'costo_cin'},                         //td:eq(8)
                    {data: 'totale_pulizie'},                       //td:eq(9)
                    {data: 'supervisor_pulizie'},                    //td:eq(10)
                    {data: 'data_partenza'},              //td:eq(11)
                    {data: 'tx_mask_t1_op_checkout',                //td:eq(12)
                        render: function (data, type, row)
                        {
                            if(data in op_check_out) {
                                var operatore = op_check_out[data]+ ' ['+data+']';
                            } else {
                                var operatore = 'NaN';
                            }
                            return operatore;
                        },
                    },
                    {data: 'costo_co'},                             //td:eq(13)
                    {data: 'costo_ex_co'},                          //td:eq(14)
                    {data: 'cash_operatore_co'},                    //td:eq(15)
                    {data: 'cash_simo_co'},                         //td:eq(16)
                    {data: 'mancia_cli'},                           //td:eq(17)
                    {data: 'extra_cash_ospite'},                    //td:eq(18)
                    {data: 'costi_costo_operatore_cambio_biancheria',
                        render: function (data, type, row)
                        {
                            if(row.tx_mask_t1_op_cambio_biancheria in op_check_out) {
                                var operatore = op_check_out[row.tx_mask_t1_op_cambio_biancheria]+ ' ['+row.tx_mask_t1_op_cambio_biancheria+'] <br>' +row.costi_costo_operatore_cambio_biancheria ;
                            } else {
                                var operatore = 'NaN';
                            }
                            return operatore;
                        },
                    },                    //td:eq(19)
                    {data: 'extra_mondezza'},                       //td:eq(20)
                    {data: 'costi_extra_op_bi'},                    //td:eq(20)
                    {data: 'totale_riga'},                          //td:eq(20)
                    {data: 'costi_costo_kit'},                      //td:eq(20)
                    {data: 'costi_costo_cambi'},                    //td:eq(20)
                    {data: 'costi_check_in_self_check_in'},         //td:eq(20)
                    {data: 'tx_mask_t3_p_s_extra_checkin'},         //td:eq(20)
                ],

                rowCallback: function(row, data, index) {
                    $('td:eq(0)', row).addClass('bg-'+houses_color[data.tx_mask_p_casa]); //CASA
                    $('td:eq(0)', row).addClass('text-center'); //CASA
                    $('td:eq(3)', row).addClass('alert-warning');               //DATA-ARRIVO
                    $('td:eq(6)', row).addClass('alert-warning');               //OP. PULIZIE
                    $('td:eq(12)', row).addClass('alert-danger');                //DATA-PARTENZA
                    $('td:eq(13)', row).addClass('alert-danger');                //OP. C-OUT
                    $('td:eq(18)', row).addClass('alert-success');                //MANCIA
                },

                footerCallback: function(row, data, index){
                    var api = this.api(), data;
                    var tot = data.length - 1;
                    if(tot > 0){
                        $( api.column( 10 ).footer() ).html(data[tot].sum_tot_costo_cin);
                        $( api.column( 11 ).footer() ).html(data[tot].sum_tot_pulizie);
                        $( api.column( 12 ).footer() ).html(data[tot].sum_supervisor_pulizie);
                        $( api.column( 15 ).footer() ).html(data[tot].sum_costo_co);
                        $( api.column( 16 ).footer() ).html(data[tot].sum_ex_co);
                        $( api.column( 17 ).footer() ).html(data[tot].sum_cash_operatore_co);
                        $( api.column( 18 ).footer() ).html(data[tot].sum_cash_simo_co);
                        $( api.column( 19 ).footer() ).html(data[tot].sum_mancia_cli);
                        $( api.column( 20 ).footer() ).addClass('alert-success');
                    } else {
                        $( api.column( 10 ).footer() ).html('');
                        $( api.column( 11 ).footer() ).html('');
                        $( api.column( 12 ).footer() ).html('');
                        $( api.column( 15 ).footer() ).html('');
                        $( api.column( 16 ).footer() ).html('');
                        $( api.column( 17 ).footer() ).html('');
                        $( api.column( 18 ).footer() ).html('');
                        $( api.column( 19 ).footer() ).html('');
                        $( api.column( 20 ).footer() ).addClass('alert-success');
                    }

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
                    { width: '5%', targets: 1}, //house
                    { width: '5%', targets: 3}, //cliente
                    { width: '8%', targets: 4}, //data-arrivo
                    { width: '8%', targets: 5}, //data-partenza
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
