@extends('layouts.main')
@section('container')
    <section class="pt-28" id="home">
        <div class="container">
            <!-- bottom hero -->
            <div class="px-4 mt-8 mb-8">
                <h1 class="lg:text-3xl  text-center font-semibold mb-8">{{ $title }}</h1>
                <form action="/category" method="GET" class="relative">
                    <div class="relative flex justify-center items-center">
                        <input type="text" name="query" id="query" placeholder="Enter keywords..."
                            class="lg:w-1/2 w-full border border-slate-300 rounded py-2 px-3 pl-10 focus:outline-none focus:ring-slate-600 focus:border-slate-500 text-slate-700"
                            value="{{ request('query') }}">
                        <button type="submit"
                            class="absolute lg:right-1/4 right-0 top-0 h-full bg-dark text-white py-2 px-4 rounded hover:opacity-80 focus:outline-none focus:ring focus:border-slate-500">
                            Search
                        </button>
                        <svg class="absolute lg:left-[26%] left-2 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 15l5-5m0 0l-5-5m5 5H4">
                            </path>
                        </svg>
                    </div>
                </form>

            </div>
            @if ($recentCategories->count())
                <div class="px-4">
                    <div class="grid lg:grid-cols-6 md:grid-cols-4 md:gap-5 sm:grid-cols-3 grid-cols-2 gap-4">
                        @foreach ($recentCategories as $category)
                            <a href="/news?category={{ $category->slug }}">
                                <div
                                    class="group bg-dark aspect-[3/4] rounded-lg md:aspect-[3/4] xl:aspect-[3/4] overflow-hidden  relative hover:scale-95 transition-all duration-500">
                                    <h3
                                        class="lg:text-base text-lg font-semibold text-white z-50 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-center">
                                        {{ $category->name }}
                                    </h3>
                                    <img class="w-full h-full bg-[url('')] bg-cover bg-center absolute group-hover:scale-125 transition-all duration-500 group-hover:rotate-12 group-hover:opacity-30 brightness-75 object-cover"
                                        src="{{ asset('storage/' . $category->image) }}" />
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center lg:text-2xl mt-10 text-slate-500 font-semibold">No Category Found!</p>
                <div class="flex justify-center">
                    <img src="/img/not-found.png" class="lg:w-1/4 drop-shadow-xl" alt="not found" />
                </div>
                <p class="text-center text-xs">
                    <span class="font-semibold text-slate-700">Source Image </span> :
                    <a class="text-slate-500" href="http://www.freepik.com">Designed by rawpixel.com / Freepik</a>
                </p>
            @endif
            <!-- end bottom hero -->
        </div>
        </div>
    </section>
    <!-- end section hero category -->
    <div class="container">
        <div class="px-4 mt-10 mb-10">
            {{ $recentCategories->links() }}
        </div>
    </div>
@endsection
