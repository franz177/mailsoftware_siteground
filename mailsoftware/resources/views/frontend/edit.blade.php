@extends('layouts.template')

@section('styles')
    <script src="https://cdn.tiny.cloud/1/ucpyfql9omtsyar93aialdqe7os76orkw8t2e5eutcwu83ue/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    Show -
                </div>
                <div class="card-body">
                    <p>{{ $prenotazione->tx_mask_p_old_uid }}  [{{ $prenotazione->uid }}]  - {{$prenotazione->header}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">

            <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Assegnamento Singolo
                            </span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div class="tab-content">
                            <div class="row mb-6">
                                <div class="col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="typeanswer_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta <span class="text-danger">*</span></label>
                                            <select class="form-control dynamic" name="typeanswer_id" id="typeanswer_id">
                                                <option value="" selected> Selezionare Tipo Risposta</option>
                                                @foreach($typeanswers as $typeanswer)
                                                    <option value="{{ $typeanswer->id }}">{{ $typeanswer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                        <div class="form-group">
                                            <label for="type_id" class="text-muted font-weight-bolder font-size-lg">Modello</label>
                                            <select class="form-control dynamic" name="type_id" id="type_id">
                                                <option value="" disabled> Selezionare Modello</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
        </div>
        <div class="col-lg-8">
            <form action="{{ route('threads.store') }}" method="POST" enctype="multipart/form-data" id="form_flow_text">
                <input type="hidden" id="text_id" name="text_id" value="{{ $prenotazione->uid }}">
                @csrf
                <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Crea Risposta
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>

                    <div class="card-toolbar">
                        <button type="submit" name="mail" id="mail" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Invia </button>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="col-sm-12 col-md-12">
                            <div class="mb-8 d-flex flex-column">
                                <div class="form-group" id="text_answer">
                                    <textarea name="risposta" id="risposta" class="form-control"></textarea>
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
    <script>
        $(document).ready(function(){

            $(document).on('change', '#typeanswer_id', function(){
                var typeanswer_id = $(this).val();
                var op="";

                $.ajax({
                    method: 'get',
                    url: '{{route('flusso_testi.types')}}',
                    data: {typeanswer_id:typeanswer_id},
                    success:function(types) {
                        // console.log('success');
                        // console.log(typeanswer_id);
                        // console.log(types);

                        op += '<option value="0" selected disabled>Scegli Modello</option>';
                        for(var i=0;i<types.length;i++){
                            op+='<option value="'+types[i].id+'">'+types[i].name+'</option>';
                        }

                        $('#type_id').prop("disabled", false);
                        $('#type_id').html(op)


                    },
                    error:function (){

                    }
                });
            });

            $(document).on('change', '#type_id', function(){
                var typeanswer_id = $('#typeanswer_id').val();
                var type_id = $(this).val();
                var text = "";
                $.ajax({
                    method: 'get',
                    url: '{{route('flusso_testi.preview_text')}}',
                    data: {typeanswer_id:typeanswer_id, type_id:type_id},
                    success:function(preview_text) {
                        $.each(preview_text, function (key, val) {
                            text += '<p>'+ val.text.testo +'</p>'
                        })

                        $('#risposta').html(text);
                        tinymce.activeEditor.setContent(text);

                    },
                    error:function (){

                    }
                });

            });

            tinymce.init({
                selector: '#risposta',
                plugins:'lists advlist link autoresize',
                autoresize_on_init: true,
                toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link',
                autoresize_bottom_margin: 50,
                menubar: false,
                statusbar: false,
                icons: 'material',
            });

        });
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script>


    </script>
@endsection
