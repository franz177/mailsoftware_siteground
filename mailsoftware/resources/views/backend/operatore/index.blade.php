{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')
    <div class="row">
    @foreach($operatori_typo as $operatore)
        @if($typo_user->matchGroup($operatore->uidg) === FALSE)

        <div class="col-lg-4 col-xxl-4">
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ $operatore->title }}</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Totale {{ $count_user[$operatore->uidg] }} </span>
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
                                        <span class="text-dark-75">Nome</span>
                                    </th>
                                    <th style="min-width: 130px">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($operatori_typo as $staff)
                                    @if($typo_user->uidg_old === $staff->uidg)
                                    <tr>
                                        <td class="pl-0 py-8">
                                            <div class="d-flex align-items-center">
                                                {{-- Symbol --}}
                                                <div class="symbol symbol-40 symbol- mr-5">
                                                    <span class="symbol-label">
                                                        {{ substr($staff->nominativo, 0, 1) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <a href="/backend/operatore/{{ $staff->uid }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $staff->nominativo }}</a>
                                                    <span class="text-muted font-weight-bold d-block">{{ $staff->name .' - '. $staff->excel}} </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pr-0 text-center">
                                            <a href="/backend/operatore/{{ $staff->uid }}" class="btn btn-light-success font-weight-bolder font-size-sm">View</a>
                                            <a href="/backend/operatore/{{ $staff->uid }}/edit" class="btn btn-light-warning font-weight-bolder font-size-sm">Edit</a>
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

        @endif
    @endforeach
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
