<x-client-layout>
    <div class="max-w-screen-xl mx-auto my-6">
        <div class="space-y-4 flex flex-col my-6">
            <h5 class="text-3xl font-bold">Course terbaik</h5>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($data as $item)
                    <div class="w-full bg-white rounded-xl border border-zinc-200">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full rounded-t-xl h-40 lg:h-60 object-cover" alt="{{ $item->nama }}">
                        <div class="p-4 space-y-2">
                            <div>
                                <h5 class="text-xl font-semibold">{{ $item->nama }}</h5>
                                <p class="text-gray-400 truncate">{{ $item->deskripsi }}</p>
                            </div>
                            <h5 class="text-xl font-semibold">Rp {{ number_format($item->harga, 0, ',', '.') }}</h5>
                            <div class="flex flex-row items-center justify-between gap-2">
                                @if(Auth::check())
                                    <form action="{{ route('client-add-cart') }}" method="POST" class="w-full text-center border border-orange-400 text-orange-400 py-2 rounded-xl add-to-cart">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $item->id }}">
                                        <button type="submit">Tambahkan</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="w-full text-center border border-orange-400 text-orange-400 py-2 rounded-xl">Tambahkan</a>
                                @endif
                                <a href="{{ route('client-detail',$item->nama) }}" class="w-full text-center bg-orange-400 text-white py-2 rounded-xl">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-client-layout>
