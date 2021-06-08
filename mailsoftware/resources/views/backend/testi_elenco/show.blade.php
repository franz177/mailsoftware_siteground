{{-- Extends layout --}}
@extends('backend.default')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
@endsection
{{-- Content --}}
@section('content')
    <form action="/backend/testi" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body pt-0 pb-3">
                <div class="tab-content">
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-8 d-flex flex-column">
                            <div class="form-group">
                                <label for="priority_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta</label>
                                <select class="form-control" name="priority_id" id="priority_id">
                                    @foreach($typeanswers as $typeanswer)
                                        <option value="{{ $typeanswer->id }}">{{ $typeanswer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_2">
                                <thead>
                                <tr class="text-left text-uppercase">
                                    <th></th>
                                    <th class="text-left" >Blocco</th>
                                    <th class="text-left" >Sezione</th>
                                    <th class="text-left ">Nome testo</th>
                                    <th class="text-left" style="min-width: 200px">Testo</th>
                                    <th class="text-left none" style="min-width: 200px">Text</th>
                                    <th class="text-left none" style="min-width: 200px">Priorità</th>
                                    <th class="text-right" style="">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($texts as $text)
                                    <tr>
                                        <th></th>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $text->block->name }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $text->section->name }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                <a href="/backend/testi/{{ $text->text_id }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $text->text->name }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $text->text->testo }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $text->text->text }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $text->text->priority->name }}
                                            </span>
                                        </td>

                                        <form action="/backend/testi/{{ $text->text_id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <td class="pr-0 text-right">
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
