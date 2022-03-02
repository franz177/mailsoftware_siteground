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
                            <table class="table table-striped table-bordered  dt-responsive" id="table-incassi">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="all">Mese</th>
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
                                    <th class="all alert-warning" title="Costo medio a notte
(bisogna preparare il calcolo)">Costo <br>medio</th>                                    
                                </tr>
                                </thead>

                                <tfoot class="total-row">
                                <tr>
                                    <th></th>
                                    <th class="all">Anno</th>
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

            var houses_typo = {!! $houses_typo !!};

            var tables = $('#table-incassi');

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
                paging: false,
                searching: false,
                bSort: false,

                ajax: {
                    url:"{{ route('incomes.datas') }}",
                    data: function (d) {
                        d.year = $('select[name=year] option').filter(':selected').val();
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
                    {data: 'month'},
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
                    {data: 'c_m'}
                ],

                rowCallback: function(row, data, index) {
                    $('td:eq(1)', row).addClass('text-right');
                    $('td:eq(2)', row).addClass('text-right');
                    $('td:eq(3)', row).addClass('text-right');
                    $('td:eq(4)', row).addClass('text-right');
                    $('td:eq(5)', row).addClass('text-right');
                    $('td:eq(6)', row).addClass('text-right');
                    $('td:eq(7)', row).addClass('text-right');
                    $('td:eq(8)', row).addClass('text-right');
                    $('td:eq(9)', row).addClass('text-right');
                    $('td:eq(10)', row).addClass('text-right');
                    $('td:eq(11)', row).addClass('text-right');
                    $('td:eq(12)', row).addClass('text-right');
                    $('td:eq(13)', row).addClass('text-right');
                    $('td:eq(14)', row).addClass('text-right');
                    $('td:eq(15)', row).addClass('text-right');
                    $('td:eq(16)', row).addClass('text-right');
                },

                footerCallback: function(row, data, index){
                    var api = this.api(), data;
                    var tot = data.length - 1;
                    {{-- if(tot > 0){ --}}
                        $( api.column( 2 ).footer() ).html(data[tot].sum_tot_lordo_incassi).addClass('text-right');
                        $( api.column( 3 ).footer() ).html(data[tot].sum_importo_stay).addClass('text-right');
                        $( api.column( 4 ).footer() ).html(data[tot].sum_perc_sito).addClass('text-right');
                        $( api.column( 5 ).footer() ).html(data[tot].sum_cleaning_fee_amount).addClass('text-right');
                        $( api.column( 6 ).footer() ).html(data[tot].sum_city_tax_amount).addClass('text-right');
                        $( api.column( 7 ).footer() ).html(data[tot].sum_s_checkout).addClass('text-right');
                        $( api.column( 8 ).footer() ).html(data[tot].sum_cash_op_cout).addClass('text-right');
                        $( api.column( 9 ).footer() ).html(data[tot].sum_cash_simo).addClass('text-right');
                        $( api.column( 10 ).footer() ).html(data[tot].sum_solo_extra).addClass('text-right');
                        $( api.column( 11 ).footer() ).html(data[tot].sum_stay_extra).addClass('text-right');
                        $( api.column( 12 ).footer() ).html(data[tot].sum_banca1).addClass('text-right');
                        $( api.column( 13 ).footer() ).html(data[tot].sum_s_chin).addClass('text-right');
                        $( api.column( 14 ).footer() ).html(data[tot].sum_s_b).addClass('text-right');
                        $( api.column( 15 ).footer() ).html(data[tot].sum_kross_payment_total_amount).addClass('text-right');
                        $( api.column( 16 ).footer() ).html(data[tot].sum_c_p).addClass('text-right');
                        $( api.column( 17 ).footer() ).html('').addClass('text-right');
                    {{-- } else {
                        $( api.column( 2 ).footer() ).html('');
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
                    //{ width: '11%', targets: 7}, //extra dovuto
                    //{ width: '11%', targets: 8}, //extra operatore
                    //{ width: '11%', targets: 9}, //extra Simonetta
                ],

                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],

                // set the initial value
                "pageLength": -1,

                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizontal scrollable datatable
            });
            $('#submit').on('click', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#removeFilter').on('click', function(e) {
                $('#house').val([]);
                oTable.draw();
            });
        });

    </script>
@endsection
