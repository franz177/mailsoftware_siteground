@if(config('layout_frontend.self.layout') == 'blank')
    <div class="d-flex flex-column flex-root">
        @yield('content')
    </div>
@else

    @include('layouts.base._header-mobile')

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">

            @if(config('layout_frontend.aside.self.display'))
                @include('layout.base._aside')
            @endif

            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                @include('layouts.base._header')

                <div class="content {{ Metronic::printClasses('content', false) }} d-flex flex-column flex-column-fluid" id="kt_content">

                    @if(config('layout_frontend.subheader.display'))
                        @include('layouts.base._subheader')
                    @endif

                    @include('layouts.base._content')
                </div>

                @include('layouts.base._footer')
            </div>
        </div>
    </div>

@endif

@if (config('layout_frontend.self.layout') != 'blank')

    @if (config('layout_frontend.extras.search.layout') == 'offcanvas')
        @include('layout.partials.extras.offcanvas._quick-search')
    @endif

    @if (config('layout_frontend.extras.notifications.layout') == 'offcanvas')
        @include('layout.partials.extras.offcanvas._quick-notifications')
    @endif

    @if (config('layout_frontend.extras.quick-actions.layout') == 'offcanvas')
        @include('layout.partials.extras.offcanvas._quick-actions')
    @endif

    @if (config('layout_frontend.extras.user.layout') == 'offcanvas')
        @include('layout.partials.extras.offcanvas._quick-user')
    @endif

    @if (config('layout_frontend.extras.quick-panel.display'))
        @include('layout.partials.extras.offcanvas._quick-panel')
    @endif

    @if (config('layout_frontend.extras.toolbar.display'))
        @include('layout.partials.extras._toolbar')
    @endif

    @if (config('layout_frontend.extras.chat.display'))
        @include('layout.partials.extras._chat')
    @endif

    @include('layout.partials.extras._scrolltop')

@endif
