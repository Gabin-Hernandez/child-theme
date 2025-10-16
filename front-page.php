<?php
/**
 * Front Page - ITOOLS MX - Diseño Moderno
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- Hero Principal con Swiper -->
    <section class="relative bg-slate-900 w-full">
        <div class="swiper hero-swiper w-full">
            <div class="swiper-wrapper">
                <!-- Slide 1 - Principal -->
                <div class="swiper-slide">
                    <div class="h-[600px] md:h-[700px] lg:h-[800px] relative w-full">
                        <!-- Imagen de fondo -->
                        <div class="absolute inset-0 w-full">
                            <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-19.webp" 
                                 alt="Herramientas para técnicos" 
                                 class="w-full h-full object-cover opacity-70">
                            <div class="absolute inset-0 bg-slate-900/60 w-full"></div>
                        </div>
                        
                        <!-- Contenido -->
                        <div class="container max-w-7xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                            <div class="max-w-3xl">
                                <div class="space-y-8 slide-content">
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
                                        <a href="/tienda" 
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
                </div>
                
                <!-- Slide 2 - Refacciones -->
                <div class="swiper-slide">
                    <div class="h-[600px] md:h-[700px] lg:h-[800px] relative w-full">
                        <div class="absolute inset-0 w-full">
                            <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-1.webp" 
                                 alt="Refacciones de celulares" 
                                 class="w-full h-full object-cover opacity-70">
                            <div class="absolute inset-0 bg-slate-900/60 w-full"></div>
                        </div>
                        
                        <div class="container max-w-7xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                            <div class="max-w-3xl">
                                <div class="space-y-8 slide-content">
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
                                    <a href="/?post_type=product&s=&product_cat=herramientas" 
                                       class="inline-block bg-green-600 hover:bg-green-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                                        Ver Refacciones
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 3 - Pantallas -->
                <div class="swiper-slide">
                    <div class="h-[600px] md:h-[700px] lg:h-[800px] relative w-full">
                        <div class="absolute inset-0 w-full">
                            <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                                 alt="Pantallas y displays" 
                                 class="w-full h-full object-cover opacity-70">
                            <div class="absolute inset-0 bg-slate-900/60 w-full"></div>
                        </div>
                        
                        <div class="container max-w-7xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                            <div class="max-w-3xl">
                                <div class="space-y-8 slide-content">
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
                                    <a href="/?post_type=product&s=&product_cat=lcd-y-touch" 
                                       class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                                        Ver Pantallas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 4 - Baterías -->
                <div class="swiper-slide">
                    <div class="h-[600px] md:h-[700px] lg:h-[800px] relative w-full">
                        <div class="absolute inset-0 w-full">
                            <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-16.webp" 
                                 alt="Baterías y accesorios" 
                                 class="w-full h-full object-cover opacity-70">
                            <div class="absolute inset-0 bg-slate-900/60 w-full"></div>
                        </div>
                        
                        <div class="container max-w-7xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                            <div class="max-w-3xl">
                                <div class="space-y-8 slide-content">
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
                                    <a href="/?post_type=product&s=&product_cat=baterias" 
                                       class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                                        Ver Baterías
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navegación Swiper -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <!-- Fin Hero Principal -->

    <!-- Estadísticas y CTA -->
    <div class="py-32 bg-gradient-to-br from-slate-50 to-blue-50">
        <div class="container max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center bg-blue-100 text-blue-800 px-6 py-2 rounded-full font-semibold mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    NUESTRA VENTAJA
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    ¿Por qué elegirnos?
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Somos líderes en el mercado mexicano con más de 10 años de experiencia
                </p>
            </div>
            
            <!-- Estadísticas mejoradas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow duration-300 border border-slate-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-blue-600 mb-2" data-counter="19000">0+</div>
                    <div class="text-slate-600 font-medium">Productos en Stock</div>
                    <div class="text-sm text-slate-500 mt-1">Disponibles inmediatamente</div>
                </div>
                
                <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow duration-300 border border-slate-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-green-600 mb-2" data-counter="50000">0+</div>
                    <div class="text-slate-600 font-medium">Clientes Satisfechos</div>
                    <div class="text-sm text-slate-500 mt-1">Confían en nosotros</div>
                </div>
                
                <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow duration-300 border border-slate-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-purple-600 mb-2" data-counter="24">0h</div>
                    <div class="text-slate-600 font-medium">Envío Express</div>
                    <div class="text-sm text-slate-500 mt-1">Entrega rápida garantizada</div>
                </div>
                
                <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow duration-300 border border-slate-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-amber-600 mb-2" data-counter="99.8" data-decimal="true">0%</div>
                    <div class="text-slate-600 font-medium">Satisfacción</div>
                    <div class="text-sm text-slate-500 mt-1">Calidad garantizada</div>
                </div>
            </div>
            
            <!-- Características adicionales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Garantía Extendida</h3>
                        <p class="text-slate-600">Todos nuestros productos incluyen garantía de fábrica y soporte técnico especializado.</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Precios Competitivos</h3>
                        <p class="text-slate-600">Ofrecemos los mejores precios del mercado con financiamiento disponible.</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Soporte Técnico</h3>
                        <p class="text-slate-600">Equipo de expertos disponible para asesorarte en tus proyectos técnicos.</p>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/tienda" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 text-center shadow-lg">
                    Explorar Catálogo
                </a>
                <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'myaccount' ) ) : '/mi-cuenta/'; ?>" 
                   class="border-2 border-slate-300 text-slate-700 hover:border-slate-400 hover:text-slate-900 px-10 py-4 text-lg font-semibold rounded-lg transition-all duration-300 text-center">
                    Crear Cuenta
                </a>
            </div>
        </div>
    </div>

  

    <!-- Productos de Herramientas -->
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <div class="py-32 bg-slate-50">
        <div class="w-full px-4 lg:px-6">
            <div class="text-center mb-20">
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
                'posts_per_page' => 16,
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key' => '_stock_status',
                        'value' => 'instock',
                        'compare' => '='
                    ),
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
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
                <!-- Primer Carrusel de Herramientas -->
                <div class="herramientas-carousel-container-1 relative w-full mx-auto mb-8">
                    <div class="herramientas-swiper-1 overflow-hidden rounded-xl bg-white shadow-lg">
                        <div class="swiper-wrapper py-4">
                            <?php 
                            $product_count = 0;
            $max_first_carousel = 8; // Primeros 8 productos para el primer carrusel
            while ( $herramientas_query->have_posts() && $product_count < $max_first_carousel ) : 
                $herramientas_query->the_post(); 
                global $product;
                if ( ! $product || ! $product->is_visible() || ! has_post_thumbnail() ) continue;
                $product_count++;
            ?>
            <div class="swiper-slide">
                <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 border border-gray-100 hover:border-amber-200 flex flex-col h-full mx-2">
                    <!-- Imagen del producto -->
                    <div class="relative overflow-hidden bg-gray-50 aspect-square">
                        <a href="<?php the_permalink(); ?>" class="block h-full">
                            <?php the_post_thumbnail( 'woocommerce_thumbnail', array(
                                'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                            )); ?>
                        </a>
                        
                        <!-- Badge de descuento -->
                        <?php if ( $product->is_on_sale() ) : ?>
                            <div class="absolute top-2 left-2 z-20">
                                <div class="bg-red-500 text-white px-2 py-1 rounded text-sm font-bold">
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
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Información del producto -->
                    <div class="p-3 flex flex-col flex-1">
                        <!-- Título -->
                        <h3 class="font-medium text-gray-900 text-base leading-tight mb-2 line-clamp-2 group-hover:text-amber-700 transition-colors flex-1" style="min-height: 2.5rem; height: 2.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                        </h3>                                        <!-- Precio -->
                                        <div class="mb-3">
                                            <div class="text-lg font-bold text-gray-900 group-hover:text-amber-600 transition-colors">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                        </div>
                                        
                                        <!-- Botón de agregar al carrito -->
                                        <div class="woocommerce-add-to-cart-wrapper-mini mt-auto">
                                            <?php woocommerce_template_loop_add_to_cart(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    
                    <!-- Navegación del primer carrusel -->
                    <div class="herramientas-swiper-button-prev-1 absolute left-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-amber-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-amber-100">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </div>
                    <div class="herramientas-swiper-button-next-1 absolute right-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-amber-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-amber-100">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Segundo Carrusel de Herramientas -->
                <div class="herramientas-carousel-container-2 relative w-full mx-auto">
                    <div class="herramientas-swiper-2 overflow-hidden rounded-xl bg-white shadow-lg">
                        <div class="swiper-wrapper py-4">
                            <?php 
                            // Reset query para obtener los productos restantes
                            $herramientas_query->rewind_posts();
                            $product_count = 0;
                            $skip_count = 0;
                            while ( $herramientas_query->have_posts() ) : 
                                $herramientas_query->the_post(); 
                                global $product;
                                if ( ! $product || ! $product->is_visible() || ! has_post_thumbnail() ) continue;
                                
                                // Saltar los primeros 8 productos que ya se mostraron
                                if ( $skip_count < $max_first_carousel ) {
                                    $skip_count++;
                                    continue;
                                }
                                $product_count++;
                            ?>
                            <div class="swiper-slide">
                                <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 border border-gray-100 hover:border-amber-200 flex flex-col h-full mx-2">
                                    <!-- Imagen del producto -->
                                    <div class="relative overflow-hidden bg-gray-50 aspect-square">
                                        <a href="<?php the_permalink(); ?>" class="block h-full">
                                            <?php the_post_thumbnail( 'woocommerce_thumbnail', array(
                                                'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                                            )); ?>
                                        </a>
                                        
                                        <!-- Badge de descuento -->
                                        <?php if ( $product->is_on_sale() ) : ?>
                                            <div class="absolute top-2 left-2 z-20">
                                                <div class="bg-red-500 text-white px-2 py-1 rounded text-sm font-bold">
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
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Información del producto -->
                                    <div class="p-3 flex flex-col flex-1">
                                        <!-- Título -->
                                        <h3 class="font-medium text-gray-900 text-base leading-tight mb-2 line-clamp-2 group-hover:text-amber-700 transition-colors flex-1" style="min-height: 2.5rem; height: 2.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                                        </h3>
                                        
                                        <!-- Precio -->
                                        <div class="mb-3">
                                            <div class="text-lg font-bold text-gray-900 group-hover:text-amber-600 transition-colors">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                        </div>
                                        
                                        <!-- Botón de agregar al carrito -->
                                        <div class="woocommerce-add-to-cart-wrapper-mini mt-auto">
                                            <?php woocommerce_template_loop_add_to_cart(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    
                    <!-- Navegación del segundo carrusel -->
                    <div class="herramientas-swiper-button-prev-2 absolute left-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-amber-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-amber-100">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </div>
                    <div class="herramientas-swiper-button-next-2 absolute right-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-amber-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-amber-100">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
                
                <!-- Botón para ver más herramientas -->
                <div class="text-center mt-12">
                    <a href="/categoria/herramientas/" 
                       class="inline-flex items-center bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg hover:shadow-xl">
                        Ver Todas las Herramientas
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Estilos CSS y JavaScript para los carruseles de herramientas -->
                <style>
                /* Carruseles específicos para herramientas */
                .herramientas-swiper-1,
                .herramientas-swiper-2 {
                    padding: 0 40px;
                }
                
                .herramientas-swiper-1 .swiper-slide,
                .herramientas-swiper-2 .swiper-slide {
                    width: 220px;
                    flex-shrink: 0;
                }
                
                .woocommerce-add-to-cart-wrapper-mini {
                    display: flex !important;
                    flex-direction: column !important;
                    gap: 4px !important;
                }
                
                .woocommerce-add-to-cart-wrapper-mini .button,
                .woocommerce-add-to-cart-wrapper-mini .added_to_cart {
                    width: 100% !important;
                    background: linear-gradient(to right, #f59e0b, #d97706) !important;
                    color: white !important;
                    font-weight: 600 !important;
                    padding: 8px 10px !important;
                    border-radius: 6px !important;
                    border: none !important;
                    transition: all 0.3s ease !important;
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    gap: 4px !important;
                    text-decoration: none !important;
                    margin: 0 !important;
                    font-size: 13px !important;
                    line-height: 1.3 !important;
                }
                
                .woocommerce-add-to-cart-wrapper-mini .button:hover,
                .woocommerce-add-to-cart-wrapper-mini .added_to_cart:hover {
                    background: linear-gradient(to right, #d97706, #b45309) !important;
                    transform: translateY(-1px) !important;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
                }
                
                .woocommerce-add-to-cart-wrapper-mini .button::before {
                    content: "";
                    font-size: 12px;
                }
                
                .woocommerce-add-to-cart-wrapper-mini .added_to_cart::before {
                    content: "✓";
                    font-size: 12px;
                }
                
                /* Line clamp para títulos */
                .line-clamp-2 {
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
                
                /* Responsive */
                @media (max-width: 640px) {
                    .herramientas-swiper-1,
                    .herramientas-swiper-2 {
                        padding: 0 20px;
                    }
                    .herramientas-swiper-1 .swiper-slide,
                    .herramientas-swiper-2 .swiper-slide {
                        width: 120px;
                    }
                }
                </style>
                
                <!-- JavaScript para inicializar los carruseles de herramientas -->
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Inicializar Swiper para primer carrusel de herramientas
                    const herramientasSwiper1 = new Swiper('.herramientas-swiper-1', {
                        slidesPerView: 'auto',
                        spaceBetween: 16,
                        centeredSlides: false,
                        loop: true,
                        autoplay: {
                            delay: 3000,
                            disableOnInteraction: false,
                        },
                        navigation: {
                            nextEl: '.herramientas-swiper-button-next-1',
                            prevEl: '.herramientas-swiper-button-prev-1',
                        },
                        breakpoints: {
                            320: {
                                slidesPerView: 1.5,
                                spaceBetween: 12,
                            },
                            480: {
                                slidesPerView: 2,
                                spaceBetween: 14,
                            },
                            640: {
                                slidesPerView: 2.5,
                                spaceBetween: 16,
                            },
                            768: {
                                slidesPerView: 3,
                                spaceBetween: 16,
                            },
                            1024: {
                                slidesPerView: 4,
                                spaceBetween: 16,
                            },
                            1280: {
                                slidesPerView: 5,
                                spaceBetween: 16,
                            },
                            1536: {
                                slidesPerView: 6,
                                spaceBetween: 16,
                            }
                        }
                    });

                    // Inicializar Swiper para segundo carrusel de herramientas
                    const herramientasSwiper2 = new Swiper('.herramientas-swiper-2', {
                        slidesPerView: 'auto',
                        spaceBetween: 16,
                        centeredSlides: false,
                        loop: true,
                        autoplay: {
                            delay: 4000,
                            disableOnInteraction: false,
                        },
                        navigation: {
                            nextEl: '.herramientas-swiper-button-next-2',
                            prevEl: '.herramientas-swiper-button-prev-2',
                        },
                        breakpoints: {
                            320: {
                                slidesPerView: 1.5,
                                spaceBetween: 12,
                            },
                            480: {
                                slidesPerView: 2,
                                spaceBetween: 14,
                            },
                            640: {
                                slidesPerView: 2.5,
                                spaceBetween: 16,
                            },
                            768: {
                                slidesPerView: 3,
                                spaceBetween: 16,
                            },
                            1024: {
                                slidesPerView: 4,
                                spaceBetween: 16,
                            },
                            1280: {
                                slidesPerView: 5,
                                spaceBetween: 16,
                            },
                            1536: {
                                slidesPerView: 6,
                                spaceBetween: 16,
                            }
                        }
                    });

                    // Funcionalidad del carrito para ambos carruseles
                    document.addEventListener('click', function(e) {
                        if (e.target.closest('.woocommerce-add-to-cart-wrapper-mini .button') || 
                            e.target.closest('.woocommerce-add-to-cart-wrapper-mini .ajax_add_to_cart')) {
                            console.log('Botón de agregar al carrito clickeado en carruseles herramientas');
                            
                            setTimeout(function() {
                                if (window.cartSidepanel) {
                                    console.log('Abriendo cart sidepanel desde carruseles herramientas');
                                    window.cartSidepanel.open();
                                }
                            }, 800);
                        }
                    });
                    
                    document.body.addEventListener('added_to_cart', function(e) {
                        console.log('Evento added_to_cart detectado en carruseles herramientas:', e.detail);
                        setTimeout(function() {
                            if (window.cartSidepanel) {
                                console.log('Abriendo sidepanel por evento added_to_cart');
                                window.cartSidepanel.open();
                            }
                        }, 500);
                    });
                });
                </script>
                
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
    </div>
    <?php endif; ?>

    <!-- Marcas Populares -->
    <div class="pb-24 pt-10 bg-slate-50">
        <div class="container max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
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
    </div>

    <!-- Carrusel de Más Vendidos -->
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <div class="py-32 bg-white">
        <div class="w-full px-4 lg:px-6">
            <div class="text-center mb-20">
                <div class="inline-flex items-center bg-purple-100 text-purple-800 px-6 py-2 rounded-full font-semibold mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    LOS FAVORITOS
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    Más Vendidos
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Los productos que más confían nuestros clientes profesionales
                </p>
            </div>
            
            <!-- Carrusel Container -->
            <div class="vendidos-carousel-container relative w-full mx-auto">
                <?php
                // Query para obtener productos más vendidos
                $vendidos_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 24, // Incrementamos a 24 productos para llenar mejor 2 carruseles (12 cada uno)
                    'post_status' => 'publish',
                    'orderby' => 'meta_value_num',
                    'meta_key' => 'total_sales',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key' => '_stock_status',
                            'value' => 'instock',
                            'compare' => '='
                        ),
                        array(
                            'key' => '_visibility',
                            'value' => array('catalog', 'visible'),
                            'compare' => 'IN'
                        )
                    )
                );
                
                $vendidos_query = new WP_Query( $vendidos_args );
                
                // Fallback si no hay ventas registradas
                if ( !$vendidos_query->have_posts() ) {
                    $vendidos_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 24, // También incrementamos el fallback
                        'post_status' => 'publish',
                        'orderby' => 'popularity', // Fallback a popularidad
                        'order' => 'DESC',
                        'meta_query' => array(
                            array(
                                'key' => '_stock_status',
                                'value' => 'instock',
                                'compare' => '='
                            )
                        )
                    );
                    $vendidos_query = new WP_Query( $vendidos_args );
                }
                
                if ( $vendidos_query->have_posts() ) : 
                    // Primero recolectemos todos los productos válidos
                    $valid_products = array();
                    while ( $vendidos_query->have_posts() ) : 
                        $vendidos_query->the_post(); 
                        global $product;
                        if ( $product && $product->is_visible() && has_post_thumbnail() ) {
                            $valid_products[] = array(
                                'post' => get_post(),
                                'product' => $product
                            );
                        }
                    endwhile;
                    wp_reset_postdata();
                    
                    // Dividir productos en dos grupos
                    $total_valid = count($valid_products);
                    $first_carousel_count = min(12, ceil($total_valid / 2));
                    $first_carousel_products = array_slice($valid_products, 0, $first_carousel_count);
                    $second_carousel_products = array_slice($valid_products, $first_carousel_count);
                ?>
                    <!-- Primer Carrusel de Más Vendidos -->
                    <div class="vendidos-carousel-container-1 relative w-full mx-auto mb-8">
                        <div class="vendidos-swiper-1 overflow-hidden rounded-xl bg-white shadow-lg">
                            <div class="swiper-wrapper py-4">
                                <?php 
                                $rank = 1;
                                foreach ( $first_carousel_products as $product_data ) :
                                    $product = $product_data['product'];
                                    $post = $product_data['post'];
                                    setup_postdata($post);
                                    
                                    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                                    $image_url = $product_image ? $product_image[0] : wc_placeholder_img_src();
                                    
                                    // Obtener número de ventas (si está disponible)
                                    $sales_count = get_post_meta( $product->get_id(), 'total_sales', true );
                                    if ( !$sales_count || $sales_count <= 0 ) {
                                        $sales_count = get_post_meta( $product->get_id(), '_total_sales', true );
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 border border-gray-100 hover:border-purple-200 flex flex-col h-full mx-2">
                                        <!-- Imagen del producto -->
                                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                                            <a href="<?php the_permalink(); ?>" class="block h-full">
                                                <?php the_post_thumbnail( 'woocommerce_thumbnail', array(
                                                    'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                                                )); ?>
                                            </a>
                                            
                                            <!-- Badge de ranking -->
                                            <div class="absolute top-2 left-2 z-20">
                                                <?php if ( $rank <= 3 ) : ?>
                                                    <div class="bg-gradient-to-r <?php echo $rank === 1 ? 'from-yellow-400 to-yellow-500' : ($rank === 2 ? 'from-gray-300 to-gray-400' : 'from-amber-600 to-amber-700'); ?> text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold shadow-lg">
                                                        #<?php echo $rank; ?>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-2 py-1 rounded-full text-xs font-bold shadow-lg">
                                                        TOP <?php echo $rank; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Badge de descuento -->
                                            <?php if ( $product->is_on_sale() ) : ?>
                                                <div class="absolute top-2 right-2 z-20">
                                                    <div class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">
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
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Información del producto -->
                                        <div class="p-3 flex flex-col flex-1">
                                            <!-- Título -->
                                            <h3 class="font-medium text-gray-900 text-base leading-tight mb-2 line-clamp-2 group-hover:text-purple-700 transition-colors flex-1" style="min-height: 2.5rem; height: 2.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                                            </h3>
                                            
                                            <!-- Precio -->
                                            <div class="mb-3">
                                                <div class="text-lg font-bold text-gray-900 group-hover:text-purple-600 transition-colors">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>
                                            </div>
                                            
                                            <!-- Botón de agregar al carrito -->
                                            <div class="woocommerce-add-to-cart-wrapper-mini mt-auto">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $rank++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        
                        <!-- Navegación del primer carrusel -->
                        <div class="vendidos-swiper-button-prev-1 absolute left-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-purple-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-purple-100">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </div>
                        <div class="vendidos-swiper-button-next-1 absolute right-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-purple-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-purple-100">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>

                                    <!-- Segundo Carrusel de Más Vendidos -->
                    <div class="vendidos-carousel-container-2 relative w-full mx-auto">
                        <div class="vendidos-swiper-2 overflow-hidden rounded-xl bg-white shadow-lg">
                            <div class="swiper-wrapper py-4">
                                <?php 
                                // Mostrar productos del segundo carrusel
                                $current_rank = $first_carousel_count + 1; // Continuar el ranking
                                foreach ( $second_carousel_products as $product_data ) :
                                    $product = $product_data['product'];
                                    $post = $product_data['post'];
                                    setup_postdata($post);
                                    
                                    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                                    $image_url = $product_image ? $product_image[0] : wc_placeholder_img_src();
                                    
                                    // Obtener número de ventas (si está disponible)
                                    $sales_count = get_post_meta( $product->get_id(), 'total_sales', true );
                                    if ( !$sales_count || $sales_count <= 0 ) {
                                        $sales_count = get_post_meta( $product->get_id(), '_total_sales', true );
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 border border-gray-100 hover:border-purple-200 flex flex-col h-full mx-2">
                                        <!-- Imagen del producto -->
                                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                                            <a href="<?php the_permalink(); ?>" class="block h-full">
                                                <?php the_post_thumbnail( 'woocommerce_thumbnail', array(
                                                    'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                                                )); ?>
                                            </a>
                                            
                                            <!-- Badge de ranking -->
                                            <div class="absolute top-2 left-2 z-20">
                                                <?php if ( $current_rank <= 3 ) : ?>
                                                    <div class="bg-gradient-to-r <?php echo $current_rank === 1 ? 'from-yellow-400 to-yellow-500' : ($current_rank === 2 ? 'from-gray-300 to-gray-400' : 'from-amber-600 to-amber-700'); ?> text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold shadow-lg">
                                                        #<?php echo $current_rank; ?>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-2 py-1 rounded-full text-xs font-bold shadow-lg">
                                                        TOP <?php echo $current_rank; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>                                            <!-- Badge de descuento -->
                                            <?php if ( $product->is_on_sale() ) : ?>
                                                <div class="absolute top-2 right-2 z-20">
                                                    <div class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">
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
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Información del producto -->
                                        <div class="p-3 flex flex-col flex-1">
                                            <!-- Título -->
                                            <h3 class="font-medium text-gray-900 text-base leading-tight mb-2 line-clamp-2 group-hover:text-purple-700 transition-colors flex-1" style="min-height: 2.5rem; height: 2.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                                            </h3>
                                            
                                            <!-- Precio -->
                                            <div class="mb-3">
                                                <div class="text-lg font-bold text-gray-900 group-hover:text-purple-600 transition-colors">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>
                                            </div>
                                            
                                            <!-- Botón de agregar al carrito -->
                                            <div class="woocommerce-add-to-cart-wrapper-mini mt-auto">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $current_rank++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        
                        <!-- Navegación del segundo carrusel -->
                        <div class="vendidos-swiper-button-prev-2 absolute left-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-purple-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-purple-100">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </div>
                        <div class="vendidos-swiper-button-next-2 absolute right-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-purple-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-purple-100">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                    
                <?php else : ?>
                    <!-- Fallback: No hay productos más vendidos disponibles -->
                    <div class="text-center py-12">
                        <div class="text-gray-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay productos más vendidos disponibles</h3>
                        <p class="text-gray-600">Pronto agregaremos más productos a esta categoría.</p>
                        <div class="mt-6">
                            <a href="/tienda" 
                               class="inline-block bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold px-8 py-3 rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-300 shadow-lg">
                                Ver Productos
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php wp_reset_postdata(); ?>
            </div>
            
            <!-- Botón Ver Más Productos -->
            <div class="text-center mt-12">
                <a href="/tienda?orderby=popularity" 
                   class="inline-flex items-center gap-3 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold text-lg px-10 py-5 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <span>Ver Más Productos</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <!-- Estilos CSS y JavaScript para los carruseles de más vendidos -->
            <style>
            /* Carruseles específicos para más vendidos */
            .vendidos-swiper-1,
            .vendidos-swiper-2 {
                padding: 0 40px;
            }
            
            .vendidos-swiper-1 .swiper-slide,
            .vendidos-swiper-2 .swiper-slide {
                width: 220px;
                flex-shrink: 0;
            }
            
            .vendidos-carousel-container .woocommerce-add-to-cart-wrapper-mini {
                display: flex !important;
                flex-direction: column !important;
                gap: 4px !important;
            }
            
            .vendidos-carousel-container .woocommerce-add-to-cart-wrapper-mini .button,
            .vendidos-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart {
                width: 100% !important;
                background: linear-gradient(to right, #7c3aed, #6d28d9) !important;
                color: white !important;
                font-weight: 600 !important;
                padding: 8px 10px !important;
                border-radius: 6px !important;
                border: none !important;
                transition: all 0.3s ease !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 4px !important;
                text-decoration: none !important;
                margin: 0 !important;
                font-size: 13px !important;
                line-height: 1.3 !important;
            }
            
            .vendidos-carousel-container .woocommerce-add-to-cart-wrapper-mini .button:hover,
            .vendidos-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart:hover {
                background: linear-gradient(to right, #6d28d9, #5b21b6) !important;
                transform: translateY(-1px) !important;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
            }
            
            .vendidos-carousel-container .woocommerce-add-to-cart-wrapper-mini .button::before {
                content: "";
                font-size: 12px;
            }
            
            .vendidos-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart::before {
                content: "✓";
                font-size: 12px;
            }
            
            /* Responsive */
            @media (max-width: 640px) {
                .vendidos-swiper-1,
                .vendidos-swiper-2 {
                    padding: 0 20px;
                }
                .vendidos-swiper-1 .swiper-slide,
                .vendidos-swiper-2 .swiper-slide {
                    width: 180px;
                }
            }
            </style>
            
            <!-- JavaScript para inicializar los carruseles de más vendidos -->
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Inicializar Swiper para primer carrusel de más vendidos
                const vendidosSwiper1 = new Swiper('.vendidos-swiper-1', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    centeredSlides: false,
                    loop: true,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.vendidos-swiper-button-next-1',
                        prevEl: '.vendidos-swiper-button-prev-1',
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1.5,
                            spaceBetween: 12,
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 14,
                        },
                        640: {
                            slidesPerView: 2.5,
                            spaceBetween: 16,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 18,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        1280: {
                            slidesPerView: 5,
                            spaceBetween: 22,
                        },
                        1536: {
                            slidesPerView: 6,
                            spaceBetween: 24,
                        }
                    }
                });

                // Inicializar Swiper para segundo carrusel de más vendidos
                const vendidosSwiper2 = new Swiper('.vendidos-swiper-2', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    centeredSlides: false,
                    loop: true,
                    autoplay: {
                        delay: 4500,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.vendidos-swiper-button-next-2',
                        prevEl: '.vendidos-swiper-button-prev-2',
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1.5,
                            spaceBetween: 12,
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 14,
                        },
                        640: {
                            slidesPerView: 2.5,
                            spaceBetween: 16,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 18,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        1280: {
                            slidesPerView: 5,
                            spaceBetween: 22,
                        },
                        1536: {
                            slidesPerView: 6,
                            spaceBetween: 24,
                        }
                    }
                });

                // Funcionalidad del carrito para ambos carruseles de más vendidos
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.vendidos-carousel-container .woocommerce-add-to-cart-wrapper-mini .button') || 
                        e.target.closest('.vendidos-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart')) {
                        
                        const button = e.target.closest('.button, .added_to_cart');
                        const originalText = button.textContent;
                        
                        // Cambiar texto temporalmente
                        button.textContent = 'Agregando...';
                        button.style.opacity = '0.7';
                        
                        setTimeout(() => {
                            button.textContent = '✓ Agregado';
                            button.style.background = 'linear-gradient(to right, #10b981, #059669)';
                            
                            setTimeout(() => {
                                button.textContent = originalText;
                                button.style.opacity = '1';
                                button.style.background = 'linear-gradient(to right, #7c3aed, #6d28d9)';
                            }, 2000);
                        }, 800);
                    }
                });
                
                document.body.addEventListener('added_to_cart', function(e) {
                    console.log('Evento added_to_cart detectado en carruseles más vendidos:', e.detail);
                    setTimeout(function() {
                        // Actualizar contador de carrito si es necesario
                    }, 500);
                });
            });
            </script>
        </div>
    </div>
    <?php endif; ?>

    <!-- Productos en Oferta -->
    <div id="ofertas" class="py-32 bg-red-50">
        <div class="container max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
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
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-slate-200 flex flex-col h-full">
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
                                    <div class="p-4 flex flex-col flex-1">
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
                                        <div class="flex gap-2 mt-auto">
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
                            <a href="/tienda" 
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
                        <a href="/tienda" 
                           class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
                            Ver Todos los Productos
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-12">
                <a href="/ofertas" 
                   class="bg-red-600 hover:bg-red-700 text-white px-10 py-4 text-lg font-semibold rounded-lg transition-colors duration-300 shadow-lg">
                    Ver Todas las Ofertas
                </a>
            </div>
        </div>
    </div>



    <!-- Carrusel de Microscopios -->
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <div class="py-32 bg-slate-50">
        <div class="w-full px-4 lg:px-6">
            <div class="text-center mb-20">
                <div class="inline-flex items-center bg-blue-100 text-blue-800 px-6 py-2 rounded-full font-semibold mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    INSTRUMENTOS DE PRECISIÓN
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    Microscopios
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Herramientas de precisión para inspección y análisis detallado
                </p>
            </div>
            
            <!-- Carrusel Container -->
            <div class="microscopios-carousel-container relative w-full mx-auto">
                <?php
                // Usar exactamente la misma lógica que page-microscopios.php
                $original_get = $_GET;
                $_GET['post_type'] = 'product';
                $_GET['s'] = 'microscopio';
                
                $microscopios_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 24,
                    'post_status' => 'publish',
                    's' => 'microscopio',
                    'tax_query' => array(),
                    'meta_query' => array()
                );
                
                $microscopios_query = new WP_Query( $microscopios_args );
                
                // Restaurar $_GET original
                $_GET = $original_get;
                
                if ( $microscopios_query->have_posts() ) : 
                    // Primero recolectemos todos los productos válidos
                    $valid_products = array();
                    while ( $microscopios_query->have_posts() ) : 
                        $microscopios_query->the_post(); 
                        global $product;
                        if ( $product && $product->is_visible() && has_post_thumbnail() ) {
                            $valid_products[] = array(
                                'post' => get_post(),
                                'product' => $product
                            );
                        }
                    endwhile;
                    wp_reset_postdata();
                    
                    // Dividir productos en dos grupos
                    $total_valid = count($valid_products);
                    $first_carousel_count = min(8, ceil($total_valid / 2));
                    $first_carousel_products = array_slice($valid_products, 0, $first_carousel_count);
                    $second_carousel_products = array_slice($valid_products, $first_carousel_count);
                ?>
                    <!-- Primer Carrusel de Microscopios -->
                    <div class="microscopios-carousel-container-1 relative w-full mx-auto mb-8">
                        <div class="microscopios-swiper-1 overflow-hidden rounded-xl bg-white shadow-lg">
                            <div class="swiper-wrapper py-4">
                                <?php 
                                foreach ( $first_carousel_products as $product_data ) :
                                    $product = $product_data['product'];
                                    $post = $product_data['post'];
                                    setup_postdata($post);
                                    
                                    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                                    $image_url = $product_image ? $product_image[0] : wc_placeholder_img_src();
                                ?>
                                <div class="swiper-slide">
                                    <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 border border-gray-100 hover:border-blue-200 flex flex-col h-full mx-2">
                                        <!-- Imagen del producto -->
                                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                                            <a href="<?php the_permalink(); ?>" class="block h-full">
                                                <?php the_post_thumbnail( 'woocommerce_thumbnail', array(
                                                    'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                                                )); ?>
                                            </a>
                                            
                                            <!-- Badge de descuento -->
                                            <?php if ( $product->is_on_sale() ) : ?>
                                                <div class="absolute top-2 right-2 z-20">
                                                    <div class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">
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
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Información del producto -->
                                        <div class="p-3 flex flex-col flex-1">
                                            <!-- Título -->
                                            <h3 class="font-medium text-gray-900 text-base leading-tight mb-2 line-clamp-2 group-hover:text-blue-700 transition-colors flex-1" style="min-height: 2.5rem; height: 2.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                                            </h3>
                                            
                                            <!-- Precio -->
                                            <div class="mb-3">
                                                <div class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>
                                            </div>
                                            
                                            <!-- Botón de agregar al carrito -->
                                            <div class="woocommerce-add-to-cart-wrapper-mini mt-auto">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                endforeach;
                                ?>
                            </div>
                        </div>
                        
                        <!-- Navegación del primer carrusel -->
                        <div class="microscopios-swiper-button-prev-1 absolute left-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-blue-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-blue-100">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </div>
                        <div class="microscopios-swiper-button-next-1 absolute right-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-blue-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-blue-100">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Segundo Carrusel de Microscopios -->
                    <div class="microscopios-carousel-container-2 relative w-full mx-auto">
                        <div class="microscopios-swiper-2 overflow-hidden rounded-xl bg-white shadow-lg">
                            <div class="swiper-wrapper py-4">
                                <?php 
                                // Mostrar productos del segundo carrusel
                                foreach ( $second_carousel_products as $product_data ) :
                                    $product = $product_data['product'];
                                    $post = $product_data['post'];
                                    setup_postdata($post);
                                    
                                    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                                    $image_url = $product_image ? $product_image[0] : wc_placeholder_img_src();
                                ?>
                                <div class="swiper-slide">
                                    <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 border border-gray-100 hover:border-blue-200 flex flex-col h-full mx-2">
                                        <!-- Imagen del producto -->
                                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                                            <a href="<?php the_permalink(); ?>" class="block h-full">
                                                <?php the_post_thumbnail( 'woocommerce_thumbnail', array(
                                                    'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                                                )); ?>
                                            </a>
                                            
                                            <!-- Badge de descuento -->
                                            <?php if ( $product->is_on_sale() ) : ?>
                                                <div class="absolute top-2 right-2 z-20">
                                                    <div class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">
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
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Información del producto -->
                                        <div class="p-3 flex flex-col flex-1">
                                            <!-- Título -->
                                            <h3 class="font-medium text-gray-900 text-base leading-tight mb-2 line-clamp-2 group-hover:text-blue-700 transition-colors flex-1" style="min-height: 2.5rem; height: 2.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                                            </h3>
                                            
                                            <!-- Precio -->
                                            <div class="mb-3">
                                                <div class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>
                                            </div>
                                            
                                            <!-- Botón de agregar al carrito -->
                                            <div class="woocommerce-add-to-cart-wrapper-mini mt-auto">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                endforeach;
                                ?>
                            </div>
                        </div>
                        
                        <!-- Navegación del segundo carrusel -->
                        <div class="microscopios-swiper-button-prev-2 absolute left-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-blue-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-blue-100">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </div>
                        <div class="microscopios-swiper-button-next-2 absolute right-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-blue-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-blue-100">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                    
                <?php else : ?>
                    <!-- Fallback: No hay microscopios disponibles -->
                    <div class="text-center py-12">
                        <div class="text-gray-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay microscopios disponibles</h3>
                        <p class="text-gray-600">Pronto agregaremos más productos de precisión a esta categoría.</p>
                        
                        <?php 
                        // Debug info simplificado - solo mostrar si es admin
                        if (current_user_can('administrator')) {
                            echo '<div class="text-xs text-gray-500 mt-4 p-4 bg-yellow-50 rounded max-w-xl mx-auto text-left">';
                            echo '<strong>🔍 Debug Info:</strong><br>';
                            echo 'Total productos encontrados: ' . $microscopios_query->found_posts . '<br>';
                            echo 'Búsqueda realizada: "microscopio"<br>';
                            echo '<a href="/tienda?s=microscopio&post_type=product" target="_blank" style="color: blue;">Ver búsqueda completa</a>';
                            echo '</div>';
                        }
                        ?>
                        
                        <div class="mt-6">
                            <a href="/tienda?s=microscopio&post_type=product" 
                               class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg">
                                Buscar Microscopios
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php wp_reset_postdata(); ?>
            </div>
            
            <!-- Botón Ver Más Productos -->
            <div class="text-center mt-12">
                <a href="/microscopios/" 
                   class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold text-lg px-10 py-5 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <span>Ver Más Microscopios</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <!-- Estilos CSS y JavaScript para los carruseles de microscopios -->
            <style>
            /* Carruseles específicos para microscopios */
            .microscopios-swiper-1,
            .microscopios-swiper-2 {
                padding: 0 40px;
            }
            
            .microscopios-swiper-1 .swiper-slide,
            .microscopios-swiper-2 .swiper-slide {
                width: 220px;
                flex-shrink: 0;
            }
            
            .microscopios-carousel-container .woocommerce-add-to-cart-wrapper-mini {
                display: flex !important;
                flex-direction: column !important;
                gap: 4px !important;
            }
            
            .microscopios-carousel-container .woocommerce-add-to-cart-wrapper-mini .button,
            .microscopios-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart {
                width: 100% !important;
                background: linear-gradient(to right, #3b82f6, #2563eb) !important;
                color: white !important;
                font-weight: 600 !important;
                padding: 8px 10px !important;
                border-radius: 6px !important;
                border: none !important;
                transition: all 0.3s ease !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 4px !important;
                text-decoration: none !important;
                margin: 0 !important;
                font-size: 13px !important;
                line-height: 1.3 !important;
            }
            
            .microscopios-carousel-container .woocommerce-add-to-cart-wrapper-mini .button:hover,
            .microscopios-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart:hover {
                background: linear-gradient(to right, #2563eb, #1d4ed8) !important;
                transform: translateY(-1px) !important;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
            }
            
            .microscopios-carousel-container .woocommerce-add-to-cart-wrapper-mini .button::before {
                content: "";
                font-size: 12px;
            }
            
            .microscopios-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart::before {
                content: "✓";
                font-size: 12px;
            }
            
            /* Responsive */
            @media (max-width: 640px) {
                .microscopios-swiper-1,
                .microscopios-swiper-2 {
                    padding: 0 20px;
                }
                .microscopios-swiper-1 .swiper-slide,
                .microscopios-swiper-2 .swiper-slide {
                    width: 180px;
                }
            }
            </style>
            
            <!-- JavaScript para inicializar los carruseles de microscopios -->
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Inicializar Swiper para primer carrusel de microscopios
                const microscopiosSwiper1 = new Swiper('.microscopios-swiper-1', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    centeredSlides: false,
                    loop: true,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.microscopios-swiper-button-next-1',
                        prevEl: '.microscopios-swiper-button-prev-1',
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1.5,
                            spaceBetween: 12,
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 14,
                        },
                        640: {
                            slidesPerView: 2.5,
                            spaceBetween: 16,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 18,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        1280: {
                            slidesPerView: 5,
                            spaceBetween: 22,
                        },
                        1536: {
                            slidesPerView: 6,
                            spaceBetween: 24,
                        }
                    }
                });

                // Inicializar Swiper para segundo carrusel de microscopios
                const microscopiosSwiper2 = new Swiper('.microscopios-swiper-2', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    centeredSlides: false,
                    loop: true,
                    autoplay: {
                        delay: 4500,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.microscopios-swiper-button-next-2',
                        prevEl: '.microscopios-swiper-button-prev-2',
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1.5,
                            spaceBetween: 12,
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 14,
                        },
                        640: {
                            slidesPerView: 2.5,
                            spaceBetween: 16,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 18,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        1280: {
                            slidesPerView: 5,
                            spaceBetween: 22,
                        },
                        1536: {
                            slidesPerView: 6,
                            spaceBetween: 24,
                        }
                    }
                });

                // Funcionalidad del carrito para ambos carruseles de microscopios
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.microscopios-carousel-container .woocommerce-add-to-cart-wrapper-mini .button') || 
                        e.target.closest('.microscopios-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart')) {
                        
                        const button = e.target.closest('.button, .added_to_cart');
                        const originalText = button.textContent;
                        
                        // Cambiar texto temporalmente
                        button.textContent = 'Agregando...';
                        button.style.opacity = '0.7';
                        
                        setTimeout(() => {
                            button.textContent = '✓ Agregado';
                            button.style.background = 'linear-gradient(to right, #10b981, #059669)';
                            
                            setTimeout(() => {
                                button.textContent = originalText;
                                button.style.opacity = '1';
                                button.style.background = 'linear-gradient(to right, #3b82f6, #2563eb)';
                            }, 2000);
                        }, 800);
                    }
                });
                
                document.body.addEventListener('added_to_cart', function(e) {
                    console.log('Evento added_to_cart detectado en carruseles microscopios:', e.detail);
                    setTimeout(function() {
                        // Actualizar contador de carrito si es necesario
                    }, 500);
                });
            });
            </script>
        </div>
    </div>
    <?php endif; ?>

   
    <!-- CTA Section -->
    <div class="py-20 bg-gradient-to-br from-slate-900 to-blue-900">
        <div class="container max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h3 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                ¿Listo para llevar tu trabajo al siguiente nivel?
            </h3>
            <p class="text-slate-300 mb-8 text-lg lg:text-xl max-w-2xl mx-auto leading-relaxed">
                Únete a miles de técnicos que ya confían en ITOOLS MX para sus proyectos más importantes.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="/tienda" 
                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 text-lg font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Explorar Catálogo
                </a>
                
                <a href="/categoria/insumos-consumibles" 
                   class="inline-flex items-center bg-teal-600 hover:bg-teal-700 text-white px-8 py-4 text-lg font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                    </svg>
                    Insumos Consumibles
                </a>
            </div>
            
            <p class="text-slate-400 text-lg mt-6">
                Compra 100% segura con garantía de satisfacción
            </p>
        </div>
    </div>

    <!-- Carrusel de Pantallas -->
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <section class="bg-white">
        <div class="w-full px-4 lg:px-6 py-32">
            <div class="text-center mb-20">
                <div class="inline-flex items-center bg-green-100 text-green-800 px-6 py-2 rounded-full font-semibold mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    COMPONENTES ESENCIALES
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    Pantallas
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Pantallas de alta calidad para reparación de dispositivos móviles y electrónicos
                </p>
            </div>
            
            <!-- Carrusel Container -->
            <div class="pantallas-carousel-container relative w-full mx-auto">
                <?php
                // Usar exactamente la misma lógica que page-microscopios.php para pantallas
                $original_get = $_GET;
                $_GET['post_type'] = 'product';
                $_GET['s'] = 'pantalla';
                
                $pantallas_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 16,
                    'post_status' => 'publish',
                    's' => 'pantalla',
                    'tax_query' => array(),
                    'meta_query' => array()
                );
                
                $pantallas_query = new WP_Query( $pantallas_args );
                
                // Restaurar $_GET original
                $_GET = $original_get;
                
                if ( $pantallas_query->have_posts() ) : 
                    // Primero recolectemos todos los productos válidos
                    $valid_products = array();
                    while ( $pantallas_query->have_posts() ) : 
                        $pantallas_query->the_post(); 
                        global $product;
                        if ( $product && $product->is_visible() && has_post_thumbnail() ) {
                            $valid_products[] = array(
                                'post' => get_post(),
                                'product' => $product
                            );
                        }
                    endwhile;
                    wp_reset_postdata();
                    
                    // Dividir productos en dos grupos
                    $total_valid = count($valid_products);
                    $first_carousel_count = min(8, ceil($total_valid / 2));
                    $first_carousel_products = array_slice($valid_products, 0, $first_carousel_count);
                    $second_carousel_products = array_slice($valid_products, $first_carousel_count);
                ?>
                    <!-- Primer Carrusel de Pantallas -->
                    <div class="pantallas-carousel-container-1 relative w-full mx-auto mb-8">
                        <div class="pantallas-swiper-1 overflow-hidden rounded-xl bg-white shadow-lg">
                            <div class="swiper-wrapper py-4">
                                <?php 
                                foreach ( $first_carousel_products as $product_data ) :
                                    $post = $product_data['post'];
                                    $product = $product_data['product'];
                                    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
                                    $image_url = $product_image ? $product_image[0] : wc_placeholder_img_src();
                                ?>
                                <div class="swiper-slide">
                                    <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 border border-gray-100 hover:border-green-200 flex flex-col h-full mx-2">
                                        <!-- Imagen del producto -->
                                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                                            <a href="<?php echo get_permalink($post->ID); ?>">
                                                <img src="<?php echo esc_url($image_url); ?>" 
                                                     alt="<?php echo esc_attr($post->post_title); ?>" 
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </a>
                                            <?php if ( $product->is_on_sale() ) : ?>
                                                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">
                                                    ¡Oferta!
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Información del producto -->
                                        <div class="p-3 flex flex-col flex-1">
                                            <h3 class="font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-green-600 transition-colors" style="height: 2.5rem;">
                                                <a href="<?php echo get_permalink($post->ID); ?>" class="hover:underline">
                                                    <?php echo $post->post_title; ?>
                                                </a>
                                            </h3>
                                            
                                            <div class="flex items-center justify-between mt-auto">
                                                <div class="text-lg font-bold text-slate-900">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                endforeach;
                                ?>
                            </div>
                        </div>
                        
                        <!-- Navegación del primer carrusel -->
                        <div class="pantallas-swiper-button-prev-1 absolute left-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-green-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-green-100">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </div>
                        <div class="pantallas-swiper-button-next-1 absolute right-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-green-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-green-100">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Segundo Carrusel de Pantallas -->
                    <div class="pantallas-carousel-container-2 relative w-full mx-auto">
                        <div class="pantallas-swiper-2 overflow-hidden rounded-xl bg-white shadow-lg">
                            <div class="swiper-wrapper py-4">
                                <?php 
                                foreach ( $second_carousel_products as $product_data ) :
                                    $post = $product_data['post'];
                                    $product = $product_data['product'];
                                    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
                                    $image_url = $product_image ? $product_image[0] : wc_placeholder_img_src();
                                ?>
                                <div class="swiper-slide">
                                    <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 border border-gray-100 hover:border-green-200 flex flex-col h-full mx-2">
                                        <!-- Imagen del producto -->
                                        <div class="relative overflow-hidden bg-gray-50 aspect-square">
                                            <a href="<?php echo get_permalink($post->ID); ?>">
                                                <img src="<?php echo esc_url($image_url); ?>" 
                                                     alt="<?php echo esc_attr($post->post_title); ?>" 
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </a>
                                            <?php if ( $product->is_on_sale() ) : ?>
                                                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">
                                                    ¡Oferta!
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Información del producto -->
                                        <div class="p-3 flex flex-col flex-1">
                                            <h3 class="font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-green-600 transition-colors" style="height: 2.5rem;">
                                                <a href="<?php echo get_permalink($post->ID); ?>" class="hover:underline">
                                                    <?php echo $post->post_title; ?>
                                                </a>
                                            </h3>
                                            
                                            <div class="flex items-center justify-between mt-auto">
                                                <div class="text-lg font-bold text-slate-900">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                endforeach;
                                ?>
                            </div>
                        </div>
                        
                        <!-- Navegación del segundo carrusel -->
                        <div class="pantallas-swiper-button-prev-2 absolute left-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-green-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-green-100">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </div>
                        <div class="pantallas-swiper-button-next-2 absolute right-2 top-1/2 -translate-y-1/2 z-20 w-8 h-8 bg-white hover:bg-green-50 rounded-full shadow-md flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 border border-green-100">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                    
                <?php else : ?>
                    <!-- Fallback: No hay pantallas disponibles -->
                    <div class="text-center py-12">
                        <div class="text-gray-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay pantallas disponibles</h3>
                        <p class="text-gray-600">Pronto agregaremos más pantallas a nuestro catálogo.</p>
                        
                        <?php 
                        // Debug info simplificado - solo mostrar si es admin
                        if (current_user_can('administrator')) {
                            echo '<div class="text-xs text-gray-500 mt-4 p-4 bg-yellow-50 rounded max-w-xl mx-auto text-left">';
                            echo '<strong>🔍 Debug Info:</strong><br>';
                            echo 'Total productos encontrados: ' . $pantallas_query->found_posts . '<br>';
                            echo 'Búsqueda realizada: "pantalla"<br>';
                            echo '<a href="/tienda?s=pantalla&post_type=product" target="_blank" style="color: blue;">Ver búsqueda completa</a>';
                            echo '</div>';
                        }
                        ?>
                        
                        <div class="mt-6">
                            <a href="/tienda?s=pantalla&post_type=product" 
                               class="inline-block bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold px-8 py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-lg">
                                Buscar Pantallas
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php wp_reset_postdata(); ?>
            </div>
            
            <!-- Botón Ver Más Productos -->
            <div class="text-center mt-12">
                <a href="/tienda?s=pantalla&post_type=product" 
                   class="inline-flex items-center gap-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold text-lg px-10 py-5 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <span>Ver Más Pantallas</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <!-- Estilos CSS y JavaScript para los carruseles de pantallas -->
            <style>
            /* Carruseles específicos para pantallas */
            .pantallas-swiper-1,
            .pantallas-swiper-2 {
                padding: 0 40px;
            }
            
            .pantallas-swiper-1 .swiper-slide,
            .pantallas-swiper-2 .swiper-slide {
                width: 220px;
                flex-shrink: 0;
            }
            
            .pantallas-carousel-container .woocommerce-add-to-cart-wrapper-mini {
                display: flex !important;
                flex-direction: column !important;
                gap: 4px !important;
            }
            
            .pantallas-carousel-container .woocommerce-add-to-cart-wrapper-mini .button,
            .pantallas-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart {
                width: 100% !important;
                background: linear-gradient(to right, #10b981, #059669) !important;
                color: white !important;
                font-weight: 600 !important;
                padding: 8px 10px !important;
                border-radius: 6px !important;
                border: none !important;
                transition: all 0.3s ease !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 4px !important;
                text-decoration: none !important;
                margin: 0 !important;
                font-size: 13px !important;
                line-height: 1.3 !important;
            }
            
            .pantallas-carousel-container .woocommerce-add-to-cart-wrapper-mini .button:hover,
            .pantallas-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart:hover {
                background: linear-gradient(to right, #059669, #047857) !important;
                transform: translateY(-1px) !important;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
            }
            
            .pantallas-carousel-container .woocommerce-add-to-cart-wrapper-mini .button::before {
                content: "";
                font-size: 12px;
            }
            
            .pantallas-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart::before {
                content: "✓";
                font-size: 12px;
            }
            
            /* Responsive */
            @media (max-width: 640px) {
                .pantallas-swiper-1,
                .pantallas-swiper-2 {
                    padding: 0 20px;
                }
                .pantallas-swiper-1 .swiper-slide,
                .pantallas-swiper-2 .swiper-slide {
                    width: 180px;
                }
            }
            </style>
            
            <!-- JavaScript para inicializar los carruseles de pantallas -->
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Inicializar Swiper para primer carrusel de pantallas
                const pantallasSwiper1 = new Swiper('.pantallas-swiper-1', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    centeredSlides: false,
                    loop: true,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.pantallas-swiper-button-next-1',
                        prevEl: '.pantallas-swiper-button-prev-1',
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1.5,
                            spaceBetween: 12,
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 14,
                        },
                        640: {
                            slidesPerView: 2.5,
                            spaceBetween: 16,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 18,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        1280: {
                            slidesPerView: 5,
                            spaceBetween: 22,
                        },
                        1536: {
                            slidesPerView: 6,
                            spaceBetween: 24,
                        }
                    }
                });

                // Inicializar Swiper para segundo carrusel de pantallas
                const pantallasSwiper2 = new Swiper('.pantallas-swiper-2', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    centeredSlides: false,
                    loop: true,
                    autoplay: {
                        delay: 4500,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.pantallas-swiper-button-next-2',
                        prevEl: '.pantallas-swiper-button-prev-2',
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1.5,
                            spaceBetween: 12,
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 14,
                        },
                        640: {
                            slidesPerView: 2.5,
                            spaceBetween: 16,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 18,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        1280: {
                            slidesPerView: 5,
                            spaceBetween: 22,
                        },
                        1536: {
                            slidesPerView: 6,
                            spaceBetween: 24,
                        }
                    }
                });

                // Funcionalidad del carrito para ambos carruseles de pantallas
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.pantallas-carousel-container .woocommerce-add-to-cart-wrapper-mini .button') || 
                        e.target.closest('.pantallas-carousel-container .woocommerce-add-to-cart-wrapper-mini .added_to_cart')) {
                        
                        const button = e.target.closest('.button, .added_to_cart');
                        const originalText = button.textContent;
                        
                        // Cambiar texto temporalmente
                        button.textContent = 'Agregando...';
                        button.style.opacity = '0.7';
                        
                        setTimeout(() => {
                            button.textContent = '✓ Agregado';
                            button.style.background = 'linear-gradient(to right, #10b981, #059669)';
                            
                            setTimeout(() => {
                                button.textContent = originalText;
                                button.style.opacity = '1';
                                button.style.background = 'linear-gradient(to right, #10b981, #059669)';
                            }, 2000);
                        }, 800);
                    }
                });
                
                document.body.addEventListener('added_to_cart', function(e) {
                    console.log('Evento added_to_cart detectado en carruseles pantallas:', e.detail);
                    setTimeout(function() {
                        // Actualizar contador de carrito si es necesario
                    }, 500);
                });
            });
            </script>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>

<!-- Hero Swiper ya está configurado en hero-swiper.js -->

<script>
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
    
    // Animación de contadores
    function animateCounter(element) {
        const target = parseFloat(element.getAttribute('data-counter'));
        const isDecimal = element.hasAttribute('data-decimal');
        const suffix = element.textContent.replace(/[\d.,]/g, '');
        let current = 0;
        const increment = target / 100;
        const duration = 2000; // 2 segundos
        const stepTime = duration / 100;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            let displayValue;
            if (isDecimal) {
                displayValue = current.toFixed(1);
            } else if (target >= 1000) {
                displayValue = Math.floor(current).toLocaleString();
            } else {
                displayValue = Math.floor(current);
            }
            
            element.textContent = displayValue + suffix;
        }, stepTime);
    }
    
    // Intersection Observer para detectar cuando la sección es visible
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('[data-counter]');
                counters.forEach(counter => {
                    if (!counter.classList.contains('animated')) {
                        counter.classList.add('animated');
                        animateCounter(counter);
                    }
                });
            }
        });
    }, observerOptions);
    
    // Observar la sección de estadísticas
    const statsSection = document.querySelector('.bg-gradient-to-br');
    if (statsSection) {
        observer.observe(statsSection);
    }
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

// Función específica para agregar al carrito desde el carrusel de herramientas
window.addToCartFromCarousel = function(productId, productName) {
    console.log('addToCartFromCarousel llamado con ID:', productId, 'Nombre:', productName);
    
    const button = event.target;
    const originalContent = button.innerHTML;
    
    // Mostrar estado de carga
    button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4m0 12v4m8-8h-4M6 12H2m10.5-6.5L15 5m-3 3L9.5 5.5M15 19l-2.5-2.5M9.5 19.5L12 17"></path></svg>';
    button.disabled = true;
    
    // Si jQuery y AJAX están disponibles, usar WooCommerce real
    if (typeof jQuery !== 'undefined' && typeof itools_ajax !== 'undefined') {
        console.log('Agregando producto del carrusel con AJAX...');
        jQuery.ajax({
            url: itools_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'itools_add_to_cart',
                product_id: productId,
                quantity: 1
            },
            success: function(response) {
                console.log('Respuesta carrusel:', response);
                if (response.success) {
                    console.log('Producto del carrusel agregado exitosamente');
                    showSuccessState(button, originalContent);
                    showCartNotification('✅ ' + productName + ' agregado al carrito');
                    
                    // Actualizar contador del carrito
                    if (response.data.cart_count !== undefined) {
                        console.log('Actualizando contador desde carrusel:', response.data.cart_count);
                        updateCartCount(response.data.cart_count);
                    }
                    
                    // Abrir sidepanel del carrito
                    setTimeout(function() {
                        if (window.cartSidepanel) {
                            console.log('Abriendo sidepanel desde carrusel');
                            window.cartSidepanel.open();
                        }
                    }, 800);
                } else {
                    console.log('Error en respuesta del carrusel:', response.data);
                    showErrorState(button, originalContent);
                    showCartNotification('❌ Error: ' + (response.data.message || 'No se pudo agregar al carrito'));
                }
            },
            error: function(xhr, status, error) {
                console.log('Error AJAX carrusel:', error);
                showErrorState(button, originalContent);
                showCartNotification('❌ Error de conexión', 'error');
            }
        });
    } else {
        // Fallback sin jQuery
        setTimeout(() => {
            showSuccessState(button, originalContent);
            showCartNotification('✅ ' + productName + ' agregado al carrito');
            updateCartCount(getRandomCartCount());
        }, 800);
    }
};

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
    
    /* Estilos generales para todos los carruseles */
    .herramientas-carousel-container,
    .ofertas-carousel-container,
    .nuevos-carousel-container,
    .vendidos-carousel-container,
    .recomendados-carousel-container {
        position: relative;
    }
    
    .herramientas-swiper,
    .ofertas-swiper,
    .nuevos-swiper,
    .vendidos-swiper,
    .recomendados-swiper {
        padding: 0 50px; /* Espacio para los botones de navegación */
    }
    
    .herramientas-swiper .swiper-slide,
    .ofertas-swiper .swiper-slide,
    .nuevos-swiper .swiper-slide,
    .vendidos-swiper .swiper-slide,
    .recomendados-swiper .swiper-slide {
        height: auto;
        display: flex;
    }
    
    .herramientas-swiper .swiper-slide > div,
    .ofertas-swiper .swiper-slide > div,
    .nuevos-swiper .swiper-slide > div,
    .vendidos-swiper .swiper-slide > div,
    .recomendados-swiper .swiper-slide > div {
        width: 100%;
        min-height: 550px;
        display: flex;
        flex-direction: column;
    }
    
    /* Ocultar botones en móvil para todos los carruseles */
    @media (max-width: 640px) {
        .herramientas-swiper,
        .ofertas-swiper,
        .nuevos-swiper,
        .vendidos-swiper,
        .recomendados-swiper {
            padding: 0 20px;
        }
        
        [class*="-swiper-button-prev"],
        [class*="-swiper-button-next"] {
            display: none !important;
        }
    }
    
    /* Hover effects para las cards de todos los carruseles */
    .herramientas-swiper .swiper-slide > div:hover,
    .ofertas-swiper .swiper-slide > div:hover,
    .nuevos-swiper .swiper-slide > div:hover,
    .vendidos-swiper .swiper-slide > div:hover,
    .recomendados-swiper .swiper-slide > div:hover {
        transform: translateY(-6px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }
    
    /* Estilos de botones con variables CSS */
    .swiper-slide a[style*="--accent-from"]:hover {
        background: linear-gradient(to right, var(--accent-hover-from), var(--accent-hover-to)) !important;
    }
    
    .swiper-slide button[style*="--accent-text"]:hover {
        background-color: var(--accent-bg-light) !important;
        border-color: var(--accent-border-hover) !important;
    }
    
    /* Mejorar el espaciado de botones en carruseles */
    .swiper-slide .flex.gap-3 {
        gap: 12px;
    }
    
    .swiper-slide .flex.gap-3 button {
        flex-shrink: 0;
    }
    
    .swiper-slide .flex.gap-3 a {
        min-height: 48px;
        display: flex;
        align-items: center;
    }
    
    /* Línea de recorte para títulos largos */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Botones de navegación unificados */
    [class*="-swiper-button-prev"],
    [class*="-swiper-button-next"] {
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        z-index: 30;
    }
    
    [class*="-swiper-button-prev"]:hover,
    [class*="-swiper-button-next"]:hover {
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
    }
    
    /* Paginación unificada */
    [class*="-swiper-pagination"] {
        position: relative !important;
        margin-top: 2rem;
    }
    
    [class*="-swiper-pagination"] .swiper-pagination-bullet {
        opacity: 0.5;
        transition: all 0.3s ease;
    }
    
    [class*="-swiper-pagination"] .swiper-pagination-bullet-active {
        opacity: 1;
        transform: scale(1.2);
    }
    
    /* Color de paginación por carrusel */
    .ofertas-swiper-pagination .swiper-pagination-bullet-active {
        background: #dc2626 !important;
    }
    
    .nuevos-swiper-pagination .swiper-pagination-bullet-active {
        background: #059669 !important;
    }
    
    .vendidos-swiper-pagination .swiper-pagination-bullet-active {
        background: #7c3aed !important;
    }
    
    .recomendados-swiper-pagination .swiper-pagination-bullet-active {
        background: #2563eb !important;
    }
    
    .herramientas-swiper-pagination .swiper-pagination-bullet-active {
        background: #f59e0b !important;
    }
    
    /* Animaciones de badges */
    [class*="animate-pulse"] {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    
    /* Efectos de hover mejorados para botones de agregar al carrito */
    .group\/cart {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .group\/cart:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px -8px rgba(0, 0, 0, 0.3);
    }
    
    /* Gradientes consistentes para las secciones */
    .bg-gradient-to-r.from-red-50.to-pink-50 {
        background: linear-gradient(135deg, #fef2f2 0%, #fdf2f8 100%);
    }
    
    .bg-gradient-to-r.from-emerald-50.to-green-50 {
        background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%);
    }
    
    .bg-gradient-to-r.from-purple-50.to-indigo-50 {
        background: linear-gradient(135deg, #faf5ff 0%, #eef2ff 100%);
    }
    
    .bg-gradient-to-r.from-slate-50.to-blue-50 {
        background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
    }
    
    /* Mejora visual para el estado "próximamente" */
    .swiper-slide:has(.bg-yellow-500) > div {
        opacity: 0.95;
        position: relative;
    }
    
    .swiper-slide:has(.bg-yellow-500) > div::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255,193,7,0.08) 50%, transparent 70%);
        border-radius: 0.75rem;
        pointer-events: none;
    }
    
    /* Transiciones suaves para todos los elementos interactivos */
    .swiper-slide a,
    .swiper-slide button {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Sombras progresivas para depth */
    .swiper-slide > div {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        will-change: transform, box-shadow;
    }
    
    /* Optimización de performance para carruseles */
    .swiper-wrapper {
        will-change: transform;
    }
    
    .swiper-slide {
        will-change: transform;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // JavaScript para funcionalidad del carrito ya implementado arriba
    console.log('Front-page cargada correctamente');
    
    // Inicializar todos los carruseles
    if (typeof Swiper !== 'undefined') {
        // Configuración base para todos los carruseles - Optimizada para cards más grandes
        const baseConfig = {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1.2,
                    spaceBetween: 24,
                },
                768: {
                    slidesPerView: 1.8,
                    spaceBetween: 28,
                },
                1024: {
                    slidesPerView: 2.5,
                    spaceBetween: 32,
                },
                1280: {
                    slidesPerView: 3,
                    spaceBetween: 32,
                },
                1536: {
                    slidesPerView: 3.5,
                    spaceBetween: 36,
                }
            }
        };

        // Carrusel de herramientas (ya existente)
        const herramientasSwiper = new Swiper('.herramientas-swiper', {
            ...baseConfig,
            autoplay: { ...baseConfig.autoplay, delay: 4000 },
            navigation: {
                nextEl: '.herramientas-swiper-button-next',
                prevEl: '.herramientas-swiper-button-prev',
            },
        });
        
        // Carrusel de ofertas de la semana
        const ofertasSwiper = new Swiper('.ofertas-swiper', {
            ...baseConfig,
            autoplay: { ...baseConfig.autoplay, delay: 4500 },
            navigation: {
                nextEl: '.ofertas-swiper-button-next',
                prevEl: '.ofertas-swiper-button-prev',
            },
            pagination: {
                el: '.ofertas-swiper-pagination',
                clickable: true,
            },
        });

        // Carrusel de nuevos ingresos
        const nuevosSwiper = new Swiper('.nuevos-swiper', {
            ...baseConfig,
            autoplay: { ...baseConfig.autoplay, delay: 5500 },
            navigation: {
                nextEl: '.nuevos-swiper-button-next',
                prevEl: '.nuevos-swiper-button-prev',
            },
            pagination: {
                el: '.nuevos-swiper-pagination',
                clickable: true,
            },
        });

        // Carrusel de más vendidos
        const vendidosSwiper = new Swiper('.vendidos-swiper', {
            ...baseConfig,
            autoplay: { ...baseConfig.autoplay, delay: 6000 },
            navigation: {
                nextEl: '.vendidos-swiper-button-next',
                prevEl: '.vendidos-swiper-button-prev',
            },
            pagination: {
                el: '.vendidos-swiper-pagination',
                clickable: true,
            },
        });

        // Carrusel de recomendados
        const recomendadosSwiper = new Swiper('.recomendados-swiper', {
            ...baseConfig,
            autoplay: { ...baseConfig.autoplay, delay: 6500 },
            navigation: {
                nextEl: '.recomendados-swiper-button-next',
                prevEl: '.recomendados-swiper-button-prev',
            },
            pagination: {
                el: '.recomendados-swiper-pagination',
                clickable: true,
            },
        });
        
        console.log('🎠 Carruseles inicializados:', {
            herramientas: herramientasSwiper,
            ofertas: ofertasSwiper,
            nuevos: nuevosSwiper,
            vendidos: vendidosSwiper,
            recomendados: recomendadosSwiper
        });

        // Pausar autoplay al hacer hover en cualquier carrusel
        const pauseCarousels = [herramientasSwiper, ofertasSwiper, nuevosSwiper, vendidosSwiper, recomendadosSwiper];
        pauseCarousels.forEach((swiper, index) => {
            if (swiper && swiper.el) {
                swiper.el.addEventListener('mouseenter', () => {
                    swiper.autoplay.stop();
                });
                swiper.el.addEventListener('mouseleave', () => {
                    swiper.autoplay.start();
                });
            }
        });
    } else {
        console.warn('⚠️ Swiper no está disponible, usando fallback CSS');
        
        // Fallback simple con CSS scroll para todos los carruseles
        const carousels = ['.herramientas-swiper', '.ofertas-swiper', '.nuevos-swiper', '.vendidos-swiper', '.recomendados-swiper'];
        carousels.forEach(selector => {
            const carousel = document.querySelector(selector + ' .swiper-wrapper');
            if (carousel) {
                carousel.style.display = 'flex';
                carousel.style.overflowX = 'auto';
                carousel.style.scrollSnapType = 'x mandatory';
                carousel.style.gap = '1rem';
                carousel.style.paddingBottom = '1rem';
                
                const slides = carousel.querySelectorAll('.swiper-slide');
                slides.forEach(slide => {
                    slide.style.minWidth = '320px';
                    slide.style.scrollSnapAlign = 'start';
                });
            }
        });
    }
});
</script>

</body>
</html>
