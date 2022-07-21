gsap.registerPlugin(ScrollTrigger);
let blockWhiteLayouts = document.querySelectorAll('.block-white-layout')

blockWhiteLayouts.forEach((el,index) => {
    let t1 = gsap.timeline({
        scrollTrigger: {
            trigger: el,
            onEnter: () => {
                if (!el.classList.contains('block-white-layout--active')) {
                    el.classList.add('block-white-layout--active')
                    animateValue(".block-white-layout", 0, 255, 500);
                }
                
            },
            
            start: "-=500",
            end: "bottom bottom",
        } 
    });
})


function animateValue(classEl, start, end, duration) {
    if (start === end) return;
    var range = end - start;
    var current = start;
    var increment = end > start? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = document.querySelector(classEl);
    var timer = setInterval(function() {
        current += increment;
        obj.style.background = `rgb(${current}, ${current}, ${current})`;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
    
}

