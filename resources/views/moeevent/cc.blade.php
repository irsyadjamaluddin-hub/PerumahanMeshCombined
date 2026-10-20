@extends('layouts.app-all')

@section('content')

<h1>Add CC Person</h1>

<form method="POST" action="{{ route('moeevent.moeevent.storecc',$event->id) }}">

@csrf

<label>IC Number</label>

<div id="ic_list">

<input type="text" 
name="cc_ic[]" 
class="form-control"
placeholder="Enter IC Number">

</div>

<br>

<button type="button" id="add">
+
</button>


<button type="submit" class="btn btn-primary">
Save
</button>

</form>


<script>

document.getElementById('add').onclick=function(){

document.getElementById('ic_list').innerHTML +=

`
<input type="text"
name="cc_ic[]"
class="form-control mt-2"
placeholder="Enter IC Number">
`;

}

</script>


@endsection