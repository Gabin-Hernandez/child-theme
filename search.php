<?php
/**
 * Plantilla para resultados de búsqueda - Solo productos
 * 
 * ITOOLS Child Theme
 */

get_header();

// Redirigir búsquedas generales a búsquedas de productos
if (!isset($_GET['post_type']) || $_GET['post_type'] !== 'product') {
    $search_query = get_search_query();
    if (!empty($search_query)) {
        $redirect_url = add_query_arg(array(
            's' => $search_query,
            'post_type' => 'product'
        ), home_url('/'));
        
        wp_redirect($redirect_url, 301);
        exit;
    }
}

// Si llegamos aquí, mostrar la página de productos (tienda)
wp_redirect(wc_get_page_permalink('shop'), 301);
exit;

get_footer();
?>