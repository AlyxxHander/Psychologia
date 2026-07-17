<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
  @vite([
    'resources/css/app.css', 'resources/css/style.css',
    'resources/js/app.js', 
  ])
</head>

<body class="text-brand-text-tertiary text-sm text-sans break-all sm:break-normal">
  <div id="toast-container" class="z-999 absolute top-20 right-5 pointer-events-none"></div>
  @if (str_contains(request()->fullUrl(), '/landing') || request()->routeIs('login'))
    <div class="w-full flex flex-row">
      @include('partial._landing_sidemenu')
      <div id="landing-main-section" class="w-full flex flex-col brightness-100 lg:brightness-100 transition-all duration-300 ease-in-out">
        @include('partial._nav_landing')
        <main class="bg-white">        
          @yield('content')
        </main>
        @include('partial._footer')
      </div>
    </div>
  @elseif (str_contains(request()->fullUrl(), '/admin'))
    <div class="w-full h-screen flex flex-row bg-stone-50">
      @include('partial._admin_sidemenu')
      <div id="admin-main-section" class="w-full overflow-y-auto brightness-100 xl:brightness-100 transition-all duration-300 ease-in-out">
        @include('partial._topbar_admin')
        <main class="p-0 sm:px-5 lg:px-15 py-10 bg-white">
          @yield('content')
        </main>
      </div>
    </div>
  @endif

  @livewireScripts
  <script>
    function showSessionToasts() {
      if (typeof window.triggerToast === 'undefined') return;
      @if (session('toast_error'))
        window.triggerToast("error", "{{ session('toast_error') }}");
      @endif
      @if (session('toast_success'))
        window.triggerToast('success', "{{ session('toast_success') }}");
      @endif
    }
    
    // Fire on Livewire SPA navigations
    document.addEventListener('livewire:navigated', function () {
      setTimeout(showSessionToasts, 50);
    });
  </script>

  @vite(['resources/js/layouts/base_js.js', 'resources/js/linked/notification_js.js'])
</body>
</html>