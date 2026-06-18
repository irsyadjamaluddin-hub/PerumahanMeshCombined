<!-- Shared Folder View -->
<div class="tab-pane fade show active" id="sharedFolders" role="tabpanel" aria-labelledby="sharedFolders-tab">
    <div class="col-md-12" style="padding: 0px;">
        <div class="card recent-sales">
            <div class="card-body overflow-auto">
                <div class="profile-overview pt-3">
                    <table class="table table-borderless datatable mt-3">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Shared Folders</h5><hr>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Folder Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($sharedFolders->isEmpty())
                                <tr class="text-center">
                                    <td colspan="4">
                                        <h5>No shared folders found</h5>
                                    </td>
                                </tr>
                            @else
                                @foreach($sharedFolders as $folder)
                                    <tr>
                                        <td>{{ $folder->id }}</td>
                                        <td>{{ $folder->folder }}</td>
                                        <td>{{ $folder->created_at }}</td>
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                            <!----Edit Button----->
                                                <form method="get" action="{{ route('fsm.fsm.editfsm', $folder->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>

                                                <style>
                                                    .btn-outline-blue {
                                                        color: #007bff;
                                                        border-color: #007bff;
                                                    }

                                                    .btn-outline-blue:hover {
                                                        background-color: #007bff;
                                                        color: #fff; /* Change text color to white when hovering */
                                                    }
                                                </style>

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
