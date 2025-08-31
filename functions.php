<?php
/**
 * Functions para Child Theme ITOOLS - Versión Mejorada
 */

// Encolar estilos del tema padre y hijo
function itools_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
    
    // Encolar JavaScript personalizado
    wp_enqueue_script( 'itools-header-js', get_stylesheet_directory_uri() . '/js/header.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'itools_child_enqueue_styles' );

// Soporte para menús de navegación
function itools_child_setup() {
    // Soporte para menús
    add_theme_support( 'menus' );
    
    // Registrar menús
    register_nav_menus( array(
        'primary' => 'Menú Principal',
        'footer' => 'Menú Footer'
    ) );
    
    // Soporte para logos personalizados
    add_theme_support( 'custom-logo', array(
        'height'      => 50,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'itools_child_setup' );

// Forzar el uso de nuestro header personalizado
function itools_force_custom_header() {
    remove_action( 'storefront_header', 'storefront_header_container', 0 );
    remove_action( 'storefront_header', 'storefront_skip_links', 5 );
    remove_action( 'storefront_header', 'storefront_social_icons', 10 );
    remove_action( 'storefront_header', 'storefront_site_branding', 20 );
    remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
    remove_action( 'storefront_header', 'storefront_product_search', 40 );
    remove_action( 'storefront_header', 'storefront_header_container_close', 41 );
    remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42 );
    remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
    remove_action( 'storefront_header', 'storefront_header_cart', 60 );
    remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );
}
add_action( 'init', 'itools_force_custom_header' );

// Agregar soporte para WooCommerce
function itools_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'itools_woocommerce_support' );

// JavaScript para funcionalidad del header
function itools_header_scripts() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.main-navigation');
        
        if (mobileToggle && mobileMenu) {
            mobileToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('mobile-open');
                this.classList.toggle('active');
            });
        }
        
        // Search enhancements
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('focused');
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('focused');
            });
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'itools_header_scripts' );

// Filtro para mostrar más productos en la página principal
function itools_modify_main_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( is_home() && function_exists( 'is_shop' ) ) {
            $query->set( 'posts_per_page', 12 );
        }
    }
}
add_action( 'pre_get_posts', 'itools_modify_main_query' );
