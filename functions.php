<?php
/**
 * Functions para Child Theme ITOOLS
 * Versión estable y compatible
 */

// Prevenir acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Encolar estilos del tema padre y hijo
 */
function itools_child_enqueue_styles() {
    // Encolar estilo del tema padre
    wp_enqueue_style( 
        'storefront-style', 
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme( get_template() )->get( 'Version' )
    );
    
    // Encolar estilo del tema hijo
    wp_enqueue_style( 
        'itools-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'storefront-style' ),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'itools_child_enqueue_styles' );

/**
 * Encolar JavaScript personalizado
 */
function itools_child_enqueue_scripts() {
    if ( file_exists( get_stylesheet_directory() . '/js/main.js' ) ) {
        wp_enqueue_script( 
            'itools-main-js',
            get_stylesheet_directory_uri() . '/js/main.js',
            array( 'jquery' ),
            wp_get_theme()->get( 'Version' ),
            true
        );
        
        // Localizar script para AJAX
        wp_localize_script( 'itools-main-js', 'itools_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'itools_nonce' )
        ));
    }
}
add_action( 'wp_enqueue_scripts', 'itools_child_enqueue_scripts' );

/**
 * Registrar áreas de menú
 */
function itools_register_nav_menus() {
    register_nav_menus( array(
        'primary' => esc_html__( 'Menú Principal', 'itools-child' ),
        'footer'  => esc_html__( 'Menú Footer', 'itools-child' ),
    ));
}
add_action( 'after_setup_theme', 'itools_register_nav_menus' );

/**
 * Función fallback para el menú principal
 */
function itools_fallback_menu() {
    $menu_items = array(
        'Inicio' => home_url( '/' ),
        'Tienda' => home_url( '/tienda' ),
        'Categorías' => home_url( '/categorias' ),
        'Contacto' => home_url( '/contacto' )
    );
    
    echo '<ul class="nav-menu">';
    foreach ( $menu_items as $title => $url ) {
        echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a></li>';
    }
    echo '</ul>';
}

/**
 * Ocultar header del tema padre
 */
function itools_hide_parent_header() {
    echo '<style type="text/css">
        .site-header,
        .storefront-primary-navigation,
        .storefront-handheld-footer-bar {
            display: none !important;
        }
    </style>';
}
add_action( 'wp_head', 'itools_hide_parent_header' );

/**
 * Soporte del tema
 */
function itools_theme_support() {
    // Soporte para WooCommerce (solo si está activo)
    if ( class_exists( 'WooCommerce' ) ) {
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
    
    // Otros soportes
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'itools_theme_support' );

/**
 * Función para obtener categorías de productos de forma segura
 */
function itools_get_product_categories() {
    if ( ! function_exists( 'get_terms' ) || ! taxonomy_exists( 'product_cat' ) ) {
        return array();
    }
    
    $categories = get_terms( array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'parent'     => 0,
    ));
    
    return is_wp_error( $categories ) ? array() : $categories;
}

/**
 * Función segura para obtener información del carrito
 */
function itools_get_cart_info() {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
        return array(
            'count' => 0,
            'total' => '$0.00',
            'url'   => '#'
        );
    }
    
    return array(
        'count' => WC()->cart->get_cart_contents_count(),
        'total' => WC()->cart->get_cart_total(),
        'url'   => wc_get_cart_url()
    );
}
