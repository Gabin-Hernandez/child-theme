<?php
// Header básico y seguro
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<header style="background: white; padding: 15px 0; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
        <a href="<?php echo home_url('/'); ?>" style="font-size: 1.5rem; font-weight: bold; text-decoration: none; color: #333;">
            <?php bloginfo('name'); ?>
        </a>
        <nav>
            <a href="<?php echo home_url('/'); ?>" style="margin: 0 15px; text-decoration: none; color: #333;">Inicio</a>
            <a href="<?php echo home_url('/tienda'); ?>" style="margin: 0 15px; text-decoration: none; color: #333;">Tienda</a>
            <a href="<?php echo home_url('/contacto'); ?>" style="margin: 0 15px; text-decoration: none; color: #333;">Contacto</a>
        </nav>
    </div>
</header>
