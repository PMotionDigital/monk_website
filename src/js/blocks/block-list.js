gsap.registerPlugin(ScrollTrigger);
let blockLists = document.querySelectorAll('.block-list')

blockLists.forEach((el, index) => {
    let t1 = gsap.timeline({
        scrollTrigger: {
            trigger: el,
            onEnter: () => {
                setTimeout(()=> {
                    el.classList.add('block-list--active')
                }, (index + 1) * 200)
                
            },
            
            start: "-=50% bottom",
            end: "bottom bottom",
        } 
    });
})
