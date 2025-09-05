<?php
/**
 * The template for displaying product category archives.
 * 
 * Template for WooCommerce product categories - ITOOLS MX
 *
 * @package ITOOLS_Child_Theme
 */

get_header(); 

// Obtener la categoría actual
$queried_object = get_queried_object();
$category_name = $queried_object->name;
$category_slug = $queried_object->slug;
$category_description = $queried_object->description;

// Mapear iconos y colores por categoría
$category_config = [
    'refacciones' => [
        'icon' => '🔧',
        'gradient' => 'from-orange-500 to-red-500',
        'bg_gradient' => 'from-orange-50 to-red-50',
        'border' => 'border-orange-200'
    ],
    'herramientas' => [
        'icon' => '🛠️',
        'gradient' => 'from-blue-500 to-purple-500',
        'bg_gradient' => 'from-blue-50 to-purple-50',
        'border' => 'border-blue-200'
    ],
    'pantallas' => [
        'icon' => '📱',
        'gradient' => 'from-green-500 to-emerald-500',
        'bg_gradient' => 'from-green-50 to-emerald-50',
        'border' => 'border-green-200'
    ],
    'baterias' => [
        'icon' => '🔋',
        'gradient' => 'from-yellow-500 to-amber-500',
        'bg_gradient' => 'from-yellow-50 to-amber-50',
        'border' => 'border-yellow-200'
    ],
    'cargadores' => [
        'icon' => '⚡',
        'gradient' => 'from-purple-500 to-pink-500',
        'bg_gradient' => 'from-purple-50 to-pink-50',
        'border' => 'border-purple-200'
    ],
    'accesorios' => [
        'icon' => '🎯',
        'gradient' => 'from-indigo-500 to-blue-500',
        'bg_gradient' => 'from-indigo-50 to-blue-50',
        'border' => 'border-indigo-200'
    ]
];

$config = $category_config[$category_slug] ?? $category_config['refacciones'];
?>

<style>
/* Estilos específicos para garantizar que el diseño funcione correctamente */
.bg-gradient-to-br { background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)) !important; }
.from-blue-900 { --tw-gradient-from: #1e3a8a !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(30, 58, 138, 0)) !important; }
.via-purple-900 { --tw-gradient-stops: var(--tw-gradient-from), #581c87, var(--tw-gradient-to, rgba(88, 28, 135, 0)) !important; }
.to-blue-900 { --tw-gradient-to: #1e3a8a !important; }
.bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)) !important; }

/* Productos grid responsive */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

@media (max-width: 768px) {
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }
}

/* Cards de productos */
.product-card {
    background: white;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.product-image {
    height: 200px;
    overflow: hidden;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

/* Filtros de productos */
.filters-container {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

/* Estilos para WooCommerce */
.woocommerce ul.products {
    display: grid !important;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)) !important;
    gap: 2rem !important;
    list-style: none !important;
    padding: 0 !important;
    margin: 2rem 0 !important;
}

.woocommerce ul.products li.product {
    background: white !important;
    border-radius: 1rem !important;
    overflow: hidden !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    transition: all 0.3s ease !important;
    border: 1px solid #e5e7eb !important;
    padding: 0 !important;
    margin: 0 !important;
    width: auto !important;
    float: none !important;
}

.woocommerce ul.products li.product:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
}

.woocommerce ul.products li.product a {
    text-decoration: none !important;
    display: block !important;
}

.woocommerce ul.products li.product .woocommerce-loop-product__title {
    font-size: 1.125rem !important;
    font-weight: 600 !important;
    color: #1f2937 !important;
    padding: 1rem !important;
    margin: 0 !important;
    line-height: 1.4 !important;
}

.woocommerce ul.products li.product .price {
    color: #059669 !important;
    font-weight: 700 !important;
    font-size: 1.25rem !important;
    padding: 0 1rem 1rem 1rem !important;
    margin: 0 !important;
}

.woocommerce ul.products li.product .price del {
    color: #9ca3af !important;
    font-weight: 400 !important;
}

.woocommerce ul.products li.product img {
    width: 100% !important;
    height: 200px !important;
    object-fit: cover !important;
    transition: transform 0.3s ease !important;
}

.woocommerce ul.products li.product:hover img {
    transform: scale(1.05) !important;
}

.woocommerce ul.products li.product .button {
    width: calc(100% - 2rem) !important;
    margin: 0 1rem 1rem 1rem !important;
    background: linear-gradient(to right, #2563eb, #9333ea) !important;
    color: white !important;
    border: none !important;
    border-radius: 0.5rem !important;
    padding: 0.75rem !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    text-align: center !important;
}

.woocommerce ul.products li.product .button:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2) !important;
}

/* Navegación y filtros de WooCommerce */
.woocommerce-ordering,
.woocommerce-result-count {
    font-size: 0.875rem !important;
    color: #6b7280 !important;
    margin-bottom: 1rem !important;
}

.woocommerce nav.woocommerce-pagination {
    text-align: center !important;
    margin-top: 3rem !important;
}

.woocommerce nav.woocommerce-pagination ul {
    display: inline-flex !important;
    gap: 0.5rem !important;
    border: none !important;
}

.woocommerce nav.woocommerce-pagination ul li {
    margin: 0 !important;
}

.woocommerce nav.woocommerce-pagination ul li a,
.woocommerce nav.woocommerce-pagination ul li span {
    padding: 0.75rem 1rem !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 0.5rem !important;
    color: #374151 !important;
    text-decoration: none !important;
    transition: all 0.3s ease !important;
}

.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current {
    background: linear-gradient(to right, #2563eb, #9333ea) !important;
    color: white !important;
    border-color: transparent !important;
}
</style>

<!-- Hero Section de la Categoría -->
<section class="relative overflow-hidden py-20" style="background: linear-gradient(135deg, #1e3a8a 0%, #581c87 50%, #1e3a8a 100%);">
    <!-- Efectos de fondo -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-72 h-72 rounded-full opacity-20" style="background: #3b82f6; filter: blur(40px); animation: pulse 2s infinite;"></div>
        <div class="absolute bottom-0 right-1/4 w-72 h-72 rounded-full opacity-20" style="background: #8b5cf6; filter: blur(40px); animation: pulse 2s infinite;"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center">
            <div class="inline-flex items-center text-white px-6 py-3 rounded-full font-semibold mb-6" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px);">
                <span class="text-2xl mr-3"><?php echo $config['icon']; ?></span>
                CATEGORÍA DE PRODUCTOS
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 capitalize">
                <?php echo esc_html($category_name); ?>
            </h1>
            <?php if ($category_description) : ?>
                <p class="text-xl text-white opacity-80 max-w-2xl mx-auto">
                    <?php echo wp_kses_post($category_description); ?>
                </p>
            <?php else : ?>
                <p class="text-xl text-white opacity-80 max-w-2xl mx-auto">
                    Descubre nuestra selección de <?php echo esc_html(strtolower($category_name)); ?> de alta calidad para técnicos profesionales
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Navegación de breadcrumbs -->
<section class="py-6 bg-gray-50">
    <div class="container mx-auto px-4">
        <nav class="flex items-center space-x-2 text-sm text-gray-600">
            <a href="<?php echo home_url(); ?>" class="hover:text-blue-600 transition-colors">Inicio</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="hover:text-blue-600 transition-colors">Tienda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900 font-medium capitalize"><?php echo esc_html($category_name); ?></span>
        </nav>
    </div>
</section>

<!-- Contenido Principal -->
<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        
        <!-- Filtros y ordenamiento -->
        <div class="filters-container">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-semibold text-gray-900">Filtrar productos:</span>
                    <?php
                    // Mostrar el resultado de WooCommerce si existe
                    if (function_exists('woocommerce_result_count')) {
                        woocommerce_result_count();
                    }
                    ?>
                </div>
                
                <div class="flex items-center space-x-4">
                    <?php
                    // Mostrar el ordenamiento de WooCommerce si existe
                    if (function_exists('woocommerce_catalog_ordering')) {
                        woocommerce_catalog_ordering();
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Grid de productos -->
        <div class="products-section">
            <?php if (have_posts()) : ?>
                
                <?php
                // Hook antes del loop de productos
                do_action('woocommerce_before_shop_loop');
                
                // Comenzar el loop de productos
                woocommerce_product_loop_start();
                
                while (have_posts()) :
                    the_post();
                    
                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action('woocommerce_shop_loop');
                    
                    wc_get_template_part('content', 'product');
                    
                endwhile;
                
                woocommerce_product_loop_end();
                
                /**
                 * Hook: woocommerce_after_shop_loop.
                 */
                do_action('woocommerce_after_shop_loop');
                ?>
                
            <?php else : ?>
                
                <!-- No hay productos -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-8 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);">
                        <span class="text-4xl"><?php echo $config['icon']; ?></span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No se encontraron productos</h3>
                    <p class="text-gray-600 mb-8">No hay productos disponibles en esta categoría en este momento.</p>
                    <a href="<?php echo wc_get_page_permalink('shop'); ?>" 
                       class="inline-flex items-center text-white px-8 py-4 text-lg font-semibold rounded-full transition-all duration-300 shadow-lg"
                       style="background: linear-gradient(to right, #2563eb, #9333ea);"
                       onmouseover="this.style.transform='scale(1.05)'"
                       onmouseout="this.style.transform='scale(1)'">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Ver todos los productos
                    </a>
                </div>
                
            <?php endif; ?>
        </div>

        <!-- Categorías relacionadas -->
        <div class="mt-16">
            <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Otras categorías que te pueden interesar</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php
                $other_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'exclude' => array($queried_object->term_id), // Excluir la categoría actual
                    'number' => 4
                ));
                
                if ($other_categories && !is_wp_error($other_categories)) :
                    foreach ($other_categories as $cat) :
                        $cat_config = $category_config[$cat->slug] ?? $category_config['refacciones'];
                ?>
                    <a href="<?php echo get_term_link($cat); ?>" 
                       class="bg-gradient-to-br <?php echo $cat_config['bg_gradient']; ?> border <?php echo $cat_config['border']; ?> rounded-xl p-6 text-center hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <div class="text-3xl mb-3"><?php echo $cat_config['icon']; ?></div>
                        <h4 class="font-semibold text-gray-900 capitalize"><?php echo esc_html($cat->name); ?></h4>
                        <p class="text-sm text-gray-600 mt-1"><?php echo $cat->count; ?> productos</p>
                    </a>
                <?php 
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Sección de beneficios -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Envío gratis -->
            <div class="text-center p-6">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Envío Express</h3>
                <p class="text-gray-600">Envíos en 24-48 horas a toda la República Mexicana</p>
            </div>

            <!-- Soporte -->
            <div class="text-center p-6">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%);">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Soporte Técnico</h3>
                <p class="text-gray-600">Asesoría especializada para técnicos profesionales</p>
            </div>

            <!-- Garantía -->
            <div class="text-center p-6">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background: linear-gradient(135deg, #fed7aa 0%, #fecaca 100%);">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Garantía Total</h3>
                <p class="text-gray-600">Productos garantizados y servicio post-venta</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
