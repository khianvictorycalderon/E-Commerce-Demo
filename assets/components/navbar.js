function NavBarComponent({ 
  title = "E-Shop", 
  image = null, 
  buttons = [], 
  buttonsAlignment = "right", 
  className = "" 
}) {
  let mobileOpen = false;

  // Create navbar container
  const nav = document.createElement("nav");
  nav.className = `fixed top-0 left-0 w-full shadow z-50 bg-white ${className}`;

  // Overlay for mobile menu
  const overlay = document.createElement("div");
  overlay.className = "fixed inset-0 bg-black/40 z-40 hidden lg:hidden";
  overlay.onclick = () => toggleMobile(false);
  document.body.appendChild(overlay);

  // Inner container
  const container = document.createElement("div");
  container.className = "max-w-7xl mx-auto flex items-center justify-between relative px-4 md:px-8 lg:px-32 py-4";

  // Logo & Title
  const logoDiv = document.createElement("div");
  logoDiv.className = "flex gap-2 items-center";

  if (image) {
    const imgEl = document.createElement("img");
    imgEl.src = image;
    imgEl.alt = `${title} Logo`;
    imgEl.className = "hidden md:block h-[50px] w-auto my-2";
    logoDiv.appendChild(imgEl);
  }

  const titleEl = document.createElement("h1");
  titleEl.className = "my-4 md:my-0 font-bold tracking-tight text-base md:text-lg lg:text-xl";
  titleEl.textContent = title;
  logoDiv.appendChild(titleEl);

  container.appendChild(logoDiv);

  // Desktop buttons
  const desktopBtns = document.createElement("div");
  desktopBtns.className = `hidden lg:flex ${buttonsAlignment === "center" ? "absolute left-1/2 -translate-x-1/2 z-10" : "ml-auto"}`;

  buttons.forEach((btn, i) => {
    const button = document.createElement("button");
    button.textContent = btn.label;
    button.className = `px-4 py-2 rounded-xl transition cursor-pointer ${btn.className || ""}`;
    button.onclick = btn.action;
    desktopBtns.appendChild(button);
  });

  container.appendChild(desktopBtns);

  // Mobile hamburger
  const mobileBtn = document.createElement("div");
  mobileBtn.className = "lg:hidden";
  const toggleBtn = document.createElement("button");
  toggleBtn.className = "p-2 text-2xl font-bold rounded-lg hover:bg-white/10";
  toggleBtn.textContent = "☰";
  toggleBtn.onclick = () => toggleMobile(!mobileOpen);
  mobileBtn.appendChild(toggleBtn);
  container.appendChild(mobileBtn);

  nav.appendChild(container);

  // Mobile menu container
  const mobileMenu = document.createElement("div");
  mobileMenu.className = "lg:hidden mt-2 bg-inherit text-inherit pb-4 hidden";
  buttons.forEach((btn, i) => {
    const button = document.createElement("button");
    button.className = "block w-full text-center py-2";
    button.textContent = btn.label;
    button.onclick = () => {
      toggleMobile(false);
      btn.action();
    };
    mobileMenu.appendChild(button);
  });
  nav.appendChild(mobileMenu);

  // Toggle function
  function toggleMobile(open) {
    mobileOpen = open;
    overlay.classList.toggle("hidden", !mobileOpen);
    mobileMenu.classList.toggle("hidden", !mobileOpen);
    toggleBtn.textContent = mobileOpen ? "✖" : "☰";
  }

  return nav;
}