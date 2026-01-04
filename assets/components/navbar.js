// --- SVG Icons ---
const hamburgerSVG = `
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
     viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <line x1="4" y1="6"  x2="20" y2="6"></line>
  <line x1="4" y1="12" x2="20" y2="12"></line>
  <line x1="4" y1="18" x2="20" y2="18"></line>
</svg>
`;

const closeSVG = `
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
     viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <line x1="18" y1="6"  x2="6"  y2="18"></line>
  <line x1="6"  y1="6"  x2="18" y2="18"></line>
</svg>
`;

// --- COMPONENT ---
function NavBarComponent({
  title = "E-Shop",
  image = null,
  buttons = [],
  buttonsAlignment = "right",
  className = ""
}) {
  let mobileOpen = false;

  // Build buttons HTML
  const desktopButtonsHTML = buttons
    .map(
      (b) => `
        <button class="px-4 py-2 rounded-xl transition cursor-pointer ${b.className || ""}">
          ${b.label}
        </button>
      `
    )
    .join("");

  const mobileButtonsHTML = buttons
    .map(
      (b) => `
        <button class="block w-full text-center py-2">
          ${b.label}
        </button>
      `
    )
    .join("");

  // --- TEMPLATE ---
  const navbar = `
    <nav class="fixed top-0 left-0 w-full shadow z-50 bg-white ${className}">
      <div class="max-w-7xl mx-auto flex items-center justify-between relative px-4 md:px-8 lg:px-32 py-4">

        <div class="flex gap-2 items-center">
          ${
            image
              ? `<img src="${image}" alt="${title} Logo"
                  class="hidden md:block h-[50px] w-auto my-2" />`
              : ""
          }
          <h1 class="font-bold tracking-tight text-base md:text-lg lg:text-xl">
            ${title}
          </h1>
        </div>

        <div class="hidden lg:flex ${
          buttonsAlignment === "center"
            ? "absolute left-1/2 -translate-x-1/2 z-10"
            : "ml-auto"
        }">
          ${desktopButtonsHTML}
        </div>

        <div class="lg:hidden">
          <button id="toggleBtn" class="p-2 rounded-lg hover:bg-black/5">
            ${hamburgerSVG}
          </button>
        </div>
      </div>

      <div id="mobileMenu" class="lg:hidden mt-2 bg-white pb-4 hidden">
        ${mobileButtonsHTML}
      </div>
    </nav>

    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden"></div>
  `;

  // Create wrapper element
  const wrapper = document.createElement("div");
  wrapper.innerHTML = navbar;

  const nav = wrapper.querySelector("nav");
  const toggleBtn = wrapper.querySelector("#toggleBtn");
  const overlay = wrapper.querySelector("#overlay");
  const mobileMenu = wrapper.querySelector("#mobileMenu");

  // Attach button actions
  const allButtons = [...nav.querySelectorAll("button")];
  allButtons.forEach((btn, index) => {
    if (index < buttons.length) {
      btn.onclick = () => buttons[index].action();
    }
  });

  // Toggle menu
  function toggleMobile(open) {
    mobileOpen = open;
    overlay.classList.toggle("hidden", !open);
    mobileMenu.classList.toggle("hidden", !open);
    toggleBtn.innerHTML = open ? closeSVG : hamburgerSVG;
  }

  toggleBtn.onclick = () => toggleMobile(!mobileOpen);
  overlay.onclick = () => toggleMobile(false);

  return nav;
}