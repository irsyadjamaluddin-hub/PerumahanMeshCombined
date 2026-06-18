{{-- Form Content --}}
{{-- Personal Information Section --}}
<div id="personalInformationContent" class="grid grid-cols-6 gap-4">

	{{-- Personal Details --}}
	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-6">Personal Details</p>

	<div class="col-span-6">
		<p class="font-semibold">Name (as stated in IC)</p><br>
		{!! Form::text('name', $users, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => 'Enter name...', ]) !!}
		{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-3 my-2 {{ $errors->has('ic_no') ? 'has-error' : '' }}">
		<p class="font-semibold">IC Number</p><br>
		{!! Form::text('ic_no', $icNos, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter IC No...', ]) !!}
		{!! $errors->first('ic_no', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-3 my-2 {{ $errors->has('ic_color_id') ? 'has-error' : '' }}">
		<p class="font-semibold">IC Color</p><br>
		{!! Form::select('ic_color_id', $iccolors, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => 'Enter IC Color...', ]) !!}
		{!! $errors->first('ic_color_id', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-2 my-2  {{ $errors->has('dob') ? 'has-error' : '' }}">
		<p class="font-semibold">Date of Birth</p><br>
		{!! Form::text('dob',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_dob', 'placeholder' => 'Enter date of birth...', ]) !!}
		{!! $errors->first('dob', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-2 my-2 {{ $errors->has('marital_status_id') ? 'has-error' : '' }}">
		<p class="font-semibold">Marital Status</p><br>
		{!! Form::select('marital_status_id', $maritalstatuss,null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => 'Enter marital status...', ]) !!}
		{!! $errors->first('marital_status_id', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-2 my-2 {{ $errors->has('gender_id') ? 'has-error' : '' }}">
		<p class="font-semibold">Gender</p><br>
		{!! Form::radio('gender_id', $genders, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => 'Enter gender...', ]) !!}
		{!! $errors->first('gender_id', '<p class="help-block">:message</p>') !!}
	</div>

	{{-- Contact Information --}}
	{{-- Form Title --}}
	<p class="text-lg font-extrabold mt-7 mb-3 col-span-6">Contact Information</p>

	<div class="col-span-6 sm:col-span-6 {{ $errors->has('postal_address') ? 'has-error' : '' }}">
		<p class="font-semibold">Postal Address</p><br>
		{!! Form::text('postal_address',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '200', 'placeholder' => 'Enter postal address...', ]) !!}
		{!! $errors->first('postal_address', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-3 my-2 {{ $errors->has('postal_code') ? 'has-error' : '' }}">
		<p class="font-semibold">Postal Code</p><br>
		{!! Form::text('postal_code',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter postal code...', ]) !!}
		{!! $errors->first('postal_code', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-3 my-2 {{ $errors->has('country_id') ? 'has-error' : '' }}">
		<p class="font-semibold">Country</p><br>
		{!! Form::select('country_id', $countrys,null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => 'Enter country...', ]) !!}
		{!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-2 lg:col-span-1 my-2 {{ $errors->has('telephone_office') ? 'has-error' : '' }}">
		<p class="font-semibold">Telephone (Office)</p><br>
		{!! Form::text('telephone_office',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter telephone office...', ]) !!}
		{!! $errors->first('telephone_office', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-2 lg:col-span-1 my-2 {{ $errors->has('telephone_home') ? 'has-error' : '' }}">
		<p class="font-semibold">Telephone (Home)</p><br>
		{!! Form::text('telephone_home',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter telephone home...', ]) !!}
		{!! $errors->first('telephone_home', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-6 sm:col-span-2 lg:col-span-1 my-2 {{ $errors->has('telephone_mobile') ? 'has-error' : '' }}">
		<p class="font-semibold">Telephone (Mobile)</p><br>
		{!! Form::text('telephone_mobile',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter telephone mobile...', ]) !!}
		{!! $errors->first('telephone_mobile', '<p class="help-block">:message</p>') !!}
	</div>
	
	<div class="col-span-6 lg:col-span-3 my-2 {{ $errors->has('email') ? 'has-error' : '' }}">
		<p class="font-semibold">Email</p><br>
		{!! Form::text('email', $usersEmail, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '45', 'placeholder' => 'Enter email...', ]) !!}
		{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	</div>

</div>


{{-- Employment Information Section --}}
<div id="employmentInformationContent" class="hidden grid-cols-8 gap-4 mb-10">

	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-8">Employment Information</p>

	<div class="col-span-8 sm:col-span-4 md:col-span-2 my-2 {{ $errors->has('service_begin_date') ? 'has-error' : '' }}">
		<p class="font-semibold">Service Begin Date</p><br>
		{!! Form::text('service_begin_date',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_service', 'placeholder' => 'Enter service begin date...', ]) !!}
		{!! $errors->first('service_begin_date', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-8 sm:col-span-4 md:col-span-2 my-2 {{ $errors->has('department_id') ? 'has-error' : '' }}">
		<p class="font-semibold">Department</p><br>
		{!! Form::select('department_id', $departments, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter department...', ]) !!}
		{!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-8 sm:col-span-4 md:col-span-2 my-2 {{ $errors->has('employment_status_id') ? 'has-error' : '' }}">
		<p class="font-semibold">Employment Status</p><br>
		{!! Form::select('employment_status_id', $employmentstatuss, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter employment status...', ]) !!}
		{!! $errors->first('employment_status_id', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-8 sm:col-span-4 md:col-span-2 my-2 {{ $errors->has('designation') ? 'has-error' : '' }}">
		<p class="font-semibold">Designation (Jawatan)</p><br>
		{!! Form::text('designation',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '50', 'placeholder' => 'Enter designation...', ]) !!}
		{!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-8 sm:col-span-4 md:col-span-2 my-2  {{ $errors->has('salary_scale') ? 'has-error' : '' }}">
		<p class="font-semibold">Salary Scale</p><br>
		{!! Form::text('salary_scale',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter salary scale...', ]) !!}
		{!! $errors->first('salary_scale', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-8 sm:col-span-4 md:col-span-2 my-2 {{ $errors->has('salary') ? 'has-error' : '' }}">
		<p class="font-semibold">Salary</p><br>
		{!! Form::text('salary',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter salary...', ]) !!}
		{!! $errors->first('salary', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-8 sm:col-span-4 md:col-span-2 my-2 {{ $errors->has('division_id') ? 'has-error' : '' }}">
		<p class="font-semibold">Division</p><br>
		{!! Form::select('division_id', $divisions, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter division...', ]) !!}
		{!! $errors->first('division_id', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="col-span-8 sm:col-span-4 md:col-span-2 my-2 {{ $errors->has('allowance_category_id') ? 'has-error' : '' }}">
		<p class="font-semibold">Allowance Category</p><br>
		{!! Form::select('allowance_category_id', $allowancecategorys, null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-black focus:ring-green-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => 'Enter allowance category...', ]) !!}
		{!! $errors->first('allowance_category_id', '<p class="help-block">:message</p>') !!}
	</div>

</div>