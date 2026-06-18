@extends('emails.notification.layouts.Mailcss')

@section('content')

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #edf2f7; border-radius: 4px;">
        <tr>
            <td align="center">
                <a href="https://mesh.moe.gov.bn">
                    <img src="{{ asset('img/newmoelogo.png') }}" class="d-block" style="height:200px" alt="img">
                </a>
            </td>
        </tr>
    </table>

    <br><br>
    <b style="font-size: 18.5px; color:#232425; text-align: center;">{{ $notf_services }}</b>
    <br><br>

    <p style="color:#2b2a2a;">Yang Mulia Pengiran / Tuan / Puan, </p>
    <p style="color:#2b2a2a;">Dengan hormat dan sukacita, sila buat tindakan bersesuaian bagi perkara seperti berikut:- </p>

    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">No. Rujukan: <span style="text-decoration: underline;">{{ $notf_nofolio }}</span></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Daripada: <b>{{ $notf_kod }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Catatan: {{ $notf_ulasanpass }}</p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Tindakan Diperlukan: <b>{{ $notf_tindakanpass }}</b></p>
    <br>
    <p style="color:#2b2a2a; margin-bottom: 0px;">Mesh: <a href="https://mesh.moe.gov.bn">https://mesh.moe.gov.bn</a></p>
    <br>
    <p style="color:#2b2a2a; margin-bottom: 0px;">Sekian Disampaikan</p>
    <br>

    <p style="color:#232425; margin-bottom: 0px;">Salam hormat,</p>
    <b style="color:#232425;"><i>Ministry of Education, Brunei Darussalam</i></b>

@endsection
