<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $course->nama }}
            </h2>
            <div class="flex flex-row items-center gap-x-2">
                <a href="{{ route('subcourse-admin-create',$course->nama) }}" class="px-4 py-2 rounded-xl bg-orange-50 text-orange-500">Tambah Materi</a>
                <a href="{{ route('course-admin') }}" class="px-4 py-2 rounded-xl bg-red-50 text-red-500">Batal</a>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-x-auto border border-zinc-200 sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-zinc-200">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Materi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Link
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($sc->subCourses as $subCourse)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $subCourse->judul }}
                        </th>
                        <td class="px-6 py-4">
                            <a href="{{ $subCourse->link }}" target="_blank" class="underline">{{ $subCourse->judul }}</a>
                        </td>
                        <td class="px-6 py-4 flex flex-row items-center gap-x-2">
                            <a href="{{ route('subcourse-admin-edit', ['name' => $course->nama, 'id' => $subCourse->id]) }}" class="font-medium px-4 py-2 rounded-lg transition-all text-orange-600 bg-orange-50 hover:bg-orange-100">Edit</a>
                            <form action="{{ route('subcourse-admin-destroy', ['name' => $course->nama, 'id' => $subCourse->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus Materi kursus {{ $subCourse->judul }}?')" class="font-medium rounded-lg transition-all text-red-600 bg-red-50 hover:bg-red-100">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium px-4 py-2 rounded-lg transition-all text-red-600 bg-red-50 hover:bg-red-100">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
