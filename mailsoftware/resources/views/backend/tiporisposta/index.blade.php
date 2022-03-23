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

            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Tipo Risposta</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Totale {{ count($typeanswers) }}</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend/tiporisposta/create" class="btn btn-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Aggiungi <img src="{{ asset('/media/svg/icons/Navigation/Plus.svg') }}"/></a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                <thead>
                                <tr class="text-left text-uppercase">
                                    <th style="min-width: 200px" class="pl-7">
                                        <span class="text-dark-75">Nome Tipo Risposta</span>
                                    </th>
                                    <th style="">Ordinamento</th>
                                    <th class="text-center" colspan="3">Colore</th>
                                    <th class="text-right" style="">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($typeanswers as $typeanswer)
                                    <tr>
                                        <td class="pl-0 py-8">
                                            <div class="d-flex align-items-center">
                                                {{-- Symbol --}}
                                                <div class="symbol symbol-40 symbol-{{ $typeanswer->color->colore_bg }} mr-5">
                                                    <span class="symbol-label">
                                                        {{ $typeanswer->initials($typeanswer->name) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <a href="/backend/tiporisposta/{{ $typeanswer->id }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $typeanswer->name }}</a>
                                                    <span class="text-muted font-weight-bold d-block"> </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $typeanswer->sorting }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                <span class="label label-dot label-{{ $typeanswer->color->colore_bg }}"></span>
                                                {{ $typeanswer->color->name }}
                                            </span>
                                        </td>

                                        <form action="/backend/tiporisposta/{{ $typeanswer->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <td class="pr-0 text-right">
                                                <a href="/backend/tiporisposta/{{ $typeanswer->id }}" class="btn btn-light-success font-weight-bolder font-size-sm">View</a>
                                                <a href="/backend/tiporisposta/{{ $typeanswer->id }}/edit" class="btn btn-light-warning font-weight-bolder font-size-sm">Edit</a>
                                                <button type="submit" class="btn btn-light-danger font-weight-bolder font-size-sm"> Delete </button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Body-->
            </div>

        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
