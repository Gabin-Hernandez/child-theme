<?php
/**
 * Listado de productos (WooCommerce)
 */
get_header();
?>
<main id="main-content">
    <section class="product-list">
        <h1>Todos los productos</h1>
        <?php woocommerce_content(); ?>
    </section>
</main>
<?php get_footer(); ?>
