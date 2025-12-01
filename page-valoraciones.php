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
            
            <!-- Botón para dejar valoración -->
            <div class="mb-12 text-center">
                <button id="btn-nueva-valoracion" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Dejar mi Valoración
                </button>
            </div>

            <!-- Formulario de Nueva Valoración (oculto inicialmente) -->
            <div id="formulario-valoracion" class="max-w-3xl mx-auto mb-12 hidden">
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                    <!-- Header del formulario -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                        <h3 class="text-2xl md:text-3xl font-bold text-white text-center">
                            Comparte tu experiencia
                        </h3>
                        <p class="text-blue-100 text-center mt-2">
                            Tu opinión es muy importante para nosotros
                        </p>
                    </div>

                    <!-- Cuerpo del formulario -->
                    <form id="form-nueva-valoracion" class="p-8 md:p-12">
                        <!-- Nombre (requerido) -->
                        <div class="mb-6">
                            <label for="valoracion-nombre" class="block text-sm font-bold text-gray-700 mb-2">
                                Tu Nombre <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="valoracion-nombre" 
                                name="nombre" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition-all"
                                placeholder="Escribe tu nombre completo"
                            >
                        </div>

                        <!-- Calificación (requerido) -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-3">
                                Calificación <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-2">
                                <input type="radio" name="rating" value="5" id="star5" class="hidden" required>
                                <input type="radio" name="rating" value="4" id="star4" class="hidden">
                                <input type="radio" name="rating" value="3" id="star3" class="hidden">
                                <input type="radio" name="rating" value="2" id="star2" class="hidden">
                                <input type="radio" name="rating" value="1" id="star1" class="hidden">
                                
                                <div class="flex gap-1" id="star-rating">
                                    <label for="star5" class="star-label cursor-pointer text-4xl text-gray-300 hover:text-yellow-400 transition-colors" data-rating="5">★</label>
                                    <label for="star4" class="star-label cursor-pointer text-4xl text-gray-300 hover:text-yellow-400 transition-colors" data-rating="4">★</label>
                                    <label for="star3" class="star-label cursor-pointer text-4xl text-gray-300 hover:text-yellow-400 transition-colors" data-rating="3">★</label>
                                    <label for="star2" class="star-label cursor-pointer text-4xl text-gray-300 hover:text-yellow-400 transition-colors" data-rating="2">★</label>
                                    <label for="star1" class="star-label cursor-pointer text-4xl text-gray-300 hover:text-yellow-400 transition-colors" data-rating="1">★</label>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Haz clic en las estrellas para calificar</p>
                        </div>

                        <!-- Comentario (requerido) -->
                        <div class="mb-6">
                            <label for="valoracion-comentario" class="block text-sm font-bold text-gray-700 mb-2">
                                Tu Comentario <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="valoracion-comentario" 
                                name="comentario" 
                                rows="5" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition-all resize-none"
                                placeholder="Cuéntanos sobre tu experiencia con nosotros..."
                            ></textarea>
                            <p class="text-sm text-gray-500 mt-2">Mínimo 10 caracteres</p>
                        </div>

                        <!-- Producto (opcional) -->
                        <div class="mb-8">
                            <label for="valoracion-producto" class="block text-sm font-bold text-gray-700 mb-2">
                                Producto que compraste <span class="text-gray-400">(Opcional)</span>
                            </label>
                            <input 
                                type="text" 
                                id="valoracion-producto" 
                                name="producto" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition-all"
                                placeholder="Ej: iPhone 15 Pro Max, Galaxy S24 Ultra, etc."
                            >
                            <p class="text-sm text-gray-500 mt-2">Si deseas mencionar algún producto específico</p>
                        </div>

                        <!-- Mensaje de respuesta -->
                        <div id="form-response" class="mb-6 hidden"></div>

                        <!-- Botones -->
                        <div class="flex gap-4">
                            <button 
                                type="button" 
                                id="btn-cancelar-valoracion"
                                class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors"
                            >
                                Cancelar
                            </button>
                            <button 
                                type="submit" 
                                class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all"
                            >
                                Enviar Valoración
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Estadísticas rápidas -->
            <div class="mb-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                    <?php
                    global $wpdb;
                    $table_name = $wpdb->prefix . 'valoraciones_generales';
                    
                    // Total de valoraciones
                    $total_reviews = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE estado = 'aprobado'");
                    
                    // Promedio de calificación
                    $avg_rating = $wpdb->get_var("SELECT AVG(rating) FROM $table_name WHERE estado = 'aprobado'");
                    $avg_rating = $avg_rating ? round($avg_rating, 1) : 0;
                    
                    // Reseñas de 5 estrellas
                    $five_star_reviews = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE rating = 5 AND estado = 'aprobado'");
                    
                    // Porcentaje de satisfacción
                    $satisfaction = $total_reviews > 0 ? round(($five_star_reviews / $total_reviews) * 100) : 0;
                    ?>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="text-3xl font-black text-blue-600 mb-2"><?php echo number_format($total_reviews); ?></div>
                        <div class="text-sm font-semibold text-gray-600">Total Valoraciones</div>
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
                        <div class="text-3xl font-black text-purple-600 mb-2"><?php echo $satisfaction; ?>%</div>
                        <div class="text-sm font-semibold text-gray-600">Satisfacción</div>
                    </div>
                </div>
            </div>

            <!-- Lista de valoraciones -->
            <div class="max-w-6xl mx-auto">
                <?php
                // Paginación
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $per_page = 12;
                $offset = ($paged - 1) * $per_page;
                
                // Obtener valoraciones
                $valoraciones = $wpdb->get_results($wpdb->prepare(
                    "SELECT * FROM $table_name WHERE estado = 'aprobado' ORDER BY fecha DESC LIMIT %d OFFSET %d",
                    $per_page,
                    $offset
                ));
                
                if ($valoraciones) :
                ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($valoraciones as $valoracion) : ?>
                            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                                <!-- Header con estrellas -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex gap-1">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <svg class="w-5 h-5 <?php echo $i <= $valoracion->rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-sm text-gray-500">
                                        <?php echo date_i18n('d M Y', strtotime($valoracion->fecha)); ?>
                                    </span>
                                </div>

                                <!-- Nombre -->
                                <h4 class="font-bold text-gray-900 mb-2"><?php echo esc_html($valoracion->nombre); ?></h4>

                                <!-- Producto (si existe) -->
                                <?php if (!empty($valoracion->producto)) : ?>
                                    <p class="text-sm text-blue-600 font-semibold mb-3">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                        </svg>
                                        <?php echo esc_html($valoracion->producto); ?>
                                    </p>
                                <?php endif; ?>

                                <!-- Comentario -->
                                <p class="text-gray-600 leading-relaxed">
                                    <?php echo nl2br(esc_html($valoracion->comentario)); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Paginación -->
                    <?php
                    $total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE estado = 'aprobado'");
                    $total_pages = ceil($total_items / $per_page);
                    
                    if ($total_pages > 1) :
                    ?>
                        <div class="mt-12 flex justify-center">
                            <?php
                            echo paginate_links(array(
                                'total' => $total_pages,
                                'current' => $paged,
                                'type' => 'list',
                                'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>',
                                'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>',
                            ));
                            ?>
                        </div>
                    <?php endif; ?>

                <?php else : ?>
                    <div class="text-center py-12">
                        <svg class="w-20 h-20 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Aún no hay valoraciones</h3>
                        <p class="text-gray-600 mb-6">¡Sé el primero en compartir tu experiencia!</p>
                        <button onclick="document.getElementById('btn-nueva-valoracion').click()" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            Dejar mi Valoración
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            
    </section>
</main>

<style>
    /* Estilos para el sistema de calificación por estrellas */
    .star-label {
        transition: all 0.2s ease;
        user-select: none;
    }
    
    .star-label:hover {
        transform: scale(1.2);
    }
    
    /* Animaciones para las cards */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .valoraciones-grid > div {
        animation: fadeInUp 0.5s ease forwards;
    }
    
    /* Paginación */
    .page-numbers {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        margin: 0 4px;
        padding: 0 12px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    
    .page-numbers:not(.current):hover {
        background-color: #f3f4f6;
        transform: translateY(-2px);
    }
    
    .page-numbers.current {
        background: linear-gradient(to right, #2563eb, #4f46e5);
        color: white;
    }
    
    .page-numbers.prev,
    .page-numbers.next {
        background-color: #f3f4f6;
    }
    
    .page-numbers.prev:hover,
    .page-numbers.next:hover {
        background-color: #e5e7eb;
    }
</style>

<?php
get_footer();
?>