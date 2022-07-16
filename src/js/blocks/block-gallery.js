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
