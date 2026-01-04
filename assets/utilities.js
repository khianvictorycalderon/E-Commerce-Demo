// This file contains utility functions across all pages in the website

export const slideTo = (id, offset = 0) => {
  const element = document.getElementById(id);
  if (element) {
    const elementTop = element.getBoundingClientRect().top + window.scrollY;
    window.scrollTo({
      top: elementTop + offset,
      behavior: 'smooth',
    });
  } else {
    console.warn(`Element with id "${id}" not found.`);
  }
};
