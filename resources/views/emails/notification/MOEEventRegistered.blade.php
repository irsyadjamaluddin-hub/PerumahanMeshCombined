@extends('emails.notification.layouts.Mailcss')

@section('content')

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <a href="https://mesh.moe.gov.bn">
                    <img src="{{ asset('img/newmoelogo.png') }}" class="d-block" style="height:200px" alt="img">
                </a>
            </td>
        </tr>
    </table>

    <br><br>
    <b style="font-size: 18.5px; color:#232425; text-align: center;"> MOE Event-Registration Application</b>
    <br><br>

    <p style="color:#2b2a2a;">Yang Mulia Pengiran / Tuan / Puan, </p>
    <p style="color:#2b2a2a; text-align: center;"><b>{{ $notf_Nama}}</b></p>
    <p style="color:#2b2a2a; text-align: center;"><b>{{ $notf_jabatan}}</b></p>



    <p style="color:#2b2a2a;"> Your regirstration has been successfully received for the following program: </p>

    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Program / Acara: <b>{{ $notf_EventLabel }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Venue: <b>{{ $notf_EventVenue }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Date: <b>{{ $notf_EventDate }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Time: <b>{{ $notf_EventTime }}</b></p>

    <br>
    <p style="color:#2b2a2a;"> This email is for registration notification only. Please wait for another email to inform your application status</p>

    
    <br>
    <p style="color:#2b2a2a; margin-bottom: 0px;">Mesh: <a href="https://mesh.moe.gov.bn">https://mesh.moe.gov.bn</a></p>
    <br>
   
    <b style="color:#232425;"><i>Ministry of Education, Brunei Darussalam</i></b>

@endsection
