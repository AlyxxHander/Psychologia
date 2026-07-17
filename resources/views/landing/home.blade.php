@extends('layouts.base')

@section('title', 'Landing Page - Home')

@section('content')

<div class="h-auto bg-white">
  <div id="hero-section" class="wobble-fade-in-effect min-h-[89vh] sm:pt-30 xl:pt-0 px-0 lg:px-20 2xl:px-50 flex flex-col xl:flex-row justify-center xl:justify-between items-center ">
    <div class="w-full gap-8 flex flex-col justify-center items-center xl:items-start text-center xl:text-start">
      <p class="px-5 py-2 text-center text-xs text-white font-semibold tracking-wider bg-brand-gradient-300 rounded-full">MENTAL WELLNESS COMMUNITY</p>
      <h1 class="text-5xl font-semibold text-black">
        Get to 
        <span class="block mt-3 text-brand-gradient-200">Know Us</span>
      </h1>
      <p class="w-full sm:w-4/5 text-brand-text-primary">
        A warm and inclusive space for self-exploration and psychological literacy, dedicated to empowering every individual's growth.
      </p>
      <a href="{{ route('landing.contact-us') }}" wire:navigate class="btn gradient-bg hover:scale-105 px-13 py-3">Join Now</a>
    </div>
    <div class="w-full mt-0 sm:mt-10 hidden sm:flex sm:flex-col sm:items-center">
      {{-- IMAGES --}}
      <img src="{{ asset('assets/images/hero-img1.jpg') }}" alt="Hero Image" class="max-w-150 sm:w-150 rotate-2 object-cover rounded-4xl"/>
      <div class="w-100 px-8 py-4 gap-2 flex flex-col justify-start items-start relative bottom-20 -left-30 -rotate-1 bg-white border-l-11 border-l-brand-gradient-200 opacity-90 rounded-4xl shadow-2xl">
        <div class="gap-3 flex flex-row justify-start items-center ">
          <img src="{{ asset('assets/icons/favorite-icon.png') }}" alt="Heart Icon" class="h-10 object-cover" />
          <p class="text-lg font-semibold">60+ Active Members</p>
        </div>
        <p class="w-4/5 text-sl text-brand-text-primary font-thin">
          Growing together within a supportive and educational community
        </p>
      </div>
    </div>
  </div>
</div>

<div class="h-auto bg-brand-main-bg">
  <div id="about-us-section" class="invisible min-h-screen px-0 lg:px-20 2xl:px-50 py-30 lg:py-20 gap-y-30 lg:gap-10 relative flex flex-col lg:flex-row justify-center lg:justify-between items-center">
    <div class="w-full mb-10 gap-3 hidden sm:flex sm:flex-row sm:justify-center sm:items-center">
      <img src="{{ asset('assets/images/about-us-img1.jpg') }}" alt="About Us Image 1" class="w-50 object-cover border-5 border-white shadow-2xl rounded-4xl"/>
      <img src="{{ asset('assets/images/about-us-img3.jpg') }}" alt="About Us Image 2" class="w-70 absolute top-17 lg:top-2/9 z-2 object-cover border-5 border-white shadow-2xl rounded-4xl"/>
      <img src="{{ asset('assets/images/about-us-img2.jpg') }}" alt="About Us Image 3" class="w-50 object-cover border-5 border-white shadow-2xl rounded-4xl"/>
    </div>

    <div class="w-full gap-10 flex flex-col justify-center items-center lg:items-start">
      <p class="px-5 py-2 text-center text-xs text-white font-semibold tracking-wider bg-brand-gradient-300 rounded-full">ABOUT THE PSYCHOLOGY CLUB</p>
      <h1 class="text-5xl font-bold text-black">About Us</h1>
      <p class="w-5/6 text-[1rem] text-brand-text-tertiary text-center lg:text-start">
        LSO Psychology Club is a student led organization dedicated to developing interests and talents in applied psychology. We believe that mental health is not merely about healing, but also about proactive growth.
      </p>
      <div class="gap-5 sm:gap-15 flex flex-col sm:flex-row justify-between items-center text-center sm:text-start">
        <p class="text-2xl text-brand-gradient-300 font-bold">2023<span class="block text-xs font-thin text-brand-text-primary">FOUNDED</span></p>
        <p class="text-2xl text-brand-gradient-300 font-bold">13<span class="block text-xs font-thin text-brand-text-primary">LEAD TEAM</span></p>
        <p class="text-2xl text-brand-gradient-300 font-bold">60+<span class="block text-xs font-thin text-brand-text-primary">MEMBERS</span></p>
      </div>
    </div>
  </div>
</div>

<!-- id="vision-mission-section" --> 
<div class="h-auto bg-white">
  <div class="invisible min-h-screen px-0 lg:px-20 2xl:px-50 py-20 gap-15 flex flex-col justify-center items-center">
    <div class="flex flex-col items-stretch text-center">
      <h1 class="text-4xl font-bold">Our Vision & Mission</h1>
      <p class="text-lg">The essential pillars behind every movement of the LSO Psychology Club</p>
    </div>

    <div class="h-full gap-y-10 lg:gap-20 flex flex-col lg:flex-row justify-between items-center lg:items-stretch">
      <div class="w-full sm:w-2/4 min-h-[53vh] p-10 rounded-2xl border border-stone-300 shadow-2xl">
        <img src="{{ asset('assets/icons/vision-icon.svg') }}" alt="Vision Icon" class="h-12 mb-5 object-cover" />
        <h2 class="mb-8 text-2xl font-bold">Our Vision</h1>
        <p class="text-[1rem]">
          {{ $vision->content }}
        </p>
      </div>

      <div class="w-full sm:w-2/4 min-h-[53vh] p-10 rounded-2xl border border-stone-300 shadow-2xl">
        <img src="{{ asset('assets/icons/mission-icon.svg') }}" alt="Mission Icon" class="h-12 mb-5 object-cover" />
        <h2 class="mb-8 text-2xl font-bold">Our Mission</h1>
        <ol class="gap-6 flex flex-col">
          @foreach ($missions as $mission)
            <li class="gap-2 lg:gap-6 flex flex-col lg:flex-row text-xl text-brand-gradient-200 font-bold">
              {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}.
              <span class="text-[1rem] text-brand-text-tertiary font-normal">
                {{ $mission->content }}
              </span>
            </li>
          @endforeach
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="h-auto bg-brand-main-bg">
  <div id="news-section" class="invisible min-h-screen px-0 lg:px-20 2xl:px-50 py-20 flex flex-col justify-center items-center">
    <div class="mb-15 flex flex-col items-center">
      <p class="text-sm font-thin ">STEPS TOWARDS MENTAL FITNESS</p>
      <h1 class="text-4xl font-bold">Our latest news & articles!</h1>
    </div>

    <div class="w-full h-full mb-8 gap-10 flex flex-wrap justify-center items-stretch">
      @foreach($recentArticles as $article)
      <div class="w-full max-w-80 p-5 gap-4 flex flex-col justify-between bg-white rounded-2xl shadow-2xl">
        <div class="gap-2 flex flex-col">
          <img src="{{ $article->thumbnail_photo }}" alt="Article Thumbnail" class="mb-4 aspect-video sm:aspect-square object-cover rounded-2xl w-full"/>
          <p class="text-brand-gradient-200 font-semibold">
            {{ $article->category->category }}
          </p>
          <h2 class="text-xl font-bold leading-tight ">
            {{ str($article->title)->limit(55) }}
          </h2>
          <p class="text-brand-text-secondary text-sm text-justify">
            {{ strip_tags(str($article->content)->limit(110)) }}
          </p>
        </div>
        <div class="pt-4 gap-y-3 flex flex-col sm:flex-row justify-between items-center border-t-2 border-brand-divider">
          <a href="{{ route('landing.news_detail', ['title' => Str::slug($article->title, '-'), 'id' => $article->id]) }}" wire:navigate class="font-semibold text-sm transition-all duration-300 text-brand-gradient-200 hover:text-brand-gradient-300 hover:underline">Read More ➔</a>
          <p class="text-sm text-brand-text-secondary">{{ $article->created_at->diffForHumans() }}</p>
        </div>
      </div>
      @endforeach
    </div>
    <p class="font-thin">Stay connected with our movement and latest programs. <a href="{{ route('landing.news-catalog') }}" wire:navigate class="font-bold underline cursor-pointer hover:text-brand-gradient-200">Discover More</a></p>
  </div>
</div>

<!-- id="team-section" -->
<div class="h-auto bg-white">
  <div class="invisible h-auto px-0 lg:px-20 2xl:px-50 py-20 gap-7 flex flex-col justify-center items-center text-center">
    <h1 class="text-4xl font-bold">
      Meet Our Team
      <span class="block text-brand-text-primary">Empathetic. Innovative. Collaborative.</span>
    </h1>
    <p class="max-w-3/5">Driven by a passion for contributing to mental health and psychological science, we collaborate to create a tangible impact for students and society.</p>
    <div id="our-team-container" class="flex flex-col justify-center">
      @if($director)
      <div class="mb-5 p-0 sm:p-5 gap-1 flex flex-col justify-center items-center">
        <img src="{{ $director->profile_photo ??  asset('assets/teams/default-profile.png') }}" alt="Director Profile" class="max-h-35 mb-4 aspect-square object-cover"/>
        <p class="text-lg font-bold">{{ $director->full_name }}</p>
        <p class="text-sm font-thin">{{ $director->position->position }}</p>
      </div>
      @endif
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 justify-center items-start">
        @foreach($members as $member)
        <div class="p-0 sm:p-5 gap-1 flex flex-col justify-center items-center">
          <img src="{{ $member['profile_photo'] ?? asset('assets/teams/default-profile.png') }}" alt="{{ $member['position'] }}" class="max-h-35 mb-4 aspect-square object-cover"/>
          <p name="team-name" class="text-lg font-bold">{{ $member->full_name }}</p>
          <p name="team-position" class="text-sm font-thin">{{ $member->position->position }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="h-auto " style="background-image: url('{{ asset('assets/images/contact-us-bg.jpg') }}');">
  <div id="contact-us-section" class="invisible h-auto w-full px-0 lg:px-20 2xl:px-50 py-20 gap-7 lg:gap-20 flex flex-col lg:flex-row justify-center items-center text-center lg:text-start">
    <video class="w-3/5 lg:max-h-[40vh] object-cover rounded-2xl" autoplay muted loop playsinline>
      <source src="{{ asset('assets/video/warm-welcome-video.mp4') }}" type="video/mp4">
    </video>
    <div class="gap-5 flex flex-col items-center lg:items-start text-white">
      <p>WE MAKE A DIFFERENCE</p>
      <h1 class="text-4xl font-bold text-white">Join us in building a supportive psychological community where your voice and well-being matter.</h1>
      <a href="{{ route('landing.contact-us') }}" wire:navigate class="btn px-6 py-2 text-white border border-white bg-transparent hover:text-brand-gradient-200 hover:bg-white transition-colors">Contact Us</a>
    </div>
  </div>
</div>


@livewireScripts

@endSection