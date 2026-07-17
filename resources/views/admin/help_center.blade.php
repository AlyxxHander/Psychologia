@extends('layouts.base')

@section('content')

<div id="help-center-section" class="fade-in-effect min-h-full gap-10 flex flex-col justify-start items-center bg-white">
  <div class="w-full gap-2 flex flex-col justify-start items-start text-center sm:text-start">
    <p class="mb-5 sm:mb-0 text-xs text-brand-text-primary uppercase font-semibold tracking-widest">
      <a href="{{ route('admin.dashboard') }}" wire:navigate class="hover:text-brand-gradient-200">Admin</a> 
      <i class="mx-1 text-xs text-brand-text-secondary/70 fa-solid fa-angle-right"></i> 
      <a href="{{ route('admin.help-center') }}" wire:navigate class="hover:text-brand-gradient-200">Help Center</a>
    </p>
    <div class="gap-2 flex flex-col">
      <h1 class="text-3xl font-bold">Help Center</h1>
      <p class="text-sl text-brand-text-secondary">Help Center for Admin Psychology Club</p>
    </div>
  </div>

  <div id="admin-general-faq-section" class="w-full gap-10 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 justify-between items-start">
    <div class="w-full lg:w-80 gap-5 flex flex-col items-center lg:items-start text-center lg:text-start">
      <div class="w-14 aspect-square flex justify-center items-center gradient-bg rounded-lg text-2xl"><i class="fa-regular fa-file-lines"></i></div>
      <h1 class="w-full sm:w-60 mb-2 text-2xl font-bold text-brand-gradient-300">Manajemen Article (News & Blog)</h1>
      <div class="w-full mb-10 lg:mb-0 gap-5 flex flex-col justify-between items-center">
        @foreach ($faqs as $faq)
          @if ($faq->type->value === 'articles')
          <div class="faq-container w-full max-w-150 flex flex-col justify-between text-brand-text-tertiary hover:text-brand-gradient-200 rounded-2xl drop-shadow-stone-400/60 drop-shadow transition-all duration-300 cursor-pointer">
            <div class="faq-question px-5 py-2 flex flex-row justify-between items-center bg-brand-main-bg rounded-xl">
              <label class="mr-5 font-semibold text-sl cursor-pointer">{{ $faq['question'] }}</label>
              <button class="dropdown-toggle mb-2 font-bold text-xl cursor-pointer">
                <i class="fa-solid fa-angle-down transition-all duration-200"></i>
              </button>
            </div>
            <div class="faq-content hidden px-5 py-3 bg-brand-main-bg brightness-93 rounded-b-xl">
              <p class="text-brand-text-primary text-start whitespace-pre-line">{{ preg_replace('/(?<!^)(\d+\))/', "\n$1", $faq['answer']) }}</p>
            </div>
          </div>
          @endif
        @endforeach
      </div>
    </div>

    <div class="w-full lg:w-80 gap-5 flex flex-col items-center lg:items-start text-center lg:text-start">
      <div class="w-14 aspect-square flex justify-center items-center gradient-bg rounded-lg text-xl"><i class="fa-solid fa-user-plus"></i></div>
      <h1 class="w-full sm:w-70 mb-2 text-2xl font-bold text-brand-gradient-300">Manajemen Anggota (Member Directory)</h1>
      <div class="w-full mb-10 lg:mb-0 gap-5 flex flex-col justify-between items-center">
        @foreach ($faqs as $faq)
          @if ($faq->type->value === 'member_managements')
            <div class="faq-container w-full max-w-150 flex flex-col justify-between text-brand-text-tertiary hover:text-brand-gradient-200 rounded-2xl drop-shadow-stone-400/60 drop-shadow transition-all duration-300 cursor-pointer">
              <div class="faq-question px-5 py-2 flex flex-row justify-between items-center bg-brand-main-bg rounded-xl">
                <label class="mr-5 font-semibold text-sl cursor-pointer">{{ $faq['question'] }}</label>
                <button class="dropdown-toggle mb-2 font-bold text-xl cursor-pointer">
                  <i class="fa-solid fa-angle-down transition-all duration-200"></i>
                </button>
              </div>
              <div class="faq-content hidden px-5 py-3 bg-brand-main-bg brightness-93 rounded-b-xl">
                <p class="text-brand-text-primary text-start whitespace-pre-line">{{ preg_replace('/(?<!^)(\d+\))/', "\n$1", $faq['answer']) }}</p>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>

    <div class="w-full lg:w-80 gap-5 flex flex-col items-center lg:items-start text-center lg:text-start">
      <div class="w-14 aspect-square flex justify-center items-center bg-blue-100 rounded-lg text-brand-text-primary text-2xl"><i class="fa-solid fa-lock"></i></div>
      <h1 class="w-full sm:w-70 mb-2 text-2xl font-bold text-brand-gradient-300">Akun & Keamanan (Account Safety)</h1>
      <div class="w-full mb-10 lg:mb-0 gap-5 flex flex-col justify-between items-center">
        @foreach ($faqs as $faq)
          @if ($faq->type->value === 'account_safety')
            <div class="faq-container w-full max-w-150 flex flex-col justify-between text-brand-text-tertiary hover:text-brand-gradient-200 rounded-2xl drop-shadow-stone-400/60 drop-shadow transition-all duration-300 cursor-pointer">
              <div class="faq-question px-5 py-2 flex flex-row justify-between items-center bg-brand-main-bg rounded-xl">
                <label class="mr-5 font-semibold text-sl cursor-pointer">{{ $faq->question }}</label>
                <button class="dropdown-toggle mb-2 font-bold text-xl cursor-pointer">
                  <i class="fa-solid fa-angle-down transition-all duration-200"></i>
                </button>
              </div>
              <div class="faq-content hidden px-5 py-3 bg-brand-main-bg brightness-93 rounded-b-xl">
                <p class="text-brand-text-primary text-start whitespace-pre-line">{{ preg_replace('/(?<!^)(\d+\))/', "\n$1", $faq['answer']) }}</p>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div id="admin-quick-faqs-section" class="admin-fade-in-effect w-full px-0 py-10 gap-5 flex flex-col items-center">
    <h1 class="mb-2 text-2xl font-bold text-brand-gradient-300">Quick FAQ</h1>
    <div class="w-full mb-10 lg:mb-0 gap-5 flex flex-col justify-between items-center">
      @foreach ($faqs as $faq)
        @if ($faq->type->value === 'quick_faqs')
          <div class="faq-container w-full max-w-150 lg:max-w-full flex flex-col justify-between text-brand-text-tertiary hover:text-brand-gradient-200 rounded-2xl drop-shadow-stone-400/60 drop-shadow transition-all duration-300 cursor-pointer">
            <div class="faq-question px-5 py-2 flex flex-row justify-between items-center bg-brand-main-bg rounded-xl">
              <label class="mr-5 font-semibold text-sl cursor-pointer">{{ $faq['question'] }}</label>
              <button class="dropdown-toggle mb-2 font-bold text-xl cursor-pointer">
                <i class="fa-solid fa-angle-down transition-all duration-200"></i>
              </button>
            </div>
            <div class="faq-content hidden px-5 py-3 bg-brand-main-bg brightness-93 rounded-b-xl">
              <p class="text-brand-text-primary text-start whitespace-pre-line"">{{ preg_replace('/(?<!^)(\d+\))/', "\n$1", $faq['answer']) }}</p>
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>

@vite('resources/js/linked/faq_js.js')

@endsection