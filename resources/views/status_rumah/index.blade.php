@extends('layouts.app-all')

@section('title', 'Status Rumah')

@section('content')

<?php $pagename = "Status Rumah"; ?>

<div class="section profile">

    <a href="{{ route('superadmindashboard') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    @if(Session::has('success'))
        <div class="alert alert-success">
            <i class="fas fa-fw fa-check"></i>
            {!! session('success') !!}
        </div>
    @endif

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">

                    {{-- ADD MULTIPLE STATUS RUMAH --}}
                    <div class="col profile-overview overflow-auto"
                        style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">Tambah Status Rumah</h3>

                        <form method="POST" action="{{ route('status.store') }}">
                            @csrf

                            <table class="table-achiev" id="declare">
                                <thead>
                                    <tr>
                                        <th class="text-center">Status Rumah</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>
                                            <input type="text"
                                                name="moreFields[0][status]"
                                                class="form-control"
                                                placeholder="Contoh: DIDIAMI"
                                                required>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary mt-2 mb-2 btn-sm"
                                                type="button" id="addDeclare">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <br>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>

                    </div>

                    <br>

                    {{-- LIST STATUS RUMAH --}}
                    <div class="col profile-overview overflow-auto"
                        style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">Senarai Status Rumah</h3>

                        <table class="table-achiev datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">Status Rumah</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($statuses as $status)
                                <tr class="text-center">
                                    <td>{{ $status->status }}</td>
                                    <td>
                                        <form method="POST"
                                            action="{{ route('status.destroy', $status->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Padam status ini?')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="2"><h5>No records found</h5></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- JS SAME AS SENARAI TINDAKAN --}}
<script type="text/javascript">
    let i = 0;

    $("#addDeclare").click(function () {
        ++i;
        $("#declare tbody").append(
            '<tr class="text-center">' +
                '<td>' +
                    '<input type="text" name="moreFields[' + i + '][status]" ' +
                    'class="form-control" placeholder="Status Rumah" required>' +
                '</td>' +
                '<td>' +
                    '<button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button">' +
                        '<i class="bi bi-dash"></i>' +
                    '</button>' +
                '</td>' +
            '</tr>'
        );
    });

    $(document).on("click", ".removeDeclare", function () {
        $(this).closest("tr").remove();
    });
</script>

@endsection
