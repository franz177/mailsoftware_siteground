@extends('layouts.template_view')

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
                                Globale
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <table class="table table-striped table-bordered  dt-responsive" id="sample_7">
                            <thead>
                                <th></th>
                                <th>YEAR</th>
                                <th>STAY</th>
                            </thead>
                            <tbody></tbody>
                        </table>
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

            var table = $('#sample_7');

            var oTable = table.DataTable({
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
                    url:"{{ route('viste.index') }}",
                    type: "GET",
                    datatype: "JSON",
                    // data:
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
                    {data: 'YEAR', name: 'YEAR'},
                    {data: 'STAY', name: 'STAY'},

                ],

                rowCallback: function() {

                },

                buttons: [
                    { extend: 'pdf', className: 'btn green btn-outline' },
                    { extend: 'excel', className: 'btn purple btn-outline ' }
                ],

                responsive: {
                    details: {
                        type: 'column',
                        target: 'th',
                    }
                },
                columnDefs: [
                    { className: 'control', targets:   0, width: '5%' }, //plus
                ],

                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "Tutte"] // change per page values here
                ],
                // set the initial value
                "pageLength": -1,

                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            });

            $('body').on('click', '#submit', function () {
                var years = $('#years').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('viste.index') }}",
                    dataType: 'json',
                    data: {years:years},
                    success: function (data) {
                        console.log(years);
                        // console.log(data.message_update+' '+whatsapp_id+' '+whatsapp_value);
                        // alert(data.message_update);
                        oTable.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });



        let len=0;

        $('body').on('change', '#months', function () {
            len = $('select[name="months[]"] option:selected').length;
            if(len > 0){
                $('#clearMonths').prop('disabled', false);
                $('#seasons').prop('disabled', true);
                $('#sub_seasons').prop('disabled', true);
            } else {
                $('#clearMonths').prop('disabled', true);
                $('#seasons').prop('disabled', false);
                $('#sub_seasons').prop('disabled', false);
            }
        });

        $('body').on('change', '#seasons', function () {
            if($(this).val() != 999){
                $('#months').prop('disabled', true);
                $('#sub_seasons').prop('disabled', true);
            } else {
                $('#months').prop('disabled', false);
                $('#sub_seasons').prop('disabled', false);
            }
        });

        $('body').on('change', '#sub_seasons', function () {
            if($(this).val() != 999){
                $('#months').prop('disabled', true);
                $('#seasons').prop('disabled', true);
            } else {
                $('#months').prop('disabled', false);
                $('#seasons').prop('disabled', false);
            }
        });

        $('body').on('click', '#clearMonths', function () {
            $("#months :selected").prop('selected', false);
            $('#seasons').prop('disabled', false);
            $('#sub_seasons').prop('disabled', false);
        });

        $('body').on('click', '#removeFilter', function () {
            $("#years :selected").prop('selected', false);
        });


    </script>
@endsection
