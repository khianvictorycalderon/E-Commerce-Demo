import { NavBarComponent, attachNavBarActions } from "./components/navbar.js";
import { AboutComponent } from "./components/about.js";
import { FooterComponent } from "./components/footer.js";
import { HeroComponent } from "./components/hero.js";
import { ServicesComponent } from "./components/services.js";

// Fill all navbar containers
document.querySelectorAll(".navbar").forEach(navbarEl => {
  navbarEl.innerHTML = NavBarComponent({
    title: "E-Commerce Demo",
    image: "/images/e-commerce-demo.png",
    className: "!bg-gray-50",
    buttons: [
      { 
        label: "Home", 
        className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
        action: () => window.location.href = "/" 
      },
      { 
        label: "Services", 
        className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
        action: () => window.location.href = "/#services" 
      },
      { 
        label: "About", 
        className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
        action: () => window.location.href = "/#about"
      },
    ],
    buttonsAlignment: "right"
  });

  // Attach mobile toggle & button actions
  attachNavBarActions(navbarEl, [
    { 
      label: "Home", 
      action: () => window.location.href = "/" 
    },
    { 
      label: "Services", 
      action: () => window.location.href = "/#services" 
    },
    { 
      label: "About", 
      action: () => window.location.href = "/#about"
    },
  ]);
});

document.querySelectorAll(".logged-navbar").forEach(navbarEl => {
  const productsButtons = [
    { 
      label: "Home", 
      className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
      action: () => window.location.href = "/" 
    },
    { 
      label: "Products", 
      className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
      action: () => window.location.href = "/products" 
    },
    { 
      label: "Cart", 
      className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
      action: () => window.location.href = "/products/cart" 
    },
    { 
      label: "Account", 
      className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
      action: () => window.location.href = "/account" 
    },
    { 
      label: "Log Out", 
      className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
      action: () => {
        // Optional: clear session via PHP endpoint
        fetch("/phps/logout.php").then(() => {
          window.location.href = "/login";
        });
      }
    }
  ];

  navbarEl.innerHTML = NavBarComponent({
    title: "Browse Products",
    className: "!bg-gray-50",
    buttons: productsButtons,
    buttonsAlignment: "right"
  });

  // Attach mobile toggle & button actions (must match buttons)
  attachNavBarActions(navbarEl, productsButtons);
});

// IIFE
(() => {
  
  // Production alert (will uncomment once the project is finally done)
  // alert("NOTE: This is a demo website only with frontend and backend functionality but does not represent a real business.");

  // Attach hero
  const heroes = document.querySelectorAll(".hero");
  heroes.forEach(hero => {
    hero.innerHTML = HeroComponent;
  });

  // Attach about
  const abouts = document.querySelectorAll(".about");
  abouts.forEach(about => {
    about.innerHTML = AboutComponent;
  });

  // Attach about
  const services = document.querySelectorAll(".services");
  services.forEach(service => {
    service.innerHTML = ServicesComponent;
  });

  // Attach footer
  const footers = document.querySelectorAll(".footer");
  footers.forEach(footer => {
    footer.innerHTML = FooterComponent;
  });
  
})();