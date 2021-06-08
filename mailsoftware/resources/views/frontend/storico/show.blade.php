@extends('layouts.template')

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            Show -
        </div>
        <div class="card-body">
            <p>{{ $typo->tx_mask_p_old_uid }}  [{{ $typo->uid }}]  - {{$typo->header}}</p>
        </div>
    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')

@endsection
