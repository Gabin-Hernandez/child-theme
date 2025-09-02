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

        <!-- Categorías con imágenes -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Categorías Populares</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <?php
                // Categorías predefinidas con imágenes
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
                        'name' => 'Baterías',
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
                                 class="w-10 h-10 object-contain" />
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
                
                <!-- Sidebar con filtros -->
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
                        
                        <!-- Widget de marcas -->
                        <?php if ( class_exists( 'WC_Widget_Layered_Nav' ) ) : ?>
                        <div class="widget-area">
                            <h4 class="font-semibold text-gray-900 mb-3">Marcas</h4>
                            <?php the_widget( 'WC_Widget_Layered_Nav', array( 
                                'title' => '', 
                                'attribute' => 'pa_marca'
                            ) ); ?>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </aside>

                <!-- Contenido principal -->
                <main class="lg:w-3/4">
                    
                    <!-- Header con resultados y ordenamiento -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-6">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex-1">
                                <?php woocommerce_result_count(); ?>
                            </div>
                            
                            <!-- Ordenamiento -->
                            <div class="flex items-center gap-4">
                                <?php woocommerce_catalog_ordering(); ?>
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
                    <p class="text-gray-600 mb-6">Intenta ajustar tus filtros o búsqueda</p>
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
