export const HeroComponent = `
<section class="relative h-screen flex items-center overflow-hidden bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600 text-white">

  <div class="container mx-auto px-6 pt-24 pb-12 lg:pt-12 grid gap-12 lg:grid-cols-2 items-center">

    <!-- LEFT -->
    <div class="space-y-6 flex flex-col justify-center">

      <!-- Promo Badge -->
      <span class="inline-block rounded-full bg-blue-100 text-blue-700 px-4 py-1 text-sm font-medium">
        New Season • Up to 40% Off
      </span>

      <!-- Headline -->
      <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
        Shop smart. Look modern.
        <span class="text-blue-200">Feel confident.</span>
      </h1>

      <!-- Subtitle -->
      <p class="text-blue-100 text-lg md:text-xl leading-relaxed max-w-lg">
        Curated collections, fast checkout, and prices you'll love. 
        Discover thousands of products trusted by customers worldwide.
      </p>

      <!-- CTA Buttons -->
      <div class="flex flex-wrap gap-3">
        <button class="px-5 py-3 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-medium transition">
          Shop Now
        </button>

        <button class="px-5 py-3 rounded-xl border border-white/30 text-white font-medium hover:bg-white/10 transition">
          View Collections
        </button>
      </div>

    </div>

    <!-- RIGHT IMAGE -->
    <div class="relative flex justify-center lg:justify-end">
      <div class="rounded-3xl aspect-square max-w-sm sm:max-w-md flex items-center justify-center">
        <img src="images/kushima.png">
      </div>

      <div class="absolute -bottom-4 -right-4 bg-white/20 shadow-xl rounded-2xl px-5 py-3 flex items-center gap-3 border border-white/30">
        <div class="w-3 h-3 rounded-full bg-blue-400"></div>
        <p class="text-sm font-medium text-white">Fast Shipping Available</p>
      </div>
    </div>

  </div>
</section>
`;
