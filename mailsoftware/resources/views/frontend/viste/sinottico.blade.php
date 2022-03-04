@extends('layouts.template')

@section('content')
	<div class="row mb-3">
		<div class="col">
			@foreach($years as $iter_year)
				<a href="{{ route('viste.sinottico', ['year' => $iter_year->year]) }}" class="btn btn-success">{{ $iter_year->year }}</a>
			@endforeach
		</div>
	</div>

	@foreach($houses as $house)
		<div class="row">
	        <div class="col">
				<div class="card card-custom card-stretch gutter-b">
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
								<span class="card-label font-weight-bolder text-dark text-uppercase">
									{{ $house->name }}
								</span>
							<span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
						</h3>
					</div>
					<div class="card-body pt-0 pb-3">
						<table class="table table-sm table-bordered">
							<thead>
								<tr>
									<th width="7.70%"></th>
									@foreach($months as $month)
										<th width="7.70%">{{ $month }}</th>
									@endforeach
								</tr>
							</thead>
							<tbody>
								@for($i = 1; $i < 32; $i++)
									<tr>
										<th>{{ $i }}</th>

										@foreach($months as $month_index => $month)
											@php
												$value = $data[$house->id][$month_index][$i] ?? 0;
											@endphp

											@if($value == 0)
												<td>&nbsp;</td>
											@else
												<td class="bg-success">{{ $value }}</td>
											@endif
										@endforeach
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>
	        </div>
		</div>
	@endforeach
@endsection
