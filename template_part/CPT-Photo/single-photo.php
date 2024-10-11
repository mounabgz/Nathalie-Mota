<?php get_header();?>

<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();
// On récupère les champs ACF nécessaires
$reference=get_field('reference');
$categorie=strip_tags(get_the_term_list($post->ID, 'categorie')); 
$type=get_field('type');
$format=strip_tags(get_the_term_list($post->ID, 'formats'));
$photo=get_field('Photo');
$annee= get_the_date('Y');
?>

<section>
<div class="page_info">

    <div class="page_info-détails">
        <h2><?php the_title(); ?></h2>
        <p>RÉFÉRENCE : <?php echo $reference; ?> </p>
        <p>CATÉGORIE : <?php echo $categorie; ?></p>
        <p>FORMAT : <?php echo $format; ?></p>
        <p>TYPE : <?php echo $type; ?></p>
        <p>ANNÉE : <?php  echo $annee; ?></p>
    </div>

        <img class="page_info-image" src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>">

</div>

<hr class= "little-horizontale-line">

<div class="page_info-contact">
    <p>Cette photo vous intéresse ?</p>
    <button class="page_info-bouton" data-reference="<?php echo get_field('reference');?>">Contact</button>

    <div class="photo-container">
    <?php // la navigation entre les photos suivantes
    $next_post = get_next_post();
    if ( is_a( $next_post, 'WP_Post' ) ) : ?>
        <a href="<?php echo get_permalink( $next_post->ID ); ?>">
            <img class="next_photo"src="<?php echo esc_url( get_the_post_thumbnail_url( $next_post->ID ) ); ?>" alt="<?php echo esc_attr( get_the_title( $next_post->ID ) ); ?>">
        </a>
        <a href="<?php echo get_permalink( $next_post->ID ); ?>">
            <svg class="arrow-right"xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="m560-240-56-58 142-142H160v-80h486L504-662l56-58 240 240-240 240Z"/></svg>
        </a>
        <?php endif; ?>

        <?php
            // la navigation entre les photos précédentes 
        $prev_post = get_previous_post();
        if ( ! empty( $prev_post ) ): ?>
        <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
            <img class="previous_photo"src="<?php echo esc_url( get_the_post_thumbnail_url( $prev_post->ID ) ); ?>" alt="<?php echo esc_attr( get_the_title( $prev_post->ID ) ); ?>">
        </a>
	    <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
            <svg class="arrow-left" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"/></svg>
	    </a>
        <?php endif; ?>
    </div>
</div>

<hr class= "longue-horizontale-line">

</section>

<section>
    <?php
        // template part conecernant la section des photos apparentés
        get_template_part('template_part/Photo_block/photo_block');
    ?>
</section>

<?php
endwhile; endif;
?>

<?php get_footer();?>