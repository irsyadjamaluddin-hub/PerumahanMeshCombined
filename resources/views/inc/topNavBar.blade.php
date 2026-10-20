{{-- Top Nav-Bar --}}
<div class="top-0 bg-white p-3 shadow flex flex-row items-center justify-between">

    <div class="flex flex-row items-center">
    
        {{-- Hamburger-Menu --}}
        <svg xmlns="http://www.w3.org/2000/svg" id="hamburger-menu" class="w-5 cursor-pointer inline ml-3 hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16" />
        </svg>

        {{-- Close Menu --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" id="close-menu" class="w-5 cursor-pointer hidden ml-3 hover:text-red-500" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>

        {{-- Links --}}
        <div class="flex flex-row text-gray-500 font-semibold">
            <a href="" class="ml-4 font-bold lg:hidden text-lg hover:text-red-500">MOE Internal</a>
        </div>

    </div>

    {{-- #========== NEWLY ADDED ============ --}}
    {{-- English / Malay switch at the top right, left of the user name -- same corner as on the other MESH pages. --}}
    {{-- ml-auto keeps it next to the name. Styled here because layouts/app2 doesn't load public/css/mesh-v4.css. --}}
    <style>
      .mesh-lang-bar { margin-left: auto; margin-right: 16px; }
      .mesh-lang-bar .mesh-lang-toggle { display: flex; gap: 2px; padding: 3px; background: #ffffff; border: 1px solid #e3e6f0; border-radius: 12px; }
      .mesh-lang-bar .mesh-lang-toggle button { height: 28px; min-width: 32px; padding: 0 8px; border: 0; border-radius: 9px; background: none; color: #5b6275; font-size: 12px; font-weight: 600; line-height: 1; letter-spacing: .04em; cursor: pointer; }
      .mesh-lang-bar .mesh-lang-toggle button:hover { background: #f2f3fa; color: #1c1934; }
      .mesh-lang-bar .mesh-lang-toggle button[aria-pressed="true"] { background: #3730a3; color: #ffffff; }
    </style>
    <div class="mesh-lang-bar">
      @include('inc.lang-toggle')
    </div>
    {{-- #================================ --}}

  <div id="username-dropdown" class="flex flex-row cursor-pointer group">

      {{-- Username --}}
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 group-hover:text-red-500" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
      </svg>

      <p class="text-sm ml-2 mt-1 hidden lg:inline group-hover:text-red-500">{{ Auth::user()->name }}</p>

      <svg id="username-right-icon" xmlns="http://www.w3.org/2000/svg" class="w-3 ml-3 mt-1 transform transition duration-500 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
      </svg>

      {{-- Dropdown Content --}}
      <div id="username-dropdown-content" class="bg-white w-52 h-0 absolute right-0 mt-7 mr-5 shadow-lg overflow-hidden text-sm transform duration-500 z-20">
          
          {{-- Logout --}}
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-2 py-2.5 flex flex-row hover:bg-red-100 hover:text-red-700 border-r-4 border-red-50 hover:border-r-4 hover:border-red-700">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 text-red-500" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              <span class="ml-2">Logout</span>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>

          <hr>

      </div>
      
  </div>

</div>


{{-- Un-used --}}

    {{-- Links --}}
    {{-- <div class="flex flex-row mt-0.5 ml-5 text-sm text-gray-500 font-semibold">

        <a href="" class="ml-4 hover:text-red-700">Home</a>
        <a href="" class="ml-4 hover:text-red-700">My Profile</a>

    </div> --}}

    {{-- Notification --}}
    {{-- <div class="">
        <div class="inline-block relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
            </svg>
            <div class="absolute -top-1 -right-3 px-1.5 rounded-full bg-red-500 text-white text-xs">
                <span>3</span>
            </div>
        </div>

        <div class="inline-block relative ml-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <div class="absolute -top-1 -right-3 px-1.5 rounded-full bg-yellow-500 text-white text-xs">
                <span>3</span>
            </div>
        </div>
    </div> --}}