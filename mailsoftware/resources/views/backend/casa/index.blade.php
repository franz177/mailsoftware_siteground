{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-lg-12 col-xxl-12">

            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Case</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Totale {{ count($case_typo) }} case</span>
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
                                @foreach($case_typo as $casa_typo)
                                    @if($casa_typo->stato != 'Disattiva')
                                        <tr>
                                            <td class="pl-0 py-8">
                                                <div class="d-flex align-items-center">
                                                    {{-- Symbol --}}
                                                    <div class="symbol symbol-50 symbol-{{ $case->find($casa_typo->uid)->color->colore_bg  }} mr-5">
                                                        <span class="symbol-label">
                                                            {{ $casa_typo->subheader }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <a href="/backend/casa/{{ $casa_typo->uid }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $casa_typo->header }}</a>
                                                        <span class="text-muted font-weight-bold d-block">Proprietario: {{ $casa_typo->proprietario }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                @if($gestori->contains($casa_typo->gestore))
                                                    {{ ' ' }}
                                                @else
                                                    {{ $gestori[$casa_typo->gestore] }}
                                                @endif
                                            </span>
                                                {{--                                            <span class="text-muted font-weight-bold"></span>--}}
                                            </td>
                                            <td>
                                                <span class="label label-xl label-light-warning label-pill label-inline text-dark-75 font-weight-bolder font-size-lg">{{ $casa_typo->stato }}</span>
                                            </td>
                                            <td class="pr-0 text-center">
                                                <a href="/backend/casa/{{ $casa_typo->uid }}" class="btn btn-light-success font-weight-bolder font-size-sm">View</a>
                                                <a href="/backend/casa/{{ $casa_typo->uid }}/edit" class="btn btn-light-warning font-weight-bolder font-size-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endif
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
