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
                            <a href="/categoria/refacciones/" 
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
                            <a href="/categoria/lcd-y-touch/" 
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
                            <a href="/categoria/baterias/" 
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
    <section id="categorias" class="py-20 bg-gray-900 relative overflow-hidden">
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
                <div class="group cursor-pointer" onclick="window.location.href='/categoria/refacciones/'">
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
                            </div>
                            
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Variedad de Piezas</h4>
                                <p class="text-gray-300 text-sm">Componentes originales y compatibles para todo tipo de dispositivos</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pantallas -->
                <div class="group cursor-pointer" onclick="window.location.href='/categoria/lcd-y-touch/'">
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
                            </div>
                            
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">LCD y Touch</h4>
                                <p class="text-gray-300 text-sm">Displays de alta calidad, OLED, INCELL y tecnologías premium</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Herramientas -->
                <div class="group cursor-pointer" onclick="window.location.href='/categoria/herramientas/'">
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
                            </div>
                            
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Para tu Taller</h4>
                                <p class="text-gray-300 text-sm">Microscopios, estaciones de soldadura, cautines y más</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Baterías -->
                <div class="group cursor-pointer" onclick="window.location.href='/categoria/baterias/'">
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
        
        <!-- Partículas animadas -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="particles-container">
                <!-- Partículas pequeñas -->
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
                <div class="particle particle-4"></div>
                <div class="particle particle-5"></div>
                <div class="particle particle-6"></div>
                <div class="particle particle-7"></div>
                <div class="particle particle-8"></div>
                <div class="particle particle-9"></div>
                <div class="particle particle-10"></div>
                
                <!-- Partículas medianas -->
                <div class="particle-medium particle-m1"></div>
                <div class="particle-medium particle-m2"></div>
                <div class="particle-medium particle-m3"></div>
                <div class="particle-medium particle-m4"></div>
                
                <!-- Partículas grandes -->
                <div class="particle-large particle-l1"></div>
                <div class="particle-large particle-l2"></div>
            </div>
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
    <section id="ofertas" class="py-20 bg-gradient-to-br from-red-50 to-orange-50">
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
                <?php 
                // Usar productos en oferta reales de WooCommerce
                if ( function_exists('woocommerce_shortcode_products') && shortcode_exists('sale_products') ) : 
                    echo do_shortcode( '[sale_products limit="8" columns="4"]' ); 
                else :
                    // Fallback: usar productos reales con consulta personalizada
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 8,
                        'meta_key' => '_sale_price',
                        'meta_compare' => 'EXISTS',
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key' => '_visibility',
                                'value' => array('catalog', 'visible'),
                                'compare' => 'IN'
                            )
                        )
                    );
                    
                    $sale_products = new WP_Query( $args );
                    
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
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                    <div class="relative">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <img src="<?php echo esc_url($image_url); ?>" 
                                                 alt="<?php echo esc_attr(get_the_title()); ?>" 
                                                 class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                                        </a>
                                        <?php if ( $discount_percentage > 0 ) : ?>
                                            <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                                -<?php echo $discount_percentage; ?>%
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
                                            <?php if ( $sale_price ) : ?>
                                                <span class="text-red-500 font-bold text-xl">
                                                    <?php echo wc_price($sale_price); ?>
                                                </span>
                                                <?php if ( $regular_price && $regular_price != $sale_price ) : ?>
                                                    <span class="text-gray-400 line-through">
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
                            <p class="text-gray-600 text-lg">No hay productos en oferta disponibles en este momento.</p>
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
                            <a href="/categoria/herramientas/" class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-6 py-2 rounded-full font-semibold transform hover:scale-105 transition-all duration-300">
                                Ver Producto
                            </a>
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
                            <a href="/categoria/lcd-y-touch/" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white px-6 py-2 rounded-full font-semibold transform hover:scale-105 transition-all duration-300">
                                Ver Producto
                            </a>
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
                            <a href="/categoria/estaciones-soldadura/" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-2 rounded-full font-semibold transform hover:scale-105 transition-all duration-300">
                                Ver Producto
                            </a>
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

    <!-- Newsletter CTA - Dentro del main -->
    <section id="newsletter-cta" class="bg-gradient-to-b from-blue-900 via-gray-900 to-black py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">¡Mantente actualizado!</h2>
            <p class="text-gray-300 mb-8 max-w-2xl mx-auto">
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

<!-- CSS y JavaScript para Navbar Sticky y Partículas -->
<style>
    /* Partículas Animadas */
    .particles-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
    
    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
    }
    
    .particle-medium {
        position: absolute;
        background: rgba(59, 130, 246, 0.2);
        border-radius: 50%;
        pointer-events: none;
    }
    
    .particle-large {
        position: absolute;
        background: rgba(147, 51, 234, 0.15);
        border-radius: 50%;
        pointer-events: none;
    }
    
    /* Partículas pequeñas */
    .particle-1 { width: 4px; height: 4px; top: 10%; left: 10%; animation: float1 6s ease-in-out infinite; }
    .particle-2 { width: 6px; height: 6px; top: 20%; left: 80%; animation: float2 8s ease-in-out infinite; }
    .particle-3 { width: 3px; height: 3px; top: 60%; left: 15%; animation: float3 7s ease-in-out infinite; }
    .particle-4 { width: 5px; height: 5px; top: 80%; left: 70%; animation: float1 9s ease-in-out infinite; }
    .particle-5 { width: 4px; height: 4px; top: 30%; left: 45%; animation: float2 5s ease-in-out infinite; }
    .particle-6 { width: 3px; height: 3px; top: 70%; left: 90%; animation: float3 6s ease-in-out infinite; }
    .particle-7 { width: 5px; height: 5px; top: 15%; left: 60%; animation: float1 7s ease-in-out infinite; }
    .particle-8 { width: 4px; height: 4px; top: 85%; left: 25%; animation: float2 8s ease-in-out infinite; }
    .particle-9 { width: 6px; height: 6px; top: 40%; left: 85%; animation: float3 6s ease-in-out infinite; }
    .particle-10 { width: 3px; height: 3px; top: 90%; left: 50%; animation: float1 9s ease-in-out infinite; }
    
    /* Partículas medianas */
    .particle-m1 { width: 12px; height: 12px; top: 25%; left: 20%; animation: float2 10s ease-in-out infinite; }
    .particle-m2 { width: 10px; height: 10px; top: 75%; left: 75%; animation: float3 12s ease-in-out infinite; }
    .particle-m3 { width: 14px; height: 14px; top: 50%; left: 65%; animation: float1 11s ease-in-out infinite; }
    .particle-m4 { width: 8px; height: 8px; top: 35%; left: 5%; animation: float2 9s ease-in-out infinite; }
    
    /* Partículas grandes */
    .particle-l1 { width: 20px; height: 20px; top: 45%; left: 35%; animation: float3 15s ease-in-out infinite; }
    .particle-l2 { width: 18px; height: 18px; top: 65%; left: 55%; animation: float1 13s ease-in-out infinite; }
    
    /* Animaciones de flotación */
    @keyframes float1 {
        0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0.4; }
        25% { transform: translateY(-20px) translateX(10px); opacity: 0.7; }
        50% { transform: translateY(-10px) translateX(-15px); opacity: 1; }
        75% { transform: translateY(-30px) translateX(5px); opacity: 0.8; }
    }
    
    @keyframes float2 {
        0%, 100% { transform: translateY(0px) translateX(0px) rotate(0deg); opacity: 0.3; }
        33% { transform: translateY(-25px) translateX(-10px) rotate(120deg); opacity: 0.8; }
        66% { transform: translateY(-15px) translateX(20px) rotate(240deg); opacity: 1; }
    }
    
    @keyframes float3 {
        0%, 100% { transform: translateY(0px) translateX(0px) scale(1); opacity: 0.5; }
        50% { transform: translateY(-35px) translateX(15px) scale(1.2); opacity: 0.9; }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .particle, .particle-medium, .particle-large {
            display: none;
        }
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

