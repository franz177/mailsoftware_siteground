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
                                                    <select class="form-control text-uppercase" name="year_from" id="year_from">
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
                                                    <select class="form-control text-uppercase" name="house_from" id="house_from" disabled>
                                                        <option value="" selected> Scegli... </option>
                                                        @foreach($houses as $uid => $name)
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
                                                    <i class="fas fa-home"></i>
                                                </span>
                                                    </div>
                                                    <select class="form-control text-uppercase" name="house_to" id="house_to" disabled>
                                                        <option value="" selected> Scegli...</option>
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
            @yield('content')
        </div>
    </div>
@endif
