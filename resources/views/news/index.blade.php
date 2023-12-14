@extends('layouts.main')
@section('container')
    <section class="pt-28" id="home">
        <div class="container">
            <!-- bottom hero -->
            <div class="px-4 mt-8 mb-5">
                <h1 class="lg:text-3xl  text-center font-semibold mb-8">{{ $title }}</h1>
                <form action="/news" method="GET" class="relative">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <div class="relative flex justify-center items-center">
                        <input type="text" name="search" id="search" placeholder="Enter keywords..."
                            class="lg:w-1/2 w-full border border-slate-300 rounded py-2 px-3 pl-10 focus:outline-none focus:ring-slate-600 focus:border-slate-500 text-slate-700"
                            value="{{ request('search') }}">
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
            @if ($news->count())
                <div class="grid lg:grid-cols-3  md:grid-cols-2">
                    @foreach ($news as $item)
                        <div class="px-4 mt-4">
                            <div class="caption hover:scale-95 transition-all duration-500 mb-5">
                                <img src="{{ asset('storage/' . $item->image) }}"
                                    class="aspect-video object-cover shadow-md brightness-50 mb-5"
                                    alt="{{ $item->title }}" />
                                <div class="flex items-center mb-2">
                                    <p class="lg:text-xs text-[10px]">
                                        <i class="fa-solid fa-clock mr-[2px]"></i> {{ $item->reading_time }} Minute Read
                                    </p>
                                </div>
                                <a href="/news/{{ $item->slug }}">
                                    <h3
                                        class="lg:text-2xl lg:font-black text-lg font-bold lg:mb-3 mb-2 title-article line-clamp-1">
                                        {{ $item->title }}
                                    </h3>
                                </a>
                                <p class="mb-3 lg:text-xs text-[11px] text-slate-600 font-medium">
                                    {{ $item->excerpt }}
                                </p>
                                <div class="mt-1 text-[10px] font-normal">
                                    <p>
                                        By <span class="font-bold">{{ $item->author->name }}</span> |
                                        {{ $item->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center lg:text-2xl mt-10 text-slate-500 font-semibold">No item Found!</p>
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
    <!-- end section hero news -->
    <div class="container">
        <div class="px-4 mt-10 mb-10">
            {{ $news->links() }}
        </div>
    </div>
@endsection
