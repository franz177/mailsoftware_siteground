{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-custom alert-notice alert-light-success fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">{{ session()->get('message') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
                </button>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <form action="/backend/testi/{{ $text->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">
                                <div class="symbol symbol-40 symbol- mr-5">
                                    <span class="symbol-label">
                                        {{ substr($text->name, 0, 2) }}
                                    </span>
                                </div>
                                {{ $text->name }}
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Aggiorna </button>
                            <a href="/backend/testi" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Annulla</a>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="row mb-6">
                                <!--begin::Info-->

                                <div class="col-sm-12 col-md-8">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="name" class="text-muted font-weight-bolder font-size-lg">Nome Testo</label>
                                            <input class="form-control" type="text" value="{{ $text->name }}" id="name" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="priority_id" class="text-muted font-weight-bolder font-size-lg">Priorità</label>
                                            <select class="form-control" name="priority_id" id="priority_id">
                                                @foreach($priorities as $priority)
                                                    <option value="{{ $priority->id }}" {{ $text->priority_id == $priority->id ? 'selected' : '' }}>{{ $priority->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="testo" class="text-muted font-weight-bolder font-size-lg">Testo [IT]</label>
                                            <textarea name="testo" class="form-control" data-provide="markdown" rows="10">{!! $text->testo !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="text" class="text-muted font-weight-bolder font-size-lg">Testo [EN]</label>
                                            <textarea name="text" class="form-control" data-provide="markdown" rows="10">{!! $text->text !!}</textarea>
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
