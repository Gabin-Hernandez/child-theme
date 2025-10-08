<?php
/**
 * Script de depuración para verificar el estado de las reseñas
 * Agregar esto temporalmente al single-product.php en la pestaña de reseñas
 */

global $product, $post;

echo '<div style="background: #fff3cd; border: 2px solid #ffc107; padding: 15px; margin: 10px 0; border-radius: 8px; font-family: monospace; font-size: 12px;">';
echo '<h3 style="margin: 0 0 10px 0; color: #856404;">🔍 Debug Info - Reseñas</h3>';

echo '<strong>Product ID:</strong> ' . $product->get_id() . '<br>';
echo '<strong>Product Name:</strong> ' . $product->get_name() . '<br>';
echo '<strong>Post Type:</strong> ' . get_post_type() . '<br>';
echo '<strong>Comment Status:</strong> ' . $post->comment_status . '<br>';
echo '<strong>comments_open():</strong> ' . ( comments_open() ? 'TRUE ✅' : 'FALSE ❌' ) . '<br>';
echo '<strong>have_comments():</strong> ' . ( have_comments() ? 'TRUE ✅' : 'FALSE ❌' ) . '<br>';
echo '<strong>get_comments_number():</strong> ' . get_comments_number() . '<br>';
echo '<strong>Review Count:</strong> ' . $product->get_review_count() . '<br>';
echo '<strong>Rating Count:</strong> ' . $product->get_rating_count() . '<br>';
echo '<strong>wc_review_ratings_enabled():</strong> ' . ( wc_review_ratings_enabled() ? 'TRUE ✅' : 'FALSE ❌' ) . '<br>';

// Verificar configuración de WooCommerce
echo '<strong>WC Enable Reviews:</strong> ' . ( get_option( 'woocommerce_enable_reviews' ) === 'yes' ? 'YES ✅' : 'NO ❌' ) . '<br>';
echo '<strong>WC Review Verification:</strong> ' . ( get_option( 'woocommerce_review_rating_verification_required' ) === 'yes' ? 'YES (requiere compra)' : 'NO ✅' ) . '<br>';
echo '<strong>Require Name/Email:</strong> ' . ( get_option( 'require_name_email' ) ? 'YES' : 'NO' ) . '<br>';

// Verificar si el usuario actual puede comentar
$current_user = wp_get_current_user();
echo '<strong>Current User ID:</strong> ' . ( $current_user->ID ? $current_user->ID : 'Guest (0)' ) . '<br>';
echo '<strong>User can comment:</strong> ' . ( comments_open() && ( ! is_user_logged_in() || current_user_can( 'edit_posts' ) ) ? 'YES ✅' : 'NO ❌' ) . '<br>';

echo '</div>';
?>
