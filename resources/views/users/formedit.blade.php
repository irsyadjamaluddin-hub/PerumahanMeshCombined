{{-- Form Content --}}



<h3 class= "card-title"> Verifier Detail</h3>
<hr>
<br>
<div class="row">
    <div class="col-lg-4 col-md-3  label">Verifier Name</div>
    <div class="col-lg-8 col-md-9">
        {!! Form::text('ap1_name',null, ['class' => 'form-control','autocomplete'=>'off', 'minlength' => '1', 'maxlength' => '191', 'placeholder' => 'Enter Name here...', ]) !!}
        {!! $errors->first('ap1_name', '<p class="text-red-500 my-2 text-xs font-semibold">:message </p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-3  label">Verifier Email</div>
    <div class="col-lg-8 col-md-9">
        {!! Form::text('ap1_email',null, ['class' => 'form-control','autocomplete'=>'off', 'minlength' => '1', 'maxlength' => '191', 'placeholder' => 'Enter email here (eg. example@moe.gov.bn)...', ]) !!}
        {!! $errors->first('ap1_email', '<p class="text-red-500 my-2 text-xs font-semibold">:message</p>') !!}
    </div>
</div>


<h3 class= "card-title"> User Detail</h3>
<hr>
<br>
<div class="row">
    <div class="col-lg-4 col-md-3  label">Name</div>
    <div class="col-lg-8 col-md-9">
        {!! Form::text('name',null, ['class' => 'form-control','autocomplete'=>'off', 'minlength' => '1', 'maxlength' => '191', 'placeholder' => 'Enter Name here...', ]) !!}
        {!! $errors->first('name', '<p class="text-red-500 my-2 text-xs font-semibold">:message </p>') !!}
    </div>
</div>



<div class="row">
    <div class="col-lg-4 col-md-3  label">IC Number</div>
    <div class="col-lg-8 col-md-9">
        {!! Form::text('ic_no',null, ['class' => 'form-control','autocomplete'=>'off', 'minlength' => '1', 'maxlength' => '191', 'placeholder' => 'Enter IC Number (eg.00123456)...', ]) !!}
        {!! $errors->first('ic_no', '<p class="text-red-500 my-2 text-xs font-semibold">:message</p>') !!}
    </div>
</div>


<!-- Include jQuery and Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@foreach ($employments as $employment)
<div class="row">
    <div class="col-lg-4 col-md-3 label">Department</div>
    <div class="col-lg-8 col-md-9">
    <select class=" form-control select2"  id="department-select" data-select2-id="department-select" name="department_id"  tabindex="-1" aria-hidden="true" >
            <option value="{{ $employment->department_id}}">{{ optional($employment->department)->label }}</option>
            @foreach ($departmentlabel as $key => $value)
                <option value="{{ $key }}">
                    {{ $value }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-3 label">Jenis Perkhidmatan</div>
    <div class="col-lg-8 col-md-9">
    <select class=" form-control select2"  id="service-select" data-select2-id="service-select" name="employment_status_id"  tabindex="-1" aria-hidden="true" >
            <option value="{{ $employment->employment_status_id}}">{{ optional($employment->employmentstatus)->label }}</option>
            @foreach ($employmentstatus as $key => $value)
                <option value="{{ $key }}">
                    {{ $value }}
                </option>
            @endforeach
        </select>

    </div>
</div>
@endforeach







<div class="row">
    <div class="col-lg-4 col-md-3  label">Email</div>
    <div class="col-lg-8 col-md-9">
        {!! Form::text('email',null, ['class' => 'form-control','autocomplete'=>'off', 'minlength' => '1', 'maxlength' => '191', 'placeholder' => 'Enter email here (eg. example@moe.gov.bn)...', ]) !!}
        {!! $errors->first('email', '<p class="text-red-500 my-2 text-xs font-semibold">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-3  label">Password</div>
    <div class="col-lg-8 col-md-9">
        <div class="input-group has-validation">
            <input id="password" type="password" class="form-control @error('password') ring-red-500 focus:ring-red-600 @enderror focus:border-transparent rounded-md w-full" name="password">
            <span class="btn btn-primary" id="inputGroupPrepend">
                <i class="bi bi-eye" id="eyeSlash" onclick="visibility3()"></i>
                <i class="bi bi-eye" id="eyeShow" style="display: none;" class="" onclick="visibility3()"></i>
            </span>
            @error('password')
            <p class="text-red-500 my-2 text-xs font-semibold" role="alert">
                <strong>{{ $message }}</strong>
            </p>
            @enderror
        </div>
    </div>
</div>


<div class="hidden">
    {!! Form::hidden('email_verified_at', null) !!}
    {!! $errors->first('email_verified_at', '<p class="help-block">:message</p>') !!}

    {!! Form::hidden('remember_token',null) !!}
    {!! $errors->first('remember_token', '<p class="help-block">:message</p>') !!}
</div>


<script>
    function visibility3() {
        var x = document.getElementById('password');
        if (x.type === 'password') {
            x.type = "text";
            $('#eyeShow').show();
            $('#eyeSlash').hide();
        } else {
            x.type = "password";
            $('#eyeShow').hide();
            $('#eyeSlash').show();
        }
    }
</script>