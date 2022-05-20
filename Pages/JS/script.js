/* NavBar/Header */
const $header = document.querySelector('header');
window.addEventListener('scroll', toggleHeader, false);
const $logo = document.querySelectorAll('.logo')[0];
const $navBar = document.querySelectorAll('.nav-bar')[0];

function toggleHeader() {
  if (window.scrollY > 60 && $header.classList.contains('max-header')) {
    $header.classList.remove('.max-header')
    $header.classList.add('min-header');
    $logo.firstElementChild.setAttribute('src', '../../Assets/Logo/telecall-logo.png');
    $logo.classList.remove('max-logo');
    $logo.classList.add('min-logo');
    $navBar.classList.remove('max-nav-links');
    $navBar.classList.add('min-nav-links');
    $navBar.firstElementChild.classList.add('min-nav-bar')
    $navBar.firstElementChild.classList.remove('max-nav-bar')
    
  } else if (window.scrollY <= 80 && $header.classList.contains('min-header')){
    $header.classList.remove('min-header')
    $header.classList.add('max-header')
    $logo.firstElementChild.setAttribute('src', '../../Assets/Logo/telecall-logo-branco.png');
    $logo.classList.remove('min-logo')
    $logo.classList.add('max-logo')
    $navBar.firstElementChild.classList.add('max-nav-bar')
    $navBar.firstElementChild.classList.remove('min-nav-bar')
  }
}

const $menu = document.querySelectorAll('.menu')[0];
$menu.addEventListener('click', toggleMenu, false);
var isOpen = false;

function toggleMenu() {
  if (!isOpen) {
    $menu.firstElementChild.classList.add('close-btn');
    $navBar.classList.add('menu-opened');
    isOpen = true;
  } else {
    $menu.firstElementChild.classList.remove('close-btn');
    $navBar.classList.remove('menu-opened');
    isOpen = false;
  }
}

$navBar.addEventListener('click', navClick, false);
function navClick(evt) {
  console.log(evt.target.tagName);
  if (evt.target.tagName == 'A') {
    toggleMenu();
  }
}