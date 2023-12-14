<header class="absolute top-0 left-0 z-10 flex items-center w-full transition duration-300 bg-dark">
    <div class="container">
        <div class="relative flex items-center justify-between">
            <div class="px-4">
                <a href="/"
                    class="flex flex-wrap py-5 text-white items-center 2xl:text-2xl text-xl font-semibold"><img
                        src="{{ url('/img/icon/icon-white.png') }}" class="w-12 mr-2" />Akane News</a>
            </div>
            <div class="flex items-center px-4">
                <button id="hamburger" name="hamburger" type="button" class="right-4 lg:hidden absolute block">
                    <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
                </button>

                <nav id="nav-menu"
                    class="hidden absolute 2xl::py-7 py-5 bg-dark shadow-xl rounded-lg max-w-full left-4 right-4 top-24 lg:block lg:static lg:bg-transparent bg-opacity-80 lg:max-w-full lg:shadow-none lg:rounded-none">
                    <div id="list"
                        class="hidden lg:absolute lg:py-5 lg:bg-dark lg:bg-opacity-80 lg:shadow-xl lg:rounded-lg lg:max-w-[250px] xl:right-[26%] lg:right-[32%] lg:top-24">
                        <ul class="lg:block md:flex md:flex-wrap justify-between text-white">
                            @if (!empty($categories))
                                @foreach ($categories as $category)
                                    <li class="group">
                                        <a href="/news?category={{ $category->slug }}"
                                            class="text-white group-hover:text-slate-300 flex py-2 mx-8 text-base">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                            <li class="group">
                                <a href="/category"
                                    class="text-white group-hover:text-slate-300 flex py-2 mx-8 text-base {{ Request::is('category') ? 'active' : '' }}">Other</a>
                            </li>

                        </ul>
                    </div>
                    <div class="lg:flex blog">
                        <ul class="lg:flex flex flex-wrap justify-between">
                            <li class="group">
                                <a href="/"
                                    class="text-white group-hover:text-slate-300 flex py-2 mx-8 2xl:text-lg text-base {{ Request::is('/') ? 'active' : '' }}">Home</a>
                            </li>
                            <li class="group">
                                <a href="/news"
                                    class="text-white group-hover:text-slate-300 flex py-2 mx-8 2xl:text-lg text-base {{ Request::is('news*') ? 'active' : '' }}">News</a>
                            </li>
                            <li class="group">
                                <a id="categories"
                                    class="cursor-pointer text-white group-hover:text-slate-300 flex py-2 mx-8 2xl:text-lg text-base items-center {{ Request::is('category') ? 'active' : '' }}">Categories
                                    <i
                                        class="fa-solid fa-chevron-down ml-2 text-xs transition duration-500 list-icon"></i></a>
                            </li>
                            <li class="group">
                                <a href="/contact"
                                    class="text-white group-hover:text-slate-300 flex py-2 mx-8 2xl:text-lg text-base {{ Request::is('contact') ? 'active' : '' }}">Contact
                                    Us</a>
                            </li>
                            <li class="group">
                                <a href="/login"
                                    class="text-dark bg-white px-5 group-hover:bg-opacity-80 flex py-2 mx-4 2xl:text-lg text-base items-center rounded-full font-medium"><i
                                        class="fa-solid fa-circle-user text-xl mr-2"></i>Login</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
