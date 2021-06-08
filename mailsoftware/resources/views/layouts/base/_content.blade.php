{{-- Content --}}
@if (config('layout.content.extended'))
    @yield('content')
@else
    <div class="d-flex flex-column-fluid">
{{--        {{ Metronic::printClasses('content-container', false) }}--}}
        <div class="container-fluid ">
            @yield('content')
        </div>
    </div>
@endif
