<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Alpine.js x-cloak style -->
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <!-- Styles -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    @stack('styles')
</head>
<body class="relative text-base font-normal z-1 bg-gray-50 font-outfit dark:bg-gray-900"
      x-data="{
          sidebarOpen: false,
          sidebarExpanded: localStorage.getItem('sidebarExpanded') === 'true',
          sidebarHovered: false,
          darkMode: localStorage.getItem('darkMode') === 'true'
      }"
      x-init="
          $watch('sidebarExpanded', val => localStorage.setItem('sidebarExpanded', val));
          $watch('darkMode', val => {
              localStorage.setItem('darkMode', val);
              if (val) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
          });
          if (darkMode) document.documentElement.classList.add('dark');
      "
      :class="{ 'dark': darkMode }">

    <div class="min-h-screen xl:flex">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Backdrop for mobile -->
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 transition-all duration-300 ease-in-out"
             :class="{
                 'lg:ml-[290px]': sidebarExpanded || sidebarHovered,
                 'lg:ml-[90px]': !sidebarExpanded && !sidebarHovered
             }">

            <!-- Header -->
            @include('admin.partials.header')

            <!-- Page Content -->
            <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Shared Icon Picker Modal - Available globally --}}
    @include('admin.components.shared-icon-picker-modal')

    <!-- jQuery (required for Toastr) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastr Configuration -->
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>

    <!-- Display Flash Messages -->
    @if(session('success'))
        <script>
            toastr.success('{{ session('success') }}');
        </script>
    @endif

    @if(session('error'))
        <script>
            toastr.error('{{ session('error') }}');
        </script>
    @endif

    @if(session('warning'))
        <script>
            toastr.warning('{{ session('warning') }}');
        </script>
    @endif

    @if(session('info'))
        <script>
            toastr.info('{{ session('info') }}');
        </script>
    @endif

    @stack('scripts')
</body>
</html>
