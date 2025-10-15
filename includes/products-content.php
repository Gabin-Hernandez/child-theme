<?php
/**
 * Products Content Component
 * Sección de contenido de productos con filtros y múltiples vistas
 * 
 * @param array $args Argumentos para personalizar la sección de productos
 *   - products_query: WP_Query - Query de productos (requerido)
 *   - show_filters: bool - Mostrar filtros laterales (default: true)
 *   - show_view_toggle: bool - Mostrar botón cambio de vista (default: true)
 *   - show_table_filters: bool - Mostrar filtros para vista tabla (default: true)
 *   - search_term: string - Término de búsqueda específico para filtros
 *   - no_products_title: string - Título cuando no hay productos
 *   - no_products_description: string - Descripción cuando no hay productos
 *   - suggested_searches: array - Array de términos sugeridos de búsqueda
 *   - container_classes: string - Clases CSS adicionales para el contenedor
 */

// Valores por defecto
$defaults = array(
    'products_query' => null,
    'show_filters' => true,
    'show_view_toggle' => true,
    'show_table_filters' => true,
    'search_term' => '',
    'no_products_title' => 'No encontramos productos',
    'no_products_description' => 'Lo sentimos, no hay productos que coincidan con tus criterios de búsqueda. Prueba ajustando los filtros o explorando nuestras categorías.',
    'suggested_searches' => array('Herramientas', 'Productos populares', 'Ofertas', 'Nuevos productos'),
    'container_classes' => 'bg-gray-50 min-h-screen py-8'
);

// Combinar argumentos con valores por defecto
$args = wp_parse_args($args ?? array(), $defaults);

// Verificar que tenemos una query de productos
if (!$args['products_query'] || !($args['products_query'] instanceof WP_Query)) {
    echo '<!-- Error: No se proporcionó una query válida de productos -->';
    return;
}

$products_query = $args['products_query'];
?>

<div class="<?php echo esc_attr($args['container_classes']); ?>">
    <div class="w-11/12 2xl:w-10/12 2xl:max-w-[1920px] mx-auto px-4 xl:px-6 2xl:px-8">
        
        <?php if ($args['show_filters']) : ?>
        <!-- Botón para filtros en móvil -->
        <div class="lg:hidden mb-6">
            <button id="toggle-filters" class="flex items-center justify-center gap-2 w-full py-3 px-4 bg-gray-100 hover:bg-gray-200 rounded-lg border border-gray-200 text-gray-700 font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                </svg>
                Filtros
            </button>
        </div>
        <?php endif; ?>

        <?php if ( woocommerce_product_loop() && $products_query->have_posts() ) : ?>

            <div class="flex flex-col lg:flex-row gap-6">
                
                <?php if ($args['show_filters']) : ?>
                <!-- Sidebar de filtros -->
                <?php include(get_template_directory() . '/includes/product-filters.php'); ?>
                <?php endif; ?>

                <!-- Contenido principal -->
                <main class="flex-1 lg:min-w-0">
                    
                    <?php if ($args['show_view_toggle']) : ?>
                    <!-- Header con controles de vista -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <div class="flex items-center gap-4">
                            <h2 class="text-xl font-bold text-gray-900">
                                <?php echo $products_query->found_posts; ?> productos encontrados
                            </h2>
                        </div>
                        
                        <!-- Controles de vista y ordenamiento -->
                        <div class="flex items-center gap-3">
                            <!-- Selector de ordenamiento -->
                            <select id="sort-products" class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option value="">Ordenar por</option>
                                <option value="price-asc" <?php selected(isset($_GET['orderby']) && $_GET['orderby'] === 'price-asc'); ?>>Precio: Menor a Mayor</option>
                                <option value="price-desc" <?php selected(isset($_GET['orderby']) && $_GET['orderby'] === 'price-desc'); ?>>Precio: Mayor a Menor</option>
                                <option value="name-asc" <?php selected(isset($_GET['orderby']) && $_GET['orderby'] === 'name-asc'); ?>>Nombre: A-Z</option>
                                <option value="name-desc" <?php selected(isset($_GET['orderby']) && $_GET['orderby'] === 'name-desc'); ?>>Nombre: Z-A</option>
                                <option value="date-desc" <?php selected(isset($_GET['orderby']) && $_GET['orderby'] === 'date-desc'); ?>>Más Reciente</option>
                            </select>
                            
                            <!-- Botones cambio de vista -->
                            <div class="flex border border-gray-300 rounded-lg overflow-hidden bg-white">
                                <button id="grid-view" class="px-3 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors border-r border-gray-300 view-toggle active" data-view="grid">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                </button>
                                <button id="table-view" class="px-3 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors view-toggle" data-view="table">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($args['show_table_filters']) : ?>
                    <!-- Filtros para vista de tabla -->
                    <?php include(get_template_directory() . '/includes/table-filters.php'); ?>
                    <?php endif; ?>

                    <!-- Grid de productos -->
                    <?php include(get_template_directory() . '/includes/products-grid.php'); ?>

                    <!-- Vista de tabla -->
                    <?php include(get_template_directory() . '/includes/products-table.php'); ?>

                    <!-- Paginación -->
                    <div class="mt-12">
                        <?php
                        // Usar función de paginación personalizada si existe
                        if (function_exists('itools_custom_pagination')) {
                            itools_custom_pagination();
                        } else {
                            // Paginación estándar de WooCommerce
                            woocommerce_pagination();
                        }
                        ?>
                    </div>

                </main>
            </div>

        <?php else : ?>

            <!-- Estado vacío -->
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <!-- Ilustración SVG -->
                    <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-gray-900 mb-4"><?php echo esc_html($args['no_products_title']); ?></h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        <?php echo esc_html($args['no_products_description']); ?>
                    </p>
                    
                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button id="clear-all-filters" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-2xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Limpiar Filtros
                        </button>
                        <a href="<?php echo home_url(); ?>" class="bg-white border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-2xl hover:border-blue-500 hover:text-blue-600 transition-all duration-300 font-semibold">
                            Volver al Inicio
                        </a>
                    </div>
                    
                    <!-- Sugerencias -->
                    <div class="mt-12 p-6 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl border border-yellow-200">
                        <h3 class="font-bold text-gray-900 mb-4">Sugerencias de búsqueda:</h3>
                        <div class="flex flex-wrap gap-2 justify-center">
                            <?php foreach ($args['suggested_searches'] as $suggestion) : ?>
                                <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">
                                    <?php echo esc_html($suggestion); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            /**
             * Hook: woocommerce_no_products_found.
             */
            do_action( 'woocommerce_no_products_found' );
            ?>

        <?php endif; ?>
    </div>
</div>