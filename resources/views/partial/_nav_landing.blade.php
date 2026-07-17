<nav id="nav" class="z-50 sticky top-0 px-0 md:px-20 2xl:px-50 py-5 shadow-lg bg-white">
  <div class="gap-10 flex flex-col sm:flex-row justify-between items-center">
    <div class="gap-3 flex flex-col sm:flex-row items-center">
      <span id="landing-sidemenu-toggle" class="block lg:hidden">
        <i class="p-3 fa-solid fa-bars rounded-full hover:bg-gray-200 text-xl hover:text-brand-gradient-200 cursor-pointer"></i>
      </span>
      <h1 class="font-bold text-2xl text-center md:text-start"><a href="{{ route('landing.home') }}" class="outline-0" wire:navigate>LSO Psychologia Club</a></h1>
    </div>

    <div id="nav-container" class="gap-6 hidden lg:flex flex-row justify-between items-center text-sl font-thin transition-all duration-300">  
      <a href="{{ route('landing.home') }}#hero-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : '' }} class="nav-link py-1 border-b-2 border-transparent transition-all duration-300 cursor-pointer hover:border-b-brand-gradient-200 hover:text-brand-gradient-200 hover:-translate-y-1 outline-0 
        {{ request()->routeIs('landing.home') ? 'text-brand-gradient-200 border-b-brand-gradient-200 -translate-y-1' : '' }}">Home</a>
      <a href="{{ route('landing.home') }}#about-us-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : '' }} class="nav-link py-1 border-b-2 border-transparent transition-all duration-300 cursor-pointer hover:border-b-brand-gradient-200 hover:text-brand-gradient-200 hover:-translate-y-1 outline-0">About Us</a>
      {{-- <a href="{{ route('landing.home') }}#vision-mission-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : '' }} class="nav-link py-1 border-b-2 border-transparent transition-all duration-300 cursor-pointer hover:border-b-brand-gradient-200 hover:text-brand-gradient-200 hover:-translate-y-1">Vision & Mission</a> --}}
      <a href="{{ route('landing.home') }}#news-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : '' }} class="nav-link py-1 border-b-2 border-transparent transition-all duration-300 cursor-pointer hover:border-b-brand-gradient-200 hover:text-brand-gradient-200 hover:-translate-y-1 outline-0">News</a>
      {{-- <a href="{{ route('landing.home') }}#team-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : '' }} class="nav-link py-1 border-b-2 border-transparent transition-all duration-300 cursor-pointer hover:border-b-brand-gradient-200 hover:text-brand-gradient-200 hover:-translate-y-1">Our Team</a> --}}
      <a href="{{ route('landing.home') }}#contact-us-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : '' }} class="nav-link py-1 border-b-2 border-transparent transition-all duration-300 cursor-pointer hover:border-b-brand-gradient-200 hover:text-brand-gradient-200 hover:-translate-y-1 outline-0">Contact Us</a>
    </div>

    @auth
      <div class="w-auto gap-3 flex flex-col sm:flex-row justify-end items-center">
        @include('partial._user_profile')
      </div>
    @else
      <div id="auth-container" class="gap-2 flex flex-col sm:flex-row justify-center items-center transition-all duration-300">
        <a href="{{ route('login') }}" wire:navigate class="btn px-10 py-2 text-brand-gradient-200 border border-brand-gradient-200 bg-transparent hover:text-white hover:bg-brand-gradient-200 transition-colors">Login</a>
      </div>
    @endauth
  </div>

  @vite('resources/js/linked/logout_js.js')
</nav>

