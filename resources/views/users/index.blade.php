@extends('layouts.app-all')

@section('title', 'Admin List User')

@section('content')

  <?php
    $pagename = "User";
  ?>


		<div class="pagetitle">
			<h1>Users Create</h1>
			<nav>
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item">Users</li>
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

			  <div class="row mb-6 align-items-center">
    <div class="col-md-6">
        <div class="col-md-2">
            <a href="{{ route('users.user.create') }}" class="btn btn-primary">
                Add New
            </a>
        </div>
    </div>

	<div class="col-6 d-flex justify-content-end">
  <a href="{{ route('users.user.email.demail') }}"
     class="btn d-inline-flex align-items-center"
     aria-label="Manage Admin Emails"
     data-bs-toggle="tooltip"
     title="Manage Admin Emails"
     style="background-color: #f8f9fa; border: 1px solid #6c757d; color: #6c757d;">
    <i class="bi bi-people-fill"></i>
  </a>
</div>
    <!-- <div class="col-md-6">
        <div class="row justify-content-end">
            <div class="col-md-10">
                <form method="get" action="{{ route('users.user.search') }}">
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
    </div> -->
</div>

<div class="card mt-3">
	<div class="card-body pt-3">
		<ul class="nav nav-tabls nav-tabs-bordered">
		<li class="nav-item">
				<buttom class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#user-approval">Approval</button>
			</li>
			<li class="nav-item">
				<buttom class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#user-pending">Pending</button>
			</li>
			<li class="nav-item">
				<buttom class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#user-verified">Verified</button>
			</li>
		</ul>
		<br>
			

		{{-- User Table Title --}}
		<div class="tab-content pt-2">

		    <!-- Approval tab -->

				<!-- pending tab -->
				<div class="tab-pane fade show active user-approval" id="user-approval">
				<h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius:0px; background-color: #4682B4;">Approval</h5>
				<div class="card-body overflow-auto">
			           {{-- Table --}}
						<table class="table table-borderless datatable mt-3">
									<thead>
										<tr >
											<th>Name</th>
											<th>IC No.</th>
											<th>Department</th>
											<th>Email</th>
											<th>Verifier</th>
											<th>Verifier Status</th>
											<th>Email Verified At</th>
											<th class="text-center">Action</th>
										</tr>

									</thead>
									<tbody>

										@if(count($userdepartmentapproval) == NULL)

										<tr class="text-center">
											<td colspan="8"><h5>No records found!</h5></td>
										</tr>

									@else

										@foreach($userdepartmentapproval as $userapproval)

											<tr>

												<td>{{ $userapproval->name }}</td>
												<td>{{ $userapproval->ic_no }}</td>
												<td>{{ $userapproval ->label }}</td>
												<td>{{ $userapproval->email }}</td>
												<td>{{ $userapproval->ap1_email }}</td>
												<td>
													@if ($userapproval->approval_response == null)
													<i class="bi bi-patch-minus-fill" style="color: red;" ></i>
													
													@else
													<i class="bi bi-patch-check-fill" style="color: green;"></i>
													
													@endif

												</td>

												
												@if ($userapproval->approval_response2 == null)
													<td>  <a href="{{ route('users.user.approvemt', $userapproval->id) }}" class="btn btn-success">Approve</a>
													</td>
												@else
													<td>{{ $userapproval->email_verified_at }}</td>
												@endif

												<td>

													<div class="flex flex-row items-center justify-center gap-2" role="group">

													<div class="btn-group gap-2" role="group" aria-label="Basic example">
														<!----Edit Button----->
														<form method="get" action="{{ route('users.user.edit', $userapproval->id ) }}">
														@csrf
														<button type="submit" class="btn btn-outline-primary">
														<i class="bi bi-pencil-fill"></i>
														</button>
														</form>


														<!----Delete Button----->
														<form method="post" action="{{ route('users.user.destroy', $userapproval->id ) }}">
														@csrf
														@method('delete')
														<a onclick='return confirm("Confirm to delete data?")'>
														<button type="submit" class="btn btn-outline-danger" >
														<i class="bi bi-trash-fill"></i>
														</button>
														</form>
													</div>




												</td>
											</tr>

										@endforeach


										@endif
								</tbody>
						</table>

						<!-- <div class="d-flex justify-content-center">{{ $userdepartmentapproval->links() }}</div> -->
				</div>
			</div>



			<!-- pending tab -->
			<div class="tab-pane fade show user-pending" id="user-pending">
				<h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius:0px; background-color: #4682B4;">Pending</h5>
				<div class="card-body overflow-auto">
			           {{-- Table --}}
						<table class="table table-borderless datatable mt-3">
									<thead>
										<tr >
											<th>Name</th>
											<th>IC No.</th>
											<th>Department</th>
											<th>Email</th>
											<th>Verifier</th>
											<th>Verifier Status</th>
											<th>Email Verified At</th>
											<th class="text-center">Action</th>
										</tr>

									</thead>
									<tbody>

										@if(count($userdepartmentpending) == NULL)

										<tr class="text-center">
											<td colspan="8"><h5>No records found!</h5></td>
										</tr>

									@else

										@foreach($userdepartmentpending as $userpending)

											<tr>

												<td>{{ $userpending->name }}</td>
												<td>{{ $userpending->ic_no }}</td>
												<td>{{ $userpending ->label }}</td>
												<td>{{ $userpending->email }}</td>
												<td>{{ $userpending->ap1_email }}</td>
												<td>
													@if ($userpending->approval_response == null)
													<i class="bi bi-patch-exclamation-fill" style="color: #F7C511;" ></i>

													


													@elseif ($userpending->approval_response == 'Decline Registration')
													<div style="display:flex; align-tiems:center">
													<i class="bi bi-patch-minus-fill" style="color: red;" ></i>
														<!-- if user is rejected -->
														 <form method="get" action="{{ route('users.user.reversereject', $userpending->id) }}" style="margin-left: 10px;">
															@csrf
															<button type="submit" class="btn btn-outline-primary" >
															<i class="bi bi-arrow-clockwise"></i>
															</button>
														 </form>
													</div>
															
													
													@else
													<i class="bi bi-patch-check-fill" style="color: green;"></i>
													
													@endif

												</td>

												
												@if ($userpending->approval_response == null)
													<td>  <a href="{{ route('users.user.approve', $userpending->id) }}" class="btn btn-success">Verify</a>
													</td>
												@else
													<td>{{ $userpending->email_verified_at }}</td>
												@endif

												<td>

													<div class="flex flex-row items-center justify-center gap-2" role="group">

												

													<div class="btn-group gap-2" role="group" aria-label="Basic example">
														<!----Edit Button----->
														<form method="get" action="{{ route('users.user.edit', $userpending->id ) }}">
														@csrf
														<button type="submit" class="btn btn-outline-primary">
														<i class="bi bi-pencil-fill"></i>
														</button>
														</form>


														<!----Delete Button----->
														<form method="post" action="{{ route('users.user.destroy', $userpending->id ) }}">
														@csrf
														@method('delete')
														<a onclick='return confirm("Confirm to delete data?")'>
														<button type="submit" class="btn btn-outline-danger" >
														<i class="bi bi-trash-fill"></i>
														</button>
														</form>
													</div>




												</td>
											</tr>

										@endforeach


										@endif
								</tbody>
						</table>

						<!-- <div class="d-flex justify-content-center">{{ $userdepartmentpending->links() }}</div> -->
				</div>
			</div>

		
			 <!-- pending tab -->
			<div class="tab-pane fade show  user-verified" id="user-verified">
				<h5 class="card-title" style="text-align:center; color:white; padding:10px; border-radius:0px; background-color:#4682B4;">Verified</h5>
				<div class="card-body overflow-auto">
			           {{-- Table --}}
						<table class="table table-borderless datatable mt-3">
									<thead>
										<tr >
											<th>Name</th>
											<th>IC No.</th>
											<th>Department</th>
											<th>Email</th>
											<th>Verifier</th>
											<th>Verifier Status</th>
											<th>Email Verified At</th>
											<th class="text-center">Action</th>
										</tr>

									</thead>
									<tbody>

										@if(count($userdepartment) == NULL)



										<tr class="text-center">
											<td colspan="8"><h5>No records found!</h5></td>
										</tr>

									@else

										@foreach($userdepartment as $user)

											<tr>

												<td>{{ $user->name }}</td>
												<td>{{ $user->ic_no }}</td>
												<td>{{ $user ->label }}</td>
												<td>{{ $user->email }}</td>
												<td>{{ $user->ap1_email }}</td>

												<td>
													@if ($user->approval_response == null)
													<i class="bi bi-patch-minus-fill"></i>
													
													@else
													
													<i class="bi bi-patch-check-fill" style="color: green;"></i>
													@endif

												</td>

												@if ($user->approval_response == null)
													<td>  <a href="{{ route('users.user.approve', $user->id) }}" class="btn btn-success">Verify</a>
													</td>
												@else
													<td>{{ $user->email_verified_at }}</td>
												@endif

												<td>

													<div class="flex flex-row items-center justify-center gap-2" role="group">

													<div class="btn-group gap-2" role="group" aria-label="Basic example">
														<!----Edit Button----->
														<form method="get" action="{{ route('users.user.edit', $user->id ) }}">
														@csrf
														<button type="submit" class="btn btn-outline-primary">
														<i class="bi bi-pencil-fill"></i>
														</button>
														</form>


														<!----Delete Button----->
														<form method="post" action="{{ route('users.user.destroy', $user->id ) }}">
														@csrf
														@method('delete')
														<a onclick='return confirm("Confirm to delete data?")'>
														<button type="submit" class="btn btn-outline-danger" >
														<i class="bi bi-trash-fill"></i>
														</button>
														</form>
													</div>




												</td>
											</tr>

										@endforeach


										@endif
								</tbody>
						</table>

						<!-- <div class="d-flex justify-content-center">{{ $userdepartment->links() }}</div> -->
				</div>
			</div>
		
		</div>

	</div>

	</section>

@endsection
