@extends('layouts.app-all')

@section('title', 'Settings Page')

@section('content')

<?php $pagename = "Settings Page"; ?>

<div class="section profile">

    <a href="{{ route('adminsettings.adminsettingsdashboard') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class="fas fa-fw fa-check"></i>
            {!! session('success_message') !!}
        </div>
    @endif

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">Tambah Senarai Tindakan</h3>

                        <form method="post" action="{{ route('adminsettings.store2') }}" enctype="multipart/form-data">
                            @csrf

                            <table class="table-achiev" id="declare">
                                <thead>
                                    <tr>
                                        <th class="text-center">Senarai Tindakan</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>
                                            <input type="text" name="moreFields[0][label]" id="label[0]"
                                                class="form-control @error('label.0') bg-red-100 border-2 border-red-500 @enderror"
                                                value="{{ old('label.0') }}">
                                        </td>
                                        <td>
                                            <button class="btn btn-primary mt-2 mb-2 btn-sm" type="button" id="addDeclare">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <br>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>

                    </div>

                    <br>

                    <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">Senarai Tindakan</h3>

                        <table class="table-achiev datatable" id="tableprestasi2">
                            <thead>
                                <tr>
                                    <th class="text-center">Senarai Tindakan</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($Stindakanlist as $tindakanlist)
                                <tr class="text-center">
                                    <td>{{ $tindakanlist->label ?? '-' }}</td>
                                    <td>
                                    <form method="post" action="{{ route('adminsettings.destroyeditjenistindakan', $tindakanlist->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">
                                        <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center"><td colspan="6"><h5>No records found</h5></td></tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  let i = 0;
  $("#addDeclare").click(function () {
    ++i;
    $("#declare tbody").append(
      '<tr class="text-center">' +
        '<td><input type="text" name="moreFields[' + i + '][label]" class="form-control" placeholder="Jenis Tindakan" required></td>' +
        '<td><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td>' +
      '</tr>'
    );
  });
  $(document).on("click", ".removeDeclare", function () {
    $(this).closest("tr").remove();
  });
</script>

@endsection