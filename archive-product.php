<?php
/**
 * Archivo de productos (tienda) - ITOOLS Rediseñado
 */

get_header( 'shop' ); ?>

<!-- Hero Section Minimalista -->
<div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="absolute inset-0">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="relative container mx-auto px-4 py-20">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-fade-in-up">
                Herramientas
                <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                    Profesionales
                </span>
            </h1>
            <p class="text-xl text-gray-300 mb-8 animate-fade-in-up delay-200">
                Descubre la mejor selección de herramientas para profesionales y entusiastas del bricolaje
            </p>
            
            <!-- Barra de búsqueda mejorada -->
            <div class="max-w-2xl mx-auto animate-fade-in-up delay-400">
                <div class="relative">
                    <input type="text" 
                           id="hero-search" 
                           placeholder="¿Qué herramienta necesitas hoy?"
                           class="w-full px-6 py-4 pl-14 text-lg rounded-2xl border-0 focus:ring-4 focus:ring-blue-500/50 shadow-2xl backdrop-blur-sm bg-white/90">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition-all duration-300 hover:scale-105">
                        Buscar
                    </button>
                </div>
            </div>
            
            <!-- Estadísticas rápidas -->
            <div class="grid grid-cols-3 gap-8 mt-16 animate-fade-in-up delay-600">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-2">500+</div>
                    <div class="text-blue-300">Productos</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-2">50+</div>
                    <div class="text-blue-300">Marcas</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-2">24/7</div>
                    <div class="text-blue-300">Soporte</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-12">

        <?php
        /**
         * Hook: woocommerce_before_main_content.
         */
        do_action( 'woocommerce_before_main_content' );
        ?>

        <!-- Navegación de breadcrumb moderna -->
        <nav class="mb-8" aria-label="Breadcrumb">
            <div class="bg-white rounded-2xl p-4 shadow-sm">
                <?php if ( function_exists( 'woocommerce_breadcrumb' ) ) : ?>
                    <?php woocommerce_breadcrumb( array(
                        'delimiter'   => '<svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>',
                        'wrap_before' => '<ol class="flex items-center text-sm text-gray-600">',
                        'wrap_after'  => '</ol>',
                        'before'      => '<li class="flex items-center">',
                        'after'       => '</li>',
                        'home'        => 'Inicio',
                    ) ); ?>
                <?php endif; ?>
            </div>
        </nav>

        <!-- Categorías destacadas -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Categorías Populares</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <?php
                $featured_categories = get_terms( array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'number' => 6,
                    'parent' => 0,
                ) );
                
                if ( ! empty( $featured_categories ) && ! is_wp_error( $featured_categories ) ) :
                    foreach ( $featured_categories as $category ) :
                        $category_url = get_term_link( $category );
                        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                        $image_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : wc_placeholder_img_src();
                ?>
                    <a href="<?php echo esc_url( $category_url ); ?>" 
                       class="group bg-white rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <img src="<?php echo esc_url( $image_url ); ?>" 
                                 alt="<?php echo esc_attr( $category->name ); ?>"
                                 class="w-8 h-8 object-contain">
                        </div>
                        <h3 class="font-semibold text-gray-900 text-sm group-hover:text-blue-600 transition-colors">
                            <?php echo esc_html( $category->name ); ?>
                        </h3>
                        <p class="text-xs text-gray-500 mt-1"><?php echo $category->count; ?> productos</p>
                    </a>
                <?php 
                    endforeach;
                endif;
                ?>
            </div>
        </div>

        <!-- Botón para mostrar filtros en móvil -->
        <div class="lg:hidden mb-6">
            <button 
                id="toggle-filters" 
                class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-2xl flex items-center gap-3 hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
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
                    class="xl:w-1/4 fixed xl:relative inset-0 xl:inset-auto bg-black/50 xl:bg-transparent z-50 xl:z-auto hidden xl:block backdrop-blur-sm xl:backdrop-blur-none">
                    <div class="bg-white h-full xl:h-auto p-6 xl:p-0 rounded-none xl:rounded-3xl shadow-2xl xl:shadow-lg overflow-y-auto ml-auto xl:ml-0 w-80 xl:w-full border-0 xl:border border-gray-100">
                        
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
                            
                            <?php if ( class_exists( 'WC_Widget_Price_Filter' ) ) : ?>
                                <div class="price-filter-widget">
                                    <?php
                                    $widget = new WC_Widget_Price_Filter();
                                    $widget->widget( array(), array() );
                                    ?>
                                </div>
                            <?php else : ?>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="relative">
                                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">$</div>
                                            <input type="number" 
                                                   id="min_price" 
                                                   placeholder="Mínimo" 
                                                   class="w-full pl-8 pr-3 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm">
                                        </div>
                                        <div class="relative">
                                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">$</div>
                                            <input type="number" 
                                                   id="max_price" 
                                                   placeholder="Máximo" 
                                                   class="w-full pl-8 pr-3 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm">
                                        </div>
                                    </div>
                                    <button id="apply-price-filter" 
                                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                        Aplicar Filtro
                                    </button>
                                </div>
                            <?php endif; ?>
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
                <main class="xl:w-3/4">
                    
                    <!-- Barra superior moderna con ordenamiento y resultados -->
                    <div class="bg-white p-6 rounded-3xl shadow-lg mb-8 border border-gray-100">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                            
                            <!-- Información de resultados -->
                            <div class="flex items-center gap-4">
                                <div class="w-3 h-8 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                                <div>
                                    <?php
                                    $total_products = wc_get_loop_prop( 'total' );
                                    $current_page = max( 1, get_query_var( 'paged' ) );
                                    $per_page = wc_get_loop_prop( 'per_page' );
                                    $first = ( $current_page - 1 ) * $per_page + 1;
                                    $last = min( $total_products, $current_page * $per_page );
                                    ?>
                                    <h3 class="text-xl font-bold text-gray-900">
                                        <?php echo $total_products; ?> Productos Encontrados
                                    </h3>
                                    <p class="text-gray-600">
                                        Mostrando <?php echo $first; ?>-<?php echo $last; ?> de <?php echo $total_products; ?> resultados
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Controles de ordenamiento -->
                            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                                <!-- Selector de vista -->
                                <div class="flex bg-gray-100 rounded-2xl p-1">
                                    <button id="grid-view" class="px-4 py-2 rounded-xl transition-all duration-300 bg-white shadow-sm">
                                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                        </svg>
                                    </button>
                                    <button id="list-view" class="px-4 py-2 rounded-xl transition-all duration-300 text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Ordenamiento -->
                                <?php
                                do_action( 'woocommerce_before_shop_loop' );
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Grid de productos moderno -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8" id="products-grid">
                        <?php
                        woocommerce_product_loop_start();

                        if ( wc_get_loop_prop( 'is_shortcode' ) ) {
                            $columns = absint( wc_get_loop_prop( 'columns' ) );
                        } else {
                            $columns = wc_get_default_products_per_row();
                        }

                        while ( have_posts() ) {
                            the_post();
                            do_action( 'woocommerce_shop_loop' );
                            
                            // Template personalizado de producto
                            ?>
                            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 hover:border-blue-200">
                                <!-- Imagen del producto -->
                                <div class="relative overflow-hidden bg-gray-50">
                                    <a href="<?php the_permalink(); ?>" class="block">
                                        <?php
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'woocommerce_thumbnail', array(
                                                'class' => 'w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500'
                                            ) );
                                        } else {
                                            echo '<div class="w-full h-64 bg-gray-200 flex items-center justify-center">';
                                            echo '<svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                            echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                                            echo '</svg>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </a>
                                    
                                    <!-- Badges -->
                                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                                        <?php if ( $product = wc_get_product( get_the_ID() ) ) : ?>
                                            <?php if ( $product->is_on_sale() ) : ?>
                                                <span class="bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                                    Oferta
                                                </span>
                                            <?php endif; ?>
                                            <?php if ( $product->is_featured() ) : ?>
                                                <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                                    Destacado
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Botones de acción rápida -->
                                    <div class="absolute top-4 right-4 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-blue-50 transition-colors wishlist-btn">
                                            <svg class="w-5 h-5 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </button>
                                        <button class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-blue-50 transition-colors quick-view-btn">
                                            <svg class="w-5 h-5 text-gray-600 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Información del producto -->
                                <div class="p-6">
                                    <div class="mb-3">
                                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        
                                        <!-- Valoración -->
                                        <?php if ( $product = wc_get_product( get_the_ID() ) ) : ?>
                                            <div class="flex items-center gap-2 mt-2">
                                                <?php 
                                                $rating = $product->get_average_rating();
                                                $review_count = $product->get_review_count();
                                                if ( $rating > 0 ) :
                                                ?>
                                                    <div class="flex items-center">
                                                        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                                            <svg class="w-4 h-4 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <span class="text-sm text-gray-600">(<?php echo $review_count; ?>)</span>
                                                <?php else : ?>
                                                    <span class="text-sm text-gray-500">Sin reseñas</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Precio -->
                                    <div class="mb-4">
                                        <?php if ( $product ) : ?>
                                            <div class="text-2xl font-bold text-gray-900">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Botón de agregar al carrito -->
                                    <div class="flex gap-3">
                                        <?php if ( $product ) : ?>
                                            <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                                                <button class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-4 rounded-2xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                                    Agregar al Carrito
                                                </button>
                                            <?php else : ?>
                                                <button class="flex-1 bg-gray-300 text-gray-600 py-3 px-4 rounded-2xl font-semibold cursor-not-allowed">
                                                    No Disponible
                                                </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        
                                        <button class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center hover:bg-gray-200 transition-colors">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                            </svg>
                                        </button>
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
        do_action( 'woocommerce_after_main_content' );
        ?>

    </div>
</div>

<!-- JavaScript mejorado para los filtros y funcionalidades modernas -->
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
    
    function setProductView(view) {
        if (view === 'grid') {
            productsGrid.className = 'grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8';
            gridViewBtn.className = 'px-4 py-2 rounded-xl transition-all duration-300 bg-white shadow-sm text-blue-600';
            listViewBtn.className = 'px-4 py-2 rounded-xl transition-all duration-300 text-gray-500';
        } else {
            productsGrid.className = 'grid grid-cols-1 gap-6';
            listViewBtn.className = 'px-4 py-2 rounded-xl transition-all duration-300 bg-white shadow-sm text-blue-600';
            gridViewBtn.className = 'px-4 py-2 rounded-xl transition-all duration-300 text-gray-500';
        }
        localStorage.setItem('productView', view);
    }
    
    // Restaurar vista guardada
    const savedView = localStorage.getItem('productView');
    if (savedView) {
        setProductView(savedView);
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
        if (filtersSidebar) {
            filtersSidebar.style.opacity = '0';
            filtersSidebar.querySelector('div').style.transform = 'translateX(100%)';
            
            setTimeout(() => {
                filtersSidebar.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }
    }
    
    if (closeFiltersBtn) {
        closeFiltersBtn.addEventListener('click', closeMobileFilters);
    }
    
    // Cerrar filtros al hacer click fuera
    if (filtersSidebar) {
        filtersSidebar.addEventListener('click', function(e) {
            if (e.target === filtersSidebar) {
                closeMobileFilters();
            }
        });
    }
    
    // Filtros rápidos
    document.querySelectorAll('.quick-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            const filterType = this.textContent.trim();
            applyQuickFilter(filterType);
        });
    });
    
    function applyQuickFilter(type) {
        const currentUrl = new URL(window.location);
        const searchParams = new URLSearchParams();
        
        // Mantener búsqueda actual
        if (currentUrl.searchParams.get('s')) {
            searchParams.set('s', currentUrl.searchParams.get('s'));
        }
        
        switch(type) {
            case '🔥 Más Vendidos':
                searchParams.set('orderby', 'popularity');
                break;
            case '⭐ Mejor Valorados':
                searchParams.set('orderby', 'rating');
                break;
            case '💰 Ofertas':
                searchParams.set('meta_key', '_sale_price');
                searchParams.set('meta_compare', 'EXISTS');
                break;
            case '🆕 Nuevos':
                searchParams.set('orderby', 'date');
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
    
    // Aplicar filtro de precio
    if (applyPriceBtn) {
        applyPriceBtn.addEventListener('click', function() {
            this.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>';
            this.disabled = true;
            
            setTimeout(() => {
                applyFilters();
            }, 300);
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
    
    // Responsive: cerrar filtros al cambiar a desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1280) { // xl breakpoint
            if (filtersSidebar) {
                filtersSidebar.classList.remove('hidden');
                filtersSidebar.style.opacity = '';
                if (filtersSidebar.querySelector('div')) {
                    filtersSidebar.querySelector('div').style.transform = '';
                }
            }
            document.body.style.overflow = 'auto';
        } else {
            if (filtersSidebar && !filtersSidebar.classList.contains('hidden')) {
                closeMobileFilters();
            }
        }
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
