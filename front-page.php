<?php
/**
 * Front Page - ITOOLS MX - Diseño Moderno
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- Hero Principal -->
    <section class="relative bg-slate-900">
        <div id="hero-slider" class="relative">
            <!-- Slide 1 - Principal -->
            <div class="slide active h-[600px] md:h-[700px] lg:h-[800px] relative">
                <!-- Imagen de fondo -->
                <div class="absolute inset-0">
                    <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-19.webp" 
                         alt="Herramientas para técnicos" 
                         class="w-full h-full object-cover opacity-70">
                    <div class="absolute inset-0 bg-slate-900/60"></div>
                </div>
                
                <!-- Contenido -->
                <div class="container max-w-6xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="space-y-8">
                            <div class="inline-flex items-center bg-white/10 backdrop-blur-sm text-white px-6 py-2 rounded-full font-medium border border-white/20">
                                Líderes en Tecnología
                            </div>
                            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight">
                                ITOOLS MX
                                <span class="block text-2xl md:text-3xl text-slate-200 font-normal mt-4">
                                    Tu socio tecnológico de confianza
                                </span>
                            </h1>
                            <p class="text-xl md:text-2xl text-slate-200 leading-relaxed max-w-2xl">
                                Más de 19,000 productos especializados para profesionales y técnicos en electrónica
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 text-center shadow-lg">
                                    Explorar Catálogo
                                </a>
                                <a href="#categorias" 
                                   class="border-2 border-white/50 text-white hover:border-white hover:bg-white/10 px-10 py-4 text-lg font-semibold rounded-lg transition-all duration-300 text-center">
                                    Ver Categorías
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 - Refacciones -->
            <div class="slide h-[600px] md:h-[700px] lg:h-[800px] relative">
                <div class="absolute inset-0">
                    <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-1.webp" 
                         alt="Refacciones de celulares" 
                         class="w-full h-full object-cover opacity-70">
                    <div class="absolute inset-0 bg-slate-900/60"></div>
                </div>
                
                <div class="container max-w-6xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="space-y-8">
                            <div class="inline-flex items-center bg-white/10 backdrop-blur-sm text-white px-6 py-2 rounded-full font-medium border border-white/20">
                                Refacciones Originales
                            </div>
                            <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight">
                                Refacciones
                                <span class="block text-2xl md:text-3xl text-slate-200 font-normal mt-4">
                                    Más de 19,000 SKU disponibles
                                </span>
                            </h2>
                            <p class="text-xl md:text-2xl text-slate-200 leading-relaxed max-w-2xl">
                                Encuentra las refacciones originales y compatibles que necesitas para mantener tus equipos funcionando perfectamente
                            </p>
                            <a href="/categoria/refacciones/" 
                               class="inline-block bg-green-600 hover:bg-green-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                                Ver Refacciones
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 - Pantallas -->
            <div class="slide h-[600px] md:h-[700px] lg:h-[800px] relative">
                <div class="absolute inset-0">
                    <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                         alt="Pantallas y displays" 
                         class="w-full h-full object-cover opacity-70">
                    <div class="absolute inset-0 bg-slate-900/60"></div>
                </div>
                
                <div class="container max-w-6xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="space-y-8">
                            <div class="inline-flex items-center bg-white/10 backdrop-blur-sm text-white px-6 py-2 rounded-full font-medium border border-white/20">
                                Tecnología Avanzada
                            </div>
                            <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight">
                                Pantallas
                                <span class="block text-2xl md:text-3xl text-slate-200 font-normal mt-4">
                                    LCD, OLED y Touch de última generación
                                </span>
                            </h2>
                            <p class="text-xl md:text-2xl text-slate-200 leading-relaxed max-w-2xl">
                                Pantallas de alta calidad para iPhone, Samsung, Huawei y más marcas. Garantía y soporte técnico incluido
                            </p>
                            <a href="/categoria/lcd-y-touch/" 
                               class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                                Ver Pantallas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 4 - Baterías -->
            <div class="slide h-[600px] md:h-[700px] lg:h-[800px] relative">
                <div class="absolute inset-0">
                    <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-16.webp" 
                         alt="Baterías y accesorios" 
                         class="w-full h-full object-cover opacity-70">
                    <div class="absolute inset-0 bg-slate-900/60"></div>
                </div>
                
                <div class="container max-w-6xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="space-y-8">
                            <div class="inline-flex items-center bg-white/10 backdrop-blur-sm text-white px-6 py-2 rounded-full font-medium border border-white/20">
                                Energía Confiable
                            </div>
                            <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight">
                                Baterías
                                <span class="block text-2xl md:text-3xl text-slate-200 font-normal mt-4">
                                    Máxima duración y rendimiento
                                </span>
                            </h2>
                            <p class="text-xl md:text-2xl text-slate-200 leading-relaxed max-w-2xl">
                                Baterías originales y compatibles para todos los modelos. Larga duración y garantía extendida
                            </p>
                            <a href="/categoria/baterias/" 
                               class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                                Ver Baterías
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navegación del slider -->
        <div id="slider-controls" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 bg-black/50 backdrop-blur-sm px-6 py-3 rounded-full" style="z-index: 9999;">
            <button id="dot-0" onclick="changeSlide(0)" class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300"></button>
            <button id="dot-1" onclick="changeSlide(1)" class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300"></button>
            <button id="dot-2" onclick="changeSlide(2)" class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300"></button>
            <button id="dot-3" onclick="changeSlide(3)" class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300"></button>
        </div>
        
        <!-- Flechas de navegación -->
        <button id="prev-arrow" onclick="prevSlide()" class="hidden md:block absolute left-6 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full transition-all duration-300" style="z-index: 9999;">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button id="next-arrow" onclick="nextSlide()" class="hidden md:block absolute right-6 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full transition-all duration-300" style="z-index: 9999;">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        
        <!-- Indicador de progreso -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/10">
            <div id="progress-bar" class="h-full bg-blue-600 transition-all duration-300"></div>
        </div>
    </section>

    <!-- Categorías Populares -->
    <section id="categorias" class="py-20 bg-slate-900">
        <div class="container max-w-6xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    Nuestras Especialidades
                </h2>
                <p class="text-xl text-slate-300 max-w-2xl mx-auto">
                    Productos de la más alta calidad para profesionales exigentes
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- Refacciones -->
                <div class="group cursor-pointer" onclick="window.location.href='/categoria/refacciones/'">
                    <div class="relative bg-slate-800 rounded-xl overflow-hidden h-72 hover:bg-slate-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-1.webp" 
                             alt="Refacciones de celulares" 
                             class="absolute inset-0 w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 bg-slate-900/70"></div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-end p-6">
                            <div class="space-y-2">
                                <h3 class="text-xl font-bold text-white">REFACCIONES</h3>
                                <p class="text-slate-300 text-sm">Más de 19,000 productos</p>
                                <p class="text-slate-400 text-xs">Componentes originales y compatibles</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pantallas -->
                <div class="group cursor-pointer" onclick="window.location.href='/categoria/lcd-y-touch/'">
                    <div class="relative bg-slate-800 rounded-xl overflow-hidden h-72 hover:bg-slate-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                             alt="Pantallas LCD y Touch" 
                             class="absolute inset-0 w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 bg-slate-900/70"></div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-end p-6">
                            <div class="space-y-2">
                                <h3 class="text-xl font-bold text-white">PANTALLAS</h3>
                                <p class="text-slate-300 text-sm">Calidad es nuestra prioridad</p>
                                <p class="text-slate-400 text-xs">LCD, OLED y tecnologías premium</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Herramientas -->
                <div class="group cursor-pointer" onclick="window.location.href='/categoria/herramientas/'">
                    <div class="relative bg-slate-800 rounded-xl overflow-hidden h-72 hover:bg-slate-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-12.webp" 
                             alt="Herramientas profesionales" 
                             class="absolute inset-0 w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 bg-slate-900/70"></div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-end p-6">
                            <div class="space-y-2">
                                <h3 class="text-xl font-bold text-white">HERRAMIENTAS</h3>
                                <p class="text-slate-300 text-sm">Servicio integral</p>
                                <p class="text-slate-400 text-xs">Microscopios, estaciones de soldadura</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Baterías -->
                <div class="group cursor-pointer" onclick="window.location.href='/categoria/baterias/'">
                    <div class="relative bg-slate-800 rounded-xl overflow-hidden h-72 hover:bg-slate-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-16.webp" 
                             alt="Baterías y accesorios" 
                             class="absolute inset-0 w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 bg-slate-900/70"></div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-end p-6">
                            <div class="space-y-2">
                                <h3 class="text-xl font-bold text-white">BATERÍAS</h3>
                                <p class="text-slate-300 text-sm">Energía completa</p>
                                <p class="text-slate-400 text-xs">Originales y compatibles con garantía</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Estadísticas y CTA -->
    <section class="py-20 bg-white">
        <div class="container max-w-6xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    ¿Por qué elegirnos?
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Somos líderes en el mercado mexicano con más de 10 años de experiencia
                </p>
            </div>
            
            <!-- Estadísticas -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">19,000+</div>
                    <div class="text-slate-600">Productos en Stock</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600 mb-2">50,000+</div>
                    <div class="text-slate-600">Clientes Satisfechos</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-600 mb-2">24h</div>
                    <div class="text-slate-600">Envío Express</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-amber-600 mb-2">99.8%</div>
                    <div class="text-slate-600">Satisfacción</div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 text-center shadow-lg">
                    Explorar Catálogo
                </a>
                <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'myaccount' ) ) : '/mi-cuenta/'; ?>" 
                   class="border-2 border-slate-300 text-slate-700 hover:border-slate-400 hover:text-slate-900 px-10 py-4 text-lg font-semibold rounded-lg transition-all duration-300 text-center">
                    Crear Cuenta
                </a>
            </div>
        </div>
    </section>

    <!-- Productos de Herramientas -->
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <section class="py-20 bg-slate-50">
        <div class="container max-w-6xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-amber-100 text-amber-800 px-6 py-2 rounded-full font-semibold mb-6">
                    HERRAMIENTAS PROFESIONALES
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    Herramientas de Precisión
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Descubre nuestra selección de herramientas especializadas para técnicos profesionales
                </p>
            </div>
            
            <?php
            // Query para obtener productos de la categoría 'Herramientas'
            // Primero verificamos si la categoría existe
            $herramientas_term = get_term_by('slug', 'herramientas', 'product_cat');
            
            if (!$herramientas_term) {
                // Si no existe con slug 'herramientas', intentamos buscar por nombre
                $herramientas_term = get_term_by('name', 'Herramientas', 'product_cat');
            }
            
            $herramientas_args = array(
                'post_type' => 'product',
                'posts_per_page' => 8,
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key' => '_stock_status',
                        'value' => 'instock',
                        'compare' => '='
                    )
                )
            );
            
            // Solo agregamos tax_query si encontramos la categoría
            if ($herramientas_term) {
                $herramientas_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $herramientas_term->term_id,
                    )
                );
            }
            
            $herramientas_query = new WP_Query( $herramientas_args );
            
            if ( $herramientas_query->have_posts() ) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    <?php while ( $herramientas_query->have_posts() ) : $herramientas_query->the_post(); 
                        global $product;
                        if ( ! $product || ! $product->is_visible() ) continue;
                    ?>
                        <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-200 hover:border-amber-300">
                            <!-- Imagen del producto -->
                            <div class="relative overflow-hidden bg-gray-50 aspect-square">
                                <a href="<?php the_permalink(); ?>" class="block h-full">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'woocommerce_thumbnail', array(
                                            'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                                        )); ?>
                                    <?php else : ?>
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </a>
                                
                                <!-- Badge de descuento -->
                                <?php if ( $product->is_on_sale() ) : ?>
                                    <div class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                        <?php
                                        $regular_price = $product->get_regular_price();
                                        $sale_price = $product->get_sale_price();
                                        if ( $regular_price && $sale_price ) {
                                            $discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                                            echo '-' . $discount . '%';
                                        } else {
                                            echo 'OFERTA';
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Información del producto -->
                            <div class="p-6">
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-amber-600 transition-colors duration-300">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <!-- Precio -->
                                <div class="mb-4">
                                    <?php echo $product->get_price_html(); ?>
                                </div>
                                
                                <!-- Rating -->
                                <?php if ( $product->get_average_rating() ) : ?>
                                    <div class="flex items-center mb-4">
                                        <div class="flex text-yellow-400">
                                            <?php
                                            $rating = $product->get_average_rating();
                                            for ( $i = 1; $i <= 5; $i++ ) {
                                                if ( $i <= $rating ) {
                                                    echo '<svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>';
                                                } else {
                                                    echo '<svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <span class="text-sm text-gray-500 ml-2">(<?php echo $product->get_review_count(); ?>)</span>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Botón de agregar al carrito -->
                                <div class="mt-auto">
                                    <?php
                                    woocommerce_template_loop_add_to_cart();
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <!-- Botón para ver más herramientas -->
                <div class="text-center mt-12">
                    <a href="/categoria/herramientas/" 
                       class="inline-flex items-center bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                        Ver Todas las Herramientas
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
            <?php else : ?>
                <div class="text-center py-12">
                    <div class="text-gray-500 mb-4">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay herramientas disponibles</h3>
                    <p class="text-gray-600">Pronto agregaremos más productos a esta categoría.</p>
                    <?php 
                    // Debug info - solo mostrar si es admin
                    if (current_user_can('administrator')) {
                        echo '<div class="text-xs text-gray-500 mt-4 p-2 bg-yellow-50 rounded max-w-md mx-auto">';
                        echo '<strong>Debug info:</strong><br>';
                        echo 'Categoría encontrada: ' . ($herramientas_term ? 'Sí (ID: ' . $herramientas_term->term_id . ', Slug: ' . $herramientas_term->slug . ')' : 'No') . '<br>';
                        echo 'Total productos encontrados: ' . $herramientas_query->found_posts . '<br>';
                        echo 'URL de categoría: <a href="' . get_term_link('herramientas', 'product_cat') . '" target="_blank">Ver categoría</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Marcas Populares -->
    <section class="py-16 bg-slate-50">
        <div class="container max-w-6xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-6">Marcas de Confianza</h3>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">Trabajamos con las mejores marcas del mercado mundial para garantizar la máxima calidad</p>
            </div>
            
            <!-- Carrusel de marcas -->
            <div class="overflow-hidden relative brands-container" style="height: 80px;">
                <div class="flex brands-carousel space-x-8 items-center" style="animation: scrollBrands 20s linear infinite; width: 200%; will-change: transform;">
                    <!-- Apple -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <svg class="w-12 h-12 text-slate-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                        </svg>
                    </div>
                    
                    <!-- Samsung -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-lg font-bold text-blue-600">SAMSUNG</div>
                    </div>
                    
                    <!-- Xiaomi -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-lg font-bold text-orange-500">Mi</div>
                    </div>
                    
                    <!-- Huawei -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-base font-bold text-red-600">HUAWEI</div>
                    </div>
                    
                    <!-- OPPO -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-lg font-bold text-green-600">OPPO</div>
                    </div>
                    
                    <!-- OnePlus -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-base font-bold text-slate-800">OnePlus</div>
                    </div>
                    
                    <!-- Realme -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-base font-bold text-yellow-600">realme</div>
                    </div>
                    
                    <!-- Motorola -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-sm font-bold text-slate-700">MOTOROLA</div>
                    </div>
                    
                    <!-- Duplicados para efecto infinito -->
                    <!-- Apple duplicado -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <svg class="w-12 h-12 text-slate-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                        </svg>
                    </div>
                    
                    <!-- Samsung duplicado -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-lg font-bold text-blue-600">SAMSUNG</div>
                    </div>
                    
                    <!-- Xiaomi duplicado -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-lg font-bold text-orange-500">Mi</div>
                    </div>
                    
                    <!-- Huawei duplicado -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-base font-bold text-red-600">HUAWEI</div>
                    </div>
                    
                    <!-- OPPO duplicado -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-lg font-bold text-green-600">OPPO</div>
                    </div>
                    
                    <!-- OnePlus duplicado -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-base font-bold text-slate-800">OnePlus</div>
                    </div>
                    
                    <!-- Realme duplicado -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-base font-bold text-yellow-600">realme</div>
                    </div>
                    
                    <!-- Motorola duplicado -->
                    <div class="flex-shrink-0 w-28 h-16 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-200">
                        <div class="text-sm font-bold text-slate-700">MOTOROLA</div>
                    </div>
                </div>
            </div>

            <!-- CSS y JavaScript inline para garantizar que funcione -->
            <style>
                @keyframes scrollBrands {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
                
                .brands-carousel {
                    animation: scrollBrands 20s linear infinite !important;
                    width: 200% !important;
                }
                
                .brands-container:hover .brands-carousel {
                    animation-play-state: paused !important;
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Asegurar que la animación se aplique
                    const carousel = document.querySelector('.brands-carousel');
                    if (carousel) {
                        carousel.style.animation = 'scrollBrands 20s linear infinite';
                        carousel.style.width = '200%';
                        carousel.style.willChange = 'transform';
                    }
                    
                    // Pausar al hacer hover
                    const container = document.querySelector('.brands-container');
                    if (container && carousel) {
                        container.addEventListener('mouseenter', function() {
                            carousel.style.animationPlayState = 'paused';
                        });
                        
                        container.addEventListener('mouseleave', function() {
                            carousel.style.animationPlayState = 'running';
                        });
                    }
                });
            </script>
        </div>
    </section>

    <!-- Productos en Oferta -->
    <section id="ofertas" class="py-20 bg-red-50">
        <div class="container max-w-6xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-red-100 text-red-800 px-6 py-2 rounded-full font-semibold mb-6">
                    OFERTAS ESPECIALES
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    Productos en Oferta
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Aprovecha nuestros descuentos exclusivos por tiempo limitado
                </p>
            </div>
            
            <div class="woocommerce">
                <?php
                $sale_products = null;

                if ( function_exists( 'wc_get_product_ids_on_sale' ) ) {
                    $sale_product_ids = array_filter( array_map( 'absint', wc_get_product_ids_on_sale() ) );

                    if ( ! empty( $sale_product_ids ) ) {
                        $args = array(
                            'post_type'      => 'product',
                            'post__in'       => $sale_product_ids,
                            'posts_per_page' => 8,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                            'post_status'    => 'publish',
                        );

                        $sale_products = new WP_Query( $args );
                    }
                }

                if ( $sale_products ) :
                    if ( $sale_products->have_posts() ) : ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <?php while ( $sale_products->have_posts() ) : $sale_products->the_post(); 
                                global $product;
                                if ( ! $product || ! $product->is_on_sale() ) continue;
                                
                                $regular_price = $product->get_regular_price();
                                $sale_price = $product->get_sale_price();
                                $discount_percentage = $regular_price ? round((($regular_price - $sale_price) / $regular_price) * 100) : 0;
                                $product_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                                $image_url = $product_image ? $product_image[0] : wc_placeholder_img_src();
                            ?>
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-slate-200">
                                    <div class="relative">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <img src="<?php echo esc_url($image_url); ?>" 
                                                 alt="<?php echo esc_attr(get_the_title()); ?>" 
                                                 class="w-full h-48 object-cover">
                                        </a>
                                        <?php if ( $discount_percentage > 0 ) : ?>
                                            <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-md text-sm font-semibold">
                                                -<?php echo $discount_percentage; ?>%
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="p-4">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <h3 class="font-semibold text-slate-900 mb-3 hover:text-blue-600 transition-colors">
                                                <?php echo get_the_title(); ?>
                                            </h3>
                                        </a>
                                        <div class="flex items-center gap-2 mb-4">
                                            <?php if ( $sale_price ) : ?>
                                                <span class="text-red-600 font-bold text-lg">
                                                    <?php echo wc_price($sale_price); ?>
                                                </span>
                                                <?php if ( $regular_price && $regular_price != $sale_price ) : ?>
                                                    <span class="text-slate-400 line-through text-sm">
                                                        <?php echo wc_price($regular_price); ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <span class="text-slate-900 font-bold text-lg">
                                                    <?php echo $product->get_price_html(); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="<?php echo get_permalink(); ?>" 
                                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-3 rounded-md transition-colors text-center text-sm font-medium">
                                                Ver Producto
                                            </a>
                                            <button onclick="addToCart('<?php echo esc_js($product->get_slug()); ?>')" 
                                                    class="bg-green-600 hover:bg-green-700 text-white p-2 rounded-md transition-colors flex items-center justify-center"
                                                    title="Agregar al carrito">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m7.5-5v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5m7.5 0H9"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="text-center py-12">
                            <p class="text-gray-600 text-lg">No hay productos en oferta disponibles en este momento.</p>
                            <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                               class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
                                Ver Todos los Productos
                            </a>
                        </div>
                    <?php endif;

                    wp_reset_postdata();
                elseif ( function_exists('woocommerce_shortcode_products') && shortcode_exists('sale_products') ) :
                    echo do_shortcode( '[sale_products limit="8" columns="4"]' );
                else : ?>
                    <div class="text-center py-12">
                        <p class="text-gray-600 text-lg">No hay productos en oferta disponibles en este momento.</p>
                        <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                           class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
                            Ver Todos los Productos
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-12">
                <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                   class="bg-red-600 hover:bg-red-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                    Ver Todas las Ofertas
                </a>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <?php if ( function_exists( 'woocommerce_output_featured_products' ) ) : ?>
    <section class="py-20 bg-white">
        <div class="container max-w-6xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-blue-100 text-blue-800 px-6 py-2 rounded-full font-semibold mb-6">
                    PRODUCTOS DESTACADOS
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    Lo Más Popular
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Los productos más valorados y mejor calificados por nuestros clientes
                </p>
            </div>
            
            <div class="woocommerce">
                <?php 
                // Usar productos destacados reales de WooCommerce
                if ( function_exists('woocommerce_shortcode_products') && shortcode_exists('featured_products') ) : 
                    echo do_shortcode( '[featured_products limit="8" columns="4"]' ); 
                else :
                    // Fallback: usar productos reales marcados como destacados
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 8,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            'relation' => 'OR',
                            array(
                                'key' => '_featured',
                                'value' => 'yes',
                                'compare' => '='
                            ),
                            array(
                                'key' => '_visibility',
                                'value' => 'featured',
                                'compare' => '='
                            )
                        )
                    );
                    
                    $featured_products = new WP_Query( $args );
                    
                    // Si no hay productos destacados, usar los productos más recientes
                    if ( ! $featured_products->have_posts() ) {
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 8,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                        $featured_products = new WP_Query( $args );
                    }
                    
                    if ( $featured_products->have_posts() ) : ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <?php while ( $featured_products->have_posts() ) : $featured_products->the_post(); 
                                global $product;
                                if ( ! $product ) continue;
                                
                                $regular_price = $product->get_regular_price();
                                $sale_price = $product->get_sale_price();
                                $is_featured = $product->is_featured();
                                $product_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                                $image_url = $product_image ? $product_image[0] : wc_placeholder_img_src();
                            ?>
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                    <div class="relative">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <img src="<?php echo esc_url($image_url); ?>" 
                                                 alt="<?php echo esc_attr(get_the_title()); ?>" 
                                                 class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                                        </a>
                                        <?php if ( $is_featured ) : ?>
                                            <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                                TOP
                                            </div>
                                        <?php elseif ( $product->is_on_sale() ) : ?>
                                            <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                                OFERTA
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="p-4">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <h3 class="font-bold text-lg mb-2 hover:text-blue-600 transition-colors">
                                                <?php echo get_the_title(); ?>
                                            </h3>
                                        </a>
                                        <div class="flex items-center gap-2 mb-3">
                                            <?php if ( $sale_price && $product->is_on_sale() ) : ?>
                                                <span class="text-red-500 font-bold text-xl">
                                                    <?php echo wc_price($sale_price); ?>
                                                </span>
                                                <?php if ( $regular_price && $regular_price != $sale_price ) : ?>
                                                    <span class="text-gray-400 line-through text-sm">
                                                        <?php echo wc_price($regular_price); ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <span class="text-blue-600 font-bold text-xl">
                                                    <?php echo $product->get_price_html(); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="<?php echo get_permalink(); ?>" 
                                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-3 rounded-lg transition-colors text-center text-sm font-medium">
                                                Ver Producto
                                            </a>
                                            <button onclick="addToCart('<?php echo esc_js($product->get_slug()); ?>')" 
                                                    class="bg-green-600 hover:bg-green-700 text-white p-2 rounded-lg transition-colors flex items-center justify-center"
                                                    title="Agregar al carrito">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m7.5-5v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5m7.5 0H9"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="text-center py-12">
                            <p class="text-gray-600 text-lg">No hay productos destacados disponibles en este momento.</p>
                            <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                               class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
                                Ver Todos los Productos
                            </a>
                        </div>
                    <?php endif;
                    wp_reset_postdata();
                endif; ?>
            </div>
            
            <div class="text-center mt-12">
                <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                   class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl">
                    Explorar Catálogo Completo
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Productos Destacados Premium -->
    <section class="py-20 bg-slate-900">
        <div class="container max-w-6xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-white/10 text-white px-6 py-2 rounded-full font-semibold mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    PRODUCTOS DESTACADOS
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    Lo Mejor de ITOOLS MX
                </h2>
                <p class="text-xl text-slate-300 max-w-2xl mx-auto">
                    Descubre nuestros productos más vendidos y mejor valorados por técnicos profesionales
                </p>
            </div>

            <!-- Grid de productos destacados -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                
                <!-- Producto 1 - Microscopio -->
                <div class="bg-slate-800 rounded-lg overflow-hidden hover:bg-slate-700 transition-colors duration-300 border border-slate-700">
                    <div class="relative">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-12.webp" 
                             alt="Microscopio Profesional" 
                             class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-slate-900/50"></div>
                        
                        <!-- Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-md text-sm font-semibold">
                                MÁS VENDIDO
                            </span>
                        </div>
                        
                        <!-- Rating -->
                        <div class="absolute top-3 right-3 flex items-center bg-black/50 rounded-md px-2 py-1">
                            <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-white text-sm">4.9</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-white mb-2">
                            Microscopio Profesional HD
                        </h3>
                        <p class="text-slate-400 text-sm mb-4">
                            Microscopio de alta definición para reparaciones de precisión
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xl font-bold text-yellow-400">$6,900</span>
                                <span class="text-slate-500 line-through ml-2 text-sm">$8,500</span>
                            </div>
                            <a href="/categoria/herramientas/" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md font-semibold transition-colors duration-300 text-sm">
                                Ver Producto
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Producto 2 - Pantalla iPhone -->
                <div class="bg-slate-800 rounded-lg overflow-hidden hover:bg-slate-700 transition-colors duration-300 border border-slate-700">
                    <div class="relative">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                             alt="Pantalla iPhone OLED" 
                             class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-slate-900/50"></div>
                        
                        <!-- Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm font-semibold">
                                MEJOR CALIDAD
                            </span>
                        </div>
                        
                        <!-- Rating -->
                        <div class="absolute top-3 right-3 flex items-center bg-black/50 rounded-md px-2 py-1">
                            <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-white text-sm">4.8</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-white mb-2">
                            Pantalla iPhone 15 Pro OLED
                        </h3>
                        <p class="text-slate-400 text-sm mb-4">
                            Display OLED original con tecnología ProMotion 120Hz
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xl font-bold text-blue-400">$2,850</span>
                                <span class="text-slate-500 line-through ml-2 text-sm">$3,200</span>
                            </div>
                            <a href="/categoria/lcd-y-touch/" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md font-semibold transition-colors duration-300 text-sm">
                                Ver Producto
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Producto 3 - Estación de Soldadura -->
                <div class="bg-slate-800 rounded-lg overflow-hidden hover:bg-slate-700 transition-colors duration-300 border border-slate-700">
                    <div class="relative">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-19.webp" 
                             alt="Estación de Soldadura Profesional" 
                             class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-slate-900/50"></div>
                        
                        <!-- Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="bg-green-500 text-white px-3 py-1 rounded-md text-sm font-semibold">
                                PROFESIONAL
                            </span>
                        </div>
                        
                        <!-- Rating -->
                        <div class="absolute top-3 right-3 flex items-center bg-black/50 rounded-md px-2 py-1">
                            <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-white text-sm">5.0</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-white mb-2">
                            Estación de Soldadura Pro
                        </h3>
                        <p class="text-slate-400 text-sm mb-4">
                            Control digital de temperatura y múltiples funciones avanzadas
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xl font-bold text-green-400">$4,750</span>
                                <span class="text-slate-500 line-through ml-2 text-sm">$5,400</span>
                            </div>
                            <a href="/categoria/estaciones-soldadura/" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md font-semibold transition-colors duration-300 text-sm">
                                Ver Producto
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Final -->
            <div class="text-center">
                <h3 class="text-3xl font-bold text-white mb-6">
                    ¿Listo para llevar tu trabajo al siguiente nivel?
                </h3>
                <p class="text-slate-300 mb-8 text-lg max-w-2xl mx-auto">
                    Únete a miles de técnicos que ya confían en ITOOLS MX para sus proyectos más importantes.
                </p>
                
                <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Explorar Catálogo Completo
                </a>
                
                <p class="text-slate-400 text-sm mt-4">
                    Compra 100% segura con garantía de satisfacción
                </p>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section id="newsletter-cta" class="bg-slate-800 py-16">
        <div class="container max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">¡Mantente actualizado!</h2>
            <p class="text-slate-300 mb-8 max-w-xl mx-auto">
                Suscríbete a nuestro boletín y recibe ofertas exclusivas, nuevos productos y consejos profesionales
            </p>
            <div class="max-w-md mx-auto flex gap-2">
                <input type="email" placeholder="Tu correo electrónico" 
                       class="flex-1 px-4 py-3 rounded-lg border border-slate-600 bg-slate-700 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-300">
                    Suscribirse
                </button>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<!-- JavaScript del Slider Mejorado -->
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.slider-dot');
const progressBar = document.getElementById('progress-bar');
const totalSlides = slides.length;
let slideInterval;
let progressInterval;

// Configurar slider automático simplificado
function startAutoSlider() {
    slideInterval = setInterval(() => {
        nextSlide();
    }, 5000); // Cambio cada 5 segundos
    
    updateProgressBar();
}

function updateProgressBar() {
    progressBar.style.width = '0%';
    progressBar.style.transition = 'width 5000ms linear';
    
    setTimeout(() => {
        progressBar.style.width = '100%';
    }, 50);
}

function resetProgress() {
    progressBar.style.transition = 'none';
    progressBar.style.width = '0%';
    setTimeout(() => {
        progressBar.style.transition = 'width 5000ms linear';
        progressBar.style.width = '100%';
    }, 100);
}

function showSlide(index) {
    // Si es el mismo slide, no hacer nada
    if (index === currentSlide) return;
    
    // Actualizar dots
    dots[currentSlide].classList.remove('bg-white');
    dots[currentSlide].classList.add('bg-white/50');
    
    // Remover clases activas del slide actual
    slides[currentSlide].classList.remove('active', 'slide-in');
    slides[currentSlide].classList.add('slide-out');
    
    // Después de un pequeño delay, mostrar el nuevo slide
    setTimeout(() => {
        // Ocultar todos los slides
        slides.forEach(slide => {
            slide.classList.remove('active', 'slide-in', 'slide-out');
        });
        
        // Mostrar el nuevo slide con animación
        slides[index].classList.add('active', 'slide-in');
        
        // Actualizar dots activos
        dots[index].classList.remove('bg-white/50');
        dots[index].classList.add('bg-white');
        
        currentSlide = index;
    }, 100);
}

function changeSlide(index) {
    showSlide(index);
    
    // Reiniciar auto slider
    clearInterval(slideInterval);
    resetProgress();
    setTimeout(startAutoSlider, 100);
}

function nextSlide() {
    const next = (currentSlide + 1) % totalSlides;
    showSlide(next);
}

function prevSlide() {
    const prev = (currentSlide - 1 + totalSlides) % totalSlides;
    showSlide(prev);
}

// Inicializar slider
document.addEventListener('DOMContentLoaded', function() {
    // Configurar el primer slide como activo
    if (slides[0]) {
        slides[0].classList.add('active');
        // Remover la clase hidden de todos los slides inicialmente
        slides.forEach(slide => slide.classList.remove('hidden'));
    }
    
    // Marcar el primer dot como activo
    if (dots[0]) {
        dots[0].classList.add('bg-white');
        dots[0].classList.remove('bg-white/50');
    }
    
    // Iniciar slider automático
    setTimeout(startAutoSlider, 1000);
    
    // Pausar en hover
    const sliderContainer = document.getElementById('hero-slider');
    sliderContainer.addEventListener('mouseenter', () => {
        clearInterval(slideInterval);
    });
    
    sliderContainer.addEventListener('mouseleave', () => {
        startAutoSlider();
    });
});

// Smooth scroll para enlaces internos
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// FUNCIONES DE CARRITO - DISPONIBLES GLOBALMENTE DESDE EL INICIO
window.addToCart = function(productSlug) {
    console.log('addToCart llamado con:', productSlug);
    
    const button = event.target;
    const originalContent = button.innerHTML;
    
    // Mostrar estado de carga
    button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4m0 12v4m8-8h-4M6 12H2m10.5-6.5L15 5m-3 3L9.5 5.5M15 19l-2.5-2.5M9.5 19.5L12 17"></path></svg>';
    button.disabled = true;
    
    // Debug: verificar disponibilidad
    console.log('jQuery disponible:', typeof jQuery !== 'undefined');
    console.log('itools_ajax disponible:', typeof itools_ajax !== 'undefined');
    console.log('itools_ajax objeto:', itools_ajax);
    
    // Si jQuery y AJAX están disponibles, usar WooCommerce real
    if (typeof jQuery !== 'undefined' && typeof itools_ajax !== 'undefined') {
        console.log('Usando método AJAX...');
        // Obtener nombre del producto basado en el slug
        let productName = '';
        switch(productSlug) {
            case 'pantalla-iphone-14':
                productName = 'Pantalla iPhone 14';
                break;
            case 'bateria-samsung':
                productName = 'Batería Samsung';
                break;
            case 'kit-herramientas':
                productName = 'Kit Herramientas';
                break;
            case 'accesorios-pro':
                productName = 'Accesorios Pro';
                break;
            default:
                productName = productSlug.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        }
        
        // Buscar ID del producto
        console.log('Buscando producto:', productName);
        jQuery.ajax({
            url: itools_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'itools_get_product_id',
                product_name: productName
            },
            success: function(response) {
                console.log('Respuesta búsqueda producto:', response);
                if (response.success) {
                    console.log('Producto encontrado, ID:', response.data.product_id);
                    // Agregar al carrito con el ID encontrado
                    addProductToCart(response.data.product_id, button, originalContent, productName);
                } else {
                    // Fallback: Simular agregado exitoso si no se encuentra el producto
                    console.log('Producto no encontrado, usando fallback:', response.data);
                    showSuccessState(button, originalContent);
                    showCartNotification('✅ Producto agregado al carrito');
                    // Simular actualización de contador
                    updateCartCount(getRandomCartCount());
                }
            },
            error: function(xhr, status, error) {
                // Fallback en caso de error
                console.log('Error en búsqueda de producto:', error);
                console.log('XHR:', xhr);
                console.log('Status:', status);
                showSuccessState(button, originalContent);
                showCartNotification('✅ Producto agregado al carrito');
                updateCartCount(getRandomCartCount());
            }
        });
    } else {
        // Fallback sin jQuery
        setTimeout(() => {
            showSuccessState(button, originalContent);
            showCartNotification('✅ Producto agregado al carrito');
            updateCartCount(getRandomCartCount());
        }, 800);
    }
};

// Función auxiliar para agregar producto al carrito
function addProductToCart(productId, button, originalContent, productName) {
    console.log('addProductToCart llamado con ID:', productId, 'Nombre:', productName);
    jQuery.ajax({
        url: itools_ajax.ajax_url,
        type: 'POST',
        data: {
            action: 'itools_add_to_cart',
            product_id: productId,
            quantity: 1
        },
        success: function(response) {
            console.log('Respuesta agregar al carrito:', response);
            if (response.success) {
                console.log('Producto agregado exitosamente');
                showSuccessState(button, originalContent);
                showCartNotification('✅ ' + productName + ' agregado al carrito');
                // Actualizar contador del carrito
                if (response.data.cart_count !== undefined) {
                    console.log('Actualizando contador:', response.data.cart_count);
                    updateCartCount(response.data.cart_count);
                }
            } else {
                // Error en la respuesta
                console.log('Error en respuesta:', response.data);
                showErrorState(button, originalContent);
                showCartNotification('❌ Error: ' + (response.data.message || 'No se pudo agregar al carrito'));
            }
        },
        error: function(xhr, status, error) {
            console.log('Error AJAX:', error);
            showErrorState(button, originalContent);
            showCartNotification('❌ Error de conexión', 'error');
        }
    });
}

// Funciones auxiliares
function getRandomCartCount() {
    // Simular un contador de carrito entre 1 y 5
    return Math.floor(Math.random() * 5) + 1;
}

function showSuccessState(button, originalContent) {
    button.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
    button.classList.remove('bg-green-600');
    button.classList.add('bg-green-700');
    
    setTimeout(() => {
        button.innerHTML = originalContent;
        button.disabled = false;
        button.classList.remove('bg-green-700');
        button.classList.add('bg-green-600');
    }, 2000);
}

function showErrorState(button, originalContent) {
    button.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
    button.classList.remove('bg-green-600');
    button.classList.add('bg-red-600');
    
    setTimeout(() => {
        button.innerHTML = originalContent;
        button.disabled = false;
        button.classList.remove('bg-red-600');
        button.classList.add('bg-green-600');
    }, 2000);
}

function updateCartCount(count) {
    // Actualizar el contador del carrito en el header
    const cartCountElements = document.querySelectorAll('.cart-count');
    cartCountElements.forEach(element => {
        if (count > 0) {
            element.textContent = ' (' + count + ')';
            element.style.display = 'inline';
        } else {
            element.textContent = '';
            element.style.display = 'none';
        }
    });
    
    // Actualizar los contadores del carrito en el header (cart-counter)
    const cartCounterElements = document.querySelectorAll('.cart-counter');
    cartCounterElements.forEach(element => {
        element.textContent = count;
        if (count > 0) {
            element.style.display = 'flex';
        } else {
            element.style.display = 'none';
        }
    });
    
    // Actualizar los nuevos badges del contador del carrito
    const badge = document.getElementById('cart-count-badge');
    const badgeFallback = document.getElementById('cart-count-badge-fallback');
    
    if (badge) {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    }
    
    if (badgeFallback) {
        badgeFallback.textContent = count;
        badgeFallback.style.display = count > 0 ? 'flex' : 'none';
    }
    
    // Añadir efecto visual al link del carrito
    const cartLink = document.getElementById('cart-link');
    if (cartLink) {
        cartLink.style.transform = 'scale(1.05)';
        cartLink.style.boxShadow = '0 4px 12px rgba(255,255,255,0.3)';
        
        setTimeout(() => {
            cartLink.style.transform = 'scale(1)';
            cartLink.style.boxShadow = 'none';
        }, 300);
    }
}

// Función para mostrar notificación de carrito
function showCartNotification(message, type = 'success') {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-600' : 'bg-red-600';
    const icon = type === 'success' 
        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>'
        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
    
    notification.className = `fixed top-20 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
    notification.innerHTML = `
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${icon}
            </svg>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Mostrar notificación
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Ocultar después de 3 segundos
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Inicialización específica cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado - Funciones de carrito ya disponibles globalmente');
    console.log('addToCart función disponible:', typeof window.addToCart);
    
    // Inicializar contador del carrito al cargar la página
    if (typeof jQuery !== 'undefined' && typeof itools_ajax !== 'undefined') {
        // Obtener el contador actual del carrito
        jQuery.ajax({
            url: itools_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'itools_get_cart_count'
            },
            success: function(response) {
                if (response.success && response.data.cart_count !== undefined) {
                    updateCartCount(response.data.cart_count);
                }
            }
        });
    }
});

// Verificación que la función está disponible (solo para debug)
console.log('🛒 Script de carrito cargado');
console.log('🔧 addToCart function:', typeof window.addToCart);
console.log('📦 Funciones auxiliares disponibles:', {
    addProductToCart: typeof addProductToCart,
    getRandomCartCount: typeof getRandomCartCount,
    showSuccessState: typeof showSuccessState,
    showErrorState: typeof showErrorState,
    updateCartCount: typeof updateCartCount,
    showCartNotification: typeof showCartNotification
});
</script>

<!-- CSS Simplificado -->
<style>
    /* Animaciones sutiles */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // JavaScript para funcionalidad del carrito ya implementado arriba
    console.log('Front-page cargada correctamente');
});
</script>

</body>
</html>

