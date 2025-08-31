<?php
/**
 * Index Template - Archivo principal de respaldo
 */
get_header();
?>

<div class="container">
    <main id="main">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1><?php the_title(); ?></h1>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No se encontró contenido.</p>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
