<?php
/**
 * Template Name: Página de Valoraciones
 */

defined('ABSPATH') || exit;

get_header();

$page_id = get_queried_object_id();
$page_title = get_the_title($page_id);
$page_excerpt = get_post_field('post_excerpt', $page_id);
$banner_url = get_the_post_thumbnail_url($page_id, 'full');
?>

<main class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <?php if ($banner_url): ?>
            <div class="h-64 md:h-80 lg:h-96 relative">
                <img src="<?php echo esc_url($banner_url); ?>" alt="<?php echo esc_attr($page_title); ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-purple-900/60 to-indigo-900/40"></div>
            </div>
        <?php else: ?>
            <div class="h-64 md:h-80 lg:h-96 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-600 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/20 via-purple-900/10 to-indigo-900/20"></div>
            </div>
        <?php endif; ?>
        
        <div class="container mx-auto px-4 -mt-20 relative z-10 pb-8">
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 md:p-12 border border-white/20 relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-yellow-500/10 to-orange-500/10 rounded-full -translate-y-16 translate-x-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-blue-500/10 to-purple-500/10 rounded-full translate-y-12 -translate-x-12"></div>
                
                <div class="relative z-10 text-center">
                    <div class="inline-flex items-center gap-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-6 py-3 rounded-full mb-6 shadow-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        <span class="font-bold text-sm uppercase tracking-wider">Testimonios Reales</span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 leading-tight">
                        <?php echo esc_html($page_title); ?>
                    </h1>
                    
                    <?php if ($page_excerpt): ?>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed mb-6">
                            <?php echo wp_kses_post($page_excerpt); ?>
                        </p>
                    <?php else: ?>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed mb-6">
                            Descubre lo que nuestros clientes reales opinan sobre nuestros productos. 
                            Cada reseña es una historia de satisfacción y confianza.
                        </p>
                    <?php endif; ?>
                    
                    <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Reseñas Verificadas</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span>Actualizadas en Tiempo Real</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span>100% Auténticas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenido Principal -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            
            <!-- Estadísticas rápidas -->
            <div class="mb-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                    <?php
                    // Obtener estadísticas de reseñas - usando la nueva consulta que incluye todos los tipos
                    $total_reviews = get_comments(array(
                        'status' => 'approve',
                        'post_type' => 'product',
                        'meta_query' => array(
                            array(
                                'key' => 'rating',
                                'compare' => 'EXISTS'
                            )
                        ),
                        'count' => true
                    ));
                    
                    $avg_rating_query = new WP_Comment_Query();
                    $all_reviews = $avg_rating_query->query(array(
                        'status' => 'approve',
                        'post_type' => 'product',
                        'meta_query' => array(
                            array(
                                'key' => 'rating',
                                'compare' => 'EXISTS'
                            )
                        )
                    ));
                    
                    $total_rating = 0;
                    $count_ratings = 0;
                    foreach ($all_reviews as $review) {
                        $rating = get_comment_meta($review->comment_ID, 'rating', true);
                        if ($rating) {
                            $total_rating += $rating;
                            $count_ratings++;
                        }
                    }
                    
                    $avg_rating = $count_ratings > 0 ? round($total_rating / $count_ratings, 1) : 0;
                    
                    // Contar reseñas de 5 estrellas
                    $five_star_reviews = count(array_filter($all_reviews, function($review) {
                        return get_comment_meta($review->comment_ID, 'rating', true) == 5;
                    }));
                    ?>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="text-3xl font-black text-blue-600 mb-2"><?php echo number_format($total_reviews); ?></div>
                        <div class="text-sm font-semibold text-gray-600">Total Reseñas</div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="text-3xl font-black text-yellow-500 mb-2"><?php echo $avg_rating; ?>/5</div>
                        <div class="text-sm font-semibold text-gray-600">Calificación Promedio</div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="text-3xl font-black text-green-600 mb-2"><?php echo number_format($five_star_reviews); ?></div>
                        <div class="text-sm font-semibold text-gray-600">5 Estrellas</div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="text-3xl font-black text-purple-600 mb-2"><?php echo $count_ratings > 0 ? round(($five_star_reviews / $count_ratings) * 100) : 0; ?>%</div>
                        <div class="text-sm font-semibold text-gray-600">Satisfacción</div>
                    </div>
                </div>
            </div>

            <!-- Shortcode de valoraciones -->
            <?php echo do_shortcode('[valoraciones_globales numero="20" orden="date" direccion="DESC" mostrar_paginacion="true"]'); ?>
            
            <!-- Call to action -->
            <div class="mt-16 text-center">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-8 md:p-12 text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative z-10">
                        <h3 class="text-2xl md:text-3xl font-black mb-4">¿Ya compraste con nosotros?</h3>
                        <p class="text-lg md:text-xl mb-6 opacity-90">
                            Comparte tu experiencia y ayuda a otros clientes a tomar la mejor decisión
                        </p>
                        <a href="/tienda" class="inline-flex items-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 transition-colors shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Explorar Productos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>