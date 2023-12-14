@extends('layouts.main')
@section('container')
    <!--section hero news ()rekomendasi) -->
    @if (
        $latestNews->count() &&
            $randomNews->count() &&
            $recommendNews->count() &&
            $newsByReadingTime->count() &&
            $author_choice->count())
        <section class="pt-28" id="home">
            <div class="container">
                <div class="flex flex-wrap mb-5">
                    <!-- left side hero  -->
                    <div class="lg:w-7/12 md:w-1/2 w-full px-4 mb-3">
                        <div class="caption hover:scale-95 transition-all duration-500">
                            <img src="{{ asset('storage/' . $recommendNews[0]->image) }}"
                                class="aspect-video object-center object-cover shadow-md mb-5"
                                alt="{{ $recommendNews[0]->title }}" />
                            <div class="flex items-center justify-between mb-2">
                                <a href="/news?category={{ $recommendNews[0]->category->slug }}"
                                    class="border border-slate-600 text-slate-600 bg-transparent lg:text-xs lg:px-4 lg:py- rounded-2xl mr-3 font-semibold px-[10px] text-[10px] py-1 hover:bg-slate-600 hover:text-white">{{ $recommendNews[0]->category->name }}</a>
                                <p class="lg:text-xs text-[10px] font-medium">
                                    <i class="fa-solid fa-clock"></i> {{ $recommendNews[0]->reading_time }} Minute Read
                                </p>
                            </div>
                            <a href="/news/{{ $recommendNews[0]->slug }}">
                                <h2
                                    class="xl:text-3xl lg:text-2xl md:text-xl text-lg font-black xl:mb-3 mb-2 title-article line-clamp-2">
                                    {{ $recommendNews[0]->title }}
                                </h2>
                            </a>
                            <p class="xl:mb-3 mb-2 md:text-xs text-[11px] text-slate-600 font-medium line-clamp-2">
                                {{ $recommendNews[0]->excerpt }}
                            </p>
                            <div class="mt-1 md:text-xs text-[10px] font-normal">
                                <p>
                                    By <a href="/news?author={{ $recommendNews[0]->author->username }}"><span
                                            class="font-bold">{{ $recommendNews[0]->author->name }}</span></a>
                                    |
                                    {{ $recommendNews[0]->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end left side hero -->

                    <!-- right side hero -->
                    <div class="lg:w-5/12 md:w-1/2 w-full px-4">
                        @php
                            $item = 0;
                        @endphp
                        @foreach ($recommendNews->skip(1) as $news)
                            @if ($item < 2)
                                <a href="/news/{{ $news->slug }}">
                                    <div class="xl:p-10 lg:p-8 md:p-7 p-6 bg-cover bg-center overflow-hidden flex items-end aspect-video justify-center mb-5 hover:scale-95 transition-all duration-500"
                                        style="
                                                background-image: linear-gradient(
                                                    rgba(0, 0, 0, 0.1),
                                                    rgba(0, 0, 0.2)
                                                ),
                                                url({{ asset('storage/' . $news->image) }});
                                            ">
                                        <div>
                                            <h2
                                                class="title-article text-white xl:text-2xl lg:text-xl text-base font-medium drop-shadow-lg xl:mb-2 lg:mb-1 tracking-wide lg:line-clamp-2 line-clamp-1">
                                                {{ $news->title }}
                                            </h2>
                                            <p
                                                class="lg:text-xs text-[11px] font-normal text-slate-300 drop-shadow-lg line-clamp-2">
                                                {{ $news->excerpt }}
                                            </p>
                                            <div
                                                class="xl:mt-4 lg:mt-3 mt-2 lg:text-[10px] text-[9px] font-normal text-slate-200">
                                                <p class="line-clamp-1">
                                                    <span><i class="fa-solid fa-user mr-1"></i>
                                                        {{ $news->author->name }}</span>
                                                    | <i class="fa-solid fa-calendar mx-1"></i>
                                                    {{ $news->created_at->diffForHumans() }} | <i
                                                        class="fa-solid fa-clock mx-1"></i> {{ $news->reading_time }}
                                                    Minute
                                                    Read
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @php
                                    $item++;
                                @endphp
                            @else
                            @break
                        @endif
                    @endforeach
                </div>
                <!-- end side hero -->
                <!-- bottom hero -->
                <div
                    class="grid lg:grid-cols-3  md:grid-cols-2 [&>div:nth-child(3)]:md:col-span-2 [&>div:nth-child(3)]:lg:col-span-1 [&>div:nth-child(3)>div>a>h3]:md:text-2xl">
                    @foreach ($recommendNews->skip(3) as $news)
                        <div class="px-4 mt-4">
                            <div class="caption hover:scale-95 transition-all duration-500 mb-5">
                                <img src="{{ asset('storage/' . $news->image) }}"
                                    class="aspect-video object-cover shadow-md brightness-50 mb-5"
                                    alt="{{ $news->title }}" />
                                <div class="flex items-center mb-2">
                                    <p class="lg:text-xs text-[10px]">
                                        <i class="fa-solid fa-clock mr-[2px]"></i> {{ $news->reading_time }} Minute
                                        Read
                                    </p>
                                </div>
                                <a href="/news/{{ $news->slug }}">
                                    <h3
                                        class="lg:text-2xl lg:font-black text-lg font-bold lg:mb-3 mb-2 title-article line-clamp-1">
                                        {{ $news->title }}
                                    </h3>
                                </a>
                                <p class="mb-3 lg:text-xs text-[11px] text-slate-600 font-medium">
                                    {{ $news->excerpt }}
                                </p>
                                <div class="mt-1 text-[10px] font-normal">
                                    <p>
                                        By <span class="font-bold">{{ $news->author->name }}</span> |
                                        {{ $news->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- end bottom hero -->
            </div>
        </div>
    </section>
    <!-- end section hero news -->
    <hr class="lg:mx-8 md:mx-[100px] mx-8 my-10" />
    <!-- author choice section -->
    <section>
        <div class="container">
            <div class="flex flex-wrap mb-5">
                <div class="px-4">
                    <h2 class="capitalize font-bold lg:text-lg text-base lg:mb-10 mb-5">
                        author's choice
                    </h2>
                    <!-- first content article -->
                    <div
                        class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 lg:gap-4 md:gap-3 gap-3 lg:mb-5 mb-2 md:justify-center [&>a:nth-child(3)]:md:col-span-2 [&>a:nth-child(3)]:lg:col-span-1 [&>a:nth-child(3)>div]:md:justify-start [&>a:nth-child(3)>div>div>h2]:md:text-2xl">
                        @php
                            $item = 0;
                        @endphp
                        @foreach ($author_choice as $news)
                            @if ($item < 3)
                                <a href="/news/{{ $news->slug }}">
                                    <div class="xl:p-10 md:p-7 p-6 bg-cover bg-center overflow-hidden flex items-end aspect-video justify-center lg:mb-5 caption hover:scale-95 transition-all duration-500"
                                        style="
                        background-image: linear-gradient(
                            rgba(0, 0, 0, 0.1),
                            rgba(0, 0, 0.2)
                          ),
                          url({{ asset('storage/' . $news->image) }});
                      ">
                                        <div>
                                            <h2
                                                class="title-article text-white xl:text-2xl lg:text-xl text-base font-medium drop-shadow-lg xl:mb-2 tracking-wide line-clamp-1">
                                                {{ $news->title }}
                                            </h2>
                                            <p
                                                class="lg:text-xs text-[11px] font-normal text-slate-300 drop-shadow-lg line-clamp-2">
                                                {{ $news->excerpt }}
                                            </p>
                                            <div
                                                class="xl:mt-4 lg:mt-3 mt-2 lg:text-[10px] text-[9px] font-normal text-slate-200">
                                                <p class="line-clamp-1">
                                                    <span><i class="fa-solid fa-user mr-1"></i>
                                                        {{ $news->author->name }}</span>
                                                    | <i class="fa-solid fa-calendar mx-1"></i>
                                                    {{ $news->created_at->diffForHumans() }} | <i
                                                        class="fa-solid fa-clock mx-1"></i> {{ $news->reading_time }}
                                                    Minute Read
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @php
                                    $item++;
                                @endphp
                            @else
                            @break
                        @endif
                    @endforeach
                </div>
                <!-- end first content article -->
                <!-- second content article -->
                @if (!empty($author_choice[4]))
                    <div class="flex flex-wrap hover:scale-95 transition-all duration-500 relative md:mt-5 mt-3">
                        <div class="lg:w-1/2 md:w-1/2 w-[40%]">
                            <img class="object-cover w-full h-full"
                                src="{{ asset('storage/' . $author_choice[4]->image) }}"
                                alt="{{ $author_choice[4]->title }}" />
                        </div>
                        <div class="lg:w-1/2 md:w-1/2 w-[50%] lg:py-16 lg:px-8 py-6 md:pl-5 pl-3 self-center">
                            <div class="flex items-center mb-2">
                                <a href="/news?category={{ $author_choice[4]->category->slug }}"
                                    class="border border-slate-600 text-slate-600 bg-transparent md:text-xs lg:px-4 lg:py-2 md:px-3 md:py-[6px] rounded-2xl mr-3 font-semibold px-[8px]  text-[8px] py-[2px] hover:bg-slate-600 hover:text-white">{{ $author_choice[4]->category->name }}</a>
                            </div>
                            <a href="/news/{{ $author_choice[4]->slug }}">
                                <h2
                                    class="xl:text-4xl lg:text-3xl md:text-2xl text-lg title-article font-black lg:line-clamp-3 line-clamp-1">
                                    {{ $author_choice[4]->title }}
                                </h2>
                            </a>
                            <p
                                class="lg:my-5 my-2 lg:line-clamp-3 font-medium line-clamp-1 lg:text-sm text-[10px] text-slate-900">
                                {{ $author_choice[4]->excerpt }}
                            </p>
                            <div class="lg:mt-4 mt-2 lg:text-xs text-[8.5px] font-normal text-slate-800">
                                <p class="line-clamp-1">
                                    <span><i class="fa-solid fa-user mr-1"></i>
                                        {{ $author_choice[4]->author->name }}</span>
                                    | <i class="fa-solid fa-calendar mx-1"></i>
                                    {{ $author_choice[4]->created_at->diffForHumans() }} | <i
                                        class="fa-solid fa-clock mx-1"></i> {{ $author_choice[4]->reading_time }}
                                    Minute
                                    Read
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- end second content article -->
            </div>
        </div>
    </div>
</section>
<!-- end author choice section -->
<!-- trending news section -->
<section>
    <div class="container">
        <div class="px-4">
            <h2 class="py-5 capitalize font-bold lg:text-lg text-base">
                Dive into our Long-Read News
            </h2>
            <div class="grid lg:grid-cols-4 grid-cols-1 gap-2 md:grid-cols-2 md:gap-5 lg:gap-4">
                @php
                    $item = 0;
                @endphp
                @foreach ($newsByReadingTime as $news)
                    @if ($item < 4)
                        <div class="caption hover:scale-95 transition-all duration-500">
                            <img src="{{ asset('storage/' . $news->image) }}"
                                class="w-full h-[calc(22vw/6*8)] object-cover object-center shadow-md mb-5"
                                alt="{{ $news->title }}" />
                            <div class="flex items-center justify-between mb-2">
                                <a href="/news?category={{ $news->category->slug }}"
                                    class="border border-slate-600 text-slate-600 bg-transparent lg:text-xs lg:px-4 lg:py- rounded-2xl mr-3 font-semibold px-[10px] text-[10px] py-1 hover:bg-slate-600 hover:text-white">{{ $news->category->name }}</a>
                                <p class="lg:text-xs text-[10px] font-medium">
                                    <i class="fa-solid fa-clock"></i> {{ $news->reading_time }} Minute Read
                                </p>
                            </div>
                            <a href="/news/{{ $news->slug }}">
                                <h3
                                    class="xl:text-2xl lg:text-xl lg:line-clamp-2 line-clamp-2 text-lg font-black lg:mb-3 mb-2 title-article">
                                    {{ $news->title }}
                                </h3>
                            </a>
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
</section>
<!-- end trending news section -->
<hr class="lg:mx-8 md:mx-[100px] mx-8 my-10" />

<section class="mb-16">
<div class="container">
    <div class="px-4">

        <div class="flex flex-wrap">
            <div class="lg:w-2/3">
                <h2 class="py-5 capitalize font-bold text-lg">Latest News</h2>
                @foreach ($latestNews as $news)
                    <div class="flex flex-wrap hover:scale-95 transition-all duration-500 relative mb-5">
                        <div class="md:w-1/3 w-[40%] md:pr-2 pr-4">
                            <img class="object-cover w-full h-full"
                                src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" />
                        </div>
                        <div class="md:w-2/3 w-[50%] xl:py-8 lg:px-8 py-6">
                            <div class="flex items-center mb-2">
                                <a href="/news?category={{ $news->category->slug }}"
                                    class="border border-slate-600 text-slate-600 bg-transparent lg:text-xs lg:px-3 lg:py-1 rounded-2xl mr-3 font-semibold px-[8px] lg:text-[10px] text-[8px] py-[2px] hover:bg-slate-600 hover:text-white">{{ $news->category->name }}</a>
                            </div>
                            <a href="/news/{{ $news->slug }}
                        ">
                                <h2
                                    class="xl:text-2xl lg:text-xl text-lg title-article font-black xl:line-clamp-3 lg:line-clamp-2 line-clamp-1">
                                    {{ $news->title }}
                                </h2>
                            </a>
                            <p
                                class="xl:my-5 lg:my-2 my-2 xl:line-clamp-3 lg:line-clamp-2 md:line-clamp-2 font-medium line-clamp-1 lg:text-sm text-[10px] text-slate-900">
                                {{ $news->excerpt }}
                            </p>
                            <div class="lg:mt-4 mt-2 lg:text-xs text-[8.5px] font-normal text-slate-800">
                                <p class="line-clamp-1">
                                    <span><i class="fa-solid fa-user mr-1"></i>
                                        {{ $news->author->name }}</span>
                                    | <i class="fa-solid fa-calendar mx-1"></i>
                                    {{ $news->created_at->diffForHumans() }} | <i
                                        class="fa-solid fa-clock mx-1"></i> {{ $news->reading_time }} Minute
                                    Read
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="lg:w-1/3">
                <h2 class="py-5 capitalize font-bold text-lg">Random News</h2>
                <div class="grid lg:grid-cols-1 md:grid-cols-2 lg:gap-2 md:gap-3">
                    @php
                        $item = 0;
                    @endphp
                    @foreach ($randomNews as $news)
                        @if ($item < 2)
                            <div class="caption hover:scale-95 transition-all duration-500 mb-5">
                                <img src="{{ asset('storage/' . $news->image) }}"
                                    class="aspect-[4/3] shadow-md brightness-50 mb-5"
                                    alt="{{ $news->title }}" />

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
@else
<p class="text-center lg:text-2xl mt-40 text-slate-500 font-semibold">News Not Found!</p>
<div class="flex justify-center">
<img src="/img/not-found.png" class="lg:w-1/4 drop-shadow-xl" alt="not found" />
</div>
<p class="text-center text-xs mb-20">

</p>
@endif
@endsection
