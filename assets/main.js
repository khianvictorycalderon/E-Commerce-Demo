import { HeroComponent } from "./components/hero.js";
import { NavBarComponent } from "./components/navbar.js";

// Navbar Usage
document.body.prepend(
  NavBarComponent({
    title: "E-Commerce Demo",
    image: "icons/e-commerce-demo.png",
    className: "!bg-gray-50", // fits e-commerce theme
    buttons: [
      { 
        label: "Home", 
        className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
        action: () => window.location.href = "/" 
      },
      { 
        label: "Shop", 
        className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
        action: () => window.location.href = "/shop" 
      },
      { 
        label: "About", 
        className: "text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200",
        action: () => window.location.href = "/#about"
      },
    ],
    buttonsAlignment: "right"
  })
);

// IIFE
(() => {
  
  // Attach hero
  const heroes = document.querySelectorAll(".hero");
  heroes.forEach(hero => {
    hero.innerHTML = HeroComponent;
  });
  
})();