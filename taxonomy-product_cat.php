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

// Procesar filtros de URL
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $category_slug,
        ),
        // Excluir productos ocultos del catálogo (WooCommerce 3.0+)
        array(
            'taxonomy' => 'product_visibility',
            'field' => 'name',
            'terms' => 'exclude-from-catalog',
            'operator' => 'NOT IN',
        )
    )
);

// Filtro por categorías adicionales
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
    }
}

// Filtro por marcas
if (!empty($_GET['product_brands'])) {
    $selected_brands = $_GET['product_brands'];
    if (is_array($selected_brands)) {
        $brand_terms = array();
        $brand_taxonomies = array('product_brand', 'pa_marca', 'pa_brand');
        
        foreach ($selected_brands as $brand) {
            foreach ($brand_taxonomies as $taxonomy) {
                if (is_numeric($brand)) {
                    $term = get_term($brand, $taxonomy);
                } else {
                    $term = get_term_by('slug', sanitize_text_field($brand), $taxonomy);
                }
                
                if ($term && !is_wp_error($term)) {
                    $brand_terms[] = array(
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => $term->term_id
                    );
                    break;
                }
            }
        }
        
        if (!empty($brand_terms)) {
            if (count($brand_terms) == 1) {
                $args['tax_query'][] = $brand_terms[0];
            } else {
                $args['tax_query'][] = array(
                    'relation' => 'OR',
                    ...$brand_terms
                );
            }
        }
    }
}

// Filtro por precio
if (!empty($_GET['min_price']) || !empty($_GET['max_price'])) {
    $price_query = array('relation' => 'AND');
    
    if (!empty($_GET['min_price'])) {
        $price_query[] = array(
            'key' => '_price',
            'value' => floatval($_GET['min_price']),
            'compare' => '>=',
            'type' => 'NUMERIC'
        );
    }
    
    if (!empty($_GET['max_price'])) {
        $price_query[] = array(
            'key' => '_price',
            'value' => floatval($_GET['max_price']),
            'compare' => '<=',
            'type' => 'NUMERIC'
        );
    }
    
    $args['meta_query'][] = $price_query;
}

// Ordenamiento
if (!empty($_GET['orderby'])) {
    switch ($_GET['orderby']) {
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
        default:
            $args['orderby'] = 'menu_order title';
            $args['order'] = 'ASC';
    }
}

// Paginación
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged'] = $paged;

// Ejecutar la consulta
$products_query = new WP_Query($args);
?>

<!-- Section Moderno para Categoría -->
<div class="bg-gradient-to-br from-blue-600 to-indigo-700 py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 sm:mb-6 capitalize leading-tight">
                <?php echo esc_html($category_name); ?>
            </h1>
            <?php if ($category_description) : ?>
                <p class="text-base sm:text-lg lg:text-xl text-blue-100 mb-6 sm:mb-8 max-w-2xl mx-auto leading-relaxed px-4">
                    <?php echo wp_kses_post($category_description); ?>
                </p>
            <?php else : ?>
                <p class="text-base sm:text-lg lg:text-xl text-blue-100 mb-6 sm:mb-8 max-w-2xl mx-auto leading-relaxed px-4">
                    Encuentra las mejores <?php echo esc_html(strtolower($category_name)); ?> profesionales para tus proyectos
                </p>
            <?php endif; ?>
            
            <!-- Formulario de búsqueda funcional -->
            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="max-w-2xl mx-auto px-4">
                <div class="flex flex-col sm:flex-row gap-3">
                    <input type="hidden" name="post_type" value="product">
                    <input type="hidden" name="product_cat" value="<?php echo esc_attr($category_slug); ?>">
                    <div class="flex-1 relative">
                        <input type="text" 
                               name="s" 
                               value="<?php echo get_search_query(); ?>"
                               placeholder="Buscar en <?php echo esc_attr($category_name); ?>..."
                               class="w-full px-4 sm:px-6 py-3 sm:py-4 text-base sm:text-lg rounded-xl border-0 focus:ring-4 focus:ring-blue-300 shadow-lg">
                    </div>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-xl font-semibold transition-colors shadow-lg text-base sm:text-lg whitespace-nowrap">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="bg-gray-50 min-h-screen py-6 sm:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Navegación de breadcrumbs -->
        <div class="mb-4 sm:mb-6">
            <nav class="flex items-center flex-wrap gap-2 text-xs sm:text-sm text-gray-600">
                <a href="<?php echo home_url(); ?>" class="hover:text-blue-600 transition-colors">Inicio</a>
                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="/tienda" class="hover:text-blue-600 transition-colors">Tienda</a>
                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium capitalize"><?php echo esc_html($category_name); ?></span>
            </nav>
        </div>

        <!-- Botón para mostrar filtros en móvil -->
        <div class="xl:hidden mb-4 sm:mb-6">
            <button id="toggle-filters" class="flex items-center gap-3 bg-white px-4 sm:px-6 py-3 sm:py-4 rounded-2xl shadow-lg border border-gray-200 font-semibold text-gray-900 hover:shadow-xl transition-all duration-300 w-full justify-center text-sm sm:text-base">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                </svg>
                Filtros y Ordenar
                <div class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></div>
            </button>
        </div>

        <?php if ( $products_query->have_posts() ) : ?>

            <div class="flex flex-col xl:flex-row gap-8">
                
                <!-- Sidebar con filtros modernos -->
                <aside 
                    id="filters-sidebar" 
                    class="xl:w-96 2xl:w-[420px] fixed xl:relative inset-0 xl:inset-auto bg-black/50 xl:bg-transparent z-50 xl:z-auto hidden xl:block backdrop-blur-sm xl:backdrop-blur-none">
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
                                // Get dynamic price range for current category
                                $current_term = get_queried_object();
                                $category_id = $current_term ? $current_term->term_id : null;
                                $price_range = itools_get_dynamic_price_range($category_id);
                                $current_min = isset($_GET['min_price']) ? $_GET['min_price'] : $price_range['min'];
                                $current_max = isset($_GET['max_price']) ? $_GET['max_price'] : $price_range['max'];
                                ?>
                                
                                <!-- Price Range Slider -->
                                <div class="price-slider-container">
                                    <div class="flex justify-between items-center mb-4">
                                        <span class="text-sm font-medium text-gray-700">$<span id="min-price-display"><?php echo number_format($current_min, 0); ?></span></span>
                                        <span class="text-sm font-medium text-gray-700">$<span id="max-price-display"><?php echo number_format($current_max, 0); ?></span></span>
                                    </div>
                                    
                                    <div class="relative">
                                        <div class="price-slider-track bg-gray-200 h-2 rounded-full relative">
                                            <div id="price-slider-range" class="absolute h-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full"></div>
                                        </div>
                                        
                                        <input type="range" 
                                               id="min-price-slider" 
                                               class="price-slider-input absolute top-0 w-full h-2 bg-transparent appearance-none cursor-pointer"
                                               min="<?php echo $price_range['min']; ?>" 
                                               max="<?php echo $price_range['max']; ?>" 
                                               value="<?php echo $current_min; ?>"
                                               step="1">
                                        
                                        <input type="range" 
                                               id="max-price-slider" 
                                               class="price-slider-input absolute top-0 w-full h-2 bg-transparent appearance-none cursor-pointer"
                                               min="<?php echo $price_range['min']; ?>" 
                                               max="<?php echo $price_range['max']; ?>" 
                                               value="<?php echo $current_max; ?>"
                                               step="1">
                                    </div>
                                    
                                    <!-- Hidden inputs for form submission -->
                                    <input type="hidden" id="min_price" value="<?php echo $current_min; ?>">
                                    <input type="hidden" id="max_price" value="<?php echo $current_max; ?>">
                                </div>
                                
                                <button id="apply-price-filter" 
                                        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-4 rounded-xl font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg">
                                    Filtrar Precios
                                </button>
                            </div>
                        </div>

                        <!-- Filtro por Categorías -->
                        <div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100">
                            <h4 class="font-bold text-gray-900 mb-6 flex items-center text-lg">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H5m10 18H5"></path>
                                    </svg>
                                </div>
                                Categorías
                            </h4>
                            
                            <div class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                                <?php
                                $product_categories = get_terms( array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => 0,
                                ) );

                                if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) :
                                    foreach ( $product_categories as $category ) :
                                        $current_cat_slug = get_queried_object()->slug;
                                        $is_current = $category->slug === $current_cat_slug;
                                ?>
                                    <label class="group flex items-center space-x-4 cursor-pointer hover:bg-white/80 p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-blue-200 <?php echo $is_current ? 'bg-blue-50 border-blue-300' : ''; ?>">
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
                                        </div>
                                        <input type="checkbox" 
                                               name="product_categories[]" 
                                               value="<?php echo esc_attr( $category->term_id ); ?>"
                                               <?php echo $is_current ? 'checked' : ''; ?>
                                               class="hidden">
                                        <div class="flex-1 flex items-center justify-between">
                                            <span class="font-medium text-gray-900 group-hover:text-blue-600 <?php echo $is_current ? 'text-blue-600' : ''; ?>">
                                                <?php echo esc_html( $category->name ); ?>
                                            </span>
                                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                                <?php echo $category->count; ?>
                                            </span>
                                        </div>
                                    </label>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>

                        <!-- Filtro por Marcas -->
                        <div class="mb-8 p-6 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border border-purple-100">
                            <h4 class="font-bold text-gray-900 mb-6 flex items-center text-lg">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                Marcas
                            </h4>
                            
                            <div class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                                <?php
                                $brand_taxonomies = array( 'product_brand', 'pa_marca', 'pa_brand' );
                                $brands = array();
                                
                                foreach ( $brand_taxonomies as $taxonomy ) {
                                    if ( taxonomy_exists( $taxonomy ) ) {
                                        $terms = get_terms( array(
                                            'taxonomy' => $taxonomy,
                                            'hide_empty' => true,
                                        ) );
                                        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
                                            $brands = array_merge( $brands, $terms );
                                            break;
                                        }
                                    }
                                }

                                if ( ! empty( $brands ) && ! is_wp_error( $brands ) ) :
                                    foreach ( $brands as $brand ) :
                                ?>
                                    <label class="group flex items-center space-x-4 cursor-pointer hover:bg-white/80 p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-purple-200">
                                        <input type="checkbox" 
                                               name="product_brands[]" 
                                               value="<?php echo esc_attr( $brand->slug ); ?>"
                                               class="w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                        <div class="flex-1 flex items-center justify-between">
                                            <span class="font-medium text-gray-900 group-hover:text-purple-600">
                                                <?php echo esc_html( $brand->name ); ?>
                                            </span>
                                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                                <?php echo $brand->count; ?>
                                            </span>
                                        </div>
                                    </label>
                                <?php 
                                    endforeach;
                                else :
                                ?>
                                    <div class="space-y-3">
                                        <?php $sample_brands = array('Bosch', 'DeWalt', 'Makita', 'Black & Decker', 'Stanley'); ?>
                                        <?php foreach ($sample_brands as $brand) : ?>
                                            <label class="group flex items-center space-x-4 cursor-pointer hover:bg-white/80 p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-purple-200">
                                                <input type="checkbox" name="sample_brands[]" value="<?php echo strtolower($brand); ?>" class="w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                                <div class="flex-1 flex items-center justify-between">
                                                    <span class="font-medium text-gray-900 group-hover:text-purple-600"><?php echo $brand; ?></span>
                                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">0</span>
                                                </div>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="space-y-4">
                            <button id="apply-filters" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-2xl font-bold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Aplicar Filtros
                            </button>
                            <button id="clear-filters" 
                                    class="w-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-4 rounded-2xl font-bold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 border border-gray-300 hover:border-gray-400 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Limpiar Todo
                            </button>
                        </div>

                        <!-- Filtros rápidos -->
                        <div class="mt-8 p-6 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl border border-yellow-200">
                            <h5 class="font-bold text-gray-900 mb-4 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                Filtros Rápidos
                            </h5>
                            <div class="space-y-2">
                                <button class="quick-filter w-full text-left p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700">
                                    🔥 Más Vendidos
                                </button>
                                <button class="quick-filter w-full text-left p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700">
                                    ⭐ Mejor Valorados
                                </button>
                                <button class="quick-filter w-full text-left p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700">
                                    💰 Ofertas
                                </button>
                                <button class="quick-filter w-full text-left p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700">
                                    🆕 Nuevos
                                </button>
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

                <!-- Contenido principal -->
                <main class="flex-1 xl:flex-none xl:w-[calc(100%-21rem)] 2xl:w-[calc(100%-25rem)]">
                    
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-5 gap-6 sm:gap-8 lg:gap-10" id="products-grid">
                <?php
                while ( $products_query->have_posts() ) {
                    $products_query->the_post();
                    
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
                                    $logo_url = get_stylesheet_directory_uri() . '/images/logo-itoolsmx.jpg';
                                    echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_the_title()) . '" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">';
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

            <!-- Paginación personalizada al final de los productos -->
            <div class="mt-12">
                <?php
                if ( $products_query && $products_query->have_posts() ) {
                    // Usar nuestra función de paginación personalizada
                    itools_custom_pagination($products_query);
                    wp_reset_postdata();
                }
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
                    
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">No encontramos productos en <?php echo esc_html($category_name); ?></h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Lo sentimos, no hay productos disponibles en esta categoría en este momento.
                        <br>Explora nuestras otras categorías o vuelve más tarde.
                    </p>
                    
                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="/tienda" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-2xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Ver Todos los Productos
                        </a>
                        <a href="<?php echo home_url(); ?>" class="bg-white border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-2xl hover:border-blue-500 hover:text-blue-600 transition-all duration-300 font-semibold">
                            Volver al Inicio
                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

<!-- Slider debajo del contenedor principal -->
<div class="w-full">
    <?php
    // Mostrar el slider fuera del contenedor principal
    if ( is_active_sidebar( 'sidebar-shop-slider' ) ) {
        dynamic_sidebar( 'sidebar-shop-slider' );
    }
    ?>
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

/* Estilos para los filtros */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

@media (max-width: 1279px) {
    #filters-sidebar {
        backdrop-filter: blur(8px);
    }
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
            productsGrid.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-5 gap-6 sm:gap-8 lg:gap-10';
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

    // ===== FUNCIONALIDAD DE FILTROS =====
    
    // Manejo del sidebar de filtros en móviles
    const toggleFilters = document.getElementById('toggle-filters');
    const filtersSidebar = document.getElementById('filters-sidebar');
    const closeFilters = document.getElementById('close-filters');

    if (toggleFilters && filtersSidebar) {
        toggleFilters.addEventListener('click', function() {
            filtersSidebar.classList.toggle('hidden');
        });
    }

    if (closeFilters) {
        closeFilters.addEventListener('click', function() {
            filtersSidebar.classList.add('hidden');
        });
    }

    // Cerrar filtros al hacer clic fuera (solo móvil)
    if (filtersSidebar) {
        filtersSidebar.addEventListener('click', function(e) {
            if (e.target === filtersSidebar) {
                filtersSidebar.classList.add('hidden');
            }
        });
    }

    // Aplicar filtros de precio
    const applyPriceFilter = document.getElementById('apply-price-filter');
    if (applyPriceFilter) {
        applyPriceFilter.addEventListener('click', function() {
            const minPrice = document.getElementById('min_price').value;
            const maxPrice = document.getElementById('max_price').value;
            
            const url = new URL(window.location);
            
            if (minPrice) url.searchParams.set('min_price', minPrice);
            else url.searchParams.delete('min_price');
            
            if (maxPrice) url.searchParams.set('max_price', maxPrice);
            else url.searchParams.delete('max_price');
            
            window.location.href = url.toString();
        });
    }

    // Aplicar filtros generales
    const applyFilters = document.getElementById('apply-filters');
    if (applyFilters) {
        applyFilters.addEventListener('click', function() {
            const url = new URL(window.location);
            
            // Recoger categorías seleccionadas (excluyendo la actual)
            const selectedCategories = [];
            document.querySelectorAll('input[name="product_categories[]"]:checked').forEach(checkbox => {
                selectedCategories.push(checkbox.value);
            });
            
            // Recoger marcas seleccionadas
            const selectedBrands = [];
            document.querySelectorAll('input[name="product_brands[]"]:checked').forEach(checkbox => {
                selectedBrands.push(checkbox.value);
            });
            
            // Aplicar filtros a la URL
            if (selectedCategories.length > 0) {
                url.searchParams.set('product_categories', selectedCategories.join(','));
            } else {
                url.searchParams.delete('product_categories');
            }
            
            if (selectedBrands.length > 0) {
                url.searchParams.set('product_brands', selectedBrands.join(','));
            } else {
                url.searchParams.delete('product_brands');
            }
            
            window.location.href = url.toString();
        });
    }

    // Limpiar todos los filtros
    const clearFilters = document.getElementById('clear-filters');
    if (clearFilters) {
        clearFilters.addEventListener('click', function() {
            // Limpiar checkboxes (mantener la categoría actual marcada)
            document.querySelectorAll('input[type="checkbox"]:not([name="current_category"])').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            // Limpiar campos de precio
            if (document.getElementById('min_price')) document.getElementById('min_price').value = '';
            if (document.getElementById('max_price')) document.getElementById('max_price').value = '';
            
            // Volver a la URL base de la categoría
            const baseUrl = window.location.pathname;
            window.location.href = baseUrl;
        });
    }

    // Filtros rápidos
    document.querySelectorAll('.quick-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            const url = new URL(window.location);
            
            if (this.textContent.includes('Más Vendidos')) {
                url.searchParams.set('orderby', 'popularity');
            } else if (this.textContent.includes('Mejor Valorados')) {
                url.searchParams.set('orderby', 'rating');
            } else if (this.textContent.includes('Ofertas')) {
                url.searchParams.set('on_sale', '1');
            } else if (this.textContent.includes('Nuevos')) {
                url.searchParams.set('orderby', 'date');
            }
            
            window.location.href = url.toString();
        });
    });
    
    // Función para cargar filtros desde URL
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
        
        // Cargar categorías
        const categories = urlParams.get('product_categories');
        if (categories) {
            const categoryIds = categories.split(',');
            categoryIds.forEach(id => {
                const checkbox = document.querySelector(`input[name="product_categories[]"][value="${id}"]`);
                if (checkbox) checkbox.checked = true;
            });
        }
        
        // Cargar marcas
        const brands = urlParams.get('product_brands');
        if (brands) {
            const brandIds = brands.split(',');
            brandIds.forEach(id => {
                const checkbox = document.querySelector(`input[name="product_brands[]"][value="${id}"]`);
                if (checkbox) checkbox.checked = true;
            });
        }
    }
    
    // Cargar filtros al cargar la página
    loadFiltersFromUrl();
});
</script>

<?php get_footer(); ?>