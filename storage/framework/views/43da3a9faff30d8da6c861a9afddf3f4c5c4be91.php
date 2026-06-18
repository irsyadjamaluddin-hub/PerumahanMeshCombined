<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MESH</title>

    <!-- Favicon -->
    <link href="<?php echo e(asset('img/panji-panji.svg.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('img/panji-panji.svg.png')); ?>" rel="apple-touch-icon">

    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>

    <div class="relative flex items-center justify-center poppins h-screen">

        <img src="<?php echo e(asset('img/moe-building-compressed.jpg')); ?>" class="absolute w-screen h-full xl:h-screen -z-30 object-cover">

        
        <div class="absolute -z-20 bg-indigo-800 w-screen h-full xl:h-screen mix-blend-color"></div>

        
        <div class="absolute -z-10 bg-gradient-to-br from-indigo-800 via-indigo-800 to-purple-50 w-screen h-full xl:h-screen mix-blend-multiply"></div>

        
        <div class="absolute text-white flex flex-col justify-between gap-10 h-full xl:h-screen p-10">

            
            <div class="flex flex-col items-center gap-4">
                <img src="<?php echo e(asset('img/panji-panji.svg.png')); ?>" class="w-20">

                <div class="flex flex-col items-center leading-none uppercase">
                    <p class="text-3xl">كمنترين ڤنديديقن</p>
                    <p class="font-bold">Ministry of Education</p>
                    <p class="mt-0.5">Brunei Darussalam</p>
                </div>

            </div>

            
            <div class="flex flex-col gap-20">

                
                <div class="flex flex-col items-center leading-none">
                    <div class="border-2 rounded-full px-2 py-0.5 text-sm self-end mr-6">
                        <p>internal</p>
                    </div>
                    <p class="font-bold text-8xl bg-gradient-to-r from-gray-50 to-gray-100 text-transparent bg-clip-text tracking-wide">MESH</p>
                    <p class="text-md text-yellow-400 font-bold drop-shadow-sm tracking-wide">MOE EMPLOYEE & SERVICES HUB</p>
                </div>

                
                <div class="flex items-center justify-center *: gap-10 uppercase font-bold">

                    <a href="<?php echo e(route('login')); ?>">
                        <div class="border-2 px-6 py-2 rounded-lg hover:bg-white hover:text-black duration-300 cursor-pointer">
                            <p>Login</p>
                        </div>
                    </a>

                    <a href="<?php echo e(route('registerform')); ?>">
                        <div class="border-2 px-6 py-2 rounded-lg hover:bg-white hover:text-black duration-300 cursor-pointer">
                            <p>Register</p>
                        </div>
                    </a>

                </div>

            </div>

            
            <div class="text-center text-sm flex flex-col gap-2">
                <p>Ministry of Education © 2021 All Rights Reserved. Powered by DevOps ICT. </p>
                <a href="/terms" class="underline">Terms & Conditions</a>
            </div>

        </div>

        
        <div id="particles-js" class="w-screen h-screen"></div>

        
        <script src="<?php echo e(asset ('js/particles.min.js')); ?>"></script>

        
        <script>
            particlesJS("particles-js", {"particles":{"number":{"value":100,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);;
        </script>
    </div>

</body>
</html>
<?php /**PATH S:\Mesh110626\resources\views/welcome.blade.php ENDPATH**/ ?>