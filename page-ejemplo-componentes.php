<?php
/**
 * Ejemplo de página usando componentes reutilizables
 * Template Name: Página de Productos con Componentes
 */

get_header();

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

// Crear consulta para productos de microscopios
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
    // Lógica de filtros (copiada del archivo original)
    // ... (aquí iría toda la lógica de procesamiento de filtros)
}

// Paginación
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged'] = $paged;

// Crear la consulta
$products_query = new WP_Query($args);

// Configurar argumentos para Products Content
$products_args = array(
    'products_query' => $products_query,
    'show_filters' => true,
    'show_view_toggle' => true,
    'show_table_filters' => true,
    'search_term' => 'microscopios',
    'no_products_title' => 'No encontramos microscopios',
    'no_products_description' => 'No hay microscopios que coincidan con tus criterios de búsqueda. Prueba ajustando los filtros.',
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

<!-- Hero Section -->
<?php include(get_template_directory() . '/includes/hero-section.php'); ?>

<!-- Breadcrumb -->
<?php include(get_template_directory() . '/includes/breadcrumb.php'); ?>

<!-- Products Content -->
<?php include(get_template_directory() . '/includes/products-content.php'); ?>

<?php
// Scripts y estilos específicos de la página
add_action('wp_footer', function() {
    ?>
    <script>
        // JavaScript específico de la página
        // ... (aquí iría todo el JavaScript necesario)
    </script>

    <style>
        /* CSS específico de la página */
        /* ... (aquí irían todos los estilos CSS necesarios) */
    </style>
    <?php
});

get_footer();
?>