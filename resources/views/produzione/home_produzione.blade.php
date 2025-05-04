@extends('produzione.main-layout_produzione')

@section('main')
	<div class="container-fluid h-100">
		<div class="card mt-5" style="background-color:rgb(27, 57, 52);">
			<div class="card-body">

				<div class="row mb-5 justify-content-center">
					<div class="col-10 text-center">
						<a style="width: 100%; height: 60px; display: flex; align-items: center; justify-content: center;" class="btn btn-primary text-center btn-xl" href="{{ route('produzione.taglio') }}"><i class="fas fa-fw fa-cut"></i>&nbsp;&nbsp;Taglio</a>
					</div>
				</div>

				<div class="row mb-5 justify-content-center">
					<div class="col-10 text-center">
						<a style="width: 100%; height: 60px; display: flex; align-items: center; justify-content: center;" class="btn btn-primary text-center btn-xl" href="{{ route('produzione.piega') }}"><i class="fas fa-fw fa-layer-group"></i>&nbsp;&nbsp;Piega</a>
					</div>
				</div>

				<div class="row mb-5 justify-content-center">
					<div class="col-10 text-center">
						<a style="width: 100%; height: 60px; display: flex; align-items: center; justify-content: center;" class="btn btn-primary text-center btn-xl" href="{{ route('produzione.raccolta') }}"><i class="fas fa-fw fa-people-carry"></i>&nbsp;&nbsp;Raccolta</a>
					</div>
				</div>

				<div class="row mb-5 justify-content-center">
					<div class="col-10 text-center">
						<a style="width: 100%; height: 60px; display: flex; align-items: center; justify-content: center;" class="btn btn-primary text-center btn-xl" href="{{ route('produzione.cucitura') }}"><i class="fas fa-dot-circle"></i>&nbsp;&nbsp;Cucitura</a>
					</div>
				</div>

				<div class="row mb-5 justify-content-center">
					<div class="col-10 text-center">
						<a style="width: 100%; height: 60px; display: flex; align-items: center; justify-content: center;" class="btn btn-primary text-center btn-xl" href="{{ route('produzione.brossura') }}"><i class="fas fa-book-open"></i>&nbsp;&nbsp;Brossura</a>
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection

@section('scripts_pagine_secondarie')

@endsection

