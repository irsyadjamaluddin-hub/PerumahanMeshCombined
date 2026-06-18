@extends('layouts.app-all')

@section('title', 'Senarai Admin Push Notifikasi Emel & WhatsApp')

@section('content')

<?php
$pagename = "EMT";
?>

<div class="section profile">

    <a href="{{ route('adminsettings.adminsettingsdashboard') }}" class="btn btn-primary mb-2">
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

                        <h3 class="card-title">Senarai Admin EMT <h3>

                        <form method="post" action="{{ route('adminsettings.storeadminnotificationpush') }}" enctype="multipart/form-data">
                            @csrf

                            <table class="table-achiev" id="declare">
                                <thead>
                                    <tr>
                                        <th class="text-center">IC No</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">No Telefon</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- First row --}}
                                    <tr class="text-center">
                                        <td>
                                            <input type="text" name="moreFields[0][ic_no]"
                                                class="form-control @error('moreFields.0.ic_no') is-invalid @enderror"
                                                placeholder="IC No" required>
                                            @error('moreFields.0.ic_no')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="email" name="moreFields[0][email]"
                                                class="form-control @error('moreFields.0.email') is-invalid @enderror"
                                                placeholder="Email" required>
                                            @error('moreFields.0.email')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <select name="moreFields[0][department_id]"
                                                    class="form-control @error('moreFields.0.department_id') is-invalid @enderror"
                                                    required>
                                                <option value="">— Pilih Jabatan —</option>
                                                @foreach ($department as $id => $label)
                                                    <option value="{{ $id }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @error('moreFields.0.department_id')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="moreFields[0][no_tel]"
                                                class="form-control @error('moreFields.0.no_tel') is-invalid @enderror"
                                                placeholder="No Tel" required>
                                            @error('moreFields.0.no_tel')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </td>
                                 
                                        <td>
                                            <button class="btn btn-primary btn-sm" type="button" id="addDeclare">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>

                        {{-- Script --}}
                        <script type="text/javascript">
                            let i = 0;

                            const jabatanOptions = `
                                <option value="">— Pilih Jabatan —</option>
                                @foreach ($department as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            `;

                       

                            // Add new row
                            $("#addDeclare").click(function () {
                                ++i;

                                $("#declare tbody").append(
                                    `<tr class="text-center">
                                        <td><input type="text" name="moreFields[${i}][ic_no]" class="form-control" placeholder="IC No" required></td>
                                        <td><input type="email" name="moreFields[${i}][email]" class="form-control" placeholder="Email" required></td>
                                        <td>
                                            <select name="moreFields[${i}][department_id]" class="form-control" required>
                                                ${jabatanOptions}
                                            </select>
                                        </td>
                                        <td><input type="text" name="moreFields[${i}][no_tel]" class="form-control" placeholder="no_tel" required></td>
                                       
                                        <td>
                                            <button class="removeDeclare btn btn-danger btn-sm" type="button">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                        </td>
                                    </tr>`
                                );
                            });

                            // Remove row
                            $(document).on('click', '.removeDeclare', function () {
                                $(this).closest('tr').remove();
                            });
                        </script>


                      

                                        </tr>

                                    </tbody>
                                </table>

                                <br>

                              

                    </div>

                    </form>

                    <br>
                    <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">Senarai Tindakan</h3>

                                <table class="table-achiev datatable" id="tableprestasi1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">IC No</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">no_tel</th>
                                            <th class="text-center">Tindakan</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @if(count( $EminitAdminPushNotifs) == 0)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                        @else

                                        @foreach( $EminitAdminPushNotifs as $EminitAdminPushNotif )
                                        

                                        <tr class="text-center">

                                            <td>{{$EminitAdminPushNotif->ic_no}}</td>

                                            <td>{{$EminitAdminPushNotif->email}}</td>

                                            <td>{{ optional($EminitAdminPushNotif->department)->label ?? '—' }}</td>

                                            <td>{{$EminitAdminPushNotif->no_tel}}</td>
                                          


                                            <td>
                                                <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                    <form method="post" action="{{ route('adminsettings.destroyadminnotificationpush', $EminitAdminPushNotif->id ) }}">
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