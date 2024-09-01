<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Materi Kursus') }}
            </h2>
            <a href="{{ route('course-admin') }}" class="px-4 py-2 rounded-xl bg-red-50 text-red-500">Batal</a>
        </div>
    </x-slot>

    <form action="{{ route('subcourse-admin-update', ['name' => $course->nama, 'id' => $subCourse->id]) }}" method="POST" class="bg-white mt-6 p-6 rounded-xl" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="flex flex-col space-y-2">
                <label class="block text-sm font-medium text-gray-900">Judul Materi</label>
                <input type="text" name="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan nama kursus" required />
            </div>
            <div class="flex flex-col space-y-2">
                <label class="block text-sm font-medium text-gray-900">Link Materi</label>
                <input type="text" name="link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan nama kursus" required />
            </div>
        </div>
        <button type="submit" class="w-full py-2 bg-orange-500 text-white rounded-lg mt-4">Tambahkan</button>
    </form>

</x-app-layout>
