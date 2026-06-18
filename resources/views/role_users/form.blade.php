
{{-- Form Content --}}


    <div class="row">
        <div class="col-lg-4 col-md-3  label">Role</div>
        <div class="col-lg-8 col-md-9">
            {!! Form::select('role_id', $roles, null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select role',  ]) !!}
            {!! $errors->first('role_id', '<p class="text-red-500 my-2 text-xs font-semibold":message</p>') !!}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-3  label">User (Name)</div>
        <div class="col-lg-8 col-md-9">
            {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'placeholder' => 'Select user', ]) !!}
            {!! $errors->first('user_id', '<p class="text-red-500 my-2 text-xs font-semibold">:message</p>') !!}
        </div>
    </div>

    {{-- @if(count($users) == 0)

    @foreach($users as $user) --}}
    <div class="row">
        <div class="col-lg-4 col-md-3  label">User (Email)</div>
        <div class="col-lg-8 col-md-9">
            {!! Form::text('email', $usersEmail,  ['class' => 'form-control',]) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>

        {{-- @endforeach

    @endif --}}




    {{-- value="{{Auth::user()->ic_no}} --}}