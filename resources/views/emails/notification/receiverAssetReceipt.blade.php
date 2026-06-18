<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receiver's Asset Receipt</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
        
</head>

<body 
    style="
    /* Font */
    color: #000000; font-family: 'Poppins';

    /* All */
    /* background-color: #f0f9ff; */
    margin: 0px; 
    overflow-wrap: break-word;
">

    @php
            
        $hashedUrl = URL::signedRoute('receiverProcess', $details);

    @endphp

    <div style="
        /* Center */
        /* width: 100%;  */
        /* text-align: center;  */
        margin: auto;
        padding: 1em;
        
        /* Others */
        background-color: white;
        font-size: 1em;
    ">

        {{-- English --}}
        <div class="">

            {{-- Title --}}
            <div style="margin-bottom: 2em;">

                <p style="margin: 0; font-weight: 600; font-size: 1.4em;">Hello,</p>

                <p style="margin: 0; margin-top: 1em;">Please confirm your receipt of ledger or consumable by clicking the link below:</p>
            
            </div>
            
            {{-- Real Link --}}
            <a href="{{ $hashedUrl }}" style="text-decoration: underline; color:#38bdf8;">
                Confirm Receipt
            </a>

            {{-- Manual Link --}}
            <div>
                
                <hr style="margin-top: 3em; margin-bottom: 2em; border-top: 1px solid #e5e7eb">

                <p style="font-weight: 600; font-size: 1.2em; color:gray;">Link not working?</p>

                <p>If the link above is not working, copy the link below to a browser.</p>

                <p style="text-decoration: underline; color:#38bdf8; ">
                    {{ $hashedUrl }}
                </p>

                <hr style="margin-top: 2em; margin-bottom: 3em; border-top: 1px solid #e5e7eb">

            </div>
            
            {{-- Footer --}}
            <div>
                <p>Thank you.</p>

                <p>Kind Regards, </p>

                <div style="font-size: 14px; color: gray;">
                    <p style="font-weight: 500; margin: 0; font-size: 16px;">JTMK Staff</p>
                    <p style="margin: 0; color: gray;">Via Inventory Management System (IMS)</p>
                    <p style="margin: 0;">Department of ICT</p>
                    <p style="margin: 0;">Ministry of Education</p>
                    <p style="margin: 0;">Negara Brunei Darussalam</p>
                </div>
            </div>

        </div>

        {{-- Divider Line --}}
        <hr style="border-top: 2px dotted gray; margin: 3em 0em;">

        {{-- Malay --}}
        <div class="">

            {{-- Title --}}
            <div style="margin-bottom: 2em;">

                <p style="margin: 0; font-weight: 600; font-size: 1.4em;">Salam sejahtera,</p>

                <p style="margin: 0; margin-top: 1em;">Sila sahkan penerimaan barangan dengan mengklik pautan di bawah:</p>
            
            </div>
            
            {{-- Real Link --}}
            <a href="{{ $hashedUrl }}" style="text-decoration: underline; color:#38bdf8;">
                Sahkan Penerimaan
            </a>

            {{-- Manual Link --}}
            <div>
                
                <hr style="margin-top: 3em; margin-bottom: 2em; border-top: 1px solid #e5e7eb">

                <p style="font-weight: 600; font-size: 1.2em; color:gray;">Pautan tidak berfungsi?</p>

                <p>Jika pautan di atas tidak berfungsi, salin pautan di bawah ke dalam browser abiskita:</p>

                <p style="text-decoration: underline; color:#38bdf8; ">
                    {{ $hashedUrl }}
                </p>

                <hr style="margin-top: 2em; margin-bottom: 3em; border-top: 1px solid #e5e7eb">

            </div>
            
            {{-- Footer --}}
            <div>
                <p>Terima Kasih.</p>

                <p>Salam Hormat, </p>

                <div style="font-size: 14px; color: gray;">
                    <p style="font-weight: 500; margin: 0; font-size: 16px;">Staf JTMK</p>
                    <p style="margin: 0; color: gray;">Melalui Sistem Pengurusan Inventori (IMS)</p>
                    <p style="margin: 0;">Jabatan Teknologi Maklumat dan Komunikasi</p>
                    <p style="margin: 0;">Kementerian Pendidikan</p>
                    <p style="margin: 0;">Negara Brunei Darussalam</p>
                </div>
            </div>
            
        </div>

        {{-- Disclaimer --}}
        <div style="
            margin-top: 3em;
            text-align: left;
            color: gray;
        ">
            <hr style="border-top: 2px dashed gray;">

            <p style="font-size: 0.8em; margin: 0;">POWERED BY IMS</p>

            <p style="
                font-style: italic;
                font-size: 0.8em;
                margin: 0;
                margin-top: 0.5em;
            ">
                This is a computer generated email, please do not reply.
            </p>

            <hr style="border-top: 2px dashed gray;">

        </div>

    </div>

</body>

</html>