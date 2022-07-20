gsap.registerPlugin(ScrollTrigger);
let blockPortolio = document.querySelectorAll('.block-portfolio')

blockPortolio.forEach((el,index) => {
    let t1 = gsap.timeline({
        scrollTrigger: {
            trigger: el,
            onEnter: () => {
                el.classList.add('block-portfolio--active')
            },
            
            start: "top top",
            end: "top bottom",
        } 
    });
})

