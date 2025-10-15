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
    's' => 'microscopios',
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

    // Crear la consulta personalizada
    $products_query = new WP_Query($args);
} else {
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
}

// Debug: Mostrar información de la consulta si estamos en modo debug
if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('Microscopios Query Args: ' . print_r($args, true));
    error_log('Found Posts: ' . $products_query->found_posts);
    error_log('URL Parameters: ' . print_r($_GET, true));
}

?>

<?php
// Configurar argumentos para Hero Section
$hero_args = array(
    'title' => 'Microscopios para',
    'subtitle' => 'Reparación de Celulares',
    'description' => 'Herramientas de alta precisión para técnicos especializados en reparación de dispositivos móviles, soldadura SMD y microelectrónica',
    'search_placeholder' => 'Buscar microscopios por modelo, marca o características...',
    'show_category_selector' => true,
    'background_gradient' => 'from-blue-50 via-indigo-50 to-white',
    'border_color' => 'border-blue-100',
    'gradient_colors' => 'from-blue-600 to-indigo-600'
);
?>

<!-- Hero Section -->
<?php include(get_template_directory() . '/includes/hero-section.php'); ?>

<?php
// Configurar breadcrumbs personalizados
$breadcrumb_args = array(
    'breadcrumbs' => array(
        array(
            'url' => home_url(),
            'title' => 'Inicio',
            'active' => false
        ),
        array(
            'url' => wc_get_page_permalink('shop'),
            'title' => 'Tienda',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => 'Microscopios',
            'active' => true
        )
    )
);
?>

<!-- Breadcrumb -->
<?php include(get_template_directory() . '/includes/breadcrumb.php'); ?>

<?php
// Configurar argumentos para Products Content
$products_args = array(
    'products_query' => $products_query,
    'show_filters' => true,
    'show_view_toggle' => true,
    'show_table_filters' => true,
    'search_term' => 'microscopios',
    'no_products_title' => 'No encontramos microscopios',
    'no_products_description' => 'Lo sentimos, no hay microscopios que coincidan con tus criterios de búsqueda. Prueba ajustando los filtros o explorando nuestras categorías.',
    'suggested_searches' => array(
        'Microscopio soldadura',
        'Lupa binocular', 
        'Microscopio digital',
        'Microscopio SMD',
        'Microscopio PCB'
    ),
    'container_classes' => 'bg-gray-50 min-h-screen py-8'
);
?>

<!-- Products Content -->
<?php include(get_template_directory() . '/includes/products-content.php'); ?>

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

/* Fix para algunos temas que pueden causar problemas de layout */
.woocommerce .woocommerce-ordering {
    margin-bottom: 0 !important;
}

/* El problema principal era el ancho del main en desktop */
@media (min-width: 1280px) {
    main.flex-1 {
        width: auto;
        max-width: none;
    }
}

/* Grid responsive classes custom */
@media (min-width: 1536px) {
    .\\32xl\\:grid-cols-5 {
        grid-template-columns: repeat(5, minmax(0, 1fr));
    }
    .\\32xl\\:grid-cols-6 {
        grid-template-columns: repeat(6, minmax(0, 1fr));
    }
    .\\32xl\\:grid-cols-7 {
        grid-template-columns: repeat(7, minmax(0, 1fr));
    }
}

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

/* Hero search bar styles */
#hero-search:focus {
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1) !important;
    border-color: #3b82f6 !important;
}

#hero-search::placeholder {
    color: #9ca3af;
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
                e.preventDefault();
                performSearch(heroSearch.value);
            }
        });

        const searchBtn = heroSearch.nextElementSibling;
        if (searchBtn && searchBtn.type === 'submit') {
            searchBtn.addEventListener('click', function(e) {
                e.preventDefault();
                performSearch(heroSearch.value);
            });
        }
    }

    function performSearch(searchTerm) {
        const currentUrl = new URL(window.location);
        currentUrl.searchParams.set('s', searchTerm);
        currentUrl.searchParams.set('post_type', 'product');
        window.location.href = currentUrl.toString();
    }

    // Funcionalidad de filtros móviles
    if (toggleFiltersBtn && filtersSidebar) {
        toggleFiltersBtn.addEventListener('click', function() {
            filtersSidebar.classList.remove('hidden');
        });
    }

    if (closeFiltersBtn && filtersSidebar) {
        closeFiltersBtn.addEventListener('click', function() {
            filtersSidebar.classList.add('hidden');
        });
    }

    // Cerrar filtros al hacer clic fuera
    if (filtersSidebar) {
        filtersSidebar.addEventListener('click', function(e) {
            if (e.target === filtersSidebar) {
                filtersSidebar.classList.add('hidden');
            }
        });
    }

    // Funcionalidad cambio de vista
    if (gridViewBtn && tableViewBtn && productsGrid && productsTable) {
        gridViewBtn.addEventListener('click', function() {
            productsGrid.classList.remove('hidden');
            productsTable.classList.add('hidden');
            if (tableFilters) tableFilters.classList.add('hidden');
            
            gridViewBtn.classList.add('active', 'bg-blue-600', 'text-white');
            gridViewBtn.classList.remove('text-gray-600');
            tableViewBtn.classList.remove('active', 'bg-blue-600', 'text-white');
            tableViewBtn.classList.add('text-gray-600');
        });

        tableViewBtn.addEventListener('click', function() {
            productsTable.classList.remove('hidden');
            productsGrid.classList.add('hidden');
            if (tableFilters) tableFilters.classList.remove('hidden');
            
            tableViewBtn.classList.add('active', 'bg-blue-600', 'text-white');
            tableViewBtn.classList.remove('text-gray-600');
            gridViewBtn.classList.remove('active', 'bg-blue-600', 'text-white');
            gridViewBtn.classList.add('text-gray-600');
        });
    }

    // Funcionalidad del slider de precio
    const minPriceSlider = document.getElementById('min-price-slider');
    const maxPriceSlider = document.getElementById('max-price-slider');
    const minPriceDisplay = document.getElementById('min-price-display');
    const maxPriceDisplay = document.getElementById('max-price-display');
    const priceSliderRange = document.getElementById('price-slider-range');

    if (minPriceSlider && maxPriceSlider && minPriceDisplay && maxPriceDisplay && priceSliderRange) {
        function updatePriceSlider() {
            const minVal = parseInt(minPriceSlider.value);
            const maxVal = parseInt(maxPriceSlider.value);
            const minRange = parseInt(minPriceSlider.min);
            const maxRange = parseInt(minPriceSlider.max);

            if (minVal > maxVal - 100) {
                minPriceSlider.value = maxVal - 100;
                return;
            }

            if (maxVal < minVal + 100) {
                maxPriceSlider.value = minVal + 100;
                return;
            }

            minPriceDisplay.textContent = minVal.toLocaleString();
            maxPriceDisplay.textContent = maxVal.toLocaleString();

            const leftPercent = ((minVal - minRange) / (maxRange - minRange)) * 100;
            const rightPercent = ((maxVal - minRange) / (maxRange - minRange)) * 100;

            priceSliderRange.style.left = leftPercent + '%';
            priceSliderRange.style.width = (rightPercent - leftPercent) + '%';
        }

        minPriceSlider.addEventListener('input', updatePriceSlider);
        maxPriceSlider.addEventListener('input', updatePriceSlider);

        updatePriceSlider();
    }

    // Funcionalidad de aplicar filtros de precio
    if (applyFiltersBtn || applyPriceBtn) {
        const applyBtn = applyFiltersBtn || applyPriceBtn;
        applyBtn.addEventListener('click', function() {
            const minPrice = minPriceSlider ? minPriceSlider.value : '';
            const maxPrice = maxPriceSlider ? maxPriceSlider.value : '';
            
            const currentUrl = new URL(window.location);
            
            if (minPrice) currentUrl.searchParams.set('min_price', minPrice);
            if (maxPrice) currentUrl.searchParams.set('max_price', maxPrice);
            
            window.location.href = currentUrl.toString();
        });
    }

    // Funcionalidad de limpiar filtros
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function() {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.delete('min_price');
            currentUrl.searchParams.delete('max_price');
            currentUrl.searchParams.delete('product_cat');
            currentUrl.searchParams.delete('orderby');
            
            window.location.href = currentUrl.toString();
        });
    }

    if (clearAllFiltersBtn) {
        clearAllFiltersBtn.addEventListener('click', function() {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.delete('min_price');
            currentUrl.searchParams.delete('max_price');
            currentUrl.searchParams.delete('product_cat');
            currentUrl.searchParams.delete('orderby');
            currentUrl.searchParams.delete('s');
            
            window.location.href = currentUrl.toString();
        });
    }

    // Funcionalidad de ordenamiento
    const sortSelect = document.getElementById('sort-products');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const currentUrl = new URL(window.location);
            
            if (this.value) {
                currentUrl.searchParams.set('orderby', this.value);
            } else {
                currentUrl.searchParams.delete('orderby');
            }
            
            window.location.href = currentUrl.toString();
        });
    }

    // Funcionalidad de filtros de tabla
    const tableSearch = document.getElementById('table-search');
    const stockFilter = document.getElementById('stock-filter');
    const maxPriceFilter = document.getElementById('max-price-filter');
    const applyTableFiltersBtn = document.getElementById('apply-filters-btn');
    const clearTableFiltersBtn = document.getElementById('clear-table-filters');

    function filterTableRows() {
        const searchTerm = tableSearch ? tableSearch.value.toLowerCase() : '';
        const stockStatus = stockFilter ? stockFilter.value : '';
        const maxPrice = maxPriceFilter ? parseFloat(maxPriceFilter.value) || Infinity : Infinity;

        const rows = document.querySelectorAll('#table-body .product-row');

        rows.forEach(row => {
            const productName = row.dataset.name || '';
            const productPrice = parseFloat(row.dataset.price) || 0;
            const productStock = row.dataset.stock || '';

            let show = true;

            if (searchTerm && !productName.includes(searchTerm)) {
                show = false;
            }

            if (stockStatus && productStock !== stockStatus) {
                show = false;
            }

            if (productPrice > maxPrice) {
                show = false;
            }

            row.style.display = show ? '' : 'none';
        });
    }

    if (applyTableFiltersBtn) {
        applyTableFiltersBtn.addEventListener('click', filterTableRows);
    }

    if (clearTableFiltersBtn) {
        clearTableFiltersBtn.addEventListener('click', function() {
            if (tableSearch) tableSearch.value = '';
            if (stockFilter) stockFilter.value = '';
            if (maxPriceFilter) maxPriceFilter.value = '';
            
            const rows = document.querySelectorAll('#table-body .product-row');
            rows.forEach(row => {
                row.style.display = '';
            });
        });
    }

    // Funcionalidad "Ver más categorías"
    const toggleMoreCategoriesBtn = document.getElementById('toggle-more-categories');
    const moreCategoriesDiv = document.getElementById('more-categories');

    if (toggleMoreCategoriesBtn && moreCategoriesDiv) {
        toggleMoreCategoriesBtn.addEventListener('click', function() {
            const isHidden = moreCategoriesDiv.classList.contains('hidden');
            
            if (isHidden) {
                moreCategoriesDiv.classList.remove('hidden');
                toggleMoreCategoriesBtn.textContent = 'Ver menos categorías';
            } else {
                moreCategoriesDiv.classList.add('hidden');
                toggleMoreCategoriesBtn.textContent = 'Ver más categorías';
            }
        });
    }
});
</script>

<?php get_footer( 'shop' ); ?>