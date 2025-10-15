<?php
/**
 * Product Filters Component
 * Sidebar de filtros para productos
 */

// Obtener rango de precios dinámico
$price_range = function_exists('itools_get_dynamic_price_range') 
    ? itools_get_dynamic_price_range() 
    : array('min' => 0, 'max' => 10000);

$current_min = isset($_GET['min_price']) ? $_GET['min_price'] : $price_range['min'];
$current_max = isset($_GET['max_price']) ? $_GET['max_price'] : $price_range['max'];
?>

<aside id="filters-sidebar" class="lg:w-80 fixed lg:relative inset-0 lg:inset-auto bg-black/50 lg:bg-transparent z-50 lg:z-auto hidden lg:block">
    <div class="bg-white h-full lg:h-auto p-6 rounded-none lg:rounded-2xl shadow-2xl lg:shadow-lg overflow-y-auto ml-auto lg:ml-0 w-80 lg:w-full border-0 lg:border border-gray-200/50 lg:sticky lg:top-4 lg:max-h-[calc(100vh-2rem)]">
        
        <!-- Header del sidebar -->
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Filtros</h3>
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
                        $category_url = home_url('/?post_type=product&s=&product_cat=' . $category->slug);
                        $is_current_category = isset($_GET['product_cat']) && $_GET['product_cat'] === $category->slug;
                        ?>
                        <a href="<?php echo esc_url($category_url); ?>" 
                           class="flex items-center justify-between p-3 rounded-xl transition-all duration-200 <?php echo $is_current_category ? 'bg-blue-50 border-blue-200 text-blue-900 font-semibold' : 'bg-gray-50 hover:bg-gray-100 border-transparent hover:border-gray-200 text-gray-700 hover:text-gray-900'; ?> border">
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-medium"><?php echo esc_html( $category->name ); ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded-full font-medium">
                                    <?php echo $category->count; ?>
                                </span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    <?php endforeach; ?>

                    <?php if (!empty($remaining_categories)) : ?>
                    <!-- Ver más categorías -->
                    <div id="more-categories" class="hidden space-y-2">
                        <?php foreach ($remaining_categories as $category) : 
                            $category_url = home_url('/?post_type=product&s=&product_cat=' . $category->slug);
                            $is_current_category = isset($_GET['product_cat']) && $_GET['product_cat'] === $category->slug;
                            ?>
                            <a href="<?php echo esc_url($category_url); ?>" 
                               class="flex items-center justify-between p-3 rounded-xl transition-all duration-200 <?php echo $is_current_category ? 'bg-blue-50 border-blue-200 text-blue-900 font-semibold' : 'bg-gray-50 hover:bg-gray-100 border-transparent hover:border-gray-200 text-gray-700 hover:text-gray-900'; ?> border">
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-medium"><?php echo esc_html( $category->name ); ?></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded-full font-medium">
                                        <?php echo $category->count; ?>
                                    </span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <button id="toggle-more-categories" class="w-full mt-3 py-2 text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
                        Ver más categorías
                    </button>
                    <?php endif; ?>

                <?php endif; ?>
            </div>
        </div>

        <!-- Botón limpiar filtros -->
        <div class="mt-8">
            <button id="clear-filters" class="w-full bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white py-4 px-6 rounded-2xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Limpiar Filtros
            </button>
        </div>
    </div>
</aside>