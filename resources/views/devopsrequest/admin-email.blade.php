@extends('layouts.app-all')

@section('title', 'DevOps Admin Email')

@section('content')

<?php
$pagename = "DevOps Admin Email";
?>

<div class="section profile">

    <a href="{{ route('devops-request.indexadmin') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">

                    <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">Create List DRF Admin Email</h3>

                        <form class="" method="post" action="{{ route('devops-request.store-emails') }}" enctype="multipart/form-data">
                            @csrf

                                <table class="table-achiev" id="declare">
                                    <thead>
                                        <tr>

                                            <th class="text-center">IC No</th>
                                            <th class="text-center">Email </th>
                                            <th class="text-center">Tel No</th>
                                            <th class="text-center">Tindakan</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr class="text-center">

                                            <td>
                                                <input type="text" name="moreFields[0][ic_no]" id="ic_no[0]"
                                                    class="form-control @error('ic_no.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('ic_no.0') }}">
                                            </td>

                                            <td>
                                                <input type="text" name="moreFields[0][email]" id="email[0]"
                                                    class="form-control @error('email.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('email.0') }}">
                                            </td>

                                            <td>
                                                <input type="text" name="moreFields[0][tel_no]" id="tel_no[0]"
                                                    class="form-control @error('tel_no.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('tel_no.0') }}">
                                            </td>

                                     

                                            <td>
                                                <button class="btn btn-primary mt-2 mb-2 btn-sm" type="button" name="addDeclare" id="addDeclare">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </td>


                                            <script type="text/javascript">
                                            var i = 0;

                                            $("#addDeclare").click(function() {

                                                ++i;

                                                $("#declare").append(
                                                    '<tr class="text-center"><td><input class="form-control" type="text" placeholder= "IC No" name="moreFields[' +
                                                    i +
                                                    '][ic_no]" required></td><td><input type="text" placeholder="Email" name="moreFields[' +
                                                    i +
                                                    '][email]" class="form-control" required></td><td><input class="form-control" type="text" placeholder= "Tel No" name="moreFields[' +
                                                    i +
                                                    '][tel_no]" required></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>


                                        </tr>

                                    </tbody>
                                </table>

                                <br>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                    </div>

                    </form>

                    <br>
                    <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">List DRF Email</h3>

                                <table class="table-achiev datatable" id="tableprestasi1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">IC No</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Tel No</th>
                                            <th class="text-center">Tindakan</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @if(count( $devopsAdminEmails) == 0)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                        @else

                                        @foreach( $devopsAdminEmails as $adminEmail )

                                        <tr class="text-center">

                                            <td>{{$adminEmail->ic_no}}</td>

                                            <td>{{$adminEmail->email}}</td>

                                            <td>{{$adminEmail->tel_no}}</td>

                                        
                                            <td>
                                                <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                    <form method="post" action="{{ route('devops-request.delete-emails', $adminEmail->id) }}">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('are you sure you want to delete?')">
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

                    </div>

</div>
</div>
</div>
</div>
</div>

@endsection