@extends('front.template')
@section('content')

    <body class="font-[Poppins] pb-[72px]">
        <x-navbar />
        <nav id="Category"
            class="max-w-[1130px] mx-auto flex overflow-x-auto items-center gap-4 mt-[30px] scroll-snap-x scroll-px-2 md:justify-center">
            @foreach ($categories as $category)
                <a href="{{ route('front.category', $category->slug) }}"
                    class="rounded-full flex-shrink-0 p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] scroll-snap-align-start">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ Storage::url($category->icon) }}" alt="icon" />
                    </div>
                    <span>{{ $category->name }}</span>
                </a>
            @endforeach
        </nav>
        <section id="Featured" class="mt-[30px]">
            <div class="main-carousel w-full">
                @foreach ($featured as $featured_article)
                    <div class="featured-news-card relative w-full h-[550px] flex shrink-0 overflow-hidden">
                        <img src="{{ Storage::url($featured_article->thumbnail) }}"
                            class="thumbnail absolute w-full h-full object-cover" alt="icon" />
                        <div class="w-full h-full bg-gradient-to-b from-[rgba(0,0,0,0)] to-[rgba(0,0,0,0.9)] absolute z-10">
                        </div>
                        <div
                            class="px-5 md:card-detail max-w-[1130px] w-full mx-auto flex items-end justify-between pb-10 relative z-20">
                            <div class="flex flex-col gap-[10px]">
                                <p class="text-white">Featured</p>
                                <a href="{{ route('front.details', $featured_article->slug) }}"
                                    class="font-bold text-4xl leading-[45px] text-white two-lines hover:underline transition-all duration-300">{{ $featured_article->name }}</a>
                                <p class="text-white">{{ $featured_article->created_at->format('M d, Y') }} •
                                    {{ $featured_article->category->name }}</p>
                            </div>
                            <div class="prevNextButtons flex items-center gap-4 mb-[60px]">
                                <button
                                    class="button--previous appearance-none w-[38px] h-[38px] flex items-center justify-center shrink-0 ring-1 ring-white hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300">
                                    <img src="{{ asset('assets/images/icons/arrow.svg') }}" alt="arrow" />
                                </button>
                                <button
                                    class="button--next appearance-none w-[38px] h-[38px] flex items-center justify-center shrink-0 ring-1 ring-white hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300 rotate-180">
                                    <img src="{{ asset('assets/images/icons/arrow.svg') }}" alt="arrow" />
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section id="Up-to-date" class="max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-[70px] px-4">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <h2 class="font-bold text-[26px] text-center leading-[39px] md:text-left">
                    Latest Hot News <br />
                    Good for Curiousity
                </h2>
                <p
                    class="badge-orange rounded-full p-[8px_18px] bg-[#FFECE1] font-bold text-sm leading-[21px] text-[#FF6B18] w-fit">
                    UP TO DATE</p>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 gap-[20px] md:grid-cols-3 gap-[30px]">
                @forelse ($articles as $article)
                    <a href="{{ route('front.details', $article->slug) }}" class="card-news">
                        <div
                            class="rounded-[20px] ring-1 ring-[#EEF0F7] p-[20px] md:p-[26px_20px] flex flex-col gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300 bg-white">
                            <!-- Thumbnail -->
                            <div
                                class="thumbnail-container w-full h-[150px] md:h-[200px] rounded-[20px] flex shrink-0 overflow-hidden relative">
                                <p
                                    class="badge-white absolute top-3 md:top-5 left-3 md:left-5 rounded-full p-[6px_12px] md:p-[8px_18px] bg-white font-bold text-[10px] md:text-xs leading-[15px] md:leading-[18px] uppercase">
                                    {{ $article->category->name }}</p>
                                <img src="{{ Storage::url($article->thumbnail) }}" class="object-cover w-full h-full"
                                    alt="thumbnail" />
                            </div>
                            <!-- Info -->
                            <div class="card-info flex flex-col gap-[6px]">
                                <h3
                                    class="font-bold text-m md:text-lg leading-[21px] md:leading-[27px] text-center md:text-left">
                                    {{ substr($article->name, 0, 25) }}{{ strlen($article->name) > 25 ? '...' : '' }}
                                </h3>
                                <p
                                    class="text-s md:text-sm leading-[18px] md:leading-[21px] text-[#A3A6AE] text-center md:text-left">
                                    {{ $article->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col text-center gap-[14px] items-center">
                        <h2 class="font-bold text-[16px] leading-[22px] md:leading-[39px]">
                            Belum ada berita terbaru
                        </h2>
                    </div>
                @endforelse
            </div>
        </section>
        <section id="Best-authors" class="max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-[70px]">
            <div class="flex flex-col text-center gap-[14px] items-center">
                <p
                    class="badge-orange rounded-full p-[8px_18px] bg-[#FFECE1] font-bold text-sm leading-[21px] text-[#FF6B18] w-fit">
                    BEST AUTHORS</p>
                <h2 class="font-bold text-[26px] leading-[39px]">
                    Explore All Masterpieces <br />
                    Written by People
                </h2>
            </div>
            <div class="m-5 grid grid-cols-1 gap-[30px] md:grid-cols-3 gap-[30px]">
                @forelse ($authors as $author)
                    <a href="{{ route('front.author', $author->slug) }}" class="card-authors">
                        <div
                            class="rounded-[20px] border border-[#EEF0F7] p-[26px_20px] flex flex-col items-center gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300">
                            <div class="w-[70px] h-[70px] flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ Storage::url($author->avatar) }}" class="object-cover w-full h-full"
                                    alt="avatar" />
                            </div>
                            <div class="flex flex-col gap-1 text-center">
                                <p class="font-semibold">{{ $author->name }}</p>
                                <p class="text-sm leading-[21px] text-[#A3A6AE]">{{ $author->article->count() }} Artikel
                                </p>
                            </div>
                        </div>
                    </a>

                @empty
                    <p>Belum ada penulis</p>
                @endforelse

            </div>
        </section>
        <section id="Advertisement" class="max-w-[1130px] mx-auto flex justify-center mt-[70px]">
            <div class="flex flex-col gap-3 shrink-0 w-fit">

                <a href="{{ $ads->link }}">
                    <div
                        class="max-w-50 md:w-[900px] h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
                        <img src="{{ Storage::url($ads->thumbnail) }}" class="object-cover w-full h-full" alt="ads" />
                    </div>
                </a>
                <p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
                    Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
                            src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
                </p>
            </div>
        </section>
        @forelse ($category_lists as $category_list)
            <section id="Latest-category" class="max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-[70px] px-4">
                <!-- Header -->
                <div class="flex flex-col md:flex-row justify-between items-center md:items-center gap-4">
                    <h2
                        class="font-bold text-[20px] md:text-[26px] leading-[30px] md:leading-[39px] text-center md:text-left">
                        Latest For You <br />
                        in {{ $category_list->name }}
                    </h2>
                    <a href="{{ route('front.category', $category_list->slug) }}"
                        class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] text-center">
                        Explore All
                    </a>
                </div>

                <!-- Content -->
                @if ($category_list->article->count() < 1)
                    <div class="flex flex-col text-center gap-[14px] items-center">
                        <h2 class="font-bold text-[16px] md:text-[18px] leading-[22px] md:leading-[39px]">
                            Belum ada berita terbaru
                        </h2>
                    </div>
                @else
                    <div class="flex flex-col md:flex-row gap-5 items-start">
                        <!-- Featured News -->
                        <div
                            class="featured-news-card relative w-full md:w-2/3 h-[250px] md:h-[424px] flex flex-1 rounded-[20px] overflow-hidden">
                            @forelse ($category_featured_lists as $category_featured_list)
                                @if ($category_list->id == $category_featured_list->category_id)
                                    <img src="{{ Storage::url($category_featured_list->thumbnail) }}"
                                        class="thumbnail absolute w-full h-full object-cover" alt="icon" />
                                    <div
                                        class="w-full h-full bg-gradient-to-b from-[rgba(0,0,0,0)] to-[rgba(0,0,0,0.9)] absolute z-10">
                                    </div>
                                    <div class="card-detail w-full flex items-end p-[20px] md:p-[30px] relative z-20">
                                        <div class="flex flex-col gap-[10px]">
                                            <p class="text-white text-sm md:text-base">Featured</p>
                                            <a href="{{ route('front.details', $category_featured_list->slug) }}"
                                                class="font-bold text-[20px] md:text-[30px] leading-[26px] md:leading-[36px] text-white hover:underline transition-all duration-300">
                                                {{ $category_featured_list->name }}
                                            </a>
                                            <p class="text-white text-xs md:text-sm">
                                                {{ $category_featured_list->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="flex flex-col text-center gap-[14px] items-center">
                                    <h2 class="font-bold text-[16px] md:text-[18px] leading-[22px] md:leading-[39px]">
                                        tidak ada berita yang disematkan
                                    </h2>
                                </div>
                            @endforelse
                        </div>

                        <!-- Articles -->
                        <div class="h-fit w-full md:w-1/3 overflow-y-scroll overflow-x-hidden relative custom-scrollbar">
                            <div class="flex flex-col gap-5 shrink-0">
                                @forelse ($articles as $category_article)
                                    @if ($category_article->category_id == $category_list->id)
                                        <a href="{{ route('front.details', $category_article->slug) }}"
                                            class="card py-[2px]">
                                            <div
                                                class="rounded-[20px] border border-[#EEF0F7] p-[10px] md:p-[14px] flex items-center gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300">
                                                <div
                                                    class="w-[100px] md:w-[130px] h-[80px] md:h-[100px] flex shrink-0 rounded-[20px] overflow-hidden">
                                                    <img src="{{ Storage::url($category_article->thumbnail) }}"
                                                        class="object-cover w-full h-full" alt="thumbnail" />
                                                </div>
                                                <div class="flex flex-col justify-center gap-[6px]">
                                                    <h3
                                                        class="font-bold text-sm md:text-lg leading-[21px] md:leading-[27px]">
                                                        {{ substr($category_article->name, 0, 50) }}
                                                        {{ strlen($category_article->name) > 50 ? '...' : '' }}
                                                    </h3>
                                                    <p
                                                        class="text-xs md:text-sm leading-[18px] md:leading-[21px] text-[#A3A6AE]">
                                                        {{ $category_article->created_at->format('M d, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @empty
                                    <div class="flex flex-col text-center gap-[14px] items-center">
                                        <h2 class="font-bold text-[16px] md:text-[18px] leading-[22px] md:leading-[39px]">
                                            Belum ada berita terbaru
                                        </h2>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        @empty
            <div class="flex flex-col text-center gap-[14px] items-center">
                <h2 class="font-bold text-[16px] md:text-[18px] leading-[22px] md:leading-[39px]">
                    Belum ada kategori
                </h2>
            </div>
        @endforelse



    </body>
@endsection
@push('after-styles')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    <style>
        /* Scroll snapping CSS */
        .scroll-snap-x {
            display: flex;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            /* For Firefox */
        }

        .scroll-snap-x::-webkit-scrollbar {
            display: none;
            /* For Chrome, Safari, and Edge */
        }

        .scroll-snap-align-start {
            scroll-snap-align: start;
        }
    </style>
@endpush

@push('after-scripts')
    <script src="js/two-lines-text.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- JavaScript -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="js/carousel.js"></script>
@endpush
