{{-- Form Content --}}

	{{-- Form Title --}}
	<p class="text-lg font-extrabold mb-3 col-span-6">Medal</p>

	<div class="col-span-6 grid grid-cols-2 gap-x-10 gap-y-5 mb-10">

		{{-- First Half --}}
		<div class="col-span-4 md:col-span-1 grid grid-cols-3 gap-4 items-center">
		
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('year') ? 'has-error' : '' }}">Year</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('year', $yearMedal, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-lightBlue focus:ring-indigo-600 focus:border-transparent rounded-md w-full', 'required', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'medal_year', 'placeholder' => 'Enter medal year...', ]) !!}
				{!! $errors->first('year', '<p class="help-block">:message</p>') !!}
			</div>
			
			<p class="col-span-3 md:col-span-1 font-semibold text-left md:text-right {{ $errors->has('name') ? 'has-error' : '' }}">Name</p>
			<div class="col-span-3 md:col-span-2">
				{!! Form::text('name', $medalName, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-lightBlue focus:ring-green-600 focus:border-transparent rounded-md w-full', 'required' => 'true', 'spellcheck' => 'false','autocomplete'=>'off', 'min' => '0', 'max' => '250', 'maxlength' => '250', 'placeholder' => 'Enter name...', ]) !!}
				{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
			</div>

		</div>

		{{-- Second Half --}}
		<div class="col-span-2 md:col-span-1 grid grid-cols-4 gap-4 items-center">

			<div class="col-span-3 sm:col-span-3 lg:col-span-2 my-2">
			Attachment:
				<div class="relative border-dotted h-8 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
					<div class="absolute">
						<div class="flex flex-col items-center"> <i class="fa fa-folder-open fa-4x text-blue-700"></i> <span class="block text-gray-400 font-normal">Medal</span> </div>
					</div>
					<input type="file" name="file_1" accept=".jpg, .jpeg, .png, .pdf"  id="file_1" class="h-full w-full opacity-0" required>
				</div>
				{!! $errors->first('file_1', '<p class="help-block">:message</p>') !!}
			</div>
			
		</div>
		
		
	</div>

</div>

{!! Form::hidden('medal_status_id', 1, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => 'Enter status...', ]) !!}
{!! $errors->first('medal_status_id', '<p class="help-block">:message</p>') !!}

{!! Form::hidden('medal_submission_date', $year, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-lightBlue focus:ring-indigo-600 focus:border-transparent rounded-md w-full', 'spellcheck' => 'false',  'id' => 'form_claim_date', 'required' => true, 'placeholder' => 'Date Claim', ]) !!}
{!! $errors->first('medal_submission_date', '<p class="help-block">:message</p>') !!}

