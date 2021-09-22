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
                                Costi Mensile
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive" >
{{--                            <table class="table table-striped table-bordered  dt-responsive" id="sample_20">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th></th>--}}
{{--                                    <th class="all text-center">--}}
{{--                                            <span class="svg-icon svg-icon-primary svg-icon-2x">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                                        <rect x="0" y="0" width="24" height="24"/>--}}
{{--                                                        <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>--}}
{{--                                                    </g>--}}
{{--                                                </svg>--}}
{{--                                            </span>--}}
{{--                                    </th>--}}
{{--                                    <th class="none text-left">--}}
{{--                                            <span class="svg-icon svg-icon-primary svg-icon-2x">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                                        <rect x="0" y="0" width="24" height="24"/>--}}
{{--                                                        <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"/>--}}
{{--                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6"/>--}}
{{--                                                    </g>--}}
{{--                                                </svg>--}}
{{--                                            </span>--}}
{{--                                    </th>--}}
{{--                                    <th class="all text-uppercase">Cliente</th>--}}
{{--                                    <th class="all">Arrivo</th>--}}
{{--                                    <th class="none">Note</th>--}}
{{--                                    <th class="none">CityTax</th>--}}
{{--                                    <th class="all">Op. Pulizie</th>--}}
{{--                                    <th class="none">Ore Pulizie</th>--}}
{{--                                    <th class="none">Costo Ore Pulizie</th>--}}
{{--                                    <th class="all">Tot <br> Pulizie</th>--}}
{{--                                    <th class="all">Supervisor <br> Pulizie</th>--}}
{{--                                    <th class="all">Partenza</th>--}}
{{--                                    <th class="all">Op. <br> C-OUT</th>--}}
{{--                                    <th class="all">Costo <br> C-OUT</th>--}}
{{--                                    <th class="all">Costo <br> Extra <br> C-OUT</th>--}}
{{--                                    <th class="all">Cash <br> Op. C-OUT</th>--}}
{{--                                    <th class="all">Cash <br> Simo <br> C-OUT</th>--}}
{{--                                    <th class="all">Mancia Cliente</th>--}}
{{--                                    <th class="none">Extra Cash dell'ospite al C-OUT</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}

{{--                            </table>--}}
                        </div>
                    </div>

                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_21">
                                <thead>
                                <tr>
                                    <th></th>
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
                                    <th class="none text-left">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6"/>
                                                    </g>
                                                </svg>
                                            </span>
                                    </th>
                                    <th class="all text-uppercase">Cliente</th>
                                    <th class="all">Arrivo</th>
                                    <th class="none">Note</th>
                                    <th class="none">CityTax</th>
                                    <th class="all">Op. Pulizie</th>
                                    <th class="none">Ore Pulizie</th>
                                    <th class="none">Costo Ore Pulizie</th>
                                    <th class="all">Tot <br> Pulizie</th>
                                    <th class="all">Supervisor <br> Pulizie</th>
                                    <th class="all">Partenza</th>
                                    <th class="all">Op. <br> C-OUT</th>
                                    <th class="all">Costo <br> C-OUT</th>
                                    <th class="all">Costo <br> Extra <br> C-OUT</th>
                                    <th class="all">Cash <br> Op. C-OUT</th>
                                    <th class="all">Cash <br> Simo <br> C-OUT</th>
                                    <th class="all">Mancia Cliente</th>
                                    <th class="none">Extra Cash dell'ospite al C-OUT</th>
                                    <th class="all">Costo Op.Cambio</th>
                                    <th class="none">Note Contabili</th>
                                    <th class="none">Note per Noi</th>
                                    <th class="none">Extra Mondezza</th>
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
                                    <th class="none">Note Contabili</th>
                                    <th class="none">Note per Noi</th>
                                    <th class="none">Extra Mondezza</th>
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
            var op_check_out = {!! $op_check_out !!};

            var table = $('#sample_20');
            var tables = $('#sample_21');

            {{--var oTable = table.DataTable({--}}
            {{--    // Internationalisation. For more info refer to http://datatables.net/manual/i18n--}}
            {{--    "language": {--}}
            {{--        "aria": {--}}
            {{--            "sortAscending": ": attivare per ordinare la colonna in ordine crescente",--}}
            {{--            "sortDescending": ": attivare per ordinare la colonna decrescente"--}}
            {{--        },--}}
            {{--        "emptyTable": "Nessun dato trovato nella Tabella",--}}
            {{--        "info": "Visualizzati da _START_ a _END_ di _TOTAL_ record",--}}
            {{--        "infoEmpty": "Nessuna voce trovata",--}}
            {{--        "infoFiltered": "(Filtrato 1 di _MAX_ record totali)",--}}
            {{--        "lengthMenu": "_MENU_ Righe",--}}
            {{--        "search": "Cerca:",--}}
            {{--        "zeroRecords": "Nessuna corrispondenza trovata"--}}
            {{--    },--}}

            {{--    processing: true,--}}
            {{--    serverSide: true,--}}

            {{--    ajax: {--}}
            {{--        url:"{{ route('viste.data') }}"--}}
            {{--    },--}}

            {{--    columns: [--}}
            {{--        {--}}
            {{--            className:      '',--}}
            {{--            orderable:      false,--}}
            {{--            searchable:     false,--}}
            {{--            data:           null,--}}
            {{--            defaultContent: '',--}}
            {{--            cellType: "th",--}}
            {{--            sortable: false--}}
            {{--        },--}}
            {{--        {--}}
            {{--            data: 'casa',                               //td:eq(0)--}}
            {{--            render: function (data, type, row)--}}
            {{--            {--}}
            {{--                var house = houses_typo[data];--}}
            {{--                return house;--}}
            {{--            },--}}
            {{--            sortable: false,--}}
            {{--        },--}}
            {{--        {data: 'sito',                                  //td:eq(1)--}}
            {{--            render: function (data, type, row)--}}
            {{--            {--}}
            {{--                if(data in sites_kross){--}}
            {{--                    var site = sites_kross[data];--}}
            {{--                } else {--}}
            {{--                    var site = data;--}}
            {{--                }--}}
            {{--                return site;--}}
            {{--            }, className:'text-left', sortable: false,--}}
            {{--        },--}}
            {{--        {data: 'header', className: 'text-capitalize'}, //td:eq(2)--}}
            {{--        {data: 'tx_mask_p_data_arrivo'},                //td:eq(3)--}}
            {{--        {data: 'tx_mask_t1_op_note'},                   //td:eq(4)--}}
            {{--        {data: 'city_tax'},                             //td:eq(5)--}}
            {{--        {data: 'tx_mask_t1_op_pulizie',                 //td:eq(6)--}}
            {{--            render: function (data, type, row)--}}
            {{--            {--}}
            {{--                if(data in op_check_out) {--}}
            {{--                    var operatore = op_check_out[data];--}}
            {{--                } else {--}}
            {{--                    var operatore = 'NaN';--}}
            {{--                }--}}
            {{--                return operatore;--}}
            {{--            },--}}
            {{--        },--}}
            {{--        {data: 'tx_mask_t1_ore_pulizie'},               //td:eq(7)--}}
            {{--        {data: 'costo_orario'},                         //td:eq(8)--}}
            {{--        {data: 'totale_pulizie'},                       //td:eq(9)--}}
            {{--        {data: null,                                    //td:eq(10)--}}
            {{--            render: function (data, type, row)--}}
            {{--            {--}}
            {{--                if(row.tx_mask_t0_fattura) {--}}
            {{--                    return row.tx_mask_t0_fattura + '<br><span class="font-weight-bolder">&euro; ' + row.tx_mask_t3_p_extra_p + '</span>';--}}
            {{--                }--}}
            {{--                return '<span class="font-weight-bolder">&euro; ' + row.tx_mask_t3_p_extra_p + '</span>';--}}
            {{--            }--}}
            {{--        },--}}
            {{--        {data: 'tx_mask_p_data_partenza'},              //td:eq(11)--}}
            {{--        {data: 'tx_mask_t1_op_checkout',                //td:eq(12)--}}
            {{--            render: function (data, type, row)--}}
            {{--            {--}}
            {{--                if(data in op_check_out) {--}}
            {{--                    var operatore = op_check_out[data];--}}
            {{--                } else {--}}
            {{--                    var operatore = 'NaN';--}}
            {{--                }--}}
            {{--                return operatore;--}}
            {{--            },--}}
            {{--        },--}}
            {{--        {data: 'costo_co'},                             //td:eq(13)--}}
            {{--        {data: 'costo_ex_co'},                          //td:eq(14)--}}
            {{--        {data: 'cash_operatore_co'},                    //td:eq(15)--}}
            {{--        {data: 'cash_simo_co'},                         //td:eq(16)--}}
            {{--        {data: 'mancia_cli'},                           //td:eq(17)--}}
            {{--        {data: 'extra_cash_ospite'},                    //td:eq(18)--}}

            {{--    ],--}}

            {{--    rowCallback: function(row, data, index) {--}}
            {{--        $('td:eq(0)', row).addClass('bg-'+houses_color[data.casa]); //CASA--}}
            {{--        // $('td:eq(2)', row).addClass('alert-warning text-left');     //CLIENTE--}}
            {{--        $('td:eq(3)', row).addClass('alert-warning');               //DATA-ARRIVO--}}
            {{--        $('td:eq(6)', row).addClass('alert-warning');               //OP. PULIZIE--}}
            {{--        $('td:eq(11)', row).addClass('alert-danger');                //DATA-PARTENZA--}}
            {{--        $('td:eq(12)', row).addClass('alert-danger');                //OP. C-OUT--}}
            {{--        $('td:eq(17)', row).addClass('alert-success');                //MANCIA--}}

            {{--        if(data.mancia_cli_or < 0){--}}
            {{--            $('td:eq(17)', row).addClass('text-danger');--}}
            {{--        }--}}
            {{--    },--}}

            {{--    // setup buttons extentension: http://datatables.net/extensions/buttons/--}}
            {{--    buttons: [--}}
            {{--        // { extend: 'print', className: 'btn dark btn-outline' },--}}
            {{--        { extend: 'pdf', className: 'btn green btn-outline' },--}}
            {{--        { extend: 'excel', className: 'btn purple btn-outline ' }--}}
            {{--    ],--}}

            {{--    // setup responsive extension: http://datatables.net/extensions/responsive/--}}
            {{--    // setup responsive extension: http://datatables.net/extensions/responsive/--}}
            {{--    responsive: {--}}
            {{--        details: {--}}
            {{--            type: 'column',--}}
            {{--            target: 'th',--}}
            {{--        }--}}
            {{--    },--}}
            {{--    columnDefs: [--}}
            {{--        { className: 'control', targets:   0, width: '3%' }, //plus--}}
            {{--        { width: '5%', targets: 1}, //house--}}
            {{--        { width: '5%', targets: 3}, //cliente--}}
            {{--        { width: '8%', targets: 4}, //data-arrivo--}}
            {{--        { width: '8%', targets: 5}, //data-partenza--}}
            {{--    ],--}}

            {{--    "lengthMenu": [--}}
            {{--        [5, 10, 15, 20, -1],--}}
            {{--        [5, 10, 15, 20, "All"] // change per page values here--}}
            {{--    ],--}}

            {{--    // set the initial value--}}
            {{--    "pageLength": -1,--}}

            {{--    "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable--}}
            {{--});--}}

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
                    url:"{{ route('viste.datas') }}"
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
                    {
                        data: 'tx_mask_p_casa',                               //td:eq(0)
                        render: function (data, type, row)
                        {
                            var houses = houses_typo[data];
                            return houses;
                        },
                        sortable: false,
                    },
                    {data: 'tx_mask_p_sito',                                  //td:eq(1)
                        render: function (data, type, row)
                        {
                            if(data in sites_kross){
                                var sites = sites_kross[data];
                            } else {
                                var sites = data;
                            }
                            return sites;
                        }, className:'text-left', sortable: false,
                    },
                    {data: 'header', className: 'text-capitalize'}, //td:eq(2)
                    {data: 'tx_mask_p_data_arrivo'},                //td:eq(3)
                    {data: 'tx_mask_t1_op_note'},                   //td:eq(4)
                    {data: 'city_tax'},                             //td:eq(5)
                    {data: 'tx_mask_t1_op_pulizie',                 //td:eq(6)
                        render: function (data, type, row)
                        {
                            if(data in op_check_out) {
                                var operatore = op_check_out[data];
                            } else {
                                var operatore = 'NaN';
                            }
                            return operatore;
                        },
                    },
                    {data: 'tx_mask_t1_ore_pulizie'},               //td:eq(7)
                    {data: 'costo_orario'},                         //td:eq(8)
                    {data: 'totale_pulizie'},                       //td:eq(9)
                    {data: null,                                    //td:eq(10)
                        render: function (data, type, row)
                        {
                            if(row.tx_mask_t0_fattura) {
                                return row.tx_mask_t0_fattura + '<br><span class="font-weight-bolder">&euro; ' + row.tx_mask_t3_p_extra_p + '</span>';
                            }
                            return '<span class="font-weight-bolder">&euro; ' + row.tx_mask_t3_p_extra_p + '</span>';
                        }
                    },
                    {data: 'tx_mask_p_data_partenza'},              //td:eq(11)
                    {data: 'tx_mask_t1_op_checkout',                //td:eq(12)
                        render: function (data, type, row)
                        {
                            if(data in op_check_out) {
                                var operatore = op_check_out[data];
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
                    {data: 'costi_costo_operatore_cambio_biancheria'},                    //td:eq(18)
                    {data: 'tx_mask_t3_p_note_cont'},                    //td:eq(18)
                    {data: 'tx_mask_p_note_noi'},                    //td:eq(18)
                    {data: 'extra_mondezza'},                    //td:eq(18)

                ],

                rowCallback: function(row, data, index) {
                    $('td:eq(0)', row).addClass('bg-'+houses_color[data.casa]); //CASA
                    // $('td:eq(2)', row).addClass('alert-warning text-left');     //CLIENTE
                    $('td:eq(3)', row).addClass('alert-warning');               //DATA-ARRIVO
                    $('td:eq(6)', row).addClass('alert-warning');               //OP. PULIZIE
                    $('td:eq(11)', row).addClass('alert-danger');                //DATA-PARTENZA
                    $('td:eq(12)', row).addClass('alert-danger');                //OP. C-OUT
                    $('td:eq(17)', row).addClass('alert-success');                //MANCIA

                    // if(data.mancia_cli_or < 0){
                    //     $('td:eq(17)', row).addClass('text-danger');
                    // }
                },

                footerCallback: function(row, data, index){
                    var api = this.api(), data;
                    console.log(data[0].sum_tot_pulizie);
                    $( api.column( 10 ).footer() ).html(data[0].sum_tot_pulizie);
                    $( api.column( 11 ).footer() ).html(data[0].sum_supervisor_pulizie);
                    $( api.column( 14 ).footer() ).html(data[0].sum_costo_co);
                    $( api.column( 15 ).footer() ).html(data[0].sum_ex_co);
                    $( api.column( 16 ).footer() ).html(data[0].sum_cash_operatore_co);
                    $( api.column( 17 ).footer() ).html(data[0].sum_cash_simo_co);
                    $( api.column( 18 ).footer() ).html(data[0].sum_mancia_cli);
                    $( api.column( 18 ).footer() ).addClass('alert-success');
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
        });

    </script>
@endsection
