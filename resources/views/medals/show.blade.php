@php 
    $pagename = "Performance";
@endphp

@extends('layouts.app2')

@section('content')
	
	{{-- Breadcrumbs --}}
	<div class="flex flex-row items-center mb-10 px-4 py-2 text-sm bg-red-100">
					
		@if (Auth::check())
			@if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
				<a href="{{ route('admin') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif

			@if (Auth::user()->hasRole('ROLE_CLAIMANT'))
				<a href="{{ route('claimant') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif

			@if (Auth::user()->hasRole('ROLE_HOD'))
				<a href="{{ route('hod') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif
			
			@if (Auth::user()->hasRole('ROLE_MAW'))
				<a href="{{ route('maw') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif
			
			@if (Auth::user()->hasRole('ROLE_MAW_SECOND'))
				<a href="{{ route('mawSecond') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif
			
			@if (Auth::user()->hasRole('ROLE_MAW_ENDORSER'))
				<a href="{{ route('mawendorser') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif
			
			@if (Auth::user()->hasRole('ROLE_ENDORSER'))
				<a href="{{ route('endorser') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif

			@if (Auth::user()->hasRole('ROLE_DA'))
				<a href="{{ route('da') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif
        @endif

		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<a href="{{ route('performances.performance.index') }}" class="ml-2 font-semibold hover:text-red-500">Performance</a>

	
		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<p class="text-red-500 font-semibold">View Performance</p>
		
	</div>

	<div class="m-10">

		{{-- Title --}}
		<div class="flex flex-row p-4 justify-between bg-indigo-100 text-indigo-700 rounded-t-xl font-extrabold text-xl">
			<p>Claims Information</p>
			<div class="flex flex-row items-center gap-3">

				{!! Form::open([
					'method' =>'DELETE',
					'class'   => 'flex flex-row items-center gap-3',
					'route'  => ['performances.performance.destroy', $performance->id]
				]) !!}

				<a href="{{ url()->previous() }}">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
					</svg>
				</a>

				@if (Auth::check())
					@if (Auth::user()->hasRole('ROLE_SUPERADMIN'))

							<a href="{{ route('performances.performance.edit', $performance->id ) }}">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-5" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
								</svg>
							</a>

							{!! Form::button('
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"  class="w-5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
							</svg>', 
							[   
								'type'    => 'submit',
								'title'   => 'Delete performance',
								'class'	  => 'focus:outline-none',
								'onclick' => 'return confirm("' . 'Delete Performance?' . '")'
							])
							!!}
						
					@endif
				@endif

				{!! Form::close() !!}

			</div>

		</div>

		{{-- Form Body --}}
		<div class="bg-white py-4 px-10 text-xs shadow-lg rounded-b-md">

			<h1>Page is still under maintainance!</h1>
					
		</div>

	</div>


<script>
	
	// Form
	// Personal Infromation Tab-button
	const personalInformationButton =  document.querySelector('#personalInformationButton');
	const personalInformationContent =  document.querySelector('#personalInformationContent');

	// Employment Infromation Tab-button
	const employmentInformationButton =  document.querySelector('#employmentInformationButton');
	const employmentInformationContent =  document.querySelector('#employmentInformationContent');

	// Application Infromation Tab-button
	const applicationInformationButton =  document.querySelector('#applicationInformationButton');
	const applicationInformationContent =  document.querySelector('#applicationInformationContent');

	const adminUseButton =  document.querySelector('#adminUseButton');
	const adminUseContent =  document.querySelector('#adminUseContent');
	
	personalInformationButton.addEventListener('click',() => {
		
		if (personalInformationContent.classList.contains('hidden')){

			personalInformationContent.classList.remove('hidden');
			personalInformationContent.classList.add('grid');

			employmentInformationContent.classList.add('hidden');
			employmentInformationContent.classList.remove('grid');

			applicationInformationContent.classList.add('hidden');
			applicationInformationContent.classList.remove('grid');

			adminUseContent.classList.add('hidden');
			adminUseContent.classList.remove('grid');

			if (personalInformationButton.classList.contains('bg-indigo-500')){
		
			} else {
				personalInformationButton.classList.add('bg-indigo-500');
				personalInformationButton.classList.add('hover:bg-lightBlue');
				personalInformationButton.classList.remove('text-gray-500');
				personalInformationButton.classList.remove('hover:text-indigo-500');

				employmentInformationButton.classList.remove('bg-indigo-500');
				employmentInformationButton.classList.remove('hover:bg-lightBlue');
				employmentInformationButton.classList.add('text-gray-500');
				employmentInformationButton.classList.add('hover:text-indigo-500');

				applicationInformationButton.classList.remove('bg-indigo-500');
				applicationInformationButton.classList.remove('hover:bg-lightBlue');
				applicationInformationButton.classList.add('text-gray-500');
				applicationInformationButton.classList.add('hover:text-indigo-500');

				adminUseButton.classList.remove('bg-indigo-500');
				adminUseButton.classList.remove('hover:bg-lightBlue');
				adminUseButton.classList.add('text-gray-500');
				adminUseButton.classList.add('hover:text-indigo-500');

			}


		} else if(personalInformationContent.classList.contains('grid')){
			
		}

		else{
			personalInformationContent.classList.add('hidden');
			personalInformationContent.classList.remove('grid');

		}
	})

	employmentInformationButton.addEventListener('click',() => {
		
		if (employmentInformationContent.classList.contains('hidden')){

			employmentInformationContent.classList.remove('hidden');
			employmentInformationContent.classList.add('grid');
			
			personalInformationContent.classList.add('hidden');
			personalInformationContent.classList.remove('grid');

			applicationInformationContent.classList.add('hidden');
			applicationInformationContent.classList.remove('grid');

			adminUseContent.classList.add('hidden');
			adminUseContent.classList.remove('grid');
			

			if (employmentInformationButton.classList.contains('bg-indigo-500')){
		
			} else {
				personalInformationButton.classList.remove('bg-indigo-500');
				personalInformationButton.classList.remove('hover:bg-lightBlue');
				personalInformationButton.classList.add('text-gray-500');
				personalInformationButton.classList.add('hover:text-indigo-500');

				employmentInformationButton.classList.add('bg-indigo-500');
				employmentInformationButton.classList.add('hover:bg-lightBlue');
				employmentInformationButton.classList.remove('text-gray-500');
				employmentInformationButton.classList.remove('hover:text-indigo-500');

				applicationInformationButton.classList.remove('bg-indigo-500');
				applicationInformationButton.classList.remove('hover:bg-lightBlue');
				applicationInformationButton.classList.add('text-gray-500');
				applicationInformationButton.classList.add('hover:text-indigo-500');

				adminUseButton.classList.remove('bg-indigo-500');
				adminUseButton.classList.remove('hover:bg-lightBlue');
				adminUseButton.classList.add('text-gray-500');
				adminUseButton.classList.add('hover:text-indigo-500');
			}
			
		} else if(employmentInformationContent.classList.contains('grid')){
			
		}

		else{
			employmentInformationContent.classList.add('hidden');
			employmentInformationContent.classList.remove('grid');

		}
	})

	applicationInformationButton.addEventListener('click',() => {
		
		if (applicationInformationContent.classList.contains('hidden')){

			employmentInformationContent.classList.add('hidden');
			employmentInformationContent.classList.remove('grid');
			
			personalInformationContent.classList.add('hidden');
			personalInformationContent.classList.remove('grid');

			applicationInformationContent.classList.remove('hidden');
			applicationInformationContent.classList.add('grid');

			adminUseContent.classList.add('hidden');
			adminUseContent.classList.remove('grid');


			if (applicationInformationButton.classList.contains('bg-indigo-500')){
		
			} else {
				personalInformationButton.classList.remove('bg-indigo-500');
				personalInformationButton.classList.remove('hover:bg-lightBlue');
				personalInformationButton.classList.add('text-gray-500');
				personalInformationButton.classList.add('hover:text-indigo-500');

				employmentInformationButton.classList.remove('bg-indigo-500');
				employmentInformationButton.classList.remove('hover:bg-lightBlue');
				employmentInformationButton.classList.add('text-gray-500');
				employmentInformationButton.classList.add('hover:text-indigo-500');

				applicationInformationButton.classList.add('bg-indigo-500');
				applicationInformationButton.classList.add('hover:bg-lightBlue');
				applicationInformationButton.classList.remove('text-gray-500');
				applicationInformationButton.classList.remove('hover:text-indigo-500');

				adminUseButton.classList.remove('bg-indigo-500');
				adminUseButton.classList.remove('hover:bg-lightBlue');
				adminUseButton.classList.add('text-gray-500');
				adminUseButton.classList.add('hover:text-indigo-500');
			}
			
		} else if(applicationInformationContent.classList.contains('grid')){
			
		}

		else{
			applicationInformationContent.classList.add('hidden');
			applicationInformationContent.classList.remove('grid');

		}
	})


	adminUseButton.addEventListener('click',() => {
		
		if (adminUseContent.classList.contains('hidden')){

			employmentInformationContent.classList.add('hidden');
			employmentInformationContent.classList.remove('grid');
			
			personalInformationContent.classList.add('hidden');
			personalInformationContent.classList.remove('grid');

			applicationInformationContent.classList.add('hidden');
			applicationInformationContent.classList.remove('grid');

			adminUseContent.classList.remove('hidden');
			adminUseContent.classList.add('grid');


			if (adminUseButton.classList.contains('bg-indigo-500')){
		
			} else {
				personalInformationButton.classList.remove('bg-indigo-500');
				personalInformationButton.classList.remove('hover:bg-lightBlue');
				personalInformationButton.classList.add('text-gray-500');
				personalInformationButton.classList.add('hover:text-indigo-500');

				employmentInformationButton.classList.remove('bg-indigo-500');
				employmentInformationButton.classList.remove('hover:bg-lightBlue');
				employmentInformationButton.classList.add('text-gray-500');
				employmentInformationButton.classList.add('hover:text-indigo-500');

				applicationInformationButton.classList.remove('bg-indigo-500');
				applicationInformationButton.classList.remove('hover:bg-lightBlue');
				applicationInformationButton.classList.add('text-gray-500');
				applicationInformationButton.classList.add('hover:text-indigo-500');

				adminUseButton.classList.add('bg-indigo-500');
				adminUseButton.classList.add('hover:bg-lightBlue');
				adminUseButton.classList.remove('text-gray-500');
				adminUseButton.classList.remove('hover:text-indigo-500');
			}
			
		} else if(adminUseContent.classList.contains('grid')){
			
		}

		else{
			adminUseContent.classList.add('hidden');
			adminUseContent.classList.remove('grid');

		}
	})

</script>
	
@endsection