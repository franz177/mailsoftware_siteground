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
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">
                            <div class="symbol symbol-40 symbol- mr-5">
                                <span class="symbol-label">
                                    {{ substr($ztl->description, 0, 2) }}
                                </span>
                            </div>
                            {{ $ztl->city->city .' - ' .  $ztl->description }}
                        </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend/ztl/{{ $ztl->id }}/edit" class="btn btn-light-info btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3">Edit</a>
                        <a href="/backend/ztl" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6">Elenco ZTL</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="row mb-6">
                            <!--begin::Info-->

                            <div class="col-sm-12 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Nome Ztl</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $ztl->description }}</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Mattina</span>
                                    <span class="text-dark font-weight-bold mb-4">
                                        {{ 'dalle: '. $ztl->ztl_a_am .' alle: '. $ztl->ztl_a_am .' (' . $ztl->ztl_out_am . ')'  }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Pomeriggio</span>
                                    <span class="text-dark font-weight-bold mb-4">
                                        {{ 'dalle: '. $ztl->ztl_a_pm .' alle: '. $ztl->ztl_a_pm .' (' . $ztl->ztl_out_pm . ')'  }}
                                    </span>
                                </div>
                            </div>

                            <!--end::Info-->
                        </div>
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
