{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')
    {{-- Dashboard 1 --}}
    <div class="row">
        {{--        <div class="col-lg-6 col-xxl-6">--}}
        {{--            @include('pages.widgets._widget-3', ['class' => 'card-stretch card-stretch-half gutter-b'])--}}
        {{--            @include('pages.widgets._widget-4', ['class' => 'card-stretch card-stretch-half gutter-b'])--}}
        {{--        </div>--}}
        <div class="col-lg-8 col-xxl-9 order-1 order-xxl-1">

            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Case</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Totale {{ count($case) }} case</span>
                    </h3>
                    <div class="card-toolbar">
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
                                        <span class="text-dark-75">Nome Casa</span>
                                    </th>
                                    <th style="">Gestore</th>
                                    <th style="">Stato</th>
                                    <th style="min-width: 130px">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($case as $casa)
                                    <tr>
                                        <td class="pl-0 py-8">
                                            <div class="d-flex align-items-center">
                                                {{-- Symbol --}}
                                                <div class="symbol symbol-40 symbol-{{$colori_case[$casa->uid][1]}} mr-5">
                                                    <span class="symbol-label">
                                                        {{$colori_case[$casa->uid][0]}}
                                                    </span>
                                                </div>
                                                <div>
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $casa->header }}</a>
                                                    <span class="text-muted font-weight-bold d-block">Proprietario: {{ $casa->proprietario }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                @if($gestori->contains($casa->gestore))
                                                    {{ ' ' }}
                                                @else
                                                    {{ $gestori[$casa->gestore] }}
                                                @endif
                                            </span>
                                            {{--                                            <span class="text-muted font-weight-bold"></span>--}}
                                        </td>
                                        <td>
                                            <span class="label label-xl label-light-warning label-pill label-inline text-dark-75 font-weight-bolder font-size-lg">{{ $casa->stato }}</span>
                                        </td>
                                        <td class="pr-0 text-center">
                                            <a href="/backend/casa/{{ $casa->uid }}" class="btn btn-light-success font-weight-bolder font-size-sm">View</a>
                                            <a href="/backend/casa/{{ $casa->uid }}/edit" class="btn btn-light-warning font-weight-bolder font-size-sm">Edit</a>
                                        </td>
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

        <div class="col-lg-4 col-xxl-3 order-2 order-xxl-1">
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Siti</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Totale {{ count($siti) }} siti</span>
                    </h3>
                    <div class="card-toolbar">
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
                                        <span class="text-dark-75">Nome Sito</span>
                                    </th>
                                    <th style="min-width: 100px">Stato</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($siti as $sito)
                                    <tr>
                                        <td class="pl-0 py-8">
                                            <div class="d-flex align-items-center">
                                                {{-- Symbol --}}
                                                <div class="symbol symbol-40 symbol-{{$colori_siti[$sito->uid][1]}} mr-5">
                                                    <span class="symbol-label">
                                                        {{$colori_siti[$sito->uid][0]}}
                                                    </span>
                                                </div>
                                                <div>
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $sito->header }}</a>
                                                    <span class="text-muted font-weight-bold d-block">{{ $sito->percentuale }}%</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="label label-xl label-light-warning label-pill label-inline text-dark-75 font-weight-bolder font-size-lg">{{ $sito->stato }}</span>
                                        </td>

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

        <div class="col-lg-4 col-xxl-3 order-2 order-xxl-1">
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Siti</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Totale {{ count($siti_kross) }} siti</span>
                    </h3>
                    <div class="card-toolbar">
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
                                        <span class="text-dark-75">Nome Sito</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($siti_kross as $sito_kross)
                                    <tr>
                                        <td class="pl-0 py-8">
                                            <div class="d-flex align-items-center">
                                                {{-- Symbol --}}
                                                <div class="symbol symbol-40 symbol-{{$colori_siti[$sito_kross->uid][1]}} mr-5">
                                                    <span class="symbol-label">
                                                        {{$colori_siti[$sito_kross->uid][0]}}
                                                    </span>
                                                </div>
                                                <div>
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $sito_kross->header }}</a>
                                                    <span class="text-muted font-weight-bold d-block">{{ $sito_kross->percentuale }}%</span>
                                                </div>
                                            </div>
                                        </td>

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
