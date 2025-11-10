<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
    <?php wp_body_open(); ?>
<header id="site-header" role="banner">
    <div class="container">
        <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
            the_custom_logo();
        } else { ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php } ?>
        <nav class="main-navigation" role="navigation">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'walker'         => class_exists('Ferrocarril_Nav_Walker') ? new Ferrocarril_Nav_Walker() : null,
                ) );
            ?>
        </nav>
    </div>
</header>
<main id="main" class="site-main">
    <div class="container">