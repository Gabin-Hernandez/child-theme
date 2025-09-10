<?php
/**
 * Archivo de categorías de productos - ITOOLS
 */

get_header();

// Obtener la categoría actual
$queried_object = get_queried_object();
$category_name = $queried_object->name;
$category_slug = $queried_object->slug;
$category_description = $queried_object->description;
?>

<!-- Hero Section Moderno para Categoría -->
<div class="bg-gradient-to-br from-blue-600 to-indigo-700 py-16">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 capitalize">
                <?php echo esc_html($category_name); ?>
            </h1>
            <?php if ($category_description) : ?>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    <?php echo wp_kses_post($category_description); ?>
                </p>
            <?php else : ?>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Encuentra las mejores <?php echo esc_html(strtolower($category_name)); ?> profesionales para tus proyectos
                </p>
            <?php endif; ?>
            
            <!-- Formulario de búsqueda funcional -->
            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="max-w-2xl mx-auto">
                <div class="flex gap-3">
                    <input type="hidden" name="post_type" value="product">
                    <input type="hidden" name="product_cat" value="<?php echo esc_attr($category_slug); ?>">
                    <div class="flex-1 relative">
                        <input type="text" 
                               name="s" 
                               value="<?php echo get_search_query(); ?>"
                               placeholder="Buscar en <?php echo esc_attr($category_name); ?>..."
                               class="w-full px-6 py-4 text-lg rounded-xl border-0 focus:ring-4 focus:ring-blue-300 shadow-lg">
                    </div>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-4 rounded-xl font-semibold transition-colors shadow-lg">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">

        <!-- Navegación de breadcrumbs -->
        <div class="mb-6">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="<?php echo home_url(); ?>" class="hover:text-blue-600 transition-colors">Inicio</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="hover:text-blue-600 transition-colors">Tienda</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium capitalize"><?php echo esc_html($category_name); ?></span>
            </nav>
        </div>

        <?php if ( have_posts() ) : ?>

            <!-- Barra superior limpia con información básica -->
            <div class="bg-white p-4 lg:p-6 rounded-2xl shadow-sm mb-6 border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    
                    <!-- Información de resultados -->
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-6 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                        <div>
                            <?php
                            global $wp_query;
                            $total_products = $wp_query->found_posts;
                            if ( $total_products ) :
                                $current_page = max( 1, get_query_var( 'paged' ) );
                                $per_page = get_option( 'posts_per_page' );
                                $first = ( $current_page - 1 ) * $per_page + 1;
                                $last = min( $total_products, $current_page * $per_page );
                            ?>
                                <h3 class="text-lg lg:text-xl font-bold text-gray-900">
                                    <?php echo $total_products; ?> Productos en <?php echo esc_html($category_name); ?>
                                </h3>
                                <p class="text-sm text-gray-600">
                                    <?php echo $first; ?>-<?php echo $last; ?> de <?php echo $total_products; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Controles simples -->
                    <div class="flex items-center gap-3">
                        <!-- Selector de vista -->
                        <div class="flex bg-gray-100 rounded-xl p-1">
                            <button id="grid-view" class="px-3 py-2 rounded-lg transition-all duration-300 bg-white shadow-sm">
                                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </button>
                            <button id="list-view" class="px-3 py-2 rounded-lg transition-all duration-300 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Ordenamiento básico -->
                        <div class="woocommerce-ordering">
                            <?php woocommerce_catalog_ordering(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid de productos moderno -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8 sm:gap-10 lg:gap-12" id="products-grid">
                <?php
                while ( have_posts() ) {
                    the_post();
                    
                    // Template personalizado de producto
                    ?>
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300 h-full flex flex-col min-h-[380px] m-4">
                        <!-- Imagen del producto -->
                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                            <a href="<?php the_permalink(); ?>" class="block h-full">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'woocommerce_thumbnail', array(
                                        'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                                    ) );
                                } else {
                                    echo '<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">';
                                    echo '<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                    echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                                    echo '</svg>';
                                    echo '</div>';
                                }
                                ?>
                            </a>
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 flex flex-col gap-1 z-10">
                                <?php if ( $product = wc_get_product( get_the_ID() ) ) : ?>
                                    <?php if ( $product->is_on_sale() ) : ?>
                                        <span class="bg-red-500 text-white px-2 py-1 rounded-md text-xs font-bold shadow-md">
                                            Oferta
                                        </span>
                                    <?php endif; ?>
                                    <?php if ( $product->is_featured() ) : ?>
                                        <span class="bg-yellow-500 text-white px-2 py-1 rounded-md text-xs font-bold shadow-md">
                                            ⭐
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Botones de acción rápida -->
                            <div class="absolute top-3 right-3 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                <button class="w-8 h-8 bg-white/95 rounded-full shadow-md flex items-center justify-center hover:bg-white hover:scale-110 transition-all duration-200 wishlist-btn">
                                    <svg class="w-4 h-4 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                                <button class="w-8 h-8 bg-white/95 rounded-full shadow-md flex items-center justify-center hover:bg-white hover:scale-110 transition-all duration-200 quick-view-btn">
                                    <svg class="w-4 h-4 text-gray-600 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Información del producto -->
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <!-- Contenido superior -->
                            <div class="flex-1">
                                <!-- Título -->
                                <h3 class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 leading-snug mb-2 min-h-[2.5rem]">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <!-- Valoración -->
                                <?php if ( $product = wc_get_product( get_the_ID() ) ) : ?>
                                    <div class="flex items-center gap-1 mb-3 min-h-[1.25rem]">
                                        <?php 
                                        $rating = $product->get_average_rating();
                                        $review_count = $product->get_review_count();
                                        if ( $rating > 0 ) :
                                        ?>
                                            <div class="flex items-center">
                                                <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                                    <svg class="w-3 h-3 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                <?php endfor; ?>
                                            </div>
                                            <span class="text-xs text-gray-500 ml-1">(<?php echo $review_count; ?>)</span>
                                        <?php else : ?>
                                            <span class="text-xs text-gray-400">Sin reseñas</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Contenido inferior fijo -->
                            <div class="mt-auto">
                                <!-- Precio -->
                                <div class="mb-4">
                                    <?php if ( $product ) : ?>
                                        <div class="text-lg font-bold text-gray-900 min-h-[1.75rem] flex items-center">
                                            <?php echo $product->get_price_html(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Botón de agregar al carrito -->
                                <div>
                                    <?php if ( $product ) : ?>
                                        <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                                                Agregar al carrito
                                            </button>
                                        <?php else : ?>
                                            <button class="w-full bg-gray-300 text-gray-600 py-2.5 px-4 rounded-lg text-sm font-medium cursor-not-allowed">
                                                No disponible
                                            </button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <!-- Paginación moderna -->
            <div class="mt-12">
                <?php
                the_posts_pagination( array(
                    'mid_size' => 2,
                    'prev_text' => __( 'Anterior', 'textdomain' ),
                    'next_text' => __( 'Siguiente', 'textdomain' ),
                ) );
                ?>
            </div>

        <?php else : ?>

            <!-- Estado vacío mejorado -->
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <!-- Ilustración SVG -->
                    <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">No encontramos productos en <?php echo esc_html($category_name); ?></h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Lo sentimos, no hay productos disponibles en esta categoría en este momento.
                        <br>Explora nuestras otras categorías o vuelve más tarde.
                    </p>
                    
                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-2xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Ver Todos los Productos
                        </a>
                        <a href="<?php echo home_url(); ?>" class="bg-white border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-2xl hover:border-blue-500 hover:text-blue-600 transition-all duration-300 font-semibold">
                            Volver al Inicio
                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <!-- Categorías relacionadas -->
        <?php if ( have_posts() ) : ?>
        <div class="mt-16">
            <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Otras categorías que te pueden interesar</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php
                $other_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'exclude' => array($queried_object->term_id), // Excluir la categoría actual
                    'number' => 4
                ));
                
                if ($other_categories && !is_wp_error($other_categories)) :
                    foreach ($other_categories as $cat) :
                ?>
                    <a href="<?php echo get_term_link($cat); ?>" 
                       class="bg-gradient-to-br from-blue-50 to-purple-50 border border-blue-200 rounded-xl p-6 text-center hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <div class="text-3xl mb-3">🛍️</div>
                        <h4 class="font-semibold text-gray-900 capitalize"><?php echo esc_html($cat->name); ?></h4>
                        <p class="text-sm text-gray-600 mt-1"><?php echo $cat->count; ?> productos</p>
                    </a>
                <?php 
                    endforeach;
                endif;
                ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<!-- Estilos específicos para categorías -->
<style>
/* Estilo personalizado para el selector de ordenamiento */
.woocommerce-ordering select {
    padding: 8px 12px !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 0.75rem !important;
    background-color: white !important;
    font-size: 14px !important;
    color: #374151 !important;
    min-width: 160px !important;
    appearance: none !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e") !important;
    background-position: right 8px center !important;
    background-repeat: no-repeat !important;
    background-size: 16px 16px !important;
    transition: all 0.2s ease !important;
}

.woocommerce-ordering select:focus {
    outline: none !important;
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1) !important;
}

.woocommerce-ordering select:hover {
    border-color: #d1d5db !important;
}

/* Estilos para el grid responsivo */
@media (max-width: 640px) {
    .woocommerce-ordering select {
        min-width: 140px !important;
        font-size: 13px !important;
        padding: 6px 10px !important;
    }
}

/* Estilos para paginación */
.wp-pagenavi,
.page-links,
.posts-navigation,
.pagination {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 0.5rem !important;
    margin-top: 2rem !important;
}

.wp-pagenavi a,
.wp-pagenavi span,
.page-links a,
.page-links span,
.posts-navigation a,
.pagination a,
.pagination span {
    padding: 0.75rem 1rem !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 0.5rem !important;
    color: #374151 !important;
    text-decoration: none !important;
    transition: all 0.3s ease !important;
    background: white !important;
}

.wp-pagenavi a:hover,
.page-links a:hover,
.posts-navigation a:hover,
.pagination a:hover {
    background: linear-gradient(to right, #2563eb, #9333ea) !important;
    color: white !important;
    border-color: transparent !important;
    transform: translateY(-2px) !important;
}

.wp-pagenavi span.current,
.page-links span.current,
.pagination span.current {
    background: linear-gradient(to right, #2563eb, #9333ea) !important;
    color: white !important;
    border-color: transparent !important;
}

/* Utilidades de línea truncada */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<!-- JavaScript para funcionalidades -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const gridViewBtn = document.getElementById('grid-view');
    const listViewBtn = document.getElementById('list-view');
    const productsGrid = document.getElementById('products-grid');
    
    // Toggle vista de productos (grid/list)
    if (gridViewBtn && listViewBtn) {
        gridViewBtn.addEventListener('click', function() {
            setProductView('grid');
        });
        
        listViewBtn.addEventListener('click', function() {
            setProductView('list');
        });
    }
    
    function setProductView(view) {
        if (view === 'grid') {
            productsGrid.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8 sm:gap-10 lg:gap-12';
            gridViewBtn.className = 'px-3 py-2 rounded-lg transition-all duration-300 bg-white shadow-sm text-blue-600';
            listViewBtn.className = 'px-3 py-2 rounded-lg transition-all duration-300 text-gray-500';
        } else {
            productsGrid.className = 'grid grid-cols-1 gap-6';
            listViewBtn.className = 'px-3 py-2 rounded-lg transition-all duration-300 bg-white shadow-sm text-blue-600';
            gridViewBtn.className = 'px-3 py-2 rounded-lg transition-all duration-300 text-gray-500';
        }
        localStorage.setItem('productView', view);
    }
    
    // Restaurar vista guardada
    const savedView = localStorage.getItem('productView');
    if (savedView) {
        setProductView(savedView);
    }
    
    // Funciones de interacción mejoradas para productos
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Animación de wishlist
            const heart = this.querySelector('svg');
            heart.style.fill = heart.style.fill === 'currentColor' ? 'none' : 'currentColor';
            heart.style.color = heart.style.fill === 'currentColor' ? '#ef4444' : '#6b7280';
            
            // Feedback visual
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });
    
    document.querySelectorAll('.quick-view-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Aquí podrías implementar una modal de vista rápida
            console.log('Vista rápida del producto');
        });
    });
});
</script>

<?php get_footer(); ?>