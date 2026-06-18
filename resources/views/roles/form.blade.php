
{{-- Form Content --}}
<div class="grid grid-cols-6 gap-4">

	<div class="col-span-3">
		<p class="font-semibold">Name</p><br>
        
        {!! Form::text('name',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-yellow-300 focus:ring-yellow-600 focus:border-transparent rounded-md w-full','autocomplete'=>'off', 'minlength' => '1', 'maxlength' => '191', 'placeholder' => 'Enter name here...', ]) !!}
        {!! $errors->first('name', '<p class="text-red-500 my-2 text-xs font-semibold":message</p>') !!}
	</div>

    <div class="col-span-3">
		<p class="font-semibold">Description</p><br>
        
        {!! Form::text('description',null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-yellow-300 focus:ring-yellow-600 focus:border-transparent rounded-md w-full','autocomplete'=>'off', 'minlength' => '1', 'maxlength' => '191', 'placeholder' => 'Enter name here...', ]) !!}
        {!! $errors->first('description', '<p class="text-red-500 my-2 text-xs font-semibold">:message</p>') !!}
	</div>

</div>