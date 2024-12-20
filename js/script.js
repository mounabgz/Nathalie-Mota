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

//CODE POUR FERMER LA MODALE
document.querySelector('.modale_contact-overlay').addEventListener("click", function() {
    const contactModaleClose = document.querySelector(".modale_contact-overlay");
    if (contactModaleClose.classList.contains('modale_contact-close')){
        contactModaleClose.style.display = 'none';
    }
});
// Pour empêcher la modale de se fermer lorsqu'on clique sur celle-ci
document.querySelector('.modale_contact').addEventListener("click", function(event) {
    event.stopPropagation(); 
});

//MODALE DE CONTACT en desktop

document.querySelector('.menu-item-17').addEventListener("click", function() {
    const contactModale = document.querySelector(".modale_contact-overlay");
    contactModale.classList.toggle('modale_contact-close')
    if (contactModale.classList.contains('modale_contact-close')){
        contactModale.style.display = 'flex';
    }
});

//MODALE DE CONTACT pour la version mobile
document.querySelector('.burger__menu').addEventListener("click", function() {
    const contactModale = document.querySelector(".modale_contact-overlay");
    contactModale.classList.toggle('modale_contact-close')
    if (contactModale.classList.contains('modale_contact-close')){
        contactModale.style.display = 'flex';
        burgerMenu.classList.add('burger__menu-close'); 
    }
});

//SINGLE POST : LE BOUTON DE CONTCACT
document.querySelector('.page_info-bouton').addEventListener("click", function() {
    const contactModale = document.querySelector(".modale_contact-overlay");
    contactModale.classList.toggle('modale_contact-close')
    if (contactModale.classList.contains('modale_contact-close')){
        contactModale.style.display = 'flex';
    }
});

//SINGLE POST : ON RECUPERE LA REFERENCE DE CHAQUE POST QU'ON INJECTE DANS LA MODALE
$(document).ready(function() {
    $('.page_info-bouton').click(function() {  
        let ref = $(this).data('reference');
        $('input[type="text"]').val(ref); 
    });
});

//SINGLE POST : LA NAVIGATION ENTRE LES PHOTOS SUIVANTES

document.querySelector('.arrow-right').addEventListener("mouseover", function() {
    const nextPhoto = document.querySelector(".next_photo");
    const arrowRight = document.querySelector(".arrow-right");
    if (arrowRight.classList.contains('arrow-right')){
        nextPhoto.style.display = 'flex';
    }
    arrowRight.addEventListener('mouseout', () => {
        nextPhoto.style.display = 'none';
    });
});

//SINGLE POST : LA NAVIGATION ENTRE LES PHOTOS PRECEDENTES

document.querySelector('.arrow-left').addEventListener("mouseover", function() {
    const prevPhoto = document.querySelector(".previous_photo");
    const arrowLeft = document.querySelector(".arrow-left");
    if (arrowLeft.classList.contains('arrow-left')){
        prevPhoto.style.display = 'flex';
    }
    arrowLeft.addEventListener('mouseout', () => {
        prevPhoto.style.display = 'none';
    });

});