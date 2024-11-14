// Tableau pour stocker les URLs des images
let images = [];
let currentPhoto = 0;

// Au clique sur l'icône d'agrandissement :
$(document).on('click', '.fa-expand', function(e) {
e.preventDefault()
    // Récupère l'URL de l'image depuis l'attribut data-url
    var imageUrl = $(this).data('url');
    // Récupère les champs acf de l'image depuis l'attribut data-categorie et date-refrence
    var categorie = $(this).data('categorie');
    var reference = $(this).data('reference');

        // Crée une liste de toutes les images dans la galerie
        images = $('.fa-expand').map(function() {
          return $(this).data('url');
      }).get();
  
      // Détermine l'index de l'image actuelle
      currentPhoto = images.indexOf(imageUrl);

    // code HTML de la lightbox
    var lightboxCode = `
        <div class="light_box">
            <button class="light_box-close"></button>
            <button class="light_box-prev"></button>
            <button class="light_box-next"></button>
            <div class="light_box-container">
                <img class="lightbox-image" src="${imageUrl}" alt="Image agrandie" class="lightbox-image"/>
                <p class="light_box-categorie">${categorie}</p>
                <p class="light_box-text">${reference}</p>
            </div>
        </div>`;

    // Insère la lightbox dans le DOM
    $('body').append(lightboxCode);
});

// Gère l'ouverture de la lightbox au clic sur l'icône d'agrandissement
$(document).on('click', '.fa-expand', function() {
    $('.light_box').css('display', 'flex'); 
});

// Gère la fermeture de la lightbox au clic sur la croix
$(document).on('click', '.light_box-close', function() {
    console.log('La croix est cliquée');
    $('.light_box').remove();
});

// la navigation au clique vers les photos suivantes 
$(document).on('click', '.light_box-next', function() {
    currentPhoto = (currentPhoto + 1) % images.length; // Passe à l'image suivante, revient au début si dernière image
  $('.lightbox-image').attr('src', images[currentPhoto]); // Met à jour l'image dans la lightbox
});

// la navigation au clique vers les photos precedentes
$(document).on('click', '.light_box-prev', function() {
    currentPhoto = (currentPhoto - 1 + images.length) % images.length; // Passe à l'image précédente, revient à la fin si première image
  $('.lightbox-image').attr('src', images[currentPhoto]); // Met à jour l'image dans la lightbox
});
