@extends('layouts.app-all')

@section('title', 'Edit CDD Inventory')

@section('content')

<?php
$pagename = "Cddinventory";
?>

@if(session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif

<section class="section profile">

  <a href="{{ route('cddinventory.cddinventory.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

      <form class="" method="post" action="{{ route('cddinventory.cddinventory.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">BORANG PERMOHONAN BAHAN-BAHAN KURIKULUM <br>BAGI SEKOLAH-SEKOLAH KERAJAAN</h5>
              <br>

              @foreach ($inventory as $inventory)
              
          
              <div style="display: flex; align-items: center; float: left; margin-top: 10px;">
                  <label style="margin-right: 10px;">No Rujukan:</label>
                  <input type="text" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" value="{{\Carbon\Carbon::parse($inventory->created_at)->format('Y')}}/SP/BBK-{{ $inventory->id }}" readonly>
           
                
              </div>

              <div style="display: flex; align-items: center; float: right; margin-top: 10px;">
                  <label style="margin-right: 10px;">Date:</label>
                  <input type="text" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" value="{{ $inventory->created_at }}" readonly>
                
              </div>

            <br>
            <br>

              <table class="table table-bordered">
                <tbody>

                <tr>
                    <th colspan="2" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Maklumat Sekolah</th>
                    <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Maklumat Pemohon</th>
                </tr>

                

                <tr>

                    <th scope="row">Nama Sekolah</th>

                    <td><input type="text" value="{{$inventory->nama_sch}}" class="form-control" readonly></td>


                    <th scope="row">No. Kad Pengenalan Pemohon</th>
                    <td><input type="text" value="{{$inventory->ic_no}}" class="form-control" readonly></td>
                </tr>

                <tr>
                    <th scope="row">Kluster</th>
                    <td><input type="text" value="{{$inventory->kluster}}" class="form-control" readonly></td>

                    <th scope="row">Nama Pemohon</th>
                    <td><input type="text" value="{{$inventory->nama}}" class="form-control" readonly></td>

                </tr>

                <tr>
                    <th scope="row">No Tel Sekolah</th>
                    <td><input type="text" value="{{$inventory->no_tel}}" class="form-control" readonly></td>

                    <th scope="row">Emel Pemohon</th>
                    <td><input type="text" value="{{$inventory->emel}}" class="form-control" readonly></td>

                </tr>
        
                <tr>
                 <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Keterangan Guru Besar/Pengetua</th>
                </tr>

                <tr>
                    <th scope="row">Nama Guru Besar/Pengetua</th>
                    <td><input type="text" value="{{$inventory->kgp_nama}}" class="form-control" readonly></td>


                    <th scope="row">No. Kad Pengenalan</th>
                    <td><input type="text" value="{{$inventory->kgp_ic_no}}" class="form-control" readonly></td>

                 
                </tr>

                <tr>
  
                    <th scope="row">Emel Guru Besar/Pengetua</th>
                    <td><input type="text" value="{{$inventory->kgp_emel}}" class="form-control" readonly></td>


                    <th></th><td></td>
                </tr>

                <tr></tr>

                <!-- Start bahan bahan kurikulum -->
           
                <tr>
                 <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Bahan - Bahan Kurikulum</th>
                </tr>   

               </tbody>
              </table>

            <!-- Restriced the view for certain view only pengetua dont need to see this-->
      
            @unless(Auth::user()->ic_no === $inventory->kgp_ic_no)
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                @if($inventory->kgp_status == "Approve")
                <!-- no button -->
                @else
                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                  <i class="bi bi-plus-lg"></i>
                </button>
                @endif
            </div>
            @endunless
            <!-- end restriction -->

              <input type="text" name="inventory_id" class="bg-gray-200 form-control " value="{{$inventory->id}}" hidden>

                <table class="table-achiev" id="tableprestasi1">

                  <thead>
                    <tr>
                    <th class="text-center">ISBN No.</th>
                      <th class="text-center">Mata Pelajaran</th>
                      <th class="text-center">Judul Bahan</th>
                      <th class="text-center">Pengarang/Penerbit</th>
                      <th class="text-center">Kuantiti Dipohonkan</th>
                      <th class="text-center">Sebab Permohonan</th>
                      <th class="text-center">Action</th>
                      <th class="text-center" style="background-color:#018749; color: white;" > Status Permohonan</th>

                      

                      <th></th>
                    </tr>
                  </thead>


                  <tbody>
                  @if(count( $inventorybbk) == 0)
                      <tr class="text-center">
                        <td colspan="8">
                          <h5>No records found</h5>
                        </td>
                      </tr>

                    @else
                    @foreach( $inventorybbk as $inventorybbk)

                    <tr class="text-center">
                        <td>{{$inventorybbk->isbn}}</td>
                        <td>{{$inventorybbk->matapelajaran}}</td>
                        <td>{{$inventorybbk->judulbahan}}</td>
                        <td>{{$inventorybbk->pengarang_penerbit}}</td>
                        <td>{{$inventorybbk->qty_dipohonkan}}</td>
                    
                        <td>
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#SebabPermohonanModal{{ $inventorybbk->id }}">
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="SebabPermohonanModal{{ $inventorybbk->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Sebab Permohonan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ $inventorybbk->sebab_permohonan }}
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            



                             
                        <!----Edit Button----->

                      <td>
                          @if($inventory->kgp_status == "Approve")
                          <button class="btn btn-primary text-right" disabled><i class="bi bi-pencil-fill"></i></button>
                              
                          @else
                          <a href="{{ route('cddinventory.cddinventory.editcddinfo', $inventorybbk->id ) }}" class="btn btn-primary text-right"><i class="bi bi-pencil-fill"></i></a>
                              
                          @endif
                      </td>

                        <td>
                          @if($inventorybbk->cdd_status!= null)
                          <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CddStatus{{ $inventorybbk->id }}">
                              {{$inventorybbk->cdd_status}}
                          </button>
                          @endif
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="CddStatus{{ $inventorybbk->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Status Catatan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $inventorybbk->cdd_catatan }}
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                   

                      </tr>

                      @endforeach
                      @endif


                    </tbody>
                  </table>

              
  <!-- Your custom script -->
<script type="text/javascript">
   document.addEventListener("DOMContentLoaded", function () {
   

    var preloadedData = <?php echo json_encode($allBooks); ?>;

    function fetchAdditionalInfo(isbn, row) {
        var bookData = preloadedData.find(function (book) { return book.isbn === isbn; });

        if (bookData) {
            console.log('Additional Info:', bookData);
            row.querySelector('.matapelajaran').value = bookData.kategori;
            row.querySelector('.judulbahan').value = bookData.judul;
            row.querySelector('.pengarang_penerbit').value = bookData.pengarang;
        } else {
            console.error('Book data not found for ISBN:', isbn);
            alert('Error: Book data not found for ISBN ' + isbn);
        }
    }

    function addRow() {
        var tbody = document.querySelector('#tableprestasi1 tbody');
        var row = tbody.insertRow();

        row.innerHTML = `
          <td>
          <input list="isbn-options" class="form-control isbn-select" name="isbn[]" required autocomplete="isbn" autofocus style="width: 100%; height: 36px !important;">
          <datalist id="isbn-options">
              <!-- Populate with options dynamically -->
          </datalist>
      </td>
              <td><input type="text" class="form-control matapelajaran"  name="matapelajaran[]" placeholder="Matapelajaran" autofocus></td>
            <td><input type="text" class="form-control judulbahan"  name="judulbahan[]" placeholder="Judul Bahan" autofocus></td>
            <td><input type="text" class="form-control pengarang_penerbit" name="pengarang_penerbit[]" placeholder="Pengarang/Penerbit" autofocus></td>
            <td><input type="text" class="form-control"  name="qty_dipohonkan[]" placeholder="Kuantiti" autofocus></td>
            <td><input type="text" class="form-control"  name="sebab_permohonan[]" placeholder="Sebab Permohonan" autofocus></td>
            <td><button class="removeDeclare">Remove</button></td>
        `;

        // Populate datalist options
  var datalist = row.querySelector('#isbn-options');
  preloadedData.forEach(function (book) {
      var option = document.createElement('option');
      option.value = book.isbn;
      datalist.appendChild(option);
  });

        // Populate ISBN options
        var select = row.querySelector('.isbn-select');
        preloadedData.forEach(function (book) {
            var option = document.createElement('option');
            option.value = book.isbn;
            option.textContent = book.isbn;
            select.appendChild(option);
        });

        // Add event listener for select change
        select.addEventListener('change', function () {
            var selectedIsbn = select.value;
            fetchAdditionalInfo(selectedIsbn, row);
        });

      
    }

    document.getElementById('addbtn2').addEventListener('click', addRow);

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('removeDeclare')) {
            event.target.closest('tr').remove();
            console.log('Row removed successfully.');
            alert('Row removed successfully.');
        }
    });
});
</script>
              
<br>


<!-- for pengetua view only -->
<br>
<br>
@if(Auth::user()->ic_no === $inventory->kgp_ic_no)

<input type="text" name="id" class="bg-gray-200 form-control" value="{{$inventory->id}}" hidden>
<div style="display: flex; align-items: center; margin-top: 10px;">
    <label style="margin-right: 10px; font-weight: bold;">Application Status:</label>
    <input type="hidden" name="kgp_status" id="kgp_status" value="{{$inventory->kgp_status}}">
    <input type="hidden" name="kgp_amendmentreasons" id="amendments_reason" value="{{ $inventory->kgp_amendmentreasons ?? '' }}">

    <div style="flex: 1;">
        <div style="display: flex; justify-content: flex-start;">
            @if($inventory->kgp_status == null)
                <div style="padding: 0 5px;">
                    <button type="button" class="btn btn-outline-success" onclick="setStatus('Approve')">
                        Approve
                    </button>
                </div>
                <div style="padding: 0 5px;">
                    <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#amendmentsModal">
                        Need Amendments
                    </button>
                </div>
            @elseif($inventory->kgp_status == "Approve")
                <div style="padding: 0 5px;">
                    <button type="button" class="btn btn-success" onclick="setStatus('Approve')">
                        Approve
                    </button>
                </div>
                <div style="padding: 0 5px;">
                    <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#amendmentsModal">
                        Need Amendments
                    </button>
                </div>
            @elseif($inventory->kgp_status == "Need Amendments")
                <div style="padding: 0 5px;">
                    <button type="button" class="btn btn-outline-success" onclick="setStatus('Approve')">
                        Approve
                    </button>
                </div>
                <div style="padding: 0 5px;">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#amendmentsModal">
                        Need Amendments
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="amendmentsModal" tabindex="-1" role="dialog" aria-labelledby="amendmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="amendmentsModalLabel">Reason for Amendments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="amendmentsReason" class="form-control" rows="4" placeholder="Enter the reason for amendments here...">{{ $inventory->kgp_amendmentreasons ?? '' }}</textarea>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitAmendments()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitAmendments() {
        const reason = document.getElementById('amendmentsReason').value;

        // Set the hidden input value for kgp_status
        document.getElementById('kgp_status').value = 'Need Amendments';

        // Store the reason for amendments in the hidden input field
        document.getElementById('amendments_reason').value = reason;

        // Submit the form (make sure this targets the correct form)
        document.forms[0].submit();
    }
</script>




<script>
    function setStatus(status) {
        // Set the hidden input value
        document.getElementById('kgp_status').value = status;
        // Optionally, submit the form here if needed
        document.forms[0].submit();
    }
</script>


@endif

<!-- end pengetua view -->

@if($inventory->kgp_status == "Need Amendments")
<table class="table">
    <tbody>
        <tr>
          <strong>Amendment Reason:</strong>
            <td>
                <input type="text" 
                       value="{{ $inventory->kgp_amendmentreasons ?? 'No reason provided.' }}" 
                       class="form-control" 
                       readonly>
            </td>
        </tr>
    </tbody>
</table>


@endif

<br>
<br>
            
@endforeach
            <div class="text-center">
              <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            </div>

          </form>
  </div>
  </div>
  </div>

</section>
@endsection