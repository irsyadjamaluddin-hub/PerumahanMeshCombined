@extends('layouts.app-all')

@section('title', 'All User Profile')

@section('content')

  <?php
    $pagename = " Admin User Detail";
  ?>


		<div class="pagetitle">
			<h1> User Details</h1>
			<nav>
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item">User Details</li>
			  </ol>
			</nav>
		  </div><!-- End Page Title -->

		  <section class="section profile">

		  <div class="col-md-12">

			  @if(Session::has('success_message'))
				  <div class="alert alert-success">
					  <i class=" fas fa-fw fa-check"></i>
					  {!! session('success_message') !!}
				  </div>
			  @endif

			  <div class="row mb-2">
				  <div class="col-md-10">

				  </div>

					{{-- <div class="col-md-2">
						<a href="{{ route('profileusers.profileuser.create') }}" class= "btn btn-primary text-right">
							 Add New
						</a>
					</div> --}}

				  </div>


        <div class="row mb-2 justify-content-center">
            <div class="col-md-10">
                <!-- New Search Bar from Data Kehadiran -->
                <form method="get" action="{{ route('profileusers.profileuser.search') }}">
                    <div class="flex justify-between mb-3 rounded-lg overflow-hidden">
                        <input type="text" name="query" id="term" placeholder="Search " class="w-full px-10 focus:outline-none">
                        <button type="submit" class="p-3 bg-blue-500 hover:bg-blue-600" style="transition: 0.4s;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>



		{{-- User Table Title --}}
		<div class="col-12">
			<div class="card recent-sales">

				<div class="card-body overflow-auto">

			{{-- Table --}}
			<table class="table table-borderless mt-3">
				<thead>
					<tr >
						<th>Name</th>
						<th>IC No.</th>

						<th class="text-center">Action</th>
					</tr>

				</thead>
				<tbody>

					@if(count($users) == 0)

					{{-- @if (empty($users)) --}}



					<tr class="text-center">
						<td colspan="8"><h5>No records found!</h5></td>
					</tr>

				 @else

					@foreach($users as $user)

						<tr>

							<td>{{ $user->name }}</td>
							<td>{{ $user->ic_no }}</td>


							<td>

								<div class="flex flex-row items-center justify-center gap-2" role="group">

								<div class="btn-group gap-2" role="group" aria-label="Basic example">

									<!----Show Button----->
									<form method="get" action="{{ route('profileusers.profileuser.show', $user->ic_no) }}">
										@csrf
										  <button type="submit" class="btn btn-outline-primary">
										  <i class="bi bi-eye-fill"></i>
										  </button>
										</form>

									<!----Edit Button----->
									<form method="get" action="{{ route('profileusers.profileuser.edit', $user->ic_no ) }}">
									@csrf
									  <button type="submit" class="btn btn-outline-primary">
									  <i class="bi bi-pencil-fill"></i>
									  </button>
									</form>


									<!----Delete Button commented by EJ 14.10.24----->
									<!-- <form method="post" action="{{ route('profileusers.profileuser.destroy', $user->id ) }}">
									@csrf
									@method('delete')
									<a onclick='return confirm("Confirm to delete user?")'>
									  <button type="submit" class="btn btn-outline-danger" >
									  <i class="bi bi-trash-fill"></i>
									  </button>
									</form> -->
									
								  </div>
							</td>
						</tr>

					@endforeach

				     @endif
			   </tbody>
				</table>

		   </div>

	     </div>
	</div>

     <!-- Pagination links -->
     <div class="d-flex justify-content-center">
              {{ $users->links() }}
          </div>

	</section>

@endsection
