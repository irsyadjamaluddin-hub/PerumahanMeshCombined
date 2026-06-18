@php 
    $pagename = "Personal Information";
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
        @endif

		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<p class="text-red-500 font-semibold">Personal Information</p>
		
	</div>

	<div class="m-10">

		{{-- Table Title --}}
		<div class="p-4 bg-green-100 text-green-700 rounded-t-xl font-extrabold text-xl">
			<p>Personal Information</p>
		</div>
		
		<div class="overflow-x-auto tableScrollbar">

			{{-- Table --}}
			<table class="tableTemplate text-sm shadow">
				
				{{-- Table Header --}}
				<tr class="tableHeaderTemplate bg-green-500 text-left">
					<th>ID</th>
					<th>Name</th>
					<th>Date of Birth</th>
					<th>IC Number</th>
					<th>Gender</th>
					<th class="text-center">Action</th>
				</tr>
				
				{{-- Table Rows (Data) --}}
				@if(count($biodatas) == 0)

					<tr class="text-center">
						<td colspan="8"><h5>No records found!</h5></td>
					</tr>
					
				@else

					@foreach($biodatas as $biodata)
					
						<tr class="">
							<td>{{ $biodata->ic_no }}</td>
							<td>{{ $biodata->name}}</td>
							<td>{{ $biodata->dob}}</td>
							<td>{{ $biodata->ic_no }}</td>
							<td>{{ optional($biodata->gender)->label }}</td>
							<td>
							
								{!! Form::open([
									'method' =>'DELETE',
									'route'  => ['biodatas.biodata.destroy', $biodata->ic_no],
								]) !!}
									<div class="flex flex-row items-center justify-center gap-2" role="group">
										
										<a href="{{ route('biodatas.biodata.show', $biodata->ic_no ) }}" class="rounded-full p-1 bg-yellow-400 hover:bg-red-500 text-white" title="Show Personal">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
											</svg>
										</a>
										
										<a href="{{ route('biodatas.biodata.edit', $biodata->ic_no ) }}" class=" rounded-full p-1 bg-green-400 hover:bg-red-500 text-white" title="Edit Personal">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
											</svg>
										</a>

										@php  ( $user = Auth::user()->email) @endphp
										
										@if (Auth::check())
											@if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
											
											{!! Form::button('
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
												</svg>', 
												[   
													'type'    => 'submit',
													'class'   => ' rounded-full p-1 bg-red-400 hover:bg-red-500 text-white',
													'title'   => 'Delete Personal',
													'onclick' => 'return confirm("' . 'Delete Claim?' . '")'
												])
											!!}
										
											@endif
										@endif
									
									</div>
								{!! Form::close() !!}

							</td>
						</tr>

					@endforeach

				@endif
		
			</table>
		</div>

	</div>

@endsection