
// 100vh fix for mobile browsers
// https://css-tricks.com/the-trick-to-viewport-units-on-mobile/
let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);
// css: 
// height: 100vh; /* Fallback for below */
// height: calc(var(--vh, 1vh) * 100);