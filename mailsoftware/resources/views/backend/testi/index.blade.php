{{-- Extends layout --}}
@extends('backend.default')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
@endsection
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
                        <span class="card-label font-weight-bolder text-dark">Testi</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Totale {{ count($texts) }} testi</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend/testi/create" class="btn btn-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Aggiungi <img src="{{ asset('/media/svg/icons/Navigation/Plus_white.svg') }}"/></a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_1">
                                <thead>
                                <tr class="text-left text-uppercase">
                                    <th></th>
                                    <th class="text-left ">Priorità</th>
                                    <th class="text-left ">Nome testo</th>
                                    <th class="text-left" style="min-width: 200px">Testo</th>
                                    <th class="text-left none">Id</th>
                                    <th class="text-left none" style="min-width: 200px">Text</th>
                                    <th class="text-right none" style="">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($texts as $text)
                                    <tr>
                                        <th></th>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $text->priority->name }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                <a href="/backend/testi/{{ $text->id }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $text->name }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $text->testo }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $text->id }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $text->text }}
                                            </span>
                                        </td>

                                        <form action="/backend/testi/{{ $text->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <td class="pr-0 text-right">
                                                <a href="/backend/testi/{{ $text->id }}/edit" class="btn btn-light-warning font-weight-bolder font-size-sm">Edit</a>
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
    <script src="{{ asset('js/datatables/datatables.js') }}" type="text/javascript"></script>


@endsection
