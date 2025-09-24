<?php
/**
 * Archivo temporal para crear productos de prueba
 * Este archivo simula productos para probar los filtros
 */

// Simular productos de prueba para diferentes categorías
$test_products = array(
    array(
        'id' => 1,
        'name' => 'Taladro DeWalt DCD771C2',
        'price' => 150.00,
        'category' => 'herramientas-electricas',
        'category_id' => 15,
        'brand' => 'dewalt',
        'image' => 'https://via.placeholder.com/300x300/1f2937/ffffff?text=Taladro+DeWalt'
    ),
    array(
        'id' => 2,
        'name' => 'Sierra Circular Makita 5007MG',
        'price' => 200.00,
        'category' => 'herramientas-electricas',
        'category_id' => 15,
        'brand' => 'makita',
        'image' => 'https://via.placeholder.com/300x300/1f2937/ffffff?text=Sierra+Makita'
    ),
    array(
        'id' => 3,
        'name' => 'Batería DeWalt 20V MAX',
        'price' => 80.00,
        'category' => 'baterias',
        'category_id' => 16,
        'brand' => 'dewalt',
        'image' => 'https://via.placeholder.com/300x300/1f2937/ffffff?text=Bateria+DeWalt'
    ),
    array(
        'id' => 4,
        'name' => 'Cargador Universal Bosch',
        'price' => 45.00,
        'category' => 'cargadores',
        'category_id' => 17,
        'brand' => 'bosch',
        'image' => 'https://via.placeholder.com/300x300/1f2937/ffffff?text=Cargador+Bosch'
    ),
    array(
        'id' => 5,
        'name' => 'Martillo DeWalt D25133K',
        'price' => 180.00,
        'category' => 'herramientas-electricas',
        'category_id' => 15,
        'brand' => 'dewalt',
        'image' => 'https://via.placeholder.com/300x300/1f2937/ffffff?text=Martillo+DeWalt'
    ),
    array(
        'id' => 6,
        'name' => 'Amoladora Makita GA5030',
        'price' => 120.00,
        'category' => 'herramientas-electricas',
        'category_id' => 15,
        'brand' => 'makita',
        'image' => 'https://via.placeholder.com/300x300/1f2937/ffffff?text=Amoladora+Makita'
    )
);

// Categorías de prueba
$test_categories = array(
    array('id' => 15, 'name' => 'Herramientas Eléctricas', 'slug' => 'herramientas-electricas', 'count' => 4),
    array('id' => 16, 'name' => 'Baterías', 'slug' => 'baterias', 'count' => 1),
    array('id' => 17, 'name' => 'Cargadores', 'slug' => 'cargadores', 'count' => 1),
);

// Marcas de prueba
$test_brands = array(
    array('id' => 1, 'name' => 'DeWalt', 'slug' => 'dewalt', 'count' => 3),
    array('id' => 2, 'name' => 'Makita', 'slug' => 'makita', 'count' => 2),
    array('id' => 3, 'name' => 'Bosch', 'slug' => 'bosch', 'count' => 1),
);

// Función para filtrar productos según parámetros URL
function filter_test_products($products, $categories, $brands) {
    $filtered = $products;
    
    // Filtrar por categoría
    if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
        $category_filter = explode(',', $_GET['product_cat']);
        $filtered = array_filter($filtered, function($product) use ($category_filter) {
            return in_array($product['category_id'], $category_filter) || 
                   in_array($product['category'], $category_filter);
        });
    }
    
    // Filtrar por marca
    if (isset($_GET['product_brand']) && !empty($_GET['product_brand'])) {
        $brand_filter = explode(',', $_GET['product_brand']);
        $filtered = array_filter($filtered, function($product) use ($brand_filter) {
            return in_array($product['brand'], $brand_filter);
        });
    }
    
    // Filtrar por precio
    if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
        $min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
        $max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : PHP_FLOAT_MAX;
        
        $filtered = array_filter($filtered, function($product) use ($min_price, $max_price) {
            return $product['price'] >= $min_price && $product['price'] <= $max_price;
        });
    }
    
    return $filtered;
}

// Exportar datos para uso en templates
global $test_products_data, $test_categories_data, $test_brands_data;
$test_products_data = $test_products;
$test_categories_data = $test_categories;
$test_brands_data = $test_brands;
?>