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
        <nav class="bg-white py-2 border-b border-gray-200 z-50 relative px-6">
          <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
            </a>
            <div class="flex items-center md:order-2 space-x-2 md:space-x-0">
                @auth
                    <button type="button" class="flex items-center justify-between rounded-lg border w-20 p-2 lg:mr-2" id="cart-user" aria-expanded="false" data-dropdown-toggle="cart-user-dropdown" data-dropdown-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <p class="px-3 py-0.5 bg-orange-100 text-orange-500 rounded-lg font-medium text-sm">{{ $cart->count() }}</p>
                    </button>
                    <div class="z-50 hidden my-4 text-base list-none bg-white rounded-lg shadow w-60" id="cart-user-dropdown">
                        @if($cart->isEmpty())
                            <p class="px-4 py-3 text-sm text-gray-700">Tambahkan kursus dahulu</p>
                        @else
                            @foreach($cart as $index => $item)
                                <div class="flex flex-row items-center justify-between px-4 py-2 border-b pb-2">
                                    <div class="flex flex-col gap-y-1">
                                        <p class="block text-sm">{{ $item->course->nama }}</p>
                                        <p class="block text-sm text-gray-500">Rp {{ $item->course->harga }}</p>
                                    </div>
                                    <form action="{{ route('client-rm-cart', $item->id) }}" method="POST" class="remove-from-cart text-sm p-1.5 bg-red-100 text-red-500 rounded-lg">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                            <form id="payment-form" action="{{ route('client-payment') }}" method="POST">
                                @csrf
                                <button type="button" id="pay-button" class="w-full text-center mx-auto px-4 py-2 text-sm text-green-700 bg-green-100">Bayar Sekarang</button>
                            </form>
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
        <script type="text/javascript"
                src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="SB-Mid-client-EbZpArANxHBj9XHL"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
        <script>
            // Add
            $('form.add-to-cart').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');

                $.ajax({
                    type: form.attr('method'),
                    url: actionUrl,
                    data: form.serialize(),
                    success: function(response) {
                        alert('Item added to cart!');
                        window.location.reload();
                    }
                });
            });
            // Remove
            $('form.remove-from-cart').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');

                $.ajax({
                    type: form.attr('method'),
                    url: actionUrl,
                    data: form.serialize(),
                    success: function(response) {
                        alert('Item removed from cart!');
                        window.location.reload();
                    }
                });
            });
            // Payment
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('pay-button').addEventListener('click', function() {
                    // Fetch the Snap token from the server
                    fetch('{{ route('client-payment') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({}) // Send any required data here
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.token) {
                            window.snap.pay(data.token, {
                                onSuccess: function(result) {
                                    console.log('Payment successful:', result);
                                    // Redirect or update the UI as needed
                                },
                                onPending: function(result) {
                                    console.log('Payment pending:', result);
                                    // Handle pending payment state
                                },
                                onError: function(result) {
                                    console.log('Payment error:', result);
                                    // Handle payment error
                                },
                                onClose: function() {
                                    console.log('Payment popup closed');
                                    // Handle popup close event
                                }
                            });
                        } else {
                            console.error('Snap token is not available');
                        }
                    })
                    .catch(error => console.error('Error fetching Snap token:', error));
                });
            });

        </script>
        @livewireScripts
    </body>
</html>
