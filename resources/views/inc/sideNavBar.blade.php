{{-- SIDE NAV-BAR --}}
<div id="sideNav" class="bg-white shadow h-full fixed z-50 top-0 overflow-x-auto w-0 lg:w-60 hover:w-60 group" style="transition: 0.4s;">
    <div class="py-5 hover:bg-gray-100">

    @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a href="{{ route('admin') }}">
        @endif
        
        @if (Auth::user()->hasRole('ROLE_HOD'))
        <a href="{{ route('hod') }}">
        @endif
        
        @if (Auth::user()->hasRole('ROLE_MAW'))
        <a href="{{ route('maw') }}">
        @endif
		
		@if (Auth::user()->hasRole('ROLE_MAW_SECOND'))
        <a href="{{ route('mawSecond') }}">
        @endif
        
        @if (Auth::user()->hasRole('ROLE_CLAIMANT'))
        <a href="{{ route('claimant') }}">
        @endif
        
        @if (Auth::user()->hasRole('ROLE_DA'))
        <a href="{{ route('da') }}">
        @endif

        @if (Auth::user()->hasRole('ROLE_ENDORSER'))
        <a href="{{ route('endorser') }}">
        @endif

        @if (Auth::user()->hasRole('ROLE_MAW_ENDORSER'))
        <a href="{{ route('mawendorser') }}">
        @endif
    @endif
            
        <div class="whitespace-nowrap overflow-hidden flex flex-row">
            <img class="w-14 ml-3" src="{{ asset('img/logo.png') }}">
            <div class="ml-4 mt-1 align-text-bottom opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <p class="font-bold text-lg tracking-wider text-red-500">MOE Internal</p>
                <p class="text-xs tracking-wide">Ministry of Education</p>
            </div>
        </div>
        </a>

    </div>
    <div class="bg-gray-200 h-0.5 w-full"></div>

    <div class="overflow-hidden whitespace-nowrap m-2 group">

		@if (Auth::check())

       
			@if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                <a href="{{ route('admin') }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Dashboard") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700  @endif @endisset" style="transition: 0.5s">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Dashboard</p>
                </a>
            @endif

			@if (Auth::user()->hasRole('ROLE_DA'))
                <a href="{{ route('da') }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Dashboard") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700  @endif @endisset" style="transition: 0.5s">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Dashboard</p>
                </a>
            @endif

			@if (Auth::user()->hasRole('ROLE_HOD'))
                <a href="{{ route('hod') }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Dashboard") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700  @endif @endisset" style="transition: 0.5s">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Dashboard</p>
                </a>
            @endif

            @if (Auth::user()->hasRole('ROLE_MAW'))
                <a href="{{ route('maw') }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Dashboard") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700  @endif @endisset" style="transition: 0.5s">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Dashboard</p>
                </a>
            @endif
			
			 @if (Auth::user()->hasRole('ROLE_MAW_SECOND'))
                <a href="{{ route('mawSecond') }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Dashboard") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700 @endif @endisset" style="transition: 0.5s">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Dashboard</p>
                </a>
            @endif
			
			@if (Auth::user()->hasRole('ROLE_MAW_ENDORSER'))
                <a href="{{ route('mawendorser') }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Dashboard") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700 @endif @endisset" style="transition: 0.5s">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Dashboard</p>
                </a>
            @endif

			@if (Auth::user()->hasRole('ROLE_CLAIMANT'))
                <a href="{{ route('claimant') }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Dashboard") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700  @endif @endisset" style="transition: 0.5s">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Dashboard</p>
                </a>
            @endif

            @if (Auth::user()->hasRole('ROLE_ENDORSER'))
                <a href="{{ route('endorser') }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Dashboard") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700 @endif @endisset" style="transition: 0.5s">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Dashboard</p>
                </a>
            @endif

            <!------------------ Sidebar Menu ------------------>

            <a href="{{ route('biodatas.biodata.show', [Auth::user()->ic_no]) }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Personal Information") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700 @endif @endisset" style="transition: 0.5s">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>  
                <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">My Profile</p>
            </a>
    
             
            <a href="{{ url('/services') }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Services") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700 @endif @endisset" style="transition: 0.5s">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                
                <p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Services</p>
            </a>
			
			 <div class="overflow-hidden whitespace-nowrap m-2 mt-20 group">
				<span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Administrative Use</span>
				<a href="{{ route('cutis.cuti.create', [Auth::user()->ic_no]) }}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Personal Information") bg-blue-100 text-black border-blue-700 @else hover:bg-blue-100 text-gray-600 hover:text-blue-700 border-white hover:border-blue-700 @endif @endisset" style="transition: 0.5s">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="blue">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>  
					<p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Employee Service</p>
				</a>
			</div>

        @endif

        {{-- Dashboard --}}
            

    </div>
    

    @if(Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MAW'))
    <div class="overflow-hidden whitespace-nowrap m-2 group">
    <span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Administrative Use</span>
    {{-- Mileage Dropdown --}}
        <p id="mileage-dropdown" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Mileage") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset transition duration-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path fill="#fff" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Mileage
                    <svg xmlns="http://www.w3.org/2000/svg" id="mileage-right-icon" class="w-4 inline ml-20 transform transition duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Mileage Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="mileage-dropdown-content" style="transition: 0.4s;">
            <a href="{{route('mileages.mileage.index')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Received</span>
            </a>
            <a href="{{route('mileages.mileage.indexEndorser')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">For Meeting</span>
            </a>
			<a href="{{route('mileages.mileage.history')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
					  <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
					</svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>

        {{-- GHRMS Dropdown --}}
        <p id="ghrms-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">GHRMS
                    <svg xmlns="http://www.w3.org/2000/svg" id="ghrms-right-icon" class="w-4 inline ml-20 transform transition duration-500" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- GHRMS Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ghrms-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>

        {{-- Training Dropdown --}}
        <p id="training-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Training
                    <svg xmlns="http://www.w3.org/2000/svg" id="training-right-icon" class="w-4 inline ml-20 transform transition duration-500" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Training Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="training-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>


        {{-- ICT Dropdown --}}
        <p id="ict-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">ICT
                    <svg xmlns="http://www.w3.org/2000/svg" id="ict-right-icon" class="w-4 inline ml-28 transform transition duration-500 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- ICT Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ict-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>

    </div>
	
	<div class="overflow-hidden whitespace-nowrap m-2 group">
    <span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Settings</span>
    {{-- Department Dropdown --}}
		<a href="{{ route('departments.department.index')}}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Departments") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset" style="transition: 0.5s">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
			</svg>
			
			<p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Departments</p>
		</a>
	{{-- Unit Dropdown --}}
       <a href="{{ route('units.unit.index')}}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Units") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset" style="transition: 0.5s">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
			</svg>
			
			<p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Units</p>
		</a>
		
	</div>

    @endif
	
	@if(Auth::user()->hasRole('ROLE_MAW_SECOND'))
    <div class="overflow-hidden whitespace-nowrap m-2 group">
    <span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Administrative Use</span>
    {{-- Mileage Dropdown --}}
        <p id="mileage-dropdown" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Mileage") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset transition duration-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path fill="#fff" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Mileage
                    <svg xmlns="http://www.w3.org/2000/svg" id="mileage-right-icon" class="w-4 inline ml-20 transform transition duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Mileage Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="mileage-dropdown-content" style="transition: 0.4s;">
            <a href="{{route('mileages.mileage.index')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Received</span>
            </a>
            <a href="{{route('mileages.mileage.indexEndorser')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">For Meeting</span>
            </a>
			<a href="{{route('mileages.mileage.history')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
					  <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
					</svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>

        {{-- GHRMS Dropdown --}}
        <p id="ghrms-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">GHRMS
                    <svg xmlns="http://www.w3.org/2000/svg" id="ghrms-right-icon" class="w-4 inline ml-20 transform transition duration-500" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- GHRMS Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ghrms-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>

        {{-- Training Dropdown --}}
        <p id="training-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Training
                    <svg xmlns="http://www.w3.org/2000/svg" id="training-right-icon" class="w-4 inline ml-20 transform transition duration-500" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Training Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="training-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>


        {{-- ICT Dropdown --}}
        <p id="ict-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">ICT
                    <svg xmlns="http://www.w3.org/2000/svg" id="ict-right-icon" class="w-4 inline ml-28 transform transition duration-500 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- ICT Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ict-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>

    </div>
	
	<div class="overflow-hidden whitespace-nowrap m-2 group">
    <span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Settings</span>
    {{-- Department Dropdown --}}
		<a href="{{ route('departments.department.index')}}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Departments") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset" style="transition: 0.5s">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
			</svg>
			
			<p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Departments</p>
		</a>
	{{-- Unit Dropdown --}}
       <a href="{{ route('units.unit.index')}}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Units") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset" style="transition: 0.5s">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
			</svg>
			
			<p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Units</p>
		</a>
		
	</div>
	
    @endif

    @if(Auth::user()->hasRole('ROLE_MAW_ENDORSER'))
    <div class="overflow-hidden whitespace-nowrap m-2 group">
    <span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Administrative Use</span>
    {{-- Mileage Dropdown --}}
        <p id="mileage-dropdown" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Mileage") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset transition duration-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path fill="#fff" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Mileage
                    <svg xmlns="http://www.w3.org/2000/svg" id="mileage-right-icon" class="w-4 inline ml-20 transform transition duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Mileage Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="mileage-dropdown-content" style="transition: 0.4s;">
            <a href="{{route('mileages.mileage.index')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Received</span>
            </a>
            <a href="{{route('mileages.mileage.indexEndorser')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">For Meeting</span>
            </a>
			<a href="{{route('mileages.mileage.history')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
					  <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
					</svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>


        {{-- GHRMS Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ghrms-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>

        {{-- Training Dropdown --}}
        <p id="training-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Training
                    <svg xmlns="http://www.w3.org/2000/svg" id="training-right-icon" class="w-4 inline ml-20 transform transition duration-500" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Training Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="training-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>


        {{-- ICT Dropdown --}}
        <p id="ict-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">ICT
                    <svg xmlns="http://www.w3.org/2000/svg" id="ict-right-icon" class="w-4 inline ml-28 transform transition duration-500 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- ICT Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ict-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>

    </div>
	
	<div class="overflow-hidden whitespace-nowrap m-2 group">
    <span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Settings</span>
    {{-- Department Dropdown --}}
		<a href="{{ route('departments.department.index')}}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Departments") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset" style="transition: 0.5s">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
			</svg>
			
			<p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Departments</p>
		</a>
	{{-- Unit Dropdown --}}
       <a href="{{ route('units.unit.index')}}" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Units") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset" style="transition: 0.5s">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
			</svg>
			
			<p class="opacity-0 lg:opacity-100 group-hover:opacity-100 inline text-sm font-semibold sideNavText">Units</p>
		</a>
		
	</div>

    @endif

    @if(Auth::user()->hasRole('ROLE_HOD'))
    <div class="overflow-hidden whitespace-nowrap m-2 group">
    <span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Administrative Use</span>
        {{-- Mileage Dropdown --}}
        <p id="mileage-dropdown" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Mileage") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset transition duration-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path fill="#fff" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Mileage
                    <svg xmlns="http://www.w3.org/2000/svg" id="mileage-right-icon" class="w-4 inline ml-20 transform transition duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Mileage Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="mileage-dropdown-content" style="transition: 0.4s;">
            <a href="{{route('mileages.mileage.index')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Endorsement</span>
            </a>
        </div>

        {{-- GHRMS Dropdown --}}
        <p id="ghrms-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">GHRMS
                    <svg xmlns="http://www.w3.org/2000/svg" id="ghrms-right-icon" class="w-4 inline ml-20 transform transition duration-500" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- GHRMS Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ghrms-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>

        {{-- Training Dropdown --}}
        <p id="training-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Training
                    <svg xmlns="http://www.w3.org/2000/svg" id="training-right-icon" class="w-4 inline ml-20 transform transition duration-500" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Training Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="training-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>


        {{-- ICT Dropdown --}}
        <p id="ict-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">ICT
                    <svg xmlns="http://www.w3.org/2000/svg" id="ict-right-icon" class="w-4 inline ml-28 transform transition duration-500 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- ICT Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ict-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>

    </div>

    @endif

    @if(Auth::user()->hasRole('ROLE_DA'))
    <div class="overflow-hidden whitespace-nowrap m-2 group">
    <span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Administrative Use</span>
        {{-- Mileage Dropdown --}}
        <p id="mileage-dropdown" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Mileage") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset transition duration-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path fill="#fff" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Mileage
                    <svg xmlns="http://www.w3.org/2000/svg" id="mileage-right-icon" class="w-4 inline ml-20 transform transition duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Mileage Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="mileage-dropdown-content" style="transition: 0.4s;">
            <a href="{{route('mileages.mileage.index')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Endorsement</span>
            </a>
            <a href="{{route('mileages.mileage.history')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
			 <a href="{{route('mileages.mileage.summary')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Summary</span>
            </a>
            
        </div>

        {{-- GHRMS Dropdown --}}
        <p id="ghrms-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">GHRMS
                    <svg xmlns="http://www.w3.org/2000/svg" id="ghrms-right-icon" class="w-4 inline ml-20 transform transition duration-500 float-right mr-4" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- GHRMS Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ghrms-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>


        {{-- Training Dropdown --}}
        <p id="training-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Training
                    <svg xmlns="http://www.w3.org/2000/svg" id="training-right-icon" class="w-4 inline ml-20 transform transition duration-500 float-right mr-4" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Training Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="training-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>


        {{-- ICT Dropdown --}}
        <p id="ict-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">ICT
                    <svg xmlns="http://www.w3.org/2000/svg" id="ict-right-icon" class="w-4 inline ml-20 transform transition duration-500 float-right mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- ICT Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ict-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>

    </div>


    @endif

    @if (Auth::user()->hasRole('ROLE_ENDORSER'))
    <div class="overflow-hidden whitespace-nowrap m-2 group">
    <span class="mt-10 mb-20 text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.90rem;">Administrative Use</span>
    {{-- Mileage Dropdown --}}
        <p id="mileage-dropdown" class="block border-r-4 py-3 pl-5 rounded-md @isset($pagename) @if($pagename == "Mileage") bg-red-100 text-red-700 border-red-700 @else hover:bg-red-100 text-gray-600 hover:text-red-700 border-white hover:border-red-700  @endif @endisset transition duration-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path fill="#fff" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Mileage
                    <svg xmlns="http://www.w3.org/2000/svg" id="mileage-right-icon" class="w-4 inline ml-20 transform transition duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Mileage Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="mileage-dropdown-content" style="transition: 0.4s;">
            <a href="{{route('mileages.mileage.index')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Received</span>
            </a>
            <a href="{{route('mileages.mileage.indexEndorser')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">For Meeting</span>
            </a>
			<a href="{{route('mileages.mileage.history')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
					  <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
					</svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>

        {{-- GHRMS Dropdown --}}
        <p id="ghrms-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">GHRMS
                    <svg xmlns="http://www.w3.org/2000/svg" id="ghrms-right-icon" class="w-4 inline ml-20 transform transition duration-500 float-right mr-4" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- GHRMS Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ghrms-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">History</span>
            </a>
        </div>

        {{-- Training Dropdown --}}
        <p id="training-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">Training
                    <svg xmlns="http://www.w3.org/2000/svg" id="training-right-icon" class="w-4 inline ml-20 transform transition duration-500 float-right mr-4" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- Training Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="training-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>


        {{-- ICT Dropdown --}}
        <p id="ict-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">ICT
                    <svg xmlns="http://www.w3.org/2000/svg" id="ict-right-icon" class="w-4 inline ml-20 transform transition duration-500 float-right mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        {{-- ICT Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ict-dropdown-content" style="transition: 0.4s;">
            <a href="#" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Apply</span>
            </a>
        </div>

    </div>
    @endif

    @if(Auth::user()->hasRole('ROLE_SUPERADMIN'))
    <div class="overflow-hidden whitespace-nowrap m-2 group">
        {{-- User Dropdown --}}
        <p id="ghrmsa-dropdown" class="block hover:bg-red-100 text-gray-600 hover:text-red-700 border-r-4 border-white hover:border-red-700 py-3 pl-5 rounded-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 sideNavText">
                <span class="text-sm font-semibold">User
                    <svg xmlns="http://www.w3.org/2000/svg" id="ghrmsa-right-icon" class="w-4 inline ml-27 transform transition duration-500 float-right mr-3" style="" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </p>

        

        {{-- User Dropdown Content --}}
        <div class="h-0 overflow-hidden" id="ghrmsa-dropdown-content" style="transition: 0.4s;">
            <a href="{{ route('roles.role.index') }}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Role Type</span>
            </a>

            <a href="{{ route('role_users.role_user.index')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">Role Assignment</span>
            </a>

            <a href="{{ route('users.user.index')}}" class="block py-2 pl-5 hover:bg-red-100 text-gray-600 hover:text-red-700 rounded-md">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="opacity-0 lg:opacity-100 group-hover:opacity-100 text-sm font-semibold sideNavText">List</span>
            </a>
        </div>
    </div>
    @endif

    {{-- Footer --}}
    <div class="absolute bottom-10 w-full text-gray-600 text-center whitespace-nowrap opacity-0 lg:opacity-100 group-hover:opacity-100 transition duration-700 sideNavText" style="font-size: 0.70rem;">
        <p class="font-bold">Department of Administration and Services</p>
        <p>Ministry of Education</p>
        <p> &copy; 2021 All Rights Reserved</p>
    </div>

</div>