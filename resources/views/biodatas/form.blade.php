{{-- Form Content --}}

{{-- Personal Information Section --}}
<div id="personalInformationContent" class="grid grid-cols-6 gap-y-7 gap-x-4">

	{{-- Personal Details --}}
	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-6">Personal Details</p>

	<div class="col-span-6 grid grid-cols-2 gap-x-10 gap-y-5">

		{{-- First Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center">

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right">Name (as stated in IC)</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('name_user', $users, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter name...', ]) !!}
				{!! $errors->first('name_user', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('ic_no') ? 'has-error' : '' }}">IC Number</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('ic_no', $icNos, ['class' => 'bg-gray-200 p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'readonly', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter IC...', ]) !!}
				{!! $errors->first('ic_no', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('bruhims_no') ? 'has-error' : '' }}">BuHIMS No</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('bruhims_no', null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter BruHIMS No...', ]) !!}
				{!! $errors->first('bruhims_no', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('race_id') ? 'has-error' : '' }}">Race</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('race_id', $races, null,['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter Race...', ]) !!}
				{!! $errors->first('race_id', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('religion_id') ? 'has-error' : '' }}">Religion</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('religion_id', $religions, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter Religion...', ]) !!}
				{!! $errors->first('religion_id', '<p class="help-block">:message</p>') !!}
			</div>

		</div>

		{{-- Second Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center">

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('dob') ? 'has-error' : '' }}">Date of Birth</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('dob',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_dob', 'placeholder' => 'Enter date of birth...', ]) !!}
				{!! $errors->first('dob', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('ic_color_id') ? 'has-error' : '' }}">IC Color</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('ic_color_id', $iccolors, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => 'Enter IC Color...', ]) !!}
				{!! $errors->first('ic_color_id', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('marital_status_id') ? 'has-error' : '' }}">Marital Status</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('marital_status_id', $maritalstatuss,null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => 'Enter marital status...', ]) !!}
				{!! $errors->first('marital_status_id', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('gender_id') ? 'has-error' : '' }}">Gender</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('gender_id', $genders, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => 'Enter gender...', ]) !!}
				{!! $errors->first('gender_id', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('citizenship_id') ? 'has-error' : '' }}">Citizenship</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('citizenship_id', $citizenships, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter Citizenship...', ]) !!}
				{!! $errors->first('citizenship_id', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('place_of_birth') ? 'has-error' : '' }}">Place of Birth</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('place_of_birth', null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter Place of Birth...', ]) !!}
				{!! $errors->first('place_of_birth', '<p class="help-block">:message</p>') !!}
			</div>

		</div>
		
	</div>
	
	<div class="col-span-6">
	
		<div class="grid grid-cols-2 gap-2 items-center ml-28">

			<p class="col-span-2 md:col-span-2 font-semibold text-left md:text-left">Vulnerable</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::textarea('vulnerable', null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'rows' => '5', 'maxlength' => '400', 'placeholder' => 'Enter vulnerable...', ]) !!}
				{!! $errors->first('vulnerable', '<p class="help-block">:message</p>') !!}
			</div>
			
		</div>
		
	</div>




	{{-- Contact Information --}}
	{{-- Form Title --}}
	<p class="text-lg font-extrabold mt-7 mb-3 col-span-6">Contact Information</p>

	{{-- New Contact Information --}}
	<div class="col-span-6 grid grid-cols-2 gap-x-10 gap-y-5">

		{{-- First Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center">

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('postal_address') ? 'has-error' : '' }}">Postal Address</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('postal_address',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '200', 'placeholder' => 'Enter postal address...', ]) !!}
				{!! $errors->first('postal_address', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('postal_code') ? 'has-error' : '' }}">Postal Code</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('postal_code',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter postal code...', ]) !!}
				{!! $errors->first('postal_code', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('country_id') ? 'has-error' : '' }}">Country</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('country_id', $countrys,null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => 'Enter country...', ]) !!}
				{!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('email') ? 'has-error' : '' }}">Government Email</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('email', $usersEmail, ['class' => 'bg-gray-200 p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '45', 'placeholder' => 'Enter government email...', ]) !!}
				{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
			</div>
		
		</div>

		{{-- Second Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center">

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('telephone_office') ? 'has-error' : '' }}">Telephone (Office)</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('telephone_office', $telOffice, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter telephone office...', ]) !!}
				{!! $errors->first('telephone_office', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('telephone_home') ? 'has-error' : '' }}">Telephone (Home)</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('telephone_home', $telHome, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter telephone home...', ]) !!}
				{!! $errors->first('telephone_home', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('telephone_mobile') ? 'has-error' : '' }}">Telephone (Mobile)</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('telephone_mobile', $telMobile, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter telephone office...', ]) !!}
				{!! $errors->first('telephone_mobile', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('personal_email') ? 'has-error' : '' }}">Personal Email</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('personal_email', null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '45', 'placeholder' => 'Enter personal email...', ]) !!}
				{!! $errors->first('personal_email', '<p class="help-block">:message</p>') !!}
			</div>
			
		</div>
	
	</div>
	
		<div class="flex sm:justify-end mt-7 mb-7">
			{!! Form::submit('Update', ['class' => 'transition duration-500 bg-green-500 cursor-pointer hover:bg-black text-white font-extrabold py-2 px-10 rounded-lg text-center w-full sm:w-auto']) !!}
		</div>

</div>

{{-- New Employment Information Section --}}
<div id="employmentInformationContent" class="hidden grid-cols-8 gap-4 mb-10">

	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-8">Employment Details</p>
	
	<div class="col-span-8 grid grid-cols-2 gap-x-10 gap-y-5 justify-center ">

		{{-- First Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center justify-center">

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('ministry_id') ? 'has-error' : '' }}">Kementerian <br> <i>Ministry</i> </p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('ministry_id', $ministry->ministry_name, ['readonly' => 'true', 'class' => 'bg-gray-200 p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
				{!! $errors->first('ministry_id', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('bahagian_id') ? 'has-error' : '' }}">Bahagian <br> <i>Section</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::Text('bahagian_id', $bahagian, ['id' => 'bahagian', 'class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
				{!! $errors->first('bahagian_id', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('role') ? 'has-error' : '' }}">Maktab/Sekolah <br> <i>College/School</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('school_id', $departments, $school, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
				{!! $errors->first('school_id', '<p class="help-block">:message</p>') !!}
			</div>

			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('role') ? 'has-error' : '' }}">Peranan <br> <i>Role</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('role', $roles, $role, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter role...', ]) !!}
				{!! $errors->first('role', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('employment_status_id') ? 'has-error' : '' }}">Jenis Perkhidmatan <i>Employment Type</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('employment_status_id', $employmentstatuss, $employmentStatus, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter employment status...', ]) !!}
				{!! $errors->first('employment_status_id', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('code_service') ? 'has-error' : '' }}">Kod Jawatan <br> <i>Position Code</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('code_service', null, ['readonly' => 'true', 'class' => 'bg-gray-200 p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
				{!! $errors->first('code_service', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('ssm_reference_no') ? 'has-error' : '' }}">No SMM Peribadi <br> <i>SSM Personnel No.</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('ssm_reference_no', $ssmRefNo, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter SSM reference no...', ]) !!}
				{!! $errors->first('ssm_reference_no', '<p class="help-block">:message</p>') !!}
			</div>			
		
		</div>

		{{-- Second Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center justify-center">
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('department_id') ? 'has-error' : '' }}">Jabatan <br> <i>Department</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('department_id', $departments, $department, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter department...', ]) !!}
				{!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('unit_name') ? 'has-error' : '' }}">Unit <br> <i>Unit</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::Text('unit_name', $unit, ['id' => 'unit_id', 'class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
				{!! $errors->first('unit_name', '<p class="help-block">:message</p>') !!}
			</div>			
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('cluster_id') ? 'has-error' : '' }}">Kluster <br> <i>Cluster</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('cluster_id', $clusters, $cluster, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
				{!! $errors->first('cluster_id', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('status_service') ? 'has-error' : '' }}">Status Perkhidmatan <br> <i>Service Status</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('status_service', $serviceStatus->service_status_name, ['readonly' => 'true', 'class' => 'bg-gray-200 p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
				{!! $errors->first('status_service', '<p class="help-block">:message</p>') !!}
			</div>		
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('skim_perkhidmatan_id') ? 'has-error' : '' }}">Skim Perkhidmatan <br> <i>Service Scheme</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('skim_perkhidmatan_id', $skimPerkhidmatans, $skimPerkhidmatan, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter skim perkhidmatan...', ]) !!}
				{!! $errors->first('skim_perkhidmatan_id', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('personnel_file') ? 'has-error' : '' }}">No Fail Peribadi <br> <i>Personnel Fail No</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('personnel_file', $personnelFail, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
				{!! $errors->first('personnel_file', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('salary_scale') ? 'has-error' : '' }}">Tanggagaji <br> <i>Salary Scale</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('salary_scale', $salaryScales, $salaryScale, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
				{!! $errors->first('salary_scale', '<p class="help-block">:message</p>') !!}
			</div>

			<p></p>
			<div class="col-span-3 md:col-span-2">
				
			</div>	
			
			
		</div>

	</div>
	
	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-8 mt-3">Intial Service Details</p>
	
	<div class="col-span-8 grid grid-cols-2 gap-x-10 gap-y-5 justify-center ">

		{{-- First Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center justify-center">
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('designation_id') ? 'has-error' : '' }}">Jawatan Lantikan Awal <br> <i>Intial Designation</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('designation_id', $designation, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter designation...', ]) !!}
				{!! $errors->first('designation_id', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('first_service_place') ? 'has-error' : '' }}">Tempat Bertugas Jawatan Lantikan Awal <br> <i>Intial Designation Placement</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('first_service_place', $designationPlace, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
				{!! $errors->first('first_service_place', '<p class="help-block">:message</p>') !!}
			</div>
		
		</div>

		{{-- Second Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center justify-center">
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('service_begin_date') ? 'has-error' : '' }}">Tarikh Lantikan Jawatan Awal <br> <i>Intial Designation Date</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('service_begin_date', $serviceDate, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_service', 'placeholder' => 'Enter service begin date...', ]) !!}
				{!! $errors->first('service_begin_date', '<p class="help-block">:message</p>') !!}
			</div>
			
		</div>

	</div>

	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-8 mt-3">Current Service Details</p>
	
	<div class="col-span-8 grid grid-cols-2 gap-x-10 gap-y-5 justify-center ">

		{{-- First Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center justify-center">
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('current_designation_id') ? 'has-error' : '' }}">Jawatan Sekarang <br> <i>Current Designation </i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('current_designation_id', $currentDesignation, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter current designation...', ]) !!}
				{!! $errors->first('current_designation_id', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('current_service_place') ? 'has-error' : '' }}">Tempat Bertugas Jawatan Sekarang <br> <i>Current Designation Placement</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('current_service_place', $designationCurrentPlace, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
				{!! $errors->first('current_service_place', '<p class="help-block">:message</p>') !!}
			</div>
		
		</div>

		{{-- Second Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center justify-center">
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('current_designation_date') ? 'has-error' : '' }}">Tarikh Lantikan Jawatan Sekarang <br> <i>Current Designation Date</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('current_designation_date', $roleDateStart, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_role_start', 'placeholder' => 'Enter current designation date...', ]) !!}
				{!! $errors->first('current_designation_date', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('district_work_id') ? 'has-error' : '' }}">Dearah Tempat Bertugas <br> <i>District of Work</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('district_work_id', $districts, $district, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter district of work...', ]) !!}
				{!! $errors->first('district_work_id', '<p class="help-block">:message</p>') !!}
			</div>
			
		</div>

	</div>
	
	<!-- {{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-8">Salary Information</p>
	
	<div class="col-span-8 grid grid-cols-2 gap-x-10 gap-y-5 justify-center ">

		{{-- First Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center justify-center">
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('salary_scale') ? 'has-error' : '' }}">Salary Scale</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('salary_scale', $salaryScales, $salaryScale, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter salary scale...', ]) !!}
				{!! $errors->first('salary_scale', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('salary') ? 'has-error' : '' }}">Salary</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('salary', $salary, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter salary...', ]) !!}
				{!! $errors->first('salary', '<p class="help-block">:message</p>') !!}
			</div>
		
		</div>

		{{-- Second Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center justify-center">
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('division_id') ? 'has-error' : '' }}">Division</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('division_id', $divisions, $division, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter division...', ]) !!}
				{!! $errors->first('division_id', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('allowance_category_id') ? 'has-error' : '' }}">Allowance Category</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('allowance_category_id', $allowancecategorys, $allowanceCat, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '-', ]) !!}
				{!! $errors->first('allowance_category_id', '<p class="help-block">:message</p>') !!}
			</div>
			
		</div>

	</div>
	 -->
		<div class="flex sm:justify-end mt-7 mb-7">
			{!! Form::submit('Update', ['class' => 'transition duration-500 bg-green-500 cursor-pointer hover:bg-black text-white font-extrabold py-2 px-10 rounded-lg text-center w-full sm:w-auto']) !!}
		</div>
	

</div>

{{-- New Education Information Section --}}
<div id="educationInformationContent" class="hidden grid-cols-8 gap-4 mb-10">

	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-8">Education Details</p>
	
	<div class="col-span-8 grid grid-cols-2 gap-x-10 gap-y-5 justify-center ">

		{{-- First Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-3 gap-4 items-center justify-center">

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('education_id') ? 'has-error' : '' }}">Kelulusan Tertinggi <i>Highest Education</i></p>
			
			<div class="col-span-3 md:col-span-2">
				{!! Form::select('education_id', $educations, $eduId, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter education...', ]) !!}
				{!! $errors->first('education_id', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right  {{ $errors->has('education_name') ? 'has-error' : '' }}">Bidang Kelulusan <i>Course Name</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('education_name', $eduName, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_service', 'placeholder' => 'Enter service begin date...', ]) !!}
				{!! $errors->first('education_name', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('graduation_date') ? 'has-error' : '' }}">Tarikh Sijil <br> <i>Ceritificate date</i></p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('graduation_date', $gradDate, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_graduate', 'placeholder' => 'Enter graduation date...', ]) !!}
				{!! $errors->first('graduation_date', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('file') ? 'has-error' : '' }}">Muat Naik Sijil <br> <i>Upload Ceritificate</i></p>
			<div class="col-span-3 md:col-span-2">
				
			<input type="file" name="file" accept=".jpg, .jpeg, .png, .pdf"  id="file">

			<a href='{{Storage::url("$eduFilePath") }}' target="_blank"><p>{{$eduFile}}</p></a>
				
				{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
			</div>
			
		</div>

	
	</div>
	
		<div class="flex sm:justify-end mt-7 mb-7">
			{!! Form::submit('Update', ['class' => 'transition duration-500 bg-green-500 cursor-pointer hover:bg-black text-white font-extrabold py-2 px-10 rounded-lg text-center w-full sm:w-auto']) !!}
		</div>

</div>

{{-- New Performance Information Section --}}
<div id="achievementsInformationContent" class="hidden grid-cols-8 gap-4 mb-10">

	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-8">Performance</p>

	<div class="col-span-8 grid grid-cols-2 gap-x-5 gap-y-5 justify-center">
		<div class="overflow-x-auto tableScrollbar mb-10">

			{{-- Table --}}
			<table class="tableTemplate text-sm shadow">
				
				{{-- Table Header --}}
				<tr class="tableHeaderTemplate bg-green-500 text-left">
					<th>Year</th>
					<th>Grade</th>
					<th>Percentage</th>
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
							<td>{{ $performance->year }}</td>
							<td>{{ optional($performance->grade)->label }}</td>
							<td>{{ $performance->percentage}}</td>
							<td>
								<div class="flex flex-row items-center justify-center gap-2" role="group">
									
									
									
									@if (Auth::check())
										@if (Auth::user()->hasRole('ROLE_ADMIN') || Auth::user()->hasRole('ROLE_HOD') || Auth::user()->hasRole('ROLE_MAW') || Auth::user()->hasRole('ROLE_MAW_SECOND') || 
										Auth::user()->hasRole('ROLE_MAW_ENDORSER') ||  Auth::user()->hasRole('ROLE_DA') || Auth::user()->hasRole('ROLE_ENDORSER')  ||  Auth::user()->hasRole('ROLE_CLAIMANT'))
										
										<a href="{{ route('performances.performance.edit', $performance->id ) }}" class=" rounded-full p-1 bg-green-400 hover:bg-red-500 text-white" title="Edit Performance">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
											</svg>
										</a>

										@php  ( $user = Auth::user()->email) @endphp

										@endif
									@endif
								
								</div>
							</td>
						</tr>

					@endforeach

				@endif
		
			</table>
		</div>
	</div>
	
	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-8">Medals</p>

	<div class="col-span-8 grid grid-cols-2 gap-x-5 gap-y-5 justify-center">
		<div class="overflow-x-auto tableScrollbar mb-10">

			{{-- Table --}}
			<table class="tableTemplate text-sm shadow">
				
				{{-- Table Header --}}
				<tr class="tableHeaderTemplate bg-green-500 text-left">
					<th>Year</th>
					<th>Name</th>
					<th class="text-center">Action</th>
				</tr>
				</tr>
				
				{{-- Table Rows (Data) --}}
				@if(count($medals) == 0)

					<tr class="text-center">
						<td colspan="8"><h5>No records found!</h5></td>
					</tr>
					
				@else

					@foreach($medals as $medal)
					
						<tr class="">
							<td>{{ $medal->year }}</td>
							<td>{{ $medal->name}}</td>
							<td>
								<div class="flex flex-row items-center justify-center gap-2" role="group">
									
									@if (Auth::check())
										@if (Auth::user()->hasRole('ROLE_ADMIN') || Auth::user()->hasRole('ROLE_HOD') || Auth::user()->hasRole('ROLE_MAW') || Auth::user()->hasRole('ROLE_MAW_SECOND') || 
										Auth::user()->hasRole('ROLE_MAW_ENDORSER') ||  Auth::user()->hasRole('ROLE_DA') || Auth::user()->hasRole('ROLE_ENDORSER')  ||  Auth::user()->hasRole('ROLE_CLAIMANT'))
										
										<a href="{{ route('medals.medal.edit', $medal->id ) }}" class=" rounded-full p-1 bg-green-400 hover:bg-red-500 text-white" title="Edit Medal">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
											</svg>
										</a>

										@php  ( $user = Auth::user()->email) @endphp

										@endif
									@endif
								
								</div>
							</td>
						</tr>

					@endforeach

				@endif
		
			</table>
			
		</div>
	</div>


</div>

{{-- New Medal Information Section --}}
<div id="medalInformationContent" class="hidden grid-cols-8 gap-4 mb-10">

	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-8">Medal Information</p>

	<div class="col-span-8 grid grid-cols-2 gap-x-5 gap-y-5 justify-center">
	   @php ($x = $medals->count()) @endphp
		@foreach($medals as $medal)
		{{-- First Half --}}
		<div class="col-span-4 md:col-span-1 grid grid-cols-3 gap-4 items-center">
		
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('year') ? 'has-error' : '' }}">Year</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('year[]', $medal->year, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-lightBlue focus:ring-indigo-600 focus:border-transparent rounded-md w-full', 'required', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'performance_year', 'placeholder' => 'Enter medal year...', ]) !!}
				{!! $errors->first('year', '<p class="help-block">:message</p>') !!}
			</div>

			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('name') ? 'has-error' : '' }}">Name</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('name[]', $medal->name, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-lightBlue focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '1', 'placeholder' => 'Enter name...', ]) !!}
				{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
			</div>
			
<!--			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('percentage') ? 'has-error' : '' }}">Attachment</p>
			<div class="relative border-dotted h-8 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center"> 
				<div class="absolute"> 
					<div class="flex flex-col items-center"> <i class="fa fa-folder-open fa-4x text-blue-700"></i> <span class="block text-gray-400 font-normal">Performance</span> </div>
				</div>
				<input type="file" name="file_1" accept=".jpg, .jpeg, .png, .pdf"  id="file_1" class="h-full w-full opacity-0" required>
			</div>
			{!! $errors->first('file_1', '<p class="help-block">:message</p>') !!}
-->			
		</div>
		
		<hr>
		@endforeach

		

	</div>

</div>


