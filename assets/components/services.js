export const ServicesComponent = `
<section id="services" class="relative min-h-screen w-full flex items-center bg-gray-800 text-white">
  <div class="container mx-auto px-6 lg:px-20 py-12 grid gap-12">

    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto space-y-3">
      <h2 class="text-blue-400 text-lg">
        Our Services
      </h2>
      <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold">
        What We Offer
      </h3>
      <p class="text-gray-300 text-lg md:text-xl">
        Essential tools to help customers shop easily — nothing unnecessary.
      </p>
    </div>

    <!-- Service Cards -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <div class="rounded-lg border border-gray-800 bg-gray-700 p-6 text-center hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2 text-blue-400">Secure Checkout</h4>
        <p class="text-gray-300 text-sm">Fast and protected payment process.</p>
      </div>

      <div class="rounded-lg border border-gray-800 bg-gray-700 p-6 text-center hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2 text-blue-400">Order Tracking</h4>
        <p class="text-gray-300 text-sm">Know exactly where your orders are.</p>
      </div>

      <div class="rounded-lg border border-gray-800 bg-gray-700 p-6 text-center hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2 text-blue-400">Product Management</h4>
        <p class="text-gray-300 text-sm">Simple CRUD for products and inventory.</p>
      </div>

      <div class="rounded-lg border border-gray-800 bg-gray-700 p-6 text-center hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2 text-blue-400">Customer Support</h4>
        <p class="text-gray-300 text-sm">Basic contact and inquiry handling.</p>
      </div>
    </div>

  </div>
</section>
`;