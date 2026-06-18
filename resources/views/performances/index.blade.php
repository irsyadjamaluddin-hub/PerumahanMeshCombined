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

		<a href="" class="ml-2 font-semibold hover:text-red-500">Performance</a>
		
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
		<div class="p-4 bg-blue-100 text-blue-700 rounded-t-xl font-extrabold text-xl flex flex-row items-center justify-between">
			<p>Performance Information</p>
			
			<div>
				<a href="{{ route('performances.performance.create') }}">
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
				<tr class="tableHeaderTemplate bg-indigo-500 text-left">

					<th>IC Number</th>
					<th>Year</th>
					<th>Grade</th>
					<th class="text-center">Percentage</th>
					<th class="text-center">Attachment</th>
					<th class="text-center">Status</th>
					<th class="text-center">Action</th>
				</tr>
				
				{{-- Table Rows (Data) --}}
				@if(count($performances) == 0)

					<tr class="text-center">
						<td colspan="8"><h5>No records found!</h5></td>
					</tr>
					
				@else

					@foreach($performances as $performance)
					
						<tr class="">
							@if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
								<td>{{ $performance->id }}</td>
							@endif

							<td class="px-5 py-5 text-sm">{{ $performance->ic_no}}</td>
							<td class="px-5 py-5 text-center">{{ $performance->year }}</td>
							<td class="px-5 py-5 text-center">{{ optional($performance->grade)->label }}</td>
							<td class="px-5 py-5 text-center">{{ $performance->percentage }}</td>
							<td class="px-5 py-5 text-center">
							
							
							@if (isset($performance->file_1) && !empty($performance->file_1))
							<div onclick="openAttachmentOne()" class="relative border-dotted h-8 rounded-lg border-2 border-blue-700 bg-gray-100 flex justify-center items-center cursor-pointer">
								<div class="absolute">
									<div class="flex flex-col items-center"> <i class="fa fa-folder-open fa-4x text-blue-700"></i> 
										<span class="text-gray-400 font-normal">
											<p>{{ $performance->file_1 }}</p>
										</span> 
									</div>
								</div>
							</div>

							
							<div id="attachmentOne" class="hidden z-50 fixed left-0 top-0 w-full h-full overflow-auto" style="background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">

								<div class="relative w-11/12 overflow-hidden mx-auto flex justify-end my-5">
									<svg onclick="closeAttachmentOne()" xmlns="http://www.w3.org/2000/svg" class="w-7 cursor-pointer text-white hover:text-red-500 transition duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
									</svg>
								</div>
								{{-- Modal Content --}}
								@php
									$filename = "$performance->file_1";
									$ext_name = \File::extension($filename);    
								@endphp

								@if ( ($ext_name=="png") || ($ext_name=="jpg") || ($ext_name=="jpeg") || ($ext_name=="bmp") )
									
									<div class="relative w-10/12 overflow-hidden mx-auto flex justify-content-center">
										<img src='{{ asset('usdi/performance/' . $performance->file_1) }}' class="mx-auto w-auto">
									</div>

								@elseif  ( ($ext_name=="pdf") )
									
									<div class="relative w-10/12 overflow-hidden mx-auto flex justify-content-center" style="padding-top: 56.25%;">
										<iframe src='{{ asset('usdi/performance/' . $performance->file_1) }}' class="absolute top-0 left-0 bottom-0 right-0 w-full h-full "></iframe>
									</div>

								@else
									
									<div class="relative w-10/12 overflow-hidden mx-auto flex justify-content-center" style="padding-top: 56.25%;">
										<iframe src='{{ asset('usdi/performance/' . $performance->file_1) }}' class="absolute top-0 left-0 bottom-0 right-0 w-full h-full "></iframe>
									</div>

								@endif   

							</div>

						<script>
							function openAttachmentOne() {
								var attachmentOne = document.getElementById("attachmentOne");

								if (attachmentOne.classList.contains('hidden')){
									
									attachmentOne.classList.remove('hidden');
									attachmentOne.classList.add('block');
								}
							}

							function closeAttachmentOne() {
								var attachmentOne = document.getElementById("attachmentOne");

								if (attachmentOne.classList.contains('block')){
									
									attachmentOne.classList.remove('block');
									attachmentOne.classList.add('hidden');
								}
							}
						</script>
						
							@endif
							
							</td>
							
							<td class="px-5 py-5 text-center">
							@if ($performance->performance_status_id === 1)
								
									<span class="relative inline-block px-3 py-1 font-semibold text-yellow-500 leading-tight">
										<span aria-hidden class="absolute inset-0 bg-yellow-300 opacity-50 rounded-full"></span>
										<span class="relative">{{ optional($performance->performanceStatus)->label }}</span>
									</span>
								
							@elseif ($performance->performance_status_id === 2)
								
									<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
										<span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
										<span class="relative">{{ optional($performance->performanceStatus)->label }}</span>
									</span>
								
							@elseif ($performance->performance_status_id === 3)
								
									<span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
										<span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
										<span class="relative">{{ optional($performance->performanceStatus)->label }}</span>
									</span>
								
							@else
									<span class="relative">{{ optional($performance->performanceStatus)->label }}</span>

							@endif
							</td>
							
							<td>

								{!! Form::open([
									'method' =>'DELETE',
									'route'  => ['performances.performance.destroy', $performance->id],
								]) !!}


									<div class="flex flex-row items-center justify-center gap-2" role="group">
										
										
										
										@if (Auth::check())
											@if (Auth::user()->hasRole('ROLE_ADMIN') || Auth::user()->hasRole('ROLE_HOD') || Auth::user()->hasRole('ROLE_MAW') || Auth::user()->hasRole('ROLE_MAW_SECOND') || 
											Auth::user()->hasRole('ROLE_MAW_ENDORSER') ||  Auth::user()->hasRole('ROLE_DA') || Auth::user()->hasRole('ROLE_ENDORSER')  ||  Auth::user()->hasRole('ROLE_CLAIMANT'))
											
											<!--
											<a href="{{ route('performances.performance.show', $performance->id ) }}" class="rounded-full p-1 bg-yellow-400 hover:bg-red-500 text-white" title="Show Performance">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
												</svg>
											</a>
											-->
											
											<a href="{{ route('performances.performance.edit', $performance->id ) }}" class=" rounded-full p-1 bg-green-400 hover:bg-red-500 text-white" title="Edit Performance">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
												</svg>
											</a>

											@php  ( $user = Auth::user()->email) @endphp
									
											{!! Form::button('
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
												</svg>', 
												[   
													'type'    => 'submit',
													'class'   => 'border-2 border-red-400 rounded-full p-0.5 bg-red-400 text-white',
													'title'   => 'Delete Performance',
													'onclick' => 'return confirm("' . 'Delete Performance?' . '")'
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
			
			<div class="d-flex justify-content-center mt-2 px-5">
				{!! $performances->links() !!}
			</div>

			
			
		
		</div>

	</div>

@endsection