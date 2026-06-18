@php 
    $pagename = "Services";
@endphp

@extends('layouts.app2')

@section('content')

    {{-- Breadcrumbs --}}
    <div class="flex flex-row items-center mb-10 px-4 py-2 text-sm bg-blue-100">
                            
        <a href="" class="ml-2 font-semibold hover:text-blue-500">Home</a>

        {{-- Right Arrow --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 mx-4 text-blue-500" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
        </svg>

        <p class="text-blue-500 font-semibold">Services</p>
        
    </div>

    <div class="m-10">

        <!-- ======= Services Section ======= -->
        <section id="services" class="services md:px-20">

            <div class="container" >
                
                <div class="grid grid-cols-6 gap-5 text-white w-full mx-auto mb-40">
                            
                    <div class="col-span-6 lg:col-span-3 group text-3xl relative">
                        <div class="bg-blue-500 hover:bg-blue-600 grid grid-cols-3 h-32 items-center border-b-4 border-gray-400 p-2 text-center group transition duration-500 rounded-xl cursor-pointer">
                            <img src="{{ asset('img/blue.svg') }}" class="col-span-1 w-32 mx-auto p-2">
                            <div class="col-span-2 text-left">
                                <div class="flex flex-row mt-2">
                                    <p>Mileage</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-4 transform group-hover:rotate-90 duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                                <p class="text-sm mt-2 text-white text-opacity-50 transform animate-pulse">Hover here to see available services</p>
                            </div>
                        </div>

                        <div class="w-full h-0 group-hover:h-40 text-black overflow-hidden text-center z-10" style="transition: 0.9s;">
                        @if (Auth::user()->hasRole('ROLE_CLAIMANT'))
                            <a href="{{route('mileages.mileage.create')}}">
                                <div class="px-4 py-2 mt-2 bg-blue-300 hover:bg-blue-400 rounded-full">
                                    <p class="text-base">Apply</p>
                                </div>
                            </a>
                            <a href="{{route('mileages.mileage.index')}}">
                                <div class="px-4 py-2 mt-2 bg-blue-300 hover:bg-blue-400 rounded-full">
                                    <p class="text-base">History</p>
                                </div>
                            </a>
                        @endif
                        @if (Auth::user()->hasRole('ROLE_HOD') || Auth::user()->hasRole('ROLE_MAW') || Auth::user()->hasRole('ROLE_DA')
							|| Auth::user()->hasRole('ROLE_ENDORSER') || Auth::user()->hasRole('ROLE_MAW_SECOND')
							|| Auth::user()->hasRole('ROLE_MAW_ENDORSER'))
                            <a href="{{route('mileages.mileage.create')}}">
                                <div class="px-4 py-2 mt-2 bg-blue-300 hover:bg-blue-400 rounded-full">
                                    <p class="text-base">Apply</p>
                                </div>
                            </a>
                            <a href="{{route('mileages.mileage.history_application')}}">
                                <div class="px-4 py-2 mt-2 bg-blue-300 hover:bg-blue-400 rounded-full">
                                    <p class="text-base">History</p>
                                </div>
                            </a>
                        @endif
                        </div>
                    </div>

                    <div class="col-span-6 lg:col-span-3 group text-3xl relative">
                        <div class="bg-red-500 hover:bg-red-600 grid grid-cols-3 h-32 items-center border-b-4 border-gray-400 p-2 text-center group transition duration-500 rounded-xl cursor-pointer">
                            <img src="{{ asset('img/red.svg') }}" class="col-span-1 w-32 mx-auto p-2">
                            <div class="col-span-2 text-left">
                                <div class="flex flex-row mt-2">
                                    <p>USDI</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-4 transform group-hover:rotate-90 duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                                <p class="text-sm mt-2 text-white text-opacity-50 transform animate-pulse">Hover here to see available services</p>
                            </div>
                        </div>

                        <div class="w-full h-0 group-hover:h-40 text-black overflow-hidden text-center z-10" style="transition: 0.9s;">
                            <a href="{{route('performances.performance.index')}}">
                                <div class="px-4 py-2 mt-2 bg-red-300 hover:bg-red-400 rounded-full">
                                    <p class="text-base">Performance</p>
                                </div>
                            </a>

                            <a href="{{route('medals.medal.index')}}">
                                <div class="px-4 py-2 mt-2 bg-red-300 hover:bg-red-400 rounded-full">
                                    <p class="text-base">Medal</p>
                                </div>
                            </a>

                            <a href="">
                                <div class="px-4 py-2 mt-2 bg-red-300 hover:bg-red-400 rounded-full">
                                    <p class="text-base">Dropdown</p>
                                </div>
                            </a>
							
                        </div>
                    </div>

                    <div class="col-span-6 lg:col-span-3 group text-3xl relative">
                        <div class="bg-yellow-500 hover:bg-yellow-600 grid grid-cols-3 h-32 items-center border-b-4 border-gray-400 p-2 text-center group transition duration-500 rounded-xl cursor-pointer">
                            <img src="{{ asset('img/yellow.svg') }}" class="col-span-1 w-32 mx-auto p-2">
                            <div class="col-span-2 text-left">
                                <div class="flex flex-row mt-2">
                                    <p>Training</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-4 transform group-hover:rotate-90 duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                                <p class="text-sm mt-2 text-white text-opacity-50 transform animate-pulse">Hover here to see available services</p>
                            </div>
                        </div>

                        <div class="w-full h-0 group-hover:h-56 text-black overflow-hidden text-center z-10" style="transition: 0.9s;">
                            <a href="">
                                <div class="px-4 py-2 mt-2 bg-yellow-300 hover:bg-yellow-400 rounded-full">
                                    <p class="text-base">Dropdown</p>
                                </div>
                            </a>

                            <a href="">
                                <div class="px-4 py-2 mt-2 bg-yellow-300 hover:bg-yellow-400 rounded-full">
                                    <p class="text-base">Dropdown</p>
                                </div>
                            </a>
							
                        </div>
                    </div>

                    <div class="col-span-6 lg:col-span-3 group text-3xl relative">
                        <div class="bg-green-500 hover:bg-green-600 grid grid-cols-3 h-32 items-center border-b-4 border-gray-400 p-2 text-center group transition duration-500 rounded-xl cursor-pointer">
                            <img src="{{ asset('img/indigo.svg') }}" class="col-span-1 w-32 mx-auto p-2">
                            <div class="col-span-2 text-left">
                                <div class="flex flex-row mt-2">
                                    <p>ICT</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-4 transform group-hover:rotate-90 duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                                <p class="text-sm mt-2 text-white text-opacity-50 transform animate-pulse">Hover here to see available services</p>
                            </div>
                        </div>

                        <div class="w-full h-0 group-hover:h-56 text-black overflow-hidden text-center z-10" style="transition: 0.9s;">
                            <a href="">
                                <div class="px-4 py-2 mt-2 bg-green-300 hover:bg-green-400 rounded-full">
                                    <p class="text-base">Dropdown</p>
                                </div>
                            </a>

                            <a href="">
                                 <div class="px-4 py-2 mt-2 bg-green-300 hover:bg-green-400 rounded-full">
                                    <p class="text-base">Dropdown</p>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                
            </div>

        </section>

    </div>
    
    <!-- End Services Section -->

@endsection