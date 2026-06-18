@extends('emails.notification.layouts.Mailcss')

@section('content')

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <a href="https://mesh.moe.gov.bn">
                    <img src="{{ asset('img/newmoelogo.png') }}" class="logo" alt="img">
                </a>
            </td>
        </tr>
    </table>

    <br><br>
    <b style="font-size: 18.5px; color:#232425; text-align: center;"> MESH Action Required: Verify User Account Validity</b>
    <br><br>

    <p style="color:#2b2a2a;">Yang Mulia Pengiran / Tuan / Puan, </p>
    <p style="color:#2b2a2a; text-align: center;"><b>{{ $notf_NamaApprover2}}</b></p>


<br>
    <p style="color:#2b2a2a;"> We need your assistance to verify the status of a user account. {{ $notf_Nama}} {{ $notf_jabatan}}. Kindly review the account details and confirm its validity within the next 1-3 days </p>

    <br>
    <p style="color:#2b2a2a;"> Please click the link below to proceed with the verification:</p>


    <p style="color:#2b2a2a;"> https://mesh.moe.gov.bn/approververify/{{ $notf_id }}</p>


    <p style="color:#2b2a2a;">Your prompt attention to this matter is greatly appreciated.</p>


    <p style="color:#2b2a2a;"> This email is for notification only. Please do not reply to this email</p>


    <br>
    <p style="color:#2b2a2a; margin-bottom: 0px;">Mesh: <a href="https://mesh.moe.gov.bn">https://mesh.moe.gov.bn</a></p>
    <br>

    <b style="color:#232425;"><i>Ministry of Education, Brunei Darussalam</i></b>

@endsection
