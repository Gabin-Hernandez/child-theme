<?php
/**
 * Front Page - ITOOLS MX - Diseño Moderno
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- He                            <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=baterias' : '/categoria/baterias/'; ?>" 
                               class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl inline-block">
                                🔋 Ver Baterías
                            </a>lider Moderno -->
    <section class="relative overflow-hidden">
        <div id="hero-slider" class="relative">
            <!-- Slide 1 - Principal -->
            <div class="slide active h-[600px] md:h-[700px] relative">
                <!-- Imagen de fondo -->
                <div class="absolute inset-0">
                    <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-19.webp" 
                         alt="Herramientas para técnicos" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                </div>
                
                <!-- Contenido -->
                <div class="container mx-auto px-4 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="animate-fade-in-up">
                            <div class="inline-flex items-center bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full font-semibold mb-6">
                                LÍDERES EN TECNOLOGÍA
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
                                <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                                   class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl text-center">
                                    Explorar Catálogo
                                </a>
                                <a href="#categorias" 
                                   class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-900 px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 text-center">
                                    Ver Categorías
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 - Refacciones -->
            <div class="slide h-[600px] md:h-[700px] relative hidden">
                <div class="absolute inset-0">
                    <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-1.webp" 
                         alt="Refacciones de celulares" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                </div>
                
                <div class="container mx-auto px-4 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="animate-fade-in-up">
                            <div class="inline-flex items-center bg-green-500/20 backdrop-blur-sm text-green-200 px-4 py-2 rounded-full font-semibold mb-6">
                                REFACCIONES ORIGINALES
                            </div>
                            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                                Refacciones
                                <span class="block text-2xl md:text-3xl text-gray-300 font-normal mt-2">
                                    Más de 19,000 SKU disponibles
                                </span>
                            </h2>
                            <p class="text-xl text-gray-200 mb-8">
                                Encuentra las refacciones originales y compatibles que necesitas para mantener tus equipos funcionando perfectamente
                            </p>
                            <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=refacciones' : '/categoria/refacciones/'; ?>" 
                               class="bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl inline-block">
                                Ver Refacciones
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 - Pantallas -->
            <div class="slide h-[600px] md:h-[700px] relative hidden">
                <div class="absolute inset-0">
                    <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                         alt="Pantallas y displays" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                </div>
                
                <div class="container mx-auto px-4 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="animate-fade-in-up">
                            <div class="inline-flex items-center bg-purple-500/20 backdrop-blur-sm text-purple-200 px-4 py-2 rounded-full font-semibold mb-6">
                                TECNOLOGÍA AVANZADA
                            </div>
                            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                                Pantallas
                                <span class="block text-2xl md:text-3xl text-purple-200 font-normal mt-2">
                                    LCD, OLED y Touch de última generación
                                </span>
                            </h2>
                            <p class="text-xl text-purple-100 mb-8">
                                Pantallas de alta calidad para iPhone, Samsung, Huawei y más marcas. Garantía y soporte técnico incluido
                            </p>
                            <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=pantallas' : '/categoria/lcd-y-touch/'; ?>" 
                               class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl inline-block">
                                Ver Pantallas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 4 - Baterías -->
            <div class="slide h-[600px] md:h-[700px] relative hidden">
                <div class="absolute inset-0">
                    <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-16.webp" 
                         alt="Baterías y accesorios" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                </div>
                
                <div class="container mx-auto px-4 relative z-10 h-full flex items-center">
                    <div class="max-w-3xl">
                        <div class="animate-fade-in-up">
                            <div class="inline-flex items-center bg-yellow-500/20 backdrop-blur-sm text-yellow-200 px-4 py-2 rounded-full font-semibold mb-6">
                                ENERGÍA CONFIABLE
                            </div>
                            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                                Baterías
                                <span class="block text-2xl md:text-3xl text-yellow-200 font-normal mt-2">
                                    Máxima duración y rendimiento
                                </span>
                            </h2>
                            <p class="text-xl text-yellow-100 mb-8">
                                Baterías originales y compatibles para todos los modelos. Larga duración y garantía extendida
                            </p>
                            <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=baterias' : '/categoria/baterias/'; ?>" 
                               class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl inline-block">
                                Ver Baterías
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
    <section class="py-20 bg-gray-900 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Nuestras Especialidades
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Productos de la más alta calidad para profesionales exigentes
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                
                <!-- Refacciones -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=refacciones' : '/categoria/refacciones/'; ?>'">
                    <div class="relative bg-black rounded-2xl overflow-hidden h-80 transform group-hover:scale-105 transition-all duration-500 shadow-2xl">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-1.webp" 
                             alt="Refacciones de celulares" 
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-between p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">REFACCIONES</h3>
                                    <p class="text-gray-300 text-sm">Más de 19,000 productos</p>
                                </div>
                                <div class="text-orange-500 text-3xl transform group-hover:translate-x-2 transition-transform">&gt;</div>
                            </div>
                            
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Variedad de Piezas</h4>
                                <p class="text-gray-300 text-sm">Componentes originales y compatibles para todo tipo de dispositivos</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pantallas -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=pantallas' : '/categoria/lcd-y-touch/'; ?>'">
                    <div class="relative bg-black rounded-2xl overflow-hidden h-80 transform group-hover:scale-105 transition-all duration-500 shadow-2xl">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                             alt="Pantallas LCD y Touch" 
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-between p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">PANTALLAS</h3>
                                    <p class="text-gray-300 text-sm">Calidad es nuestra prioridad</p>
                                </div>
                                <div class="text-blue-500 text-3xl transform group-hover:translate-x-2 transition-transform">&gt;</div>
                            </div>
                            
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">LCD y Touch</h4>
                                <p class="text-gray-300 text-sm">Displays de alta calidad, OLED, INCELL y tecnologías premium</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Herramientas -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=herramientas' : '/categoria/herramientas/'; ?>'">
                    <div class="relative bg-black rounded-2xl overflow-hidden h-80 transform group-hover:scale-105 transition-all duration-500 shadow-2xl">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-12.webp" 
                             alt="Herramientas profesionales" 
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-between p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">HERRAMIENTAS</h3>
                                    <p class="text-gray-300 text-sm">Servicio integral</p>
                                </div>
                                <div class="text-red-500 text-3xl transform group-hover:translate-x-2 transition-transform">&gt;</div>
                            </div>
                            
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Para tu Taller</h4>
                                <p class="text-gray-300 text-sm">Microscopios, estaciones de soldadura, cautines y más</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Baterías -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=baterias' : '/categoria/baterias/'; ?>'">
                    <div class="relative bg-black rounded-2xl overflow-hidden h-80 transform group-hover:scale-105 transition-all duration-500 shadow-2xl">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-16.webp" 
                             alt="Baterías y accesorios" 
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <div class="relative z-10 h-full flex flex-col justify-between p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">BATERÍAS</h3>
                                    <p class="text-gray-300 text-sm">Energía completa</p>
                                </div>
                                <div class="text-green-500 text-3xl transform group-hover:translate-x-2 transition-transform">&gt;</div>
                            </div>
                            
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Máxima Duración</h4>
                                <p class="text-gray-300 text-sm">Baterías originales y compatibles con garantía extendida</p>
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
                    <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                       class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl">
                        Explorar Catálogo
                    </a>
                    <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'myaccount' ) ) : '/mi-cuenta/'; ?>" 
                       class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-900 px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300">
                        Crear Cuenta
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
            <div class="overflow-hidden relative brands-container" style="height: 100px;">
                <div class="flex brands-carousel space-x-12 items-center" style="animation: scrollBrands 20s linear infinite; width: 200%; will-change: transform;">
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
                    
                    <!-- Realme -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-xl font-bold text-yellow-600">realme</div>
                    </div>
                    
                    <!-- Motorola -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-lg font-bold text-gray-800">MOTOROLA</div>
                    </div>
                    
                    <!-- Duplicados para efecto infinito -->
                    <!-- Apple duplicado -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <svg class="w-16 h-16 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                        </svg>
                    </div>
                    
                    <!-- Samsung duplicado -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl font-bold text-blue-600">SAMSUNG</div>
                    </div>
                    
                    <!-- Xiaomi duplicado -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl font-bold text-orange-500">Mi</div>
                    </div>
                    
                    <!-- Huawei duplicado -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-xl font-bold text-red-600">HUAWEI</div>
                    </div>
                    
                    <!-- OPPO duplicado -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl font-bold text-green-600">OPPO</div>
                    </div>
                    
                    <!-- OnePlus duplicado -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-xl font-bold text-black">OnePlus</div>
                    </div>
                    
                    <!-- Realme duplicado -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-xl font-bold text-yellow-600">realme</div>
                    </div>
                    
                    <!-- Motorola duplicado -->
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-lg font-bold text-gray-800">MOTOROLA</div>
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
    <section class="py-20 bg-gradient-to-br from-red-50 to-orange-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-red-100 text-red-800 px-4 py-2 rounded-full font-semibold mb-4">
                    OFERTAS ESPECIALES
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">
                    Productos en Oferta
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Aprovecha nuestros descuentos exclusivos por tiempo limitado
                </p>
            </div>
            
            <div class="woocommerce">
                <?php if ( function_exists('woocommerce_shortcode_products') && shortcode_exists('sale_products') ) : ?>
                    <?php echo do_shortcode( '[sale_products limit="8" columns="4"]' ); ?>
                <?php else : ?>
                    <!-- Productos en oferta estáticos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Producto 1 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                                     alt="Pantalla iPhone 14" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                    -25%
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">Pantalla iPhone 14</h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-red-500 font-bold text-xl">$750.00</span>
                                    <span class="text-gray-400 line-through">$1,000.00</span>
                                </div>
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition-colors">
                                    Ver Producto
                                </button>
                            </div>
                        </div>
                        
                        <!-- Producto 2 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-16.webp" 
                                     alt="Batería Samsung" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                    -30%
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">Batería Samsung</h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-red-500 font-bold text-xl">$175.00</span>
                                    <span class="text-gray-400 line-through">$250.00</span>
                                </div>
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition-colors">
                                    Ver Producto
                                </button>
                            </div>
                        </div>
                        
                        <!-- Producto 3 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-12.webp" 
                                     alt="Kit Herramientas" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                    -20%
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">Kit Herramientas</h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-red-500 font-bold text-xl">$320.00</span>
                                    <span class="text-gray-400 line-through">$400.00</span>
                                </div>
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition-colors">
                                    Ver Producto
                                </button>
                            </div>
                        </div>
                        
                        <!-- Producto 4 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-1.webp" 
                                     alt="Accesorios Pro" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                    -15%
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">Accesorios Pro</h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-red-500 font-bold text-xl">$85.00</span>
                                    <span class="text-gray-400 line-through">$100.00</span>
                                </div>
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition-colors">
                                    Ver Producto
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-12">
                <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                   class="bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 text-white px-10 py-4 text-xl font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl">
                    Ver Todas las Ofertas
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
                    PRODUCTOS DESTACADOS
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Lo Más Popular
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Los productos más valorados y mejor calificados por nuestros clientes
                </p>
            </div>
            
            <div class="woocommerce">
                <?php if ( function_exists('woocommerce_shortcode_products') && shortcode_exists('featured_products') ) : ?>
                    <?php echo do_shortcode( '[featured_products limit="8" columns="4"]' ); ?>
                <?php else : ?>
                    <!-- Productos destacados estáticos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Producto Destacado 1 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-12.webp" 
                                     alt="Microscopio Pro" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                    TOP
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">Microscopio Pro</h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-blue-600 font-bold text-xl">$6,900.00</span>
                                </div>
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition-colors">
                                    Ver Producto
                                </button>
                            </div>
                        </div>
                        
                        <!-- Producto Destacado 2 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                                     alt="LCD iPhone 15" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                    TOP
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">LCD iPhone 15</h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-blue-600 font-bold text-xl">$700.00</span>
                                </div>
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition-colors">
                                    Ver Producto
                                </button>
                            </div>
                        </div>
                        
                        <!-- Producto Destacado 3 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-19.webp" 
                                     alt="Estación Soldadura" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                    TOP
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">Estación Soldadura</h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-blue-600 font-bold text-xl">$7,450.00</span>
                                </div>
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition-colors">
                                    Ver Producto
                                </button>
                            </div>
                        </div>
                        
                        <!-- Producto Destacado 4 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-1.webp" 
                                     alt="Kit Completo" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                    TOP
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">Kit Completo</h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-blue-600 font-bold text-xl">$1,350.00</span>
                                </div>
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition-colors">
                                    Ver Producto
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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
    <section class="py-20 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 relative overflow-hidden">
        <!-- Efectos de fondo -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse animation-delay-2000"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <!-- Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-gradient-to-r from-orange-500/20 to-red-500/20 backdrop-blur-sm text-orange-200 px-6 py-3 rounded-full font-semibold mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    PRODUCTOS DESTACADOS
                </div>
                <h2 class="text-5xl md:text-6xl font-bold text-white mb-6">
                    Lo Mejor de 
                    <span class="bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent">
                        ITOOLS MX
                    </span>
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Descubre nuestros productos más vendidos y mejor valorados por técnicos profesionales
                </p>
            </div>

            <!-- Grid de productos destacados -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                
                <!-- Producto 1 - Microscopio -->
                <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl overflow-hidden hover:bg-white/10 transition-all duration-500 border border-white/10 hover:border-orange-500/50">
                    <div class="aspect-w-16 aspect-h-12 relative overflow-hidden">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-12.webp" 
                             alt="Microscopio Profesional" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <!-- Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                MÁS VENDIDO
                            </span>
                        </div>
                        
                        <!-- Rating -->
                        <div class="absolute top-4 right-4 flex items-center bg-black/50 backdrop-blur-sm rounded-full px-3 py-1">
                            <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-white text-sm font-medium">4.9</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-orange-400 transition-colors">
                            Microscopio Profesional HD
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">
                            Microscopio de alta definición para reparaciones de precisión
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-orange-400">$6,900</span>
                                <span class="text-gray-500 line-through ml-2">$8,500</span>
                            </div>
                            <button class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-6 py-2 rounded-full font-semibold transform hover:scale-105 transition-all duration-300">
                                Ver Producto
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Producto 2 - Pantalla iPhone -->
                <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl overflow-hidden hover:bg-white/10 transition-all duration-500 border border-white/10 hover:border-blue-500/50">
                    <div class="aspect-w-16 aspect-h-12 relative overflow-hidden">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                             alt="Pantalla iPhone OLED" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <!-- Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                MEJOR CALIDAD
                            </span>
                        </div>
                        
                        <!-- Rating -->
                        <div class="absolute top-4 right-4 flex items-center bg-black/50 backdrop-blur-sm rounded-full px-3 py-1">
                            <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-white text-sm font-medium">4.8</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors">
                            Pantalla iPhone 15 Pro OLED
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">
                            Display OLED original con tecnología ProMotion 120Hz
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-400">$2,850</span>
                                <span class="text-gray-500 line-through ml-2">$3,200</span>
                            </div>
                            <button class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white px-6 py-2 rounded-full font-semibold transform hover:scale-105 transition-all duration-300">
                                Ver Producto
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Producto 3 - Estación de Soldadura -->
                <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl overflow-hidden hover:bg-white/10 transition-all duration-500 border border-white/10 hover:border-green-500/50">
                    <div class="aspect-w-16 aspect-h-12 relative overflow-hidden">
                        <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-19.webp" 
                             alt="Estación de Soldadura Profesional" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <!-- Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                PROFESIONAL
                            </span>
                        </div>
                        
                        <!-- Rating -->
                        <div class="absolute top-4 right-4 flex items-center bg-black/50 backdrop-blur-sm rounded-full px-3 py-1">
                            <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-white text-sm font-medium">5.0</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-green-400 transition-colors">
                            Estación de Soldadura Pro
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">
                            Control digital de temperatura y múltiples funciones avanzadas
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-green-400">$4,750</span>
                                <span class="text-gray-500 line-through ml-2">$5,400</span>
                            </div>
                            <button class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-2 rounded-full font-semibold transform hover:scale-105 transition-all duration-300">
                                Ver Producto
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas y CTA -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Estadísticas -->
                <div class="space-y-8">
                    <h3 class="text-3xl font-bold text-white mb-8">Números que nos respaldan</h3>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                            <div class="text-3xl font-bold text-orange-400 mb-2">19,000+</div>
                            <div class="text-gray-300 text-sm">Productos en Stock</div>
                        </div>
                        <div class="text-center p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                            <div class="text-3xl font-bold text-blue-400 mb-2">50,000+</div>
                            <div class="text-gray-300 text-sm">Clientes Satisfechos</div>
                        </div>
                        <div class="text-center p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                            <div class="text-3xl font-bold text-green-400 mb-2">98.5%</div>
                            <div class="text-gray-300 text-sm">Satisfacción</div>
                        </div>
                        <div class="text-center p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                            <div class="text-3xl font-bold text-purple-400 mb-2">24h</div>
                            <div class="text-gray-300 text-sm">Envío Express</div>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="text-center lg:text-left">
                    <h3 class="text-3xl font-bold text-white mb-6">
                        ¿Listo para llevar tu trabajo al siguiente nivel?
                    </h3>
                    <p class="text-gray-300 mb-8 text-lg">
                        Únete a miles de técnicos que ya confían en ITOOLS MX para sus proyectos más importantes.
                    </p>
                    
                    <div class="space-y-4">
                        <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url( wc_get_page_permalink( 'shop' ) ) : '/tienda/'; ?>" 
                           class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-8 py-4 text-lg font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Explorar Catálogo Completo
                        </a>
                        
                        <div class="flex items-center justify-center lg:justify-start text-gray-400 text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Compra 100% segura con garantía de satisfacción
                        </div>
                    </div>
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
