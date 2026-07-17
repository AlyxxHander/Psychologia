@extends('layouts.base')

@section('title', 'News Catalog')

@section('content')

<div class="min-h-screen">
  <div id="news-section">
    <div class="fade-in-effect w-full px-0 md:px-20 2xl:px-50 pt-10">
      <div class="pb-3 gap-5 flex flex-col lg:flex-row justify-between items-center border-b-2 border-b-brand-text-tertiary text-center lg:text-start">
        <div class="w-full lg:w-auto flex flex-col items-center lg:items-start">
          <h1 class="mb-7 sm:mb-3 font-normal text-black text-4xl">
            <span class="font-extrabold">PC</span>
            News
          </h1>
          {{-- <div class="gap-5 flex flex-row flex-wrap sm:flex-nowrap justify-center sm:justify-start items-center sm:items-start text-sl">
            <a href="" class="hover:text-brand-gradient-200 cursor-pointer">Event & Bulletin</a>
            <a href="" class="hover:text-brand-gradient-200 cursor-pointer">Organization Update</a>
            <a href="" class="hover:text-brand-gradient-200 cursor-pointer">Upcoming Events</a>
          </div> --}}
        </div>
        <div class="w-full max-w-85 mb-5 lg:mb-0 gap-2 hidden sm:flex flex-row items-center border border-gray-300 rounded-full bg-brand-main-bg text-brand-text-tertiary">
          <i class="ml-5 fa-lg fa-solid fa-magnifying-glass"></i>
          <input id="search-field" class="input-field-transparent" type="text" name="search" placeholder="Search" />
        </div>
      </div>
    </div>

    @if ($latestArticles->isEmpty() && $recentArticles->isEmpty() && $pinnedArticles->isEmpty())
      <div class="fade-in-effect w-full mt-20 flex justify-center items-center">
        <p class="text-lg text-gray-500">No news have been created</p>
      </div>
    @else
      @if ($latestArticles->isNotEmpty())
        <div id="main-news-section" class="fade-in-effect px-0 md:px-20 2xl:px-50 py-10 flex flex-col justify-start items-center">
          <div class="gap-5 grid grid-cols-1 lg:grid-cols-2">
            <div class="relative">
              <img src="{{ $latestArticles->first()->thumbnail_photo }}" alt="News Image" class="w-full object-cover aspect-square brightness-70"/>
              <label class="px-4 py-2 absolute top-3 left-3 bg-brand-main-bg text-brand-text-tertiary font-bold rounded-full shadow-lg">News</label>
              <div class="absolute bottom-3 left-3 gap-3 flex flex-col text-white">
                <a href="{{ route('landing.news_detail', ['title' => Str::slug($latestArticles->first()->title, '-'), 'id' => $latestArticles->first()->id]) }}" class="w-full text-lg md:text-2xl font-bold hover:text-brand-gradient-100 cursor-pointer">
                  {{ str($latestArticles->first()->title)->limit(90) }}
                </a>
                <div class="gap-3 flex flex-row items-center text-sm">
                  <i class="fa-regular fa-clock text-white"></i>
                  <p>{{ $latestArticles->first()->created_at->diffForHumans() }}</p>
                </div>
              </div>
            </div>
            
            <div class="gap-5 grid grid-cols-1 md:grid-cols-2 justify-between items-center">
              @foreach ($latestArticles as $latestArticle)
                @if ($loop->first) 
                  @continue
                @endif
                <div class="w-full relative">
                  <img src="{{ $latestArticle->thumbnail_photo }}" alt="News Image" class="w-full aspect-square object-cover brightness-70"/>
                  <label class="px-4 py-2 absolute top-3 left-3 bg-brand-main-bg text-brand-text-tertiary font-bold rounded-full shadow-lg">News</label>
                  <div class="px-0 sm:px-3 absolute bottom-3 gap-3 flex flex-col text-white">
                    <a href="{{ route('landing.news_detail', ['title' => Str::slug($latestArticle->title, '-'), 'id' => $latestArticle->id]) }}" class="w-full text-sm sm:text-base lg:max-xl:text-xs font-bold hover:text-brand-gradient-100 cursor-pointer">
                    {{ str($latestArticle->title)->limit(75) }}
                  </a>
                  <div class="gap-3 flex flex-row items-center text-sm lg:max-xl:text-xs">
                    <i class="fa-regular fa-clock text-white"></i>
                    <p>{{ $latestArticle->created_at->diffForHumans() }}</p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      @endif

      <div id="pinned-news-section" class="invisible px-0 md:px-20 2xl:px-50 py-10 flex flex-col justify-start items-center">
        @if ($pinnedArticles->isEmpty())
          <div class="w-full mt-20 flex justify-center items-center">
            <p class="text-lg text-gray-500">No Pinned Article found</p>
          </div>
        @else
          <div class="w-full px-0 sm:px-18 lg:px-0 gap-5 grid grid-cols-1 lg:grid-cols-3 items-center">
            @foreach ($pinnedArticles as $pinnedArticle)
              <div class="relative">
                <img src="{{ $pinnedArticle->thumbnail_photo }}" alt="News Image" class="w-full object-cover brightness-70"/>
                <label class="px-4 py-2 absolute top-3 left-3 bg-brand-main-bg text-brand-text-tertiary font-bold rounded-full shadow-lg">Pinned News</label>
                <div class="px-0 sm:px-3 absolute bottom-3 gap-3 flex flex-col text-white">
                  <a href="{{ route('landing.news_detail', ['title' => Str::slug($pinnedArticle->title, '-'), 'id' => $pinnedArticle->id]) }}" class="w-full text-sm sm:text-base lg:max-xl:text-xs font-bold hover:text-brand-gradient-100 cursor-pointer">{{ str($pinnedArticle->title)->limit(120) }}</a>
                  <div class="gap-3 flex flex-row items-center text-sm lg:max-xl:text-xs">
                    <i class="fa-regular fa-clock text-white"></i>
                    <p>{{ $pinnedArticle->created_at->diffForHumans() }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>

      @if ($recentArticles->isNotEmpty())
        <div id="sub-news-section" class="invisible px-0 md:px-20 2xl:px-50 py-10 flex flex-col justify-start">
          <div class="gap-20 lg:gap-10 flex flex-col">
            @foreach ($recentArticles as $recentArticle)
            <div class="px-0 sm:px-18 lg:px-0 gap-6 flex flex-col lg:flex-row">
              <div class="relative">
                <img src="{{ $recentArticle->thumbnail_photo }}" alt="News Image" class="w-full max-w-full lg:max-w-75 object-cover brightness-70"/>
                <label class="px-4 py-2 absolute top-3 left-3 bg-brand-main-bg text-brand-text-tertiary font-bold rounded-full shadow-lg">News</label>
              </div>
              <div class="w-full lg:w-140 gap-3 flex flex-col justify-between">
                <div class="flex flex-col text-justify">
                  <a href="{{ route('landing.news_detail', ['title' => Str::slug($recentArticle->title, '-'), 'id' => $recentArticle->id]) }}" class="mb-4 text-lg font-extrabold hover:text-brand-gradient-200 cursor-pointer">{{ str($recentArticle->title)->limit(90) }}</a>
                  <p class="text-brand-text-secondary text-sm text-justify">{!! str(strip_tags($recentArticle->content))->limit(300) !!}</p>
                </div>
                <div class="gap-3 flex flex-row items-center">
                  <i class="text-sm fa-regular fa-clock text-black"></i>
                  <p class="text-sm text-brand-text-primary">{{ $recentArticle->created_at->diffForHumans() }}</p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      @endif

      @if ($recentArticles->lastPage() > 1)
        <div class="w-full px-0 md:px-20 2xl:px-50 pb-10 flex items-center justify-between bg-white">
          {{ $recentArticles->links() }}
        </div>
      @endif
    @endif
  </div>
</div>

@vite('resources/js/landing/news_catalog_js.js')

@endsection