<?php
/**
 * Header Template
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="site-header">
    <div class="container">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
            <?php bloginfo('name'); ?>
        </a>
        <nav id="main-nav">
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav>
    </div>
</header>
<!-- ...continúa el contenido... -->
