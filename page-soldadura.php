<?php
/**
 * Template Name: Página de Soldadura
 * 
 * Template para mostrar productos de soldadura (cautines y estaciones)
 */

get_header();

// Agregar metadata SEO específica para soldadura
add_action('wp_head', function() {
    echo '<meta name="description" content="Equipos de soldadura profesionales: cautines, estaciones de soldadura, aire caliente y accesorios para reparación de celulares y electrónica. Control de temperatura digital y herramientas especializadas.">' . "\n";
    echo '<meta name="keywords" content="soldadura, cautin, estacion soldadura, aire caliente, soldadura electronica, cautin precision, estacion desoldadura, rework station, soldadura SMD, herramientas soldadura">' . "\n";
    echo '<meta property="og:title" content="Equipos de Soldadura Profesionales - Cautines y Estaciones - ITOOLS">' . "\n";
    echo '<meta property="og:description" content="Cautines, estaciones de soldadura y equipos profesionales para reparación de celulares. Control de temperatura, aire caliente y accesorios especializados">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:url" content="' . get_permalink() . '">' . "\n";
    
    // Agregar imagen destacada como og:image
    if (has_post_thumbnail()) {
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'large');
        if ($thumbnail_url) {
            echo '<meta property="og:image" content="' . esc_url($thumbnail_url[0]) . '">' . "\n";
            echo '<meta property="og:image:width" content="' . $thumbnail_url[1] . '">' . "\n";
            echo '<meta property="og:image:height" content="' . $thumbnail_url[2] . '">' . "\n";
            echo '<meta property="og:image:alt" content="Equipos de Soldadura - ITOOLS">' . "\n";
        }
    }
    
    echo '<link rel="canonical" href="' . get_permalink() . '">' . "\n";
    
    // Datos estructurados JSON-LD
    echo '<script type="application/ld+json">' . "\n";
    echo json_encode(array(
        "@context" => "https://schema.org",
        "@type" => "CollectionPage",
        "name" => "Equipos de Soldadura Profesionales",
        "description" => "Cautines y estaciones de soldadura profesionales para reparación de celulares y electrónica. Equipos con control de temperatura, aire caliente y accesorios especializados.",
        "url" => get_permalink(),

        "breadcrumb" => array(
            "@type" => "BreadcrumbList",
            "itemListElement" => array(
                array(
                    "@type" => "ListItem",
                    "position" => 1,
                    "name" => "Inicio",
                    "item" => home_url()
                ),
                array(
                    "@type" => "ListItem", 
                    "position" => 2,
                    "name" => "Tienda",
                    "item" => wc_get_page_permalink('shop')
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 3,
                    "name" => "Soldadura"
                )
            )
        )
    ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    echo '</script>' . "\n";
});

// Simular exactamente lo que hace el buscador normal
// Establecer $_GET temporalmente para que las funciones de búsqueda funcionen
$original_get = $_GET;
$_GET['post_type'] = 'product';
$_GET['s'] = 'soldadura';

// Configurar paginación - verificar tanto query_var como $_GET
$paged = 1;
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (isset($_GET['paged'])) {
    $paged = intval($_GET['paged']);
}
$paged = max(1, $paged);

// Usar la función estándar de WordPress para búsquedas
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 15,
    'post_status' => 'publish',
    's' => 'soldadura',
    'paged' => $paged,
    'tax_query' => array(),
    'meta_query' => array()
);

// Procesar filtros adicionales si existen
$has_additional_filters = !empty($_GET['product_categories']) || 
                         !empty($_GET['min_price']) || !empty($_GET['max_price']) || 
                         !empty($_GET['orderby']) || !empty($_GET['product_cat']);

if ($has_additional_filters) {
    // Procesar filtros de URL
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 15,
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

}

// Paginación
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged'] = $paged;

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

// Crear la consulta
$products_query = new WP_Query($args);

// Restaurar $_GET original
$_GET = $original_get;

// Debug: Mostrar información de la consulta si estamos en modo debug
if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('Soldadura Query Args: ' . print_r($args, true));
    error_log('Found Posts: ' . $products_query->found_posts);
    error_log('URL Parameters: ' . print_r($_GET, true));
}

?>


<div class="relative bg-gradient-to-br from-orange-50 via-red-50 to-white border-b border-orange-100">
    <!-- Patrón sutil -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ff8c42" fill-opacity="0.1"%3E%3Ccircle cx="20" cy="20" r="1"/%3E%3C/g%3E%3C/svg%3E')] opacity-60"></div>
    
    <!-- Contenido -->
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
           
            
            <!-- Título principal -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                Equipos de Soldadura
                <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-red-600">
                    Cautines y Estaciones Profesionales
                </span>
            </h1>
            
            <!-- Descripción -->
            <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Encuentra cautines de precisión y estaciones de soldadura profesionales con control de temperatura digital. Todo para reparación de celulares y electrónica
            </p>
            
            <!-- Barra de búsqueda -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden backdrop-blur-sm">
                    <div method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex flex-col sm:flex-row">
                        <input type="hidden" name="post_type" value="product">
                        
                        <!-- Input de búsqueda -->
                        <div class="flex-1 relative ">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   id="hero-search"
                                   name="s" 
                                   value="<?php echo get_search_query(); ?>"
                                   placeholder="Buscar cautines, estaciones, puntas..."
                                   class="w-full h-full pl-12 pr-4 py-4 text-base border-0 focus:outline-none focus:ring-0 text-gray-900 placeholder-gray-400 bg-white">
                        </div>
                        
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
                                foreach ( $categories as $category ) {
                                    echo '<option value="' . esc_attr( $category->slug ) . '" ' . selected( get_query_var( 'product_cat' ), $category->slug, false ) . '>' . esc_html( $category->name ) . '</option>';
                                }
                                ?>
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Botón de búsqueda -->
                        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-4 font-semibold text-base transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Buscar</span>
                        </button>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<div class="bg-white border-b border-gray-100">
    <div class="w-11/12 py-4 mx-auto 2xl:max-w-[1920px] px-6">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="<?php echo home_url(); ?>" class="text-gray-500 hover:text-gray-700 transition-colors font-medium">Inicio</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="text-gray-500 hover:text-gray-700 transition-colors font-medium">Tienda</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900 font-semibold">Soldadura</span>
        </nav>
    </div>
</div>

<!-- Products Content -->
<div class="bg-gray-50 min-h-screen py-8">
    <div class="w-11/12 2xl:max-w-[1920px] mx-auto px-4 xl:px-6 2xl:px-8">
        <!-- Botón para filtros en móvil - más limpio -->
        <div class="lg:hidden mb-6">
            <button id="toggle-filters" class="flex items-center justify-center gap-2 w-full py-3 px-4 bg-gray-100 hover:bg-gray-200 rounded-lg border border-gray-200 text-gray-700 font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                </svg>
                Filtros
            </button>
        </div>

        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="flex flex-col lg:flex-row gap-6">
                
                <!-- Sidebar de filtros elegante y sticky -->
                <aside 
                    id="filters-sidebar" 
                    class="lg:w-80 fixed lg:relative inset-0 lg:inset-auto bg-black/50 lg:bg-transparent z-50 lg:z-auto hidden lg:block">
                    <div class="bg-white h-full lg:h-auto p-6 rounded-none lg:rounded-2xl shadow-2xl lg:shadow-lg overflow-y-auto ml-auto lg:ml-0 w-80 lg:w-full border-0 lg:border border-gray-200/50 lg:sticky lg:top-4 lg:max-h-[calc(100vh-2rem)]">
                        
                        <!-- Header del sidebar -->
                        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">
                                    Filtros
                                </h3>
                            </div>
                            <button id="close-filters" class="lg:hidden text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-xl transition-all duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Filtro por Precio -->
                        <div class="mb-8 p-5 bg-white rounded-2xl border border-gray-200 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-sm text-gray-800 font-semibold">$<span id="min-price-display"><?php echo number_format($current_min, 0); ?></span></span>
                                    <span class="text-sm text-gray-800 font-semibold">$<span id="max-price-display"><?php echo number_format($current_max, 0); ?></span></span>
                                </div>
                                
                                <div class="relative">
                                    <div class="price-slider-track bg-gray-300 h-2 rounded-full relative">
                                        <div id="price-slider-range" class="absolute h-2 bg-gray-800 rounded-full"></div>
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
                                    
                                    <!-- Inputs ocultos para mantener funcionalidad -->
                                    <input type="hidden" id="sidebar-min-price" value="<?php echo $current_min; ?>">
                                    <input type="hidden" id="sidebar-max-price" value="<?php echo $current_max; ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Filtro por Categorías -->
                        <div class="mb-8 p-5 bg-white rounded-2xl border border-gray-200 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
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
                                   class="flex items-center justify-between p-3 rounded-xl transition-all duration-200 <?php echo $is_all_categories ? 'bg-gray-100 border-gray-300 text-gray-900 font-semibold' : 'bg-gray-50 hover:bg-gray-100 border-transparent hover:border-gray-200 text-gray-700 hover:text-gray-900'; ?> border">
                                    <span class="text-sm font-medium">Todas las categorías</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                
                                <?php
                                $product_categories = get_terms( array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => 0,
                                    'orderby' => 'count',
                                    'order' => 'DESC'
                                ) );

                                if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) :
                                    // Separar las primeras 3 categorías del resto
                                    $top_categories = array_slice($product_categories, 0, 3);
                                    $remaining_categories = array_slice($product_categories, 3);
                                    
                                    // Mostrar las 3 principales
                                    foreach ( $top_categories as $category ) :
                                        // Create correct URL format: ?post_type=product&s=&product_cat=slug
                                        $category_url = home_url('/?post_type=product&s=&product_cat=' . $category->slug);
                                        $is_current = (isset($_GET['product_cat']) && $_GET['product_cat'] === $category->slug);
                                ?>
                                    <a href="<?php echo esc_url($category_url); ?>" 
                                       class="flex items-center justify-between p-3 rounded-xl transition-all duration-200 group <?php echo $is_current ? 'bg-gray-100 border-gray-300 text-gray-900 font-semibold' : 'bg-gray-50 hover:bg-gray-100 border-transparent hover:border-gray-200 text-gray-700 hover:text-gray-900'; ?> border">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-medium"><?php echo esc_html( $category->name ); ?></span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs px-2 py-1 rounded-full <?php echo $is_current ? 'bg-gray-200 text-gray-800' : 'bg-gray-200 text-gray-600 group-hover:bg-gray-300 group-hover:text-gray-700'; ?>"><?php echo $category->count; ?></span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </a>
                                <?php 
                                    endforeach;
                                    
                                    // Mostrar categorías adicionales (ocultas inicialmente)
                                    if (!empty($remaining_categories)) : ?>
                                        <div id="more-categories" class="hidden space-y-2">
                                            <?php foreach ( $remaining_categories as $category ) :
                                                $category_url = home_url('/?post_type=product&s=&product_cat=' . $category->slug);
                                                $is_current = (isset($_GET['product_cat']) && $_GET['product_cat'] === $category->slug);
                                            ?>
                                                <a href="<?php echo esc_url($category_url); ?>" 
                                                   class="flex items-center justify-between p-3 rounded-xl transition-all duration-200 group <?php echo $is_current ? 'bg-gray-100 border-gray-300 text-gray-900 font-semibold' : 'bg-gray-50 hover:bg-gray-100 border-transparent hover:border-gray-200 text-gray-700 hover:text-gray-900'; ?> border">
                                                    <div class="flex items-center gap-3">
                                                        <span class="text-sm font-medium"><?php echo esc_html( $category->name ); ?></span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-xs px-2 py-1 rounded-full <?php echo $is_current ? 'bg-gray-200 text-gray-800' : 'bg-gray-200 text-gray-600 group-hover:bg-gray-300 group-hover:text-gray-700'; ?>"><?php echo $category->count; ?></span>
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                        <!-- Botón para expandir/contraer -->
                                        <button id="toggle-categories" 
                                                class="w-full mt-3 p-3 bg-gray-50 hover:bg-gray-100 border border-gray-200 hover:border-gray-300 rounded-xl transition-all duration-200 flex items-center justify-center gap-2 text-gray-700 hover:text-gray-800 font-medium text-sm group">
                                            <span id="toggle-text">Ver más categorías</span>
                                            <svg id="toggle-icon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                    <?php endif;
                                endif;
                                ?>
                            </div>
                        </div>


                        <!-- Botones de acción -->
                        <div class="space-y-4">
                            <button id="apply-sidebar-filters" 
                                    class="apply-filters w-full bg-gradient-to-r from-orange-600 to-red-600 text-white py-4 rounded-2xl font-bold hover:from-orange-700 hover:to-red-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-3">
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
                            <div class="inline-flex items-center px-4 py-3 bg-orange-50 text-orange-700 rounded-xl border border-orange-200">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-orange-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                                <div class="w-2 h-6 bg-gradient-to-b from-orange-500 to-red-600 rounded-full"></div>
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
                                       class="product-search-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            </div>
                            
                            <!-- Filtro por disponibilidad -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Disponibilidad</label>
                                <select id="stock-filter" class="availability-filter w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    <option value="">Todos</option>
                                    <option value="in-stock">En stock</option>
                                    <option value="out-of-stock">Agotado</option>
                                </select>
                            </div>
                            
                            <!-- Botones de acción -->
                            <div class="flex items-end">
                                <button id="apply-filters-btn" class="apply-filters w-full px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition-colors font-medium">
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
                            <div class="inline-flex items-center px-4 py-2 bg-orange-50 text-orange-700 rounded-lg">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-orange-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                            wc_get_template_part( 'content', 'product' );
                        }

                        woocommerce_product_loop_end();
                        ?>
                    </div>

                    <!-- Vista de tabla compacta -->
                    <div id="products-table" class="hidden">
                        <!-- La tabla se maneja con JS desde los otros templates -->
                    </div>

                    <!-- Paginación personalizada al final de los productos -->
                    <div class="mt-12">
                        <?php
                        // Función de paginación específica para página de soldadura
                        function soldadura_custom_pagination($query) {
                            if ($query->max_num_pages <= 1) return;
                            
                            $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
                            $max_pages = $query->max_num_pages;
                            
                            // URL base fija para la página de soldadura
                            $base_url = home_url('/soldadura/');
                            
                            echo '<div class="custom-pagination-wrapper mt-8 mb-4">';
                            echo '<nav class="custom-pagination flex justify-center items-center space-x-2" role="navigation" aria-label="Navegación de páginas">';
                            
                            // Botón anterior
                            if ($paged > 1) {
                                if ($paged == 2) {
                                    $prev_url = $base_url;
                                } else {
                                    $prev_url = add_query_arg('paged', $paged - 1, $base_url);
                                }
                                echo '<a href="' . esc_url($prev_url) . '" class="pagination-btn prev-btn bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 hover:border-orange-500 transition-all duration-200 flex items-center space-x-2">';
                                echo '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>';
                                echo '<span>Anterior</span>';
                                echo '</a>';
                            }
                            
                            // Números de página
                            $start_page = max(1, $paged - 2);
                            $end_page = min($max_pages, $paged + 2);
                            
                            for ($i = $start_page; $i <= $end_page; $i++) {
                                if ($i == 1) {
                                    $page_url = $base_url;
                                } else {
                                    $page_url = add_query_arg('paged', $i, $base_url);
                                }
                                
                                if ($i == $paged) {
                                    echo '<span class="pagination-btn current-page bg-orange-600 text-white px-3 py-2 rounded-lg font-medium">' . $i . '</span>';
                                } else {
                                    echo '<a href="' . esc_url($page_url) . '" class="pagination-btn page-btn bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-50 hover:border-orange-500 transition-all duration-200">' . $i . '</a>';
                                }
                            }
                            
                            // Botón siguiente
                            if ($paged < $max_pages) {
                                $next_url = add_query_arg('paged', $paged + 1, $base_url);
                                echo '<a href="' . esc_url($next_url) . '" class="pagination-btn next-btn bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 hover:border-orange-500 transition-all duration-200 flex items-center space-x-2">';
                                echo '<span>Siguiente</span>';
                                echo '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
                                echo '</a>';
                            }
                            
                            echo '</nav>';
                            echo '<div class="pagination-info text-center text-sm text-gray-600 mt-4">';
                            echo 'Página ' . $paged . ' de ' . $max_pages . ' (' . $query->found_posts . ' productos en total)';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                        // Usar la función personalizada
                        soldadura_custom_pagination($products_query);
                        ?>
                    </div>

                </main>
            </div>

        <?php else : ?>

            <!-- Estado vacío mejorado -->
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <!-- Ilustración SVG -->
                    <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-orange-100 to-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <button id="clear-all-filters" class="bg-gradient-to-r from-orange-600 to-red-600 text-white px-8 py-4 rounded-2xl hover:from-orange-700 hover:to-red-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Limpiar Filtros
                        </button>
                        <a href="<?php echo home_url(); ?>" class="bg-white border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-2xl hover:border-orange-500 hover:text-orange-600 transition-all duration-300 font-semibold">
                            Volver al Inicio
                        </a>
                    </div>
                    
                    <!-- Sugerencias -->
                    <div class="mt-12 p-6 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl border border-yellow-200">
                        <h3 class="font-bold text-gray-900 mb-4">Sugerencias de búsqueda:</h3>
                        <div class="flex flex-wrap gap-2 justify-center">
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Estación soldadura</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Cautín digital</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Aire caliente</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Puntas soldadura</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Desoldadura</span>
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

<!-- Incluir los mismos scripts que los otros templates -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/price-slider.css">
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/filters.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/table-filters.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/price-slider.js"></script>

<?php get_footer( 'shop' ); ?>
