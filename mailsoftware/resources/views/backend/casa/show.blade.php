{{-- Extends layout --}}
@extends('backend.default')

{{-- Content --}}
@section('content')


    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">
                            <div class="symbol symbol-40 symbol-{{ $casa->color->colore_bg }} mr-5">
                                <span class="symbol-label">
                                    {{ $casa_typo->subheader }}
                                </span>
                            </div>
                            {{ $casa_typo->header }}
                        </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend" class="btn btn-light-primary btn-sm font-weight-bolder font-size-sm py-3 px-6">Dashboard</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Dati Fissi</span>
                            <span class="text-muted font-weight-bold font-size-sm">Provenienti da DB <strong>NewtVisions</strong></span>
                        </h3>
                        <div class="row mb-6">
                            <!--begin::Info-->

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Proprietario</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $casa_typo->tx_mask_t1_casa_gestore }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Gestore</span>
                                    <span class="text-dark font-weight-bold mb-4">
                                        @if($gestori->contains($casa_typo->tx_mask_t1_op_gestore))
                                            {{ 'Dato Mancante a DB' }}
                                        @else
                                            {{ $gestori[$casa_typo->tx_mask_t1_op_gestore] }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Indirizzo</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $casa_typo->tx_mask_casa_add }} - {{ $citta ? $citta->city : 'SELEZIONA CITTÀ' }}<br> {{ $citta ? $citta->cap .' '. $citta->provincia : 'SU TYPO3' }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Bagni</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $casa_typo->tx_mask_casa_bagni }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Operatore CheckIn</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $users->find($casa_typo->tx_mask_t6_def_checkin) ? $users->find($casa_typo->tx_mask_t6_def_checkin)->name : 'NON SELEZIONATO SU TYPO3' }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Operatore Pulizie</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $users->find($casa_typo->tx_mask_t6_def_pulizie) ? $users->find($casa_typo->tx_mask_t6_def_pulizie)->name : 'NON SELEZIONATO SU TYPO3' }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Operatore Cambi</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $users->find($casa_typo->tx_mask_t6_def_cambi) ? $users->find($casa_typo->tx_mask_t6_def_cambi)->name : 'NON SELEZIONATO SU TYPO3' }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Operatore CheckOut</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $users->find($casa_typo->tx_mask_t6_def_checkout) ? $users->find($casa_typo->tx_mask_t6_def_checkout)->name : 'NON SELEZIONATO SU TYPO3' }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Linea Wifi</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $casa_typo->tx_mask_t2_wifi_linea }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Password Wifi</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $casa_typo->tx_mask_t2_wifi_pwd }}</span>
                                </div>
                            </div>



                            <!--end::Info-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <h3 class="card-title align-items-start flex-column"  style="display: inline;">
                        <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3"> Dati Variabili </span>
                        <span class="text-muted font-weight-bold font-size-sm">DB interno</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="/backend/casa/{{ $casa_typo->uid }}/edit" class="btn btn-light-info btn-sm font-weight-bolder font-size-sm py-3 px-6">Edit</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="row mb-6">
                            <!--begin::Info-->

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Banca</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $casa->bank->name .' ('. $casa->bank->beneficiario.')' }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">ZTL</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $citta ? $citta->city . ' (' . $casa->ztl->description . ')' : 'SELEZIONA CITTÀ SU TYPO3'  }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Posti Letto Max</span>
                                    <span class="text-dark font-weight-bold mb-4">{{ $casa->persone_max }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Colore Casa</span>
                                    <span class="text-dark font-weight-bold mb-4">
                                        <span class="label label-dot label-{{ $casa->color->colore_bg }}"></span>
                                        {{ $casa->color->name }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Camere</span>
                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">

                                            <tbody>
                                            @forelse($casa->rooms as $room)
                                                <tr>
                                                    <td>{{ $room->name }}</td>
                                                    {{--<td class="pr-0">
                                                        <a href="/backend/camera/{{ $room->id }}/edit" class="btn btn-sm btn-light-warning font-weight-bolder font-size-sm">Edit</a>
                                                    </td>--}}
                                                </tr>
                                            @empty
                                                <td colspan="4">Nessuna Camera Assegnata</td>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-muted font-weight-bolder font-size-lg">Utenti SoftwareMail</span>
                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">

                                            <tbody>
                                            @forelse($casa->users as $user)
                                                <tr>
                                                    <td>{{ $user->name . ' (' . $user->email.')' }}</td>
                                                    {{--<td class="pr-0">
                                                        <a href="/backend/user/{{ $user->id }}/edit" class="btn btn-sm btn-light-warning font-weight-bolder font-size-sm">Edit</a>
                                                    </td>--}}
                                                </tr>
                                            @empty
                                                <td colspan="4">Nessun Utente Assegnato</td>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>

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
