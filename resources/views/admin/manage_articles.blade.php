@extends('layouts.base')

@section('content')

<div id="manage-members-section" class="fade-in-effect min-h-screen gap-10 flex flex-col justify-start items-center bg-white">
  <div class="w-full gap-5 sm:gap-0 flex flex-col sm:flex-row justify-between items-center">
    <div class="w-auto gap-2 flex flex-col text-center sm:text-start">
      <p class="mb-5 sm:mb-0 text-xs text-brand-text-primary uppercase font-semibold tracking-widest">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="hover:text-brand-gradient-200">Admin</a> 
        <i class="mx-1 text-xs text-brand-text-secondary/70 fa-solid fa-angle-right"></i> 
        <a href="{{ route('admin.manage-articles') }}" wire:navigate class="hover:text-brand-gradient-200">Manage Articles</a>
      </p>
      <h1 class="text-3xl font-bold">Manage Articles</h1>
      <p class="w-full sm:w-90 text-sl text-brand-text-secondary">Access and control all published articles within the LSO Psychology section.</p>
    </div>
    <a href="{{ route('admin.article-form') }}" wire:navigate class="px-6 py-3 text-sl text-white font-semibold bg-brand-text-tertiary hover:bg-brand-gradient-200 transition-colors rounded-xl cursor-pointer">
      <i class="mr-4 fa-solid fa-file-circle-plus"></i>
      Add New Articles
    </a>
  </div>

  <div class="w-full flex flex-col">
    <form action="{{ url()->current() }}" method="GET" class="w-full mb-5 flex justify-between items-center">
      <h1 class="text-2xl font-bold">Articles</h1>
      <div class="relative max-w-xs">
        <select id="filter" name="sort" onchange="this.form.submit()" class="pl-5 pr-15 py-3 bg-white border-2 border-brand-divider text-brand-text-tertiary text-sl rounded-xl outline-0 appearance-none cursor-pointer">
          <option value="" selected disabled>Filter</option>
          <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Recently Created</option>
          <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest Created</option>
          <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>A-Z (Judul Artikel)</option>
          <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Z-A (Judul Artikel)</option>
          <option value="status_asc" {{ request('sort') == 'status_asc' ? 'selected' : '' }}>A-Z (Status)</option>
          <option value="status_desc" {{ request('sort') == 'status_desc' ? 'selected' : '' }}>Z-A (Status)</option>
        </select>
        <div class="absolute inset-y-6 right-4 flex items-center pointer-events-none text-brand-text-secondary">
          <i class="fa-solid fa-angle-down"></i>
        </div>
      </div>
    </form>

    @if ($articles->isEmpty())
    <div class="w-full mt-30 text-center text-base text-brand-text-secondary">
      No articles found
    </div>
    @else
    <div class="w-full block bg-white border border-brand-divider rounded-t-lg shadow-sm overflow-x-auto">
      <table class="w-full border border-brand-divider text-left">
        <thead class="bg-stone-200 border-b border-brand-divider">
          <tr>
            <th class="min-w-60 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Articles Details</th>
            <th class="min-w-50 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Author</th>
            <th class="min-w-30 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Status</th>
            <th class="min-w-40 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Date Created</th>
            <th class="min-w-40 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Updated</th>
            <th class="min-w-30 px-6 py-4 text-xs font-bold text-brand-text-primary uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-brand-divider">
          @foreach ($articles as $article)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex flex-col">
                  <p class="text-sl font-medium text-brand-text-tertiary">{!! str($article->title)->limit(25) !!}</p>
                  <p class="text-xs text-brand-text-secondary">{{ $article->category->category }}</p>
                </div>
              </td>
              <td class="px-6 py-4 text-sl text-brand-text-tertiary whitespace-nowrap">
                <div class="gap-5 flex flex-row items-center">
                  <img src="{{ $article->author->profile_photo }}" class="w-13 h-13 rounded-full border border-brand-divider" alt="Avatar">
                  <div class="flex flex-col">
                    <p class="text-sl font-medium text-brand-text-tertiary">{{ $article->author->full_name }}</p>
                    <p class="text-xs text-brand-text-secondary">{{ $article->author->position->position }}</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if ($article->status == 'draft')
                  <span class="px-3 py-1 text-[10px] font-bold shadow shadow-stone-400 uppercase tracking-wider rounded-full bg-blue-50 text-blue-400">
                    Draft
                  </span>
                @elseif ($article->status == 'published')
                  <span class="px-3 py-1 text-[10px] font-bold shadow shadow-stone-400 uppercase tracking-wider rounded-full bg-emerald-50 text-emerald-500">
                    Published
                  </span>
                @elseif ($article->status == 'archived')
                  <span class="px-3 py-1 text-[10px] font-bold shadow shadow-stone-400 uppercase tracking-wider rounded-full bg-amber-50 text-amber-500">
                    Archived
                  </span>
                @endif
              </td>
              <td class="px-6 py-4 text-sl text-brand-text-tertiary whitespace-nowrap">
                {{ $article->created_at->format('d M Y') }}
              </td>
              <td class="px-6 py-4 text-sl text-brand-text-tertiary whitespace-nowrap">
                {{ $article->updated_at->diffForHumans() }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="gap-5 flex items-center text-brand-text-secondary">
                  <a href="{{ route('admin.edit-article-form', ['id' => $article->id]) }}" wire:navigate>
                    <i class="hover:text-amber-500 transition-colors cursor-pointer fa-lg fa-solid fa-pen-to-square"></i>
                  </a>
                  <form action="{{ route('admin.delete-article', ['id' => $article->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this article?')" class="hover:text-red-500 transition-colors cursor-pointer" >
                      <i class="fa-lg fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @if ($articles->lastPage() > 1)
        <div class="w-full px-6 py-4 flex items-center justify-between bg-white border border-brand-divider rounded-b-lg shadow-sm">
          {{ $articles->links() }}
        </div>
      @endif
    </div>
    @endif
  </div>
</div>

@endsection