<?php
/**
 * Header moderno simplificado para ITOOLS Child Theme - Versión 3.0
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

<!-- ITOOLS Modern Header v3.0 -->
<div class="itools-header-wrapper">
    <!-- Top Bar Minimal -->
    <div class="top-info-bar">
        <div class="container">
            <div class="top-content">
                <div class="contact-info">
                    <span>📞 +52 (55) 1234-5678</span>
                    <span>✉️ info@itoolsmx.com</span>
                </div>
                <div class="top-links">
                    <a href="<?php echo esc_url( home_url( '/mi-cuenta' ) ); ?>">Mi Cuenta</a>
                    <a href="<?php echo esc_url( home_url( '/ayuda' ) ); ?>">Ayuda</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header Sticky -->
    <header class="main-header-clean" id="main-header">
        <div class="container">
            <div class="header-flex">
                <!-- Logo -->
                <div class="logo-section">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
                        <div class="logo-icon">🔧</div>
                        <div class="logo-text">
                            <span class="brand-name">ITOOLS MX</span>
                            <span class="brand-sub">Herramientas</span>
                        </div>
                    </a>
                </div>

                <!-- Categories Dropdown -->
                <div class="categories-dropdown">
                    <button class="categories-btn" id="categories-trigger">
                        <span class="categories-icon">☰</span>
                        <span class="categories-text">Categorías</span>
                        <span class="dropdown-arrow">▼</span>
                    </button>
                    
                    <div class="dropdown-menu" id="categories-menu">
                        <div class="dropdown-content">
                            <?php
                            // Obtener categorías de WooCommerce
                            if ( function_exists( 'get_terms' ) && taxonomy_exists( 'product_cat' ) ) {
                                $categories = get_terms( array(
                                    'taxonomy'   => 'product_cat',
                                    'hide_empty' => false,
                                    'parent'     => 0,
                                    'number'     => 8,
                                ));
                                
                                if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
                                    echo '<div class="categories-grid">';
                                    foreach ( $categories as $category ) {
                                        $category_link = get_term_link( $category );
                                        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                                        $image_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : '';
                                        
                                        if ( ! is_wp_error( $category_link ) ) {
                                            echo '<div class="category-card">';
                                            echo '<a href="' . esc_url( $category_link ) . '" class="category-link">';
                                            
                                            // Imagen de categoría o icono por defecto
                                            if ( $image_url ) {
                                                echo '<div class="category-image">';
                                                echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $category->name ) . '">';
                                                echo '</div>';
                                            } else {
                                                // Iconos por defecto según el nombre de la categoría
                                                $icon = '🔧'; // Default
                                                if ( stripos( $category->name, 'herramienta' ) !== false ) $icon = '🔨';
                                                elseif ( stripos( $category->name, 'electr' ) !== false ) $icon = '⚡';
                                                elseif ( stripos( $category->name, 'maquin' ) !== false ) $icon = '🏭';
                                                elseif ( stripos( $category->name, 'jardín' ) !== false ) $icon = '🌿';
                                                elseif ( stripos( $category->name, 'segur' ) !== false ) $icon = '🦺';
                                                
                                                echo '<div class="category-icon">' . $icon . '</div>';
                                            }
                                            
                                            echo '<div class="category-info">';
                                            echo '<h3 class="category-name">' . esc_html( $category->name ) . '</h3>';
                                            echo '<span class="category-count">' . $category->count . ' productos</span>';
                                            echo '</div>';
                                            echo '</a>';
                                            echo '</div>';
                                        }
                                    }
                                    echo '</div>';
                                } else {
                                    // Categorías fallback
                                    echo '<div class="categories-grid">';
                                    $fallback_categories = array(
                                        array( 'name' => 'Herramientas Manuales', 'icon' => '🔨', 'count' => '25' ),
                                        array( 'name' => 'Herramientas Eléctricas', 'icon' => '⚡', 'count' => '18' ),
                                        array( 'name' => 'Maquinaria Industrial', 'icon' => '🏭', 'count' => '12' ),
                                        array( 'name' => 'Jardín y Exterior', 'icon' => '🌿', 'count' => '15' ),
                                        array( 'name' => 'Seguridad', 'icon' => '🦺', 'count' => '8' ),
                                        array( 'name' => 'Accesorios', 'icon' => '🔧', 'count' => '22' ),
                                    );
                                    
                                    foreach ( $fallback_categories as $cat ) {
                                        echo '<div class="category-card">';
                                        echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '" class="category-link">';
                                        echo '<div class="category-icon">' . $cat['icon'] . '</div>';
                                        echo '<div class="category-info">';
                                        echo '<h3 class="category-name">' . $cat['name'] . '</h3>';
                                        echo '<span class="category-count">' . $cat['count'] . ' productos</span>';
                                        echo '</div>';
                                        echo '</a>';
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>
                            
                            <div class="dropdown-footer">
                                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="view-all-btn">
                                    Ver todas las categorías →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="search-section">
                    <form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input 
                            type="search" 
                            name="s" 
                            class="search-input"
                            placeholder="Buscar herramientas..." 
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                        >
                        <input type="hidden" name="post_type" value="product">
                        <button type="submit" class="search-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                                <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Header Actions -->
                <div class="header-actions">
                    <!-- Account -->
                    <a href="<?php echo esc_url( home_url( '/mi-cuenta' ) ); ?>" class="action-btn" title="Mi Cuenta">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"/>
                            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </a>

                    <!-- Cart -->
                    <?php 
                    $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/carrito' );
                    $cart_count = function_exists( 'WC' ) && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
                    ?>
                    <a href="<?php echo esc_url( $cart_url ); ?>" class="action-btn cart-btn" title="Carrito">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <?php if ( $cart_count > 0 ) : ?>
                            <span class="cart-badge"><?php echo esc_html( $cart_count ); ?></span>
                        <?php endif; ?>
                    </a>

                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-toggle" id="mobile-toggle" aria-label="Menú móvil">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobile-menu">
        <div class="mobile-content">
            <div class="mobile-header">
                <span class="mobile-logo">ITOOLS MX</span>
                <button class="mobile-close" id="mobile-close">✕</button>
            </div>
            
            <div class="mobile-search">
                <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" name="s" placeholder="Buscar productos..." value="<?php echo esc_attr( get_search_query() ); ?>">
                    <input type="hidden" name="post_type" value="product">
                </form>
            </div>

            <nav class="mobile-nav">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-link">🏠 Inicio</a>
                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="mobile-link">🛍️ Tienda</a>
                <a href="<?php echo esc_url( home_url( '/ofertas' ) ); ?>" class="mobile-link">🔥 Ofertas</a>
                <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" class="mobile-link">📞 Contacto</a>
                <a href="<?php echo esc_url( $cart_url ); ?>" class="mobile-link">🛒 Carrito (<?php echo $cart_count; ?>)</a>
                <a href="<?php echo esc_url( home_url( '/mi-cuenta' ) ); ?>" class="mobile-link">👤 Mi Cuenta</a>
            </nav>
        </div>
    </div>
</div>

<style>
/* Reset y ocultación de header padre */
.site-header,
.storefront-primary-navigation,
.storefront-handheld-footer-bar,
.site-branding,
.site-search,
.site-header-cart,
.storefront-secondary-navigation {
    display: none !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Categories dropdown
    const categoriesTrigger = document.getElementById('categories-trigger');
    const categoriesMenu = document.getElementById('categories-menu');
    
    if (categoriesTrigger && categoriesMenu) {
        categoriesTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            categoriesMenu.classList.toggle('active');
            this.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!categoriesTrigger.contains(e.target) && !categoriesMenu.contains(e.target)) {
                categoriesMenu.classList.remove('active');
                categoriesTrigger.classList.remove('active');
            }
        });
    }
    
    // Mobile menu
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileClose = document.getElementById('mobile-close');
    
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function() {
            mobileMenu.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (mobileClose && mobileMenu) {
        mobileClose.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // Sticky header
    const header = document.getElementById('main-header');
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
});
</script>
