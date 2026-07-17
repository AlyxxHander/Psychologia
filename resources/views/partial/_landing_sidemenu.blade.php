<div id="landing-sidemenu-section" class="min-w-75 h-screen max-h-screen flex flex-col justify-between z-50 fixed left-0 top-0 text-start border-r shadow-2xl border-brand-divider bg-white transition-transform duration-300 ease-in-out translate-x-0 lg:-translate-x-full">
  <div class="py-10 ">
    <div class="ml-5 mb-10 px-5 gap-3 flex flex-row items-center">
      <img src="{{ asset('assets/icons/psychologia_logo.png') }}" alt="Psychologia Logo" class="h-11 object-cover">
      <h1 class="text-xl font-bold">Psychologia</h1>
    </div>

    <div id="nav-sidemenu-container" class="flex flex-col text-brand-text-primary">
      <a href="{{ route('landing.home') }}#hero-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : ''}} class="sidemenu-nav-link px-10 py-3 gap-7 flex flex-row justify-start items-center hover:bg-brand-main-bg cursor-pointer transition-colors duration-300
        {{ str_contains(request()->fullUrl(), '#hero-section') || request()->routeIs('landing.home') ? 'bg-brand-gradient-200 text-white' : ' bg-white text-brand-text-tertiary' }}  
      ">
        <i class="fa-solid fa-lg fa-house cursor-pointer"></i> 
        <label class="text-sm font-semibold cursor-pointer">Home</label>
      </a>
      <a href="{{ route('landing.home') }}#about-us-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : ''}} class="sidemenu-nav-link px-10 py-3 gap-7 flex flex-row justify-start items-center hover:bg-brand-main-bg cursor-pointer transition-colors duration-300
        {{ str_contains(request()->fullUrl(), '#about-us-section') ? 'bg-brand-gradient-200 text-white' : ' bg-white text-brand-text-tertiary' }}  
      ">
        <i class="fa-solid fa-lg fa-info-circle cursor-pointer"></i> 
        <label class="text-sm font-semibold cursor-pointer">About Us</label>
      </a>
      <a href="{{ route('landing.home') }}#news-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : ''}} class="sidemenu-nav-link px-10 py-3 gap-7 flex flex-row justify-start items-center hover:bg-brand-main-bg cursor-pointer transition-colors duration-300
        {{ str_contains(request()->fullUrl(), '#news-section') ? 'bg-brand-gradient-200 text-white' : ' bg-white text-brand-text-tertiary' }}  
      ">
        <i class="fa-solid fa-lg fa-newspaper cursor-pointer"></i> 
        <label class="text-sm font-semibold cursor-pointer">News</label>
      </a>
      <a href="{{ route('landing.home') }}#contact-us-section" {{ !request()->routeIs('landing.home') ? 'wire:navigate' : ''}} class="sidemenu-nav-link px-10 py-3 gap-7 flex flex-row justify-start items-center hover:bg-brand-main-bg cursor-pointer transition-colors duration-300
        {{ str_contains(request()->fullUrl(), '#contact-us-section') ? 'bg-brand-gradient-200 text-white' : ' bg-white text-brand-text-tertiary' }}  
      ">
        <i class="fa-solid fa-lg fa-envelope cursor-pointer"></i> 
        <label class="text-sm font-semibold cursor-pointer">Contact Us</label>
      </a>
    </div>
  </div>
</div>  

@vite('resources/js/linked/logout_js.js')