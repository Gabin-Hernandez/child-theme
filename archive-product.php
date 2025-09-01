<?php
/**
 * Archivo de productos (tienda) - ITOOLS
 */

get_header( 'shop' ); ?>

<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">

        <?php
        /**
         * Hook: woocommerce_before_main_content.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         * @hooked WC_Structured_Data::generate_website_data() - 30
         */
        do_action( 'woocommerce_before_main_content' );
        ?>

        <header class="woocommerce-products-header mb-8">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="woocommerce-products-header__title page-title text-4xl font-bold text-gray-900 mb-4">
                    <?php woocommerce_page_title(); ?>
                </h1>
            <?php endif; ?>

            <?php
            /**
             * Hook: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
            ?>
        </header>

        <!-- Botón para mostrar filtros en móvil -->
        <div class="lg:hidden mb-6">
            <button 
                id="toggle-filters" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                </svg>
                Filtros
            </button>
        </div>

        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Sidebar con filtros -->
                <aside 
                    id="filters-sidebar" 
                    class="lg:w-1/4 fixed lg:relative inset-0 lg:inset-auto bg-black bg-opacity-50 lg:bg-transparent z-50 lg:z-auto hidden lg:block">
                    <div class="bg-white h-full lg:h-auto p-6 rounded-none lg:rounded-lg shadow-lg lg:shadow-sm overflow-y-auto ml-auto lg:ml-0 w-80 lg:w-full">
                        
                        <!-- Header del sidebar (solo móvil) -->
                        <div class="flex justify-between items-center mb-6 lg:hidden">
                            <h3 class="text-xl font-bold text-gray-900">Filtros</h3>
                            <button id="close-filters" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <h3 class="text-lg font-semibold mb-6 hidden lg:block text-gray-900">Filtros</h3>

                        <!-- Filtro por Precio -->
                        <div class="mb-8 border-b border-gray-200 pb-6">
                            <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Rango de Precio
                            </h4>
                            
                            <?php if ( class_exists( 'WC_Widget_Price_Filter' ) ) : ?>
                                <div class="price-filter-widget">
                                    <?php
                                    $widget = new WC_Widget_Price_Filter();
                                    $widget->widget( array(), array() );
                                    ?>
                                </div>
                            <?php else : ?>
                                <!-- Filtro personalizado de precio -->
                                <div class="space-y-3">
                                    <div class="flex gap-3">
                                        <input type="number" 
                                               id="min_price" 
                                               placeholder="Min $" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <input type="number" 
                                               id="max_price" 
                                               placeholder="Max $" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <button id="apply-price-filter" 
                                            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors">
                                        Aplicar
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Filtro por Categorías -->
                        <div class="mb-8 border-b border-gray-200 pb-6">
                            <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                Categorías
                            </h4>
                            
                            <div class="space-y-2 max-h-48 overflow-y-auto">
                                <?php
                                $product_categories = get_terms( array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => 0, // Solo categorías padre
                                ) );

                                if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) :
                                    foreach ( $product_categories as $category ) :
                                        $category_url = get_term_link( $category );
                                        $is_current = is_tax( 'product_cat', $category->term_id );
                                ?>
                                    <label class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-md transition-colors">
                                        <input type="checkbox" 
                                               value="<?php echo $category->term_id; ?>" 
                                               name="product_categories[]"
                                               class="category-filter text-blue-600 rounded focus:ring-blue-500"
                                               <?php checked( $is_current ); ?>>
                                        <span class="text-gray-700 flex-1">
                                            <?php echo esc_html( $category->name ); ?>
                                            <span class="text-gray-500 text-sm">(<?php echo $category->count; ?>)</span>
                                        </span>
                                    </label>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>

                        <!-- Filtro por Marcas -->
                        <div class="mb-8 border-b border-gray-200 pb-6">
                            <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Marcas
                            </h4>
                            
                            <div class="space-y-2 max-h-48 overflow-y-auto">
                                <?php
                                // Intentar obtener marcas de diferentes formas
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
                                    <label class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-md transition-colors">
                                        <input type="checkbox" 
                                               value="<?php echo $brand->term_id; ?>" 
                                               name="product_brands[]"
                                               class="brand-filter text-blue-600 rounded focus:ring-blue-500">
                                        <span class="text-gray-700 flex-1">
                                            <?php echo esc_html( $brand->name ); ?>
                                            <span class="text-gray-500 text-sm">(<?php echo $brand->count; ?>)</span>
                                        </span>
                                    </label>
                                <?php 
                                    endforeach;
                                else :
                                ?>
                                    <!-- Marcas comunes como fallback -->
                                    <div class="space-y-2">
                                        <?php
                                        $common_brands = array(
                                            'Apple', 'Samsung', 'Huawei', 'Xiaomi', 'OPPO', 
                                            'OnePlus', 'LG', 'Motorola', 'Sony', 'Nokia'
                                        );
                                        foreach ( $common_brands as $brand ) :
                                        ?>
                                            <label class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-md transition-colors">
                                                <input type="checkbox" 
                                                       value="<?php echo strtolower( $brand ); ?>" 
                                                       name="product_brands[]"
                                                       class="brand-filter text-blue-600 rounded focus:ring-blue-500">
                                                <span class="text-gray-700"><?php echo $brand; ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="space-y-3">
                            <button id="apply-filters" 
                                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Aplicar Filtros
                            </button>
                            <button id="clear-filters" 
                                    class="w-full bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                                Limpiar Filtros
                            </button>
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
                <main class="lg:w-3/4">
                    
                    <!-- Barra superior con ordenamiento y resultados -->
                    <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <?php
                            /**
                             * Hook: woocommerce_before_shop_loop.
                             *
                             * @hooked woocommerce_output_all_notices - 10
                             * @hooked woocommerce_result_count - 20
                             * @hooked woocommerce_catalog_ordering - 30
                             */
                            do_action( 'woocommerce_before_shop_loop' );
                            ?>
                        </div>
                    </div>

                    <!-- Grid de productos -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="products-grid">
                        <?php
                        woocommerce_product_loop_start();

                        if ( wc_get_loop_prop( 'is_shortcode' ) ) {
                            $columns = absint( wc_get_loop_prop( 'columns' ) );
                        } else {
                            $columns = wc_get_default_products_per_row();
                        }

                        while ( have_posts() ) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action( 'woocommerce_shop_loop' );

                            wc_get_template_part( 'content', 'product' );
                        }

                        woocommerce_product_loop_end();
                        ?>
                    </div>

                    <?php
                    /**
                     * Hook: woocommerce_after_shop_loop.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                    ?>

                </main>
            </div>

        <?php else : ?>

            <div class="text-center py-12">
                <div class="max-w-md mx-auto">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">No se encontraron productos</h2>
                    <p class="text-gray-500 mb-8">Lo sentimos, no hay productos disponibles que coincidan con tus criterios de búsqueda.</p>
                    <a href="<?php echo home_url(); ?>" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors inline-block">
                        Volver al inicio
                    </a>
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
        do_action( 'woocommerce_after_main_content' );
        ?>

    </div>
</div>

<!-- JavaScript para los filtros -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const toggleFiltersBtn = document.getElementById('toggle-filters');
    const closeFiltersBtn = document.getElementById('close-filters');
    const filtersSidebar = document.getElementById('filters-sidebar');
    const applyFiltersBtn = document.getElementById('apply-filters');
    const clearFiltersBtn = document.getElementById('clear-filters');
    const applyPriceBtn = document.getElementById('apply-price-filter');
    
    // Mostrar/ocultar filtros en móvil
    if (toggleFiltersBtn) {
        toggleFiltersBtn.addEventListener('click', function() {
            filtersSidebar.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (closeFiltersBtn) {
        closeFiltersBtn.addEventListener('click', function() {
            filtersSidebar.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });
    }
    
    // Cerrar filtros al hacer click fuera
    if (filtersSidebar) {
        filtersSidebar.addEventListener('click', function(e) {
            if (e.target === filtersSidebar) {
                filtersSidebar.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
    }
    
    // Aplicar filtros
    if (applyFiltersBtn) {
        applyFiltersBtn.addEventListener('click', function() {
            applyFilters();
        });
    }
    
    // Aplicar filtro de precio
    if (applyPriceBtn) {
        applyPriceBtn.addEventListener('click', function() {
            applyFilters();
        });
    }
    
    // Limpiar filtros
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function() {
            clearAllFilters();
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
    
    // Función para limpiar filtros
    function clearAllFilters() {
        // Limpiar campos de precio
        const minPrice = document.getElementById('min_price');
        const maxPrice = document.getElementById('max_price');
        if (minPrice) minPrice.value = '';
        if (maxPrice) maxPrice.value = '';
        
        // Desmarcar checkboxes
        document.querySelectorAll('.category-filter, .brand-filter').forEach(cb => {
            cb.checked = false;
        });
        
        // Redirigir a la página sin filtros
        const baseUrl = window.location.pathname;
        window.location.href = baseUrl;
    }
    
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
    
    // Responsive: cerrar filtros al cambiar a desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            filtersSidebar.classList.remove('hidden');
            document.body.style.overflow = 'auto';
        } else {
            filtersSidebar.classList.add('hidden');
        }
    });
});
</script>

<?php get_footer( 'shop' ); ?>
