<?php
/**
 * Archivo de productos (tienda) - ITOOLS
 */

get_header(); ?>

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

<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">

        <?php
        /**
         * Hook: woocommerce_before_main_content.
         */
        do_action( 'woocommerce_before_main_content' );
        ?>

        <!-- Breadcrumb -->
        <?php if ( function_exists( 'woocommerce_breadcrumb' ) ) : ?>
            <div class="bg-white rounded-lg p-4 shadow-sm mb-6">
                <?php woocommerce_breadcrumb(); ?>
            </div>
        <?php endif; ?>

        <!-- Categor├¡as con im├ígenes -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Categor├¡as Populares</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <?php
                // Categor├¡as predefinidas con im├ígenes
                $featured_categories = array(
                    array(
                        'name' => 'Herramientas',
                        'slug' => 'herramientas',
                        'image' => get_stylesheet_directory_uri() . '/images/categoria-herramientas.svg',
                        'count' => 150
                    ),
                    array(
                        'name' => 'Refacciones',
                        'slug' => 'refacciones',
                        'image' => get_stylesheet_directory_uri() . '/images/categoria-refacciones.svg',
                        'count' => 89
                    ),
                    array(
                        'name' => 'Bater├¡as',
                        'slug' => 'baterias',
                        'image' => get_stylesheet_directory_uri() . '/images/categoria-baterias.svg',
                        'count' => 45
                    ),
                    array(
                        'name' => 'Accesorios',
                        'slug' => 'accesorios',
                        'image' => get_stylesheet_directory_uri() . '/images/categoria-accesorios.svg',
                        'count' => 120
                    ),
                    array(
                        'name' => 'Cargadores',
                        'slug' => 'cargadores',
                        'image' => get_stylesheet_directory_uri() . '/images/categoria-cargadores.svg',
                        'count' => 67
                    ),
                    array(
                        'name' => 'Pantallas',
                        'slug' => 'pantallas',
                        'image' => get_stylesheet_directory_uri() . '/images/categoria-pantallas.svg',
                        'count' => 78
                    )
                );
                
                foreach ( $featured_categories as $category ) :
                    $category_url = home_url( '/tienda/?product_cat=' . $category['slug'] );
                ?>
                    <a href="<?php echo esc_url( $category_url ); ?>" 
                       class="group bg-white rounded-xl p-4 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-white flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <img src="<?php echo esc_url( $category['image'] ); ?>" 
                                 alt="<?php echo esc_attr( $category['name'] ); ?>"
                                 class="w-10 h-10 object-contain"
                                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0yMCAxMkMxNi42ODYzIDEyIDEzLjUwNTQgMTMuMzE2NCAxMS4yNzIxIDE1LjU0OTdDOS4wMzg3OSAxNy43ODMgNy43MjI2NiAyMC45NjM3IDcuNzIyNjYgMjQuMjc3M0M3LjcyMjY2IDI3LjU5MSA5LjAzODc5IDMwLjc3MTcgMTEuMjcyMSAzMy4wMDVDMTMuNTA1NCAzNS4yMzg0IDE2LjY4NjMgMzYuNTU0NyAyMCAzNi41NTQ3QzIzLjMxMzcgMzYuNTU0NyAyNi40OTQ2IDM1LjIzODQgMjguNzI3OSAzMy4wMDVDMzAuOTYxMiAzMC43NzE3IDMyLjI3NzMgMjcuNTkxIDMyLjI3NzMgMjQuMjc3M0MzMi4yNzczIDIwLjk2MzcgMzAuOTYxMiAxNy43ODMgMjguNzI3OSAxNS41NDk3QzI2LjQ5NDYgMTMuMzE2NCAyMy4zMTM3IDEyIDIwIDEyWk0yMCA5LjMzMzMzQzI0LjI0MzUgOS4zMzMzMyAyOC4zMTMxIDEwLjkxNjcgMzEuMzEzNyAxMy45MTczQzM0LjMxNDIgMTYuOTE3OSAzNS44OTc2IDIwLjk4NzUgMzUuODk3NiAyNS4yMzA5QzM1Ljg5NzYgMjkuNDc0NCAzNC4zMTQyIDMzLjU0NCAzMS4zMTM3IDM2LjU0NDZDMI4zMTMxIDM5LjU0NTIgMjQuMjQzNSA0MS4xMjg2IDIwIDQxLjEyODZDMTUuNzU2NSA0MS4xMjg2IDExLjY4NjkgMzkuNTQ1MiA4LjY4NjMgMzYuNTQ0NkM1LjY4NTcxIDMzLjU0NCA0LjEwMjM4IDI5LjQ3NDQgNC4xMDIzOCAyNS4yMzA5QzQuMTAyMzggMjAuOTg3NSA1LjY4NTcxIDE2LjkxNzkgOC42ODYzIDEzLjkxNzNDMTEuNjg2OSAxMC45MTY3IDE1Ljc1NjUgOS4zMzMzMyAyMCA5LjMzMzMzWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'" />
                        </div>
                        <h3 class="font-semibold text-gray-900 text-sm group-hover:text-blue-600 transition-colors">
                            <?php echo esc_html( $category['name'] ); ?>
                        </h3>
                        <p class="text-xs text-gray-500 mt-1"><?php echo $category['count']; ?> productos</p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Sidebar con filtros simples -->
                <aside class="lg:w-1/4">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 sticky top-4 space-y-6">
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                            </svg>
                            Filtros
                        </h3>

                        <!-- Widget de precio -->
                        <div class="widget-area">
                            <h4 class="font-semibold text-gray-900 mb-3">Filtrar por precio</h4>
                            <?php the_widget( 'WC_Widget_Price_Filter' ); ?>
                        </div>
                        
                        <!-- Widget de categorías -->
                        <div class="widget-area">
                            <h4 class="font-semibold text-gray-900 mb-3">Categorías</h4>
                            <?php the_widget( 'WC_Widget_Product_Categories', array(
                                'title' => '',
                                'count' => 1,
                                'hierarchical' => 1,
                                'show_children_only' => 0
                            ) ); ?>
                        </div>
                        
                        <!-- Widget de atributos de marca -->
                        <?php if ( class_exists( 'WC_Widget_Layered_Nav' ) ) : ?>
                        <div class="widget-area">
                            <h4 class="font-semibold text-gray-900 mb-3">Marcas</h4>
                            <?php the_widget( 'WC_Widget_Layered_Nav', array( 
                                'title' => '', 
                                'attribute' => 'pa_marca'
                            ) ); ?>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Widget de productos en oferta -->
                        <div class="widget-area">
                            <h4 class="font-semibold text-gray-900 mb-3">Estado</h4>
                            <?php the_widget( 'WC_Widget_Product_Tag_Cloud', array(
                                'title' => ''
                            ) ); ?>
                        </div>
                        
                    </div>
                </aside>

                <!-- Contenido principal -->
                <main class="lg:w-3/4">
                    
                    <!-- Header con resultados y ordenamiento -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-6">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex-1">
                                <?php
                                /**
                                 * Hook: woocommerce_before_shop_loop - Mostrar resultados
                                 */
                                woocommerce_result_count();
                                ?>
                            </div>
                            
                            <!-- Ordenamiento -->
                            <div class="flex items-center gap-4">
                                <?php
                                /**
                                 * Selector de ordenamiento
                                 */
                                woocommerce_catalog_ordering();
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Grid de productos -->
                    <?php woocommerce_product_loop_start(); ?>
                    
                    <?php if ( wc_get_loop_prop( 'total' ) ) : ?>
                        <?php while ( have_posts() ) : ?>
                            <?php the_post(); ?>
                            <?php
                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action( 'woocommerce_shop_loop' );

                            wc_get_template_part( 'content', 'product' );
                            ?>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <?php woocommerce_product_loop_end(); ?>

                    <!-- Paginación -->
                    <div class="mt-12">
                        <?php
                        /**
                         * Hook: woocommerce_after_shop_loop.
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                        ?>
                    </div>

                </main>
            </div>

        <?php else : ?>

            <!-- No se encontraron productos -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0118 12a8 8 0 01-8 8 8 8 0 01-8-8 8 8 0 018-8c2.027 0 3.9.756 5.336 2"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">No se encontraron productos</h2>
                    <p class="text-gray-600 mb-6">Intenta ajustar tus filtros o b├║squeda</p>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                       class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors inline-block">
                        Ver todos los productos
                    </a>
                </div>
            </div>

        <?php endif; ?>

        <?php
        /**
         * Hook: woocommerce_after_main_content.
         */
        do_action( 'woocommerce_after_main_content' );
        ?>

    </div>
</div>

<?php get_footer(); ?>
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
                                                   placeholder="M├¡nimo" 
                                                   class="w-full pl-8 pr-3 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-white/80 backdrop-blur-sm">
                                        </div>
                                        <div class="relative">
                                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">$</div>
                                            <input type="number" 
                                                   id="max_price" 
                                                   placeholder="M├íximo" 
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

                        <!-- Filtro por Categor├¡as -->
                        <div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100">
                            <h4 class="font-bold text-gray-900 mb-6 flex items-center text-lg">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                Categor├¡as
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

                        <!-- Botones de acci├│n -->
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

                        <!-- Filtros r├ípidos -->
                        <div class="mt-8 p-6 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl border border-yellow-200">
                            <h5 class="font-bold text-gray-900 mb-4 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                Filtros R├ípidos
                            </h5>
                            <div class="space-y-2">
                                <button class="quick-filter w-full text-left p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700">
                                    ­ƒöÑ M├ís Vendidos
                                </button>
                                <button class="quick-filter w-full text-left p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700">
                                    Ô¡É Mejor Valorados
                                </button>
                                <button class="quick-filter w-full text-left p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700">
                                    ­ƒÆ░ Ofertas
                                </button>
                                <button class="quick-filter w-full text-left p-3 rounded-xl bg-white/60 hover:bg-white transition-all duration-300 border border-transparent hover:border-yellow-300 text-sm font-medium text-gray-700 hover:text-yellow-700">
                                    ­ƒåò Nuevos
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
                            
                            <!-- Informaci├│n de resultados -->
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
                                    
                                    <!-- Botones de acci├│n r├ípida -->
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
                                
                                <!-- Informaci├│n del producto -->
                                <div class="p-6">
                                    <div class="mb-3">
                                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        
                                        <!-- Valoraci├│n -->
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
                                                    <span class="text-sm text-gray-500">Sin rese├▒as</span>
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
                                    
                                    <!-- Bot├│n de agregar al carrito -->
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

                    <!-- Paginaci├│n moderna -->
                    <div class="mt-12">
                        <?php
                        do_action( 'woocommerce_after_shop_loop' );
                        ?>
                    </div>

                </main>
            </div>

        <?php else : ?>

            <!-- Estado vac├¡o mejorado -->
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <!-- Ilustraci├│n SVG -->
                    <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">No encontramos productos</h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Lo sentimos, no hay productos que coincidan con tus criterios de b├║squeda. 
                        <br>Prueba ajustando los filtros o explorando nuestras categor├¡as.
                    </p>
                    
                    <!-- Botones de acci├│n -->
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
                        <h3 class="font-bold text-gray-900 mb-4">Sugerencias de b├║squeda:</h3>
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
        
        // B├║squeda con el bot├│n
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
    
    // Mostrar/ocultar filtros en m├│vil con animaciones
    if (toggleFiltersBtn) {
        toggleFiltersBtn.addEventListener('click', function() {
            filtersSidebar.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Animaci├│n de entrada
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
    
    // Filtros r├ípidos
    document.querySelectorAll('.quick-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            const filterType = this.textContent.trim();
            applyQuickFilter(filterType);
        });
    });
    
    function applyQuickFilter(type) {
        const currentUrl = new URL(window.location);
        const searchParams = new URLSearchParams();
        
        // Mantener b├║squeda actual
        if (currentUrl.searchParams.get('s')) {
            searchParams.set('s', currentUrl.searchParams.get('s'));
        }
        
        switch(type) {
            case '­ƒöÑ M├ís Vendidos':
                searchParams.set('orderby', 'popularity');
                break;
            case 'Ô¡É Mejor Valorados':
                searchParams.set('orderby', 'rating');
                break;
            case '­ƒÆ░ Ofertas':
                searchParams.set('meta_key', '_sale_price');
                searchParams.set('meta_compare', 'EXISTS');
                break;
            case '­ƒåò Nuevos':
                searchParams.set('orderby', 'date');
                break;
        }
        
        currentUrl.search = searchParams.toString();
        window.location.href = currentUrl.toString();
    }
    
    // Aplicar filtros con animaci├│n de carga
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
    
    // Funci├│n para aplicar filtros
    function applyFilters() {
        const currentUrl = new URL(window.location);
        const searchParams = new URLSearchParams();
        
        // Mantener par├ímetros b├ísicos
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
        
        // Filtros de categor├¡as
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
        
        // Redirigir con los nuevos par├ímetros
        currentUrl.search = searchParams.toString();
        window.location.href = currentUrl.toString();
    }
    
    // Funci├│n para limpiar filtros con animaci├│n
    function clearAllFilters() {
        // Animaci├│n de limpiar
        document.querySelectorAll('.category-filter, .brand-filter').forEach(cb => {
            if (cb.checked) {
                cb.checked = false;
                cb.closest('label').style.backgroundColor = '#fee2e2';
                setTimeout(() => {
                    cb.closest('label').style.backgroundColor = '';
                }, 200);
            }
        });
        
        // Limpiar campos de precio con animaci├│n
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
        
        // Redirigir despu├®s de la animaci├│n
        setTimeout(() => {
            const baseUrl = window.location.pathname;
            window.location.href = baseUrl;
        }, 400);
    }
    
    // Funciones de interacci├│n mejoradas para productos
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Animaci├│n de wishlist
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
            
            // Aqu├¡ podr├¡as implementar una modal de vista r├ípida
            console.log('Vista r├ípida del producto');
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
        
        // Cargar categor├¡as
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
    
    // Cargar filtros al cargar la p├ígina
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
    
    // Lazy loading para im├ígenes (si es necesario)
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
