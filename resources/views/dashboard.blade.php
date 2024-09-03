<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if(Auth::user()->role == '1')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="px-4 py-3 flex flex-row items-center justify-between text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow">
                        <div class="flex flex-col">
                            <span class="block text-gray-900">Beranda</span>
                            <span class="block text-gray-500 truncate">Lihat kursus lebih lengkap</span>
                        </div>
                        <a href="{{ route('client-index') }}" class="block text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </div>
                    <div class="text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow">
                        <div class="px-4 py-3">
                            <span class="block text-gray-900">0</span>
                            <span class="block text-gray-500 truncate">Total Kursus</span>
                        </div>
                    </div>
                    <div class="px-4 py-3 flex flex-row items-center justify-between text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow">
                        <div class="flex flex-col">
                            <span class="block text-gray-900">Belajar Sekarang</span>
                            <span class="block text-gray-500 truncate">Total Kursus</span>
                        </div>
                        <span class="block text-gray-500 truncate">Total Kursus</span>
                    </div>
                </div>
            @elseif(Auth::user()->role == '0')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="px-4 py-3 flex flex-row items-center justify-between text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow">
                        <div class="flex flex-col">
                            <span class="block text-gray-900">Beranda</span>
                            <span class="block text-gray-500 truncate">Lihat kursus lebih lengkap</span>
                        </div>
                        <a href="{{ route('client-index') }}" class="block text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </div>
                    <div class="text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow">
                        <div class="px-4 py-3">
                            <span class="block text-gray-900">0</span>
                            <span class="block text-gray-500 truncate">Kursus Yang Dirilis</span>
                        </div>
                    </div>
                    <div class="text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow">
                        <div class="px-4 py-3">
                            <span class="block text-gray-900">0</span>
                            <span class="block text-gray-500 truncate">Total Pengguna</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
