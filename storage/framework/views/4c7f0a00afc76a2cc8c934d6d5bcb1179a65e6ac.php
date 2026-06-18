<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login · MESH BN</title>

        <!-- Favicons -->
        <link href="<?php echo e(asset('assets/img/logo.png')); ?>" rel="icon">
        <link href="<?php echo e(asset('assets/img/logo.png')); ?>" rel="apple-touch-icon">

        
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

        <!-- Alpine JS Plugin: Collapse -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

        
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>

        
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

        
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

        
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

        
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

    <?php if(session('success')): ?>
    <div class="fixed top-0 z-10 w-full
            bg-green-100 text-green-500
            px-5 lg:px-20 py-2 text-center text-sm flex items-center justify-center">
        <?php echo e(session()->get('success')); ?>

        </div>
    <?php endif; ?>

        
        <?php if(Session::has('verification_message')): ?>

            <div class="fixed top-0 z-10 w-full
            bg-red-100 text-red-500
            px-5 lg:px-20 py-2 text-center text-sm flex items-center justify-center">

                <p><?php echo e(session()->get('verification_message')); ?></p>

            </div>

        <?php endif; ?>

        
        <div class="min-h-screen w-full flex flex-col items-center md:justify-center">

            
            <div>

                
                <div class="hidden md:flex items-start py-4 px-5 lg:px-0">

                    
                    <a href="<?php echo e(url('/')); ?>">
                        <div class="flex items-center gap-1 font-semibold">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <p>Go Back</p>
                        </div>
                    </a>

                </div>

                
                <div class="flex flex-col gap-10 bg-white p-10 border-2 min-h-screen md:min-h-max">

                    
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

                    
                    <div>
                        <p class="text-xl font-semibold">Login Form</p>
                        <p class="mt-2 text-gray-600">Welcome back! Let's get you in.</p>
                    </div>

                    
                    <?php if(Session::has('verification_message')): ?>
                        <p class="text-red-400"><?php echo e(session()->get('verification_message')); ?></p>
                    <?php endif; ?>

                    <?php if(Session::has('success')): ?>
                        <p class="text-green-400"> <?php echo e(session()->get('success')); ?></p>
                    <?php endif; ?>

                    
                    <form action="<?php echo e(route('login')); ?>" method="POST" class="flex flex-col gap-5" autocomplete="off">

                        <?php echo csrf_field(); ?>

                        
                        <div class="flex items-center rounded-md border-2 border-gray-200 overflow-hidden" x-data>

                            
                            <div class="pl-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                </svg>
                            </div>

                            <input type="text"
                            class="w-full px-3 py-3 placeholder:text-gray-400 focus:outline-none placeholder:capitalize"
                            x-mask="99999999"
                            name="ic_no" value="<?php echo e(old('ic_no')); ?>" placeholder="IC No." required autocomplete="off">

                        </div>

                        
                        <div class="flex items-center rounded-md border-2 border-gray-200" x-data="{ viewPass:false }">

                            
                            <div class="pl-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>

                            <input :type="viewPass ? 'text' : 'password'"
                            class="px-3 py-3 placeholder:text-gray-400 placeholder:capitalize  w-full focus:outline-none"
                            name="password" value="<?php echo e(old('password')); ?>" placeholder="Password" required autocomplete="off">

                            
                            <div class="h-full cursor-pointer" x-on:click="viewPass = !viewPass">
                                
                                <div class=" px-2 h-full flex items-center justify-center text-gray-300 hover:text-gray-400" :class="viewPass ? '':'hidden'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </div>

                                
                                <div class=" px-2 h-full flex items-center justify-center text-gray-300 hover:text-gray-400" :class="viewPass ? 'hidden':''">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </div>
                            </div>

                        </div>

                        
                        <div x-data="{ showModal: false }"
                        class="select-none mt-5 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-5 lg:gap-40">

                            
                            <div x-data="{ isChecked : false }" class="flex items-center gap-2" x-data="{ isChecked:false }" x-on:click="isChecked = !isChecked">

                                
                                <div class="flex items-center gap-2 border-2 border-gray-200 p-0.5 text-white rounded-md overflow-hidden"
                                :class="isChecked ? 'border-indigo-600 bg-indigo-600' : '' ">

                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3">
                                        <path fill-rule="evenodd" d="M12 3.75a6.715 6.715 0 0 0-3.722 1.118.75.75 0 1 1-.828-1.25 8.25 8.25 0 0 1 12.8 6.883c0 3.014-.574 5.897-1.62 8.543a.75.75 0 0 1-1.395-.551A21.69 21.69 0 0 0 18.75 10.5 6.75 6.75 0 0 0 12 3.75ZM6.157 5.739a.75.75 0 0 1 .21 1.04A6.715 6.715 0 0 0 5.25 10.5c0 1.613-.463 3.12-1.265 4.393a.75.75 0 0 1-1.27-.8A6.715 6.715 0 0 0 3.75 10.5c0-1.68.503-3.246 1.367-4.55a.75.75 0 0 1 1.04-.211ZM12 7.5a3 3 0 0 0-3 3c0 3.1-1.176 5.927-3.105 8.056a.75.75 0 1 1-1.112-1.008A10.459 10.459 0 0 0 7.5 10.5a4.5 4.5 0 1 1 9 0c0 .547-.022 1.09-.067 1.626a.75.75 0 0 1-1.495-.123c.041-.495.062-.996.062-1.503a3 3 0 0 0-3-3Zm0 2.25a.75.75 0 0 1 .75.75c0 3.908-1.424 7.485-3.781 10.238a.75.75 0 0 1-1.14-.975A14.19 14.19 0 0 0 11.25 10.5a.75.75 0 0 1 .75-.75Zm3.239 5.183a.75.75 0 0 1 .515.927 19.417 19.417 0 0 1-2.585 5.544.75.75 0 0 1-1.243-.84 17.915 17.915 0 0 0 2.386-5.116.75.75 0 0 1 .927-.515Z" clip-rule="evenodd" />
                                    </svg>

                                </div>

                                <p class="cursor-pointer text-gray-400">Remember me</p>

                                
                                <input type="hidden" name="remember" :value="isChecked ? 'true' : 'false'" />

                            </div>

                            
                            
                            <a href="/resetpassword" class="text-indigo-600 hover:text-indigo-500 duration-300">Forgot Password?</a>

                          

                        </div>

                        <style>
                            @keyframes  slow-spin {
                                0% { transform: rotate(0deg); }
                                100% { transform: rotate(360deg); }
                            }
                            .animate-slow-spin {
                                animation: slow-spin 10s linear infinite; /* Adjust the duration here */
                            }
                        </style>

                        
                        <!-- <button type="submit" class="relative mt-5 bg-gradient-to-br from-indigo-700 to-indigo-500 text-white text-center py-4 px-10 rounded-md flex items-center justify-center overflow-hidden"> -->
                        <button type="submit" class="relative mt-5 bg-indigo-700 hover:bg-indigo-600 duration-500 text-white text-center py-4 px-10 rounded-md flex items-center justify-center overflow-hidden">
                            
                            <p class="">Log In</p>

                            
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
<?php /**PATH S:\Mesh110626\resources\views/auth/login.blade.php ENDPATH**/ ?>