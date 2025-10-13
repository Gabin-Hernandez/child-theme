<?php
/**
 * Archivo de productos (tienda) - ITOOLS
 */

get_header();

// Solo crear consulta personalizada si hay filtros avanzados activos
// NO crear consulta personalizada para product_cat o s ya que WooCommerce los maneja mejor
$has_advanced_filters = !empty($_GET['product_categories']) || 
                       !empty($_GET['min_price']) || !empty($_GET['max_price']) || !empty($_GET['orderby']);

if ($has_advanced_filters) {
    // Procesar filtros de URL
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12,
        'post_status' => 'publish',
        'tax_query' => array(),
        'meta_query' => array()
    );

    // Filtro por categorías
    if (!empty($_GET['product_categories'])) {
    $selected_categories = $_GET['product_categories'];
    if (is_array($selected_categories)) {
        $category_terms = array();
        foreach ($selected_categories as $cat) {
            if (is_numeric($cat)) {
                $category_terms[] = intval($cat);
            } else {
                $term = get_term_by('slug', sanitize_text_field($cat), 'product_cat');
                if ($term) {
                    $category_terms[] = $term->term_id;
                }
            }
        }
        if (!empty($category_terms)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $category_terms,
                'operator' => 'IN'
            );
        }
    } else {
        // Si es una cadena separada por comas
        $categories = explode(',', sanitize_text_field($selected_categories));
        $category_terms = array();
        foreach ($categories as $cat) {
            $cat = trim($cat);
            if (is_numeric($cat)) {
                $category_terms[] = intval($cat);
            } else {
                $term = get_term_by('slug', $cat, 'product_cat');
                if ($term) {
                    $category_terms[] = $term->term_id;
                }
            }
        }
        if (!empty($category_terms)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $category_terms,
                'operator' => 'IN'
            );
        }
    }
}

// product_cat se maneja mejor por WooCommerce en la consulta principal
// product_brands ha sido removido del filtro

// Filtro por precio
if (!empty($_GET['min_price']) || !empty($_GET['max_price'])) {
    $price_query = array('relation' => 'AND');
    
    if (!empty($_GET['min_price'])) {
        $min_price = floatval($_GET['min_price']);
        $price_query[] = array(
            'key' => '_price',
            'value' => $min_price,
            'compare' => '>=',
            'type' => 'NUMERIC'
        );
    }
    
    if (!empty($_GET['max_price'])) {
        $max_price = floatval($_GET['max_price']);
        $price_query[] = array(
            'key' => '_price',
            'value' => $max_price,
            'compare' => '<=',
            'type' => 'NUMERIC'
        );
    }
    
    $args['meta_query'][] = $price_query;
}

// Ordenamiento
if (!empty($_GET['orderby'])) {
    $orderby = sanitize_text_field($_GET['orderby']);
    switch ($orderby) {
        case 'popularity':
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'rating':
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'date':
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
        case 'price':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            break;
        case 'price-desc':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
    }
}

// Parámetro 's' se maneja mejor por WooCommerce en la consulta principal

// Configurar relación de tax_query si hay múltiples filtros de taxonomía
if (!empty($args['tax_query']) && count($args['tax_query']) > 1) {
    $args['tax_query']['relation'] = 'AND';
}

// Limpiar arrays vacíos
if (empty($args['tax_query'])) {
    unset($args['tax_query']);
}
if (empty($args['meta_query'])) {
    unset($args['meta_query']);
}

// Paginación
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged'] = $paged;

// Crear la consulta personalizada
$products_query = new WP_Query($args);

// Debug: Mostrar información de la consulta si estamos en modo debug
if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('Custom Query Args: ' . print_r($args, true));
    error_log('Found Posts: ' . $products_query->found_posts);
    error_log('URL Parameters: ' . print_r($_GET, true));
}

} else {
    // Usar la consulta principal de WordPress cuando no hay filtros avanzados
    // Esto incluye búsquedas (s) y filtros de categoría (product_cat) que WooCommerce maneja mejor
    global $wp_query;
    $products_query = $wp_query;
    
    // Asegurar que la consulta principal esté configurada correctamente para WooCommerce
    if (!$products_query->is_main_query()) {
        // Si por alguna razón no es la consulta principal, crear una nueva
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12,
            'post_status' => 'publish'
        );
        
        // Agregar parámetros de búsqueda si existen
        if (!empty($_GET['s'])) {
            $args['s'] = sanitize_text_field($_GET['s']);
        }
        
        // Agregar filtro de categoría si existe
        if (!empty($_GET['product_cat'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => sanitize_text_field($_GET['product_cat'])
                )
            );
        }
        
        $products_query = new WP_Query($args);
    }
    
    // Debug: Mostrar información de la consulta principal
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('Using main query - Found Posts: ' . $products_query->found_posts);
        error_log('Main Query Vars: ' . print_r($products_query->query_vars, true));
        error_log('Is Main Query: ' . ($products_query->is_main_query() ? 'Yes' : 'No'));
        error_log('URL Parameters: ' . print_r($_GET, true));
    }
}

?>

<!-- Hero Section Moderno -->
<div class="bg-gradient-to-br from-blue-600 to-indigo-700 py-16">
    <div class="max-w-7xl mx-auto px-4 xl:px-6 2xl:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Tienda de Herramientas
            </h1>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Encuentra las mejores herramientas profesionales para tus proyectos
            </p>
            
            <!-- Formulario de búsqueda funcional -->
            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="max-w-2xl mx-auto">
                <div class="flex gap-3">
                    <input type="hidden" name="post_type" value="product">
                    <div class="flex-1 relative">
                        <input type="text" 
                               name="s" 
                               value="<?php echo get_search_query(); ?>"
                               placeholder="Buscar herramientas..."
                               class="w-full px-6 py-4 text-lg rounded-xl border-0 focus:ring-4 focus:ring-blue-300 shadow-lg">
                    </div>
                    <select name="product_cat" class="px-4 py-4 rounded-xl border-0 focus:ring-4 focus:ring-blue-300 shadow-lg bg-white">
                        <option value="">Todas las categorías</option>
                        <?php
                        $categories = get_terms( array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                        ) );
                        foreach ( $categories as $category ) {
                            echo '<option value="' . esc_attr( $category->slug ) . '" ' . selected( get_query_var( 'product_cat' ), $category->slug, false ) . '>' . esc_html( $category->name ) . '</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-4 rounded-xl font-semibold transition-colors shadow-lg">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="bg-gray-50 min-h-screen py-12">
    <div class="w-11/12 mx-auto px-4 xl:px-6 2xl:px-8">

        <!-- Botón para mostrar filtros en móvil -->
        <div class="xl:hidden mb-6">
            <button id="toggle-filters" class="flex items-center gap-3 bg-white px-6 py-4 rounded-2xl shadow-lg border border-gray-200 font-semibold text-gray-900 hover:shadow-xl transition-all duration-300 w-full justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                </svg>
                Filtros y Ordenar
                <div class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></div>
            </button>
        </div>

        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="flex flex-col xl:flex-row gap-8">
                
                <!-- Sidebar con filtros modernos -->
                <aside 
                    id="filters-sidebar" 
                    class="xl:w-96 2xl:w-[320px] fixed xl:relative inset-0 xl:inset-auto bg-black/50 xl:bg-transparent z-50 xl:z-auto hidden xl:block backdrop-blur-sm xl:backdrop-blur-none">
                    <div class="bg-white h-full xl:h-auto p-4 lg:p-6 rounded-none xl:rounded-3xl shadow-2xl xl:shadow-lg overflow-y-auto ml-auto xl:ml-0 w-80 xl:w-full border-0 xl:border border-gray-100 sticky xl:top-4">
                        
                        <!-- Header del sidebar -->
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                                <div class="w-2 h-8 bg-gradient-to-b from-blue-500 to-purple-500 rounded-full"></div>
                                Filtros
                            </h3>
                            <button id="close-filters" class="xl:hidden text-gray-500 hover:text-gray-700 p-2 hover:bg-gray-100 rounded-full transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Filtro por Precio -->
                        <div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl border border-blue-100">
                            <h4 class="font-bold text-gray-900 mb-6 flex items-center text-lg">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                Rango de Precio
                            </h4>
                            
                            <div class="space-y-4">
                                <p class="text-sm text-gray-600 mb-3">Filtrar por precio:</p>
                                
                                <?php
                                // Get dynamic price range
                                $price_range = itools_get_dynamic_price_range();
                                $current_min = isset($_GET['min_price']) ? $_GET['min_price'] : $price_range['min'];
                                $current_max = isset($_GET['max_price']) ? $_GET['max_price'] : $price_range['max'];
                                ?>
                                
                                <!-- Inputs manuales para precio -->
                                <div class="grid grid-cols-2 gap-3 mb-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Precio mínimo</label>
                                        <div class="relative">
                                            <span class="absolute left-0.5 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">$</span>
                                            <input type="number" 
                                                   id="sidebar-min-price" 
                                                   class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                                   placeholder="0"
                                                   min="0"
                                                   max="<?php echo $price_range['max']; ?>"
                                                   value="<?php echo $current_min > 0 ? $current_min : ''; ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Precio máximo</label>
                                        <div class="relative">
                                            <span class="absolute left-0.5 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">$</span>
                                            <input type="number" 
                                                   id="sidebar-max-price" 
                                                   class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                                   placeholder="<?php echo number_format($price_range['max'], 0); ?>"
                                                   min="0"
                                                   max="<?php echo $price_range['max']; ?>"
                                                   value="<?php echo $current_max < $price_range['max'] ? $current_max : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Price Range Slider -->
                                <div class="price-slider-container">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-xs text-gray-500">$<span id="min-price-display"><?php echo number_format($current_min, 0); ?></span></span>
                                        <span class="text-xs text-gray-500">$<span id="max-price-display"><?php echo number_format($current_max, 0); ?></span></span>
                                    </div>
                                    
                                    <div class="relative">
                                        <div class="price-slider-track bg-gray-200 h-2 rounded-full relative">
                                            <div id="price-slider-range" class="absolute h-2 bg-gradient-to-r from-green-400 to-green-600 rounded-full"></div>
                                        </div>
                                        
                                        <input type="range" 
                                               id="min-price-slider" 
                                               class="price-slider-input absolute top-0 w-full h-2 bg-transparent appearance-none cursor-pointer"
                                               min="<?php echo $price_range['min']; ?>" 
                                               max="<?php echo $price_range['max']; ?>" 
                                               value="<?php echo $current_min; ?>"
                                               step="100">
                                        
                                        <input type="range" 
                                               id="max-price-slider" 
                                               class="price-slider-input absolute top-0 w-full h-2 bg-transparent appearance-none cursor-pointer"
                                               min="<?php echo $price_range['min']; ?>" 
                                               max="<?php echo $price_range['max']; ?>" 
                                               value="<?php echo $current_max; ?>"
                                               step="100">
                                    </div>
                                </div>
                                
                                <!-- Rangos predefinidos -->
                                <div class="flex flex-wrap gap-2 mt-3">
                                    <button type="button" class="price-preset text-xs px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors" data-min="0" data-max="1000">Hasta $1K</button>
                                    <button type="button" class="price-preset text-xs px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors" data-min="1000" data-max="5000">$1K - $5K</button>
                                    <button type="button" class="price-preset text-xs px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors" data-min="5000" data-max="10000">$5K - $10K</button>
                                    <button type="button" class="price-preset text-xs px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors" data-min="10000" data-max="">$10K+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro por Categorías -->
                        <div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100">
                            <h4 class="font-bold text-gray-900 mb-6 flex items-center text-lg">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                Categorías
                            </h4>
                            
                            <div class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                                <!-- Enlace para todas las categorías -->
                                <?php 
                                $all_categories_url = home_url('/?post_type=product&s=');
                                $is_all_categories = empty($_GET['product_cat']);
                                ?>
                                <a href="<?php echo esc_url($all_categories_url); ?>" class="group flex items-center space-x-4 hover:bg-white/80 p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-blue-200 <?php echo $is_all_categories ? 'bg-blue-50 border-blue-300' : ''; ?>">
                                    <div class="relative">
                                        <div class="w-5 h-5 bg-gradient-to-br from-gray-400 to-gray-600 rounded-lg flex items-center justify-center">
                                            <?php if ($is_all_categories) : ?>
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <span class="text-gray-700 font-medium group-hover:text-blue-700 transition-colors <?php echo $is_all_categories ? 'text-blue-700 font-semibold' : ''; ?>">
                                            Todas las categorías
                                        </span>
                                        <div class="text-sm text-gray-500">Ver todos los productos</div>
                                    </div>
                                </a>
                                
                                <?php
                                $product_categories = get_terms( array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => 0,
                                ) );

                                if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) :
                                    foreach ( $product_categories as $category ) :
                                        // Create correct URL format: ?post_type=product&s=&product_cat=slug
                                        $category_url = home_url('/?post_type=product&s=&product_cat=' . $category->slug);
                                        $is_current = (isset($_GET['product_cat']) && $_GET['product_cat'] === $category->slug);
                                ?>
                                    <a href="<?php echo esc_url($category_url); ?>" class="group flex items-center space-x-4 hover:bg-white/80 p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-blue-200 <?php echo $is_current ? 'bg-blue-50 border-blue-300' : ''; ?>">
                                        <div class="relative">
                                            <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                                                <?php if ($is_current) : ?>
                                                    <div class="absolute inset-0 bg-white rounded-lg flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </div>
                                                <?php else: ?>
                                                    <?php
                                                    // Iconos específicos por categoría
                                                    $category_icons = [
                                                        'consolas' => '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M21.5 2h-19C1.12 2 0 3.12 0 4.5v15C0 20.88 1.12 22 2.5 22h19c1.38 0 2.5-1.12 2.5-2.5v-15C24 3.12 22.88 2 21.5 2zM8 17.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5V15c0-.83-.67-1.5-1.5-1.5S4 14.17 4 15v2.5c0 .28-.22.5-.5.5S3 17.78 3 17.5V15c0-1.38 1.12-2.5 2.5-2.5S8 13.62 8 15v2.5zm9.5-2.5c0 1.38-1.12 2.5-2.5 2.5S12.5 16.38 12.5 15v-2.5c0-.28.22-.5.5-.5s.5.22.5.5V15c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-2.5c0-.28.22-.5.5-.5s.5.22.5.5V15z"/></svg>',
                                                        'baterias' => '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M15.67 4H14V2c0-1.1-.9-2-2-2s-2 .9-2 2v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4zM15 20H9V6h2v1h2V6h2v14z"/></svg>',
                                                        'herramientas' => '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/></svg>',
                                                        'lcd-y-touch' => '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M21 3H3c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h6l-2 2v1h8v-1l-2-2h6c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 13H3V5h18v11z"/></svg>',
                                                        'pantallas' => '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M21 3H3c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h6l-2 2v1h8v-1l-2-2h6c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 13H3V5h18v11z"/></svg>',
                                                        'accesorios' => '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>',
                                                        'cargadores' => '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M14.47 15.08L11 13V7h1.5v5.25l2.72 1.68-.75 1.15zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>',
                                                        'refacciones' => '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>'
                                                    ];
                                                    
                                                    echo isset($category_icons[$category->slug]) ? $category_icons[$category->slug] : '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>';
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-purple-600 rounded-lg opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-gray-700 font-medium group-hover:text-blue-700 transition-colors <?php echo $is_current ? 'text-blue-700 font-semibold' : ''; ?>">
                                                <?php echo esc_html( $category->name ); ?>
                                            </span>
                                            <div class="text-sm text-gray-500"><?php echo $category->count; ?> productos</div>
                                        </div>
                                    </a>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>


                        <!-- Botones de acción -->
                        <div class="space-y-4">
                            <button id="apply-sidebar-filters" 
                                    class="apply-filters w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-2xl font-bold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Aplicar Filtros
                            </button>
                            <button id="clear-filters" 
                                    class="clear-filters w-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-4 rounded-2xl font-bold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 border border-gray-300 hover:border-gray-400 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Limpiar Todo
                            </button>
                        </div>
                        
                        <!-- Estado de carga para sidebar -->
                        <div class="filters-loading hidden mt-6 text-center">
                            <div class="inline-flex items-center px-4 py-3 bg-blue-50 text-blue-700 rounded-xl border border-blue-200">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Aplicando filtros...
                            </div>
                        </div>

                        <!-- Widget sidebar adicional -->
                        <div class="mt-8">
                            <?php
                            if ( is_active_sidebar( 'sidebar-shop' ) ) {
                                dynamic_sidebar( 'sidebar-shop' );
                            }
                            ?>
                        </div>
                    </div>
                </aside>

                <?php if ( $products_query->have_posts() ) : ?>

                <!-- Contenido principal -->
                <main class="flex-1 w-full xl:w-auto">
                    
                    <!-- Barra superior limpia con información básica -->
                    <div class="bg-white p-4 lg:p-6 rounded-2xl shadow-sm mb-6 border border-gray-100">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            
                            <!-- Información de resultados -->
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-6 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                                <div>
                                    <?php
                                    $total_products = $products_query->found_posts;
                                    if ( $total_products ) :
                                        $current_page = max( 1, get_query_var( 'paged' ) );
                                        $per_page = $products_query->query_vars['posts_per_page'];
                                        $first = ( $current_page - 1 ) * $per_page + 1;
                                        $last = min( $total_products, $current_page * $per_page );
                                    ?>
                                        <h3 class="text-lg lg:text-xl font-bold text-gray-900">
                                            <?php echo $total_products; ?> Productos
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
                                    <button id="grid-view" class="px-3 py-2 rounded-lg transition-all duration-300 bg-white shadow-sm" title="Vista en tarjetas">
                                        <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                        </svg>
                                    </button>
                                    <button id="table-view" class="px-3 py-2 rounded-lg transition-all duration-300 text-gray-500" title="Vista de tabla técnica">
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

                    <!-- Filtros para vista de tabla -->
                    <div id="table-filters" class="hidden mb-6 bg-white rounded-lg border border-gray-200 p-4">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <!-- Búsqueda -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar producto</label>
                                <input type="text" id="table-search" placeholder="Buscar por nombre..." 
                                       class="product-search-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Filtro por disponibilidad -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Disponibilidad</label>
                                <select id="stock-filter" class="availability-filter w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todos</option>
                                    <option value="in-stock">En stock</option>
                                    <option value="out-of-stock">Agotado</option>
                                </select>
                            </div>
                            
                            <!-- Botones de acción -->
                            <div class="flex items-end">
                                <button id="apply-filters-btn" class="apply-filters w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors font-medium">
                                    Aplicar Filtros
                                </button>
                            </div>
                            
                            <!-- Botón limpiar -->
                            <div class="flex items-end">
                                <button id="clear-table-filters" class="clear-filters w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">
                                    Limpiar
                                </button>
                            </div>
                        </div>
                        
                        <!-- Estado de carga -->
                        <div class="filters-loading hidden mt-4 text-center">
                            <div class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Filtrando productos...
                            </div>
                        </div>
                    </div>

                    <!-- Grid de productos moderno -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-5 gap-x-6 gap-y-10" id="products-grid">
                        <?php
                        woocommerce_product_loop_start();

                        if ( wc_get_loop_prop( 'is_shortcode' ) ) {
                            $columns = absint( wc_get_loop_prop( 'columns' ) );
                        } else {
                            $columns = wc_get_default_products_per_row();
                        }

                        while ( $products_query->have_posts() ) {
                            $products_query->the_post();
                            do_action( 'woocommerce_shop_loop' );
                            
                            // Template personalizado de producto
                            ?>
                            <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300 h-full flex flex-col min-h-[380px]">
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
                                                    <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" 
                                                       data-quantity="1" 
                                                       data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
                                                       data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" 
                                                       class="add_to_cart_button ajax_add_to_cart product_type_simple w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200 shadow-sm hover:shadow-md inline-block text-center"
                                                       rel="nofollow">
                                                        Agregar al carrito
                                                    </a>
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

                        woocommerce_product_loop_end();
                        ?>
                    </div>

                    <!-- Vista de tabla compacta -->
                    <div id="products-table" class="hidden">
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 border-b border-gray-200">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                                        <?php
                                        // Reset query for table view
                                        $products_query->rewind_posts();
                                        while ( $products_query->have_posts() ) {
                                            $products_query->the_post();
                                            $product = wc_get_product( get_the_ID() );
                                            $product_name = get_the_title();
                                            $product_price = $product ? $product->get_price() : 0;
                                            $product_stock_status = $product && $product->is_in_stock() ? 'in-stock' : 'out-of-stock';
                                            ?>
                                            <tr class="hover:bg-gray-50 transition-colors product-row" 
                                                data-name="<?php echo esc_attr( strtolower( $product_name ) ); ?>"
                                                data-price="<?php echo esc_attr( $product_price ); ?>"
                                                data-stock="<?php echo esc_attr( $product_stock_status ); ?>">
                                                
                                                <!-- Producto -->
                                                <td class="px-4 py-4 product-name">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-12 w-12">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php if ( has_post_thumbnail() ) : ?>
                                                                    <?php the_post_thumbnail( 'thumbnail', array(
                                                                        'class' => 'h-12 w-12 rounded-lg object-cover'
                                                                    ) ); ?>
                                                                <?php else : ?>
                                                                    <div class="h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                                        </svg>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </a>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                <a href="<?php the_permalink(); ?>" class="hover:text-blue-600">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </div>
                                                            <?php if ( $product ) : ?>
                                                                <div class="text-sm text-gray-500">
                                                                    SKU: <?php echo $product->get_sku() ? $product->get_sku() : 'N/A'; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <!-- Precio -->
                                                <td class="px-4 py-4 whitespace-nowrap product-price" data-price="<?php echo esc_attr( $product_price ); ?>">
                                                    <?php if ( $product ) : ?>
                                                        <div class="text-sm font-semibold text-gray-900">
                                                            <?php echo $product->get_price_html(); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <!-- Stock -->
                                                <td class="px-4 py-4 whitespace-nowrap product-stock" data-stock="<?php echo esc_attr( $product_stock_status ); ?>">
                                                    <?php if ( $product ) : ?>
                                                        <?php if ( $product->is_in_stock() ) : ?>
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                En stock
                                                            </span>
                                                        <?php else : ?>
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                Agotado
                                                            </span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <!-- Acción -->
                                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                                    <?php if ( $product ) : ?>
                                                        <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                                                            <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" 
                                                               data-quantity="1" 
                                                               data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
                                                               data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" 
                                                               class="add_to_cart_button ajax_add_to_cart product_type_simple bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs font-medium transition-colors duration-200"
                                                               rel="nofollow">
                                                                Agregar
                                                            </a>
                                                        <?php else : ?>
                                                            <button class="bg-gray-300 text-gray-600 px-3 py-1.5 rounded text-xs font-medium cursor-not-allowed">
                                                                No disponible
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Paginación personalizada al final de los productos -->
                    <div class="mt-12">
                        <?php
                        // Usar nuestra función de paginación personalizada
                        itools_custom_pagination();
                        ?>
                    </div>

                </main>
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
                    
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">No encontramos productos</h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Lo sentimos, no hay productos que coincidan con tus criterios de búsqueda. 
                        <br>Prueba ajustando los filtros o explorando nuestras categorías.
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
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Taladros</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Martillos</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Destornilladores</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Llaves</span>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action( 'woocommerce_no_products_found' );
            ?>

        <?php endif; ?>

        <?php
        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        // do_action( 'woocommerce_after_main_content' );
        ?>

    </div>
</div>

<?php endif; ?>

<!-- Slider debajo del contenedor principal -->
<div class="w-full">
    <?php
    // Mostrar el slider fuera del contenedor principal
    if ( is_active_sidebar( 'sidebar-shop-slider' ) ) {
        dynamic_sidebar( 'sidebar-shop-slider' );
    }
    ?>
</div>

<!-- JavaScript mejorado para los filtros y funcionalidades modernas -->
<style>
/* Solo prevenir overflow horizontal sin afectar otras funciones */
html {
    overflow-x: hidden;
}

body {
    overflow-x: hidden;
    max-width: 100vw;
}

/* El problema principal era el ancho del main en desktop */
@media (min-width: 1280px) {
    main.flex-1 {
        width: auto;
        max-width: none;
    }
}


/* Ocultar el botón "Ver en carrito" que aparece después de agregar un producto */
.added_to_cart {
    display: none !important;
}

/* Estilo personalizado para el selector de ordenamiento */
.woocommerce-ordering select {
    padding: 8px 12px !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 0.75rem !important;
    background-color: white !important;
    font-size: 14px !important;
    color: #374151 !important;
    min-width: 160px !important;
    max-width: 200px !important;
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

/* Ocultar elementos innecesarios del resultado count */
.woocommerce-result-count {
    display: none !important;
}

/* Ajustes de la vista de productos */
#products-grid > li {
    list-style: none;
    float: none !important;
    width: 100% !important;
    margin: 0 !important;
}

#products-grid > li::marker {
    content: none;
}

/* Responsive básico */
@media (max-width: 640px) {
    .woocommerce-ordering select {
        min-width: 140px !important;
        max-width: 100% !important;
        font-size: 13px !important;
        padding: 6px 10px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const toggleFiltersBtn = document.getElementById('toggle-filters');
    const closeFiltersBtn = document.getElementById('close-filters');
    const filtersSidebar = document.getElementById('filters-sidebar');
    const applyFiltersBtn = document.getElementById('apply-filters');
    const clearFiltersBtn = document.getElementById('clear-filters');
    const clearAllFiltersBtn = document.getElementById('clear-all-filters');
    const applyPriceBtn = document.getElementById('apply-price-filter');
    const heroSearch = document.getElementById('hero-search');
    const gridViewBtn = document.getElementById('grid-view');
    const tableViewBtn = document.getElementById('table-view');
    const productsGrid = document.getElementById('products-grid');
    const productsTable = document.getElementById('products-table');
    const tableFilters = document.getElementById('table-filters');
    const baseGridClasses = 'grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-5 gap-x-6 gap-y-10';



    if (productsGrid) {
        const legacyList = productsGrid.querySelector('ul.products');
        if (legacyList) {
            legacyList.style.listStyle = 'none';
            legacyList.style.margin = '0';
            legacyList.style.padding = '0';

            while (legacyList.firstChild) {
                productsGrid.appendChild(legacyList.firstChild);
            }

            legacyList.remove();
        }
    }
    // Funcionalidad del hero search
    if (heroSearch) {
        heroSearch.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch(this.value);
            }
        });
        
        // Búsqueda con el botón
        const searchBtn = heroSearch.nextElementSibling;
        if (searchBtn) {
            searchBtn.addEventListener('click', function() {
                performSearch(heroSearch.value);
            });
        }
    }
    
    function performSearch(query) {
        if (query.trim()) {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('s', query.trim());
            currentUrl.searchParams.set('post_type', 'product');
            window.location.href = currentUrl.toString();
        }
    }
    
    // Toggle vista de productos (grid/table)
    if (gridViewBtn && tableViewBtn) {
        gridViewBtn.addEventListener('click', function() {
            setProductView('grid');
        });
        
        tableViewBtn.addEventListener('click', function() {
            setProductView('table');
        });
    }
    
    function applyGridClasses(view) {
        if (!productsGrid) {
            return;
        }

        // Solo aplicar clases base para grid
        productsGrid.className = baseGridClasses;
    }

    function setProductView(view, persist = true) {
        if (!productsGrid || !productsTable) {
            return;
        }

        // Hide all views first
        productsGrid.classList.add('hidden');
        productsTable.classList.add('hidden');
        if (tableFilters) {
            tableFilters.classList.add('hidden');
        }

        // Show the selected view
        if (view === 'table') {
            productsTable.classList.remove('hidden');
            if (tableFilters) {
                tableFilters.classList.remove('hidden');
            }
        } else {
            productsGrid.classList.remove('hidden');
            applyGridClasses(view);
        }

        // Update button states
        if (gridViewBtn) {
            gridViewBtn.className = view === 'grid'
                ? 'px-3 py-2 rounded-lg transition-all duration-300 bg-white shadow-sm text-blue-600'
                : 'px-3 py-2 rounded-lg transition-all duration-300 text-gray-500';
        }

        if (tableViewBtn) {
            tableViewBtn.className = view === 'table'
                ? 'px-3 py-2 rounded-lg transition-all duration-300 bg-white shadow-sm text-blue-600'
                : 'px-3 py-2 rounded-lg transition-all duration-300 text-gray-500';
        }

        if (persist) {
            localStorage.setItem('productView', view);
        }
    }

    // Restaurar vista guardada
    const savedView = localStorage.getItem('productView');
    if (savedView === 'grid' || savedView === 'table') {
        setProductView(savedView, false);
    } else {
        setProductView('grid', false);
    }
    
    // Mostrar/ocultar filtros en móvil con animaciones
    if (toggleFiltersBtn) {
        toggleFiltersBtn.addEventListener('click', function() {
            filtersSidebar.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Animación de entrada
            setTimeout(() => {
                filtersSidebar.style.opacity = '1';
                filtersSidebar.querySelector('div').style.transform = 'translateX(0)';
            }, 10);
        });
    }
    
    function closeMobileFilters() {
        if (!filtersSidebar) {
            return;
        }

        filtersSidebar.style.opacity = '0';
        const sidebarContent = filtersSidebar.querySelector('div');
        if (sidebarContent) {
            sidebarContent.style.transform = 'translateX(100%)';
        }

        setTimeout(() => {
            filtersSidebar.classList.add('hidden');
            document.body.style.overflow = 'auto';
            if (sidebarContent) {
                sidebarContent.style.transform = '';
            }
        }, 300);
    }

    
    // Aplicar filtros con animación de carga
    if (applyFiltersBtn) {
        applyFiltersBtn.addEventListener('click', function() {
            this.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Aplicando...';
            this.disabled = true;
            
            setTimeout(() => {
                applyFilters();
            }, 500);
        });
    }
    
    // Aplicar filtro de precio - básico
    if (applyPriceBtn) {
        applyPriceBtn.addEventListener('click', function() {
            const minPrice = document.getElementById('min_price').value;
            const maxPrice = document.getElementById('max_price').value;
            const currentUrl = new URL(window.location);
            
            console.log('Valores capturados:', { minPrice, maxPrice });
            
            if (minPrice) {
                currentUrl.searchParams.set('min_price', minPrice);
            } else {
                currentUrl.searchParams.delete('min_price');
            }
            
            if (maxPrice) {
                currentUrl.searchParams.set('max_price', maxPrice);
            } else {
                currentUrl.searchParams.delete('max_price');
            }
            
            console.log('URL final:', currentUrl.toString());
            window.location.href = currentUrl.toString();
        });
    }
    
    // Limpiar filtros
    if (clearFiltersBtn || clearAllFiltersBtn) {
        [clearFiltersBtn, clearAllFiltersBtn].forEach(btn => {
            if (btn) {
                btn.addEventListener('click', function() {
                    clearAllFilters();
                });
            }
        });
    }
    
    // Función para aplicar filtros
    function applyFilters() {
        // Crear URL base para búsqueda de productos
        const baseUrl = new URL(window.location.origin);
        const searchParams = new URLSearchParams();
        
        // Asegurar que siempre incluya post_type=product para búsquedas de productos
        searchParams.set('post_type', 'product');
        searchParams.set('s', '');
        
        // Mantener parámetros básicos
        const currentUrl = new URL(window.location);
        if (currentUrl.searchParams.get('s')) {
            searchParams.set('s', currentUrl.searchParams.get('s'));
        }
        
        // Filtro de precio
        const minPrice = document.getElementById('min_price');
        const maxPrice = document.getElementById('max_price');
        if (minPrice && minPrice.value) {
            searchParams.set('min_price', minPrice.value);
        }
        if (maxPrice && maxPrice.value) {
            searchParams.set('max_price', maxPrice.value);
        }
        
        // Las categorías ahora usan enlaces directos, no checkboxes
        // Las marcas han sido removidas del filtro
        
        // Asegurar que siempre incluya post_type=product para búsquedas de productos
        searchParams.set('post_type', 'product');
        searchParams.set('s', '');
        
        // Redirigir con los nuevos parámetros
        baseUrl.search = searchParams.toString();
        window.location.href = baseUrl.toString();
    }
    
    // Función para limpiar filtros con animación
    function clearAllFilters() {
        // Las categorías son enlaces directos, las marcas han sido removidas
        // Solo limpiar campos de precio
        
        // Limpiar campos de precio con animación
        const minPrice = document.getElementById('min_price');
        const maxPrice = document.getElementById('max_price');
        [minPrice, maxPrice].forEach(input => {
            if (input && input.value) {
                input.style.backgroundColor = '#fee2e2';
                setTimeout(() => {
                    input.value = '';
                    input.style.backgroundColor = '';
                }, 200);
            }
        });
        
        // Redirigir después de la animación - ir a la tienda sin filtros
        setTimeout(() => {
            const baseUrl = window.location.origin + '/?post_type=product&s=';
            window.location.href = baseUrl;
        }, 400);
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
    
    // Cargar valores de filtros desde URL
    function loadFiltersFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Cargar precio
        const minPrice = urlParams.get('min_price');
        const maxPrice = urlParams.get('max_price');
        if (minPrice && document.getElementById('min_price')) {
            document.getElementById('min_price').value = minPrice;
        }
        if (maxPrice && document.getElementById('max_price')) {
            document.getElementById('max_price').value = maxPrice;
        }
        
        // Las categorías ahora se manejan automáticamente con enlaces directos y estado visual
        // Las marcas han sido removidas del filtro
    }
    
    // Cargar filtros al cargar la página
    loadFiltersFromUrl();
    
    // ⚠️ Los filtros de tabla ahora se manejan en js/table-filters.js
    // El archivo table-filters.js maneja:
    // - Búsqueda por nombre (#table-search)
    // - Filtro por disponibilidad (#stock-filter)
    // - Botones de aplicar y limpiar filtros
    // - Paginación personalizada para resultados filtrados
    
    // Responsive: cerrar filtros al cambiar a desktop y optimizar grid
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1280) {
            if (filtersSidebar) {
                filtersSidebar.classList.remove('hidden');
                filtersSidebar.style.opacity = '';
                const sidebarContent = filtersSidebar.querySelector('div');
                if (sidebarContent) {
                    sidebarContent.style.transform = '';
                }
            }
            document.body.style.overflow = 'auto';
        } else {
            if (filtersSidebar && !filtersSidebar.classList.contains('hidden')) {
                closeMobileFilters();
            }
        }

        const currentView = localStorage.getItem('productView') || 'grid';
        applyGridClasses(currentView);
    });
    
    // Lazy loading para imágenes (si es necesario)
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove('loading-shimmer');
                        observer.unobserve(img);
                    }
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Animaciones de scroll para elementos
    if ('IntersectionObserver' in window) {
        const animateOnScroll = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        document.querySelectorAll('.product-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            animateOnScroll.observe(card);
        });
    }
    
    // Manejar eventos de agregar al carrito
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add_to_cart_button') && e.target.classList.contains('ajax_add_to_cart')) {
            e.preventDefault();
            
            const button = e.target;
            const productId = button.getAttribute('data-product_id');
            const quantity = button.getAttribute('data-quantity') || 1;
            
            // Mostrar estado de carga
            const originalText = button.textContent;
            button.textContent = 'Agregando...';
            button.disabled = true;
            
            // Realizar petición AJAX
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'woocommerce_add_to_cart',
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error al agregar al carrito:', data.error);
                    button.textContent = originalText;
                    button.disabled = false;
                } else {
                    // Disparar evento personalizado
                    const event = new CustomEvent('added_to_cart', {
                        detail: {
                            product_id: productId,
                            quantity: quantity,
                            fragments: data.fragments || {}
                        }
                    });
                    document.body.dispatchEvent(event);
                    
                    // Restaurar botón
                    button.textContent = '¡Agregado!';
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.disabled = false;
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Error en la petición:', error);
                button.textContent = originalText;
                button.disabled = false;
            });
        }
    });
});
</script>

<?php get_footer( 'shop' ); ?>






