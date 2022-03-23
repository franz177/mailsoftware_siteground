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
                                Incassi
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
                                    <th class="all alert-warning" title="Totale lordo incassi
(STAY + Sito + Solo extra)">Lordo</th>
                                    <th class="all alert-warning" title="Incasso lordo base">STAY</th>
                                    <th class="all alert-warning" title="% sito web">Sito</th>
                                    <th class="all alert-warning" title="Pulizie cliente">Pulizie</th>
                                    <th class="all alert-warning">City tax</th>
                                    <th class="all alert-warning" title="Extra cash che il cliente deve al check-out">Extra <br>Cash CO</th>
                                    <th class="all alert-warning" title="Extra cash ritirato al check-out da operatore">Cash <br>Op. C-OUT</th>
                                    <th class="all alert-warning" title="Extra cash ritirato al check-out da Simonetta">Cash <br>Simo C-OUT</th>
                                    <th class="all alert-warning" title="Cash Op. C-OUT +  Cash Simo C-OUT - city tax">Solo <br>extra</th>
                                    <th class="all alert-warning" title="Importo STAY con EXTRA (no siti) = INCASSO al netto della promozione web">STAY <br>+ extra</th>
                                    <th class="all alert-warning" title="Caparra o pagamento in un'unica soluzione da sito web">Incassi <br>banca I</th>
                                    <th class="all alert-warning" title="Saldo cash ospite al check-in">Cash CI</th>
                                    <th class="all alert-warning" title="Saldo BANCA II dell'ospite">Saldo <br>banca II</th>
                                    <th class="all alert-warning" title="API Kross">Pagamento</th>
                                    <th class="all alert-warning" title="Consuntivo - preventivo
(STAY + Extra cash CO) - (Pagamento + Solo extra)">Cons. - Prev.</th>
                                    <!-- <th class="all alert-warning" title="Media aritmetica dei costi medi a notte">Costo <br>medio</th> -->
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="all text-center"></th>
                                    <th class="none text-left"></th>
                                    <th class="all text-uppercase"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <!-- <th class="all"></th> -->
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
                    url:"{{ route('incassi.data') }}",
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
                    {data: 'tot_lordo_incassi'},
                    {data: 'importo_stay'}, 
                    {data: 'perc_sito'},
                    {data: 'cleaning_fee_amount'},
                    {data: 'city_tax_amount'},
                    {data: 's_checkout'},
                    {data: 'cash_op_cout'},
                    {data: 'cash_simo'},
                    {data: 'solo_extra'},
                    {data: 'stay_extra'},
                    {data: 'banca1'},
                    {data: 's_chin'},
                    {data: 's_b'},
                    {data: 'kross_payment_total_amount'},
                    {data: 'c_p'},
                    //{data: 'c_m'}
                ],

                rowCallback: function(row, data, index) {
                    // $('td:eq(0)', row).addClass('bg-'+houses_color[data.tx_mask_p_casa]); //CASA
                    // $('td:eq(0)', row).addClass('text-center'); //CASA
                    // $('td:eq(3)', row).addClass('alert-warning');               //DATA-ARRIVO
                    // $('td:eq(6)', row).addClass('alert-warning');               //OP. PULIZIE
                    // $('td:eq(12)', row).addClass('alert-danger');                //DATA-PARTENZA
                    // $('td:eq(13)', row).addClass('alert-danger');                //OP. C-OUT
                    // $('td:eq(18)', row).addClass('alert-success');                //MANCIA

                    console.log(data);
                },

                footerCallback: function(row, data, index){
                    var api = this.api(), data;
                    var tot = data.length - 1;
                    return;
                    {{-- if(tot > 0){
                        $( api.column( 10 ).footer() ).html(data[tot].sum_tot_stay);
                        $( api.column( 11 ).footer() ).html(data[tot].sum_saldo_cash);
                        $( api.column( 20 ).footer() ).addClass('alert-success');
                    } else {
                        $( api.column( 10 ).footer() ).html('');
                        $( api.column( 19 ).footer() ).html('');
                        $( api.column( 20 ).footer() ).addClass('alert-success');
                    } --}}

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