gsap.registerPlugin(ScrollTrigger);
let blockLists = document.querySelectorAll('.block-list')

blockLists.forEach((el) => {
    let t1 = gsap.timeline({
        scrollTrigger: {
            trigger: el,
            onEnter: () => {
                let trigerElems = el.querySelectorAll('.block-list_grid-item');
                trigerElems.forEach((elem, index) => {
                    setTimeout(()=> {
                        elem.classList.add('block-list_grid-item--active')
                    }, (index + 1) * 200)
                })
                
            },
            
            start: "bottom bottom",
            end: "top bottom",
        } 
    });
})
