{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <form action="/backend/operatore/{{ $operatore_typo->uid }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">
                                <div class="symbol symbol-40 symbol- mr-5">
                                    <span class="symbol-label">
                                        {{ substr($operatore_typo->nominativo, 0, 1) }}
                                    </span>
                                </div>
                                {{ $operatore_typo->nominativo }}
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Aggiorna </button>
                            <a href="/backend/operatore/{{ $operatore_typo->uid }}" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Annulla</a>
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

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label class="text-muted font-weight-bolder font-size-lg" for="gender">Città <span class="text-danger">*</span></label>
                                            <div class="checkbox-inline">
                                                @foreach($citta as $city)
                                                <label class="checkbox">
                                                    <input type="checkbox" name="houses[]" value="{{ $city->id }}" @foreach($operatore->cities as $citi) @if($citi->id == $city->id) checked="checked" @endif @endforeach />
                                                    <span></span>
                                                    {{ $city->city }}
                                                </label>

                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label class="text-muted font-weight-bolder font-size-lg" for="gender">Sesso <span class="text-danger">*</span></label>
                                            <select class="form-control" id="gender" name="gender">
                                                @foreach($operatore->gender_list as $gk => $gv)
                                                    <option value="{{ $gk }}" {{ $operatore->gender == $gk ? 'selected' : '' }}>{{ $gv }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label class="text-muted font-weight-bolder font-size-lg" for="transfer">Transfer Aeroporto <span class="text-danger">*</span></label>
                                            <select class="form-control" id="transfer" name="transfer">
                                                @foreach($operatore->transfer_list as $tk => $tv)
                                                    <option value="{{ $tk }}" {{ $operatore->transfer == $tk ? 'selected' : '' }}>{{ $tv }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="dalle" class="text-muted font-weight-bolder font-size-lg">Dalle</label>
                                            <input class="form-control" type="text" value="{{ $operatore->dalle }}" id="dalle" name="dalle">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="alle" class="text-muted font-weight-bolder font-size-lg">Alle</label>
                                            <input class="form-control" type="text" value="{{ $operatore->alle }}" id="alle" name="alle">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="debit" class="text-muted font-weight-bolder font-size-lg">Costo</label>
                                            <input class="form-control" type="text" value="{{ $operatore->debit }}" id="debit" name="debit">
                                        </div>
                                    </div>
                                </div>

                                <!--end::Info-->

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
