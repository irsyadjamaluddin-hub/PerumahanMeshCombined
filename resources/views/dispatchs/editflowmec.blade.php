@extends('layouts.app-all')

@section('title', 'View MEC')

@section('content')

<?php
$pagename = "MEC";
?>




<section class="section profile">

    <a href="{{ route('dispatchs.dis.indextindakan') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-12">
        <div class="card pt-3">

            <div class="card-body">
                
            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Rujukan MEC</h5>
                
                <br> 
                
                    <div class="card">
                    
                        <table class="table-achiev overflow-auto">
                            <thead>
                                <tr>

                                    <th class="text-center">From</th>
                                    <th class="text-center">To</th>
                                    <th class="text-center">Tindakan</th>
                                    <th class="text-center">Catatan</th>
                                    <th class="text-center">Tarikh</th>

                                </tr>
                            </thead>

                            <tbody>
                                   @if(count($dispatchpassmecs) == 0)

                                                <tr class="text-center">
                                                    <td colspan="8">
                                                        <h5>No records found</h5>
                                                    </td>
                                                </tr>

                                                @else



                                                @foreach( $dispatchpassmecs as $dispatchpassmec )
                                                
                                               


                                                <tr class="text-center">



                                                    <!-- <td> {{$dispatchpassmec->created_by}} </td> -->

                                                    <td> {{$dispatchpassmec->kod}} </td>

                                                    <!-- <td></td> -->
                                                         @foreach ($dispatchpassmecstindakanpasss as $dispatchpassmecstindakanpass)
                                                        <td>
                                                            @if ($dispatchpassmecstindakanpass->tindakan_pass !== null)
                                                                {{ $dispatchpassmecstindakanpass->kod }}
                                                            @else
                                                                <!-- Handle the case where 'kod' is null, e.g., display a message or leave it empty -->
                                                                -
                                                            @endif
                                                        </td>
                                                    @endforeach

                                             

                                              


                                                   



                                                    <td>
                                                    @php
                                                                        $tindakan_action_passs=$dispatchpassmec->tindakan_action_pass
                                                                        ?
                                                                        json_decode($dispatchpassmec->tindakan_action_pass,
                                                                        true) : []; @endphp
                                                                        @foreach($tindakan_action_passs as
                                                                        $tindakan_action_pass)

                                                                        {{($tindakan_action_pass)}}

                                                                        @endforeach

                                                    </td>


                                                    <td>
                                                        <!-- Basic Modal -->
                                                        <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            data-bs-toggle="modal" data-bs-target="#catatan{{$dispatchpassmec->id}}">

                                                        </button>
                                                        <div class="modal fade" id="catatan{{$dispatchpassmec->id}}"  tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Catatan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <textarea class="form-control"
                                                                            style="height: 150px"
                                                                            readonly>{{$dispatchpassmec->ulasan_pass}}</textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div><!-- End Basic Modal-->
                                                    </td>


                                                    @if ($dispatchpassmec->created_at == null)
                                                    <td></td>
                                                    @else
                                                    <td>{{ date('d/m/Y', strtotime($dispatchpassmec->created_at)) }}
                                                    </td>
                                                    @endif

                                                </tr>

                                                @endforeach


                                                @endif
                                            </tbody>
                            </table>
                    </div>

                       <!-- start catatan -->
                         <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Catatan</h5>       
                         
                         <form class="" method="post" action="{{ route('dispatchs.dis.updateflowmec') }}" enctype="multipart/form-data">
  
                         @csrf 

                
                      @foreach ($dispatchpassmecs as $item)
                            <input type="text" name="id[]" class="bg-gray-200 form-control" value="{{ $item->id }}" hidden>
                        @endforeach



                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="editButton">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                         

                            </div>

                            
                                <div class="row">
                                    <div class="col-md-12">
                                       
                                        <textarea class="w-100 border-2 border-gray-300 p-2 rounded" spellcheck="false" autocomplete="off" id="catatan"  disabled>{{$dispatchpassmec->catatanmec}}</textarea>
                                    </div>
                                </div>
                            

                       
                        </div>

                        <!-- Modal for Editing Text -->
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Catatan</h5>
                                    <button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea class="w-full border-2 border-gray-300 p-2 rounded" spellcheck="false" autocomplete="off" id="editedCatatan" cols="50" name="catatanmec"></textarea>

                                    </div>
                                    <div class="modal-footer">
                                       
                                        <button type="submit" class="btn btn-primary" id="saveChanges">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                          </form>
                        <!-- end catatan -->
            </div>
            </div>
            <!-- End of Tab Rujukan MEC -->

         


         </div>
      </div>
     </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Include Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Handle the Edit button click event
    document.getElementById("editButton").addEventListener("click", function () {
        // Get the current text from the textarea
        var currentText = document.getElementById("catatan").value;

        // Set the text in the modal textarea
        document.getElementById("editedCatatan").value = currentText;

        // Show the modal
        $('#editModal').modal('show');
    });

    // Handle the Save Changes button click event
    document.getElementById("saveChanges").addEventListener("click", function () {
        // Get the edited text from the modal textarea
        var editedText = document.getElementById("editedCatatan").value;

        // Set the edited text back to the main textarea
        document.getElementById("catatan").value = editedText;

        // Close the modal
        $('#editModal').modal('hide');
    });

        // Handle the Close button click event
document.querySelector(".modal-header .close").addEventListener("click", function () {
    $('#editModal').modal('hide');
});

</script>


</section>
@endsection