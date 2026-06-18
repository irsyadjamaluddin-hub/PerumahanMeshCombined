@php 
    $pagename = "Unit";
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

			@if (Auth::user()->hasRole('ROLE_DA'))
				<a href="{{ route('da') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
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
        @endif

		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<a href="" class="ml-2 font-semibold hover:text-red-500">Unit</a>
		
		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<p class="text-red-500 font-semibold">Edit Unit Detail</p>
		
	</div>


	<div class="m-10">
		
		{{-- Title --}}
		<div class="flex flex-row p-4 justify-between bg-red-100 text-red-700 rounded-t-xl font-extrabold text-xl">
			<p>Edit Unit Detail</p>
			<div class="flex flex-row items-center gap-3">

				{{-- Show All (Button) --}}
				<a href="{{ route('units.unit.index') }}">
					<svg xmlns="http://www.w3.org/2000/svg" title="Show All Unit" class="w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
					</svg>
				</a>

                {{-- Add Button --}}
                <a href="{{ route('units.unit.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" title="Create Unit" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
						
			</div>
		</div>


		{{-- Form Body --}}
		<div class="bg-white py-4 px-10 text-xs shadow-lg rounded-b-md">

			{{-- Form Data --}}
			<div class="mt-5">

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

                {!! Form::model($unit, [
                    'method' => 'PUT',
                    'route' => ['units.unit.update', $unit->id],
                    'class' => 'form-horizontal',
                    'name' => 'edit_unit_form',
                    'id' => 'edit_unit_form',
                    
                ]) !!}

                @include ('units.form_edit', ['unit' => $unit,])

                <div class="flex sm:justify-end mt-7 mb-7">
                    {!! Form::submit('Update', ['class' => 'transition duration-500 bg-red-500 cursor-pointer hover:bg-black text-white font-extrabold py-2 px-10 rounded-lg text-center w-full sm:w-auto']) !!}
                </div>

                {!! Form::close() !!}
		
            </div>

		</div>


	</div>

@endsection

