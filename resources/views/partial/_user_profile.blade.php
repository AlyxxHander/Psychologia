<div id="profile-wrapper" class="relative top-0 flex flex-col items-center">
  <button id="profile-container" class="w-full gap-3 flex flex-col sm:flex-row justify-end items-center text-center sm:text-end outline-0 cursor-pointer">
    <div>
      <p id="user_position" class="text-base font-bold uppercase">{{ auth()->user()->full_name }}</p>
      <p id="user_email" class="font-thin text-xs">{{ auth()->user()->email }}</p>
    </div>
    <img id="profile_picture" src="{{ asset(auth()->user()->profile_photo ?? 'assets/icons/default-profile-photo.jpg') }}" alt="Profile Picture" class="w-13 block aspect-square rounded-full">
  </button>
  
  <div id="profile-menu" class="hidden w-64 mt-3 p-5 absolute top-10 -right-17 sm:right-0 bg-white rounded-2xl shadow-xl border border-slate-300 z-100 transition-all duration-300">
    <div class="pb-5 gap-3 flex flex-row items-center border-b-2 border-brand-divider">
      <img id="profile_picture" src="{{ asset(auth()->user()->profile_photo ?? 'assets/icons/default-profile-photo.jpg') }}" alt="Profile Picture" class="w-13 block aspect-square rounded-full">
      <div class="flex flex-col justify-center">
        <p id="user_position" class="text-base font-bold uppercase">{{ auth()->user()->full_name }}</p>
        <p id="user_email" class="font-thin text-xs">{{ auth()->user()->email }}</p>
      </div>
    </div>
    <div class="mt-2 px-3 py-2 border-b border-slate-50">
      <span class="text-xs font-bold uppercase tracking-widest text-brand-text-secondary">Main Menu</span>
    </div>
    <nav class="gap-1 flex flex-col">
      <a href="{{ route('admin.dashboard') }}" wire:navigate class="px-5 py-2 gap-4 flex flex-row justify-start items-center rounded-md text-brand-text-primary hover:text-brand-text-tertiary cursor-pointer">
        <i class="ml-1 fa-solid fa-house"></i>
        <label class="ml-2 text-sm font-semibold cursor-pointer">Admin</label>
      </a>
      <a href="{{ route('landing.home') }}" wire:navigate target="_blank" class="px-5 py-2 gap-5 flex flex-row justify-start items-center rounded-md text-brand-text-primary hover:text-brand-gradient-200 cursor-pointer">
        <i class="ml-1 fa-solid fa-globe"></i>
        <label class="ml-2 text-sm font-semibold cursor-pointer">Landing Page</label>
      </a>
      <form action="{{ route('logout') }}" method="POST" class="logout-form flex flex-col items-start text-brand-text-primary hover:text-red-600 transition-colors font-semibold cursor-pointer">
        @csrf
        <button type="submit" class="w-full px-5 py-2 gap-5 flex flex-row items-center text-sm cursor-pointer">
          <i class="ml-1 text-base fa-solid fa-right-from-bracket"></i>
          <label class="ml-2 text-sm font-semibold cursor-pointer">Logout</label>
        </button>
      </form>
    </nav>
  </div>
</div>

@vite('resources/js/linked/user_profile_js.js')