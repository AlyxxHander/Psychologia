@extends('layouts.base')

@section('title', 'Login')

@section('content')

<div class="fade-in-effect w-auto h-auto sm:h-115 max-w-100 max-h-120 mx-auto my-25 p-5 sm:p-10 gap-15 flex flex-col justify-center items-center border border-gray-300 rounded-3xl shadow-xl bg-white">
  <div class="gap-3 flex flex-col items-center text-center">
    <h1 class="text-4xl font-bold">Sign In</h1>
    <p class="text-black text-sl font-thin">Mari berkolaborasi menciptakan dampak nyata bagi kesehatan mental.</p>
  </div>
  <form action="{{ route('login.post') }}" method="POST" class="w-full gap-3 flex flex-col justify-center items-center">
    @csrf
    <div class="w-full gap-2 flex flex-row items-center border border-gray-300 rounded-lg shadow">
      <i class="ml-4 text-brand-text-tertiary fa-lg fa-solid fa-envelope"></i>
      <input name="email" class="input-field-transparent" type="email" value="{{ old('email') }}" placeholder="Email" required />
    </div>
    <div class="w-full mb-5 gap-2 flex flex-row items-center border border-gray-300 rounded-lg shadow">
      <i class="ml-4 text-brand-text-tertiary fa-lg fa-solid fa-lock"></i>
      <input name="password" class="password-input input-field-transparent" type="password" placeholder="Password" required />
      <button type="button" class="toggle-password mr-4 text-brand-text-primary hover:text-brand-gradient-300 transition-colors cursor-pointer">
        <i class="toggle-password-icon fa-solid fa-eye-slash fa-lg"></i>
      </button>
    </div>
    <!-- << Ubah elemen "a" menjadi "<input type='submit' />" >>-->
    <button type="submit" class="btn w-full py-2 text-white bg-brand-text-tertiary hover:bg-brand-gradient-200 transition-colors">Login</button>
  </form>
</div>

@vite('resources/js/linked/toggle_js.js')

@endsection
