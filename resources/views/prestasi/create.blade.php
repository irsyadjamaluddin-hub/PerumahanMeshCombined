@extends('layouts.app-all')

@section('title', 'Create Prestasi')

@section('content')

<?php
$pagename = "Prestasi";
?>

@if (count($errors) > 0)
          <div class="alert alert-danger">
            Upload Validation Error<br><br>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
 @endif

 <style>
    .hidden-div {
        display: none;
    }
</style>

<section class="section profile">

  <a href="{{ route('prestasi.prestasi.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

          <form class="" method="post" action="{{ route('prestasi.prestasi.store') }}" enctype="multipart/form-data"   id="file_form">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Prestasi</h5>


<br>
<i style="color:red;">*Dipohonkan kerjasama Pengiran / Tuan / Puan untuk menghadapkan <strong> pengumpulan keseluruhan markah</strong>  prestasi 2023 pegawai dan kakitangan dari Jabatan / Sekolah masing-masing dalam bentuk PDF. <strong> seorang wakil Jabatan / Sekolah sahaja </strong> yang diperlukan untuk menghadapkan markah prestasi melalui borang MESH ini.</i>
<br>
<br>


                @foreach($biodatas as $biodata)

                 <div class="row hidden-div">
                    <div class="col-lg-4 label">Nama</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control" name="nama" value="{{$biodata->name}}" readonly>
                    </div>
                </div>

               <div class="row hidden-div">
                    <div class="col-lg-4 label">No. Kad Pengenalan</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control" name="ic_no" value="{{$biodata->ic_no}}" readonly>
                    </div>
                </div>

                @endforeach


                @foreach ($contacts as $contact)

                 <div class="row hidden-div">
                    <div class="col-lg-4 label">No. Tel</div>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="telephone_mobile" value="{{$contact->telephone_mobile}}">
                    </div>
                </div>

                @endforeach
          
              <div class="row">
                <label class="col-lg-4 label">Jabatan</label>
                <div class="col-lg-8">
                @foreach($employments as $employment)
                <input type="text" class="bg-gray-200 form-control" name="jabatan" value="{{ optional($employment->department)->label }}" readonly>
                <input type="hidden" name="jabatan" class="bg-gray-200 form-control" value="{{ $employment->department_id }}" hidden>
                @endforeach
                </div>
              </div>

            <!--   <div class="row">
                <label for="inputText" class="col-lg-4 label">Perkara</label>
                <div class="col-lg-8">
                  <input type="text" name="perkara" class="form-control" required>
                </div>
              </div> -->

              <div class="row">
				  <label for="perkara" class="col-lg-4 label">Perkara</label>
				  <div class="col-lg-8">
				    <select id="perkara" name="perkara" class="form-control" required>
				      <option value="">Sila Pilih</option>
				      <option value="Prestasi Tahun 2023 (Oktober 2022 - September 2023)">Prestasi Tahun 2023 (Oktober 2022 - September 2023)</option>
				    </select>
				  </div>
				</div>




              <div class="row">
                  <div class="col-lg-4 label">Muat Naik Dokumen<br><i style="color:red;">*Saiz maksimum bagi setiap fail: 2MB dalam pdf format sahaja</i></div>
                  <div class="col-lg-8">
                      <div class="row" id="file-input-container">
                          <div class="col-lg-4">
                              <input class="form-control pdf-file-input" type="file" name="file[]" required>
                          </div>
                          <div class="col-lg-4">
                              <button type="button" class="btn btn-primary add-file-input">Add</button>
                          </div>
                      </div>
                      @error('file')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>
              </div>

  


             <div class="row">
                <label for="inputText" class="col-lg-4 label">Catatan</label>
                <div class="col-lg-8">
                  <textarea class="form-control" name="catatan" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;"></textarea>
                </div>
              </div>


               <P> <b> DISCLAIMER</b></P>


            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>

                <label class="form-check-label" for="acceptTerms">Saya mengakui bahawa maklumat dan keputusan yang dihadapkan adalah sahih dan betul.</label>
                <div class="invalid-feedback">You must agree before submitting.</div>
              </div>
            </div>
              
              
             

<br>

            <div class="text-center">
              <button id ="submit-button" type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>

    </div>
    </div>
    </div>

    <script>

           var submitButton = document.getElementById('submit-button');
            var form = document.getElementById('file_form');
            
           

            var form = document.getElementById('pdf_form');
    $(document).ready(function () {
        // Add new file input field when the "Add" button is clicked
        $(document).on("click", ".add-file-input", function () {
            var fileInputContainer = $(this).closest("#file-input-container");
            var clonedFileInput = fileInputContainer.find(".pdf-file-input").first().clone();
            var removeButton = "<button type='button' class='btn btn-primary remove-file-input'>Remove</button>";
            var newRow = $("<div class='row mb-3'><div class='col-lg-4'>" + clonedFileInput[0].outerHTML + "</div><div class='col-lg-4'>" + removeButton + "</div></div>");
            newRow.appendTo(fileInputContainer);
        });

        // Remove file input field when the "Remove" button is clicked
        $(document).on("click", ".remove-file-input", function () {
            $(this).closest(".row.mb-3").remove();
        });

        // Validate PDF files before form submission
        $('#file_form').on('submit', function (event) {
            var pdfFileInputs = $('.pdf-file-input');

            for (var i = 0; i < pdfFileInputs.length; i++) {
                var input = pdfFileInputs[i];
                if (!input.files.length) {
                    event.preventDefault();
                    alert('Please select a PDF file.');
                    return; // Prevent further checks if one input is empty
                }

                var file = input.files[0];
                if (file.type !== 'application/pdf') {
                    event.preventDefault();
                    alert('Please select a valid PDF file.');
                    return; // Prevent further checks if one input is not a PDF
                }
            }
        });
    });
</script>




  
</section>
@endsection