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
                                Costi Aziendali per Mesi
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
                                            <select multiple="multiple" class="form-control" id="months" name="months[]" style="min-height: 150px;">
                                                @foreach($months as $month => $name)
                                                    <option value="{{ $month }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-light btn-sm btn-block" id="clearMonths" name="clearMonths">Pulisci</a>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-2 d-flex flex-column">
                                        <div class="input-group has-validation">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-home"></i>
                                                </span>
                                            </div>
                                            <select multiple="multiple" class="form-control" id="houses" name="houses[]" style="min-height: 150px;">
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
                        <h3> Anno 2021 </h3>
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
                                    <th class="all">Case</th>
                                    <th class="all">Carta Igienica</th>
                                    <th class="all">Case Sel</th>

                                </tr>
                                </thead>
                                <tfoot class="total-row">
                                <tr>
                                    <th></th>
                                    <th class="all"></th>
                                    <th class="all"></th>
                                    <th class="all"></th>

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
                    url:"{{ route('costi_aziendali.data') }}",
                    data: function (d) {
                        d.months = $('#months').val();
                        d.houses = $('#houses').val();
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
                    {data: 'case'},
                    {data: 'carta_igienica'},
                    {data: 'case_sel'},


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
                    // { className: 'total-column', targets: 9},
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
