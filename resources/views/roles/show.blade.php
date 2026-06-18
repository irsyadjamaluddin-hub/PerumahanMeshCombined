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

		<a href="{{ route('mileages.mileage.index') }}" class="ml-2 font-semibold hover:text-red-500">Role Types</a>

		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<p class="text-red-500 font-semibold">View Role Information</p>
		
	</div>

	<div class="m-10">

		{{-- Title --}}
		<div class="flex flex-row p-4 justify-between bg-yellow-100 text-yellow-700 rounded-t-xl font-extrabold text-xl">
			<p>{{ isset($role->name) ? $role->name : 'Role' }}</p>
			<div class="flex flex-row items-center gap-3">

				{!! Form::open([
					'method' =>'DELETE',
					'class'   => 'flex flex-row items-center gap-3',
					'route'  => ['roles.role.destroy', $role->id]
				]) !!}

				<a href="{{ route('roles.role.index') }}">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
					</svg>
				</a>

                <a href="{{ route('roles.role.create') }}">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
				</a>
                
                @php ($k = $role->id) @endphp
                @if ($k == 1)

                @else

                    <a href="{{ route('roles.role.edit', $role->id ) }}">
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
                            'title'   => 'Delete Role',
                            'class'	  => 'focus:outline-none',
                            'onclick' => 'return confirm("' . 'Delete Role?' . '")'
                        ])
                    !!}

                @endif
            

				{!! Form::close() !!}

			</div>
		</div>

		{{-- Form Body --}}
		<div class="bg-white py-4 px-10 text-xs shadow-lg rounded-b-md">
			
			{{-- Form Data --}}
			<div class="my-5 grid grid-cols-8 gap-x-3 gap-y-8 mx-auto">
				
				<div class="col-span-8 grid grid-cols-4 border-2 rounded-xl border-yellow-500 p-4">

					<p class="col-span-4 mb-2 text-yellow-500 font-bold text-lg">Personal Details</p>

					<hr class="col-span-4 border-yellow-600 my-2">

					<div class="col-span-4 sm:col-span-1 mt-2">
						<p class="font-bold">Name</p>
						<p>{{ $role->name }}</p>
					</div>

					<div class="col-span-4 sm:col-span-1 mt-2">
						<p class="font-bold">Description</p>
						<p>{{ $role->description }}</p>
					</div>

					<div class="col-span-4 sm:col-span-1 mt-2">
						<p class="font-bold">Created At</p>
						<p>{{ $role->created_at }}</p>
					</div>
	
					<div class="col-span-4 sm:col-span-1 mt-2">
						<p class="font-bold">Updated At</p>
						<p>{{$role->updated_at }}</p>
					</div>

				</div>

			</div>

		</div>
		
	</div>
	
@endsection