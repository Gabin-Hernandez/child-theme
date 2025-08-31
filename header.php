<?php
/**
 * Header Clean - ITOOLS Child Theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<!-- Header Limpio ITOOLS -->
<header class="clean-header">
    <div class="container">
        <div class="header-content">
            <!-- Logo a la izquierda -->
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <span class="logo-text">ITOOLS MX</span>
                </a>
            </div>

            <!-- Buscador centrado -->
            <div class="search-area">
                <form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input 
                        type="search" 
                        name="s" 
                        class="search-input"
                        placeholder="¿Qué herramienta necesitas?" 
                        value="<?php echo esc_attr( get_search_query() ); ?>"
                    >
                    <input type="hidden" name="post_type" value="product">
                    <button type="submit" class="search-btn">Buscar</button>
                </form>
            </div>

            <!-- Acciones a la derecha -->
            <div class="header-actions">
                <a href="<?php echo esc_url( home_url( '/mi-cuenta' ) ); ?>" class="action-link">Mi Cuenta</a>
                <a href="<?php 
                    $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/carrito' );
                    echo esc_url( $cart_url ); 
                ?>" class="action-link">Carrito 
                    <?php 
                    $cart_count = function_exists( 'WC' ) && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
                    if ( $cart_count > 0 ) : ?>
                        (<?php echo esc_html( $cart_count ); ?>)
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</header>
