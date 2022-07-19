if (innerWidth > 1200) {

class FollowingLine {
                
    /**
     * Main element of line (parent selector)
     * @type {DOMElement}
     */
    element;

    /**
     * Element which follows mouse
     * @type {DOMElement}
     */
    followingElement;

    /**
     * Bounding rect of main element (to calculate)
     * @type {DOMRect}
     */
    elementRect;

    /**
     * Check if element is hovered
     * @type {Boolean}
     */
    hovered = false;

    /**
     * Raw mouse position
     * @type {Object}
     */
    mouse = {
        x: 0,
        y: 0,
    };

    /**
     * Calculated mouse position based on raw mouse & element's rect
     * @type {Object}
     */
    newMouse = {
        x: 0,
        y: 0,
    };

    /**
     * Mouse with little transition (for smooth transforming)
     * @type {Object}
     */
    transitionMouse = {
        x: 0,
        y: 0,
    };

    /**
     * Setup lline with following element
     * @param {DOMElement} element - Main element (row)
     * @param {String} followingElementSelector - Selector of inner following element
     */
    constructor(element, followingElementSelector) {

        // if no element -> return
        if (!element) {
            return;
        }
        this.element = element;
        this.followingElement = element.querySelector(followingElementSelector);

        // if no following element -> return
        if (!this.followingElement) {
            return;
        }

        // init all functions
        this._init();
    }

    /**
     * Add listeners and run the loop
     */
    _init() {
        this.element.addEventListener('mousemove', (e) => {
            this.hovered = true;
            this.mouse = {
                x: e.clientX,
                y: e.clientY,
            };

            this.followingElement.classList.add('follow-cursor_active');

        });

        this.element.addEventListener('mouseleave', (e) => {
            this.hovered = false;
            this.followingElement.classList.remove('follow-cursor_active');
        });

        this._loop();
    }

    /**
     * Calculate mouse position based on element's rect and calculate transition mouse
     */
    _calcMouse() {
        this.newMouse = {
            y: this.mouse.y - this.elementRect?.top,
            x: this.mouse.x - this.elementRect?.left,
        };

        this.transitionMouse.x += ( this.newMouse.x - this.transitionMouse.x ) * 0.9;
        this.transitionMouse.y += ( this.newMouse.y - this.transitionMouse.y ) * 0.9;
    }

    /**
     * Save element's bounding rect
     */
    _setupRect() {
        if (!this.hovered && this.elementRect) {
            return;
        }
        this.elementRect = this.element.getBoundingClientRect();
    }

    /**
     * Apply mouse transition to element
     */
    _moveElement() {
        
        if (!this.hovered) {
            return;
        }
        
        this.followingElement.style.transform = `translate3d(${this.transitionMouse.x}px, ${this.transitionMouse.y}px, 0)`;
    }

    /**
     * Main loop with request animation frame
     */
    _loop() {
        this._setupRect();
        this._calcMouse();
        this._moveElement();
        
        requestAnimationFrame(this._loop.bind(this)); // bind this ЧТОБЫ НЕ ПРОЕБАТЬ КОНТЕКСТ ВЫПОЛНЕНИЯ 
    }
};


Array.from(document.querySelectorAll('.block-news_list-item')).forEach(l => {
    const fd = new FollowingLine(l, '.follow-cursor');
    console.log(fd);
});
}