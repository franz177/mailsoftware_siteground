@extends('layouts.template')

@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Download Prenotazioni in Excel
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" id="form_flow_text">
                    @csrf
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-2 d-flex flex-column">
                                        <div class="input-group has-validation">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <select multiple="multiple" class="form-control" id="years" name="years[]" style="min-height: 150px;">
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
                                            <select multiple="multiple" class="form-control" id="house" name="house[]"style="min-height: 150px;">
                                                @foreach($houses_typo as $uid => $name)
                                                    <option value="{{ $uid }}">{{ $name }}</option>
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
                                                    <i class="fas fa-adjust"></i>
                                                </span>
                                            </div>
                                            <select multiple="multiple" class="form-control" id="bookings_status" name="bookings_status[]" style="min-height: 150px;">
                                                @foreach($bookings_status as $booking_status)
                                                    <option value="{{ $booking_status->tx_mask_cod_reservation_status }}">{{ $booking_status->tx_mask_cod_reservation_status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-2 d-flex flex-column">
                                        <div class="input-group has-validation">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-list"></i>
                                                </span>
                                            </div>
                                            <select multiple="multiple" class="form-control" id="column_default" name="column_default[]"style="min-height: 150px;">
                                                @foreach($columns_default as $column)
                                                    <option value="{{ $column }}" {{ in_array($column, $columns_selected) ? 'selected' : '' }}>{{ $column }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-2 d-flex flex-column">
                                        <div class="input-group has-validation">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-list"></i>
                                                </span>
                                            </div>
                                            <select multiple="multiple" class="form-control" id="column" name="column[]"style="min-height: 150px;">
                                                @foreach($columns as $column)
                                                    @if(!in_array($column, $columns_default))
                                                        <option value="{{ $column }}" {{ in_array($column, $columns_default) ? 'selected' : '' }}>{{ $column }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">

                    </div>
                </div>
                <div class="card-footer justify-content-between">
                    <div class="row mb-8">
                        <div class="col-md-12 text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-light-success" name="submit" id="submit">Excel Personalizzato</button>
                                <a href="#" id="download" class="btn btn-instagram font-weight-bold hidden">{{ __('Download Excel') }}</a>
                                <button type="button" class="btn btn-light-instagram" name="removeFilter" id="removeFilter">Rimuovi Filtri</button>
                                <a href="{{ route('excel.export') }}" class="btn btn-success font-weight-bold">{{ __('Excel Completo') }}</a>

                            </div>
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

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            var token = '{{csrf_token()}}';

            $('#submit').on('click', function (e) {
                let year = $('#years').val();
                let house = $('#house').val();
                let column_default = $('#column_default').val();
                let column = $('#column').val();
                let bookings_status = $('#bookings_status').val();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{ route('excel.custom_export') }}",
                    data: {
                        _method:'POST',
                        _token:token,
                        year:year,
                        house:house,
                        column_default:column_default,
                        column:column,
                        bookings_status:bookings_status,
                    },
                    success: function (response, textStauts, request) {
                        console.log(response.filename);
                        $('#download').removeClass('hidden');
                        $('#download').attr('href', '/excel/download_custom_export/' + response.filename + '');
                        console.log($('#download').attr('href'));
                    },
                    error: function (data) {
                        console.log('Error:', data);

                    }
                });
            });
            $('#download').on('click', function (e) {
                $('#download').addClass('hidden');
            });
            $('#removeFilter').on('click', function (e) {
                location.reload();
            });
        });

    </script>
@endsection
