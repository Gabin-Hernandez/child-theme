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

// Función AJAX para filtros de productos
function itools_filter_products() {
    $categories = isset($_POST['categories']) ? $_POST['categories'] : array();
    $brands = isset($_POST['brands']) ? $_POST['brands'] : array();
    $min_price = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $max_price = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 999999;
    
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12,
        'meta_query' => array(
            array(
                'key' => '_price',
                'value' => array($min_price, $max_price),
                'type' => 'NUMERIC',
                'compare' => 'BETWEEN'
            )
        )
    );
    
    if (!empty($categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $categories
        );
    }
    
    if (!empty($brands)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'pa_marca',
            'field' => 'slug',
            'terms' => $brands
        );
    }
    
    $products = new WP_Query($args);
    
    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            wc_get_template_part('content', 'product');
        }
    } else {
        echo '<p>No se encontraron productos.</p>';
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filter_products', 'itools_filter_products');
add_action('wp_ajax_nopriv_filter_products', 'itools_filter_products');

// Encolar scripts personalizados
function itools_enqueue_scripts() {
    wp_enqueue_script('itools-main', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
    wp_localize_script('itools-main', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('itools_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'itools_enqueue_scripts');

// Personalizar WooCommerce
function itools_woocommerce_customizations() {
    // Remover acciones por defecto de WooCommerce
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    
    // Agregar nuestras propias acciones
    add_action('woocommerce_before_main_content', 'itools_wrapper_start', 10);
    add_action('woocommerce_after_main_content', 'itools_wrapper_end', 10);
}
add_action('init', 'itools_woocommerce_customizations');

function itools_wrapper_start() {
    echo '<div class="woocommerce-container"><div class="container">';
}

function itools_wrapper_end() {
    echo '</div></div>';
}

// Agregar atributo de marca para productos
function itools_register_product_attributes() {
    if (!taxonomy_exists('pa_marca')) {
        $args = array(
            'label' => __('Marca', 'child-theme'),
            'rewrite' => array('slug' => 'marca'),
            'hierarchical' => true,
        );
        register_taxonomy('pa_marca', 'product', $args);
    }
}
add_action('init', 'itools_register_product_attributes');

// Personalizar la cantidad de productos por página
function itools_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'itools_products_per_page', 20);
