@extends('layouts.base')

@section('content')

<div id="dashboard-section" class="fade-in-effect min-h-full gap-10 flex flex-col justify-start items-center bg-white">  
  <div class="w-full gap-2 flex flex-col justify-start items-start text-center sm:text-start">
    <p class="w-full mb-5 sm:mb-0 text-xs text-brand-text-primary uppercase font-semibold tracking-widest">
      <a href="{{ route('admin.dashboard') }}" wire:navigate class="hover:text-brand-gradient-200">Admin</a>
    </p>  
    <div class="w-full gap-5 flex flex-col sm:flex-row justify-between items-center">
      <div class="text-center sm:text-start">
        <h1 class="mb-2 text-3xl font-bold">Content Dashboard</h1>
        <p class="text-sl text-brand-text-secondary">Manage, edit and publish your news & blog.</p>
      </div>
      <a href="{{ route('admin.article-form') }}" wire:navigate class="px-6 py-3 text-sl text-white font-semibold bg-brand-text-tertiary hover:bg-brand-gradient-200 transition-colors rounded-xl cursor-pointer">
        <i class="mr-4 fa-solid fa-file-circle-plus"></i>
        Add New Articles
      </a>
    </div>
  </div>
  
  <div class="w-full gap-10 grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 text-center sm:text-start">
    <div class="p-6 gap-7 flex flex-col sm:flex-row justify-center sm:justify-start items-center bg-brand-main-bg rounded-xl">
      <div class="h-15 p-5 aspect-square bg-indigo-50 rounded-xl drop-shadow">
        <i class="text-indigo-700 text-2xl fa-regular fa-file-lines"></i>
      </div>
      <div>
        <p class="mb-1 text-xs text-brand-text-primary font-semibold tracking-wider uppercase">Total Articles</p>
        <p class="text-2xl font-bold">{{ $recentArticles->count() }}</p>
      </div>
    </div>

    <div class="p-6 gap-7 flex flex-col sm:flex-row justify-center sm:justify-start items-center bg-brand-main-bg rounded-xl">
      <div class="h-15 p-5 aspect-square bg-blue-50 rounded-xl drop-shadow">
        <i class="text-blue-400 text-2xl fa-solid fa-file-pen"></i>
      </div>
      <div>
        <p class="mb-1 text-xs text-brand-text-primary font-semibold tracking-wider uppercase">Drafts</p>
        <p class="text-2xl font-bold">{{ $recentArticles->where('status', 'draft')->count() }}</p>
      </div>
    </div>

    <div class="p-6 gap-7 flex flex-col sm:flex-row justify-center sm:justify-start items-center bg-brand-main-bg rounded-xl">
      <div class="h-15 p-5 aspect-square bg-green-50 rounded-xl drop-shadow">
        <i class="text-emerald-500 text-2xl fa-regular fa-square-check"></i>
      </div>
      <div>
        <p class="mb-1 text-xs text-brand-text-primary font-semibold tracking-wider uppercase">Published</p>
        <p class="text-2xl font-bold">{{ $recentArticles->where('status', 'published')->count() }}</p>
      </div>
    </div>

    <div class="p-6 gap-7 flex flex-col sm:flex-row justify-center sm:justify-start items-center bg-brand-main-bg rounded-xl">
      <div class="h-15 p-5 aspect-square bg-orange-50 rounded-xl drop-shadow">
        <i class="text-orange-500 text-2xl fa-solid fa-folder-open"></i>
      </div>
      <div>
        <p class="mb-1 text-xs text-brand-text-primary font-semibold tracking-wider uppercase">Archieved</p>
        <p class="text-2xl font-bold">{{ $recentArticles->where('status', 'archived')->count() }}</p>
      </div>
    </div>
  </div>

  <div class="w-full gap-5 flex flex-col">
    <h1 class="text-2xl font-bold">Recent Articles</h1>

    @if ($recentArticles->isEmpty())
      <div class="w-full mt-20 text-center text-base text-brand-text-secondary">
        No articles found
      </div>
    @else
      <div class="w-full block bg-white border border-brand-divider rounded-lg shadow-sm overflow-x-auto">
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
          <tbody class="divide-brand-divider">
            @foreach ($recentArticles as $article)
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
        <div class="px-6 py-4 flex items-center justify-between border-t border-brand-divider bg-stone-50">
          {{ $recentArticles->links() }}
        </div>
      </div>
    @endif
  </div>
</div>

@endsection