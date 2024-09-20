//MENU

const header = document.getElementById("menu-header");
const burgerMenu = document.querySelector(".burger__menu");

header.addEventListener('click', () => {
    // Condition pour alterner le fade-up et fade-down
if (burgerMenu.classList.contains('burger__menu-open')) {
        burgerMenu.classList.remove('burger__menu-open');
        burgerMenu.classList.add('burger__menu-close');
    } else{
        burgerMenu.style.display = 'flex'; // Rendre visible
        burgerMenu.classList.remove('burger__menu-close');
        burgerMenu.classList.add('burger__menu-open'); 
    }
    // Alterner entre les icônes de burger et de croix
    header.classList.toggle('menu-open');
});
//Une fois l'animation terminée, on cache le menu
burgerMenu.addEventListener('animationend', (event) => {
    if (event.animationName === 'fade-up') {
        burgerMenu.style.display = 'none'; 
    }
});




       
    


