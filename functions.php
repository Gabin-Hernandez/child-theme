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

// Remover acciones del tema padre que pueden interferir
function itools_remove_parent_actions() {
    // Remover el header del tema padre
    remove_action( 'storefront_header', 'storefront_header_container', 0 );
    remove_action( 'storefront_header', 'storefront_skip_links', 5 );
    remove_action( 'storefront_header', 'storefront_social_icons', 10 );
    remove_action( 'storefront_header', 'storefront_site_branding', 20 );
    remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
    remove_action( 'storefront_header', 'storefront_product_search', 40 );
    remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42 );
    remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
    remove_action( 'storefront_header', 'storefront_header_cart', 60 );
    remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );
    remove_action( 'storefront_header', 'storefront_header_container_close', 41 );
}
add_action( 'init', 'itools_remove_parent_actions' );

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
    check_ajax_referer('itools_nonce', 'nonce');
    
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
        echo '<div class="products-container">';
        while ($products->have_posts()) {
            $products->the_post();
            wc_get_template_part('content', 'product');
        }
        echo '</div>';
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

// Personalizar la cantidad de productos por página
function itools_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'itools_products_per_page', 20);

// Mejorar la búsqueda para incluir categorías
function itools_search_filter($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_search() && isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => sanitize_text_field($_GET['product_cat'])
                )
            ));
        }
    }
}
add_action('pre_get_posts', 'itools_search_filter');

// Agregar clase body personalizada para el tema hijo
function itools_body_class($classes) {
    $classes[] = 'itools-child-theme';
    return $classes;
}
add_filter('body_class', 'itools_body_class');

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

// Agregar contenido después del body open
function itools_after_body_open() {
    get_template_part('header');
}
// Commented out as it might conflict with the header.php inclusion
// add_action('wp_body_open', 'itools_after_body_open');
