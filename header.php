<?php
/**
 * Header Simple - ITOOLS Child Theme v4.0
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

<!-- Header Simple ITOOLS -->
<header class="simple-header">
    <div class="container">
        <div class="header-row">
            <!-- Logo -->
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <span class="logo-text">ITOOLS MX</span>
                </a>
            </div>

            <!-- Buscador con Filtro -->
            <div class="search-box">
                <form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <select name="product_cat" class="category-filter">
                        <option value="">Todas las categorías</option>
                        <?php
                        if ( function_exists( 'get_terms' ) && taxonomy_exists( 'product_cat' ) ) {
                            $categories = get_terms( array(
                                'taxonomy'   => 'product_cat',
                                'hide_empty' => false,
                                'parent'     => 0,
                            ));
                            
                            if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
                                foreach ( $categories as $category ) {
                                    printf(
                                        '<option value="%s">%s</option>',
                                        esc_attr( $category->slug ),
                                        esc_html( $category->name )
                                    );
                                }
                            } else {
                                echo '<option value="herramientas">Herramientas</option>';
                                echo '<option value="maquinaria">Maquinaria</option>';
                                echo '<option value="accesorios">Accesorios</option>';
                            }
                        }
                        ?>
                    </select>
                    <input 
                        type="search" 
                        name="s" 
                        class="search-input"
                        placeholder="Buscar productos..." 
                        value="<?php echo esc_attr( get_search_query() ); ?>"
                    >
                    <input type="hidden" name="post_type" value="product">
                    <button type="submit" class="search-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                            <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Carrito -->
            <div class="cart">
                <?php 
                $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/carrito' );
                $cart_count = function_exists( 'WC' ) && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
                ?>
                <a href="<?php echo esc_url( $cart_url ); ?>" class="cart-link">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <?php if ( $cart_count > 0 ) : ?>
                        <span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</header>
