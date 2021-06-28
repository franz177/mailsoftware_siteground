@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
@endsection

@section('content')
    <form action="" method="POST" enctype="multipart/form-data" id="form_flow_text">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="row mb-6">
                                <div class="col-md-2">
                                    <div class="mb-2 d-flex flex-column">
                                        <div class="input-group has-validation">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <select class="form-control text-uppercase" name="year_from" id="year_from">
                                                <option value="" selected> tutti</option>
                                                @foreach($years as $year)
                                                    <option value="{{ $year->year }}">{{ $year->year }}</option>
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
                                            <select class="form-control text-uppercase" name="year_to" id="year_to" disabled>
                                                <option value="" selected> Scegli...</option>
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
                                            <select class="form-control text-uppercase" name="year_from" id="year_from">
                                                <option value="" selected> tutte</option>
                                                @foreach($years as $year)
                                                    <option value="{{ $year->year }}">{{ $year->year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p id="alert_text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row ">
        <div class="col-sm-12 col-lg-4">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <h4>Prenotazioni</h4>
                </div>
                <div class="card-body">
                    <div id="chartDonut"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <h4>Nazionalità</h4>
                </div>
                <div class="card-body">
                    <div id="chartPie"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <h4>Prenotazioni</h4>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables/datatables.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script type="text/javascript">

        let data_search = new Object();

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            let years = {!! $years !!};
            let year_from;
            let year_to;

            var optionsDonut = {
                chart: {
                    type: 'donut',
                },
                legend: {
                    show: false,
                },

                labels: [],
                series: [],
                animate: true,

                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: "Totale",
                                }
                            }
                        }
                    }
                }
            }

            var chartDonut = new ApexCharts(document.querySelector("#chartDonut"), optionsDonut);
            chartDonut.render();

            getData(year_from, year_to);

            var optionsPie = {
                chart: {
                    type: 'donut',
                },
                legend: {
                    show: false,
                },

                labels: [],
                series: [],
                animate: true,

                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: "Totale",
                                }
                            }
                        }
                    }
                }
            };

            var chartPie = new ApexCharts(document.querySelector("#chartPie"), optionsPie);
            chartPie.render();
            let anni;
            $(document).on('change', '#year_from', function(){
                year_from = $(this).val();

                getData(year_from, year_to);

                if (!year_to)
                    $.each(years, function(anno, value){
                        if( year_from && year_from < value.year){
                            anni += '<option value="'+value.year+'">'+value.year+'</option>';
                        } else {
                            $('#year_to').html('<option value="0" selected> Scegli...</option>');
                        }
                    });
                if(anni){
                    $('#year_to').append(anni);
                    $('#year_to').prop("disabled", false);
                } else {
                    $('#year_to').prop("disabled", true);
                }

                data_search.year_from = year_from;

            });

            $(document).on('change', '#year_to', function(){
                year_to = $(this).val();
                getData(year_from, year_to);
            });

            function getData(year_from, year_to){
                $.ajax({
                    url: "{{ route('api.dashboard') }}",
                    data: {year_from:year_from, year_to:year_to},
                    type:"GET",
                    dataType: 'json',
                    async: true,
                    cache: false,
                    success: function(data) {
                        // console.log(data);
                        chartDonut.updateOptions({
                            labels: data.dataReservations.labels,
                            animate: true,
                        });
                        chartDonut.updateSeries(reset(data.dataReservations));
                        chartPie.updateOptions({
                            labels: data.dataCountries.labels,
                            animate: true,
                        });
                        chartPie.updateSeries(resetPie(data.dataCountries));
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            }

            function reset(data) {
                optionsDonut.series = data.series;
                return optionsDonut.series;
            }
            function resetPie(data) {
                optionsPie.series = data.series;
                return optionsPie.series;
            }
        });



        $(document).on('change', '#year_to', function(){
            data_search["year_to"] = $(this).val();
            $('#alert_text').html('<strong>Attenzione</strong>, verranno confrontati l\'anno <strong>'+data_search.year_from+'</strong> e l\'anno <strong>'+data_search.year_to+'</strong>')
        });

    </script>
@endsection
