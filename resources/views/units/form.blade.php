
{{-- Form Content --}}

<div id="" class="grid grid-cols-6 gap-4">

	<div class="col-span-1 {{ $errors->has('code') ? 'has-error' : '' }}">
		<p class="font-semibold">ID</p><br>
        
        {!! Form::text('code', $code, ['readonly', 'class' => 'p-2 border shadow focus:outline-none ring-2 ring-red-300 focus:ring-red-600 focus:border-transparent rounded-md w-full', 'required' => true, 'placeholder' => 'Enter ID',  ]) !!}
        {!! $errors->first('code', '<p class="text-red-500 my-2 text-xs font-semibold":message</p>') !!}
	</div>

    <div class="col-span-5 {{ $errors->has('label') ? 'has-error' : '' }}">
		<p class="font-semibold">Name</p><br>
        
        {!! Form::text('label', null, ['class' => 'p-2 border shadow focus:outline-none ring-2 ring-red-300 focus:ring-red-600 focus:border-transparent rounded-md w-full', 'placeholder' => 'Enter Unit Name', ]) !!}
        {!! $errors->first('label', '<p class="text-red-500 my-2 text-xs font-semibold">:message</p>') !!}
	</div>

</div>