<div id="admin-sidemenu-section" class="min-w-75 h-screen max-h-screen flex flex-col justify-between z-50 fixed xl:sticky left-0 top-0 text-start border-r shadow-2xl border-brand-divider bg-white transition-transform duration-300 ease-in-out translate-x-0 xl:translate-x-0">
  <div class="px-5 py-10 ">
    <div class="ml-5 mb-10">
      <div class="mb-3 gap-3 flex flex-row items-center">
        <img src="{{ asset('assets/icons/psychologia_logo.png') }}" alt="Psychologia Logo" class="h-11 object-cover">
        <h1 class="text-xl font-bold">LSO Insight</h1>
      </div>
      <p class="text-brand-text-primary font-thin text-xs tracking-widest uppercase">Editorial Admin</p>
    </div>

    <div class="gap-2 flex flex-col text-brand-text-primary">
      <a href="{{ route('admin.dashboard') }}" wire:navigate class="px-5 py-3 gap-6 flex flex-row justify-start items-center border-r-brand-divider hover:border-r-brand-text-tertiary rounded-md border-r-0 hover:border-r-5 hover:bg-brand-main-bg hover:text-brand-text-tertiary cursor-pointer
        {{ request()->routeIs('admin.dashboard') ? 'border-r-5 border-r-brand-text-tertiary bg-brand-main-bg text-brand-text-tertiary' : '' }}
      ">
        <i class="fa-solid fa-lg fa-house cursor-pointer"></i>
        <label class="text-sm font-semibold cursor-pointer">Dashboard</label>
      </a>
      <a href="{{ route('admin.manage-articles') }}" wire:navigate class="ml-1 px-5 py-3 gap-6 flex flex-row justify-start items-center border-r-brand-divider hover:border-r-brand-text-tertiary rounded-md border-r-0 hover:border-r-5 hover:bg-brand-main-bg hover:text-brand-text-tertiary cursor-pointer
        {{ request()->routeIs(['admin.manage-articles', 'admin.article-form', 'admin.edit-article-form']) ? 'border-r-5 border-r-brand-text-tertiary bg-brand-main-bg text-brand-text-tertiary' : '' }}
      ">
        <i class="fa-regular fa-lg fa-file-lines cursor-pointer"></i>
        <label class="ml-1 text-sm font-semibold cursor-pointer">Articles</label>
      </a>
      <a href="{{ route('admin.manage-members') }}" wire:navigate class="px-5 py-3 gap-6 flex flex-row justify-start items-center border-r-brand-divider hover:border-r-brand-text-tertiary rounded-md border-r-0 hover:border-r-5 hover:bg-brand-main-bg hover:text-brand-text-tertiary cursor-pointer
        {{ request()->routeIs(['admin.manage-members', 'admin.edit-member-profile-form', 'admin.new-member-form']) ? 'border-r-5 border-r-brand-text-tertiary bg-brand-main-bg text-brand-text-tertiary' : '' }}
      ">
        <i class="fa-solid fa-lg fa-users cursor-pointer"></i>
        <label class="text-sm font-semibold cursor-pointer">Manage Members</label>
      </a>
      <a href="{{ route('admin.edit-admin-profile-form') }}" wire:navigate class="ml-1 px-5 py-3 gap-6 flex flex-row justify-start items-center border-r-brand-divider hover:border-r-brand-text-tertiary rounded-md border-r-0 hover:border-r-5 hover:bg-brand-main-bg hover:text-brand-text-tertiary cursor-pointer
        {{ request()->routeIs('admin.edit-admin-profile-form') ? 'border-r-5 border-r-brand-text-tertiary bg-brand-main-bg text-brand-text-tertiary' : '' }}
      ">
        <i class="fa-regular fa-lg fa-user cursor-pointer"></i>
        <label class="ml-1 text-sm font-semibold cursor-pointer">Edit profile</label>
      </a>
    </div>
  </div>

  <div class="px-5 pt-5 pb-10 flex flex-col items-start font-semibold border-t-4 border-brand-divider">
    <a href="{{ route('landing.home') }}" wire:navigate target="_blank" class="px-5 py-3 gap-5 flex flex-row items-center text-sm cursor-pointer text-brand-text-secondary hover:text-brand-gradient-200">
      <i class="text-xl fa-solid fa-globe"></i>
      View Landing Page
    </a>
    <a href="{{ route('admin.help-center') }}" wire:navigate class="px-5 py-3 gap-5 flex flex-row items-center text-sm cursor-pointer
      {{ request()->routeIs('admin.help-center') ? 'text-brand-text-primary' : 'text-brand-text-secondary hover:text-brand-text-primary' }}
      ">
      <i class="text-xl fa-regular fa-circle-question"></i>
      Help Center
    </a>    
  </div>
    
  @vite('resources/js/linked/logout_js.js')
</div>  