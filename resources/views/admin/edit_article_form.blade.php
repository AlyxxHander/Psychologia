@extends('layouts.base')

@section('content')

<div id="article-form-section" class="fade-in-effect gap-15 flex flex-col justify-start items-start bg-white">
  <div class="w-full gap-2 flex flex-col justify-start items-start text-center sm:text-start">
    <p class="mb-5 sm:mb-0 text-xs text-brand-text-primary uppercase font-semibold tracking-widest">
      <a href="{{ route('admin.dashboard') }}" wire:navigate class="hover:text-brand-gradient-200">Admin</a>
      <i class="mx-1 text-xs text-brand-text-secondary/70 fa-solid fa-angle-right"></i> 
      <a href="{{ route('admin.manage-articles') }}" wire:navigate class="hover:text-brand-gradient-200">Manage Articles</a>
      <i class="mx-1 text-xs text-brand-text-secondary/70 fa-solid fa-angle-right"></i> 
      <a href="{{ route('admin.article-form') }}" wire:navigate class="hover:text-brand-gradient-200">Edit Article</a>
    </p>
    <div class="gap-2 flex flex-col">
      <h1 class="text-3xl font-bold">Edit Article</h1>
      <p class="w-full sm:w-115 text-sl text-brand-text-secondary">Edit the article according to the changes you want to make.</p>
    </div>
  </div>
  
  <form action="{{ route('admin.update-article', ['id' => $article->id, 'author_id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data" id="new-article-form" class="w-full gap-10 flex flex-col 2xl:flex-row justify-start items-start">
    @csrf
    @method('PUT')
    <div class="w-full 2xl:w-3/5 gap-7 flex flex-col justify-start">
      <input id="article-title" name="title" type="text" value="{{ old('title') ?? $article->title }}" placeholder="Enter Article Title..." class="w-full text-2xl font-semibold outline-0 placeholder:text-brand-text-secondary"/>
      <div id="preview_container" class="w-full h-85 flex flex-col gap-1 relative justify-center items-center rounded-xl border-2 border-dashed border-brand-text-secondary bg-stone-200">
        <div id="thumbnail-preview-container" class="hidden w-full h-full relative overflow-hidden rounded-xl">
          <img src="" id="thumbnail-preview" alt="Profile Photo" class="absolute h-full object-cover">
          <button id="remove-preview-btn" class="px-2 py-1 absolute top-3 right-3 rounded-full hover:bg-brand-bg-main bg-red-500 hover:bg-red-700 text-white cursor-pointer" type="button">
            <i class="fa-lg fa-solid fa-xmark"></i>
          </button>
        </div>
        <div id="upload-container" class="gap-1 flex flex-col items-center text-center">
          <i class="mb-8 text-3xl text-brand-text-secondary fa-solid fa-upload"></i>
          <input id="article-thumbnail-input" name="thumbnail_photo" type="file" accept="image/png, image/jpeg" class="w-full h-full opacity-0 absolute top-0 cursor-pointer"/>
          <label for="article-thumbnail-input" class="mb-5 text-lg font-semibold">Upload Featured Image</label>
          <label for="article-thumbnail-input" class="text-brand-text-secondary flex flex-col items-center">
            <span class="block">Recomended Size: 1660x900 px</span>
            <span class="block">JPG or PNG. Maximum 2MB.</span>
          </label>
        </div>
      </div>

      <div class="pb-5 gap-5 flex flex-col shadow-xl bg-white rounded-2xl border border-brand-divider">
        <div class="w-full flex flex-col gap-2">
          <textarea id="content" name="content" class="h-100">
            {{ old('content') ?? $article->content }}
          </textarea>
        </div>
      </div>
    </div>

    <div class="w-full 2xl:w-2/5 gap-6 flex flex-col">
      <div class="p-7 gap-3 flex flex-col shadow bg-slate-100 rounded-2xl border border-brand-divider">
        <label class="text-sl font-semibold tracking-wider uppercase">
          Research Category
          <span class="text-red-500">*</span>
        </label>
        <div class="relative">
          <select id="article-category" name="category_id" class="w-full pl-5 py-4 bg-white border-2 border-brand-divider text-brand-text-tertiary font-normal text-sl rounded-xl outline-0 appearance-none cursor-pointer">
            <option value="" {{ old('category_id') ? 'disabled' : 'selected' }} disabled>Select Category</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id') ?? $article->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->category }}
              </option>
            @endforeach
          </select>
          <div class="absolute inset-y-6 right-4 flex items-center pointer-events-none text-brand-text-secondary">
            <i class="fa-solid fa-angle-down"></i>
          </div>
        </div>
      </div>

      <div class="p-7 gap-3 flex flex-col shadow bg-slate-100 rounded-2xl border border-brand-divider">
        <label class="text-sl font-semibold tracking-wider uppercase">Author</label>
        <div class="mb-2 p-4 gap-5 flex flex-row justify-start items-center bg-white rounded-lg shadow border border-brand-divider">
          <img src="{{ $article->author->profile_photo }}" alt="Profile Picture" class="w-15 aspect-square rounded-lg">
          <input type="hidden" name="author_id" value="{{ old('author_id') ?? $article->author_id }}">
          <div class="flex flex-col">
            <span class="text-lg font-semibold text-brand-text-tertiary">{{ old('position') ?? $article->author->position->position }}</span>
            <span class="text-sm text-brand-text-secondary">{{ old('email') ?? $article->author->email }}</span>
          </div>
        </div>
      </div>
      <div class="p-7 gap-3 flex flex-col shadow bg-slate-100 rounded-2xl border border-brand-divider">
        <label class="text-sl font-semibold tracking-wider uppercase">
          Tags
          <span class="text-red-500">*</span>
        </label>
        <div id="tags-container" class="flex flex-wrap gap-2"></div>
        <div class="flex flex-row justify-between items-center rounded-lg border border-brand-divider bg-white mt-2">
          <input type="text" id="tag-input" name="new_tag" placeholder="Add Tags..." class="w-full p-4 text-brand-text-tertiary outline-0">
          <button type="button" id="add-tag-btn" class="p-4 text-sl rounded-lg text-brand-text-tertiary font-semibold hover:text-brand-gradient-200 outline-0 cursor-pointer"><i class="fa-solid fa-plus"></i></button>
        </div>
        <input type="hidden" id="tags" name="tags" value="{{ json_encode($article->tags ?? []) }}">
        <input type="hidden" name="last_updated_at" value="{{ $article->updated_at }}">
      </div>

      <div class="p-7 gap-2 flex flex-col shadow rounded-lg border border-brand-divider bg-slate-100">
        <label class="text-base font-semibold tracking-wider uppercase">Visibility</label>
        <div class="w-full p-4 bg-white rounded-lg shadow border border-brand-divider flex flex-row justify-between items-center">
          <label class="text-sl font-semibold">Pin Article</label>
          <label class="toggle-switch">
            <input type="checkbox" name="is_pinned" value="1" {{ old('is_pinned', $article->is_pinned) == 1 ? 'checked' : ''}}>
            <div class="slider"></div>
          </label>
        </div>
        <p class="text-brand-text-secondary text-justify">Toggle on to make this article appear as pinned on the home page.</p>
      </div>

      <div class="gap-2 flex flex-row justify-start">
        <button type="submit" name="status" value="published" class="px-6 py-3 font-semibold text-white rounded-md gradient-bg hover:scale-105 shadow cursor-pointer">Publish</button>
        <button type="submit" name="status" value="archived" class="px-6 py-3 font-semibold bg-transparent hover:text-brand-gradient-200 cursor-pointer">Archive</button>
      </div>
    </div>
  </form>
</div>

@vite(['resources/js/tinymce.js', 'resources/js/admin/new_article_form_js.js'])

@endsection