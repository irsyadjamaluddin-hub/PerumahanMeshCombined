@extends('emails.notification.layouts.Mailcss')

@section('content')

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #edf2f7; border-radius: 4px;">
    <tr>
        <td align="center">
            <a href="https://http://127.0.0.1:8000">
                <img src="{{ asset('img/newmoelogo.png') }}" class="d-block" style="height:200px" alt="img">
            </a>
        </td>
    </tr>
</table>

    <br><br>
    <b style="font-size: 18.5px; color: black; text-align: center;">{{ $notf_services }}</b>

    <br><br>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        @if ($notf_image && $filename)
            <tr>
                <td align="center">
                    <img src="{{ asset('storage/announcement/' . $notf_image) }}" class="custom-image" alt="Announcement has been deleted" style="width: 100% !important; max-width: 200px; max-height: 250px; object-fit: scale-down; border-radius: 5px;">
                </td>
            </tr>
        @else
            <tr>
                <td align="center">
                    <img src="{{ asset('img/Announcement.png') }}" class="custom-image" alt="Announcement has been deleted" style="width: 100% !important; max-width: 200px; max-height: 250px; object-fit: scale-down; border-radius: 5px;">
                </td>
            </tr>
        @endif
    </table>

    <br>
    <p style="font-size: 18px; color: black; text-decoration: underline;">{{ $notf_title }}</p>
    <br>

<div style="display: flex;"> <!-- Use align-items to vertically center content -->
    <div style="margin-right: 10px;"> <!-- Add margin for spacing -->
        <p style="font-size: 14px; color: black; vertical-align: middle;">{{ $notf_date }}</p>
    </div>
    <!-- Centering the icons -->
    @php
        $icons = json_decode($notf_icon, true);
    @endphp
    @if(in_array("info", $icons))
        <div style="background-color: #4caf50; display: inline-block; width: 20px; height: 20px; border-radius: 5px; margin-right: 5px;" title="Information">
        </div>
    @endif
    @if(in_array("maintenance", $icons))
        <div style="background-color: #ff9800; display: inline-block; width: 20px; height: 20px; border-radius: 5px; margin-right: 5px;" title="Maintenance">
        </div>
    @endif
    @if(in_array("update", $icons))
        <div style="background-color: #607d8b; display: inline-block; width: 20px; height: 20px; border-radius: 5px; margin-right: 5px;" title="Update">
        </div>
    @endif
    @if(in_array("urgent", $icons))
        <div style="background-color: #f44336; display: inline-block; width: 20px; height: 20px; border-radius: 5px; margin-right: 5px;" title="Urgent">
        </div>
    @endif
</div>


    <br>
    <p style="color: black !important;">{{ $notf_content  }}</p>
    <br>

    @if (!empty($announcement->pdf_file))
        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 0; padding: 0;">
            <tr>
                <td>
                    <p  style="color: black;">Muat turun dokumen:</p>
                </td>
            </tr>
            @foreach ($announcement->pdf_file as $key => $document)
                <tr>
                    <td style="vertical-align: middle;">
                        @php
                            $filenameWithoutExtension = pathinfo($document, PATHINFO_FILENAME);
                            $nameParts = explode('_', $filenameWithoutExtension);
                            $documentName = implode(' ', array_slice($nameParts, 1));
                        @endphp 
                        <p style="font-size: 14px;">{{ $documentName }} :</p>

                    </td>
                    <td style="vertical-align: middle;">
                        <a href="{{ asset('storage/announcement/' . $document) }}" target="_blank" style="padding-left: 10px;">
                            <img src="{{ asset('img/file-earmark-arrow-down.svg') }}" class="logo" alt="img" style="width: 20px; height: 30px;">
                        </a>
                    </td>
                </tr>
                <!-- Add an empty row for spacing -->
                <tr>
                    <td colspan="2" style="height: 10px;"></td>
                </tr>
            @endforeach
        </table>
    @endif

    <p style="color: black;">Salam hormat,</p>
    <b style="color: black;"><i>Ministry of Education, Brunei Darussalam</i></b>

@endsection
