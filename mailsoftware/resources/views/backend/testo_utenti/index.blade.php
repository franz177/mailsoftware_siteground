{{-- Extends layout --}}
@extends('backend.default')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.css') }}">
@endsection
{{-- Content --}}
@section('content')
    <form action="{{ route('flusso_testi.retrive') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="turn" name="turn" value="{{ $turn }}">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                Elenco Testi tramite Flusso
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm py-3 px-6 mr-3"> Cerca </button>
                        <a href="/backend/flusso_testi" class="btn btn-danger btn-sm font-weight-bolder font-size-sm py-3 px-6">Reset</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="row mb-6">
                            <div class="col-sm-3 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="typeanswer_id" class="text-muted font-weight-bolder font-size-lg">Tipo Risposta</label>
                                        <select class="form-control dynamic" name="typeanswer_id" id="typeanswer_id">
                                            <option value="" selected> Selezionare Tipo Risposta</option>
                                            @foreach($typeanswers as $typeanswer)
                                                <option value="{{ $typeanswer->id }}" {{ $typeanswer_id == $typeanswer->id ? 'selected' : '' }}>{{ $typeanswer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="type_id" class="text-muted font-weight-bolder font-size-lg">Modelli </label>
                                        <select class="form-control dynamic" name="type_id" id="type_id">
                                            <option value="" readonly="readonly" > Selezionare Modello</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}" {{ $type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="site_uid" class="text-muted font-weight-bolder font-size-lg">Canali</label>
                                        <select class="form-control dynamic" name="site_uid" id="site_uid">
                                            <option value="" readonly="readonly"> Selezionare Canale</option>
                                            @foreach($sites as $site)
                                                <option value="{{ $site->uid }}" {{ $site_uid == $site->uid ? 'selected' : '' }}>{{ $site->name . ' ' . $site->percentuale.'%' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                                <div class="mb-8 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="house_uid" class="text-muted font-weight-bolder font-size-lg">Case</label>
                                        <select class="form-control dynamic" name="house_uid" id="house_uid">
                                            <option value="" readonly="readonly"> Selezionare Casa</option>
                                            @foreach($houses as $house)
                                                <option value="{{ $house->uid }}" {{ $house_uid == $house->uid ? 'selected' : '' }}>{{ $house->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if($flow_texts !== NULL)
    <div class="row">
        <div class="col-lg-12 col-xxl-12">

            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->

                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-15">
                    <div class="tab-content">
                        <!--begin::Table-->

                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered  dt-responsive" id="sample_6">
                                <thead>
                                    <tr class="text-left text-uppercase">
                                        <th></th>
                                        <th class="text-left" >Blocco</th>
                                        <th class="text-left" >Sezione</th>
                                        <th class="text-left ">Nome testo</th>
                                        <th class="text-left" style="min-width: 200px">Testo</th>
                                        <th class="text-left none">Text</th>
                                        <th class="text-left none">Priorità</th>
                                        <th class="text-center">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($flow_texts as $flow_text)
                                    <tr>
                                        <th></th>
                                        <td>
                                            <select class="form-control form-control-sm" name="block_id" id="block_id">
                                                @foreach($blocks as $block)
                                                    <option value="{{ $block->id }}" {{ $flow_text->block->id == $block->id ? 'selected' : '' }}>{{ $block->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm" name="section_id" id="section_id">
                                                @foreach($sections as $section)
                                                    <option value="{{ $section->id }}" {{ $flow_text->section->id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><a href="/backend/testi/{{ $flow_text->text->id }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"> {{ $flow_text->text->name }}</a></td>
                                        <td>{!! $flow_text->text->testo !!}</td>
                                        <td>{!! $flow_text->text->text !!} </td>
                                        <td>{{ $flow_text->text->priority->name }}</td>
                                        <td></td>
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
    @endif
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        $(document).ready(function(){

            var turn = $('input#turn').attr('value');
            turn = parseInt(turn);

            if(turn != 0){
                $('#type_id').prop("disabled", true);
                $('#site_uid').prop("disabled", true);
                $('#house_uid').prop("disabled", true);
            }

            $(document).on('change', '#typeanswer_id', function(){
                var typeanswer_id = $(this).val();
                var op=" ";

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

                var op=" ";

                $.ajax({
                    method: 'get',
                    url: '{{route('flusso_testi.sites')}}',
                    data: {typeanswer_id:typeanswer_id, type_id:type_id},
                    success:function(sites) {
                        // console.log(sites);
                        op += '<option value="0" selected disabled>Scegli Canale</option>';
                        for(var i=0;i<sites.length;i++){
                            op+='<option value="'+sites[i].uid+'">'+sites[i].name+' '+sites[i].percentuale +'%</option>';
                        }

                        $('#site_uid').prop("disabled", false);
                        $('#site_uid').html(op)


                    },
                    error:function (){

                    }
                });
            });

            $(document).on('change', '#site_uid', function(){
                var typeanswer_id = $('#typeanswer_id').val();
                var type_id = $('#type_id').val();
                var site_uid = $(this).val();

                var op=" ";

                $.ajax({
                    method: 'get',
                    url: '{{route('flusso_testi.houses')}}',
                    data: {typeanswer_id:typeanswer_id, type_id:type_id, site_uid:site_uid},
                    success:function(houses) {
                        op += '<option value="0" selected disabled>Scegli Casa</option>';
                        for(var i=0;i<houses.length;i++){
                            op+='<option value="'+houses[i].uid+'">'+houses[i].name+'</option>';
                        }

                        $('#house_uid').prop("disabled", false);
                        $('#house_uid').html(op)


                    },
                    error:function (){

                    }
                });
            });

        });
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables/datatables.js') }}" type="text/javascript"></script>


@endsection
