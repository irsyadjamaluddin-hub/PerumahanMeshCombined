<div class="tab-pane fade profile-asses pt-3" id="profile-asses">

                <div class="overflow-auto" style="text-align: center;">
                    <table class="table-achiev datatable" id="tableprestasi">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">IC Number</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if(count($competencies1) == 0)

                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                            @else
                            @foreach($competencies1 as $competencie)

                            <tr>
                                <td>{{ $competencie->indv_name }}</td>
                                <td>{{ $competencie->indv_icno }}</td>

                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('competencies.competencie.editsupervisorcompetency', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>


                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('competencies.competencie.destroysupervisorcompetency', $competencie->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <a onclick='return confirm("Confirm to delete data?")'>
                                                <button type="submit" class="btn btn-outline-danger">
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

