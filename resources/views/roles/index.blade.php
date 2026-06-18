@php 
    $pagename = "User";
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
        @endif

		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<a href="" class="ml-2 font-semibold hover:text-red-500">User</a>

		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<p class="text-red-500 font-semibold">Role Types</p>
		
	</div>

	<div class="m-10">

		{{-- Success Message --}}
		@if(Session::has('success_message'))
			<div id="SuccessMessage" class="p-2 w-full bg-green-200 rounded-md mb-5 flex flex-row items-center justify-between text-green-800">
			
				<div class="flex flex-row items-center">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-5" viewBox="0 0 20 20" fill="currentColor">
						<path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
					</svg>

					<p class="ml-3">{!! session('success_message') !!}</p>
				</div>

				<button onclick="closeSuccessMessage()" class="" data-dismiss="alert" aria-label="Close">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>

			</div>
		@endif

		{{-- Table Title --}}
		<div class="p-4 bg-yellow-100 text-yellow-700 rounded-t-xl font-extrabold text-xl flex flex-row items-center justify-between">
			<p>Role Types</p>

			<div>
				<a href="{{ route('roles.role.create') }}">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
				</a>
			</div>
		</div>
		
		<div class="overflow-x-auto tableScrollbar">

			{{-- Table --}}
			<table class="tableTemplate text-sm shadow">
				
				{{-- Table Header --}}
				<tr class="tableHeaderTemplate bg-yellow-500 text-left">
					<th>ID</th>
					<th>Name</th>
					<th>Description</th>
					<th class="text-center">Action</th>
				</tr>
				
				{{-- Table Rows (Data) --}}
				@if(count($roles) == 0)

					<tr class="text-center">
						<td colspan="8"><h5>No records found!</h5></td>
					</tr>
					
				@else

					@foreach($roles as $role)
					
						<tr class="">
							
							<td>{{ $role->id }}</td>
							<td class="px-5 py-5 text-sm">{{ $role->name}}</td>
							<td class="px-5 py-5 text-sm">{{ $role->description }}</td>

							<td>

								{!! Form::open([
									'method' =>'DELETE',
									'route'  => ['roles.role.destroy', $role->id],
								]) !!}


									<div class="flex flex-row items-center justify-center gap-2" role="group">
										
										<a href="{{ route('roles.role.show', $role->id ) }}" class="rounded-full p-1 bg-yellow-400 hover:bg-red-500 text-white" title="Show Role">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
											</svg>
										</a>

										@php  ($k = $role->id) @endphp

										@if ($k == 1)
										
										@else
											<a href="{{ route('roles.role.edit', $role->id ) }}" class=" rounded-full p-1 bg-green-400 hover:bg-red-500 text-white" title="Edit Role">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
												</svg>
											</a>

											{!! Form::button('
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
												</svg>', 
												[   
													'type'    => 'submit',
													'class'   => 'border-2 border-red-400 rounded-full p-0.5 bg-red-400 text-white focus:outline-none',
													'title'   => 'Delete Role',
													'onclick' => 'return confirm("' . 'Delete Role?' . '")'
												])
											!!}
										@endif

									</div>

								{!! Form::close() !!}

							</td>
						</tr>

					@endforeach

				@endif
		
			</table>
			
			<div class="d-flex justify-content-center mt-2 px-5">
				{!! $roles->links() !!}
			</div>
			
		</div>

	</div>

	<!-- JQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>

	<!-- Page specific script -->
	<script>
		$(function () {
			$("#example1").DataTable({
				"responsive": true, "lengthChange": false, "autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	</script>


@endsection