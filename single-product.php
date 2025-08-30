<?php
/**
 * Página de producto individual (WooCommerce)
 */
get_header();
?>
<main id="main-content">
    <section class="single-product">
        <?php woocommerce_content(); ?>
    </section>
</main>
<?php get_footer(); ?>
