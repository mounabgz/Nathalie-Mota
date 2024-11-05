<?php
//ENQUEUE LES STYLES ET SCRIPTS
function nathalieMota_enqueue_styles() {
    wp_enqueue_style( 'nathalieMota-style', get_template_directory_uri() . '/style.css' ); 
    wp_enqueue_script( 'nathalieMota-scripts', get_template_directory_uri() . '/js/script.js', array(), null, true );
    wp_enqueue_script( 'nathalieMota-scripts', get_template_directory_uri() . '/js//ajax.js', array(), null, true );
    wp_enqueue_script('jquery');
    wp_enqueue_script('select2');
}
add_action( 'wp_enqueue_scripts', 'nathalieMota_enqueue_styles');


function nathalieMota_support(){
    add_theme_support ('menus'); //Créer l'onget menu dans le back-office 
    add_theme_support ('custom-logo'); //Créer une zone pour ajouter le logo dans le customizer
    add_theme_support('post-thumbnails'); //Ajoute les sections "images mises en avant" dans les posts
    add_image_size( 'custom-thumbnail', 500, 500, true ); // Dimensions des vignettes
}
add_action ('after_setup_theme', 'nathalieMota_support', 'post-thumbnails', array('photo'), 'custom-thumbnail');

// MENU

function nathalieMota_menus() {
    register_nav_menus( array(
        'Header' => 'En tête du menu',
        'Footer' => 'Pied De Page',
    ) );
}
add_action('after_setup_theme','nathalieMota_menus');


//AJOUT DE L'ACTION AJAX POUR CHARGER LES PHOTOS

function load_photos() {

    // Récupérer la page de pagination
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'paged' => $paged // pagination AJAX
    ];

    $loop = new WP_Query($args);

    // HTML des photos à renvoyer
    $html = "<div class='photo_list'>";

    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            $categorie = strip_tags(get_the_term_list(get_the_ID(), 'categorie')); // Récupérer la catégorie
            $reference = get_field('reference', $post->ID); // Récupère la référence
            $post_url = get_permalink(); // Récupérer le lien du post

            // Construire le HTML pour chaque photo
            $html .= "<div class='photo_list-image'>";
                $html .= "<a href='" . esc_url($post_url) . "'>";
                    $html .= get_the_post_thumbnail(); // Affiche la vignette
                $html .= "<div><i class='fa-regular fa-eye'></i>
                      <i class='fa-solid fa-expand'></i>
                      <p class='photo_list-text'>". $reference . "</p>
                      <p class='photo_list-categorie'>" . $categorie . "</p>
                      </div>";
                $html .= "</a>";
                $html .= "</div>"; 
                                
            $html .= "<div class='load-more-photos'></div>"; 
        endwhile;
    } else {
        $html .= "<p>Aucune photo trouvée.</p>";
    }

    $html .= "</div>";

    $html .= "<div class='button-container'>";
        $html .= "<button class='photo_list-button'>Charger plus</button>";
    $html .= "</div>";

    wp_reset_postdata();

    wp_send_json_success($html); // Envoie du HTML vers le front avec wp_send_json_success
    exit; // après avoir renvoyé la réponse, arrêt de l'exécution du script 
}

add_action('wp_ajax_load_photos', 'load_photos');
add_action('wp_ajax_nopriv_load_photos', 'load_photos'); // Pour les utilisateurs non connectés

//CODE POUR FILTRES/SELECTS

function filter_posts(){

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
    );

    $tax_query = array();

        // Filtre par catégorie
        if (!empty($_POST['categorie'])) {
            $tax_query[] = array(
                'taxonomy' => 'categorie',
                'field' => 'term_id',
                'terms' => $_POST['categorie']
            );
        }
    
        // Filtre par format
        if (!empty($_POST['formats'])) {
            $tax_query[] = array(
                'taxonomy' => 'formats',
                'field' => 'term_id',
                'terms' => $_POST['formats']
            );
        }

        // Filtre par ordre d'ancienneté
        if (!empty($_POST['date']) && is_numeric($_POST['date'])) {
            $annee = intval($_POST['date']);
            $args['date_query'] = array(
                array(
                    'year' => $annee,
                ),
            );
        } else {
            // Tri basé sur le choix de l’utilisateur
            $args['order'] = isset($_POST['date']) && in_array($_POST['date'], ['ASC', 'DESC']) ? $_POST['date'] : 'DESC';
        }

        // Ajout des taxonomies à la wp_query
        if (!empty($tax_query)) {
            $args['tax_query'] = $tax_query;
        }

            $loop = new WP_Query($args);
            echo "<div class='photo_list'>";
                while ($loop->have_posts()) : $loop->the_post();
                $categorie=strip_tags(get_the_term_list($post->ID, 'categorie')); // Récupère la catégorie
                $reference = get_field('reference', $post->ID); // Récupère la référence

                $post_id = get_permalink(); // Récupère le lien de l'article
                    echo"<div class='photo_list-image'>";
                        echo "<a href='" . esc_url($post_id) . "'>";
                            the_post_thumbnail(); // Affiche les vignettes

                            echo "<div><i class='fa-regular fa-eye'></i>
                            <i class='fa-solid fa-expand'></i>
                            <p class='photo_list-text'>". $reference . "</p>
                            <p class='photo_list-categorie'>" . $categorie . "</p>
                        </div>";
                    echo "</a>";
                echo "</div>";
            endwhile;
            echo "</div>";

        wp_reset_postdata();
        wp_die();
        
}     
add_action('wp_ajax_myfilter', 'filter_posts');
add_action('wp_ajax_nopriv_myfilter', 'filter_posts');