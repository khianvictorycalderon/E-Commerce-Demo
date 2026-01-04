export const ServicesComponent = `
<div
  class="w-full h-screen m-auto bg-gray-900 bg-no-repeat bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1620121692029-d088224ddc74?auto=format&fit=crop&w=1600&q=80')]">

  <div
    class="max-w-7xl m-auto md:px-0 px-4 md:my-10 bg-[#111111] rounded-xl overflow-hidden">

    <section class="w-full h-full flex flex-col justify-center md:py-20 py-10 md:px-20 px-2">

      <!-- Heading -->
      <div class="w-fit">
        <h2 class="text-2xl font-bold text-white pb-2">Our Services</h2>
        <div class="rounded-t-full border border-gray-600 overflow-hidden">
          <hr class="border-[3px] border-blue-500 w-[25%]" />
        </div>
      </div>

      <div class="w-full grid md:grid-cols-2 grid-cols-1 gap-6 mt-8">

        <!-- 1 -->
        <div class="flex gap-3">
          <span>
            <svg class="sm:h-10 sm:w-10 h-8 w-8 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l1-5h16l1 5M5 9v10h14V9M9 13h6"/>
            </svg>
          </span>

          <div class="flex flex-col gap-2">
            <h3 class="text-xl font-semibold text-white">Product Catalog</h3>
            <p class="text-gray-400">Organized categories, clean layouts, and smooth browsing.</p>
          </div>
        </div>

        <!-- 2 -->
        <div class="flex gap-3">
          <span>
            <svg class="sm:h-10 sm:w-10 h-8 w-8 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="9" cy="21" r="1"/>
              <circle cx="20" cy="21" r="1"/>
              <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61H19a2 2 0 001.94-1.5L23 6H6"/>
            </svg>
          </span>

          <div class="flex flex-col gap-2">
            <h3 class="text-xl font-semibold text-white">Simple Cart</h3>
            <p class="text-gray-400">Add and manage items easily — nothing unnecessary.</p>
          </div>
        </div>

        <!-- 3 -->
        <div class="flex gap-3">
          <span>
            <svg class="sm:h-10 sm:w-10 h-8 w-8 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="5" width="20" height="14" rx="2" ry="2"/>
              <line x1="2" y1="10" x2="22" y2="10"/>
            </svg>
          </span>

          <div class="flex flex-col gap-2">
            <h3 class="text-xl font-semibold text-white">Secure Checkout</h3>
            <p class="text-gray-400">Minimal, safe, and focused only on essentials.</p>
          </div>
        </div>

        <!-- 4 -->
        <div class="flex gap-3">
          <span>
            <svg class="sm:h-10 sm:w-10 h-8 w-8 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 8a6 6 0 00-12 0v6a6 6 0 0012 0V8z"/>
              <path d="M5 15a7 7 0 0014 0"/>
            </svg>
          </span>

          <div class="flex flex-col gap-2">
            <h3 class="text-xl font-semibold text-white">Customer Support</h3>
            <p class="text-gray-400">Clear, simple support when users need it.</p>
          </div>
        </div>

      </div>
    </section>
  </div>
</div>
`;