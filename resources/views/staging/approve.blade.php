<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Approve User · MESH BN</title>

        <!-- Favicons -->
        <link href="assets/img/logo.png" rel="icon">
        <link href="assets/img/logo.png" rel="apple-touch-icon">

        {{-- Tailwind CSS --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Alpine JS Plugin: Collapse -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

        {{-- Alpine JS Plugin: Sort --}}
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>

        {{-- Alpine JS Plugin: Mask --}}
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

        {{-- Alpine JS Plugin: Intersect --}}
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

        {{-- Alpine JS --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
        </style>

    </head>

    <body class="bg-gray-100 zigZagPattern relative poppins">

        {{-- Default Message --}}
        <div class="bg-indigo-100 px-5 lg:px-20 py-2 text-center text-sm text-indigo-500 flex items-center justify-center gap-2">
            <p>Do you know this person?</p>
        </div>

        {{-- Success and Error Message --}}
        @if(Session::has('success_message'))

            <div class="fixed top-0 z-10 w-full bg-green-100 text-green-500 px-5 lg:px-20 py-2 text-center text-sm flex items-center justify-center">

                @if(Session::has('success_message'))
                    <p>{{ Session::get('success_message') }}</p>
                @endif

            </div>

        @elseif(!Session::has('success_message'))

            @foreach ($registerverify as $rv)

                @if($rv->approval_response == 'Accept Registration')
                    
                    <div class="fixed top-0 z-10 w-full bg-green-100 text-green-500 px-5 lg:px-20 py-2 text-center text-sm flex items-center justify-center">

                        <p>This account has already been verified. The next step is to wait for admin approval.</p>

                    </div>

                @elseif($rv->approval_response == 'Decline Registration')

                    <div class="fixed top-0 z-10 w-full bg-red-100 text-red-500 px-5 lg:px-20 py-2 text-center text-sm flex items-center justify-center">

                        <p>This account has been rejected. Please contact the admin to reconsider. </p>

                    </div>

                @endif

            @endforeach

        @endif

        {{-- Login --}}
        <div class="min-h-screen w-full flex flex-col items-center md:justify-center px-5 lg:px-20">

            @foreach ($registerverify as $rv)

                {{-- Go Back Button and Login Section --}}
                <form method="post" action="route('registerverify.registerverify.update')" enctype="multipart/form-data">

                    @csrf

                    {{-- Container: Go Back Button and MESH Logo --}}
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-center justify-between my-5 pl-5 lg:pl-0">

                        {{-- Go Back Button --}}
                        <a href="/">
                            <div class="flex items-center gap-1 font-semibold">
                                {{-- Left Arrow --}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>
                                <p>Home</p>
                            </div>
                        </a>

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

                    </div>

                    {{-- Login Section --}}
                    <div class="flex flex-col gap-10 bg-white p-5 lg:p-10 border-2">

                        {{-- Logo --}}
                        <a href="" class="hidden">
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
                        <div class="">
                            <p class="text-xl font-semibold">Verify New User</p>
                            <p class="mt-2 text-gray-600">Kindly examine this user's details and ensure you are acquainted with this individual.</p>
                        </div>

                        {{-- Form Inputs --}}
                        <div class="grid grid-cols-6 gap-6 bg-white">

                            {{-- Name --}}
                            <div class="col-span-6 lg:col-span-6 flex flex-col gap-2">
                                <p>Name</p>
                                <div class="px-5 py-3.5 rounded-md capitalize bg-gray-100 text-gray-500">
                                    <p class="whitespace-pre-wrap">{{ $rv->name }}</p>
                                </div>
                            </div>

                            {{-- IC No. --}}
                            <div class="col-span-6 lg:col-span-2 flex flex-col gap-2">
                                <p>IC No.</p>
                                <div class="px-5 py-3.5 rounded-md uppercase bg-gray-100 text-gray-500 ">
                                    <p class="whitespace-pre-wrap">{{ $rv->ic_no }}</p>
                                </div>
                            </div>

                            {{-- Email Address --}}
                            <div class="col-span-6 lg:col-span-2 flex flex-col gap-2">
                                <p>Email Address</p>
                                <div class="px-5 py-3.5 rounded-md lowercase bg-gray-100 text-gray-500 ">
                                    <p class="whitespace-pre-wrap">{{ $rv->email }}</p>
                                </div>
                            </div>

                            {{-- Phone No. --}}
                            <div class="col-span-6 lg:col-span-2 flex flex-col gap-2">
                                <p>Phone No.</p>
                                <div class="px-5 py-3.5 rounded-md uppercase bg-gray-100 text-gray-500 flex items-center gap-2">
                                    <p class="text-gray-400 whitespace-pre-wrap">+673</p>

                                    @php
                                        $number = $rv->telephone_mobile;
                                        $formattedNumber = substr($number, 0, 3) . ' ' . substr($number, 3);
                                    @endphp

                                    <p>{{ $formattedNumber }}</p>
                                </div>
                            </div>

                            {{-- Nama Unit --}}
                            <div class="col-span-6 lg:col-span-2 flex flex-col gap-2">
                                <p>Nama Unit</p>
                                <input class="px-5 py-3.5 rounded-md capitalize bg-gray-100 text-gray-500" disabled value="{{ $rv->bahagian_id }}">
                            </div>

                            {{-- Tangga Gaji --}}
                            <div class="col-span-6 lg:col-span-2 flex flex-col gap-2">
                                <p>Tangga Gaji</p>
                                @foreach($employments as $employment)
                                    <input class="px-5 py-3.5 rounded-md capitalize bg-gray-100 text-gray-500" disabled value="{{ optional($employment->division)->label }}">
                                @endforeach
                            </div>

                            {{-- Jenis Perkhidmatan --}}
                            <div class="col-span-6 lg:col-span-2 flex flex-col gap-2">
                                <p>Jenis Perkhidmatan</p>
                                @foreach($employments as $employment)
                                    <input class="px-5 py-3.5 rounded-md capitalize bg-gray-100 text-gray-500" disabled value="{{ optional($employment->employmentstatus)->label }}">
                                @endforeach
                            </div>

                            {{-- Jabatan --}}
                            <div class="col-span-6 lg:col-span-6 flex flex-col gap-2">
                                <p>Jabatan</p>

                                @foreach($employments as $employment)
                                    <input class="px-5 py-3.5 rounded-md capitalize bg-gray-100 text-gray-500" disabled value="{{ optional($employment->department)->label }}">
                                @endforeach

                            </div>

                            {{-- Line --}}
                            <div class="col-span-6 h-0.5 w-full bg-gray-100 my-5 mx-auto"></div>

                            {{-- Second Section --}}
                            <div class="col-span-6 mb-5">
                                <p class="text-lg font-semibold leading-none">Verifier Details</p>
                                {{-- <p class="mt-5 text-sm text-gray-500">Note: You cannot access the system until an existing user verifies your identity.</p> --}}
                            </div>

                            {{-- Name --}}
                            <div class="col-span-6 lg:col-span-2 flex flex-col gap-2">
                                <p>Name</p>
                                <input class="px-5 py-3.5 rounded-md capitalize bg-gray-100 text-gray-500" disabled value="{{ $rv->ap1_name }}">
                            </div>

                            {{-- Email Address --}}
                            <div class="col-span-6 lg:col-span-2 flex flex-col gap-2">
                                <p>Email Address</p>
                                <input class="px-5 py-3.5 rounded-md lowercase bg-gray-100 text-gray-500" disabled value="{{ $rv->ap1_email }}">
                            </div>

                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="col-span-4 mb-10 flex items-center justify-end w-full gap-6 pt-8 px-5 xl:px-0">
                        
                        <input type="hidden" name="id" value="{{ $rv->id }}" />
                        <input type="hidden" id="approval_response" name="approval_response" value="{{ old('approval_response', $rv->approval_response) }}">

                        <style>
                            @keyframes slow-spin {
                                0% { transform: rotate(360deg); }
                                100% { transform: rotate(0deg); }
                            }

                            .animate-slow-spin {
                                animation: slow-spin 10s linear infinite; /* Adjust the duration here */
                            }

                            .animate-slow-spin-reject {
                                animation: slow-spin 10s linear infinite reverse; /* Adjust the duration here */
                            }
                        </style>

                        @if(empty($rv->approval_response))

                            {{-- Accept Button --}}
                            <div class="flex justify-end uppercase overflow-hidden">
                                <button type="submit" onclick="setApprovalResponse('Accept Registration')"
                                class="group relative px-9 py-3.5 bg-indigo-700 hover:bg-indigo-500 border border-indigo-400 rounded-tr-xl
                                rounded-bl-xl rounded-br-xl text-white flex items-center gap-2 justify-center duration-500 cursor-pointer">

                                    <p>Accept</p>

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                    </svg>

                                    {{-- Spinny Boi --}}
                                    <div class="absolute z-10 flex items-center justify-center animate-slow-spin self-center duration-1000">
                                        <div class="absolute left-0  rounded-full p-8 bg-white/10"></div>
                                        <div class="absolute right-0 rounded-full p-8 bg-white/10"></div>
                                        <div class="absolute top-5 left-0 rounded-full p-8 bg-white/5"></div>
                                        <div class="absolute bottom-5 right-0 rounded-full p-8 bg-white/5"></div>
                                    </div>

                                </button>
                            </div>

                            {{-- Reject Button --}}
                            <div class="relative flex justify-end uppercase">

                                <button type="submit" onclick="setApprovalResponse('Decline Registration')"
                                class="group relative px-9 py-3.5 bg-red-700 hover:bg-red-500 border border-red-400 rounded-tr-xl
                                rounded-bl-xl rounded-br-xl text-white flex items-center gap-2 justify-center duration-500 cursor-pointer overflow-hidden">

                                    <p>Reject</p>

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>

                                    {{-- <div class="scale-50 group-hover:scale-110 duration-300 absolute -z-10 bg-indigo-100 blur-xl p-10 rounded-full"></div> --}}

                                    {{-- Spinny Boi --}}
                                    <div class="absolute z-10 flex items-center justify-center animate-slow-spin-reject self-center duration-1000">
                                        <div class="absolute left-0  rounded-full p-8 bg-white/10"></div>
                                        <div class="absolute right-0 rounded-full p-8 bg-white/10"></div>
                                        <div class="absolute top-5 left-0 rounded-full p-8 bg-white/5"></div>
                                        <div class="absolute bottom-5 right-0 rounded-full p-8 bg-white/5"></div>
                                    </div>

                                </button>
                            </div>

                        @endif

                        <script>
                            function setApprovalResponse(value) {
                                document.getElementById('approval_response').value = value;
                            }
                        </script>

                    </div>

                </form>

            @endforeach

        </div>

    </body>

</html>
