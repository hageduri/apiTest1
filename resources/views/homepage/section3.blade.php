

{{-- <div class="w-full flex items-center justfy-center relative"> --}}

    {{-- <img src="logos/demo1.jpg" class="w-full h-auto" alt="">
    <div class="absolute h-full w-full p-3 flex justify-between items-center">
        <div class="h-12 w-12 p-3 opacity-50 rounded-full left-0 bg-white text-black flex justify-center items-center cursor-pointer">
            <i class="fa-solid fa-arrow-left"></i>
        </div>
        <div class="h-12 w-12 p-3 opacity-50 rounded-full right-0 bg-white text-black flex justify-center items-center cursor-pointer">
            <i class="fa-solid fa-arrow-right"></i>
        </div>
    </div> --}}
    <div class="container m-0 min-w-full h-auto overflow-hidden relative"> {{--container--}}
        <div class="slides flex h-auto w-full">{{--slides--}}
            <div class="slide min-w-full h-auto">{{--slide--}}
                <img src="gallery/img1.png" class="w-full h-auto" alt="">{{--container--}}
            </div>
            <div class="slide min-w-full h-auto">{{--slide--}}
                <img src="gallery/img2.png" class="w-full h-auto" alt="">{{--container--}}
            </div>
            <div class="slide min-w-full h-auto">{{--slide--}}
                <img src="gallery/img3.png" class="w-full h-auto" alt="">{{--container--}}
            </div>
            <div class="slide min-w-full h-auto">{{--slide--}}
                <img src="gallery/img4.jpg" class="w-full h-auto" alt="">{{--container--}}{{--container--}}
            </div>
        </div>
        <div class="slide-controls absolute top-[50%] left-0 -translate-y-[50%] w-[100%] flex justify-between items-center px-3">{{--sli-control--}}
            <button id="prev-btn" class="rounded-full h-10 w-10 bg-white text-black"><i class="fa-solid fa-arrow-left"></i></button>{{--prev--}}
            <button id="next-btn" class="rounded-full h-10 w-10 bg-white text-black"><i class="fa-solid fa-arrow-right"></i></button>{{--next--}}

        </div>
    </div>
{{-- </div> --}}



 <script>
    const slideContainer = document.querySelector('.container');
    const slide = document.querySelector('.slides');
    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const interval = 3000;

    let slides = document.querySelectorAll('.slide');
    let index = 1;
    let slideId;

    const firstClone = slides[0].cloneNode(true);
    const lastClone = slides[slides.length - 1].cloneNode(true);

    firstClone.id = 'first-clone';
    lastClone.id = 'last-clone';

    slide.append(firstClone);
    slide.prepend(lastClone);

    const slideWidth = window.innerWidth;
    console.log(slideWidth);

    slide.style.transform = `translateX(${-slideWidth * index}px)`;

    console.log(slides);

    const startSlide = () => {
    slideId = setInterval(() => {
        moveToNextSlide();
    }, interval);
    };

    const getSlides = () => document.querySelectorAll('.slide');

    slide.addEventListener('transitionend', () => {
    slides = getSlides();
    if (slides[index].id === firstClone.id) {
        slide.style.transition = 'none';
        index = 1;
        slide.style.transform = `translateX(${-slideWidth * index}px)`;
    }

    if (slides[index].id === lastClone.id) {
        slide.style.transition = 'none';
        index = slides.length - 2;
        slide.style.transform = `translateX(${-slideWidth * index}px)`;
    }
    });

    const moveToNextSlide = () => {
        const slideWidth = window.innerWidth;
        console.log(slideWidth);
        console.log(slides);
        slides = getSlides();
        if (index >= slides.length - 1) return;
        index++;
        slide.style.transition = '.7s ease-out';
        slide.style.transform = `translateX(${-slideWidth * index}px)`;
    };

    const moveToPreviousSlide = () => {
    if (index <= 0) return;
    index--;
    const slideWidth = window.innerWidth;
    slide.style.transition = '.7s ease-out';
    slide.style.transform = `translateX(${-slideWidth * index}px)`;
    };

    slideContainer.addEventListener('mouseenter', () => {
    clearInterval(slideId);
    });

    slideContainer.addEventListener('mouseleave', startSlide);
    nextBtn.addEventListener('click', moveToNextSlide);
    prevBtn.addEventListener('click', moveToPreviousSlide);

    startSlide();
 </script>



