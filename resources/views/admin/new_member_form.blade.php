@extends('layouts.base')

@section('content')

<form action="{{ route('admin.add-member') }}" method="POST" enctype="multipart/form-data" id="member-form-section" class="w-full gap-10 flex flex-col justify-start items-center bg-white">
  @csrf
  <div class="w-full gap-2 flex flex-col justify-start items-start text-center sm:text-start">
    <p class="mb-5 sm:mb-0 text-xs text-brand-text-primary uppercase font-semibold tracking-widest">
      <a href="{{ route('admin.dashboard') }}" wire:navigate class="hover:text-brand-gradient-200">Admin</a> 
      <i class="mx-1 text-xs text-brand-text-secondary/70 fa-solid fa-angle-right"></i> 
      <a href="{{ route('admin.manage-members') }}" wire:navigate class="hover:text-brand-gradient-200">Manage Members</a>
      <i class="mx-1 text-xs text-brand-text-secondary/70 fa-solid fa-angle-right"></i> 
      <a href="{{ route('admin.new-member-form') }}" wire:navigate class="hover:text-brand-gradient-200">Add New Member</a>
    </p>
    <div class="gap-2 flex flex-col">
      <h1 class="text-3xl font-bold">Add New Member</h1>
      <p class="w-full sm:w-115 text-sl text-brand-text-secondary">Onboard a new executive member to the LSO Psychology Club editorial team.</p>
    </div>
  </div>

  <div class="w-full max-w-220 gap-10 flex flex-col items-center md:flex-row">
    <div id="member_profile" class="w-full sm:min-w-82 max-w-82 p-10 gap-5 flex flex-col items-center shadow-xl bg-white rounded-2xl border border-brand-divider">
      <div id="preview_container" class="w-full aspect-square flex flex-col gap-1 relative justify-center items-center rounded-xl border-2 border-dashed border-brand-text-secondary bg-stone-200">
        <div id="preview-image-container" class="hidden w-full h-full relative">
          <img src="" id="profile-photo-preview" alt="Profile Photo" class="object-cover absolute top-0 left-0 rounded-lg">
          <button id="remove-preview-btn" class="px-2 py-1 absolute top-3 right-3 rounded-full hover:bg-brand-bg-main bg-red-500 hover:bg-red-700 text-white cursor-pointer" type="button">
            <i class="fa-lg fa-solid fa-xmark"></i>
          </button>
        </div>
        <div id="upload-container" class="gap-1 flex flex-col items-center text-center">
          <i class="mb-5 text-3xl text-brand-text-secondary fa-solid fa-upload"></i>
          <input id="profile-photo-input" name="profile_photo" type="file" accept="image/png, image/jpeg" class="w-full h-full opacity-0 absolute top-0 cursor-pointer"/>
          <label for="profile-photo-input" class="text-sl font-semibold">Upload Photo</label>
        </div>
      </div>
      <div class="gap-1 flex flex-col items-center text-center">
        <label class="gap-2 flex flex-row items-center text-lg text-brand-gradient-300 font-semibold">
          Member Avatar
          <span class="text-red-500">*</span>
        </label>
        <p class="text-sl text-brand-text-secondary">JPG or PNG. Maximum 2MB. Use a professional headshot for the public directory.</p>
      </div>
    </div>

    <div class="w-full p-10 gap-7 flex flex-col shadow-xl bg-slate-100 rounded-2xl border border-brand-divider">
      <div class="gap-2 flex flex-col text-xs text-brand-text-primary uppercase font-bold tracking-wider">
        <label class="flex flex-row items-center gap-2">
          Full Name 
          <span class="text-red-500">*</span>
        </label>
        <input name="full_name" type="text" placeholder="Full Name" value="{{ old('full_name') }}" class="p-4 text-sl font-normal rounded-lg bg-white border-2 border-brand-divider outline-0">
      </div>
      <div class="gap-2 flex flex-col text-xs text-brand-text-primary uppercase font-bold tracking-wider">
        <label class="flex flex-row items-center gap-2">
          Position
          <span class="text-red-500">*</span>
        </label>
        <div class="relative">
          <select name="position_id" class="w-full pl-5 py-4 bg-white border-2 border-brand-divider text-brand-text-tertiary font-normal text-sl rounded-xl outline-0 appearance-none cursor-pointer">
            <option value="" {{ old('position_id') ? 'disabled' : 'selected' }}>Select a Position</option>
            @foreach($positions as $pos)
              <option value="{{ $pos->id }}" {{ old('position_id') == $pos->id ? 'selected' : '' }}>
                {{ $pos->position }}
              </option>
            @endforeach
          </select>
          <div class="absolute inset-y-6 right-4 flex items-center pointer-events-none text-brand-text-secondary">
            <i class="fa-solid fa-angle-down"></i>
          </div>
        </div>
      </div>
      <div class="gap-2 flex flex-col text-xs text-brand-text-primary uppercase font-bold tracking-wider">
        <label class="flex flex-row items-center gap-2">
          Institutional Email
          <span class="text-red-500">*</span>
        </label>
        <input name="email" type="text" placeholder="@umm.acc.id" value="{{ old('email') }}" class="p-4 text-sl font-normal rounded-lg bg-white border-2 border-brand-divider outline-0">
      </div>
      <div class="w-full gap-2 flex flex-col sm:flex-row justify-end">
        {{-- <button class="px-6 py-3 font-semibold bg-transparent hover:text-brand-gradient-200 cursor-pointer">Cancel</button> --}}
        <button type="submit" class="px-10 py-3 font-semibold text-white rounded-md gradient-bg hover:scale-105 shadow cursor-pointer">Add Member</button>
      </div>
    </div>
  </div>
</form>

@vite(['resources/js/admin/new_member_form_js.js', 'resources/js/linked/toggle_js.js'])

@endsection