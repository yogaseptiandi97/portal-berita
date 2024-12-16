<nav id="Navbar" class="m-8 md:max-w-[1130px] mx-auto mt-[30px]">
    <!-- Wrapper -->
    <div class="flex justify-between items-center">
        <!-- Logo and Search -->
        <div class="logo-container flex gap-[30px] items-center">
            <a href="{{ route('front.index') }}" class="flex shrink-0">
                <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="logo" />
            </a>
            <div class="hidden md:block h-12 border border-[#E8EBF4]"></div>
            <form method="GET" action="{{ route('disfrontplay.search') }}"
                class="hidden md:flex w-[450px] items-center rounded-full border border-[#E8EBF4] p-[12px_20px] gap-[10px] focus-within:ring-2 focus-within:ring-[#FF6B18] transition-all duration-300">
                @csrf
                <button type="submit" class="w-5 h-5 flex shrink-0">
                    <img src="{{ asset('assets/images/icons/search-normal.svg') }}" alt="icon" />
                </button>
                <input type="text" name="keyword"
                    class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#A3A6AE]"
                    placeholder="Search hot trendy news today..." />
            </form>
        </div>

        <!-- Menu Toggle for Mobile -->
        <button id="menu-toggle" class="md:hidden p-2 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <!-- Right Menu -->
        <div class="hidden md:flex items-center gap-3">
            <a href=""
                class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18]">
                Upgrade Pro
            </a>
            <a href=""
                class="rounded-full p-[12px_22px] flex gap-[10px] font-bold transition-all duration-300 bg-[#FF6B18] text-white hover:shadow-[0_10px_20px_0_#FF6B1880]">
                <div class="w-6 h-6 flex shrink-0">
                    <img src="{{ asset('assets/images/icons/favorite-chart.svg') }}" alt="icon" />
                </div>
                <span>Post Ads</span>
            </a>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="m-4 hidden flex-col gap-4 mt-4 md:hidden">
        <form method="GET" action="{{ route('disfrontplay.search') }}"
            class="w-full flex items-center rounded-full border border-[#E8EBF4] p-[12px_20px] gap-[10px] focus-within:ring-2 focus-within:ring-[#FF6B18] transition-all duration-300">
            @csrf
            <button type="submit" class="w-5 h-5 flex shrink-0">
                <img src="{{ asset('assets/images/icons/search-normal.svg') }}" alt="icon" />
            </button>
            <input type="text" name="keyword"
                class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#A3A6AE]"
                placeholder="Search hot trendy news today..." />
        </form>
        <a href=""
            class="rounded-full p-[12px_22px] mb-4 flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18]">
            Upgrade Pro
        </a>
        <a href=""
            class="rounded-full p-[12px_22px] flex gap-[10px] font-bold transition-all duration-300 bg-[#FF6B18] text-white hover:shadow-[0_10px_20px_0_#FF6B1880]">
            <div class="w-6 h-6 flex shrink-0">
                <img src="{{ asset('assets/images/icons/favorite-chart.svg') }}" alt="icon" />
            </div>
            <span>Post Ads</span>
        </a>
    </div>
</nav>


