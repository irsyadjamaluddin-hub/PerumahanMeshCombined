@php 
    $pagename = "Medal";
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
			@if (Auth::user()->hasRole('ROLE_ENDORSER'))
				<a href="{{ route('endorser') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif
			@if (Auth::user()->hasRole('ROLE_MAW_ENDORSER'))
				<a href="{{ route('mawendorser') }}" class="ml-2 font-semibold hover:text-red-500">Home</a>
            @endif
        @endif


		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<a href="" class="ml-2 font-semibold hover:text-red-500">Medal</a>

		{{-- Right Arrow --}}
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
		</svg>

		<p class="text-red-500 font-semibold">Add Medal</p>
		
	</div>

	<div class="m-10">

		{{-- Title --}}
		<div class="flex flex-row p-4 justify-between bg-indigo-100 text-indigo-700 rounded-t-xl font-extrabold text-xl">
			<p>Add Medal</p>
			<div class="flex flex-row items-center gap-3">

				@if (Auth::check())
					@if (Auth::user()->hasRole('ROLE_CLAIMANT'))
						
						<a href="{{ route('claimant') }}">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
							</svg>
						</a>

					@endif
				@endif

			</div>
		</div>

		{{-- Form Body --}}
		<div class="bg-white py-4 px-10 text-xs shadow-lg rounded-b-md">
		
			{{-- Error Message --}}
			@if ($errors->any())
				<div class="flex flex-row items-center gap-2 my-5 px-5 py-2 bg-red-200 text-red-600 font-extrabold rounded-lg">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
					<p>{{ $errors }}</p>
				</div>
			@endif
			
			
			{{-- Form Data --}}
			<div class="mt-5">

				{!! Form::open([
					'route' => 'medals.medal.store',
					'class' => 'form-horizontal',
					'name' => 'create_mileage_form',
					'id' => 'create_mileage_form',
					'files' => true,
					])
				!!}

				@include ('medals.form', ['medal' => null,])
											
				

				{!! Form::close() !!}



			</div>

		</div>
		
	</div>		
	

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
		$(function() {
			$( "#performance_year" ).datepicker({
           changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
				yearRange: '-30:+0',
                onClose: function(dateText, inst) { 
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 1));
                }
            });
        $(".date-picker-year").focus(function () {
                $(".ui-datepicker-month").hide();
			});
		});
</script>
<style>
    .ui-datepicker-calendar {
        display: none;
    }
	.ui-datepicker-month {
        display: none;
    }
    </style>
@endsection