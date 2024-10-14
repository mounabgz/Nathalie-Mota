<section class="hero_header">
    <div>
        <?php
            // IDs des images à exclure
            $exclude_ids = array(95, 96, 99, 94, 105);

            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 1,
                'orderby' => 'rand',
                'post__not_in' => $exclude_ids,
            );

            $loop = new WP_Query($args);

            while ($loop->have_posts()) : $loop->the_post();
                the_post_thumbnail();
            endwhile;
            wp_reset_postdata();
        ?>
        <h1 class="hero_header-title">PHOTOGRAPHE EVENT</h1>
    </div>
</section>
