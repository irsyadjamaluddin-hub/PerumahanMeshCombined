<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reset · MESH BN</title>

        <!-- Favicons -->
        <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
        <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

        {{-- Tailwind CSS --}}
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Alpine JS Plugin: Collapse -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

        {{-- Alpine JS Plugin: Sort --}}
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>

        {{-- Alpine JS Plugin: Mask --}}
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

        {{-- Alpine JS Plugin: Intersect --}}
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

        {{-- Alpine JS --}}
        <script defer src="{{ asset('vendor/alpinejs/alpine.min.js') }}"></script>

        {{-- Google Font Initializer --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        {{-- Google Font: Nunito --}}
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

        {{-- Google Font: Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        {{-- Google Font: Oswald --}}
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

        {{-- Google Font: Lobster --}}
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <style>
            [x-cloak] { display:none !important; }

            .poppins {
                font-family: "Poppins", sans-serif;
            }

            .oswald {
                font-family: "Oswald", sans-serif;
            }

            .zigZagPattern{
                background-color: #f9fafb;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='199' viewBox='0 0 100 199'%3E%3Cg fill='%239C92AC' fill-opacity='0.19'%3E%3Cpath d='M0 199V0h1v1.99L100 199h-1.12L1 4.22V199H0zM100 2h-.12l-1-2H100v2z'%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
            }

            .zigZagPatternDarker{
                background-color: #f9fafb;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='199' viewBox='0 0 100 199'%3E%3Cg fill='%239C92AC' fill-opacity='0.47'%3E%3Cpath d='M0 199V0h1v1.99L100 199h-1.12L1 4.22V199H0zM100 2h-.12l-1-2H100v2z'%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
            }

            .alert {
                padding: 15px;
                border: 1px solid transparent;
                border-radius: 4px;
                margin-bottom: 20px;
            }

            .alert-success {
                color: #155724;
                background-color: #d4edda;
                border-color: #c3e6cb;
            }

            .alert-danger {
                color: #721c24;
                background-color: #f8d7da;
                border-color: #f5c6cb;
            }

        </style>

    </head>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <body class="bg-gray-100 zigZagPattern relative poppins">



        {{-- Login --}}
        <div class="min-h-screen w-full flex flex-col items-center md:justify-center">

            {{-- Go Back Button and Login Section --}}
            <div>

                {{-- Go Back Button: Container --}}
                <div class="hidden md:flex items-start py-4 px-5 lg:px-0">

                    {{-- Go Back Button --}}
                    <a href="{{ url('/') }}">
                        <div class="flex items-center gap-1 font-semibold">
                            {{-- Left Arrow --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <p>Go Back</p>
                        </div>
                    </a>

                </div>

                {{-- Login Section --}}
                <div class="flex flex-col gap-10 bg-white p-10 border-2 min-h-screen md:min-h-max">

                    {{-- Logo --}}
                    <a href="/">
                        <div class="text-center flex items-center gap-4">
                            <div class="flex flex-col leading-none">
                                <p class="font-bold text-5xl bg-gradient-to-r from-indigo-700  to-indigo-500 text-transparent bg-clip-text">MESH</p>
                                <p class="pl-0.5 text-left text-[0.7rem] text-yellow-500 font-bold tracking-tighter drop-shadow-sm">MOE BRUNEI</p>
                            </div>

                            <div class="flex flex-col justify-center leading-none border-l-2 border-yellow-500 pl-4 font-semibold text-xs text-gray-600">
                                <p class="text-[10px] text-left">MOE</p>
                                <p class=" text-sm">Employees and Services</p>
                                <p class="text-[10px] text-right ">Hub</p>
                            </div>
                        </div>
                    </a>

                    {{-- Title --}}
                    <div>
                        <p class="text-xl font-semibold">Reset Password</p>
                    </div>

                    {{-- Verification Message --}}
                    @if(Session::has('verification_message'))
                        <p class="text-red-400">{{ session()->get('verification_message') }}</p>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('resetpassword.resetpassword.sendlink') }}" method="POST" class="flex flex-col gap-5" autocomplete="off">

                        @csrf

                        {{-- IC No --}}
                        <div class="flex items-center rounded-md border-2 border-gray-200 overflow-hidden" x-data>

                            {{-- IC Icon --}}
                            <div class="pl-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                </svg>
                            </div>

                            <input type="text"
                            class="w-full px-3 py-3 placeholder:text-gray-400 focus:outline-none placeholder:capitalize"
                            x-mask="99999999"
                            name="ic_no" value="{{ old('ic_no') }}" placeholder="IC No." required autocomplete="off">

                            {{-- Display error for IC No --}}
                                @error('ic_no')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror

                        </div>

                        {{-- Emel --}}
                        <div class="flex items-center rounded-md border-2 border-gray-200 overflow-hidden" x-data>

                            {{-- Emel --}}
                            <div class="pl-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0a2.25 2.25 0 0 0-2.25-2.25H4.5a2.25 2.25 0 0 0-2.25 2.25m19.5 0L12 13.5 2.25 6.75" />
                                </svg>
                            </div>

                            <input type="text"class="w-full px-3 py-3 placeholder:text-gray-400 focus:outline-none" name="email" value="{{ old('emel') }}" placeholder="@moe.gov.bn/edu.moe.bn" required autocomplete="off">

                            {{-- Display error for Email --}}
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

        
                        <style>
                            @keyframes slow-spin {
                                0% { transform: rotate(0deg); }
                                100% { transform: rotate(360deg); }
                            }
                            .animate-slow-spin {
                                animation: slow-spin 10s linear infinite; /* Adjust the duration here */
                            }
                        </style>

                        {{-- Submit Button --}}
                        <!-- <button type="submit" class="relative mt-5 bg-gradient-to-br from-indigo-700 to-indigo-500 text-white text-center py-4 px-10 rounded-md flex items-center justify-center overflow-hidden"> -->
                        <button type="submit" class="relative mt-5 bg-indigo-700 hover:bg-indigo-600 duration-500 text-white text-center py-4 px-10 rounded-md flex items-center justify-center overflow-hidden">
                            
                            <p class="">Reset Account</p>

                            {{-- Spinny Boi --}}
                            <div class="absolute z-10 flex items-center justify-center animate-slow-spin self-center duration-1000">
                                <div class="absolute left-0  rounded-full p-20 bg-white/10"></div>
                                <div class="absolute right-0 rounded-full p-20 bg-white/10"></div>
                                <div class="absolute top-0 left-0 rounded-full p-20 bg-white/5"></div>
                                <div class="absolute bottom-0 right-0 rounded-full p-20 bg-white/5"></div>
                            </div>
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>
