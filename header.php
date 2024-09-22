<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nathalie Mota</title>

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">

    <!--Police Space Mono-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!--Police Poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
    <!--Iônes Google Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
<header>
    <nav>
        <?php the_custom_logo(); ?>
        <?php wp_nav_menu( array(
            'menu' => 'Header',
            'theme_location' => 'En tête du menu',
            'menu_class' => 'categories'
        ) ); ?>

        <ul class= "burger__menu">
            <li><a href="http://localhost:10028/">ACCEUIL</a></li>
            <li><a href="http://localhost:10028/a-propos/">À PROPOS</a></li>
            <li><a class="contact" href="http://localhost:10028/contact/">CONTACT</a></li>
        </ul>   
    </nav>
</header>

</body>
</html>
