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
                                Costi Mensile - {{ $message }}
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_20">
                                <thead class="text-uppercase">
                                <tr>
                                    <th></th>
                                    <th class="all">Mesi</th>
                                    <th class="all">Tot Pulizie</th>
{{--                                    <th class="all">Tot Supervisor</th>--}}
{{--                                    <th class="all">Tot C-OUT</th>--}}
{{--                                    <th class="all">Tot EXTRA C-OUT</th>--}}
{{--                                    <th class="all">Tot CASH OP. C-OUT</th>--}}
{{--                                    <th class="all">Tot CASH SIMO C-OUT</th>--}}
{{--                                    <th class="all">Tot CAMBI BIANCHERIA</th>--}}
{{--                                    <th class="all">Tot CITY TAX</th>--}}
{{--                                    <th class="all">Tot MANCIA CLIENTE</th>--}}
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

            var table = $('#sample_20');

            var oTable = table.DataTable({
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
                    url:"{{ route('simonetta.data') }}"
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
                    {data: 'month'},                                    //td:eq(0)
                    {data: 'stay'},                                    //td:eq(1)
                    // {data: '0'},                                    //td:eq(2)
                    // {data: '0'},                                    //td:eq(3)
                    // {data: '0'},                                    //td:eq(4)
                    // {data: '0'},                                    //td:eq(5)
                    // {data: '0'},                                    //td:eq(6)
                    // {data: '0'},                                    //td:eq(7)
                    // {data: '0'},                                    //td:eq(8)
                    // {data: '0'},                                    //td:eq(9)


                ],

                rowCallback: function(row, data, index) {

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
