@extends('layouts.app3')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-xs-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card">
				<div class="card-header bg-primary text-white">
					<h5  class="my-1 float-left">Create Personal Information</h5>
					@if (Auth::check())
					@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_HOD'))
					<div class="btn-group btn-group-sm float-right" role="group">
						<a href="{{ route('biodatas.biodata.index') }}" class="btn btn-primary" title="Show All Biodata">
							<i class=" fas fa-fw fa-th-list" aria-hidden="true"></i>
						</a>
					</div>
					@endif
					@endif
				</div>
				<div class="card-body">
					{{-- Error Message --}}
					@if ($errors->any())
						@foreach ($errors->all() as $error)

							<div class="ErrorMessage p-2 w-full bg-red-200 rounded-md mb-5 flex flex-row items-center justify-between text-red-800">
								
								<div class="flex flex-row items-center">
									<svg xmlns="http://www.w3.org/2000/svg" class="w-5" viewBox="0 0 20 20" fill="currentColor">
										<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
									</svg>

									<p class="ml-3">{{ $error }}</p>
								</div>

								<button onclick="closeErrorMessage()" class="" data-dismiss="alert" aria-label="Close">
									<svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
									</svg>
								</button>

							</div>

						@endforeach
					@endif

					{!! Form::open([
						'route' => 'biodatas.biodata.store',
						'class' => 'form-horizontal',
						'name' => 'create_biodata_form',
						'id' => 'create_biodata_form',
						
						])
					!!}

					@include ('biodatas.form', ['biodata' => null,])
					
					 <div class="form-group row mb-0">
						<div class="col-md-8 offset-md-5">
							{!! Form::submit('Apply', ['class' => 'btn btn-primary']) !!}
						</div>
					</div>

					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>

@endsection


