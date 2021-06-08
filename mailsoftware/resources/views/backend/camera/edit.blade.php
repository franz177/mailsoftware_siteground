{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <form action="/backend/camera/{{ $room->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">
                                <div class="symbol symbol-40 symbol- mr-5">
                                    <span class="symbol-label">
                                        {{ substr($room->name, 0, 2) }}
                                    </span>
                                </div>
                                {{ $room->name }}
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Aggiorna </button>
                            <a href="/backend/camera/{{ $room->id }}" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Annulla</a>
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
                                            <label for="name" class="text-muted font-weight-bolder font-size-lg">Name</label>
                                            <input class="form-control" type="text" value="{{ $room->name }}" id="name" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="descrizione" class="text-muted font-weight-bolder font-size-lg">Descrizione (IT)</label>
                                            <input class="form-control" type="text" value="{{ $room->descrizione }}" id="descrizione" name="descrizione">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="description" class="text-muted font-weight-bolder font-size-lg">Description (EN)</label>
                                            <input class="form-control" type="text" value="{{ $room->description }}" id="description" name="description">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label class="text-muted font-weight-bolder font-size-lg" for="gender">Scegli Case <span class="text-danger">*</span></label>
                                            <div class="checkbox-inline">
                                                @foreach($case_typo as $casa_typo)
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="houses[]" value="{{ $casa_typo->uid }}" @foreach($room->houses as $house_room) @if($house_room->uid == $casa_typo->uid) checked="checked" @endif @endforeach />
                                                        <span></span>
                                                        {{ $casa_typo->nome }}
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
            </form>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
