<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt Confirmed</title>

    {{-- Tailwind CSS --}}
    @vite('resources/css/app.css')

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Poppins Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body class="poppins">

    {{-- Background --}}
    <div class="bg-black text-white w-full h-screen relative flex items-center justify-center">

        <div class="py-5 px-10 absolute top-0 left-0">
            <div class="flex items-center gap-2 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8">
                    <path fill-rule="evenodd" d="M1.5 9.832v1.793c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875V9.832a3 3 0 00-.722-1.952l-3.285-3.832A3 3 0 0016.215 3h-8.43a3 3 0 00-2.278 1.048L2.222 7.88A3 3 0 001.5 9.832zM7.785 4.5a1.5 1.5 0 00-1.139.524L3.881 8.25h3.165a3 3 0 012.496 1.336l.164.246a1.5 1.5 0 001.248.668h2.092a1.5 1.5 0 001.248-.668l.164-.246a3 3 0 012.496-1.336h3.165l-2.765-3.226a1.5 1.5 0 00-1.139-.524h-8.43z" clip-rule="evenodd" />
                    <path d="M2.813 15c-.725 0-1.313.588-1.313 1.313V18a3 3 0 003 3h15a3 3 0 003-3v-1.688c0-.724-.588-1.312-1.313-1.312h-4.233a3 3 0 00-2.496 1.336l-.164.246a1.5 1.5 0 01-1.248.668h-2.092a1.5 1.5 0 01-1.248-.668l-.164-.246A3 3 0 007.046 15H2.812z" />
                </svg>

                <p class="font-bold text-2xl">IMS</p>
            </div>
        </div>

        <div class="py-5 px-10 absolute top-0 right-0 text-sm hidden sm:flex flex-row items-center gap-2">

            <div class="flex flex-col justify-center items-end gap-1 text-white">
                <p class="font-bold text-2xl">Department of ICT</p>
                <p class="">Ministry of Education</p>
            </div>

            <img src="{{ asset('img/panji-panji.svg') }}" class="w-16">

        </div>

        <div class="">

            {{-- Message --}}
            <div class="text-2xl text-white flex flex-col items-center justify-center gap-2 px-10">
                <p class="">{{ $title }}</p>
                <p class="">{{ $description }}</p>
            </div>

        </div>

        <div class="py-5 px-10 absolute bottom-0 text-xs flex sm:hidden items-center gap-2 mb-4">
            <img src="{{ asset('img/panji-panji.svg') }}" class="w-10">
            
            <div class="flex flex-col justify-start items-start gap-1 text-white">
                <p class="font-bold">Department of ICT</p>
                <p class="">Ministry of Education</p>
            </div>
        </div>

    </div>

</body>

</html>