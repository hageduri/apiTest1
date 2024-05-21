<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <title>Department of Education</title>
    <style>
        .calendar ul li{
            width: calc(100%/7);
            position: relative;
        }
        .calendar .days li{
            cursor: pointer;
            margin-top: 30px;
            z-index: 1;
        }
        .calendar .days li::before{
            position: absolute;
            content: "";
            height: 40px;
            width: 40px;
            top: 50%;
            left: 50%;
            z-index: -1;
            transform: translate(-50%, -50%);
            border-radius: 50%;
        }
        .days li:hover::before{
            background: #f2f2f2;
            z-index: -1;
        }
        .days li.inactive{
            color: #aaa;
        }
        .days li.active{
            color: #fff;
        }
        .days  li.active::before{
            background: rgb(14, 116, 144);

        }

        /* .marquee{
            animation: marquee 20s linear infinite;
        } */

        .marquee:hover{
            animation-play-state: paused;
        }

        /* @keyframes marquee{
            0%{transform: translateX(100%);}
            100%{transform: translateX(-100%);}
        } */
    </style>
    {{-- <style>
        body:::-webkit-scrollbar{
            display: none;
        }
    </style> --}}
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
    <section class="flex justify-center w-full h-auto border-b border-collapse">
      @include('homepage.section2')
    </section>

    {{-- banner: section 3 --}}
    <section class="flex justify-center w-full">
        @include('homepage.section3')
    </section>

    <section class="flex justify-center w-full">
        @include('homepage.section3a')
    </section>

    {{-- about section 4 --}}
    <section class="flex justify-center w-full mt-4">
        @include('homepage.section4')
    </section>

    {{-- blog section 5 --}}
    <section class="flex justify-center w-full mt-4">
        @include('homepage.section5')
    </section>

    {{-- glance section 6 --}}
    <section class="flex justify-center w-full mt-4 ">
        @include('homepage.section6')
    </section>

    {{-- gallery and calender section 7 --}}
    <section class="flex justify-center w-full mt-4 bg-cyan-700">
        @include('homepage.section7')
    </section>


    {{-- footer section 8 --}}
    <section class="flex justify-center w-full shadow-lg border-t mt-4">
        @include('homepage.section8')

    </section>

    <header class="grid grid-cols-2 items-center gap-2 lg:grid-cols-3">

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

</body>
</html>
