// Menu Mobile
const btnOpen = document.querySelector('#btnOpen')
const btnClose = document.querySelector('#btnClose')
const media = window.matchMedia('(width < 48em)')
const topNavMenu = document.querySelector('.nav__menu')
const main = document.querySelector('main')

function setupTopNav(e) {
  if (e.matches) {
    // is mobile
    topNavMenu.setAttribute('inert', '')
    topNavMenu.style.transition = 'none'
  }
  else {
    // is tablet/desktop
    topNavMenu.removeAttribute('inert')
  }
}

function openMobileMenu() {
  btnOpen.setAttribute('aria-expanded', 'true')
  topNavMenu.removeAttribute('inert')
  topNavMenu.removeAttribute('style')
  main.setAttribute('inert', '')
  btnClose.focus()
}

function closeMobileMenu() {
  btnOpen.setAttribute('aria-expanded', 'false')
  topNavMenu.setAttribute('inert', '')
  main.removeAttribute('inert')
  btnOpen.focus()

  setTimeout(() => {
    topNavMenu.style.transition = 'none'
  }, 500)
}

setupTopNav(media)

btnOpen.addEventListener('click', openMobileMenu)
btnClose.addEventListener('click', closeMobileMenu)

media.addEventListener('change', function (e) {
  setupTopNav(e)
})
