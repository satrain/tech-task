function changeHamburgerMenu(x) {
    x.classList.toggle("change");
}

let hamburger = document.querySelector('.hamburger')
let mobileOverlay = document.querySelector('.mobile-menu-overlay')

hamburger.addEventListener('click', () => {
    mobileOverlay.classList.toggle('visible')
})