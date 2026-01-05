export const FooterComponent = `
<footer class="bg-gray-900 text-white pt-12 pb-8 w-full">
  <div class="container mx-auto px-4">

    <div
      class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8
             text-center md:text-center lg:text-left
             items-center lg:items-start">

      <!-- Company Info -->
      <div class="space-y-4">
        <div class="flex items-center justify-center lg:justify-start">
          <svg class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          <span class="ml-2 text-xl font-bold">E-Commerce Demo</span>
        </div>

        <p class="text-gray-400">Developed by <a class="underline font-semibold cursor-pointer" href="https://khian.netlify.app" target="_blank">Khian Victory D. Calderon</a></p>

        <div class="flex justify-center lg:justify-start space-x-4">
          <!-- social icons ... unchanged -->
        </div>
      </div>

      <!-- Quick Links -->
      <div class="space-y-4">
        <h3 class="text-lg font-semibold">Quick Links</h3>
        <ul class="space-y-2">
          <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Services</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Pricing</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Blog</a></li>
        </ul>
      </div>

      <!-- Services -->
      <div class="space-y-4">
        <h3 class="text-lg font-semibold">Services</h3>
        <ul class="space-y-2">
          <li><a href="#" class="text-gray-400 hover:text-white transition">Web Development</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Mobile Apps</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">UI/UX Design</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Digital Marketing</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Cloud Solutions</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="space-y-4">
        <h3 class="text-lg font-semibold">Contact Us</h3>
        <address class="not-italic text-gray-400">
          <p>123 Business Ave</p>
          <p>San Francisco, CA 94107</p>
          <p class="mt-2">
            Email:
            <a href="mailto:info@company.com" class="hover:text-white transition">
              info@company.com
            </a>
          </p>
          <p>
            Phone:
            <a href="tel:+11234567890" class="hover:text-white transition">
              +1 (123) 456-7890
            </a>
          </p>
        </address>
      </div>

    </div>

    <div
      class="border-t border-gray-800 pt-6
             flex flex-col md:flex-row
             items-center
             justify-center md:justify-between
             text-center md:text-left">

      <p class="text-gray-500 text-sm mb-4 md:mb-0">
        © 2025 E-Commerce Demo. All rights reserved.
      </p>

      <div class="flex space-x-6">
        <a href="#" class="text-gray-500 hover:text-white text-sm transition">Privacy Policy</a>
        <a href="#" class="text-gray-500 hover:text-white text-sm transition">Terms of Service</a>
        <a href="#" class="text-gray-500 hover:text-white text-sm transition">Cookies</a>
      </div>
    </div>

  </div>
</footer>
`;