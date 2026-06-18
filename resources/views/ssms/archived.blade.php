@extends('layouts.app-all')

@section('title', 'Archived SSM Records')

@section('content')

<a href="{{ url()->previous() }}" class="btn btn-primary mb-3" style="width: fit-content;">
    <i class="bi bi-arrow-left"></i>
</a>
<section class="section profile">
    <div class="container mb-3"><!-- removed mt-4, added mb-3 -->
        <h3 class="mb-3">Archived SSM Records</h3>

        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by Name or IC No">


        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($ssms->isEmpty())
            <p>No archived records found.</p>
        @else
            <table class="table table-hover table-bordered" id="ssmTable">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>IC No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ssms as $ssm)
                    <tr>
                        <td>{{ $ssm->id }}</td>
                        <td>{{ $ssm->ic_no }}</td>
                        <td>{{ $ssm->name }}</td>
                        <td>{{ $ssm->status_ssm }}</td>
                        <td>{{ $ssm->created_at }}</td>
                        <td>
                            <a href="{{ route('ssms.show', $ssm->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</section>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#ssmTable tbody tr');

        rows.forEach(row => {
            let icNo = row.cells[1].textContent.toLowerCase();
            let name = row.cells[2].textContent.toLowerCase();
            if(icNo.includes(filter) || name.includes(filter)){
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
