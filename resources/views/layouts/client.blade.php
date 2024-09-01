<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kursus Software Mahasiswa') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('status.info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        <nav class="bg-white py-2 border-b border-gray-200 z-50 relative px-6">
          <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
            </a>
            <div class="flex items-center md:order-2 space-x-2 md:space-x-0">
                @auth
                    <button type="button" class="flex rounded-lg border px-4 py-2 lg:mr-2" id="cart-user" aria-expanded="false" data-dropdown-toggle="cart-user-dropdown" data-dropdown-placement="bottom">
                        <p>Cart</p>
                    </button>
                    <div class="z-50 hidden my-4 text-base list-none bg-white rounded-lg shadow" id="cart-user-dropdown">
                        @if($cart->isEmpty())
                            <p class="px-4 py-3 text-sm text-gray-700">Tambahkan kursus dahulu</p>
                        @else
                            @foreach($cart as $index => $item)
                                <div class="px-4 py-3 flex flex-row gap-x-4 justify-between border-b pb-2">
                                    <p class="block text-sm text-gray-900">{{ $item->course->nama }}</p>
                                    <p class="block text-sm text-gray-500">Rp {{ $item->course->harga }}</p>
                                </div>
                            @endforeach
                            <ul class="">
                                <li>
                                    <a href="{{ route('dashboard-user') }}" class="block w-full text-center mx-auto px-4 py-2 text-sm text-green-700 bg-green-100">Checkout</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                @endauth
                <div>
                    <!-- Dropdown menu -->
                    @if(Auth::check())
                        <button type="button" class="flex rounded-lg border px-4 py-2" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                            <p>Halo, {{ Auth::user()->name }}</p>
                        </button>
                        @if(Auth::user()->role == '1')
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                                <div class="px-4 py-3">
                                    <span class="block text-sm text-gray-900">{{ Auth::user()->name }}</span>
                                    <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
                                </div>
                                <ul class="py-2" aria-labelledby="user-menu-button">
                                    <li>
                                        <a href="{{ route('dashboard-user') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                    </li>
                                </ul>
                            </div>
                        @elseif(Auth::user()->role == '0')
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                                <div class="px-4 py-3">
                                    <span class="block text-sm text-gray-900">{{ Auth::user()->name }}</span>
                                    <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
                                </div>
                                <ul class="py-2" aria-labelledby="user-menu-button">
                                    <li>
                                        <a href="{{ route('dashboard-admin') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
                    @endif
                </div>

                <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="{{ route('client-index') }}" class="{{ request()->routeIs('client-index') ? 'block py-2 px-3 text-orange-500 bg-white rounded md:bg-transparent md:text-orange-500 md:p-0' : 'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-gray-600 md:p-0' }}">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('client-course') }}" class="{{ request()->routeIs('client-course') ? 'block py-2 px-3 text-orange-500 bg-white rounded md:bg-transparent md:text-orange-500 md:p-0' : 'block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-gray-600 md:p-0' }}">Kursus</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">FAQ</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Kontak Kami</a>
                    </li>
                </ul>
            </div>
          </div>
        </nav>
        <div class="font-sans text-gray-900 antialiased px-6">
            {{ $slot }}
        </div>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
        <script>
        $(document).ready(function() {
            $('.addCartClient').on('click', function(e) {
                e.preventDefault();
                var courseId = $(this).data('course-id');

                $.ajax({
                    url: '{{ route('client-add-cart') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        course_id: courseId
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menambahkan item ke keranjang.');
                    }
                });
            });
        });
        </script>
        @livewireScripts
    </body>
</html>
