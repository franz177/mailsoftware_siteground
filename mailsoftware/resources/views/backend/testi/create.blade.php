{{-- Extends layout --}}
@extends('backend.default')

@section('styles')
    <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <form action="/backend/testi" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">
                                <div class="symbol symbol-40 symbol- mr-5">
                                    <span class="symbol-label"></span>
                                </div>
                                Crea nuovo Testo
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Crea </button>
                            <a href="/backend/testi" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Annulla</a>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="card-header border-0 py-5 mb-2 px-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Dati Variabili</span>
                                    <span class="text-muted font-weight-bold font-size-sm"> DB interno</span>
                                </h3>
                            </div>

                            <div class="row mb-6">
                                <!--begin::Info-->
                                <div class="col-sm-12 col-md-8">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="name" class="text-muted font-weight-bolder font-size-lg">Nome Testo</label>
                                            <input class="form-control" type="text" value="" id="name" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="priority_id" class="text-muted font-weight-bolder font-size-lg">Priorità</label>
                                            <select class="form-control" name="priority_id" id="priority_id">
                                                @foreach($priorities as $priority)
                                                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="testo" class="text-muted font-weight-bolder font-size-lg">Testo [IT]</label>
                                            <textarea name="testo" id="testo" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="text" class="text-muted font-weight-bolder font-size-lg">Testo [EN]</label>
                                            <textarea name="text" id="text" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

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
    <script>
        $(document).ready(function() {
            // Class definition
            tinymce.init({
                selector: '#testo',
                plugins: 'lists advlist link code',
                toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link code',
                menubar: false,
                statusbar: false,
                icons: 'material',
                height: 300,
            });

            tinymce.init({
                selector: '#text',
                plugins: 'lists advlist link code',
                toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link code',
                menubar: false,
                statusbar: false,
                icons: 'material',
                height: 300,

            });
        });
    </script>
@endsection
