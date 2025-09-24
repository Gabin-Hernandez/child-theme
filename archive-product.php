<?php
/**
 * Archivo de productos (tienda) - ITOOLS
 */

get_header();

// Solo crear consulta personalizada si hay filtros activos
$has_filters = !empty($_GET['product_categories']) || !empty($_GET['product_brands']) || 
               !empty($_GET['min_price']) || !empty($_GET['max_price']) || !empty($_GET['orderby']);

if ($has_filters) {
    // Procesar filtros de URL
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12,
        'post_status' => 'publish'
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

// Filtro por marcas
if (!empty($_GET['product_brands'])) {
    $selected_brands = $_GET['product_brands'];
    if (is_array($selected_brands)) {
        $brand_terms = array_map('intval', $selected_brands);
    } else {
        $brands = explode(',', sanitize_text_field($selected_brands));
        $brand_terms = array_map('intval', array_map('trim', $brands));
    }
    if (!empty($brand_terms)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_brand',
            'field' => 'term_id',
            'terms' => $brand_terms,
            'operator' => 'IN'
        );
    }
}

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

// Paginación
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged'] = $paged;

// Crear la consulta personalizada
$products_query = new WP_Query($args);

} else {
    // Usar la consulta principal de WordPress cuando no hay filtros
    global $wp_query;
    $products_query = $wp_query;
}

?>

<!-- Hero Section Moderno -->
<div class="bg-gradient-to-br from-blue-600 to-indigo-700 py-16">
    <div class="container mx-auto px-4">
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

<div class="bg-gray-50 min-h-screen pt-0 pb-8">
    <div class="container mx-auto px-4">

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
                    class="xl:w-80 2xl:w-96 fixed xl:relative inset-0 xl:inset-auto bg-black/50 xl:bg-transparent z-50 xl:z-auto hidden xl:block backdrop-blur-sm xl:backdrop-blur-none">
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
                                
                                <input type="number" 
                                       id="min_price" 
                                       placeholder="Precio mínimo" 
                                       value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 placeholder-gray-500"
                                       min="0">
                                
                                <input type="number" 
                                       id="max_price" 
                                       placeholder="Precio máximo" 
                                       value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 placeholder-gray-500"
                                       min="0">
                                
                                <button id="apply-price-filter" 
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                                    Filtrar Precios
                                </button>
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
                                <?php
                                $product_categories = get_terms( array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => 0,
                                ) );

                                if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) :
                                    foreach ( $product_categories as $category ) :
                                        $category_url = get_term_link( $category );
                                        $is_current = is_tax( 'product_cat', $category->term_id );
                                ?>
                                    <label class="group flex items-center space-x-4 cursor-pointer hover:bg-white/80 p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-blue-200">
                                        <div class="relative">
                                            <input type="checkbox" 
                                                   value="<?php echo $category->term_id; ?>" 
                                                   name="product_categories[]"
                                                   class="category-filter w-5 h-5 text-blue-600 rounded-lg focus:ring-blue-500 focus:ring-2 border-gray-300"
                                                   <?php checked( $is_current ); ?>>
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-purple-600 rounded-lg opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-gray-700 font-medium group-hover:text-blue-700 transition-colors">
                                                <?php echo esc_html( $category->name ); ?>
                                            </span>
                                            <div class="text-sm text-gray-500"><?php echo $category->count; ?> productos</div>
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
                                        $brands = get_terms( array(
                                            'taxonomy' => $taxonomy,
                                            'hide_empty' => true,
                                        ) );
                                        if ( ! empty( $brands ) && ! is_wp_error( $brands ) ) {
                                            break;
                                        }
                                    }
                                }

                                if ( ! empty( $brands ) && ! is_wp_error( $brands ) ) :
                                    foreach ( $brands as $brand ) :
                                ?>
                                    <label class="group flex items-center space-x-4 cursor-pointer hover:bg-white/80 p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-purple-200">
                                        <div class="relative">
                                            <input type="checkbox" 
                                                   value="<?php echo $brand->term_id; ?>" 
                                                   name="product_brands[]"
                                                   class="brand-filter w-5 h-5 text-purple-600 rounded-lg focus:ring-purple-500 focus:ring-2 border-gray-300">
                                            <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-pink-600 rounded-lg opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-gray-700 font-medium group-hover:text-purple-700 transition-colors">
                                                <?php echo esc_html( $brand->name ); ?>
                                            </span>
                                            <div class="text-sm text-gray-500"><?php echo $brand->count; ?> productos</div>
                                        </div>
                                    </label>
                                <?php 
                                    endforeach;
                                else :
                                ?>
                                    <div class="space-y-3">
                                        <?php
                                        $common_brands = array(
                                            'DeWalt', 'Makita', 'Bosch', 'Stanley', 'Black & Decker', 
                                            'Craftsman', 'Milwaukee', 'Ryobi', 'Hitachi', 'Festool'
                                        );
                                        foreach ( $common_brands as $brand ) :
                                        ?>
                                            <label class="group flex items-center space-x-4 cursor-pointer hover:bg-white/80 p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-purple-200">
                                                <div class="relative">
                                                    <input type="checkbox" 
                                                           value="<?php echo strtolower( $brand ); ?>" 
                                                           name="product_brands[]"
                                                           class="brand-filter w-5 h-5 text-purple-600 rounded-lg focus:ring-purple-500 focus:ring-2 border-gray-300">
                                                    <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-pink-600 rounded-lg opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                                </div>
                                                <span class="text-gray-700 font-medium group-hover:text-purple-700 transition-colors"><?php echo $brand; ?></span>
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

                        <!-- Filtros Rápidos -->
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
                                <button class="quick-filter w-full flex items-center gap-3 p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700" data-filter="best-sellers">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-orange-100 to-orange-200 text-orange-600">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.3622 5.21361C18.2427 6.50069 20.25 9.39075 20.25 12.7497C20.25 17.306 16.5563 20.9997 12 20.9997C7.44365 20.9997 3.75 17.306 3.75 12.7497C3.75 10.5376 4.62058 8.52889 6.03781 7.04746C6.8043 8.11787 7.82048 8.99731 9.00121 9.60064C9.04632 6.82497 10.348 4.35478 12.3621 2.73413C13.1255 3.75788 14.1379 4.61821 15.3622 5.21361Z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18C14.0711 18 15.75 16.3211 15.75 14.25C15.75 12.3467 14.3321 10.7746 12.4949 10.5324C11.4866 11.437 10.7862 12.6779 10.5703 14.0787C9.78769 13.8874 9.06529 13.5425 8.43682 13.0779C8.31559 13.4467 8.25 13.8407 8.25 14.25C8.25 16.3211 9.92893 18 12 18Z"></path>
                                        </svg>
                                    </span>
                                    <span>Más Vendidos</span>
                                </button>
                                <button class="quick-filter w-full flex items-center gap-3 p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700" data-filter="top-rated">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-amber-100 to-yellow-200 text-yellow-600">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.4806 3.4987C11.6728 3.03673 12.3272 3.03673 12.5193 3.4987L14.6453 8.61016C14.7263 8.80492 14.9095 8.93799 15.1197 8.95485L20.638 9.39724C21.1367 9.43722 21.339 10.0596 20.959 10.3851L16.7546 13.9866C16.5945 14.1238 16.5245 14.3391 16.5734 14.5443L17.8579 19.9292C17.974 20.4159 17.4446 20.8005 17.0176 20.5397L12.2932 17.6541C12.1132 17.5441 11.8868 17.5441 11.7068 17.6541L6.98238 20.5397C6.55539 20.8005 6.02594 20.4159 6.14203 19.9292L7.42652 14.5443C7.47546 14.3391 7.4055 14.1238 7.24531 13.9866L3.04099 10.3851C2.661 10.0596 2.86323 9.43722 3.36197 9.39724L8.88022 8.95485C9.09048 8.93799 9.27363 8.80492 9.35464 8.61016L11.4806 3.4987Z"></path>
                                        </svg>
                                    </span>
                                    <span>Mejor Valorados</span>
                                </button>
                                <button class="quick-filter w-full flex items-center gap-3 p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700" data-filter="on-sale">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-rose-100 to-pink-200 text-rose-600">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.56802 3H5.25C4.00736 3 3 4.00736 3 5.25V9.56802C3 10.1648 3.23705 10.7371 3.65901 11.159L13.2401 20.7401C13.9388 21.4388 15.0199 21.6117 15.8465 21.0705C17.9271 19.7084 19.7084 17.9271 21.0705 15.8465C21.6117 15.0199 21.4388 13.9388 20.7401 13.2401L11.159 3.65901C10.7371 3.23705 10.1648 3 9.56802 3Z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 6H6.0075V6.0075H6V6Z"></path>
                                        </svg>
                                    </span>
                                    <span>Ofertas</span>
                                </button>
                                <button class="quick-filter w-full flex items-center gap-3 p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700" data-filter="newest">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-200 text-indigo-600">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.8132 15.9038L9 18.75L8.1868 15.9038C7.75968 14.4089 6.59112 13.2403 5.09619 12.8132L2.25 12L5.09619 11.1868C6.59113 10.7597 7.75968 9.59112 8.1868 8.09619L9 5.25L9.8132 8.09619C10.2403 9.59113 11.4089 10.7597 12.9038 11.1868L15.75 12L12.9038 12.8132C11.4089 13.2403 10.2403 14.4089 9.8132 15.9038Z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.2589 8.71454L18 9.75L17.7411 8.71454C17.4388 7.50533 16.4947 6.56117 15.2855 6.25887L14.25 6L15.2855 5.74113C16.4947 5.43883 17.4388 4.49467 17.7411 3.28546L18 2.25L18.2589 3.28546C18.5612 4.49467 19.5053 5.43883 20.7145 5.74113L21.75 6L20.7145 6.25887C19.5053 6.56117 18.5612 7.50533 18.2589 8.71454Z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.8942 20.5673L16.5 21.75L16.1058 20.5673C15.8818 19.8954 15.3546 19.3682 14.6827 19.1442L13.5 18.75L14.6827 18.3558C15.3546 18.1318 15.8818 17.6046 16.1058 16.9327L16.5 15.75L16.8942 16.9327C17.1182 17.6046 17.6454 18.1318 18.3173 18.3558L19.5 18.75L18.3173 19.1442C17.6454 19.3682 17.1182 19.8954 16.8942 20.5673Z"></path>
                                        </svg>
                                    </span>
                                    <span>Nuevos</span>
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
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-12" id="products-grid">
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

                        woocommerce_product_loop_end();
                        ?>
                    </div>

                    <!-- Paginación moderna -->
                    <div class="mt-12">
                        <?php
                        do_action( 'woocommerce_after_shop_loop' );
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

#products-grid.list-layout {
    grid-template-columns: repeat(1, minmax(0, 1fr));
}

#products-grid.list-layout > li {
    width: 100% !important;
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
    const listViewBtn = document.getElementById('list-view');
    const productsGrid = document.getElementById('products-grid');
    const baseGridClasses = 'grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-12';
    const listGridClasses = 'grid grid-cols-1 gap-y-10 list-layout';



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
    
    // Toggle vista de productos (grid/list)
    if (gridViewBtn && listViewBtn) {
        gridViewBtn.addEventListener('click', function() {
            setProductView('grid');
        });
        
        listViewBtn.addEventListener('click', function() {
            setProductView('list');
        });
    }
    
    function applyGridClasses(view) {
        if (!productsGrid) {
            return;
        }

        if (view === 'list') {
            productsGrid.className = listGridClasses;
        } else {
            productsGrid.className = baseGridClasses;
        }
    }

    function setProductView(view, persist = true) {
        if (!productsGrid) {
            return;
        }

        applyGridClasses(view);

        if (gridViewBtn) {
            gridViewBtn.className = view === 'grid'
                ? 'px-3 py-2 rounded-lg transition-all duration-300 bg-white shadow-sm text-blue-600'
                : 'px-3 py-2 rounded-lg transition-all duration-300 text-gray-500';
        }

        if (listViewBtn) {
            listViewBtn.className = view === 'list'
                ? 'px-3 py-2 rounded-lg transition-all duration-300 bg-white shadow-sm text-blue-600'
                : 'px-3 py-2 rounded-lg transition-all duration-300 text-gray-500';
        }

        if (persist) {
            localStorage.setItem('productView', view);
        }
    }

    // Restaurar vista guardada
    const savedView = localStorage.getItem('productView');
    if (savedView === 'list' || savedView === 'grid') {
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

    // Filtros rapidos
    document.querySelectorAll('.quick-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            const filterType = this.getAttribute('data-filter');
            applyQuickFilter(filterType);
        });
    });

    function applyQuickFilter(type) {
        if (!type) {
            return;
        }
        const currentUrl = new URL(window.location);
        const searchParams = new URLSearchParams();

        // Mantener busqueda actual
        if (currentUrl.searchParams.get('s')) {
            searchParams.set('s', currentUrl.searchParams.get('s'));
        }

        switch (type) {
            case 'best-sellers':
                searchParams.set('orderby', 'popularity');
                break;
            case 'top-rated':
                searchParams.set('orderby', 'rating');
                break;
            case 'on-sale':
                searchParams.set('meta_key', '_sale_price');
                searchParams.set('meta_compare', 'EXISTS');
                break;
            case 'newest':
                searchParams.set('orderby', 'date');
                break;
            default:
                break;
        }

        currentUrl.search = searchParams.toString();
        window.location.href = currentUrl.toString();
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
        const currentUrl = new URL(window.location);
        const searchParams = new URLSearchParams();
        
        // Mantener parámetros básicos
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
        
        // Filtros de categorías
        const categoryFilters = document.querySelectorAll('.category-filter:checked');
        if (categoryFilters.length > 0) {
            const categories = Array.from(categoryFilters).map(cb => cb.value);
            searchParams.set('product_cat', categories.join(','));
        }
        
        // Filtros de marcas
        const brandFilters = document.querySelectorAll('.brand-filter:checked');
        if (brandFilters.length > 0) {
            const brands = Array.from(brandFilters).map(cb => cb.value);
            searchParams.set('product_brand', brands.join(','));
        }
        
        // Redirigir con los nuevos parámetros
        currentUrl.search = searchParams.toString();
        window.location.href = currentUrl.toString();
    }
    
    // Función para limpiar filtros con animación
    function clearAllFilters() {
        // Animación de limpiar
        document.querySelectorAll('.category-filter, .brand-filter').forEach(cb => {
            if (cb.checked) {
                cb.checked = false;
                cb.closest('label').style.backgroundColor = '#fee2e2';
                setTimeout(() => {
                    cb.closest('label').style.backgroundColor = '';
                }, 200);
            }
        });
        
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
        
        // Redirigir después de la animación
        setTimeout(() => {
            const baseUrl = window.location.pathname;
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
        
        // Cargar categorías
        const categories = urlParams.get('product_cat');
        if (categories) {
            const categoryIds = categories.split(',');
            categoryIds.forEach(id => {
                const checkbox = document.querySelector(`.category-filter[value="${id}"]`);
                if (checkbox) checkbox.checked = true;
            });
        }
        
        // Cargar marcas
        const brands = urlParams.get('product_brand');
        if (brands) {
            const brandIds = brands.split(',');
            brandIds.forEach(id => {
                const checkbox = document.querySelector(`.brand-filter[value="${id}"]`);
                if (checkbox) checkbox.checked = true;
            });
        }
    }
    
    // Cargar filtros al cargar la página
    loadFiltersFromUrl();
    
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
});
</script>

<?php get_footer( 'shop' ); ?>






