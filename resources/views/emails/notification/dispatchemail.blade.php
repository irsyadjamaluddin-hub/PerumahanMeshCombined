@extends('emails.notification.layouts.Mailcss')

@section('content')

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #edf2f7; border-radius: 4px;">
        <tr>
            <td align="center">
                <a href="http://127.0.0.1:8000">
                    <img src="{{ asset('img/newmoelogo.png') }}" class="d-block" style="height:200px" alt="img">
                </a>
            </td>
        </tr>
    </table>

    <br><br>
    <b style="font-size: 18.5px; color:#232425; text-align: center;">{{ $notf_services }}</b>
    <br><br>

    <p style="color:#2b2a2a;">Yang Mulia Pengiran / Tuan / Puan, </p>
    <p style="color:#2b2a2a;">Dengan hormat bersukacita tindakan bersesuaian bagi perkara seperti berikut:- </p>

    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Daripada: <b>{{ $notf_jabatan }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Perkara: {{ $notf_perkara }}</p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Tindakan: <b>{{ $notf_kod }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">No. Rujukan: <span style="text-decoration: underline;">{{ $notf_norujukan }}</span></p>
    <p style="color:#2b2a2a; margin-bottom: 0px;">Catatan: {{ $notf_catt }}</p>
    <br>
    <p style="color:#2b2a2a; margin-bottom: 0px;">Mesh: <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a></p>
    <br>
    <p style="color:#2b2a2a; margin-bottom: 0px;">Sekian Disampaikan</p>
    <br>

    <p style="color:#232425; margin-bottom: 0px;">Salam hormat,</p>
    <b style="color:#232425;"><i>Ministry of Education, Brunei Darussalam</i></b>

@endsection
