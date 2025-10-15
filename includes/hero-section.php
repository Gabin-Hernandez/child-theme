<?php
/**
 * Hero Section Component
 * Sección hero reutilizable para páginas de productos
 * 
 * @param array $args Argumentos para personalizar el hero
 *   - title: string - Título principal (requerido)
 *   - subtitle: string - Subtítulo con gradiente (requerido)  
 *   - description: string - Descripción (requerido)
 *   - search_placeholder: string - Placeholder del input de búsqueda
 *   - show_category_selector: bool - Mostrar selector de categorías (default: true)
 *   - background_gradient: string - Clases CSS para el gradiente de fondo
 */

// Valores por defecto
$defaults = array(
    'title' => 'Productos para',
    'subtitle' => 'Reparación Profesional',
    'description' => 'Herramientas especializadas para técnicos profesionales',
    'search_placeholder' => 'Buscar productos por modelo, marca o características...',
    'show_category_selector' => true,
    'background_gradient' => 'from-blue-50 via-indigo-50 to-white',
    'border_color' => 'border-blue-100',
    'gradient_colors' => 'from-blue-600 to-indigo-600'
);

// Combinar argumentos con valores por defecto
$args = wp_parse_args($args ?? array(), $defaults);
?>

<div class="relative bg-gradient-to-br <?php echo esc_attr($args['background_gradient']); ?> border-b <?php echo esc_attr($args['border_color']); ?>">
    <!-- Patrón sutil -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%2393c5fd" fill-opacity="0.1"%3E%3Ccircle cx="20" cy="20" r="1"/%3E%3C/g%3E%3C/svg%3E')] opacity-60"></div>
    
    <!-- Contenido -->
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            
            <!-- Título principal -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                <?php echo esc_html($args['title']); ?>
                <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r <?php echo esc_attr($args['gradient_colors']); ?>">
                    <?php echo esc_html($args['subtitle']); ?>
                </span>
            </h1>
            
            <!-- Descripción -->
            <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                <?php echo esc_html($args['description']); ?>
            </p>
            
            <!-- Barra de búsqueda -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden backdrop-blur-sm">
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex flex-col sm:flex-row">
                        <input type="hidden" name="post_type" value="product">
                        
                        <!-- Input de búsqueda -->
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-4 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   id="hero-search"
                                   name="s" 
                                   value="<?php echo get_search_query(); ?>"
                                   placeholder="<?php echo esc_attr($args['search_placeholder']); ?>"
                                   class="w-full h-full pl-12 pr-4 py-4 text-base border-0 focus:outline-none focus:ring-0 text-gray-900 placeholder-gray-400 bg-white">
                        </div>
                        
                        <?php if ($args['show_category_selector']) : ?>
                        <!-- Separador -->
                        <div class="hidden sm:block w-px bg-gray-200"></div>
                        
                        <!-- Selector de categoría -->
                        <div class="relative sm:min-w-[200px]">
                            <select name="product_cat" class="w-full px-4 py-4 text-base border-0 focus:outline-none focus:ring-0 text-gray-700 bg-white appearance-none cursor-pointer">
                                <option value="">Todas las categorías</option>
                                <?php
                                $categories = get_terms( array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                ) );
                                if (!empty($categories) && !is_wp_error($categories)) {
                                    foreach ( $categories as $category ) {
                                        echo '<option value="' . esc_attr( $category->slug ) . '" ' . selected( get_query_var( 'product_cat' ), $category->slug, false ) . '>' . esc_html( $category->name ) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Botón de búsqueda -->
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 font-semibold text-base transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Buscar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>