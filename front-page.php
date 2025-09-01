<?php
/**
 * Front Page - ITOOLS MX - Diseño Moderno
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- Hero Slider -->
    <section class="relative overflow-hidden">
        <div id="hero-slider" class="relative">
            <!-- Slide 1 -->
            <div class="slide active h-96 md:h-[500px] bg-gradient-to-r from-blue-900 to-blue-700 flex items-center relative">
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                <div class="container mx-auto px-4 relative z-10 text-white">
                    <div class="max-w-2xl">
                        <h1 class="text-4xl md:text-6xl font-bold mb-6">ITOOLS MX</h1>
                        <p class="text-xl md:text-2xl mb-8">Las mejores herramientas profesionales para tus proyectos</p>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                           class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 text-lg font-semibold rounded-lg transition duration-300 inline-block">
                            Ver Catálogo Completo
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="slide h-96 md:h-[500px] bg-gradient-to-r from-gray-900 to-gray-700 flex items-center relative hidden">
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                <div class="container mx-auto px-4 relative z-10 text-white">
                    <div class="max-w-2xl">
                        <h2 class="text-4xl md:text-5xl font-bold mb-6">Refacciones Originales</h2>
                        <p class="text-xl mb-8">Encuentra las refacciones que necesitas para mantener tus herramientas en perfecto estado</p>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=refacciones" 
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 text-lg font-semibold rounded-lg transition duration-300 inline-block">
                            Ver Refacciones
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 -->
            <div class="slide h-96 md:h-[500px] bg-gradient-to-r from-purple-900 to-purple-700 flex items-center relative hidden">
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                <div class="container mx-auto px-4 relative z-10 text-white">
                    <div class="max-w-2xl">
                        <h2 class="text-4xl md:text-5xl font-bold mb-6">Baterías de Alta Calidad</h2>
                        <p class="text-xl mb-8">Potencia y durabilidad para todas tus herramientas eléctricas</p>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=baterias" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-4 text-lg font-semibold rounded-lg transition duration-300 inline-block">
                            Ver Baterías
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navegación del slider -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <button onclick="changeSlide(0)" class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition"></button>
            <button onclick="changeSlide(1)" class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition"></button>
            <button onclick="changeSlide(2)" class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition"></button>
        </div>
        
        <!-- Flechas de navegación -->
        <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-40 text-white p-2 rounded-full transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-40 text-white p-2 rounded-full transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </section>

    <!-- Categorías Populares - Diseño Moderno -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Patrón de fondo decorativo -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-blue-900 via-purple-900 to-gray-900"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Nuestras Especialidades
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Descubre nuestra amplia gama de productos especializados para profesionales y técnicos
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                
                <!-- Refacciones -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=refacciones'">
                    <div class="relative bg-black rounded-2xl overflow-hidden h-80 transform group-hover:scale-105 transition-all duration-500 shadow-2xl">
                        <!-- Imagen de fondo con overlay -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-black">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        </div>
                        
                        <!-- Contenido -->
                        <div class="relative z-10 h-full flex flex-col justify-between p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Spare Parts</h3>
                                    <p class="text-gray-300 text-sm">Over 19,000+ SKU</p>
                                </div>
                                <div class="text-red-500 text-3xl">&gt;&gt;&gt;</div>
                            </div>
                            
                            <div class="text-center">
                                <div class="inline-block bg-white/10 backdrop-blur-sm rounded-lg p-4 mb-4">
                                    <svg class="w-12 h-12 text-white mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-white">REFACCIONES</h4>
                                <p class="text-gray-300 text-sm">Partes originales y compatibles</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pantallas -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=pantallas'">
                    <div class="relative bg-black rounded-2xl overflow-hidden h-80 transform group-hover:scale-105 transition-all duration-500 shadow-2xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-black">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-between p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">SCREENS</h3>
                                    <p class="text-gray-300 text-sm">Quality is Our Priority</p>
                                </div>
                                <div class="text-red-500 text-3xl">&gt;&gt;&gt;</div>
                            </div>
                            
                            <div class="text-center">
                                <div class="inline-block bg-white/10 backdrop-blur-sm rounded-lg p-4 mb-4">
                                    <svg class="w-12 h-12 text-white mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M21 3H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h5l-1 1v1h8v-1l-1-1h5c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 12H3V5h18v10z"/>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-white">PANTALLAS</h4>
                                <p class="text-gray-300 text-sm">LCD, OLED y más tecnologías</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Herramientas -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=herramientas'">
                    <div class="relative bg-black rounded-2xl overflow-hidden h-80 transform group-hover:scale-105 transition-all duration-500 shadow-2xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-900 via-red-800 to-black">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-between p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Repair Machines</h3>
                                    <p class="text-gray-300 text-sm">One-stop Service</p>
                                </div>
                                <div class="text-red-500 text-3xl">&gt;&gt;&gt;</div>
                            </div>
                            
                            <div class="text-center">
                                <div class="inline-block bg-white/10 backdrop-blur-sm rounded-lg p-4 mb-4">
                                    <svg class="w-12 h-12 text-white mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-white">HERRAMIENTAS</h4>
                                <p class="text-gray-300 text-sm">Equipos profesionales</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Baterías -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=baterias'">
                    <div class="relative bg-black rounded-2xl overflow-hidden h-80 transform group-hover:scale-105 transition-all duration-500 shadow-2xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-900 via-green-800 to-black">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-between p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Battery</h3>
                                    <p class="text-gray-300 text-sm">Full power, full energy.</p>
                                </div>
                                <div class="text-red-500 text-3xl">&gt;&gt;&gt;</div>
                            </div>
                            
                            <div class="text-center">
                                <div class="inline-block bg-white/10 backdrop-blur-sm rounded-lg p-4 mb-4">
                                    <svg class="w-12 h-12 text-white mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z"/>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-white">BATERÍAS</h4>
                                <p class="text-gray-300 text-sm">Máxima duración y potencia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA con Estadísticas -->
    <section class="py-20 bg-gradient-to-r from-blue-900 via-purple-900 to-blue-900 relative overflow-hidden">
        <!-- Efectos de fondo -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
            <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    ¿Por qué elegirnos?
                </h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-12">
                    Somos líderes en el mercado mexicano con más de 10 años de experiencia
                </p>
                
                <!-- Estadísticas -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-yellow-400 mb-2">19,000+</div>
                        <div class="text-white font-semibold">Productos en Stock</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-green-400 mb-2">50,000+</div>
                        <div class="text-white font-semibold">Clientes Satisfechos</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-blue-400 mb-2">24h</div>
                        <div class="text-white font-semibold">Envío Express</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-purple-400 mb-2">99.8%</div>
                        <div class="text-white font-semibold">Satisfacción</div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                       class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl">
                        🚀 Explorar Catálogo
                    </a>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" 
                       class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-900 px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300">
                        💼 Crear Cuenta
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Marcas Populares -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Marcas de Confianza</h3>
                <p class="text-gray-600">Trabajamos con las mejores marcas del mercado mundial</p>
            </div>
            
            <!-- Carrusel de marcas -->
            <div class="overflow-hidden relative">
                <div class="flex animate-scroll space-x-12 items-center">
                    <!-- Apple -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <svg class="w-16 h-16 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                        </svg>
                    </div>
                    
                    <!-- Samsung -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl font-bold text-blue-600">SAMSUNG</div>
                    </div>
                    
                    <!-- Xiaomi -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl font-bold text-orange-500">Mi</div>
                    </div>
                    
                    <!-- Huawei -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-xl font-bold text-red-600">HUAWEI</div>
                    </div>
                    
                    <!-- OPPO -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl font-bold text-green-600">OPPO</div>
                    </div>
                    
                    <!-- Repetir para efecto infinito -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <svg class="w-16 h-16 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <?php if ( function_exists( 'woocommerce_output_featured_products' ) ) : ?>
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">Productos Destacados</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">
                Descubre nuestros productos más populares y mejor valorados por nuestros clientes
            </p>
            <div class="woocommerce">
                <?php echo do_shortcode( '[featured_products limit="8" columns="4"]' ); ?>
            </div>
            <div class="text-center mt-8">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold transition duration-300 inline-block">
                    Ver Todos los Productos
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Beneficios y Características -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">¿Por qué elegir ITOOLS MX?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Envío Gratis</h3>
                    <p class="text-gray-600">En compras mayores a $1,000 pesos en toda la República Mexicana</p>
                </div>
                
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Garantía Completa</h3>
                    <p class="text-gray-600">Todos nuestros productos cuentan con garantía del fabricante</p>
                </div>
                
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Entrega Rápida</h3>
                    <p class="text-gray-600">Recibe tus herramientas en 2-5 días hábiles</p>
                </div>
                
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Soporte Técnico</h3>
                    <p class="text-gray-600">Asesoría especializada para todos tus proyectos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-blue-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">¡Mantente actualizado!</h2>
            <p class="text-blue-100 mb-8 max-w-2xl mx-auto">
                Suscríbete a nuestro boletín y recibe ofertas exclusivas, nuevos productos y consejos profesionales
            </p>
            <div class="max-w-md mx-auto flex">
                <input type="email" placeholder="Tu correo electrónico" 
                       class="flex-1 px-4 py-3 rounded-l-lg border-0 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-r-lg font-semibold transition duration-300">
                    Suscribirse
                </button>
            </div>
        </div>
    </section>

</main>

<!-- JavaScript del Slider -->
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.slider-dot');

function showSlide(index) {
    slides.forEach(slide => slide.classList.add('hidden'));
    dots.forEach(dot => dot.classList.remove('bg-opacity-100'));
    
    slides[index].classList.remove('hidden');
    dots[index].classList.add('bg-opacity-100');
    currentSlide = index;
}

function nextSlide() {
    const next = (currentSlide + 1) % slides.length;
    showSlide(next);
}

function prevSlide() {
    const prev = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(prev);
}

function changeSlide(index) {
    showSlide(index);
}

// Auto-slide cada 5 segundos
setInterval(nextSlide, 5000);

// Inicializar el primer dot como activo
document.addEventListener('DOMContentLoaded', function() {
    dots[0].classList.add('bg-opacity-100');
});
</script>

<?php get_footer(); ?>
