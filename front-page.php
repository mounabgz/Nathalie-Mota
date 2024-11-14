<?php get_header(); ?>

<?php get_template_part('template_part/hero-header/hero-header' );?>

<!-- SECTION POUR LES SELECTS-->
<section class="selects_filters">
    <form action="<?php echo site_url()?>/wp-admin/admin-ajax.php" method="POST" id="filters">
    <input type="hidden" name="action" value="myfilter">
    <div class="selects_filters-flex">
        <!-- Filtres catégories -->
        <div class="selects_filters-category">
        <select name="categorie" class="selects_filters-input">
        <option value="">CATÉGORIE</option>
            <?php
                $categories = get_terms('categorie');
                if (!is_wp_error($categories)) {
                    foreach ($categories as $categorie) {
                        echo '<option class="selects_filters-input" value="' . $categorie->term_id . '">' . $categorie->name . '</option>';
                    }
                }
            ?>
        </select>
        <!-- Filtre formats -->
        <select name="formats" class="selects_filters-input selects_filters-format">
        <option value="">FORMAT</option>
            <?php
                $formats = get_terms('formats');
                if (!is_wp_error($formats)) {
                    foreach ($formats as $format) {
                        echo '<option class="selects_filters-input" value="' . $format->term_id . '">' . $format->name . '</option>';
                    }
                }
            ?>
        </select>
        </div>
        <!-- Filtres par ancienneté -->
        <div class="selects_filters-date">
            <select name="date" class="selects_filters-input">
                <option value="">TRIER PAR</option>
                <option value="DESC">A partir des plus récentes</option>
                <option value="ASC">A partir des plus anciennes</option>
                <?php
                    // Récupérer les années des publications
                    $args = array(
                        'post_type' => 'photo',
                        'posts_per_page' => -1,
                    );
                    $query = new WP_Query($args);
                    $annees = array();

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $annee = get_the_date('Y');
                            if (!in_array($annee, $annees)) {
                                $annees[] = $annee;
                            }
                        }
                        wp_reset_postdata();
                    }
                ?> 
            </select>
        </div>

    </div>
    </form>
</section>

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
                $thumbnail_url= get_the_post_thumbnail_url();//variable qui recupère l'url de l'image pour ensuite être affiché dans la lightbox

                $post_id = get_permalink(); // Récupère le lien de l'article
                    echo"<div class='photo_list-image'>";
                        echo "<a href='" . esc_url($post_id) . "'>";
                            the_post_thumbnail(); // Affiche les vignettes
                    echo "</a>";

                    echo "<div><i class='fa-regular fa-eye'></i>
                    <i class='fa-solid fa-expand' data-url='{$thumbnail_url}' data-reference='{$reference}' data-categorie='{$categorie}'></i>
                    <p class='photo_list-text'>". $reference . "</p>
                    <p class='photo_list-categorie'>" . $categorie . "</p>
                </div>";
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

    <hr class= "horizontale-line">

<?php get_footer(); ?>