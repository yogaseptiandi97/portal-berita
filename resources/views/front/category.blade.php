@extends('front.template')
@section('content')

    <body class="font-[Poppins] pb-[83px]">
        <x-navbar />
        <nav id="Category"
            class="max-w-[1130px] mx-auto flex overflow-x-auto items-center gap-4 mt-[30px] scroll-snap-x scroll-px-2 md:justify-center">
            @foreach ($categories as $item_category)
                <a href="{{ route('front.category', $item_category->slug) }}"
                    class="rounded-full flex-shrink-0 p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] scroll-snap-align-start">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ Storage::url($item_category->icon) }}" alt="icon" />
                    </div>
                    <span>{{ $item_category->name }}</span>
                </a>
            @endforeach
        </nav>
        <section id="Category-result" class="max-w-[1130px] mx-auto flex items-center flex-col gap-[30px] mt-[70px]">
            <h1 class="text-4xl leading-[45px] font-bold text-center">
                Explore Our <br />
                {{ $category->name }} News
            </h1>
            <div id="search-cards"
                class="m-5 grid grid-cols-1 gap-[30px] sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-[30px] ">
                @forelse ($category->article as $article)
                    <a href="{{ route('front.details', $article->slug) }}" class="card">
                        <div
                            class="flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] rounded-[20px] overflow-hidden bg-white">
                            <div class="thumbnail-container h-[200px] relative rounded-[20px] overflow-hidden">
                                <div
                                    class="badge absolute left-5 top-5 bottom-auto right-auto flex p-[8px_18px] bg-white rounded-[50px]">
                                    <p class="text-xs leading-[18px] font-bold uppercase">{{ $article->category->name }}</p>
                                </div>
                                <img src="{{ Storage::url($article->thumbnail) }}" alt="thumbnail photo"
                                    class="w-full h-full object-cover" />
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <h3 class="text-lg leading-[27px] font-bold">{{ substr($article->name, 0, 50) }}
                                    {{ strlen($article->name) > 50 ? '...' : '' }}</h3>
                                <p class="text-sm leading-[21px] text-[#A3A6AE]">
                                    {{ $article->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col text-center gap-[14px] items-center">
                        <h2 class="font-bold text-[16px] leading-[39px]">
                            Belum ada berita terbaru
                        </h2>
                    </div>
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
    </body>
@endsection
@push('after-styles')
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
