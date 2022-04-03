@extends('layouts.template')

@section('content')
	<div class="row row-cols-1 row-cols-md-2">
		<div class="col mb-4">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark text-uppercase">
								Servizi
							</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
					</h3>
				</div>
				<div class="card-body pt-0 pb-3">
					<ul>
						<li>
							<a href="https://alguerhome2.krossbooking.com/login" target="_blank">Kross Booking</a>
						</li>
						<li>
							<a href="https://gestionale.alguerhome.it/typo3/" target="_blank">Gestionale Typo3</a>
						</li>
						<li>
							<a href="https://gestionale.alguerhome.it/amministrazione/" target="_blank">Gestionale Amministrazione</a>
						</li>
						<li>
							<a href="https://trello.com/b/vF4ZdCiD/mail-software" target="_blank">Trello</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col mb-4">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark text-uppercase">
								Documentazione
							</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
					</h3>
				</div>
				<div class="card-body pt-0 pb-3">
					<ul>
						<li>
							<a href="https://docs.google.com/spreadsheets/d/1R7g92J2yVk3zJk_50txyz_pILAuljIapu2IhERmI-F4/edit" target="_blank">GDoc: Database</a>
						</li>
						<li>
							<a href="https://docs.google.com/spreadsheets/d/1mXmEZTf9n-C2mOx9H4wV8SKmvFBMPUelnCXfkOjJyQI/edit" target="_blank">GDoc: Implementazioni e Correzioni</a>
						</li>
						<li>
							<a href="https://drive.google.com/drive/u/0/folders/13kvgsluN34gm7GIfO3BzV2cI8nbkrzXE" target="_blank">GDoc: Prenotazioni Lalla</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection
