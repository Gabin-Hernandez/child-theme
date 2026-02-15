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

<!-- Hero Section - Minimalist Compact Design -->
<div class="relative bg-gray-900 border-b border-gray-200 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/master-uses-special-tools-disassemble-electronic-device-carefully-pincers-bit-screw-driver.jpg" 
             alt="Herramientas profesionales" 
             class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/80 via-gray-900/70 to-gray-900/90"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight mb-4">
                <span class="block">Tienda Profesional</span>
            </h1>
            <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">
                Herramientas y refacciones de alta calidad para tu taller.
            </p>
            
            <!-- Compact Search Bar -->
            <div class="max-w-xl mx-auto relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-200"></div>
                <form role="search" method="get" class="relative bg-white rounded-lg shadow-sm" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="hidden" name="post_type" value="product">
                    <div class="flex items-center">
                        <div class="pl-4 text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="s" 
                               class="w-full py-4 px-4 text-gray-700 bg-transparent border-none focus:ring-0 text-base placeholder-gray-400" 
                               placeholder="Buscar por nombre, modelo o marca..."
                               value="<?php echo get_search_query(); ?>">
                        <button type="submit" class="mr-2 px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Quick Links -->
            <div class="mt-6 flex flex-wrap justify-center gap-3 text-sm text-gray-400">
                <span>Busca también:</span>
                <a href="?s=iphone&post_type=product" class="text-indigo-400 hover:text-indigo-300 hover:underline">iPhone</a>
                <span class="text-gray-600">•</span>
                <a href="?s=cautin&post_type=product" class="text-indigo-400 hover:text-indigo-300 hover:underline">Cautines</a>
                <span class="text-gray-600">•</span>
                <a href="?s=microscopio&post_type=product" class="text-indigo-400 hover:text-indigo-300 hover:underline">Microscopios</a>
                <span class="text-gray-600">•</span>
                <a href="?s=consumibles&post_type=product" class="text-indigo-400 hover:text-indigo-300 hover:underline">Consumibles</a>
            </div>
        </div>
    </div>
</div>

<!-- Popular Products Carousel -->
<section class="bg-gray-50 py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-black mb-4 tracking-tight">
                PRODUCTOS POPULARES
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Los productos más vendidos y mejor valorados por nuestros clientes
            </p>
        </div>

        <!-- Products Carousel -->
        <div class="relative">
            <?php
            // Get popular products from WooCommerce
            $popular_args = array(
                'post_type' => 'product',
                'posts_per_page' => 12,
                'meta_key' => 'total_sales',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'post_status' => 'publish'
            );
            $popular_products = new WP_Query($popular_args);
            
            if ($popular_products->have_posts()) :
            ?>
            <div class="swiper popular-products-swiper">
                <div class="swiper-wrapper">
                    <?php while ($popular_products->have_posts()) : $popular_products->the_post(); 
                        $product = wc_get_product(get_the_ID());
                        if (!$product) continue;
                    ?>
                    <div class="swiper-slide">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 border-2 border-gray-200 hover:border-black h-full">
                            <!-- Product Image -->
                            <a href="<?php echo get_permalink(); ?>" class="block relative overflow-hidden bg-gray-50 aspect-square">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('woocommerce_thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-itoolsmx.jpg" alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-full object-contain p-4">
                                <?php endif; ?>
                                
                                <?php if ($product->is_on_sale()) : ?>
                                    <span class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-lg uppercase">
                                        Oferta
                                    </span>
                                <?php endif; ?>
                            </a>
                            
                            <!-- Product Info -->
                            <div class="p-5">
                                <h3 class="text-base font-bold text-gray-900 mb-3 line-clamp-2 hover:text-black transition-colors">
                                    <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                </h3>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <?php if ($product->is_on_sale()) : ?>
                                            <span class="text-sm text-gray-500 line-through"><?php echo $product->get_regular_price(); ?></span>
                                            <span class="text-xl font-bold text-black"><?php echo $product->get_sale_price(); ?> MXN</span>
                                        <?php else : ?>
                                            <span class="text-xl font-bold text-black"><?php echo $product->get_price(); ?> MXN</span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <a href="<?php echo get_permalink(); ?>" class="bg-black text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-900 transition-all duration-300">
                                        Ver
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                
                <!-- Navigation -->
                <div class="swiper-button-next popular-next"></div>
                <div class="swiper-button-prev popular-prev"></div>
                
                <!-- Pagination -->
                <div class="swiper-pagination popular-pagination"></div>
            </div>
            
            <!-- View All Button -->
            <div class="text-center mt-12">
                <a href="<?php echo home_url('/tienda'); ?>" class="inline-flex items-center gap-2 bg-black text-white px-8 py-4 rounded-2xl font-bold uppercase text-sm tracking-wider hover:bg-gray-900 transition-all duration-300 shadow-lg hover:shadow-xl">
                    Ver Todos los Productos
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Brands/Categories Carousel -->
<section class="bg-white py-16 border-y border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-black mb-3 tracking-tight">
                EXPLORA POR CATEGORÍA
            </h2>
            <p class="text-gray-600">Encuentra exactamente lo que necesitas</p>
        </div>
        
        <div class="swiper categories-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="<?php echo home_url('/categoria-product/pantallas'); ?>" class="block group">
                        <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-black transition-all duration-300 border-2 border-gray-200 hover:border-black">
                            <div class="flex justify-center mb-4">
                                <i data-lucide="monitor" class="w-20 h-20 text-gray-700 group-hover:text-white transition-colors"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-white transition-colors">Pantallas LCD</h3>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="<?php echo home_url('/categoria-product/baterias'); ?>" class="block group">
                        <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-black transition-all duration-300 border-2 border-gray-200 hover:border-black">
                            <div class="flex justify-center mb-4">
                                <i data-lucide="battery-charging" class="w-20 h-20 text-gray-700 group-hover:text-white transition-colors"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-white transition-colors">Baterías</h3>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="<?php echo home_url('/categoria-product/herramientas'); ?>" class="block group">
                        <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-black transition-all duration-300 border-2 border-gray-200 hover:border-black">
                            <div class="flex justify-center mb-4">
                                <i data-lucide="wrench" class="w-20 h-20 text-gray-700 group-hover:text-white transition-colors"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-white transition-colors">Herramientas</h3>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="<?php echo home_url('/categoria-product/refacciones'); ?>" class="block group">
                        <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-black transition-all duration-300 border-2 border-gray-200 hover:border-black">
                            <div class="flex justify-center mb-4">
                                <i data-lucide="package" class="w-20 h-20 text-gray-700 group-hover:text-white transition-colors"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-white transition-colors">Refacciones</h3>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="<?php echo home_url('/categoria-product/cargadores'); ?>" class="block group">
                        <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-black transition-all duration-300 border-2 border-gray-200 hover:border-black">
                            <div class="flex justify-center mb-4">
                                <i data-lucide="plug-zap" class="w-20 h-20 text-gray-700 group-hover:text-white transition-colors"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-white transition-colors">Cargadores</h3>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="<?php echo home_url('/categoria-product/accesorios'); ?>" class="block group">
                        <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-black transition-all duration-300 border-2 border-gray-200 hover:border-black">
                            <div class="flex justify-center mb-4">
                                <i data-lucide="headphones" class="w-20 h-20 text-gray-700 group-hover:text-white transition-colors"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-white transition-colors">Accesorios</h3>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="swiper-pagination !relative !mt-8"></div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center space-x-3 text-sm">
            <a href="<?php echo home_url(); ?>" class="text-gray-600 hover:text-black transition-colors font-semibold">Inicio</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="text-gray-600 hover:text-black transition-colors font-semibold">Tienda</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-black font-bold">Productos</span>
        </nav>
    </div>
</div>

<!-- Products Content -->
<div class="bg-white min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Botón para filtros en móvil -->
        <div class="lg:hidden mb-8">
            <button id="toggle-filters" class="flex items-center justify-center gap-3 w-full py-4 px-6 bg-black hover:bg-gray-900 rounded-2xl text-white font-bold uppercase text-sm tracking-wider transition-all duration-300 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                </svg>
                <span>Filtros</span>
            </button>
        </div>



        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="flex flex-col lg:flex-row gap-6">
                
                <!-- Sidebar de filtros moderno -->
                <aside 
                    id="filters-sidebar" 
                    class="lg:w-80 fixed lg:relative inset-0 lg:inset-auto bg-black/70 lg:bg-transparent z-50 lg:z-auto hidden lg:block">
                    <div class="bg-black h-full lg:h-auto p-8 rounded-none lg:rounded-3xl shadow-2xl overflow-y-auto ml-auto lg:ml-0 w-80 lg:w-full border-0 lg:border-2 lg:border-gray-800 lg:sticky lg:top-4 lg:max-h-[calc(100vh-2rem)]">
                        
                        <!-- Header del sidebar -->
                        <div class="flex justify-between items-center mb-10 pb-6 border-b border-white/10">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white tracking-tight">
                                    Filtros
                                </h3>
                            </div>
                            <button id="close-filters" class="lg:hidden text-white/70 hover:text-white p-2 hover:bg-white/10 rounded-xl transition-all duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Filtro por Precio -->
                        <div class="mb-8 p-6 bg-white/5 rounded-2xl border border-white/10 shadow-sm hover:border-white/20 transition-all duration-300">
                            <h4 class="font-bold text-white mb-6 flex items-center gap-3 text-lg">
                                <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                Rango de Precio
                            </h4>
                            
                            <?php
                            // Get dynamic price range
                            $price_range = itools_get_dynamic_price_range();
                            $current_min = isset($_GET['min_price']) ? $_GET['min_price'] : $price_range['min'];
                            $current_max = isset($_GET['max_price']) ? $_GET['max_price'] : $price_range['max'];
                            ?>
                            
                            <!-- Price Range Slider -->
                            <div class="price-slider-container">
                                <div class="flex justify-between items-center mb-5">
                                    <span class="text-sm text-white/90 font-bold">$<span id="min-price-display"><?php echo number_format($current_min, 0); ?></span></span>
                                    <span class="text-sm text-white/90 font-bold">$<span id="max-price-display"><?php echo number_format($current_max, 0); ?></span></span>
                                </div>
                                
                                <div class="relative">
                                    <div class="price-slider-track bg-white/20 h-2 rounded-full relative">
                                        <div id="price-slider-range" class="absolute h-2 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></div>
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
                        </div>

                        <!-- Filtro por Categorías -->
                        <div class="mb-8 p-6 bg-white/5 rounded-2xl border border-white/10 shadow-sm hover:border-white/20 transition-all duration-300">
                            <h4 class="font-bold text-white mb-6 flex items-center gap-3 text-lg">
                                <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                Categorías de Producto
                            </h4>
                            
                            <div class="space-y-2">
                                <!-- Enlace para todas las categorías -->
                                <?php 
                                $all_categories_url = home_url('/?post_type=product&s=');
                                $is_all_categories = empty($_GET['product_cat']);
                                ?>
                                <a href="<?php echo esc_url($all_categories_url); ?>" 
                                   class="flex items-center justify-between p-4 rounded-xl hover:bg-white/10 transition-all duration-300 group <?php echo $is_all_categories ? 'bg-white/10 border border-white/20' : ''; ?>">
                                    <span class="text-white/90 font-semibold group-hover:text-white transition-colors <?php echo $is_all_categories ? 'text-white' : ''; ?>">
                                        Todas las categorías
                                    </span>
                                    <?php if ($is_all_categories) : ?>
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    <?php endif; ?>
                                </a>
                                
                                <?php
                                $product_categories = get_terms( array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => 0,
                                    'meta_key' => 'product_count_product_cat',
                                    'orderby' => 'count',
                                    'order' => 'DESC'
                                ) );

                                if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) :
                                ?>
                                <?php 
                                    foreach ( $product_categories as $index => $category ) :
                                        // Create correct URL format: ?post_type=product&s=&product_cat=slug
                                        $category_url = home_url('/?post_type=product&s=&product_cat=' . $category->slug);
                                        $is_current = (isset($_GET['product_cat']) && $_GET['product_cat'] === $category->slug);
                                        
                                        // Mostrar solo las primeras 3 categorías, el resto en "más categorías"
                                        $hidden_class = $index >= 3 ? 'hidden more-category' : '';
                                ?>
                                    <a href="<?php echo esc_url($category_url); ?>" 
                                       class="flex items-center justify-between p-4 rounded-xl hover:bg-white/10 transition-all duration-300 group <?php echo $is_current ? 'bg-white/10 border border-white/20' : ''; ?> <?php echo $hidden_class; ?>">
                                        <div class="flex items-center gap-3">
                                            <span class="text-white/90 font-semibold group-hover:text-white transition-colors <?php echo $is_current ? 'text-white' : ''; ?>">
                                                <?php echo esc_html( $category->name ); ?>
                                            </span>
                                            <span class="text-xs bg-white/10 text-white/70 px-3 py-1.5 rounded-full font-bold">
                                                <?php echo $category->count; ?>
                                            </span>
                                        </div>
                                        <?php if ($is_current) : ?>
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        <?php endif; ?>
                                    </a>
                                <?php 
                                    endforeach;
                                    
                                    // Si hay más de 3 categorías, mostrar botón "Ver más"
                                    if (count($product_categories) > 3) :
                                ?>
                                    <div id="more-categories" class="hidden">
                                        <!-- Las categorías adicionales ya están marcadas con more-category -->
                                    </div>
                                    <button id="toggle-categories" class="w-full p-4 text-center text-white font-bold flex items-center justify-center gap-2 hover:bg-white/10 rounded-xl transition-all duration-300">
                                        <span id="toggle-text">Ver más categorías</span>
                                        <svg id="toggle-icon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                <?php 
                                    endif;
                                endif;
                                ?>
                            </div>
                        </div>


                        <!-- Botones de acción -->
                        <div class="space-y-4 mt-10">
                            <button id="apply-sidebar-filters" 
                                    class="apply-filters w-full bg-white text-black py-5 rounded-2xl font-bold uppercase text-sm tracking-wider hover:bg-white/90 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Aplicar Filtros
                            </button>
                            <button id="clear-filters" 
                                    class="clear-filters w-full bg-white/10 text-white py-5 rounded-2xl font-bold uppercase text-sm tracking-wider hover:bg-white/20 transition-all duration-300 border-2 border-white/20 hover:border-white/30 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Limpiar Todo
                            </button>
                        </div>
                        
                        <!-- Estado de carga para sidebar -->
                        <div class="filters-loading hidden mt-6 text-center">
                            <div class="inline-flex items-center px-4 py-3 bg-white/10 text-white rounded-xl border border-white/20">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                    
                    <!-- Barra superior moderna -->
                    <div class="bg-white p-6 lg:p-8 rounded-3xl shadow-lg mb-8 border border-gray-200">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-5">
                            
                            <!-- Información de resultados -->
                            <div class="flex items-center gap-4">
                                <div class="w-1.5 h-12 bg-black rounded-full"></div>
                                <div>
                                    <?php
                                    $total_products = $products_query->found_posts;
                                    if ( $total_products ) :
                                        $current_page = max( 1, get_query_var( 'paged' ) );
                                        $per_page = $products_query->query_vars['posts_per_page'];
                                        $first = ( $current_page - 1 ) * $per_page + 1;
                                        $last = min( $total_products, $current_page * $per_page );
                                    ?>
                                        <h3 class="text-xl lg:text-2xl font-bold text-black tracking-tight">
                                            <?php echo $total_products; ?> Productos
                                        </h3>
                                        <p class="text-sm text-gray-600 font-semibold mt-1">
                                            <?php echo $first; ?>-<?php echo $last; ?> de <?php echo $total_products; ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Controles simples -->
                            <div class="flex items-center gap-4">
                                <!-- Selector de vista -->
                                <div class="flex bg-gray-100 rounded-xl p-1.5">
                                    <button id="grid-view" class="px-4 py-3 rounded-lg transition-all duration-300 bg-white shadow-sm" title="Vista en tarjetas">
                                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                        </svg>
                                    </button>
                                    <button id="table-view" class="px-4 py-3 rounded-lg transition-all duration-300 text-gray-500" title="Vista de tabla técnica">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
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
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="products-grid">
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
                            <div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-gray-200 hover:border-black h-full flex flex-col min-h-[450px]">
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
                                    
                                    <!-- Botones de acción flotantes -->
                                    <div class="absolute top-3 right-3 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="wishlist-btn w-8 h-8 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-200">
                                            <svg class="w-4 h-4 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </button>
                                        <button class="quick-view-btn w-8 h-8 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-200">
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
                                        
                                        <!-- Descripción corta -->
                                        <div class="text-xs text-gray-600 mb-3 line-clamp-2">
                                            <?php 
                                            $excerpt = get_the_excerpt();
                                            echo $excerpt ? wp_trim_words($excerpt, 15, '...') : 'Producto de alta calidad para uso profesional';
                                            ?>
                                        </div>
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

            <!-- Estado vacío moderno -->
            <div class="text-center py-24">
                <div class="max-w-lg mx-auto">
                    <!-- Ilustración SVG -->
                    <div class="w-36 h-36 mx-auto mb-10 bg-black rounded-full flex items-center justify-center shadow-xl">
                        <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-bold text-black mb-6 tracking-tight">No encontramos productos</h2>
                    <p class="text-lg md:text-xl text-gray-600 mb-10 leading-relaxed max-w-md mx-auto">
                        Lo sentimos, no hay productos que coincidan con tus criterios de búsqueda. 
                        Prueba ajustando los filtros o explorando nuestras categorías.
                    </p>
                    
                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button id="clear-all-filters" class="bg-black text-white px-10 py-5 rounded-2xl hover:bg-gray-900 transition-all duration-300 font-bold uppercase text-sm tracking-wider shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Limpiar Filtros
                        </button>
                        <a href="<?php echo home_url(); ?>" class="bg-white border-2 border-black text-black px-10 py-5 rounded-2xl hover:bg-black hover:text-white transition-all duration-300 font-bold uppercase text-sm tracking-wider">
                            Volver al Inicio
                        </a>
                    </div>
                    
                    <!-- Sugerencias -->
                    <div class="mt-14 p-8 bg-gray-50 rounded-3xl border-2 border-gray-200">
                        <h3 class="font-bold text-black mb-6 text-lg tracking-tight">Sugerencias de búsqueda:</h3>
                        <div class="flex flex-wrap gap-3 justify-center">
                            <span class="bg-white px-5 py-3 rounded-full text-sm font-bold text-gray-700 border-2 border-gray-300 hover:border-black hover:bg-black hover:text-white transition-all cursor-pointer">Pantallas</span>
                            <span class="bg-white px-5 py-3 rounded-full text-sm font-bold text-gray-700 border-2 border-gray-300 hover:border-black hover:bg-black hover:text-white transition-all cursor-pointer">Baterías</span>
                            <span class="bg-white px-5 py-3 rounded-full text-sm font-bold text-gray-700 border-2 border-gray-300 hover:border-black hover:bg-black hover:text-white transition-all cursor-pointer">Herramientas</span>
                            <span class="bg-white px-5 py-3 rounded-full text-sm font-bold text-gray-700 border-2 border-gray-300 hover:border-black hover:bg-black hover:text-white transition-all cursor-pointer">Soldadura</span>
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

/* Estilo personalizado para el selector de ordenamiento - Black Theme */
.woocommerce-ordering select {
    padding: 12px 16px !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 0.75rem !important;
    background-color: white !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    color: #000000 !important;
    min-width: 180px !important;
    max-width: 220px !important;
    appearance: none !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='2.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e") !important;
    background-position: right 12px center !important;
    background-repeat: no-repeat !important;
    background-size: 18px 18px !important;
    transition: all 0.3s ease !important;
}

.woocommerce-ordering select:focus {
    outline: none !important;
    border-color: #000000 !important;
    box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1) !important;
}

.woocommerce-ordering select:hover {
    border-color: #000000 !important;
    background-color: #f9fafb !important;
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
    const baseGridClasses = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6';



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
            const homeUrl = new URL(window.location.origin);
            homeUrl.searchParams.set('s', query.trim());
            homeUrl.searchParams.set('post_type', 'product');
            window.location.href = homeUrl.toString();
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

// Price Slider Functionality
document.addEventListener('DOMContentLoaded', function() {
    const minSlider = document.getElementById('min-price-slider');
    const maxSlider = document.getElementById('max-price-slider');
    const minInput = document.getElementById('sidebar-min-price');
    const maxInput = document.getElementById('sidebar-max-price');
    const minDisplay = document.getElementById('min-price-display');
    const maxDisplay = document.getElementById('max-price-display');
    const sliderRange = document.getElementById('price-slider-range');
    
    if (!minSlider || !maxSlider) return;
    
    const minPrice = parseInt(minSlider.min);
    const maxPrice = parseInt(minSlider.max);
    
    function updateSliderUI() {
        const minVal = parseInt(minSlider.value);
        const maxVal = parseInt(maxSlider.value);
        
        // Asegurar que min no sea mayor que max
        if (minVal >= maxVal) {
            minSlider.value = maxVal - 100;
        }
        if (maxVal <= minVal) {
            maxSlider.value = minVal + 100;
        }
        
        const currentMin = parseInt(minSlider.value);
        const currentMax = parseInt(maxSlider.value);
        
        // Actualizar displays
        minDisplay.textContent = currentMin.toLocaleString();
        maxDisplay.textContent = currentMax.toLocaleString();
        
        // Actualizar inputs ocultos
        if (minInput) minInput.value = currentMin;
        if (maxInput) maxInput.value = currentMax;
        
        // Actualizar barra visual
        const percentMin = ((currentMin - minPrice) / (maxPrice - minPrice)) * 100;
        const percentMax = ((currentMax - minPrice) / (maxPrice - minPrice)) * 100;
        
        sliderRange.style.left = percentMin + '%';
        sliderRange.style.width = (percentMax - percentMin) + '%';
    }
    
    // Event listeners para sliders
    minSlider.addEventListener('input', updateSliderUI);
    maxSlider.addEventListener('input', updateSliderUI);
    
    // Inicializar
    updateSliderUI();
});

// Toggle Categories Functionality
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggle-categories');
    const moreCategories = document.querySelectorAll('.more-category');
    const toggleText = document.getElementById('toggle-text');
    const toggleIcon = document.getElementById('toggle-icon');
    
    if (toggleButton && moreCategories.length > 0) {
        let isExpanded = false;
        
        toggleButton.addEventListener('click', function() {
            isExpanded = !isExpanded;
            
            if (isExpanded) {
                // Mostrar categorías adicionales
                moreCategories.forEach(category => {
                    category.classList.remove('hidden');
                });
                toggleText.textContent = 'Ver menos categorías';
                toggleIcon.style.transform = 'rotate(180deg)';
                
            } else {
                // Ocultar categorías adicionales
                moreCategories.forEach(category => {
                    category.classList.add('hidden');
                });
                toggleText.textContent = 'Ver más categorías';
                toggleIcon.style.transform = 'rotate(0deg)';
            }
        });
    }
});
</script>

<style>
    /* Price Slider Styles - Black Theme */
    .price-slider-container {
        position: relative;
        margin: 0.5rem 0;
    }
    
    .price-slider-track {
        position: relative;
        height: 8px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 999px;
    }
    
    .price-slider-input {
        position: absolute;
        width: 100%;
        height: 8px;
        background: transparent;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        outline: none;
        pointer-events: none;
        z-index: 2;
    }
    
    .price-slider-input::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        pointer-events: all;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 3px solid #ffffff;
        background: #000000;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        transition: all 0.2s ease;
    }
    
    .price-slider-input::-webkit-slider-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 6px 20px rgba(255, 255, 255, 0.4);
    }
    
    .price-slider-input::-moz-range-thumb {
        pointer-events: all;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 3px solid #ffffff;
        background: #000000;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        transition: all 0.2s ease;
        -moz-appearance: none;
    }
    
    .price-slider-input::-moz-range-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 6px 20px rgba(255, 255, 255, 0.4);
    }
    
    .price-slider-input::-moz-range-track {
        background: transparent;
        border: none;
    }
    
    .price-slider-input:active::-webkit-slider-thumb {
        transform: scale(1.25);
    }
    
    .price-slider-input:active::-moz-range-thumb {
        transform: scale(1.25);
    }
    
    /* Hero search bar styles */
    #hero-search:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }
    
    #hero-search::placeholder {
        color: #9ca3af;
    }
    
    /* Select styling */
    select[name="product_cat"]:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }
    
    /* Mobile responsive */
    @media (max-width: 640px) {
        .flex.flex-col.sm\\:flex-row form {
            flex-direction: column;
        }
        
        .hidden.sm\\:block {
            display: none;
        }
    }
    
    /* Grid responsive improvements */
    @media (min-width: 1600px) {
        .microscopios-grid {
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }
    }
    
    @media (min-width: 2000px) {
        .microscopios-grid {
            grid-template-columns: repeat(6, minmax(0, 1fr));
        }
    }
    
    /* Swiper Navigation Buttons */
    .popular-products-swiper {
        padding-bottom: 50px !important;
        position: relative;
    }
    
    .popular-products-swiper .swiper-button-next,
    .popular-products-swiper .swiper-button-prev {
        color: white !important;
        width: 48px !important;
        height: 48px !important;
        background: #000 !important;
        border-radius: 50% !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
        z-index: 10 !important;
    }
    
    .popular-products-swiper .swiper-button-next:hover,
    .popular-products-swiper .swiper-button-prev:hover {
        background: #1f2937 !important;
        transform: scale(1.1);
    }
    
    .popular-products-swiper .swiper-button-next:after,
    .popular-products-swiper .swiper-button-prev:after {
        font-size: 18px !important;
        font-weight: bold !important;
        color: white !important;
    }
    
    .popular-pagination {
        bottom: 0 !important;
        margin-top: 30px !important;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
        color: white !important;
        width: 48px !important;
        height: 48px !important;
        background: #000 !important;
        border-radius: 50% !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
    }
    
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: #1f2937 !important;
        transform: scale(1.1);
    }
    
    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 18px !important;
        font-weight: bold !important;
    }
    
    /* Swiper Pagination */
    .swiper-pagination-bullet {
        background: #000 !important;
        opacity: 0.3 !important;
        width: 12px !important;
        height: 12px !important;
        transition: all 0.3s ease !important;
    }
    
    .swiper-pagination-bullet:hover {
        opacity: 0.6 !important;
    }
    
    .swiper-pagination-bullet-active {
        opacity: 1 !important;
        width: 32px !important;
        border-radius: 6px !important;
    }
</style>

<!-- Swiper Carousel Initialization -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Popular Products Swiper
    if (document.querySelector('.popular-products-swiper')) {
        new Swiper('.popular-products-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            loop: true,
            navigation: {
                nextEl: '.popular-products-swiper .popular-next',
                prevEl: '.popular-products-swiper .popular-prev',
            },
            pagination: {
                el: '.popular-products-swiper .popular-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 24,
                },
                1280: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                },
                1536: {
                    slidesPerView: 6,
                    spaceBetween: 30,
                },
            },
        });
    }
    
    // Categories Swiper
    if (document.querySelector('.categories-swiper')) {
        new Swiper('.categories-swiper', {
            slidesPerView: 2,
            spaceBetween: 16,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            loop: true,
            pagination: {
                el: '.categories-swiper .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 24,
                },
                1280: {
                    slidesPerView: 6,
                    spaceBetween: 30,
                },
            },
        });
    }
});
</script>

<?php get_footer( 'shop' ); ?>






