<x-client-layout>
<div class="max-w-screen-xl mx-auto my-6">
    <div class="grid grid-cols-1 space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-semibold">{{ $course->nama }}</h1>
            <h1 class="text-gray-400">Tanggal Rilis : {{ $course->created_at->format('d F Y') }}</h1>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @if($preview)
                    <div class="bg-white border border-zinc-200 rounded-xl">
                        <iframe src="{{ $preview }}" class="w-full h-full" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="bg-white border border-zinc-200 rounded-xl">
                        <p>No preview available.</p>
                    </div>
                @endif
                <div class="grid grid-cols-1 gap-y-4">
                <div class="bg-white p-4 border border-zinc-200 rounded-xl">
                    <h5 class="text-xl font-medium">Materi Kursus</h5>
                    <p class="text-justify text-gray-400">{{ $course->deskripsi }}</p>
                </div>
                <div class="bg-white p-4 border border-zinc-200 rounded-xl flex flex-col">
                    <h5 class="text-xl font-medium mb-4">Konten Kursus</h5>
                    @if($course->subCourses->count() > 0)
                        @foreach($course->subCourses as $subCourse)
                            <div class="mb-1 border-b border-zinc-200 px-4 py-2 flex flex-row">
                                <p class="">{{ $loop->iteration }}.</p>
                                <p class="ml-4">{{ $subCourse->judul }}</p>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak ada sub-courses.</p>
                    @endif
                    @if($course->subCourses->count() > 0)
                        <div class="bg-gray-100 text-gray-500 border border-zinc-200 px-4 py-2 flex flex-col mb-1">
                            <p class="font-semibold text-center">{{ $total }} Video lainnya</p>
                        </div>
                    @elseif($course->subCourses->count() < 4)
                        <div class="bg-gray-100 text-gray-500 border border-zinc-200 px-4 py-2 flex flex-col mb-1">
                            <p class="font-semibold text-center">0 Video lainnya</p>
                        </div>
                    @else
                        <p class="hidden">Tidak ada sub-courses.</p>
                    @endif
                    <div class="flex flex-col space-y-2 mt-4">
                        @if(Auth::check())
                            <form action="{{ route('client-add-cart') }}" method="POST" class="w-full text-center border border-orange-400 text-orange-400 py-2 rounded-xl add-to-cart">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button type="submit">Tambahkan</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="w-full text-center border border-orange-400 text-orange-400 py-2 rounded-xl">Tambahkan</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h1 class="text-xl font-semibold">Kursus Lainnya</h1>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mt-2">
                @if ($relatedCourses->isNotEmpty())
                    @foreach($relatedCourses as $c)
                        <div class="w-full bg-white rounded-xl border border-zinc-200">
                            <img class="w-full rounded-t-xl h-40 object-cover" src="{{ asset('storage/' . $c->thumbnail) }}" alt="{{ $c->nama }}" />
                            <div class="p-4 space-y-2">
                                <div>
                                    <h5 class="text-xl font-semibold">{{ $c->nama }}</h5>
                                    <p class="text-gray-400">{{ $c->deskripsi }}</p>
                                </div>
                                <h5 class="text-xl font-semibold">Rp {{ number_format($c->harga, 0, ',', '.') }}</h5>
                                <div class="flex flex-row items-center justify-between gap-2">
                                    @if(Auth::check())
                                        <form action="{{ route('client-add-cart') }}" method="POST" class="w-full text-center border border-orange-400 text-orange-400 py-2 rounded-xl add-to-cart">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $c->id }}">
                                            <button type="submit">Tambahkan</button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="w-full text-center border border-orange-400 text-orange-400 py-2 rounded-xl">Tambahkan</a>
                                    @endif
                                    <a href="" class="w-full text-center bg-orange-400 text-white py-2 rounded-xl">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Tidak ada kursus lain.</p>
                @endif
            </div>
        </div>
    </div>
</div>
</x-client-layout>
