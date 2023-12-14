@extends('layouts.main')
@section('container')
    <section class="lg:pt-40 pt-36 pb-12" id="home">
        <div class="container">
            <div class="xl:px-36 lg:px-10 px-4">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <div class="mb-5 lg:mr-10">
                            <h5 class="text-center lg:text-xl text-lg font-semibold text-slate-500 mb-5">
                                {{ $news->category->name }}</h5>
                            <h1 class="text-center xl:text-4xl lg:text-3xl text-2xl font-semibold mb-5 title-article">
                                {{ $news->title }}
                            </h1>
                            <div
                                class="block lg:flex lg:justify-between font-semibold mb-5 text-slate-500 xl:text-lg lg:text-base text-sm">
                                <p class="lg:mb-0 mb-2">By : {{ $news->author->name }}</p>
                                <p>{{ $news->published_at->format('l, d F Y') }}</p>
                            </div>
                            <img src="{{ asset('storage/' . $news->image) }}" class="aspect-video object-cover mb-5"
                                alt="{{ $news->title }}">
                            <div
                                class="text-slate-900 body-article leading-loose [&>p]:xl:text-lg [&>p]:xl:leading-loose [&>ul>li]:list-disc [&>ul>li]:ml-7 [&>table]:border [&>table]:border-slate-500">
                                {!! $news->body !!}
                            </div>

                        </div>
                    </div>
                    <div class="w-full">
                        <h2 class="py-5 capitalize font-bold lg:text-2xl text-lg">Latest News</h2>
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                            @php
                                $item = 0;
                            @endphp
                            @foreach ($latestNews as $news)
                                @if ($item < 3)
                                    <div class="caption hover:scale-95 transition-all duration-500 mb-5">
                                        <img src="{{ asset('storage/' . $news->image) }}"
                                            class="aspect-[4/3] shadow-md brightness-50 mb-5" alt="{{ $news->title }}" />

                                        <a href="/news/{{ $news->slug }}">
                                            <h3
                                                class="lg:text-2xl lg:font-black text-lg font-bold lg:mb-3 mb-2 title-article line-clamp-2">
                                                {{ $news->title }}
                                            </h3>
                                        </a>

                                        <div class="mt-1 text-[10px] font-normal">
                                            <p>
                                                By <span class="font-bold">{{ $news->author->name }}</span> |
                                                {{ $news->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    @php
                                        $item++;
                                    @endphp
                                @else
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
