<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package ITOOLS_Child_Theme
 */

// Configuración básica para desarrollo local
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

// Simular funciones básicas de WordPress para desarrollo local
if (!function_exists('get_header')) {
    function get_header() {
        echo '<!DOCTYPE html><html><head><title>ITOOLS MX - Tienda</title>';
        echo '<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<script src="https://cdn.tailwindcss.com"></script>';
        echo '</head><body>';
    }
}

if (!function_exists('get_footer')) {
    function get_footer() {
        echo '</body></html>';
    }
}

if (!function_exists('have_posts')) {
    function have_posts() { return false; }
}

if (!function_exists('home_url')) {
    function home_url($path = '') { return 'http://localhost:8000' . $path; }
}

get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        
        <?php if ( have_posts() ) : ?>
            
            <div class="space-y-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-sm p-6 border border-gray-200'); ?>>
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="mb-6">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large', array('class' => 'w-full h-64 object-cover rounded-lg')); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <header class="mb-4">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <div class="text-sm text-gray-600 flex items-center gap-4">
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date(); ?>
                                </time>
                                <span>Por <?php the_author(); ?></span>
                                <?php if ( has_category() ) : ?>
                                    <span>En <?php the_category(', '); ?></span>
                                <?php endif; ?>
                            </div>
                        </header>
                        
                        <div class="prose max-w-none text-gray-700">
                            <?php
                            if ( is_home() || is_archive() ) {
                                the_excerpt();
                            } else {
                                the_content();
                            }
                            ?>
                        </div>
                        
                        <?php if ( is_home() || is_archive() ) : ?>
                            <footer class="mt-6 pt-4 border-t border-gray-200">
                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                                    Leer más
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </footer>
                        <?php endif; ?>
                        
                    </article>
                    
                <?php endwhile; ?>
            </div>
            
            <!-- Paginación -->
            <div class="mt-12">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '← Anterior',
                    'next_text' => 'Siguiente →',
                    'class' => 'flex justify-center space-x-2'
                ));
                ?>
            </div>
            
        <?php else : ?>
            
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">No se encontró contenido</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Lo sentimos, no hay contenido disponible en este momento.
                    </p>
                    <a href="<?php echo home_url('/'); ?>" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        Volver al inicio
                    </a>
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>
</div>

<?php get_footer(); ?>