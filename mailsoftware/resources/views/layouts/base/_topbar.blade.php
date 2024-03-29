{{-- Topbar --}}
<div class="topbar">

    {{-- User --}}
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        @if (config('layout_frontend.extras.user.display'))
            @if (config('layout_frontend.extras.user.layout') == 'offcanvas')
                <div class="topbar-item">
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Ciao,</span>
                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
                        <span class="symbol symbol-35 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </span>
                    </div>
                </div>
            @else
                <div class="dropdown">
                    {{-- Toggle --}}
                    <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                        <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2">
                            <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Ciao,</span>
                            <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
                            <span class="symbol symbol-35 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </span>
                        </div>
                    </div>

                    {{-- Dropdown --}}
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
                        @include('layouts.base.dropdown._user')
                    </div>
                </div>
            @endif
        @endif

    @endguest

</div>
