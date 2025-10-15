<?php
/**
 * SEO Enhancements para los componentes
 * Mejoras adicionales opcionales para SEO
 */

// 1. Agregar más structured data para productos individuales
function add_product_schema($product) {
    if (!$product) return;
    
    $schema = array(
        "@context" => "https://schema.org",
        "@type" => "Product",
        "name" => $product->get_name(),
        "description" => wp_strip_all_tags($product->get_short_description()),
        "url" => get_permalink($product->get_id()),
        "image" => wp_get_attachment_image_url($product->get_image_id(), 'full'),
        "offers" => array(
            "@type" => "Offer",
            "price" => $product->get_price(),
            "priceCurrency" => get_woocommerce_currency(),
            "availability" => $product->is_in_stock() ? "https://schema.org/InStock" : "https://schema.org/OutOfStock"
        )
    );
    
    if ($product->get_average_rating()) {
        $schema["aggregateRating"] = array(
            "@type" => "AggregateRating",
            "ratingValue" => $product->get_average_rating(),
            "reviewCount" => $product->get_review_count()
        );
    }
    
    echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
}

// 2. Mejorar títulos de página dinámicos
function get_seo_title($search_term, $page_num = 1) {
    $title = "Microscopios para Reparación de Celulares";
    
    if ($search_term) {
        $title = "Microscopios: " . ucfirst($search_term);
    }
    
    if ($page_num > 1) {
        $title .= " - Página " . $page_num;
    }
    
    return $title . " | ITOOLS";
}

// 3. Canonical URLs para filtros
function get_canonical_url() {
    $current_url = home_url($_SERVER['REQUEST_URI']);
    
    // Mantener solo parámetros importantes para SEO
    $allowed_params = ['s', 'product_cat', 'min_price', 'max_price', 'orderby', 'paged'];
    $parsed_url = parse_url($current_url);
    
    if (isset($parsed_url['query'])) {
        parse_str($parsed_url['query'], $params);
        $filtered_params = array_intersect_key($params, array_flip($allowed_params));
        $query_string = http_build_query($filtered_params);
        
        return $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'] . 
               ($query_string ? '?' . $query_string : '');
    }
    
    return $current_url;
}

// 4. Sitemap automático para productos filtrados
function generate_product_sitemap_urls() {
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true
    ));
    
    $sitemap_urls = array();
    
    foreach ($categories as $category) {
        $sitemap_urls[] = array(
            'url' => home_url('/?post_type=product&product_cat=' . $category->slug),
            'changefreq' => 'weekly',
            'priority' => '0.8'
        );
    }
    
    return $sitemap_urls;
}
?>