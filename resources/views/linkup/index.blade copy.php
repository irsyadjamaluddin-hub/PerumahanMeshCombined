@extends('layouts.app-all')

@section('title', 'Mesh Kongsi Pautan')

@section('content')

<?php
$pagename = "LinkUP";
?>

<div class="pagetitle">
    <h1>Mesh Kongsi Pautan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Laman Utama</a></li>
            <li class="breadcrumb-item active">Mesh Kongsi Pautan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="col-md-12">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}
        </div>
        @endif

        @if(Session::has('error_message'))
        <div class="alert alert-danger">
            <i class="fas fa-fw fa-exclamation-circle"></i>
            {!! session('error_message') !!}
        </div>
        @endif

        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">
                    <form method="post" action="{{ route('linkup.store') }}" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">LinkUP</h5><hr>
                        <br>

                        @foreach($biodatas as $biodata)
                            <div class="row">
                                <div class="col-lg-4 label">Nama</div>
                                <div class="col-lg-8">
                                    <input type="text" class="bg-gray-200 form-control" name="name" value="{{$biodata->name}}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 label">No. Kad Pengenalan</div>
                                <div class="col-lg-8">
                                    <input type="text" class="bg-gray-200 form-control" name="ic_no" value="{{$biodata->ic_no}}" readonly>
                                </div>
                            </div>
                        @endforeach

                            <div class="row">
                                <div class="col-lg-4 label" data-bs-toggle="tooltip" data-bs-placement="top">Dokumen</div>
                                <div class="col-lg-8">
                                    <input type="file" class="bg-gray-200 form-control" name="file" id="file" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-8">
                                    <p class="text-muted">Hanya fail sehingga 10MB saiz diterima</p>
                                </div>
                            </div>
                        <br>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Hantar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Recent Sales -->
        
        <div class="col-12" style="padding: 0px;">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">
                    <div class="profile-overview pt-3">
                        <div class="overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No. Kad Pengenalan</th>
                                        <th scope="col">Nama Fail</th>
                                        <th scope="col">Salin</th>
                                        <th scope="col">Kod Qr</th>
                                        <th scope="col">Dicipta Pada</th>
                                        <th scope="col">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($linkup) == null)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>Tiada rekod dijumpai</h5>
                                        </td>
                                    </tr>
                                    @else
                                    @foreach($linkup as $linkup)
                                    <tr>
                                        <td>{{ $linkup->name }}</td>
                                        <td>{{ $linkup->ic_no }}</td>
                                        <td>
                                            @if($linkup->file)
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('linkup.serve', ['filename' => basename($linkup->file)]) }}" target="_blank">
                                                        {{ basename($linkup->file) }}
                                                    </a>
                                                </div>
                                            @else
                                                <p>Tiada fail</p>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" onclick="copyToClipboard(this, '{{ asset(basename($linkup->file)) }}')">
                                                <i class="bi bi-link-45deg"></i> Salin Pautan
                                            </button>
                                        </td>                                           
                                        <td>
                                            @if($linkup->file)
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('linkup.serve', ['filename' => pathinfo($linkup->file, PATHINFO_FILENAME) . 'qrcode.pdf']) }}" target="_blank">PDF</a>
                                                </div>
                                            @else
                                                <p>Tiada fail</p>
                                            @endif
                                        </td>                                        
                                        <td>{{ $linkup->created_at }}</td>
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                                <!----Delete Button----->
                                                <form id="deleteForm{{$linkup->id}}" method="post" action="{{ route('linkup.destroy', $linkup->id) }}" style="margin-bottom:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="showDeleteConfirmationApproval({{ $linkup->id }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                    
                                                <!-- Add a modal for confirmation -->
                                                <div class="modal" id="deleteConfirmationModalApproval{{ $linkup->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Sahkan Pemadaman</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup" onclick="hideDeleteConfirmationApproval({{ $linkup->id }})">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Adakah anda pasti mahu memadam rekod ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $linkup->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Padam</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $linkup->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Batal</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                            
                                                <script>
                                                    function showDeleteConfirmationApproval(id) {
                                                        $('#deleteConfirmationModalApproval' + id).modal('show');
                                                    }
                            
                                                    function hideDeleteConfirmationApproval(id) {
                                                        $('#deleteConfirmationModalApproval' + id).modal('hide');
                                                    }
                            
                                                    function deleteRecordApproval(formId) {
                                                        $('#' + formId).submit();
                                                    }
                                                </script>
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
    </div><!-- End Recent Sales -->
@endsection

<script>
    function copyToClipboard(button, text) {
        var textArea = document.createElement("textarea");

        // Check if text is an absolute URL, if not, prepend the custom text
        if (!text.startsWith('http') && !text.startsWith('https')) {
            text = "https://mesh.moe.gov.bn/" + text;
        }

        textArea.value = text;

        document.body.appendChild(textArea);
        textArea.select();

        try {
            document.execCommand('copy');

            var originalButtonText = button.innerHTML;
            button.innerHTML = "Pautan Disalin!";

            setTimeout(function () {
                button.innerHTML = originalButtonText;
            }, 2000);
        } catch (err) {
            console.error('Unable to copy', err);
        }

        document.body.removeChild(textArea);
    }
</script>