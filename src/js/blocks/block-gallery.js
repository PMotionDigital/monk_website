if (innerWidth < 1200) {
    if (document.querySelector('.grid')) {
        let elem = document.querySelector('.grid');
        let msnry = new Masonry( elem, {
        // options
        itemSelector: '.grid-item',
        percentPosition: true,
        gutter: 10,
    });
    }
    
}

gsap.registerPlugin(ScrollTrigger);
let blockGalleryItems = document.querySelectorAll('.block-gallery_list-item')

blockGalleryItems.forEach((el,index) => {
    let t1 = gsap.timeline({
        scrollTrigger: {
            trigger: el,
            onEnter: () => {
                
                setTimeout(()=> {
                    el.classList.add('block-gallery_list-item--active')
                    console.log(index)
                }, (index + 1) * 200)
                
            },
            
            start: "bottom bottom",
            end: "top bottom",
        } 
    });
})

