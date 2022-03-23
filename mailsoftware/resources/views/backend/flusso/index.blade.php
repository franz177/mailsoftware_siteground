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

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Elenco Flussi</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend/flusso/create" class="btn btn-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Aggiungi <img src="{{ asset('/media/svg/icons/Navigation/Plus.svg') }}"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    @foreach($flows as $flow)
        @if($flow_model->matchGroup($flow->typeanswer_id, $flow->type_id) === FALSE)
        <div class="col-lg-4 col-xxl-4">

            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-size-h6 font-weight-bolder text-dark">
                            <div class="symbol symbol-30 symbol-{{ $colors[$flow->typeanswer->color_id] }} mr-3">
                                <span class="symbol-label">
                                    {{ $flow->initials($flow->typeanswer->name) }}
                                </span>
                            </div>
                            {{ $flow->typeanswer->name }}
                            <span class="text-dark-50 mt-3 font-size-sm  font-weight-bold font-size-sm"> | {{ $flow->type->name }}</span>
                        </span>

                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 pb-3">
                    <div data-scroll="true" data-height="380" class="scroll ps ps--active-y" style="height: 200px; overflow: hidden;">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                <thead>
                                <tr class="text-left text-uppercase">

                                    <th style="">Sito</th>
                                    <th style="">Casa</th>
                                    <th class="text-right" style="">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($flows as $flusso)
                                    @if($flow_model->typeanswer_id_old === $flusso->typeanswer_id && $flow_model->type_id_old === $flusso->type_id)
                                    <tr>

                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-sm">
                                                {{ $sites[$flusso->site_uid] }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-sm">
                                                {{ $houses[$flusso->house_uid] }}
                                            </span>
                                        </td>

                                        <form action="/backend/flusso/{{ $flow->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <td class="pr-0 text-center">

                                                <button type="submit" class="btn btn-link-danger btn-sm font-weight-bolder font-size-sm"> Delete </button>
                                            </td>
                                        </form>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>

        </div>
        @endif
    @endforeach
    </div>

    <div class="row">
        <div class="col-sm-12 offset-sm-0 col-md-4 offset-md-8">
            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5"  style="display: inline-block">
                    <div class="card-toolbar">
                        <a href="/backend/flusso/create" class="btn btn-danger btn-sm btn-block font-weight-bolder font-size-sm py-3 px-6">Aggiungi <img src="{{ asset('/media/svg/icons/Navigation/Plus.svg') }}"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
