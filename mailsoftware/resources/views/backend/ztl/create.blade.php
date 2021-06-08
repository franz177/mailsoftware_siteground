{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <form action="/backend/ztl" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">
                                <div class="symbol symbol-40 symbol- mr-5">
                                    <span class="symbol-label"></span>
                                </div>
                                Crea nuova ZTL
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Crea </button>
                            <a href="/backend/ztl" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Annulla</a>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="card-header border-0 py-5 mb-2 px-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Dati Variabili</span>
                                    <span class="text-muted font-weight-bold font-size-sm"> DB interno</span>
                                </h3>
                            </div>

                            <div class="row mb-6">
                                <!--begin::Info-->
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="city_id" class="text-muted font-weight-bolder font-size-lg">Descrizione</label>
                                            <select class="form-control" name="city_id" id="city_id">
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-8">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="description" class="text-muted font-weight-bolder font-size-lg">Descrizione</label>
                                            <input class="form-control" type="text" value="" id="description" name="description">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="ztl_da_am" class="text-muted font-weight-bolder font-size-lg">Mattina Da</label>
                                            <input class="form-control" type="text" value="" id="ztl_da_am" name="ztl_da_am">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="ztl_a_am" class="text-muted font-weight-bolder font-size-lg">Mattina A</label>
                                            <input class="form-control" type="text" value="" id="ztl_a_am" name="ztl_a_am">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="ztl_out_am" class="text-muted font-weight-bolder font-size-lg">Mattina Out</label>
                                            <input class="form-control" type="text" value="" id="ztl_out_am" name="ztl_out_am">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="ztl_da_pm" class="text-muted font-weight-bolder font-size-lg">Pomeriggio Da</label>
                                            <input class="form-control" type="text" value="" id="ztl_da_pm" name="ztl_da_pm">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="ztl_a_pm" class="text-muted font-weight-bolder font-size-lg">Pomeriggio A</label>
                                            <input class="form-control" type="text" value="" id="ztl_a_pm" name="ztl_a_pm">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="ztl_out_pm" class="text-muted font-weight-bolder font-size-lg">Pomeriggio Out</label>
                                            <input class="form-control" type="text" value="" id="ztl_out_pm" name="ztl_out_pm">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>

@endsection
