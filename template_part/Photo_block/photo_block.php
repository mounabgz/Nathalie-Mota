<!-- PHOTOS APPARENTÉS  -->
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

// On lance la boucle
if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
$categorie=strip_tags(get_the_term_list($post->ID, 'categorie')); // Récupère la catégorie
$reference = get_field('reference', $post->ID); // Récupère la référence
$post_id = get_permalink();
$thumbnail_url= get_the_post_thumbnail_url();//variable qui recupère l'url de l'image pour ensuite être affiché dans la lightbox
    echo"<div class='photos_apparentes-images'>";
        echo "<a href='" . esc_url($post_id) . "'>";
            the_post_thumbnail('custom-thumbnail');
            echo "<i class='fa-regular fa-eye'></i>";
            echo "</a>";
                echo "<div>
                <i class='fa-solid fa-expand' data-url='{$thumbnail_url}' data-reference='{$reference}' data-categorie='{$categorie}'></i>
                    <p class='photos_apparentes-text'>". $reference . "</p>
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