<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kursus {{ $course->nama }}
        </h2>
    </x-slot>

    <div class="flex flex-col-reverse md:flex-row justify-between mt-6 space-x-2">
        <!-- Daftar Subcourses -->
        <div class="p-4 bg-white lg:w-2/12 rounded-lg border border-zinc-200">
            <ul id="subcourse-list">
                @foreach ($course->subCourses as $index => $subcourse)
                    <li>
                        <a href="#"
                            class="subcourse-link truncate mb-1 block p-2 rounded bg-gray-100 transition-colors {{ $index === 0 ? 'bg-gray-200 text-gray-900 font-semibold' : 'text-gray-600' }}"
                           data-title="{{ $subcourse->judul }}"
                           data-link="{{ $subcourse->link }}">
                           {{ $subcourse->judul }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Video yang Dipilih -->
        <div class="p-4 bg-white lg:w-10/12 rounded-lg border border-zinc-200" id="video-container">
            <div id="video-display"></div>
        </div>
    </div>

    <!-- JavaScript untuk interaksi dinamis -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subcourseLinks = document.querySelectorAll('.subcourse-link');
            const videoDisplay = document.getElementById('video-display');

            function updateVideoDisplay(title, videoLink) {
                // Mengambil video ID dari link YouTube
                const videoId = new URL(videoLink).searchParams.get('v');
                videoDisplay.innerHTML = `
                    <iframe class="w-full h-96" width="560" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>
                `;
            }

            // Menampilkan video untuk subcourse pertama saat halaman dimuat
            const firstSubcourse = document.querySelector('.subcourse-link.active');
            if (firstSubcourse) {
                const title = firstSubcourse.getAttribute('data-title');
                const videoLink = firstSubcourse.getAttribute('data-link');
                updateVideoDisplay(title, videoLink);
            }

            subcourseLinks.forEach(link => {
                            link.addEventListener('click', function (event) {
                                event.preventDefault();

                                // Menghapus kelas 'active' dari semua link
                                subcourseLinks.forEach(l => l.classList.remove('active', 'bg-gray-200', 'text-gray-900', 'font-semibold'));
                                this.classList.add('active', 'bg-gray-200', 'text-gray-900', 'font-semibold');

                                const title = this.getAttribute('data-title');
                                const videoLink = this.getAttribute('data-link');
                                updateVideoDisplay(title, videoLink);
                            });
                        });
        });
    </script>
</x-app-layout>
