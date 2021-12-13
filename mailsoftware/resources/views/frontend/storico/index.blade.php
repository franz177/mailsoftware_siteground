@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
@endsection

@section('content')

    <div class="row hidden">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    Show -
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                {{--                <div class="card-header border-0 pt-5">--}}
                {{--                    <h3 class="card-title align-items-start flex-column">--}}
                {{--                            <span class="card-label font-weight-bolder text-dark text-uppercase">--}}
                {{--                            </span>--}}
                {{--                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>--}}
                {{--                    </h3>--}}
                {{--                </div>--}}
                <div class="card-body pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_20">
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
                                    <th class="all text-center">
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
                                    <th class="none">city tax</th>
                                    <th class="all">nominativo</th>
                                    <th class="all">arrivo</th>
                                    <th class="all">partenza</th>
                                    <th class="all">doc</th>
                                    <th class="all">Mail Inviate</th>
                                    <th class="all">WA</th>
                                    <th class="all">Cambi</th>
                                    <th class="none">Importo STAY</th>
                                    <th class="none">KIT Biancheria</th>
                                    <th class="none">Cash CI</th>
                                    <th class="none">Extra Cash CO</th>
                                    <th class="none">Extra Kit</th>
                                    <th class="none">Extra Biancheria</th>
                                    <th class="none">Threads</th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="ajaxModel" aria-hidden="true" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeading">
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-6">
                        <div class="col-sm-12 col-md-9">
                            <div class="mb-8 d-flex flex-column">
                                <h5 class="text-muted font-weight-bolder font-size-lg">Testo Inviato:</h5>
                                <p id="modalTesto"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Chiudi</button>
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
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            var houses_color = {!! $houses_color !!};
            var houses_typo = {!! $houses_typo !!};
            var houses_gestore = {!! $houses_gestore !!};
            var sites_kross = {!! $sites_kross !!};
            var sites = {!! $sites !!};
            var op_checkin = {!! $op_checkin !!};

            var table = $('#sample_20');

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
                    url:"{{ route('storico.index') }}"
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
                    {data: 'casa',
                        render: function (data, type, row)
                        {
                            var house = houses_typo[data];
                            var house_gestore = houses_gestore[data];
                            var house_gestore = row.gestore_casa;
                            var op_check_in ='';
                            if(row.op_check_in != 'chiave'){
                                op_check_in = '<br> – <br>' + row.op_check_in;
                            }
                            return house + '<br>' + house_gestore + op_check_in;
                        }, sortable: true,
                    },
                    {data: 'tx_mask_p_sito',
                        render: function (data, type, row)
                        {
                            if(data in sites_kross){
                                var site = sites_kross[data];
                            } else if(data in sites) {
                                var site = sites[data];
                            } else {
                                var site = data;
                            }

                            return site;
                        }, className:'text-center', sortable: true,
                    },
                    {data: 'city_tax', sortable: false},
                    {data: 'header'},
                    { data: {
                            _:    "data_arrivo.display",
                            sort: "data_arrivo.timestamp"
                        },
                        name:'data_arrivo.timestamp'
                    },
                    { data: {
                            _:    "data_partenza.display",
                            sort: "data_partenza.timestamp"
                        },
                        name:'data_partenza.timestamp'
                    },
                    {data: 'documenti'},
                    {data: 'thread', name: 'thread'},
                    {data: 'whatsapp_stato', className: 'text-center', sortable: false},
                    {data: 'cambi'},
                    {data: 'importo_stay'},
                    {data: 'kit_base'},
                    {data: 'saldo_cash_cin'},
                    {data: 'extra_checkout'},
                    {data: 'extra_kit'},
                    {data: 'extra_biancheria'},
                    {data: 'threads', name: 'threads', sortable: false},

                ],

                rowCallback: function(row, data, index) {
                    let wa_friendly = ' (0)';

                    if(data.whatsapp_stato == 1){
                        $('td:eq(8)', row).addClass('bg-whatsapp');
                        wa_friendly = ' (DOC)';
                    } else if(data.whatsapp_stato == 2) {
                        $('td:eq(8)', row).addClass('bg-whatsapp-2');
                        wa_friendly = ' (IN)';
                    } else if(data.whatsapp_stato == 3) {
                        $('td:eq(8)', row).addClass('bg-whatsapp-2');
                        wa_friendly = ' (HOUSE)';
                    }else if(data.whatsapp_stato == 4) {
                        $('td:eq(8)', row).addClass('bg-whatsapp-3');
                        wa_friendly = ' (OUT)';
                    } else if(data.whatsapp_stato == 0) {
                        $('td:eq(8)', row).addClass('bg-whatsapp-0');
                        wa_friendly = ' (MAIL)';
                    }

                    console.log(data.alert_booking);


                    $('td:eq(0)', row).addClass('bg-'+houses_color[data.casa]);
                    // $('td:eq(2)', row).addClass('bg-'+houses_color[data.casa]);
                    $('td:eq(3)', row).addClass('alert-warning text-left');
                    $('td:eq(4)', row).addClass('alert-warning');
                    $('td:eq(4)', row).append('<p class="mt-2">h: '+data.tx_mask_t1_ora_checkin+'</p>');
                    $('td:eq(4)', row).append('<p class="mt-2 font-size-sm">'+data.op_pulizie+'</p>');
                    $('td:eq(5)', row).addClass('alert-danger');
                    $('td:eq(5)', row).append('<p class="mt-2">h: '+data.tx_mask_t1_ora_checkout+'</p>');
                    $('td:eq(5)', row).append('<p class="mt-2 font-size-sm">'+data.op_check_out+'</p>');
                    $('td:eq(8)', row).html('<i class="icon-2x la text-dark-50 socicon-whatsapp"></i>' +
                        '<br>' +
                        '<input type="range" class="whatsappRange" min="-1" max="4" data-id="'+data.whatsapp_id+'" value="'+data.whatsapp_stato+'" list="tickmarks">' +
                        '<datalist id="tickmarks">' +
                        '<option value="-1" label="-1"></option>'+
                        '<option value="0" label="0"></option>'+
                        '<option value="1" label="1"></option>'+
                        '<option value="2" label="2"></option>'+
                        '<option value="3" label="2.1"></option>'+
                        '<option value="4" label="3"></option>'+
                        '</datalist>'+
                        '<br>' +
                        ''+ wa_friendly
                    );
                    if(!data.thread) {
                        $('td:eq(7)', row).html('');
                    } else {
                        $('td:eq(7)', row).html(data.thread);
                        $('td:eq(7)', row).addClass('bg-'+ data.color +' text-left');
                    }

                },

                // setup buttons extentension: http://datatables.net/extensions/buttons/
                buttons: [
                    { extend: 'print', className: 'btn dark btn-outline' },
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
                    { className: 'control', targets:   0, width: '5%' }, //plus
                    { width: '5%', targets: 1}, //house
                    { width: '5%', targets: 2}, //site
                    { width: '5%', targets: 3}, //uid
                    { width: '20%', targets: 4}, //Nominativo
                    { width: '10%', targets: 5}, //arrivo
                    { width: '10%', targets: 6}, //partenza
                    { width: '8%', targets: 7}, //doc
                    { width: '12%', targets: 8}, //gestore
                    { width: '10%', targets: 9}, //op-Checkin
                ],

                // order: [
                //     5, 'asc',
                //     6, 'asc'
                // ],

                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": -1,

                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            });

            $('body').on('input', '.whatsappRange', function () {
                var whatsapp_stato = $(this).val();
                var whatsapp_id = $(this).data('id');
                // console.log(whatsapp_id+' '+whatsapp_value);
                // confirm("Si vuole procedere alla modifica dello stato WhatsApp?");
                $.ajax({
                    type: "PUT",
                    url: "/whatsapp/" + whatsapp_id,
                    dataType: 'json',
                    data: {whatsapp_stato:whatsapp_stato},
                    success: function (data) {
                        // console.log(data.message_update+' '+whatsapp_id+' '+whatsapp_value);
                        alert(data.message_update);
                        oTable.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            });

            $('body').on('click', '.showThread', function () {
                var thread_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "/threads/" + thread_id,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        $('#modalHeading').html(data.thread_title+' <span class="text-muted mt-3 font-weight-bold font-size-sm">'+ data.threads.user.name +' '+ data.threads.user.lastname +'</span>');
                        $('#ajaxModel').modal('show');
                        $("#modalTesto").html(data.threads.testo);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                })
            });

            $("input[type=range]").mousemove(function (e) {
                var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
                var percent = val * 100;

                $(this).css('background-image',
                    '-webkit-gradient(linear, left top, right top, ' +
                    'color-stop(' + percent + '%, #34B7F1), ' +
                    'color-stop(' + percent + '%, #FFF)' +
                    ')');

                $(this).css('background-image',
                    '-moz-linear-gradient(left center, #34B7F1 0%, #34B7F1 ' + percent + '%, #FFF ' + percent + '%, #FFF 100%)');
            });

        });
    </script>
@endsection
