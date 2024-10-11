<div class= "photos_apparentes">
    <p> VOUS AIMEREZ AUSSI </p>
    <div class= "photos_apparentes-flex"> 
    <?php 
$categorie = get_the_terms( get_the_ID(), 'categorie' ); // Récupère les termes associés à la taxonomie 'categorie'
if ( !empty( $categorie ) && !is_wp_error( $categorie ) ) {
    $category_ids = wp_list_pluck($categorie, 'term_id' ); // Récupère l'ID de la première catégorie
}

    // Paramètres pour récupérer les articles de cette catégorie
    $current_post_id = get_the_ID();
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 2,
        'post__not_in' => array($current_post_id),
        'orderby' => 'date',
        'tax_query' => [
        [
        'taxonomy' => 'categorie',
        'field' => 'term_id',
        'terms' => $category_ids,
        ],
    ],
];

// On exécute la WP Query
$my_query = new WP_Query( $args );
$categorie=strip_tags(get_the_term_list($post->ID, 'categorie'));

// On lance la boucle
if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
$post_id = get_permalink();
    echo"<div class='photos_apparentes-images'>";
        echo "<a href='" . esc_url($post_id) . "'>";
            the_post_thumbnail('custom-thumbnail');
            echo "</a>";
                echo "<div><i class='fa-regular fa-eye'></i>
                    <i class='fa-solid fa-expand'></i>
                    <p class='photos_apparentes-text'>REFERENCE DE LA PHOTO</p>
                    <p class='photos_apparentes-categorie'>" . $categorie . "</p>
                </div>";
    echo"</div>";
endwhile;
else :
    echo 'Aucun autre article trouvé pour cette catégorie';
endif;

// On réinitialise à la requête principale
wp_reset_postdata();?>
    </div>
</div>