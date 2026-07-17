@extends('layouts.base')

@section('content')

<div id="manage-members-section" class="fade-in-effect min-h-screen gap-10 flex flex-col justify-start items-center bg-white">
  <div class="w-full gap-5 md:gap-0 flex flex-col md:flex-row justify-between items-center">
    <div class="w-auto gap-2 flex flex-col text-center md:text-start">
      <p class="mb-5 md:mb-0 text-xs text-brand-text-primary uppercase font-semibold tracking-widest">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="hover:text-brand-gradient-200">Admin</a> 
        <i class="mx-1 text-xs text-brand-text-secondary/70 fa-solid fa-angle-right"></i> 
        <a href="{{ route('admin.manage-members') }}" wire:navigate class="hover:text-brand-gradient-200">Manage Members</a>
      </p>
      <h1 class="text-3xl font-bold">Manage Members</h1>
      <p class="w-full md:w-90 text-sl text-brand-text-secondary">Oversee the editorial board and contributing research coordinators of the LSO Psychology Club.</p>
    </div>
    <a href="{{ route('admin.new-member-form') }}" wire:navigate class="px-6 py-3 text-sl text-white font-semibold bg-brand-text-tertiary hover:bg-brand-gradient-200 transition-colors rounded-xl cursor-pointer">
      <i class="mr-4 fa-solid fa-user-plus"></i>
      Add New Members
    </a>
  </div>

  <div class="w-full flex flex-col">
    <form action="{{ url()->current() }}" method="GET" class="w-full mb-5 flex justify-between items-center">
      <h1 class="text-2xl font-bold">Members</h1>
      <div class="relative max-w-xs">
        <select id="filter" name="sort" onchange="this.form.submit()" class="pl-5 pr-15 py-3 bg-white border-2 border-brand-divider text-brand-text-tertiary text-sl rounded-xl outline-0 appearance-none cursor-pointer">
          <option value="" selected disabled>Filter</option>
          <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Recently Created</option>
          <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest Created</option>
          <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>A-Z (Nama)</option>
          <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Z-A (Nama)</option>
          <option value="position_asc" {{ request('sort') == 'position_asc' ? 'selected' : '' }}>A-Z (Jabatan)</option>
          <option value="position_desc" {{ request('sort') == 'position_desc' ? 'selected' : '' }}>Z-A (Jabatan)</option>
        </select>
        <div class="absolute inset-y-6 right-4 flex items-center pointer-events-none text-brand-text-secondary">
          <i class="fa-solid fa-angle-down"></i>
        </div>
      </div>
    </form>

    @if ($members->isEmpty())
    <div class="w-full mt-30 text-center text-base text-brand-text-secondary">
      No members found
    </div>
    @else
    <div class="w-full block bg-white border border-brand-divider rounded-t-lg shadow-sm overflow-x-auto">
      <table class="w-full border border-brand-divider text-left">
        <thead class="bg-stone-200 border-b border-brand-divider">
          <tr>
            <th class="min-w-90 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Members</th>
            <th class="min-w-40 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Position</th>
            <th class="min-w-30 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Join Date</th>
            <th class="min-w-20 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-brand-divider">
          @foreach ($members as $member)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="gap-6 flex items-center">
                  <img src="{{ $member->profile_photo }}" class="w-14 h-14 rounded-full border border-brand-divider" alt="Avatar">
                  <div class="flex flex-col">
                    <p class="text-sl font-medium text-brand-text-tertiary">{{ str($member->full_name)->limit(30) }}</p>
                    <p class="text-xs text-brand-text-secondary">{{ $member->email }}</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-sl text-brand-text-tertiary whitespace-nowrap">
                {{ (request('sort') == 'position_asc' || request('sort') == 'position_desc') ? $member->position : $member->position->position }}
              </td>
              <td class="px-6 py-4 text-sl text-brand-text-tertiary whitespace-nowrap">{{ $member->join_date->format('Y-m-d') }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="gap-5 flex items-center text-brand-text-secondary">
                  <a href="{{ route('admin.edit-member-profile-form', ['id' => $member->id]) }}" wire:navigate>
                    <i class="hover:text-amber-500 transition-colors cursor-pointer fa-lg fa-solid fa-pen-to-square"></i>
                  </a>
                  <form action="{{ route('admin.delete-member', ['id' => $member->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this member?')" class="hover:text-red-500 transition-colors cursor-pointer" >
                      <i class="fa-lg fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @if ($members->lastPage() > 1)
        <div class="w-full px-6 py-4 flex items-center justify-between bg-white border border-brand-divider rounded-b-lg shadow-sm">
          {{ $members->links() }}
        </div>
      @endif  
    </div>
    @endif
  </div>
</div>

@endsection