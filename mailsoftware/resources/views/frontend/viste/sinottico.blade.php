@extends('layouts.template')

@section('content')
	<div class="row mb-3">
		<div class="col">
			@foreach($years as $iter_year)
				<a href="{{ route('viste.sinottico', ['year' => $iter_year->year]) }}" class="btn btn-{{ $current_year == $iter_year->year ? 'success' : 'info' }}">{{ $iter_year->year }}</a>
			@endforeach
		</div>
	</div>

	<div class="row row-cols-1 row-cols-md-2">
		@foreach($houses as $house)
			@php
			$totals_by_month = array_fill(1, 12, 0);
			$count_by_month = array_fill(1, 12, 0);
			@endphp

	        <div class="col mb-4">
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
												$value = $data[$house->id][$month_index][$i] ?? null;
											@endphp

											@if(is_null($value) || $value['amount'] == 0)
												<td>&nbsp;</td>
											@else
												@php
												$totals_by_month[$month_index] += $value['amount'];
												$count_by_month[$month_index] += 1;
												@endphp

												<td style="background-color: {{ $value['color'] }}">{{ $value['amount'] }}</td>
											@endif
										@endforeach
									</tr>
								@endfor
							</tbody>
							<tfoot>
								<tr>
									<th>Totale</th>
									@foreach($months as $month_index => $month)
										<th>{{ $totals_by_month[$month_index] ?: '' }}</th>
									@endforeach
								</tr>
								<tr>
									<th>Media</th>
									@foreach($months as $month_index => $month)
										<th>
											@if($count_by_month[$month_index])
												{{ round($totals_by_month[$month_index] / $count_by_month[$month_index], 2) }}
											@endif
										</th>
									@endforeach
								</tr>
							</tfoot>
						</table>

						<form method="POST" action="{{ route('viste.sinottico.note') }}">
							@csrf
							<input type="hidden" name="target_id" value="{{ $house->id }}">
							<input type="hidden" name="context" value="sinottico_{{ $current_year }}">

							@php

							$notes = $house->notes()->where('context', 'sinottico_' . $current_year)->first();
							if ($notes) {
								$notes = json_decode($notes->content);
							}

							@endphp

							<table class="table table-sm table-bordered">
								<tbody>
									@for($i = 0; $i < 4; $i++)
										<tr>
											@for($a = 0; $a < 13; $a++)
												<?php $key = sprintf('note_%s_%s', $i, $a) ?>
												<td width="7.70%">
													<input type="text" name="{{ $key }}" class="form-control" value="{{ $notes ? ($notes->$key ?? '') : '' }}">
												</td>
											@endfor
										</tr>
									@endfor
								</tbody>
							</table>

							<button type="submit" class="btn btn-light-success btn-sm font-weight-bolder font-size-sm float-right">Salva Note</button>
						</form>
					</div>
				</div>
	        </div>
		@endforeach
	</div>
@endsection
