<?php
/**
 * Temporary debug file to check categories and products
 * Access via: /debug-categories.php
 */

// Load WordPress
require_once('../../../wp-load.php');

echo "<h1>Debug: Categories and Products</h1>";

// Check if WooCommerce is active
if (!class_exists('WooCommerce')) {
    echo "<p><strong>ERROR:</strong> WooCommerce is not active!</p>";
    exit;
}

echo "<h2>1. All Product Categories</h2>";
$categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
));

if (is_wp_error($categories)) {
    echo "<p>Error getting categories: " . $categories->get_error_message() . "</p>";
} else {
    echo "<ul>";
    foreach ($categories as $category) {
        echo "<li><strong>{$category->name}</strong> (slug: {$category->slug}, ID: {$category->term_id}) - {$category->count} products</li>";
    }
    echo "</ul>";
}

echo "<h2>2. Check 'consolas' category specifically</h2>";
$consolas_term = get_term_by('slug', 'consolas', 'product_cat');
if ($consolas_term) {
    echo "<p><strong>Found 'consolas' category:</strong></p>";
    echo "<ul>";
    echo "<li>Name: {$consolas_term->name}</li>";
    echo "<li>Slug: {$consolas_term->slug}</li>";
    echo "<li>ID: {$consolas_term->term_id}</li>";
    echo "<li>Count: {$consolas_term->count}</li>";
    echo "</ul>";
    
    // Get products in this category
    echo "<h3>Products in 'consolas' category:</h3>";
    $products = wc_get_products(array(
        'category' => array('consolas'),
        'status' => 'publish',
        'limit' => 10
    ));
    
    if (empty($products)) {
        echo "<p><strong>No products found in 'consolas' category!</strong></p>";
    } else {
        echo "<ul>";
        foreach ($products as $product) {
            echo "<li>{$product->get_name()} (ID: {$product->get_id()})</li>";
        }
        echo "</ul>";
    }
} else {
    echo "<p><strong>ERROR:</strong> 'consolas' category not found!</p>";
}

echo "<h2>3. All Products (first 10)</h2>";
$all_products = wc_get_products(array(
    'status' => 'publish',
    'limit' => 10
));

if (empty($all_products)) {
    echo "<p><strong>No products found at all!</strong></p>";
} else {
    echo "<ul>";
    foreach ($all_products as $product) {
        $categories = wp_get_post_terms($product->get_id(), 'product_cat');
        $cat_names = array_map(function($cat) { return $cat->name; }, $categories);
        echo "<li>{$product->get_name()} (ID: {$product->get_id()}) - Categories: " . implode(', ', $cat_names) . "</li>";
    }
    echo "</ul>";
}

echo "<h2>4. Test Query with product_cat=consolas</h2>";
$test_query = new WP_Query(array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => 'consolas'
        )
    ),
    'posts_per_page' => 10
));

echo "<p>Query found {$test_query->found_posts} products</p>";
if ($test_query->have_posts()) {
    echo "<ul>";
    while ($test_query->have_posts()) {
        $test_query->the_post();
        echo "<li>" . get_the_title() . " (ID: " . get_the_ID() . ")</li>";
    }
    echo "</ul>";
    wp_reset_postdata();
} else {
    echo "<p>No products found with direct query</p>";
}

echo "<h2>5. Current URL Parameters</h2>";
echo "<pre>";
print_r($_GET);
echo "</pre>";

?>
