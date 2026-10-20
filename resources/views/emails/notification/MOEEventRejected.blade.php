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
    <b style="font-size: 18.5px; color:#232425; text-align: center;">MOE Event-UNSUCCESSFUL APPLICATION</b>
    <br><br>

    <p style="color:#2b2a2a;">Yang Mulia Pengiran / Tuan / Puan, </p>
    <p style="color:#2b2a2a; text-align: center;"><b>{{ $notf_Nama}}</b></p>
    <p style="color:#2b2a2a; text-align: center;"><b>{{ $notf_jabatan}}</b></p>



    <p style="color:#2b2a2a;"> Your application has been <b>rejected</b> for the following program: </p>

    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Program / Acara: <b>{{ $notf_EventLabel }}</b></p>
    <p style="font-size: 16px; color:#232425; margin-bottom: 0px;">Date: <b>{{ $notf_EventDate }}</b></p>

    <br>
    <p style="color:#2b2a2a;">You may apply for the next available slot. </p>
    <br>
   
    <b style="color:#232425;"><i>Ministry of Education, Brunei Darussalam</i></b>

@endsection
