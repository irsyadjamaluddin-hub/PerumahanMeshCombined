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
    <b style="font-size: 18.5px; color:#232425; text-align: center;">E-Memo</b>
    <br><br>

    <p style="color:#2b2a2a;">Yang Mulia Pengiran / Tuan / Puan, </p>
    <p style="color:#2b2a2a; text-align: center;"><b>{{ $notf_Nama}}</b></p>
    <p style="color:#2b2a2a; text-align: center;"><b>{{ $notf_jabatan}}</b></p>



    <p style="color:#2b2a2a;"> E-Memo telah direkodkan seperti maklumat berikut:-</p>

    
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Jenis: <b>{{ $notf_Jenis }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Memo Daripada: <b>{{ $notf_MemoDaripada }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Perkara: <b>{{ $notf_Perkara }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Tarikh: <b>{{ $notf_Tarikh }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Disediakan Oleh: <b>{{ $notf_Icno }}</b></p>

    <p style="margin-top:12px; color:#2b2a2a;">
    Sila log masuk ke dalam sistem <b>MESH</b> untuk membuat tindakan lanjut.
    </p>
    
    <br>
    <b style="color:#232425;"><i>Mesej ini dihantar menggunakan sistem.</i></b>
    <br><br>
   
  
    <b style="color:#232425;"><i>Kementerian Pendidikan, Brunei Darussalam</i></b>

@endsection
