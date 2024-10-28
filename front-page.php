<?php get_header(); ?>

<?php get_template_part('template_part/hero-header/hero-header' );?>

<!-- SECTION POUR LA LISTE DES PHOTOS DE LA PAGE D'ACCUEIL-->
<section>
        <?php
            $args = [
                'post_type' => 'photo',
                'posts_per_page' => 8,
                'orderby' => 'date',
            ];

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
        ?>
        
    <div class="button-container">
        <button data-action="load-more-photos" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>" class="photo_list-button">Charger plus</button>
    </div>

    <div class="load-more-photos">
        <!-- div pour les photos suivantes -->
    </div>
    </section>

<?php get_footer(); ?>