{{-- Header --}}
<div id="kt_header" class="header {{ Metronic::printClasses('header', false) }}" {{ Metronic::printAttrs('header') }}>

    {{-- Container --}}
    <div class="container-fluid d-flex align-items-center justify-content-between">
        @if (config('layout.header.self.display'))

            @php
                $kt_logo_image = 'logo.png';
            @endphp

            @if (config('layout.header.self.theme') === 'light')
                @php $kt_logo_image = 'logo.png' @endphp
            @elseif (config('layout.header.self.theme') === 'dark')
                @php $kt_logo_image = 'logo.png' @endphp
            @endif

            {{-- Header Menu --}}
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                @if(config('layout.aside.self.display') == false)
                    <div class="header-logo">
                        <a href="{{ url('/') }}">
                            <img alt="Logo" src="{{ asset('images/'.$kt_logo_image) }}"/>
                        </a>
                    </div>
                @endif

                <div id="kt_header_menu" class="header-menu header-menu-mobile {{ Metronic::printClasses('header_menu', false) }}" {{ Metronic::printAttrs('header_menu') }}>
                    <ul class="menu-nav {{ Metronic::printClasses('header_menu_nav', false) }}">
                        {{ Menu::renderHorMenu(config('menu_backend.items_top')) }}
                    </ul>
                </div>
            </div>

        @else
            <div></div>
        @endif

        @include('backend.partials.extras._topbar')
    </div>
</div>
