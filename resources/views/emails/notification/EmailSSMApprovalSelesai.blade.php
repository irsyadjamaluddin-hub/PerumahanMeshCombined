@extends('emails.notification.layouts.Mailcss')

@section('content')

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <a href="http://127.0.0.1:8000">
                    <img src="{{ asset('img/newmoelogo.png') }}" class="d-block" style="height:200px" alt="img">
                </a>
            </td>
        </tr>
    </table>

    <br><br>
    <b style="font-size: 18.5px; color:#232425; text-align: center;">Permohonan Pembetulan Approver SSM</b>
    <br><br>

    <p style="color:#2b2a2a;"><b>{{ $notf_Nama }}</b>, sukacita dimaklumkan bahawa permohonan pertukaran approver rujukan <b>AP{{ $notf_latestID }}</b>
    telah selesai diambil tindakan. Untuk sebarang maklumat lanjut sila hubungi atau whatsapp ke talian 2383098.</p>

    <br>
    <b style="color:#232425;"><i>Mesej ini dihantar menggunakan sistem. sebarang balasan mesej tidak akan diterima</i></b>
    <br><br>

@endsection
