<?php
/**
 * Functions para Child Theme ITOOLS - Versión Corregida
 */

// Prevenir acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Encolar estilos y scripts correctamente para tema hijo
function itools_child_enqueue_styles() {
    // Versión para cache busting
    $version = wp_get_theme()->get('Version');
    
    // Estilos del tema padre (Storefront)
    wp_enqueue_style( 
        'parent-style', 
        get_template_directory_uri() . '/style.css',
        array(),
        $version
    );

    // Estilos del tema hijo
    wp_enqueue_style( 
        'child-style', 
        get_stylesheet_directory_uri() . '/style.css', 
        array('parent-style'),
        $version
    );
}
add_action( 'wp_enqueue_scripts', 'itools_child_enqueue_styles' );

// Agregar Tailwind CSS y configuración en el head
function itools_add_tailwind_css() {
    ?>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#667eea',
                        'brand-purple': '#764ba2',
                    }
                }
            }
        }
    </script>
    <style>
        /* Asegurar que Tailwind funcione correctamente */
        * {
            box-sizing: border-box;
        }
        
        body {
            margin: 0;
            padding: 0;
        }
        
        /* Fix para el tema padre Storefront */
        .site-main {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .content-area {
            margin: 0 !important;
            padding: 0 !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'itools_add_tailwind_css', 1 );

// Soporte para tema hijo
function itools_child_setup() {
    // Soporte para menús
    add_theme_support( 'menus' );

    register_nav_menus( array(
        'primary' => 'Menú Principal',
        'footer'  => 'Menú Footer'
    ) );

    // Soporte para logo personalizado
    add_theme_support( 'custom-logo', array(
        'height'      => 50,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Soporte para imágenes destacadas
    add_theme_support( 'post-thumbnails' );
    
    // Soporte para HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
}
add_action( 'after_setup_theme', 'itools_child_setup' );

// WooCommerce Support
function itools_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'itools_woocommerce_support' );

// Forzar que el tema hijo tome precedencia sobre el padre
function itools_force_child_theme() {
    // Asegurar que nuestros templates se usen
    if ( is_front_page() ) {
        remove_all_actions( 'storefront_homepage' );
    }
}
add_action( 'init', 'itools_force_child_theme' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'itools_woocommerce_support' );

// Forzar uso de header y footer personalizados
function itools_use_custom_header( $template ) {
    $child_header = get_stylesheet_directory() . '/header.php';
    if ( file_exists( $child_header ) ) {
        return $child_header;
    }
    return $template;
}
add_filter( 'template_include', function( $template ) {
    if ( is_page() || is_single() || is_home() || is_archive() ) {
        return itools_use_custom_header( $template );
    }
    return $template;
});

function itools_get_header( $header ) {
    $child_header = get_stylesheet_directory() . '/header.php';
    if ( file_exists( $child_header ) ) {
        load_template( $child_header, true );
        return;
    }
    get_template_part( 'header', $header );
}
add_filter( 'get_header', 'itools_get_header' );

function itools_get_footer( $footer ) {
    $child_footer = get_stylesheet_directory() . '/footer.php';
    if ( file_exists( $child_footer ) ) {
        load_template( $child_footer, true );
        return;
    }
    get_template_part( 'footer', $footer );
}
add_filter( 'get_footer', 'itools_get_footer' );

// JS Inline para mejoras del header
function itools_header_scripts() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.main-navigation');
        
        if (mobileToggle && mobileMenu) {
            mobileToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('mobile-open');
                this.classList.toggle('active');
            });
        }

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

// Mostrar más productos en home
function itools_modify_main_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( is_home() && function_exists( 'is_shop' ) ) {
            $query->set( 'posts_per_page', 12 );
        }
    }
}
add_action( 'pre_get_posts', 'itools_modify_main_query' );
