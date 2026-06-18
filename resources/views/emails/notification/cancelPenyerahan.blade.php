<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Handover Cancelled</title>

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

                <p style="margin: 0; margin-top: 1em;">The handover process for Borang Penyerahan {{ $details['bpNo'] }} has successfully been cancelled.</p>

                @isset($details['remark'])

                    <div>
                        <p style="margin: 0;">The handover process was cancelled due to the following reason:</p>

                        <p style="font-weight: 500; margin: 0; color: gray;">{{ ucfirst($details['remark']) }}</p>
                    </div>

                @endisset

            </div>

            {{-- Footer --}}
            <div style="margin-top: 3em;">

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
