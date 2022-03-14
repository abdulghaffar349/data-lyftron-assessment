/**
 * Detect if there is scrollbar
 * @returns {boolean}
 */
const hasScrollbar = () => {
    return window.innerWidth > document.documentElement.clientWidth;
}

export {
    hasScrollbar
}
