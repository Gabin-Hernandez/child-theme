<?php
/**
 * Template Name: Página de Microscopios
 * 
 * Template para mostrar productos de microscopios
 */

get_header();

// Agregar metadata SEO específica para microscopios de reparación electrónica
add_action('wp_head', function() {
    echo '<meta name="description" content="Microscopios profesionales para reparación de celulares y dispositivos electrónicos. Microscopios estereoscópicos digitales con cámara, lupas binoculares y equipos especializados para técnicos en reparación móvil.">' . "\n";
    echo '<meta name="keywords" content="microscopio reparacion celulares, microscopio electronica, microscopio soldadura, lupa binocular reparacion, microscopio estereoscopico digital, microscopio SMD, reparacion moviles, microscopio PCB">' . "\n";
    echo '<meta property="og:title" content="Microscopios para Reparación de Celulares y Electrónicos - ITOOLS">' . "\n";
    echo '<meta property="og:description" content="Microscopios especializados para reparación de celulares, soldadura SMD y trabajo de precisión en dispositivos electrónicos">' . "\n";
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
            echo '<meta property="og:image:alt" content="Microscopios para Reparación de Celulares - ITOOLS">' . "\n";
        }
    }
    
    echo '<link rel="canonical" href="' . get_permalink() . '">' . "\n";
    
    // Datos estructurados JSON-LD
    echo '<script type="application/ld+json">' . "\n";
    echo json_encode(array(
        "@context" => "https://schema.org",
        "@type" => "CollectionPage",
        "name" => "Microscopios para Reparación de Celulares y Electrónicos",
        "description" => "Microscopios especializados para reparación de celulares, soldadura SMD, PCB y dispositivos electrónicos. Equipos profesionales para técnicos en reparación móvil.",
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
                    "name" => "Microscopios para Reparación Electrónica"
                )
            )
        )
    ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    echo '</script>' . "\n";
});

// Crear consulta para productos de microscopios de reparación
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'post_status' => 'publish',
    's' => 'microscopios', // Búsqueda específica para reparación
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

// Debug: Mostrar información de la consulta si estamos en modo debug
if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('Microscopios Query Args: ' . print_r($args, true));
    error_log('Found Posts: ' . $products_query->found_posts);
    error_log('URL Parameters: ' . print_r($_GET, true));
}

?>

<!-- Header profesional y limpio -->
<div class="bg-white border-b border-gray-100">
    <div class="w-11/12 2xl:w-10/12 2xl:max-w-[1920px] mx-auto px-4 xl:px-6 2xl:px-8 py-12">
        <div class="max-w-4xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Microscopios para Reparación de Celulares
            </h1>
            <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                Equipos de precisión profesionales para técnicos especializados en reparación de dispositivos móviles y soldadura SMD.
            </p>
            
            <!-- Barra de búsqueda integrada -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex flex-col lg:flex-row gap-4">
                    <input type="hidden" name="post_type" value="product">
                    <div class="flex-1">
                        <input type="text" 
                               name="s" 
                               value="<?php echo get_search_query(); ?>"
                               placeholder="Buscar por modelo o características..."
                               class="w-full px-6 py-4 text-lg border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                    </div>
                    <select name="product_cat" class="px-6 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 lg:min-w-[200px]">
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
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Buscar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Breadcrumb limpio -->
<div class="bg-gray-50 border-b border-gray-200">
    <div class="w-11/12 2xl:w-10/12 2xl:max-w-[1920px] mx-auto px-4 xl:px-6 2xl:px-8 py-3">
        <nav class="flex items-center space-x-1 text-sm text-gray-500">
            <a href="<?php echo home_url(); ?>" class="hover:text-gray-700 transition-colors">Inicio</a>
            <span>/</span>
            <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="hover:text-gray-700 transition-colors">Tienda</a>
            <span>/</span>
            <span class="text-gray-900">Microscopios</span>
        </nav>
    </div>
</div>

<div class="bg-gray-50 min-h-screen py-8">
    <div class="w-11/12 2xl:w-10/12 2xl:max-w-[1920px] mx-auto px-4 xl:px-6 2xl:px-8">
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
                
                <!-- Sidebar de filtros limpio -->
                <aside 
                    id="filters-sidebar" 
                    class="lg:w-72 fixed lg:relative inset-0 lg:inset-auto bg-black/50 lg:bg-transparent z-50 lg:z-auto hidden lg:block">
                    <div class="bg-white h-full lg:h-auto p-6 rounded-none lg:rounded-lg shadow-lg lg:shadow-sm overflow-y-auto ml-auto lg:ml-0 w-80 lg:w-full border-0 lg:border border-gray-200 sticky lg:top-6">
                        
                        <!-- Header del sidebar -->
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">
                                Filtros
                            </h3>
                            <button id="close-filters" class="lg:hidden text-gray-500 hover:text-gray-700 p-2 hover:bg-gray-100 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Filtro por Precio -->
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <h4 class="font-medium text-gray-900 mb-4">
                                Precio
                            </h4>
                            
                            <?php
                            // Get dynamic price range
                            $price_range = itools_get_dynamic_price_range();
                            $current_min = isset($_GET['min_price']) ? $_GET['min_price'] : $price_range['min'];
                            $current_max = isset($_GET['max_price']) ? $_GET['max_price'] : $price_range['max'];
                            ?>
                            
                            <!-- Inputs de precio simples -->
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div>
                                    <label class="block text-sm text-gray-600 mb-2">Desde</label>
                                    <input type="number" 
                                           id="sidebar-min-price" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                           placeholder="0"
                                           min="0"
                                           max="<?php echo $price_range['max']; ?>"
                                           value="<?php echo $current_min > 0 ? $current_min : ''; ?>">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-2">Hasta</label>
                                    <input type="number" 
                                           id="sidebar-max-price" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                           placeholder="<?php echo number_format($price_range['max'], 0); ?>"
                                           min="0"
                                           max="<?php echo $price_range['max']; ?>"
                                           value="<?php echo $current_max < $price_range['max'] ? $current_max : ''; ?>">
                                </div>
                            </div>
                            
                            <!-- Rangos rápidos -->
                            <div class="flex flex-wrap gap-2">
                                <button type="button" class="price-preset text-sm px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors" data-min="0" data-max="1000">< $1K</button>
                                <button type="button" class="price-preset text-sm px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors" data-min="1000" data-max="5000">$1K-5K</button>
                                <button type="button" class="price-preset text-sm px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors" data-min="5000" data-max="">$5K+</button>
                            </div>
                        </div>

                        <!-- Filtro por Categorías -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-4">
                                Categorías
                            </h4>
                            
                            <div class="space-y-2">
                                <!-- Enlace para todas las categorías -->
                                <?php 
                                $all_categories_url = home_url('/?post_type=product&s=');
                                $is_all_categories = empty($_GET['product_cat']);
                                ?>
                                <a href="<?php echo esc_url($all_categories_url); ?>" class="block px-3 py-2 text-sm rounded-md transition-colors <?php echo $is_all_categories ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'; ?>">
                                    Todas las categorías
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
                                    <a href="<?php echo esc_url($category_url); ?>" class="flex items-center justify-between px-3 py-2 text-sm rounded-md transition-colors <?php echo $is_current ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'; ?>">
                                        <span><?php echo esc_html( $category->name ); ?></span>
                                        <span class="text-xs text-gray-400"><?php echo $category->count; ?></span>
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
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 3xl:grid-cols-6 gap-6" id="products-grid">
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
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Microscopio soldadura</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Lupa binocular</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Microscopio digital</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Microscopio SMD</span>
                            <span class="bg-white px-4 py-2 rounded-full text-sm text-gray-700 border border-yellow-300">Microscopio PCB</span>
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

/* Breakpoint personalizado para pantallas extra grandes */
@media (min-width: 1920px) {
    .grid-cols-6 {
        grid-template-columns: repeat(6, minmax(0, 1fr));
    }
}

/* El problema principal era el ancho del main en desktop */
@media (min-width: 1280px) {
    main.flex-1 {
        width: auto;
        max-width: none;
    }
}

/* Clases utilitarias para 3xl */
@media (min-width: 1920px) {
    .\\33xl\\:grid-cols-6 {
        grid-template-columns: repeat(6, minmax(0, 1fr));
    }
    .\\33xl\\:grid-cols-7 {
        grid-template-columns: repeat(7, minmax(0, 1fr));
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
    const baseGridClasses = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 3xl:grid-cols-6 gap-6';



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






