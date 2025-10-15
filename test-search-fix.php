<?php
/**
 * Archivo de prueba para verificar búsquedas
 * Solo para testing - eliminar después
 */

// Simular WordPress
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

// Test de búsqueda de productos
echo "<h2>Test de Búsqueda - Solo Productos</h2>";

// Simular una búsqueda
$search_term = 'herramienta';

// Test 1: WP_Query directa con post_type=product
echo "<h3>Test 1: WP_Query directa (como AJAX)</h3>";
$args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    's' => $search_term
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    echo "Productos encontrados: " . $query->found_posts . "<br>";
    while ($query->have_posts()) {
        $query->the_post();
        echo "- " . get_the_title() . " (Tipo: " . get_post_type() . ")<br>";
    }
    wp_reset_postdata();
} else {
    echo "No se encontraron productos.<br>";
}

// Test 2: Búsqueda general (simulando $_GET sin post_type)
echo "<h3>Test 2: Búsqueda general (debería incluir solo productos)</h3>";
$_GET['s'] = $search_term;

$general_args = array(
    'post_status' => 'publish',
    'posts_per_page' => 5,
    's' => $search_term
);

$general_query = new WP_Query($general_args);

if ($general_query->have_posts()) {
    echo "Posts encontrados: " . $general_query->found_posts . "<br>";
    while ($general_query->have_posts()) {
        $general_query->the_post();
        echo "- " . get_the_title() . " (Tipo: " . get_post_type() . ")<br>";
    }
    wp_reset_postdata();
} else {
    echo "No se encontraron posts.<br>";
}

// Limpiar
unset($_GET['s']);
?>