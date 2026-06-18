@extends('layouts.app-all')

@section('title', 'Create')

@section('content')

<?php
$pagename = "MSC";
?>

<div class="pagetitle">

    <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Add Suspended Company</h5>

                        <form class="" method="post" action="{{ route('msc.store') }}" id="msc_form" enctype="multipart/form-data">
                            @csrf

                            <!-- Add Button -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                                    Add Data
                                </button>
                            </div>

                            <br>

                            <div style="padding: 0 24px 0 24px;">
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Company Name</div>
                                    <div class="col-md-9"><input type="text" name="nama_syarikat[]" class="form-control" required></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Ministry</div>
                                    <div class="col-md-9"><input type="text" name="kementerian[]" class="form-control" required></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Bil.Reference</div>
                                    <div class="col-md-9"><input type="text" name="bil_rujukan[]" class="form-control" required></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Date Start</div>
                                    <div class="col-md-9">
                                        <input type="date" name="date_start[]" id="date_start" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Date End</div>
                                    <div class="col-md-9">
                                        <input type="date" name="date_end[]" id="date_end" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Monthly Period</div>
                                    <div class="col-md-9">
                                        <input type="number" name="tempoh_bulanan[]" id="tempoh_bulanan" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Reason of Suspension</div>
                                    <div class="col-md-9"><textarea name="sebab[]" placeholder="...." class="form-control"></textarea></div>
                                </div>

                                <br>
                                <hr>
                                <br>

                                <div class="container" style="padding: 0 0 0 0">
                                    <div id="dataContainer">
                                        <!-- Data rows will be added here -->
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Html spawn Script --}}
<script type="text/javascript">
    $(document).ready(function () {
        $('#addbtn2').off().on('click', function () {
            var html = '';

            // Create a new data entry container
            html += '<div class="data-entry mb-3">';
            
            // Add rows with formatted data
            html += `
                <div class="row mb-2">
                    <div class="col-md-3 label">Nama Syarikat</div>
                    <div class="col-md-9"><input type="text" name="nama_syarikat[]" class="form-control" required></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Kementerian</div>
                    <div class="col-md-9"><input type="text" name="kementerian[]" class="form-control" required></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Bil.Rujukan</div>
                    <div class="col-md-9"><input type="text" name="bil_rujukan[]" class="form-control" required></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Date Bermula</div>
                    <div class="col-md-9">
                        <input type="date" name="date_start[]" id="date_start" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Date Berakhir</div>
                    <div class="col-md-9">
                        <input type="date" name="date_end[]" id="date_end" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Tempoh Bulanan</div>
                    <div class="col-md-9">
                        <input type="number" name="tempoh_bulanan[]" id="tempoh_bulanan" class="form-control" readonly>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Sebab</div>
                    <div class="col-md-9"><textarea name="sebab[]" placeholder="...." class="form-control"></textarea></div>
                </div>

                <div class="row">
                    <div class="col-md-12"><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" style="background-color: #f75f6e;" type="button">Remove</button></div>
                </div>

                <br>
                <hr>
                <br>
            `;

            // Close the data entry container
            html += '</div>';

            $('#dataContainer').append(html);

        });

        $(document).on('click', '.removeDeclare', function () {
            // Remove the entire parent container of the data entry
            $(this).parents('.data-entry').remove();
        });

    });
</script>

{{-- Date Script --}}
<script>
    document.addEventListener('change', function (event) {
        if (event.target.id === 'date_start') {
            // Get the selected date in 'date_start'
            const startDate = event.target.value;

            // Set the minimum date for 'date_end' based on 'date_start'
            document.getElementById('date_end').min = startDate;
        }
    }, true); // Use 'true' for event capture phase
</script>

{{-- Tempoh Bulanan Script --}}
<script>
    function updateTempohBulanan() {
        const startDate = new Date(document.getElementById('date_start').value);
        const endDate = new Date(document.getElementById('date_end').value);
        const months = (endDate.getFullYear() - startDate.getFullYear()) * 12 + (endDate.getMonth() - startDate.getMonth());
        document.getElementById('tempoh_bulanan').value = months;
    }

    // Attach the function to 'change' events on date_start and date_end
    document.getElementById('date_start').addEventListener('change', updateTempohBulanan);
    document.getElementById('date_end').addEventListener('change', updateTempohBulanan);
</script>

{{-- Date Script For Dynamically Spawned HTML --}}
<script>
    $(document).on('change', '[id^="date_start"]', function () {
    // Get the selected date in 'date_start'
    const startDate = $(this).val();

    // Set the minimum date for the corresponding 'date_end'
    const endDateInput = $(this).closest('.data-entry').find('[id^="date_end"]');
    endDateInput.attr('min', startDate);
    });
</script>

{{-- Tempoh Bulanan Script For Dynamically Spawned HTML --}}
<script>
    function updateTempohBulanan(startDateInput, endDateInput, tempohBulananInput) {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        const months = (endDate.getFullYear() - startDate.getFullYear()) * 12 + (endDate.getMonth() - startDate.getMonth());
        tempohBulananInput.value = months;
    }

    document.addEventListener('change', function (event) {
        if (event.target.id === 'date_start' || event.target.id === 'date_end') {
            const dataEntry = event.target.closest('.data-entry');
            const startDateInput = dataEntry.querySelector('#date_start');
            const endDateInput = dataEntry.querySelector('#date_end');
            const tempohBulananInput = dataEntry.querySelector('#tempoh_bulanan');
            if (startDateInput && endDateInput && tempohBulananInput) {
                updateTempohBulanan(startDateInput, endDateInput, tempohBulananInput);
            }
        }
    }, true); // Use 'true' for event capture phase
</script>

{{-- Disable button when Submitting --}}
<script>
    var submitButton = document.getElementById('submit-button');
    var form = document.getElementById('msc_form');
    
    form.addEventListener('submit', function(event) {
        if (this.getAttribute('data-submitted') !== null) {
            event.preventDefault();
        } else {
            submitButton.disabled = true;
            submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
            this.setAttribute('data-submitted', 'true');
        }
    });
</script>

<style>
    .removeDeclare:hover {
        background-color: #dc3545 !important;
    }
</style>
@endsection