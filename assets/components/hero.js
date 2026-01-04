export const HeroComponent = `
    <section class="relative h-screen flex items-center overflow-hidden bg-white text-gray-900">
        <div class="container mx-auto px-6 py-12 lg:py-20 grid gap-12 lg:grid-cols-2 items-center">

            <!-- LEFT -->
            <div class="space-y-6 flex flex-col justify-center">
            <span class="inline-block rounded-full bg-emerald-100 text-emerald-700 px-4 py-1 text-sm font-medium">
                New Season • Up to 40% Off
            </span>

            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                Shop smart. Look modern.
                <span class="text-emerald-600">Feel confident.</span>
            </h1>

            <p class="text-gray-600 text-lg md:text-xl leading-relaxed max-w-lg">
                Curated collections, fast checkout, and prices you’ll love. 
                Discover thousands of products trusted by customers worldwide.
            </p>

            <!-- SEARCH -->
            <div class="flex items-center gap-2 bg-white rounded-2xl shadow-sm border px-4 py-2 max-w-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="11" cy="11" r="7"></circle>
                <line x1="16.5" y1="16.5" x2="21" y2="21"></line>
                </svg>
                <input
                type="text"
                placeholder="Search products…"
                class="w-full outline-none text-gray-700 placeholder-gray-400"
                />
            </div>

            <!-- CTA -->
            <div class="flex flex-wrap gap-3">
                <button class="px-5 py-3 rounded-xl bg-emerald-600 text-white font-medium hover:bg-emerald-700 transition">
                Shop Now
                </button>

                <button class="px-5 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                View Collections
                </button>
            </div>
            </div>

            <!-- RIGHT -->
            <div class="relative flex justify-center lg:justify-end">
            <div class="rounded-3xl bg-gray-100 aspect-square max-w-sm sm:max-w-md flex items-center justify-center shadow-inner">
                <span class="text-gray-400">Product Image / Banner</span>
            </div>

            <div class="absolute -bottom-4 -right-4 bg-white shadow-xl rounded-2xl px-5 py-3 flex items-center gap-3 border">
                <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                <p class="text-sm font-medium text-gray-700">Fast Shipping Available</p>
            </div>
            </div>

        </div>
    </section>
`;