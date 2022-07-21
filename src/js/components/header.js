gsap.registerPlugin(ScrollTrigger);
let logo = document.querySelector('.main-header_logo')

window.onload = function() {
let t1 = gsap.timeline({
    scrollTrigger: {
        trigger: logo,
        onEnter: () => {
            logo.classList.add('main-header_logo--active')
        },
        
        start: "-=200",
        end: "top top",
    } 
});
}
