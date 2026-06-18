<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Page Title --}}
    <title>@yield('title')</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logoIms.png') }}">

    {{-- Tailwind CSS --}}
    {{-- @vite('resources/css/app.css') --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Livewire Styles --}}
    @livewireStyles

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Poppins Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    {{-- Lobster Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    {{-- Alpine JS --}}
    <script defer src="{{ asset('js/alpine.js') }}"></script>

    {{-- Slick CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>

    {{-- Chart JS --}}
    <script src="{{ asset('js/chart.js') }}"></script>

    <style>
        [x-cloak] { display:none !important;}
    </style>

</head>
<body
class="poppins"

{{-- x-data="{ isHovering: false, closeSuccessMessage: false, openSuccessMessage: true }" --}}

{{-- Pines UI - Toast Notification --}}
x-data="{
    title: 'Default Toast Notification',
    description: '',
    type: 'default',
    position: 'top-center',
    expanded: false,
    popToast (custom){
        let html = '';
        if(typeof custom != 'undefined'){
            html = custom;
        }
        toast(this.title, { description: this.description, type: this.type, position: this.position, html: html })
    }
}"

{{-- Pines UI - Toast Notification --}}
x-init="
    window.toast = function(message, options = {}){
        let description = '';
        let type = 'default';
        let position = 'top-center';
        let html = '';
        if(typeof options.description != 'undefined') description = options.description;
        if(typeof options.type != 'undefined') type = options.type;
        if(typeof options.position != 'undefined') position = options.position;
        if(typeof options.html != 'undefined') html = options.html;

        window.dispatchEvent(new CustomEvent('toast-show', { detail : { type: type, message: message, description: description, position : position, html: html }}));
    }

    window.customToastHTML = `
        <div class='relative flex items-start justify-center p-4'>
            <img src='https://cdn.devdojo.com/images/august2023/headshot-new.jpeg' class='w-10 h-10 mr-2 rounded-full'>
            <div class='flex flex-col'>
                <p class='text-sm font-medium text-gray-800'>New Friend Request</p>
                <p class='mt-1 text-xs leading-none text-gray-800'>Friend request from John Doe.</p>
                <div class='flex mt-3'>
                    <button type='button' @click='burnToast(toast.id)' class='inline-flex items-center px-2 py-1 text-xs font-semibold text-white bg-indigo-600 rounded shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'>Accept</button>
                    <button type='button' @click='burnToast(toast.id)' class='inline-flex items-center px-2 py-1 ml-3 text-xs font-semibold text-gray-900 bg-white rounded shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50'>Decline</button>
                </div>
            </div>
        </div>
    `
"

>

    @livewire('components.toast')

    @auth

        @livewire('layouts.nav')

    @endauth

    {{-- ---------------------------------------- --}}
    {{-- Page Content --}}
    {{-- ---------------------------------------- --}}

    @auth

        <div class="px-5 md:px-20 2xl:px-56 pt-20 md:pt-40 pb-10 text-sm">
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </div>

        {{-- Footer Space --}}
        <div class="mt-20"></div>

    @else

        @isset($slot)
            {{ $slot }}
        @else
            @yield('content')
        @endisset

    @endauth

    {{-- ---------------------------------------- --}}
    {{-- Livewire Scripts --}}
    {{-- ---------------------------------------- --}}

    @livewireScripts

    {{-- ---------------------------------------- --}}
    {{-- Turbolink --}}
    {{-- ---------------------------------------- --}}

    {{-- <script type="module">
        import hotwiredTurbo from 'https://cdn.skypack.dev/@hotwired/turbo';
    </script>

    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script> --}}

    {{-- ---------------------------------------- --}}
    {{-- JQuery --}}
    {{-- ---------------------------------------- --}}

    {{-- <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> --}}
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    {{-- ---------------------------------------- --}}
    {{-- Slick JS --}}
    {{-- ---------------------------------------- --}}

    <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>

    <script>

        $('.slida').slick({
            arrows: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
        });

        $('.tabHeaders').slick({
            arrows: true,
            variableWidth: true,
            slidesToShow: 5,
            slidesToScroll: 3,
            infinite: false,
            nextArrow: $('.next_tabHeaders'),
            prevArrow: $('.prev_tabHeaders'),
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
            ]
        });

    </script>

    <script>

        $(document).ready(function(){
            // Initialize Slick JS when everything is ready
            initializeSlick();
        });

        // Function to initialize Slick JS
        $(function initializeSlick() {

            // Do not remove. This hides slider and show skeleton when slider still loading.
            $('.sliderOneSkeleton').hide();
            $('.sliderOne').show();
            $('.sliderTwo').show();

            $('.sliderOneSkeleton').slick({
                infinite: true,
            });

            $('.sliderOne').slick({
                infinite: true,
                arrows: true,
                slidesToShow: 1,
                asNavFor: '.sliderTwo',
                autoplay: true,
                autoplaySpeed: 5000,
                nextArrow: $('.next_sliderTen'),
                prevArrow: $('.prev_sliderTen'),
            });

            $('.sliderTwo').slick({
                infinite: true,
                arrows: false,
                slidesToShow: 1,
                asNavFor: '.sliderOne',
            });

            // Andang balik2 ni bui. DO NOT REMOVE.
            $('.sliderOneSkeleton').hide();
            $('.sliderOne').show();
            $('.sliderTwo').show();

            $('.sliderThree').slick({
                infinite: true,
                arrows: false,
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 9000,
                nextArrow: $('.next_sliderThree'),
                prevArrow: $('.prev_sliderThree'),
            });

            $('.sliderThree').show();
        });

    </script>

    {{-- ---------------------------------------- --}}
    {{-- Particles JS --}}
    {{-- ---------------------------------------- --}}

    {{-- <script src="{{ asset('js/particles-js/particles.js')}}"></script>

    <script>
        particlesJS.load('particles-js', 'js/particles-js/particlesjs-config.json',
        function(){
            console.log('particles.json loaded...')
        })
    </script> --}}

    {{-- ---------------------------------------- --}}
    {{-- JQuery Double Scroll - DO NOT DELETE --}}
    {{-- ---------------------------------------- --}}

    {{-- <script type="text/javascript" src="{{ asset('js/jquery.doublescroll.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.double-scroll').doubleScroll({
                resetOnWindowResize: true
            });
        });
    </script> --}}

</body>
</html>
