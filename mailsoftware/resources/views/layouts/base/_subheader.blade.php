{{-- Subheader V1 --}}

<div class="subheader py-2 py-lg-2 subheader-transparent {{ Metronic::printClasses('subheader', true) }}" id="kt_subheader">
    <div class="container {{ Metronic::printClasses('subheader-container', true) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

		{{-- Info --}}
        <div class="d-flex align-items-center flex-wrap mr-1">

			{{-- Page Title --}}
            <h2 class="text-white font-weight-bold my-2 mr-5">
                {{ @$page_title }}

                @if (isset($page_description) && config('layout_frontend.subheader.displayDesc'))
                    <small>{{ @$page_description }}</small>
                @endif
            </h2>

            @if (!empty($page_breadcrumbs))
				{{-- Separator --}}
                <div class="subheader-separator subheader-separator-ver my-2 mr-4 d-none"></div>

				{{-- Breadcrumb --}}
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
                    <li class="breadcrumb-item"><a href="#"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
                    @foreach ($page_breadcrumbs as $k => $item)
						<li class="breadcrumb-item">
                        	<a href="{{ url($item['page']) }}" class="text-muted">
                            	{{ $item['title'] }}
                        	</a>
						</li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
</div>
