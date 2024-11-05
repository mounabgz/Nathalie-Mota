//CODE POUR LA PAGINATION INFINI EN AJAX
let currentPage = 1; // variable pour suivre la pagination

document.querySelector('.photo_list-button').addEventListener('click', function() {
    console.log('Le bouton est cliqué');

    const ajaxurl = $(this).data('ajaxurl'); // L'URL qui réceptionne les requêtes Ajax dans l'attribut "data-ajaxurl" du "button"
    const postid = $(this).data('postid');
    const button = $(this); // On enregistre le contexte du bouton

    currentPage++; // Incrémentation de la page

    // Les données du bouton
    const data = {
        action: 'load_photos', // Ajoute l'action ici
        postid: postid,
        page: currentPage // Ajouter la page aux données
    };

    // Requête Ajax en JS natif via Fetch
    fetch(ajaxurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Cache-Control': 'no-cache',
        },
        body: new URLSearchParams(data),
    })
    .then(response => response.json())
    .then(body => {
        console.log(body);

        // En cas d'erreur
        if (!body.success) {
            alert(body.data);
            return;
        }

        // En cas de réussite
        button.hide(); // Cacher le bouton 
        $('.load-more-photos').html(body.data); // Ajout des nouvelles photos sans remplacer les anciennes
    })
});
(jQuery);

//CODE POUR LES FILTRES/SELECTS
$(function(){
    $(".selects_filters-input").select2()
    jQuery(document).ready(function() {
        jQuery(".selects_filters-input").change(function(){
            const filter =jQuery("#filters");
    
            jQuery.ajax({
                url: filter.attr("action"),
                data :filter.serialize(),
                type:filter.attr("method"),
                success: function(data){
                    jQuery(".photo_list").html(data);
                }
            });
        })
    })
})

