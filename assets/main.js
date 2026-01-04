import { AboutComponent } from "./components/about.js";
import { HeroComponent } from "./components/hero.js";
import { NavBarComponent } from "./components/navbar.js";
import { ServicesComponent } from "./components/services.js";

// Navbar Usage
document.body.prepend(
  NavBarComponent({
    title: "E-Commerce Demo",
    image: "images/e-commerce-demo.png",
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
  
})();