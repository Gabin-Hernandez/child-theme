<?php
// Listado de productos básico y seguro
get_header();
?>
<main style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    <h1 style="margin-bottom: 30px; color: #333;">Todos los productos</h1>
    <?php woocommerce_content(); ?>
</main>
<?php get_footer(); ?>
