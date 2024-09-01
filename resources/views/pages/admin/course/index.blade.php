<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kursus') }}
            </h2>
            <a href="{{ route('course-admin-create') }}" class="px-4 py-2 rounded-xl bg-orange-50 text-orange-400">Tambah Kursus</a>
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
                        Nama Kursus
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Thumbnail
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>

                </tr>
            </thead>
            <tbody>
                @if($data->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-4">Tidak ada data</td>
                    </tr>
                @else
                    @foreach($data as $item)
                        <tr class="bg-white border-b hover:bg-gray-50 items-center">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $item->nama }}
                            </th>
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" width="100" alt="{{ $item->nama }}">
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->harga }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->deskripsi }}
                            </td>
                            <td class="px-6 py-4 flex flex-row items-center gap-x-2">
                                <a href="{{ route('course-admin-detail', $item->nama) }}" class="font-medium px-4 py-2 rounded-lg transition-all text-blue-600 bg-blue-50 hover:bg-blue-100">Detail</a>
                                <a href="{{ route('course-admin-edit', $item->nama) }}" class="font-medium px-4 py-2 rounded-lg transition-all text-orange-600 bg-orange-50  hover:bg-orange-100">Edit</a>
                                <form action="{{ route('course-admin-destroy', $item->nama) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kursus {{ $item->nama }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium px-4 py-2 rounded-lg transition-all text-red-600 bg-red-50 hover:bg-red-100">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="bg-white px-6">
            {{ $data->links() }}
        </div>
    </div>
</x-app-layout>
