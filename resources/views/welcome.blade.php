<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> --}}
    <title>Department of Education</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="">
    <section class="flex justify-center w-full">
        <div class="max-w-[1280px] w-full flex justify-between items-center">
            language
        </div>
    </section>


    {{--header section 1--}}
    <section class="flex justify-center w-full h-[120px] border border-x">
        @include('homepage.section1')
    </section>


    {{--navbar section 2 --}}
    <section class="flex justify-center w-full h-[44px] border-b border-collapse">
      @include('homepage.section2')
    </section>

    {{-- banner: section 3 --}}
    <section class="flex justify-center w-full">
        @include('homepage.section3')
    </section>

    {{-- about section 4 --}}
    <section class="flex justify-center w-full">
        @include('homepage.section4')
    </section>

    {{-- blog section 5 --}}
    <section class="flex justify-center w-full">
        @include('homepage.section5')
    </section>

    {{-- glance section 6 --}}
    <section class="flex justify-center w-full">
        @include('homepage.section6')
    </section>

    {{-- gallery and calender section 7 --}}
    <section class="flex justify-center w-full">
        @include('homepage.section7')
    </section>


    {{-- footer section 8 --}}
    <section class="flex justify-center w-full">
        {{-- @include('homepage.section8') --}}
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">

                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Log in
                            </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
    </section>

    @livewireScripts
</body>
</html>
