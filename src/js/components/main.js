// jQuery(document).ready(function ($) {
    window.onload = function() {
        if (document.querySelector('.loader')) {
            let loader = document.querySelector('.loader');
            loader.style.display = "none"
        }
        
    }
    gsap.registerPlugin(ScrollTrigger);
    let starAnim = document.querySelectorAll('.start-anim')
    starAnim.forEach((el,index) => {
        let t1 = gsap.timeline({
            scrollTrigger: {
                trigger: el,
                onEnter: () => {
                    el.classList.add('active')
                },
                
                start: "top bottom",
                end: "top bottom",
            } 
        });
    })
    
    
// })