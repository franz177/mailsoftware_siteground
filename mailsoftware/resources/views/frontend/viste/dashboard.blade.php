@extends('layouts.templat<e_view')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
@endsection

@section('content')

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
            let houses = {!! $houses !!};
            data_search.year_from = {!! now()->year !!};

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

            getData(data_search.year_from, data_search.year_to, data_search.house_from, data_search.house_to);

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
                                    label: "Totale per Naz.",
                                }
                            }
                        }
                    }
                }
            };

            var chartPie = new ApexCharts(document.querySelector("#chartPie"), optionsPie);
            chartPie.render();
            let year_options;
            $(document).on('change', '#year_from', function(){
                data_search.year_from = $(this).val();

                getData(data_search.year_from, data_search.year_to, data_search.house_from, data_search.house_to);

                $.each(years, function(year, value){
                    if( data_search.year_from && data_search.year_from < value.year){
                        year_options += '<option value="'+value.year+'">'+value.year+'</option>';
                    } else {
                        $('#year_to').html('<option value="0" selected> Scegli...</option>');
                    }
                });
                if(year_options){
                    $('#year_to').append(year_options);
                    $('#year_to').prop("disabled", false);
                } else {
                    $('#year_to').prop("disabled", true);
                }

            });

            $(document).on('change', '#year_to', function(){
                data_search["year_to"] = $(this).val();
                getData(data_search.year_from, data_search.year_to, data_search.house_from, data_search.house_to);
                $('#alert_text').html('<strong>Attenzione</strong>, verranno confrontati l\'anno <strong>'+data_search.year_from+'</strong> e l\'anno <strong>'+data_search.year_to+'</strong>')
                $('#house_from').prop("disabled", false);
                year_options = false;
            });

            let house_options;
            $(document).on('change', '#house_from', function(){
                data_search.house_from = $(this).val();

                getData(data_search.year_from, data_search.year_to, data_search.house_from, data_search.house_to);

                $.each(houses, function(house, value){
                    if( data_search.house_from && data_search.house_from < house){
                        house_options += '<option value="'+house+'">'+value+'</option>';
                    } else {
                        $('#house_to').html('<option value="0" selected> Scegli...</option>');
                    }
                });
                if(house_options){
                    $('#house_to').append(house_options);
                    $('#house_to').prop("disabled", false);
                    $('#alert_text').append(' per la casa <strong>'+houses[data_search.house_from]+'</strong>')
                } else {
                    $('#house_to').prop("disabled", true);
                }

            });

            $(document).on('change', '#house_to', function(){
                data_search["house_to"] = $(this).val();
                getData(data_search.year_from, data_search.year_to, data_search.house_from, data_search.house_to);
                $('#alert_text').append(' e la casa <strong>'+houses[data_search.house_to]+'</strong>')
                house_options = false;
            });

            function getData(year_from, year_to, house_from, house_to){
                $.ajax({
                    url: "{{ route('api.dashboard') }}",
                    data: {year_from:year_from, year_to:year_to, house_from:house_from, house_to:house_to},
                    type:"GET",
                    dataType: 'json',
                    async: true,
                    cache: false,
                    success: function(data) {
                        console.log(data);
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





    </script>
@endsection
