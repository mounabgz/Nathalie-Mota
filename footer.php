<?php get_template_part('template_part/Modale_contact/modale-contact'); ?>
<footer>
	<?php wp_nav_menu( array(
	'menu' => 'Footer',
	'theme_location' => 'Pied De Page',
	) ); ?>

</footer>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/ajax.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lightbox.js"></script>

</body>
</html>