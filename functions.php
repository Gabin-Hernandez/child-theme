<?php
// Función para encolar los estilos del tema padre y del hijo
function child_theme_enqueue_styles() {
    $parent_style = 'storefront-style'; // Nombre del estilo del tema padre

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );

// Registrar menús de navegación
function itools_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Menú Principal', 'child-theme' ),
        'footer' => __( 'Menú Footer', 'child-theme' ),
    ) );
}
add_action( 'init', 'itools_register_menus' );

// Soporte para características del tema
function itools_theme_support() {
    // Soporte para imágenes destacadas
    add_theme_support( 'post-thumbnails' );
    
    // Soporte para WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    
    // Soporte para título dinámico
    add_theme_support( 'title-tag' );
    
    // Soporte para logos personalizados
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'itools_theme_support' );

// Encolar scripts personalizados
function itools_enqueue_scripts() {
    wp_enqueue_script('itools-main', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
    wp_localize_script('itools-main', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('itools_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'itools_enqueue_scripts');

// Función fallback para menú
function itools_fallback_menu() {
    echo '<ul class="nav-menu">
        <li><a href="' . home_url('/') . '">Inicio</a></li>
        <li><a href="' . home_url('/tienda') . '">Tienda</a></li>
        <li><a href="' . home_url('/categorias') . '">Categorías</a></li>
        <li><a href="' . home_url('/ofertas') . '">Ofertas</a></li>
        <li><a href="' . home_url('/contacto') . '">Contacto</a></li>
    </ul>';
}

// Ocultar elementos del tema padre que pueden interferir
function itools_hide_parent_elements() {
    ?>
    <style>
        .storefront-primary-navigation,
        .site-header,
        .storefront-handheld-footer-bar {
            display: none !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'itools_hide_parent_elements');
