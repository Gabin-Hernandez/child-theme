<?php
/**
 * Página de inicio personalizada
 */
get_header();
?>
<main id="main-content">
    <section class="hero">
        <h1>Bienvenido a <?php bloginfo('name'); ?></h1>
        <p>Soluciones modernas en herramientas y maquinaria.</p>
        <a href="/tienda" class="btn">Ver productos</a>
    </section>
    <section class="featured-products">
        <h2>Productos destacados</h2>
        <?php echo do_shortcode('[featured_products]'); ?>
    </section>
</main>
<?php get_footer(); ?>
