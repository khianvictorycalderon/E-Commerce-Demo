export const HeroComponent = `
    <section class="relative  text-white overflow-hidden  ">
      <div class="absolute inset-0 bg-black opacity-50"></div>
      <div
        class="absolute inset-0 bg-cover bg-center "
               style="background-image: url('https://www.leadsnextech.com/_next/static/media/bg.153fe1e6.jpg'); filter: brightness(0.4);"

      ></div>

      <div class="container mx-auto lg:px-12 px-5 py-24 md:py-32 relative z-10 lg:h-[90vh]">
        <div class="flex flex-col md:flex-row items-center justify-around">
          <div class="w-full md:w-1/2 mb-12 md:mb-0 relative">
            <h1 class="text-5xl md:text-8xl font-bold mb-6 leading-tight ">
              Leads
              <br />
              <span class="bg-gradient-to-r from-blue-700 via-green-400 to-indigo-400 inline-block text-transparent bg-clip-text">
                NexTech
              </span>
            </h1>

            <p class="text-xl mb-5 text-gray-300 ">
              Harnessing Research for developing Sustainable, Scalable, &
              Impactful Solutions.
            </p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 ">
              <button class="group relative w-full sm:w-auto px-6 py-3 min-w-[160px]">
                <div class="absolute inset-0 bg-gradient-to-r from-violet-600 to-cyan-600 rounded-lg"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-violet-600 to-cyan-600 rounded-lg lg:blur-md blur-0 group-hover:opacity-60 transition-opacity duration-500"></div>
                <div class="relative flex items-center justify-center gap-2">
                  <span class="text-white font-medium">Get Started</span>
                  <svg
                    class="w-5 h-5 text-white transform group-hover:translate-x-1 transition-transform"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth="2"
                      d="M13 7l5 5m0 0l-5 5m5-5H6"
                    />
                  </svg>
                </div>
              </button>

              <button class="w-full sm:w-auto px-6 py-3 rounded-lg border border-white/10 bg-white/5 backdrop-blur-lg text-white/70 hover:bg-white/10 hover:text-white transition-all min-w-[160px]">
                Documentation
              </button>
            </div>
           
          </div>

          <div class="w-full md:w-2/5 md:pl-12 ">
            <div class="bg-white bg-opacity-10 backdrop-filter md:backdrop-blur-lg relative  rounded-xl p-8 shadow-2xl">
              <h2 class="text-2xl font-semibold mb-6">Why Choose Us?</h2>
              <img
                src="img/leadsNexTech-logo-transparent.png"
                alt="Logo"
                class="h-16 right-2 top-2 drop_shadow lg:block md:block hidden  absolute"
              />
              <ul class="space-y-4">
                <li class="flex items-center">
                  <svg
                    class="w-6 h-6 mr-3 text-yellow-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth="2"
                      d="M13 10V3L4 14h7v7l9-11h-7z"
                    ></path>
                  </svg>
                  <span>Data-Driven EarthTech Solutions</span>
                </li>
                <li class="flex items-center">
                  <svg
                    class="w-6 h-6 mr-3 text-green-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth="2"
                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                    ></path>
                  </svg>
                  <span>Human-Centric AI & Analytics</span>
                </li>
                <li class="flex items-center">
                  <svg
                    class="w-6 h-6 mr-3 text-purple-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth="2"
                      d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"
                    ></path>
                  </svg>
                  <span>NextGen Technology for a Sustainable Future</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="absolute bottom-0 left-0 right-0">
        <svg
          viewBox="0 0 1440 120"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
            fill="white"
          />
        </svg>
      </div>
    </section>
`;