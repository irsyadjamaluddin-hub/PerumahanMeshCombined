<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- Tailwind CSS --}}
    @vite('resources/css/app.css')

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Poppins Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body class="poppins">

    <style>

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .respo {
                width: 100%;
                padding: 20px;
            }
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            .respo {
                width: 70%;
                padding: 10px;
            }
        }

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            .respo {
                width: 50%;
                padding: 10px;
            }
        }

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            .respo {
                width: 50%;
                padding: 10px;
            }
        }


    </style>
    
    {{-- Email Content --}}
    <div class="bg-white mx-auto respo">
    
        {{-- Icon --}}
        <div class="text-sky-400 flex justify-center relative">
            {{-- Mail --}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.9" stroke="currentColor" class="w-32 absolute">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>

            {{-- Tick --}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-14 absolute bg-white rounded-full">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>              
        </div>

        {{-- Title and Sub-Title --}}
        <div class="text-center mt-32 text-gray-600">
            {{-- Title --}}
            <p class="text-lg font-bold">Copy of Borang Penyerahan {{ $details['bp_no'] }}</p>

            {{-- Sub Title --}}
            <p class="mt-2 text-sm">For you.</p>
        </div>

        {{-- Content --}}
        <div class="mt-10">

            <p>Please check the attached Borang Penyerahan and review its content, for your reference.</p>

        </div>

        {{-- Footer --}}
        <div class="font-thin text-center mt-10 text-gray-200">
            <p>Inventory Management System</p>
        </div>

    </div>
    
</body>
</html>



{{-- 2nd Version. Outlook too strict, wont accept images, link or button --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receiver Asset Receipt</title>

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

    {{-- Logo --}}
    {{-- <div style="
        margin: 0px;
        text-align: center;
        margin: auto;
        margin-top: 1em;
        font-weight: 600;
        font-size: 30px;
    ">
        <p>LOGO</p>
    </div> --}}

    {{-- Paper --}}
    <div style="
        /* Center */
        width: 90%; 
        /* text-align: center;  */
        margin: auto;
        padding: 3em;
        
        /* Others */
        background-color: white;
        font-size: 1em;
    ">

        {{-- Top --}}
        <div>

            {{-- Title --}}
            <div style="">

                <p style="margin: 0; font-weight: 600; font-size: 1.4em;">Hello,</p>

                <p style="margin: 0; margin-top: 1em;">Please confirm your receipt of ledger or consumable by clicking the button below:</p>
            </div>

            {{-- Button --}}
            <a href="#" style="
            
                /* Button */
                margin-top: 2em;
                background-color: #38bdf8;
                border: none;
                color: white;
                padding: 1em 2em;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
                border-radius: 10px;
                white-space: nowrap;

            ">
                Confirm Receipt 
                <span>&rarr;</span>
            </a>

            {{-- Horizontal Line --}}
            <hr style="margin-top: 2em;">

            {{-- Link --}}
            <div>
                <p style="font-weight: 600; font-size: 1.2em;">Button not working?</p>

                <p>If the button above is not working, copy the link below to a browser.</p>

                <p style="text-decoration: underline; color:#38bdf8; ">
                    http://127.0.0.1:8000/penyerahan/receiver-action/1/full?signature=803678553e4027fcf5aed900cd5c20642294a6998b5fd27d58fd00c53de5cbf6
                </p>
            </div>

            <hr style="margin-top: 2em;">

        </div>

        {{-- Bottom --}}
        <div style="
            margin-top: 3em;
            text-align: left;
        ">
            <p style="font-size: 0.8em;">POWERED BY IMS</p>

            <p style="
                font-style: italic;
                font-size: 0.8em;
                color:#374151;
            ">
                This is a computer generated email, please do not reply.</p>
        </div>

    </div>

</body>

</html>