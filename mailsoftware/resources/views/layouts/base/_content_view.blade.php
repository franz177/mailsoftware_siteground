{{-- Content --}}
@if (config('layout.content.extended'))
    @yield('content')
@else
    <div class="d-flex flex-column-fluid">
{{--        {{ Metronic::printClasses('content-container', false) }}--}}
        <div class="container-fluid ">
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
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control text-capitalize" name="seasons" id="seasons">
                                                        <option value="999" selected> Sel. Stagione</option>
                                                        @foreach($seasons as $season => $period)
                                                            <option value="{{ $season }}">{{ $season . ' '.json_encode($period) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2 d-flex flex-column">
                                                <div class="input-group has-validation">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control text-capitalize" name="sub_seasons" id="sub_seasons">
                                                        <option value="999" selected> Sel. Sub Stagione</option>
                                                        @foreach($sub_seasons as $sub_season => $sub_period)
                                                            <option value="{{ $sub_season }}">{{ $sub_period[0][0] . ' - '. $sub_period[0][1] }}</option>
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
                                                    <select multiple="multiple" class="form-control" id="houses" name="houses[]" style="min-height: 150px;">
                                                        @foreach($houses as $uid => $name)
                                                            <option value="{{ $uid }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-light" name="removeFilter" id="removeFilter">Rimuovi Filtri</button>
                                                <button type="button" class="btn btn-secondary" name="submit" id="submit">Invia</button>
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
            @yield('content')
        </div>
    </div>
@endif
