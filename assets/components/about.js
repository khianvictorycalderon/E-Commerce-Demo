export const AboutComponent = `
<section
  id="about"
  class="relative min-h-screen flex items-center bg-gray-900 text-white">

  <div
    class="container mx-auto px-6 lg:px-20 py-16 grid gap-12 md:gap-16 lg:grid-cols-2 items-center">

    <!-- LEFT CONTENT -->
    <div class="flex flex-col justify-center space-y-6 text-center lg:text-left">
      
      <h2 class="text-blue-400 text-base sm:text-lg mb-1" data-aos="fade-down">
        About E-Commerce Demo
      </h2>

      <h3
        class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight"
        data-aos="fade-down">
        Your One-Stop Online Store
      </h3>

      <p
        class="text-gray-300 text-base sm:text-lg md:text-xl max-w-xl mx-auto lg:mx-0"
        data-aos="fade-down">
        We deliver high-quality products at unbeatable prices, with fast shipping
        and excellent customer support. Discover curated collections and exclusive
        deals for every shopper.
      </p>
    </div>

    <!-- RIGHT STATS CARDS -->
    <div
      class="grid gap-6 sm:grid-cols-2 lg:grid-cols-2 justify-items-center lg:justify-items-start">

      <div class="rounded-lg border border-gray-800 bg-gray-800 p-6 w-full max-w-xs text-center hover:shadow-lg transition">
        <h4 class="mb-2 text-3xl font-bold text-blue-400">500+</h4>
        <p class="text-gray-300">Products Available</p>
      </div>

      <div class="rounded-lg border border-gray-800 bg-gray-800 p-6 w-full max-w-xs text-center hover:shadow-lg transition">
        <h4 class="mb-2 text-3xl font-bold text-blue-400">20K+</h4>
        <p class="text-gray-300">Happy Customers</p>
      </div>

      <div class="rounded-lg border border-gray-800 bg-gray-800 p-6 w-full max-w-xs text-center hover:shadow-lg transition">
        <h4 class="mb-2 text-3xl font-bold text-blue-400">99%</h4>
        <p class="text-gray-300">On-Time Delivery</p>
      </div>

      <div class="rounded-lg border border-gray-800 bg-gray-800 p-6 w-full max-w-xs text-center hover:shadow-lg transition">
        <h4 class="mb-2 text-3xl font-bold text-blue-400">24/7</h4>
        <p class="text-gray-300">Customer Support</p>
      </div>
    </div>

  </div>
</section>
`;