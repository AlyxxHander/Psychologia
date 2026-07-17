@extends('layouts.base')

@section('content')

<div>
  <div id="news-section">
    <div id="news-detail-section" class="mt-0 mb-20 px-0 lg:px-20 2xl:px-50 flex flex-col justify-center xl:justify-between items-center">
      <div class="fade-in-effect mt-10 mb-10 flex flex-col items-center">
        <div class="mb-3 gap-7 flex flex-col sm:flex-row justify-center items-center">
          <label class="px-4 py-1 rounded-full bg-brand-accent text-sm text-brand-gradient-200 font-bold uppercase">{{ $article->category->category }}</label>
          <label class="bg-transparent text-brand-text-secondary font-semibold uppercase text-xs">{{ $article->created_at->diffForHumans() }}</label>
        </div>
        <h1 class="w-auto md:w-220 mb-7 text-brand-gradient-300 text-lg sm:text-4xl font-bold text-center">{{ $article->title }}</h1>
        <div class="gap-5 flex flex-col sm:flex-row items-center text-center sm:text-start">
          <img id="author-profile" src="{{ $article->author->profile_photo }}" alt="Author Profile Picture" class="w-14 aspect-square"/>
          <div class="text-sl">
            <p class="font-semibold">{{ $article->author->full_name }}</p>
            <p class="text-brand-text-primary">Published {{ $article->created_at->format('M d, Y') }}</p>
          </div>
        </div>
      </div>
      <img src="{{ $article->thumbnail_photo }}" alt="Recent News Image 2" class="fade-in-effect h-auto w-full md:h-130 mb-10 object-cover rounded-2xl"/>
      <div class="w-auto md:w-185 gap-5 flex flex-col text-[1rem] font-thin text-justify">
        <div class="invisible rich-text-content text-base first-letter:mr-4 first-letter:text-7xl first-letter:font-semibold first-letter:float-left">
          {!! $article->content !!}
        </div>
        <div class="invisible pt-5 gap-5 flex flex-col md:flex-row justify-start md:justify-between items-start text-xs text-start border-t-2 border-brand-divider">
          <p class="w-full md:w-65 text-sm text-brand-text-secondary font-semibold uppercase">Categorized Under</p>
          <div class="w-full gap-3 flex flex-wrap justify-start md:justify-end">
            @foreach($article->tags as $tag)
              <p class="px-2 py-1 md:px-5 md:py-2 text-brand-text-primary font-semibold bg-brand-main-bg rounded-xl">{{ $tag }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection