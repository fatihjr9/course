<x-client-layout>
    <!-- Hero -->
    <div class="relative isolate  mx-auto max-w-screen-xl py-10">
        <div class="flex flex-col-reverse lg:flex-row mx-auto mt-10">
            <div class=" flex flex-col">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Berkembang dengan mengikuti kursus kami</h1>
                <p class=" text-lg leading-8 text-gray-600">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
            </div>
            <img src="{{ asset('/hero.png') }}" class="w-full lg:w-6/12 ml-auto mb-4 lg:mt-0"/>
        </div>
    </div>
    <!-- Hero -->
    <div class="bg-zinc-50 p-6">
        <div class="max-w-screen-xl grid grid-cols-1 mx-auto py-10">
            <div class=" flex flex-col">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Materi Kami</h1>
                <p class=" text-base text-gray-600">Anim aute id magna aliqua ad ad non deserunt sunt. occaecat fugiat aliqua.</p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
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
                                <form action="{{ route('client-add-cart') }}" method="POST" class="w-full text-center border border-orange-400 text-orange-400 py-2 rounded-xl addCartClient">
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

    <section>
      <div class="max-w-screen-xl mx-auto lg:py-16">
        <div class="grid grid-cols-1 gap-y-8 lg:grid-cols-2 lg:gap-x-16">
          <div class="mx-auto max-w-lg lg:mx-0">
            <h2 class="text-3xl font-bold sm:text-4xl">Find your career path</h2>

            <p class="mt-4 text-gray-600">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut vero aliquid sint distinctio
              iure ipsum cupiditate? Quis, odit assumenda? Deleniti quasi inventore, libero reiciendis
              minima aliquid tempora. Obcaecati, autem.
            </p>

            <a
              href="#"
              class="mt-8 inline-block rounded bg-indigo-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-yellow-400"
            >
              Get Started Today
            </a>
          </div>

          <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
            <a
              class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
              href="#"
            >
              <span class="inline-block rounded-lg bg-gray-50 p-3">
                <svg
                  class="size-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                  <path
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                  ></path>
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                  ></path>
                </svg>
              </span>

              <h2 class="mt-2 font-bold">Accountant</h2>

              <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                Lorem ipsum dolor sit amet consectetur.
              </p>
            </a>

            <a
              class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
              href="#"
            >
              <span class="inline-block rounded-lg bg-gray-50 p-3">
                <svg
                  class="size-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                  <path
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                  ></path>
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                  ></path>
                </svg>
              </span>

              <h2 class="mt-2 font-bold">Accountant</h2>

              <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                Lorem ipsum dolor sit amet consectetur.
              </p>
            </a>

            <a
              class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
              href="#"
            >
              <span class="inline-block rounded-lg bg-gray-50 p-3">
                <svg
                  class="size-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                  <path
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                  ></path>
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                  ></path>
                </svg>
              </span>

              <h2 class="mt-2 font-bold">Accountant</h2>

              <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                Lorem ipsum dolor sit amet consectetur.
              </p>
            </a>

            <a
              class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
              href="#"
            >
              <span class="inline-block rounded-lg bg-gray-50 p-3">
                <svg
                  class="size-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                  <path
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                  ></path>
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                  ></path>
                </svg>
              </span>

              <h2 class="mt-2 font-bold">Accountant</h2>

              <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                Lorem ipsum dolor sit amet consectetur.
              </p>
            </a>

            <a
              class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
              href="#"
            >
              <span class="inline-block rounded-lg bg-gray-50 p-3">
                <svg
                  class="size-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                  <path
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                  ></path>
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                  ></path>
                </svg>
              </span>

              <h2 class="mt-2 font-bold">Accountant</h2>

              <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                Lorem ipsum dolor sit amet consectetur.
              </p>
            </a>

            <a
              class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
              href="#"
            >
              <span class="inline-block rounded-lg bg-gray-50 p-3">
                <svg
                  class="size-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                  <path
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                  ></path>
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                  ></path>
                </svg>
              </span>

              <h2 class="mt-2 font-bold">Accountant</h2>

              <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                Lorem ipsum dolor sit amet consectetur.
              </p>
            </a>
          </div>
        </div>
      </div>
    </section>
</x-client-layout>
