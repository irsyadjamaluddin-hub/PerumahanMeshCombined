@extends('layout.main-layout')
@section('body')
 <div class="row">
 	<div class="col-md-2">
 		<ul class="list-group profile-nav">
		
		  
		  <!-- <li class="list-group-item {{(request()->route()->getName()=='change_password')?'active':''}}"><a href="{{route('change_password')}}">Change Password</a></li> -->
		</ul>
 	</div>
    <div class="col-md-8">
    	@yield('profile')
    </div>
 </div>
@endsection