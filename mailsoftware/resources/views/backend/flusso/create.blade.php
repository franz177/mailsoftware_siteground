{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')
    @if(session()->has('message_success'))
        <div class="alert alert-custom alert-notice alert-light-success fade show mb-5 col-6" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{!!  session()->get('message_success') !!}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
                </button>
            </div>
        </div>
    @endif
    @if(session()->has('message_warning'))
        <div class="alert alert-custom alert-notice alert-light-warning fade show mb-5 col-6" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{!! session()->get('message_warning') !!}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
                </button>
            </div>
        </div>
    @endif
    <form action="/backend/flusso" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12 col-xxl-12">

                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Crea Nuovo/i Flusso/i</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Crea </button>
                            <a href="/backend/flusso" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Indietro</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 col-xxl-4">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="card-header border-0 py-5 mb-2 px-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Tipo Risposta/Modello</span>
                                    <span class="text-muted font-weight-bold font-size-sm"> | Scelta Singola</span>
                                </h3>
                            </div>

                            <div class="row mb-6">
                                <!--begin::Info-->

                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="typeanswer_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta</label>
                                            <select class="form-control" name="typeanswer_id" id="typeanswer_id">
                                                @foreach($typeanswers as $typeanswer)
                                                    <option value="{{ $typeanswer->id }}">{{ $typeanswer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="type_id" class="text-muted font-weight-bolder font-size-lg">Modelli</label>
                                            <select class="form-control" name="type_id" id="type_id">
                                                @foreach($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
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

            <div class="col-lg-4 col-xxl-4">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="card-header border-0 py-5 mb-2 px-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Canali</span>
                                    <span class="text-muted font-weight-bold font-size-sm"> | Scelta Multipla</span>
                                </h3>
                            </div>

                            <div class="row mb-6">
                                <!--begin::Info-->
                                <div class="col-sm-12 col-md-12">
                                    <div class="d-flex flex-column">
                                        <div class="form-group">
                                            <label for="site_uid" class="text-muted font-weight-bolder font-size-lg">Siti</label>
                                            <select multiple="multiple" class="form-control" id="site_uid" name="site_uid[]" style="min-height: 190px;">
                                                @foreach($sites as $site)
                                                    <option value="{{ $site->uid }}">{{ $site->sito . ' ' . $site->header }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer justify-content-between">
                        <p class="text-muted font-weight-bold font-size-sm mb-2">Per selezionare più valori <strong>consecutivi</strong> tenere premuto il tasto <strong>SHIFT</strong> della tastiera.</p>
                        <p class="text-muted font-weight-bold font-size-sm">Per selezionare più valori <strong>NON</strong> consecutivi tenere premuto il tasto <strong>CTRL</strong> della tastiera.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xxl-4">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="card-header border-0 py-5 mb-2 px-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Case</span>
                                    <span class="text-muted font-weight-bold font-size-sm"> | Scelta Multipla</span>
                                </h3>
                            </div>

                            <div class="row mb-6">
                                <div class="col-sm-12 col-md-12">
                                    <div class="d-flex flex-column">
                                        <div class="form-group">
                                            <label for="house_uid" class="text-muted font-weight-bolder font-size-lg">Case</label>
                                            <select multiple="multiple" class="form-control" id="house_uid" name="house_uid[]" style="min-height: 190px;">
                                                @foreach($houses as $house)
                                                    <option value="{{ $house->uid }}">{{ $house->subheader . ' ' . $house->header }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer justify-content-between">
                        <p class="text-muted font-weight-bold font-size-sm mb-2">Per selezionare più valori <strong>consecutivi</strong> tenere premuto il tasto <strong>SHIFT</strong> della tastiera.</p>
                        <p class="text-muted font-weight-bold font-size-sm">Per selezionare più valori <strong>NON</strong> consecutivi tenere premuto il tasto <strong>CTRL</strong> della tastiera.</p>
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
