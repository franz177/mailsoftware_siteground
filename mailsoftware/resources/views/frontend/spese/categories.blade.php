@extends('layouts.template')

@section('styles')
@endsection

@section('content')
    @foreach($master_categories as $master_category)
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card card-custom card-stretch gutter-b">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark text-uppercase">
                                @if($master_category->parent == 0)
                                    {{$master_category->title}}
                                @endif
                            </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="row">
                            @foreach($middle_categories as $middle_category)
                            <div class="col-lg-2 col-xxl-2">
                                <div class="card card-custom card-stretch gutter-b">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 py-5">
                                        <h5 class="align-items-start flex-column">
                                            <span class="card-label text-uppercase font-weight-bolder text-dark">{{ $middle_category->title }}</span>
                                        </h5>
                                        <div class="card-toolbar">
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-0 pb-3">
                                        <div class="tab-content">
                                            @foreach($categories as $category)
                                                @if($category->parent == $middle_category->uid)
                                                    <p class="text-capitalize">{{$category->title}}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
{{--                        @if($category->parent != 0)--}}
{{--                            <p>{{$category->parent}} -> {{$category->title}} -> {{ $category->uid }}</p>--}}
{{--                        @endif--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

{{-- Scripts Section --}}
@section('scripts')

    <script type="text/javascript">

        let data_search = new Object();

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        });

    </script>
@endsection
