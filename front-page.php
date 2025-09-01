<?php
/**
 * Front Page - ITOOLS MX - Diseño Moderno
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- Hero Slider Moderno -->
    <section class="relative overflow-hidden">
        <div id="hero-slider" class="relative">
            <!-- Slide 1 - Principal -->
            <div class="slide active h-[600px] md:h-[700px] relative">
                <!-- Imagen de fondo con gradiente -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1000 1000\"><defs><radialGradient id=\"a\" cx=\"50%\" cy=\"50%\" r=\"50%\"><stop offset=\"0%\" stop-color=\"%23ffffff\" stop-opacity=\"0.1\"/><stop offset=\"100%\" stop-color=\"%23ffffff\" stop-opacity=\"0\"/></radialGradient></defs><circle cx=\"500\" cy=\"500\" r=\"500\" fill=\"url(%23a)\"/></svg>'); background-size: cover; background-position: center;"></div>
                    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                </div>
                
                <!-- Contenido -->
                <div class="container mx-auto px-4 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="animate-fade-in-up">
                            <div class="inline-flex items-center bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full font-semibold mb-6">
                                🚀 LÍDERES EN TECNOLOGÍA
                            </div>
                            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                                ITOOLS MX
                                <span class="block text-3xl md:text-4xl text-blue-200 font-normal mt-2">
                                    Tu socio tecnológico de confianza
                                </span>
                            </h1>
                            <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
                                Más de 19,000 productos especializados para profesionales y técnicos en electrónica
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                                   class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl text-center">
                                    🛒 Explorar Catálogo
                                </a>
                                <a href="#categorias" 
                                   class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-900 px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 text-center">
                                    📱 Ver Categorías
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Decoraciones flotantes -->
                <div class="absolute top-20 right-20 w-20 h-20 bg-white/10 rounded-full animate-pulse hidden md:block"></div>
                <div class="absolute bottom-32 right-32 w-16 h-16 bg-blue-400/20 rounded-full animate-bounce hidden md:block"></div>
                <div class="absolute top-1/2 left-10 w-12 h-12 bg-orange-400/20 rounded-full animate-ping hidden md:block"></div>
            </div>
            
            <!-- Slide 2 - Refacciones -->
            <div class="slide h-[600px] md:h-[700px] relative hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-800 to-blue-900">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grid\" width=\"10\" height=\"10\" patternUnits=\"userSpaceOnUse\"><path d=\"M 10 0 L 0 0 0 10\" fill=\"none\" stroke=\"%23ffffff\" stroke-width=\"0.5\" opacity=\"0.1\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grid)\"/></svg>'); background-size: 50px 50px;"></div>
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                </div>
                
                <div class="container mx-auto px-4 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="animate-fade-in-up">
                            <div class="inline-flex items-center bg-green-500/20 backdrop-blur-sm text-green-200 px-4 py-2 rounded-full font-semibold mb-6">
                                ⚙️ REFACCIONES ORIGINALES
                            </div>
                            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                                Spare Parts
                                <span class="block text-2xl md:text-3xl text-gray-300 font-normal mt-2">
                                    Over 19,000+ SKU disponibles
                                </span>
                            </h2>
                            <p class="text-xl text-gray-200 mb-8">
                                Encuentra las refacciones originales y compatibles que necesitas para mantener tus equipos funcionando perfectamente
                            </p>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=refacciones" 
                               class="bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl inline-block">
                                🔧 Ver Refacciones
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 - Pantallas -->
            <div class="slide h-[600px] md:h-[700px] relative hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-900 via-blue-900 to-indigo-900">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 200 200\"><defs><linearGradient id=\"circuit\" x1=\"0%\" y1=\"0%\" x2=\"100%\" y2=\"100%\"><stop offset=\"0%\" stop-color=\"%23ffffff\" stop-opacity=\"0.1\"/><stop offset=\"100%\" stop-color=\"%23ffffff\" stop-opacity=\"0\"/></linearGradient></defs><rect width=\"200\" height=\"200\" fill=\"url(%23circuit)\"/></svg>'); background-size: 100px 100px;"></div>
                    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                </div>
                
                <div class="container mx-auto px-4 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="animate-fade-in-up">
                            <div class="inline-flex items-center bg-purple-500/20 backdrop-blur-sm text-purple-200 px-4 py-2 rounded-full font-semibold mb-6">
                                📱 TECNOLOGÍA AVANZADA
                            </div>
                            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                                SCREENS
                                <span class="block text-2xl md:text-3xl text-purple-200 font-normal mt-2">
                                    Quality is Our Priority
                                </span>
                            </h2>
                            <p class="text-xl text-purple-100 mb-8">
                                Pantallas LCD, OLED y más tecnologías de última generación para todos los dispositivos móviles
                            </p>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=pantallas" 
                               class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl inline-block">
                                📱 Ver Pantallas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 4 - Baterías -->
            <div class="slide h-[600px] md:h-[700px] relative hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-800 via-green-800 to-emerald-900">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 60 60\"><defs><radialGradient id=\"energy\" cx=\"50%\" cy=\"50%\" r=\"50%\"><stop offset=\"0%\" stop-color=\"%23ffff00\" stop-opacity=\"0.1\"/><stop offset=\"100%\" stop-color=\"%23ffff00\" stop-opacity=\"0\"/></radialGradient></defs><circle cx=\"30\" cy=\"30\" r=\"30\" fill=\"url(%23energy)\"/></svg>'); background-size: 120px 120px;"></div>
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                </div>
                
                <div class="container mx-auto px-4 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="animate-fade-in-up">
                            <div class="inline-flex items-center bg-yellow-500/20 backdrop-blur-sm text-yellow-200 px-4 py-2 rounded-full font-semibold mb-6">
                                🔋 ENERGÍA CONFIABLE
                            </div>
                            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                                Battery
                                <span class="block text-2xl md:text-3xl text-yellow-200 font-normal mt-2">
                                    Full power, full energy
                                </span>
                            </h2>
                            <p class="text-xl text-yellow-100 mb-8">
                                Baterías de alta calidad y máxima duración para todos tus dispositivos electrónicos
                            </p>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=baterias" 
                               class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl inline-block">
                                ⚡ Ver Baterías
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navegación del slider mejorada -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3">
            <button onclick="changeSlide(0)" class="slider-dot w-4 h-4 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300 transform hover:scale-125"></button>
            <button onclick="changeSlide(1)" class="slider-dot w-4 h-4 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300 transform hover:scale-125"></button>
            <button onclick="changeSlide(2)" class="slider-dot w-4 h-4 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300 transform hover:scale-125"></button>
            <button onclick="changeSlide(3)" class="slider-dot w-4 h-4 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300 transform hover:scale-125"></button>
        </div>
        
        <!-- Flechas de navegación mejoradas -->
        <button onclick="prevSlide()" class="absolute left-6 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white p-4 rounded-full transition-all duration-300 hover:scale-110">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button onclick="nextSlide()" class="absolute right-6 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white p-4 rounded-full transition-all duration-300 hover:scale-110">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        
        <!-- Indicador de progreso -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-white bg-opacity-20">
            <div id="progress-bar" class="h-full bg-gradient-to-r from-blue-500 to-purple-500 transition-all duration-300"></div>
        </div>
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
            
            <!-- Carrusel de marcas mejorado -->
            <div class="overflow-hidden relative">
                <div class="flex animate-scroll-seamless space-x-12 items-center">
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
                    
                    <!-- OnePlus -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-xl font-bold text-black">OnePlus</div>
                    </div>
                    
                    <!-- Duplicados para efecto infinito sin espacio -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <svg class="w-16 h-16 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                        </svg>
                    </div>
                    
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl font-bold text-blue-600">SAMSUNG</div>
                    </div>
                    
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl font-bold text-orange-500">Mi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos en Oferta -->
    <section class="py-20 bg-gradient-to-br from-red-50 to-orange-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-red-100 text-red-800 px-4 py-2 rounded-full font-semibold mb-4">
                    🔥 OFERTAS ESPECIALES
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">
                    Productos en Oferta
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Aprovecha nuestros descuentos exclusivos por tiempo limitado
                </p>
            </div>
            
            <div class="woocommerce">
                <?php echo do_shortcode( '[sale_products limit="8" columns="4"]' ); ?>
            </div>
            
            <div class="text-center mt-12">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?on_sale=1" 
                   class="bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl">
                    🏷️ Ver Todas las Ofertas
                </a>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <?php if ( function_exists( 'woocommerce_output_featured_products' ) ) : ?>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold mb-4">
                    ⭐ PRODUCTOS DESTACADOS
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Lo Más Popular
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Los productos más valorados y mejor calificados por nuestros clientes
                </p>
            </div>
            
            <div class="woocommerce">
                <?php echo do_shortcode( '[featured_products limit="8" columns="4"]' ); ?>
            </div>
            
            <div class="text-center mt-12">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                   class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl">
                    🚀 Explorar Catálogo Completo
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

<!-- JavaScript del Slider Mejorado -->
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.slider-dot');
const progressBar = document.getElementById('progress-bar');
const totalSlides = slides.length;
let slideInterval;
let progressInterval;

// Configurar slider automático con barra de progreso
function startAutoSlider() {
    slideInterval = setInterval(() => {
        nextSlide();
    }, 6000); // Cambio cada 6 segundos
    
    updateProgressBar();
}

function updateProgressBar() {
    let progress = 0;
    progressBar.style.width = '0%';
    
    progressInterval = setInterval(() => {
        progress += 100 / 600; // 6000ms / 10ms = 600 iteraciones
        progressBar.style.width = progress + '%';
        
        if (progress >= 100) {
            clearInterval(progressInterval);
        }
    }, 10);
}

function resetProgress() {
    clearInterval(progressInterval);
    progressBar.style.width = '0%';
    setTimeout(updateProgressBar, 100);
}

function showSlide(index) {
    // Animación de salida
    slides[currentSlide].style.opacity = '0';
    slides[currentSlide].style.transform = 'translateX(-50px)';
    dots[currentSlide].classList.remove('bg-opacity-100');
    dots[currentSlide].classList.add('bg-opacity-50');
    
    setTimeout(() => {
        slides.forEach(slide => {
            slide.classList.add('hidden');
            slide.style.opacity = '1';
            slide.style.transform = 'translateX(0)';
        });
        
        // Mostrar nuevo slide
        slides[index].classList.remove('hidden');
        slides[index].style.opacity = '0';
        slides[index].style.transform = 'translateX(50px)';
        
        // Animación de entrada
        setTimeout(() => {
            slides[index].style.opacity = '1';
            slides[index].style.transform = 'translateX(0)';
        }, 50);
        
        dots[index].classList.remove('bg-opacity-50');
        dots[index].classList.add('bg-opacity-100');
        currentSlide = index;
    }, 300);
}

function changeSlide(index) {
    showSlide(index);
    
    // Reiniciar auto slider y barra de progreso
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
    // Configurar transiciones CSS
    slides.forEach(slide => {
        slide.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    });
    
    // Marcar el primer dot como activo
    if (dots[0]) {
        dots[0].classList.add('bg-opacity-100');
    }
    
    // Iniciar slider automático
    setTimeout(startAutoSlider, 1000);
    
    // Pausar en hover
    const sliderContainer = document.getElementById('hero-slider');
    sliderContainer.addEventListener('mouseenter', () => {
        clearInterval(slideInterval);
        clearInterval(progressInterval);
    });
    
    sliderContainer.addEventListener('mouseleave', () => {
        startAutoSlider();
    });
    
    // Soporte para navegación con teclado
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
            changeSlide(currentSlide);
        } else if (e.key === 'ArrowRight') {
            nextSlide();
            changeSlide(currentSlide);
        }
    });
});

// Animaciones de contadores
function animateCounters() {
    const counters = document.querySelectorAll('.count-up');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 100;
        let current = 0;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.floor(current).toLocaleString();
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target.toLocaleString();
            }
        };
        
        updateCounter();
    });
}

// Intersection Observer para animaciones
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px 50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            if (entry.target.classList.contains('stats-section')) {
                animateCounters();
            }
            entry.target.classList.add('animate-fade-in-up');
        }
    });
}, observerOptions);

// Observar elementos cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        observer.observe(statsSection);
    }
    
    // Smooth scroll para enlaces internos
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
</script>

<?php get_footer(); ?>
