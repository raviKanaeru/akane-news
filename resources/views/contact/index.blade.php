@extends('layouts.main')
@section('container')
    <section class="pt-28" id="home">
        @if (session()->has('success'))
            <script>
                toastr.success('{{ session('success') }}');
            </script>
        @endif
        <div class="container">
            <!-- bottom hero -->
            <div class="px-4 mt-8 mb-5">
                <h6 class="text-sm text-center font-normal text-slate-500">Get question?</h6>
                <h1 class="lg:text-3xl  text-center font-semibold mb-4">{{ $title }}</h1>
                <p class="text-center mx-auto text-slate-400 text-xs font-medium lg:w-1/2">Lorem ipsum dolor sit amet
                    consectetur
                    adipisicing elit.
                    Animi,
                    nisi Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, magnam eos? Mollitia aliquam dolore
                    vel deleniti, distinctio reiciendis rerum saepe repellendus consequatur, tempora voluptas corrupti
                    temporibus suscipit facere! Iusto, nihil?</p>

                <form class="my-8" action="/contact" method="POST">
                    @csrf
                    <div class="lg:w-1/2 lg:mx-auto w-full">
                        <div class="w-full px-4 mb-8">
                            <label for="name" class="text-slate-500 text-base font-bold">Name</label>
                            <input type="text" id="name"
                                class="bg-slate-200 text-slate-700 focus:outline-none focus:ring-slate-500 focus:ring-1 focus:border-slate-500 w-full p-2 rounded-md"
                                name="name" />
                            @error('name')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-full px-4 mb-8">
                            <label for="email" class="text-slate-500 text-base font-bold">Email</label>
                            <input type="email" id="email"
                                class="bg-slate-200 text-dark focus:outline-none focus:ring-slate-500 focus:ring-1 focus:border-slate-500 w-full p-2 rounded-md"
                                name="email" />
                            @error('email')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-full px-4 mb-8">
                            <label for="message" class="text-slate-500 text-base font-bold">Message</label>
                            <textarea id="message"
                                class="bg-slate-200 text-dark focus:outline-none focus:ring-slate-500 focus:ring-1 focus:border-slate-500 w-full h-32 p-2 rounded-md"
                                name="message"></textarea>
                            @error('message')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-full px-4">
                            <button
                                class="bg-dark hover:shadow-lg hover:opacity-75 w-full px-8 py-3 text-base font-semibold text-white transition duration-300 ease-in-out rounded-full"
                                type="submit">
                                Kirim
                            </button>
                        </div>
                    </div>
                </form>
                <div>

                </div>
            </div>


            <!-- end bottom hero -->
        </div>
        </div>
    </section>
    <!-- end section hero blogs -->
@endsection
