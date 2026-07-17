<header id="topbar-admin-section" class="w-full px-0 sm:px-5 lg:px-16 py-5  z-49 sticky top-0 gap-5 flex flex-col sm:flex-row justify-between xl:justify-end items-center md:items-end border-b border-b-brand-divider shadow-lg bg-white">
  <div class="relative top-0 left-0 flex xl:hidden flex-col items-center">
    <span id="admin-sidemenu-toggle" class="block">
      <i class="p-3 fa-solid fa-bars rounded-full hover:bg-gray-200 text-xl hover:text-brand-gradient-200 cursor-pointer"></i>
    </span>

    <div id="admin-nav-link" class="hidden w-65 mt-3 p-2 absolute top-full -left-32 sm:left-0 bg-white rounded-2xl shadow-xl border border-slate-300 z-100 transition-all duration-300">
      <div class="px-3 py-2 mb-2 border-b border-slate-50">
        <span class="text-xs font-bold uppercase tracking-widest text-brand-text-secondary">Main Menu</span>
      </div>
      <nav class="flex flex-col gap-1">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="px-5 py-3 gap-5 flex flex-row justify-start items-center border-r-brand-divider hover:border-r-brand-text-tertiary rounded-md border-r-0 hover:border-r-5 hover:bg-brand-main-bg text-brand-text-primary hover:text-brand-text-tertiary cursor-pointer">
          <i class="ml-1 fa-solid fa-lg fa-house cursor-pointer"></i>
          <label class="text-sm font-semibold cursor-pointer">Dashboard</label>
        </a>
        <a href="{{ route('admin.manage-articles') }}" wire:navigate class="px-4 py-3 flex items-center gap-2 border-r-brand-divider hover:border-r-brand-text-tertiary border-r-0 hover:border-r-5 hover:bg-brand-main-bg text-brand-text-primary hover:text-brand-text-tertiary rounded-md transition-all cursor-pointer">
          <i class="ml-2.5 fa-regular fa-file-lines text-lg group-hover:scale-110 transition-transform"></i>
          <span class="ml-4 text-sm font-semibold">Articles</span>
        </a>
        <a href="{{ route('admin.edit-admin-profile-form') }}" wire:navigate class="px-4 py-3 gap-2 flex items-center border-r-brand-divider hover:border-r-brand-text-tertiary rounded-md border-r-0 hover:border-r-5 hover:bg-brand-main-bg text-brand-text-primary hover:text-brand-text-tertiary transition-all cursor-pointer">
          <i class="ml-2 fa-regular fa-user text-lg group-hover:scale-110 transition-transform"></i>
          <span class="ml-4 text-sm font-semibold">Edit Profile</span>
        </a>
        <a href="{{ route('admin.manage-members') }}" wire:navigate class="px-5 py-3 gap-6 flex flex-row justify-start items-center border-r-brand-divider hover:border-r-brand-text-tertiary rounded-md border-r-0 hover:border-r-5 hover:bg-brand-main-bg text-brand-text-primary hover:text-brand-text-tertiary">
          <i class="fa-solid fa-lg fa-users cursor-pointer"></i>
          <label class="text-sm font-semibold cursor-pointer">Manage Members</label>
        </a>
        <div class="mt-2 pt-2 flex flex-col items-start font-semibold border-t-2 border-brand-divider">
          <a href="{{ route('landing.home') }}" wire:navigate target="_blank" class="px-5 py-3 gap-6 flex flex-row items-center text-sm cursor-pointer text-brand-text-secondary hover:text-brand-gradient-200"><i class="text-xl fa-solid fa-globe"></i>Landing Page</a>
          <a href="{{ route('admin.help-center') }}" wire:navigate class="px-5 py-3 gap-6 flex flex-row items-center text-sm cursor-pointer
            {{ request()->routeIs('admin.help-center') ? 'text-brand-text-primary' : 'text-brand-text-secondary hover:text-brand-text-primary' }}
            ">
            <i class="text-xl fa-regular fa-circle-question"></i>
            Help Center
          </a>
        </div>
      </nav>
    </div>
  </div>
  @auth
    @include('partial._user_profile')
  @endauth
</header>