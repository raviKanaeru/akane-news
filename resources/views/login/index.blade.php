<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ url('img/icon/icon-black.png') }}" />
    @include('style.tailwind')
    <title>{{ $title }} - Akane Celestial</title>
</head>

<body class="bg-white h-screen">
    <div class="flex flex-wrap justify-center">
        <div class="sm:w-1/2">
            <div class="container">
                <div class="px-4 py-24">
                    <div class="mb-6">
                        <div class="flex flex-wrap text-dark items-center text-xl font-light justify-center mb-4">
                            <img src="{{ url('img/icon/icon-black.png') }}" class="w-12 mr-2" />Akane News
                        </div>
                        <h2 class="text-3xl font-extralight text-center">Welcome User</h2>
                    </div>
                    <div class="mt-5 lg:px-24 md:px-5">
                        @if (session()->has('loginError'))
                            <div class="mb-5 text-center text-red-700">
                                {{ session('loginError') }}
                            </div>
                        @endif
                        <form action="/login" method="post">
                            @csrf
                            <div class="mb-5">
                                <label for="email">Email</label>
                                <input type="email" placeholder="Masukkan Email" id="email"
                                    class="shadow border rounded-md w-full py-2 px-3 text-slate-500 mt-1 focus:outline-none"
                                    autocomplete="off" autofocus required name="email" value="{{ old('email') }}"
                                    oninvalid="InvalidMsgEmail(this);" oninput="InvalidMsgEmail(this);" />
                            </div>
                            <div class="mb-5">
                                <label for="password">Password</label>
                                <input type="password" id="password" placeholder="Masukkan Password"
                                    class="shadow border rounded-md w-full py-2 px-3 text-slate-400 mt-1 focus:outline-none"
                                    name="password" required />
                            </div>
                            <div class="md:mb-5 mb-3">
                                <button type="submit"
                                    class="w-full py-2 px-3 text-white rounded-sm bg-dark font-semibold">
                                    Log in
                                </button>
                            </div>
                        </form>
                        <div>
                            <p class="text-center text-sm font-normal">
                                Back to home?
                                <a href="/" class="font-semibold">Go</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sm:w-1/2 sm:inline-flex hidden w-full relative">
            <img src="{{ url('img/bg-login/bg-login.jpg') }}" class="h-screen object-cover w-full brightness-50"
                alt="bg-login" />
            <div
                class="absolute backdrop-opacity-10 backdrop-invert bg-white/3 top-[20%] overflow-hidden text-white shadow-xl py-10 px-12 z-10 lg:left-[28%] md:left-[15%] md:right-[15%] rounded-lg scale-80 md:max-w-[350px] mx-auto sm:left-[10%] sm:right-[10%]">
                <h2 class="mb-2 text-xl">
                    <div class="flex flex-wrap text-white items-center text-xl font-light justify-start mb-4">
                        <img src="{{ url('img/icon/icon-white.png') }}" class="w-12 mr-2" />Akane News
                    </div>
                </h2>
                <p class="lg:text-sm text-xs font-light text-justify lg:line-clamp-5 md:line-clamp-4 sm:line-clamp-3">
                    Explore a World of Stories and Insights. Welcome to the realm of web blogs, where words weave
                    connections and tales come alive. Discover fresh perspectives and uncover inspiring narratives with
                    every click.
                </p>
                <div class="border-slate-700 w-full pt-5">
                    <div class="flex flex-wrap items-center justify-center mb-5">
                        <!-- instagram -->
                        <a href="https://www.instagram.com/muhammad_ravi27/" target="_blank"
                            class="w-9 h-9 border-slate-300 text-slate-300 hover:border-secondary hover:bg-secondary hover:text-white flex items-center justify-center mr-3 border rounded-full mb-2">
                            <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Instagram</title>
                                <path
                                    d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                            </svg>
                        </a>
                        <!-- email -->

                        <a href="https://www.linkedin.com/in/muhammad-ravi-0a07a5274/" target="_blank"
                            class="w-9 h-9 border-slate-300 text-slate-300 hover:border-secondary hover:bg-secondary hover:text-white flex items-center justify-center mr-3 border rounded-full mb-2">
                            <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>LinkedIn</title>
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        <!-- github -->
                        <a href="https://github.com/raviKanaeru/" target="_blank"
                            class="w-9 h-9 border-slate-300 text-slate-300 hover:border-secondary hover:bg-secondary hover:text-white flex items-center justify-center mr-3 border rounded-full mb-2">
                            <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>GitHub</title>
                                <path
                                    d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-slate-500 text-xs font-medium">
                        Copyright &copy; 2023 By
                        <a href="https://www.instagram.com/muhammad_ravi27/" target="_blank"
                            class="text-secondary hover:text-white font-bold">Muhammad Ravi</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function InvalidMsgEmail(textbox) {
            if (textbox.value === '') {
                textbox.setCustomValidity('Required email address.');
            } else if (textbox.validity.typeMismatch) {
                textbox.setCustomValidity('Please enter a valid email address.');
            } else {
                textbox.setCustomValidity('');
            }

            return true;
        }
    </script>
</body>

</html>
