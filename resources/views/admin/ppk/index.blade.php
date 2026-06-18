@extends('layouts.app-all')

@section('title', 'Manage PPKs')

@php
    $pagename = 'PPK Management';
@endphp

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="section profile">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">&larr; Back</a>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPpkModal">+ Add PPK</button>
    </div>

    <div class="card shadow-sm p-3 mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">List of PPKs</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>IC No</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="ppkTableBody">
                        @foreach($ppks as $ppk)
                        <tr id="ppk-row-{{ $ppk->id }}">
                            <td>{{ $ppk->name }}</td>
                            <td>{{ $ppk->email }}</td>
                            <td>{{ $ppk->ic_no }}</td>
                            <td>{{ $ppk->phone }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-ppk-btn" data-id="{{ $ppk->id }}">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add PPK Modal -->
    <div class="modal fade" id="addPpkModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addPpkForm">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add New PPK</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Success and error messages -->
                        <div id="ppk-success-message" class="alert alert-success d-none"></div>
                        <div id="ppk-form-errors" class="alert alert-danger d-none"></div>

                        <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
                        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
                        <input type="text" name="ic_no" placeholder="IC No" class="form-control mb-2" required>
                        <input type="text" name="phone" placeholder="Phone" class="form-control mb-2">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save PPK</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<style>
.card { border-radius: 0.5rem; }
.table-hover tbody tr:hover { background-color: #f8f9fa; }
.btn-success { font-weight: 500; padding: 0.4rem 1rem; }
.btn-danger { font-weight: 500; padding: 0.25rem 0.6rem; }
.modal-header { border-bottom: none; }
.modal-body input { border-radius: 0.3rem; }
.alert { border-radius: 0.3rem; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const addPpkForm = document.getElementById('addPpkForm');
    const ppkTableBody = document.getElementById('ppkTableBody');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const errorDiv = document.getElementById('ppk-form-errors');
    const successDiv = document.getElementById('ppk-success-message');

    // Add PPK
    addPpkForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(addPpkForm);

        fetch("{{ route('admin.ppk.store') }}", {
            method: 'POST',
            headers: { 
                'X-CSRF-TOKEN': csrfToken, 
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                errorDiv.classList.add('d-none');
                errorDiv.innerHTML = '';

                successDiv.textContent = 'PPK saved successfully!';
                successDiv.classList.remove('d-none');

                setTimeout(() => {
                    successDiv.classList.add('d-none');
                    addPpkForm.reset();
                }, 2000);

                const row = document.createElement('tr');
                row.id = `ppk-row-${data.ppk.id}`;
                row.innerHTML = `
                    <td>${data.ppk.name}</td>
                    <td>${data.ppk.email}</td>
                    <td>${data.ppk.ic_no}</td>
                    <td>${data.ppk.phone || ''}</td>
                    <td><button class="btn btn-danger btn-sm delete-ppk-btn" data-id="${data.ppk.id}">Remove</button></td>
                `;
                ppkTableBody.appendChild(row);
            } else if(data.errors){
                errorDiv.innerHTML = Object.values(data.errors).flat().join('<br>');
                errorDiv.classList.remove('d-none');
            } else {
                errorDiv.innerHTML = data.message || 'Failed to save PPK.';
                errorDiv.classList.remove('d-none');
            }
        })
        .catch(err => {
            console.error(err);
            errorDiv.innerHTML = 'Failed to save PPK. Please check the form.';
            errorDiv.classList.remove('d-none');
        });
    });

    // Delete PPK
    document.body.addEventListener('click', function(e){
        if(e.target.classList.contains('delete-ppk-btn')){
            const id = e.target.getAttribute('data-id');
            if(!confirm('Are you sure you want to delete this PPK?')) return;

            fetch(`{{ url('admin/ppk') }}/${id}`, {
                method: 'DELETE',
                headers: { 
                    'X-CSRF-TOKEN': csrfToken, 
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    const row = document.getElementById(`ppk-row-${id}`);
                    if(row) row.remove();
                    alert('PPK deleted successfully!');
                } else {
                    alert(data.message || 'Failed to delete PPK.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Unexpected error while deleting PPK.');
            });
        }
    });
});
</script>
@endsection
