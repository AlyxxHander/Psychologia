@extends('layouts.base')

@section('content')

<div id="edit-admin-profile-section" class="fade-in-effect min-h-full gap-10 flex flex-col justify-start items-center bg-white">
  <div class="w-full gap-2 flex flex-col justify-start items-start text-center sm:text-start">
    <p class="mb-5 sm:mb-0 text-xs text-brand-text-primary uppercase font-semibold tracking-widest">
      <a href="{{ route('admin.dashboard') }}" wire:navigate class="hover:text-brand-gradient-200">Admin</a> 
      <i class="mx-1 text-xs text-brand-text-secondary/70 fa-solid fa-angle-right"></i> 
      <a href="{{ route('admin.edit-admin-profile-form') }}" wire:navigate class="hover:text-brand-gradient-200">Profile Settings</a>
    </p>
    <div class="gap-2 flex flex-col">
      <h1 class="text-3xl font-bold">Edit Admin Profile</h1>
      <p class="w-full sm:w-115 text-sl text-brand-text-secondary">Oversee the editorial board and contributing research coordinators of the LSO Psychology Club.</p>
    </div>
  </div>

  <form action="{{ route('admin.update-admin-profile', ['id' => $admin->id]) }}" method="POST" enctype="multipart/form-data" id="edit-admin-form-section" class="w-full max-w-160 gap-7 flex flex-col items-center">
    @csrf
    @method('PUT')
    <div class="w-full p-5 gap-8 flex flex-col sm:flex-row items-center rounded-xl shadow-stone-300 shadow-sm border border-brand-divider">
      <img id="profile-photo-preview" src="{{ $admin->profile_photo ?? asset('assets/icons/default-profile-photo.jpg') }}" alt="Profile Picture" class="w-35 aspect-square rounded-lg">
      <div class="gap-1 flex flex-col items-center sm:items-start text-center sm:text-start">
        <p class="text-2xl font-semibold text-brand-gradient-300">Profile Photo</p>
        <p class="w-auto sm:w-70 mb-4 text-xs text-brand-text-secondary">Upload a professional photo. Recommended size is 400x400 px. PNG or JPG only.</p>
        <div class="gap-7 flex flex-col sm:flex-row items-center">
          <div class="gradient-bg px-7 py-2 relative text-center text-white rounded-lg cursor-pointer hover:scale-105">
            <input id="profile_photo" name="profile_photo" type="file" class="w-full h-full absolute top-0 left-0 opacity-0 cursor-pointer" accept="image/png, image/jpeg" />
            <p class="text-sm font-semibold">Edit Photo</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="w-full">
      <p class="mb-5 gap-5 flex flex-row items-center text-xl font-bold text-brand-gradient-200"><i class="fa-regular fa-user"></i>Personal Information</p>
      <div class="p-10 gap-7 flex flex-col bg-slate-100 rounded-xl shadow-stone-300 shadow-sm">
        <label class="gap-2 flex flex-col text-xs text-brand-text-primary uppercase font-bold tracking-wider">
          <p>Full Name <span class="text-red-500">*</span></p>
          <input name="full_name" type="text" value="{{ old('full_name') ?? $admin->full_name }}" placeholder="Enter your full name..." class="p-4 text-sl font-normal rounded-lg bg-white border-2 border-brand-divider outline-0">
        </label>
        <label class="gap-2 flex flex-col text-xs text-brand-text-primary uppercase font-bold tracking-wider">
          <p>Email <span class="text-red-500">*</span></p>
          <input name="email" type="text" value="{{ old('email') ?? $admin->email }}" placeholder="acoount@gmail.com" class="p-4 text-sl font-normal rounded-lg bg-white border-2 border-brand-divider outline-0">
        </label>
        <div class="gap-2 flex flex-col text-xs text-brand-text-primary uppercase font-bold tracking-wider">
          <label class="flex flex-row items-center gap-2">
            Position
            <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select name="position_id" class="w-full pl-5 py-4 bg-white border-2 border-brand-divider text-brand-text-tertiary font-normal text-sl rounded-xl outline-0 appearance-none cursor-pointer">
              <option value="" disabled>Select a Position<i class="fa-solid fa-angle-down"></i></option>
              @foreach($positions as $pos)
                <option value="{{ $pos->id }}" {{ old('position_id') ?? $admin->position->id == $pos->id ? 'selected' : '' }}>
                  {{ $pos->position }}
                </option>
              @endforeach
            </select>
            <div class="absolute inset-y-6 right-4 flex items-center pointer-events-none text-brand-text-secondary">
              <i class="fa-solid fa-angle-down"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="w-full">
      <p class="mb-5 gap-5 flex flex-row items-center text-xl font-bold text-brand-gradient-200">
        <i class="fa-solid fa-key"></i>Account Security
      </p>
      <div class="p-10 gap-7 flex flex-col bg-slate-100 rounded-xl shadow-stone-300 shadow-sm">
        <label class="w-full gap-2 flex flex-col text-xs text-brand-text-primary uppercase font-bold tracking-wider">
          Current Password
          <div class="w-full p-4 flex flex-row text-sl font-normal rounded-lg bg-white border-2 border-brand-divider outline-0">
            <input name="current_password" type="password" placeholder="Current Password" class="password-input w-full bg-transparent outline-0">
            <button type="button" class="toggle-password mr-4 text-brand-text-primary hover:text-brand-gradient-300 transition-colors cursor-pointer">
              <i class="toggle-password-icon fa-solid fa-eye-slash fa-lg"></i>
            </button>
          </div>
        </label>
        <label class="w-full gap-2 flex flex-col text-xs text-brand-text-primary uppercase font-bold tracking-wider">
          New Password
          <div class="w-full p-4 flex flex-row text-sl font-normal rounded-lg bg-white border-2 border-brand-divider outline-0">
            <input name="password" type="password" placeholder="New Password" class="password-input w-full bg-transparent outline-0">
            <button type="button" class="toggle-password mr-4 text-brand-text-primary hover:text-brand-gradient-300 transition-colors cursor-pointer">
              <i class="toggle-password-icon fa-solid fa-eye-slash fa-lg"></i>
            </button>
          </div>
        </label>
        <label class="w-full gap-2 flex flex-col text-xs text-brand-text-primary uppercase font-bold tracking-wider">
          Confirm New Password
          <div class="w-full p-4 flex flex-row text-sl font-normal rounded-lg bg-white border-2 border-brand-divider outline-0">
            <input name="confirm_new_password" type="password" placeholder="Confirm New Password" class="password-input w-full bg-transparent outline-0">
            <button type="button" class="toggle-password mr-4 text-brand-text-primary hover:text-brand-gradient-300 transition-colors cursor-pointer">
              <i class="toggle-password-icon fa-solid fa-eye-slash fa-lg"></i>
            </button>
          </div>
        </label>
      </div>
    </div>

    <div class="w-full gap-2 flex flex-col sm:flex-row justify-end">
      <button id="cancel_admin_edit_profile" class="max-w-80 px-6 py-3 font-semibold bg-transparent hover:text-brand-gradient-200 cursor-pointer">Cancel</button>
      <button type="submit" class="max-w-80 px-10 py-3 font-semibold text-white rounded-md gradient-bg hover:scale-105 shadow cursor-pointer">Save Changes</button>
    </div>
  </form>
</div>

@vite(['resources/js/linked/toggle_js.js', 'resources/js/admin/edit_profile_js.js'])

@endsection