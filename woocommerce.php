<?php
/**
 * Template principal de WooCommerce
 * Este archivo maneja todas las páginas de WooCommerce incluyendo la tienda
 */

get_header(); ?>

<div class="woocommerce-page">
    <?php
    // Verificar si es la página de tienda
    if (is_shop()) {
        // Incluir el template personalizado de tienda
        get_template_part('archive', 'product');
    } 
    // Verificar si es una categoría de producto
    elseif (is_product_category()) {
        get_template_part('taxonomy', 'product_cat');
    }
    // Verificar si es un producto individual
    elseif (is_product()) {
        get_template_part('single', 'product');
    }
    // Para cualquier otra página de WooCommerce
    else {
        ?>
        <div class="container mx-auto px-4 py-8">
            <?php woocommerce_content(); ?>
        </div>
        <?php
    }
    ?>
</div>

<?php get_footer(); ?>