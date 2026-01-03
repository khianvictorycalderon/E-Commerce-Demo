// This is the main initiator and entry script of the homepage

// Navbar Usage
document.body.prepend(
  NavBarComponent({
    title: "E-Shop",
    image: "assets/logo.png",
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
        action: () => window.location.href = "/about" 
      },
    ],
    buttonsAlignment: "right"
  })
);