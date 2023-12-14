<!DOCTYPE html>
<html class="scroll-smooth">

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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ url('img/icon/icon-black.png') }}" />
    <link rel="stylesheet" href="/admin/css/toastr/toastr.min.css">
    <!-- jQuery -->
    <script src="/admin/js/jquery/jquery.min.js"></script>
    <!-- Toastr -->
    <script src="/admin/js/toastr/toastr.min.js"></script>
    @include('style.tailwind')

    <title>{{ $title }} - Akane News</title>
</head>

<body>
    {{-- header start --}}
    @include('layouts.navbar')
    {{-- end header --}}

    {{-- container start --}}
    @yield('container')
    {{-- container end --}}

    {{-- footer start --}}
    @include('layouts.footer')
    {{-- footer end --}}
    <a href="#home"
        class="h-14 w-14 bottom-4 right-4 p-4 bg-dark fixed z-[9999] hidden justify-center items-center rounded-full hover:animate-pulse shadow-sm shadow-slate-100 transition duration-500 ease-in"
        id="to-top">
        <span class="block w-5 h-5 mt-2 rotate-45 border-t-2 border-l-2"></span>
    </a>
    <script>
        // navbar fixed
        window.onscroll = function() {
            const header = document.querySelector("header");
            const fixedNav = header.offsetTop;
            const toTop = document.querySelector("#to-top");

            if (window.pageYOffset > fixedNav) {
                header.classList.add("navbar-fixed");
                toTop.classList.remove("hidden");
                toTop.classList.add("flex");
            } else {
                header.classList.remove("navbar-fixed");
                toTop.classList.remove("flex");
                toTop.classList.add("hidden");
            }
        };

        // hamburger
        const hamburger = document.querySelector("#hamburger");
        const navMenu = document.querySelector("#nav-menu");

        hamburger.addEventListener("click", function() {
            hamburger.classList.toggle("hamburger-active");
            navMenu.classList.toggle("hidden");
        });

        // list categories
        const categories = document.querySelector("#categories");
        const list = document.querySelector("#list");
        const listIcon = document.querySelector(".list-icon");

        categories.addEventListener("click", function() {
            listIcon.classList.toggle("category-list");
            list.classList.toggle("hidden");
        });

        // klik diluar hamburgernya
        window.addEventListener("click", function(e) {
            if (
                e.target != hamburger &&
                e.target != navMenu &&
                e.target != categories
            ) {
                hamburger.classList.remove("hamburger-active");
                navMenu.classList.add("hidden");
                list.classList.add("hidden");
                listIcon.classList.remove("category-list");
            }
        });
    </script>
</body>

</html>
