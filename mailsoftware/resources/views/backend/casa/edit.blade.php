{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')
    <form action="/backend/casa/{{ $casa_typo->uid }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-lg-12 col-xxl-12">

                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">
                                <div class="symbol symbol-40 symbol-{{ $casa->color->colore_bg }} mr-5">
                                    <span class="symbol-label">
                                        {{ $casa_typo->subheader }}
                                    </span>
                                </div>
                                {{ $casa_typo->header }}
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Aggiorna </button>
                            <a href="/backend/casa/{{ $casa_typo->uid }}" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Annulla</a>
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

                                <div class="col-sm-12 col-md-3">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label class="text-muted font-weight-bolder font-size-lg" for="bank_id">Banca <span class="text-danger">*</span></label>
                                            <select class="form-control" id="bank_id" name="bank_id">
                                                @foreach($banks as $bank)
                                                    <option value="{{ $bank->id }}" {{ $bank->id == $casa->bank->id ? 'selected' : '' }}>{{ $bank->name . ' ('.$bank->beneficiario .')' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label class="text-muted font-weight-bolder font-size-lg" for="ztl_id">ZTL <span class="text-danger">*</span></label>
                                            <select class="form-control" id="ztl_id" name="ztl_id">
                                                @foreach($ztls as $ztl)
                                                    <option value="{{ $ztl->id }}" {{ $ztl->id == $casa->ztl->id ? 'selected' : '' }}>{{ $ztl->city ? $ztl->city->city.' ('.$ztl->description.')' : $ztl->description  }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="persone_max" class="text-muted font-weight-bolder font-size-lg">Posti letto Max</label>
                                            <input class="form-control" type="number" value="{{ $casa->persone_max }}" id="persone_max" name="persone_max">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label class="text-muted font-weight-bolder font-size-lg" for="color_id">Colore Casa <span class="text-danger">*</span></label>
                                            <select class="form-control" id="color_id" name="color_id">
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->id }}" {{ $color->id == $casa->color->id ? 'selected' : '' }} class="option-{{ $color->colore_bg }}">{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-xxl-6">

                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="card-header border-0 py-5 mb-2 px-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Camere</span>
                                    <span class="text-muted font-weight-bold font-size-sm"> | Assegna Camere alla Casa</span>
                                </h3>
                            </div>

                            <div class="row mb-6">
                                <!--begin::Info-->

                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label class="text-muted font-weight-bolder font-size-lg" for="gender">Scegli Camere <span class="text-danger">*</span></label>
                                            <div class="checkbox-list">
                                                @foreach($rooms as $room)
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="rooms[]" value="{{ $room->id }}" @foreach($casa->rooms as $house_room) @if($house_room->id == $room->id) checked="checked" @endif @endforeach />
                                                        <span></span>
                                                        {{ $room->name }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end::Info-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-6">

                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="card-header border-0 py-5 mb-2 px-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Utenti</span>
                                    <span class="text-muted font-weight-bold font-size-sm"> | Assegna Utenti softwareMail</span>
                                </h3>
                            </div>

                            <div class="row mb-6">
                                <!--begin::Info-->

                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label class="text-muted font-weight-bolder font-size-lg" for="gender">Scegli Utenti <span class="text-danger">*</span></label>
                                            <div class="checkbox-inline">
                                                @foreach($users as $user)
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="users[]" value="{{ $user->id }}" @foreach($casa->users as $house_user) @if($house_user->id == $user->id) checked="checked" @endif @endforeach />
                                                        <span></span>
                                                        {{ $user->name . ' (' . $user->email .')' }}
                                                    </label>

                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end::Info-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
