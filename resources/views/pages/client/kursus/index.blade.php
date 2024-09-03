<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Materi Kursus') }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 my-6">
        @foreach ($courses as $course)
            <div class="bg-white p-4 rounded-lg">
                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full rounded-t-xl h-40 lg:h-60 object-cover" alt="{{ $course->nama }}">
                <div class="flex flex-col">
                    <h3 class="font-bold text-xl mb-1">{{ $course->nama }}</h3>
                    <a href="{{ route('detail-kursus-user',$course->nama) }}" class="w-full text-center py-2 bg-orange-500 text-white rounded-lg">Belajar Sekarang</a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
