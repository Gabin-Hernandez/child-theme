<?php
/**
 * Front Page - ITOOLS MX - Rediseño UX Simplificado
 * Enfocado en: búsqueda fácil, navegación por categorías, menos ruido visual
 */

get_header(); ?>

<main id="main" class="site-main">

    <!-- ============================================ -->
    <!-- HERO CAROUSEL + BARRA DE BÚSQUEDA           -->
    <!-- ============================================ -->
    <section class="relative bg-slate-900 w-full">
        <!-- Swiper Hero Carousel -->
        <div class="swiper hero-swiper w-full">
            <div class="swiper-wrapper">
                <!-- Slide 1 - Principal -->
                <div class="swiper-slide">
                    <div class="h-[420px] md:h-[480px] lg:h-[540px] relative w-full">
                        <div class="absolute inset-0 w-full">
                            <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-19.webp" 
                                 alt="Herramientas para técnicos" class="w-full h-full object-cover opacity-60">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/50 to-transparent"></div>
                        </div>
                        <div class="container max-w-7xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                            <div class="max-w-2xl">
                                <span class="inline-flex items-center bg-blue-600/90 text-white text-xs md:text-sm px-4 py-1.5 rounded-full font-medium mb-4">
                                    +19,000 productos disponibles
                                </span>
                                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-3">
                                    ITOOLS MX
                                    <span class="block text-lg md:text-xl text-slate-200 font-normal mt-2">Tu socio tecnológico de confianza</span>
                                </h1>
                                <p class="text-base md:text-lg text-slate-300 mb-6 max-w-lg">
                                    Refacciones, herramientas y equipo especializado para técnicos profesionales
                                </p>
                                <a href="/tienda" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 text-sm md:text-base font-semibold rounded-lg transition-colors shadow-lg">
                                    Explorar Catálogo
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 - Refacciones -->
                <div class="swiper-slide">
                    <div class="h-[420px] md:h-[480px] lg:h-[540px] relative w-full">
                        <div class="absolute inset-0 w-full">
                            <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-1.webp" 
                                 alt="Refacciones de celulares" class="w-full h-full object-cover opacity-60">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/50 to-transparent"></div>
                        </div>
                        <div class="container max-w-7xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                            <div class="max-w-2xl">
                                <span class="inline-flex items-center bg-green-600/90 text-white text-xs md:text-sm px-4 py-1.5 rounded-full font-medium mb-4">
                                    Refacciones Originales
                                </span>
                                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-3">
                                    Refacciones
                                    <span class="block text-lg md:text-xl text-slate-200 font-normal mt-2">+19,000 SKU disponibles</span>
                                </h2>
                                <p class="text-base md:text-lg text-slate-300 mb-6 max-w-lg">
                                    Componentes originales y compatibles para todas las marcas
                                </p>
                                <a href="/?post_type=product&s=&product_cat=refacciones" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 text-sm md:text-base font-semibold rounded-lg transition-colors shadow-lg">
                                    Ver Refacciones
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 - Pantallas -->
                <div class="swiper-slide">
                    <div class="h-[420px] md:h-[480px] lg:h-[540px] relative w-full">
                        <div class="absolute inset-0 w-full">
                            <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/refacciones-de-celulares-en-todo-mexico-2.webp" 
                                 alt="Pantallas y displays" class="w-full h-full object-cover opacity-60">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/50 to-transparent"></div>
                        </div>
                        <div class="container max-w-7xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                            <div class="max-w-2xl">
                                <span class="inline-flex items-center bg-purple-600/90 text-white text-xs md:text-sm px-4 py-1.5 rounded-full font-medium mb-4">
                                    Tecnología Avanzada
                                </span>
                                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-3">
                                    Pantallas
                                    <span class="block text-lg md:text-xl text-slate-200 font-normal mt-2">LCD, OLED y Touch de última generación</span>
                                </h2>
                                <p class="text-base md:text-lg text-slate-300 mb-6 max-w-lg">
                                    Para iPhone, Samsung, Huawei y más marcas con garantía incluida
                                </p>
                                <a href="<?php echo esc_url( home_url( '/pantallas-lcd/' ) ); ?>" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 text-sm md:text-base font-semibold rounded-lg transition-colors shadow-lg">
                                    Ver Pantallas
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 - Baterías -->
                <div class="swiper-slide">
                    <div class="h-[420px] md:h-[480px] lg:h-[540px] relative w-full">
                        <div class="absolute inset-0 w-full">
                            <img src="https://itoolsmx.com/wp-content/themes/storely/assets/img/herramientas-para-tecnicos-en-todo-mexico-16.webp" 
                                 alt="Baterías y accesorios" class="w-full h-full object-cover opacity-60">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/50 to-transparent"></div>
                        </div>
                        <div class="container max-w-7xl mx-auto px-6 lg:px-8 relative z-10 h-full flex items-center">
                            <div class="max-w-2xl">
                                <span class="inline-flex items-center bg-amber-600/90 text-white text-xs md:text-sm px-4 py-1.5 rounded-full font-medium mb-4">
                                    Energía Confiable
                                </span>
                                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-3">
                                    Baterías
                                    <span class="block text-lg md:text-xl text-slate-200 font-normal mt-2">Máxima duración y rendimiento</span>
                                </h2>
                                <p class="text-base md:text-lg text-slate-300 mb-6 max-w-lg">
                                    Baterías originales y compatibles para todos los modelos con garantía extendida
                                </p>
                                <a href="<?php echo esc_url( home_url( '/baterias/' ) ); ?>" class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 text-sm md:text-base font-semibold rounded-lg transition-colors shadow-lg">
                                    Ver Baterías
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
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

    <!-- ============================================ -->
    <!-- BARRA DE CONFIANZA COMPACTA                 -->
    <!-- ============================================ -->
    <div class="bg-white border-b border-slate-200">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-slate-200">
                <div class="flex items-center justify-center gap-3 py-4 md:py-5">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <div>
                        <div class="text-sm font-bold text-slate-900">+19,000</div>
                        <div class="text-xs text-slate-500">Productos</div>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-3 py-4 md:py-5">
                    <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <div>
                        <div class="text-sm font-bold text-slate-900">Garantía</div>
                        <div class="text-xs text-slate-500">En todos los productos</div>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-3 py-4 md:py-5">
                    <svg class="w-6 h-6 text-purple-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <div>
                        <div class="text-sm font-bold text-slate-900">Envío 24h</div>
                        <div class="text-xs text-slate-500">Express disponible</div>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-3 py-4 md:py-5">
                    <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    <div>
                        <div class="text-sm font-bold text-slate-900">99.8%</div>
                        <div class="text-xs text-slate-500">Satisfacción</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- NAVEGACIÓN POR CATEGORÍAS                   -->
    <!-- ============================================ -->
    <section class="py-10 md:py-12 bg-slate-50">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-6 md:mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">Explora por categoría</h2>
                <p class="text-slate-500">Encuentra rápidamente lo que necesitas</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 md:gap-4">
                <!-- Refacciones -->
                <a href="/?post_type=product&s=&product_cat=refacciones" class="group bg-white rounded-xl p-4 text-center border border-slate-200 hover:border-blue-300 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col items-center justify-start min-h-[140px]">
                    <div class="w-14 h-14 mx-auto mb-3 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-800 text-sm group-hover:text-blue-600 transition-colors">Refacciones</h3>
                    <p class="text-xs text-slate-400 mt-1">Componentes celulares</p>
                </a>

                <!-- Pantallas -->
                <a href="<?php echo esc_url(home_url('/pantallas-lcd/')); ?>" class="group bg-white rounded-xl p-4 text-center border border-slate-200 hover:border-purple-300 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col items-center justify-start min-h-[140px]">
                    <div class="w-14 h-14 mx-auto mb-3 bg-purple-50 rounded-xl flex items-center justify-center group-hover:bg-purple-100 transition-colors">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-800 text-sm group-hover:text-purple-600 transition-colors">Pantallas</h3>
                    <p class="text-xs text-slate-400 mt-1">LCD, OLED y Touch</p>
                </a>

                <!-- Herramientas -->
                <a href="/?post_type=product&s=&product_cat=herramientas" class="group bg-white rounded-xl p-4 text-center border border-slate-200 hover:border-amber-300 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col items-center justify-start min-h-[140px]">
                    <div class="w-14 h-14 mx-auto mb-3 bg-amber-50 rounded-xl flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-800 text-sm group-hover:text-amber-600 transition-colors">Herramientas</h3>
                    <p class="text-xs text-slate-400 mt-1">Precisión profesional</p>
                </a>

                <!-- Baterías -->
                <a href="<?php echo esc_url(home_url('/baterias/')); ?>" class="group bg-white rounded-xl p-4 text-center border border-slate-200 hover:border-green-300 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col items-center justify-start min-h-[140px]">
                    <div class="w-14 h-14 mx-auto mb-3 bg-green-50 rounded-xl flex items-center justify-center group-hover:bg-green-100 transition-colors">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-800 text-sm group-hover:text-green-600 transition-colors">Baterías</h3>
                    <p class="text-xs text-slate-400 mt-1">Originales y compat.</p>
                </a>

                <!-- Microscopios -->
                <a href="<?php echo esc_url(home_url('/microscopios/')); ?>" class="group bg-white rounded-xl p-4 text-center border border-slate-200 hover:border-sky-300 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col items-center justify-start min-h-[140px]">
                    <div class="w-14 h-14 mx-auto mb-3 bg-sky-50 rounded-xl flex items-center justify-center group-hover:bg-sky-100 transition-colors">
                        <svg class="w-7 h-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-800 text-sm group-hover:text-sky-600 transition-colors">Microscopios</h3>
                    <p class="text-xs text-slate-400 mt-1">Inspección detallada</p>
                </a>

                <!-- Soldadura -->
                <a href="<?php echo esc_url(home_url('/soldadura/')); ?>" class="group bg-white rounded-xl p-4 text-center border border-slate-200 hover:border-red-300 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col items-center justify-start min-h-[140px]">
                    <div class="w-14 h-14 mx-auto mb-3 bg-red-50 rounded-xl flex items-center justify-center group-hover:bg-red-100 transition-colors">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-800 text-sm group-hover:text-red-600 transition-colors">Soldadura</h3>
                    <p class="text-xs text-slate-400 mt-1">Estaciones y cautines</p>
                </a>
            </div>

            <!-- Link a tienda completa -->
            <div class="text-center mt-6">
                <a href="/tienda" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm gap-1 transition-colors">
                    Ver todas las categorías
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- BÚSQUEDA POR MARCA (nuevo)                  -->
    <!-- ============================================ -->
    <section class="py-10 md:py-12 bg-white border-b border-slate-100">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">Busca por marca</h2>
                <p class="text-slate-500">Selecciona la marca de tu dispositivo</p>
            </div>

            <div class="flex flex-wrap justify-center gap-3 md:gap-4">
                <a href="<?php echo esc_url(home_url('/apple/')); ?>" class="flex items-center gap-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 hover:border-slate-300 rounded-lg px-5 py-3 transition-all group">
                    <svg class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 24 24"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                    <span class="font-semibold text-slate-700 text-sm group-hover:text-slate-900">Apple</span>
                </a>
                <a href="<?php echo esc_url(home_url('/samsung/')); ?>" class="flex items-center gap-2 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-300 rounded-lg px-5 py-3 transition-all group">
                    <span class="font-bold text-blue-600 text-sm">SAMSUNG</span>
                </a>
                <a href="<?php echo esc_url(home_url('/xiaomi/')); ?>" class="flex items-center gap-2 bg-slate-50 hover:bg-orange-50 border border-slate-200 hover:border-orange-300 rounded-lg px-5 py-3 transition-all group">
                    <span class="font-bold text-orange-500 text-sm">Xiaomi</span>
                </a>
                <a href="<?php echo esc_url(home_url('/huawei/')); ?>" class="flex items-center gap-2 bg-slate-50 hover:bg-red-50 border border-slate-200 hover:border-red-300 rounded-lg px-5 py-3 transition-all group">
                    <span class="font-bold text-red-600 text-sm">HUAWEI</span>
                </a>
                <a href="<?php echo esc_url(home_url('/motorola/')); ?>" class="flex items-center gap-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 hover:border-slate-400 rounded-lg px-5 py-3 transition-all group">
                    <span class="font-bold text-slate-700 text-sm">MOTOROLA</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- HERRAMIENTAS - 1 SOLO CARRUSEL              -->
    <!-- ============================================ -->
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <section class="py-10 md:py-12 bg-white">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6">
            <!-- Header de sección -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Herramientas</h2>
                    <p class="text-slate-500 mt-1 text-sm md:text-base">Equipamiento profesional para técnicos</p>
                </div>
                <a href="/?post_type=product&s=&product_cat=herramientas" class="hidden sm:inline-flex items-center gap-1 text-amber-600 hover:text-amber-700 font-semibold text-sm transition-colors">
                    Ver todo
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <?php
            $herramientas_term = get_term_by('slug', 'herramientas', 'product_cat');
            if (!$herramientas_term) {
                $herramientas_term = get_term_by('name', 'Herramientas', 'product_cat');
            }

            $herramientas_args = array(
                'post_type'      => 'product',
                'posts_per_page' => 12,
                'post_status'    => 'publish',
                'meta_query'     => array(
                    array('key' => '_stock_status', 'value' => 'instock', 'compare' => '='),
                    array('key' => '_thumbnail_id', 'compare' => 'EXISTS')
                )
            );

            if ($herramientas_term) {
                $herramientas_args['tax_query'] = array(
                    array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $herramientas_term->term_id)
                );
            }

            $herramientas_query = new WP_Query($herramientas_args);

            if ($herramientas_query->have_posts()) :
                $herr_products = array();
                while ($herramientas_query->have_posts()) {
                    $herramientas_query->the_post();
                    global $product;
                    if ($product && $product->is_visible() && has_post_thumbnail()) {
                        $herr_products[] = get_post();
                    }
                }
                wp_reset_postdata();
            ?>
            <!-- Un solo carrusel -->
            <div class="fp-carousel-container relative">
                <div class="fp-swiper fp-swiper-herramientas overflow-hidden">
                    <div class="swiper-wrapper">
                        <?php foreach ($herr_products as $hp) :
                            global $post;
                            $post = $hp;
                            setup_postdata($post);
                            $product = wc_get_product($post->ID);
                            if (!$product) continue;
                        ?>
                        <div class="swiper-slide" style="width: 220px;">
                            <?php get_template_part_product_card($product); ?>
                        </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </div>

                <!-- Nav buttons -->
                <button class="fp-nav-prev fp-nav-prev-herr absolute left-0 top-1/2 -translate-y-1/2 -translate-x-3 z-20 w-10 h-10 bg-white rounded-full shadow-lg border border-slate-200 flex items-center justify-center hover:bg-amber-50 hover:border-amber-300 transition-all">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="fp-nav-next fp-nav-next-herr absolute right-0 top-1/2 -translate-y-1/2 translate-x-3 z-20 w-10 h-10 bg-white rounded-full shadow-lg border border-slate-200 flex items-center justify-center hover:bg-amber-50 hover:border-amber-300 transition-all">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            <!-- Mobile link -->
            <div class="text-center mt-6 sm:hidden">
                <a href="/?post_type=product&s=&product_cat=herramientas" class="inline-flex items-center gap-1 text-amber-600 font-semibold text-sm">
                    Ver todas las herramientas
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <?php else : ?>
            <div class="text-center py-8 text-slate-500">
                <p>Pronto agregaremos herramientas a esta sección.</p>
            </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ============================================ -->
    <!-- REFACCIONES - 1 SOLO CARRUSEL               -->
    <!-- ============================================ -->
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <section class="py-10 md:py-12 bg-slate-50">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Refacciones</h2>
                    <p class="text-slate-500 mt-1 text-sm md:text-base">Componentes originales y compatibles</p>
                </div>
                <a href="/?post_type=product&s=&product_cat=refacciones" class="hidden sm:inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors">
                    Ver todo
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <?php
            $refacciones_term = get_term_by('slug', 'refacciones', 'product_cat');
            if (!$refacciones_term) {
                $refacciones_term = get_term_by('name', 'Refacciones', 'product_cat');
            }

            $refacciones_args = array(
                'post_type'      => 'product',
                'posts_per_page' => 12,
                'post_status'    => 'publish',
                'meta_query'     => array(
                    array('key' => '_stock_status', 'value' => 'instock', 'compare' => '='),
                    array('key' => '_thumbnail_id', 'compare' => 'EXISTS')
                )
            );

            if ($refacciones_term) {
                $refacciones_args['tax_query'] = array(
                    array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $refacciones_term->term_id)
                );
            }

            $refacciones_query = new WP_Query($refacciones_args);

            if ($refacciones_query->have_posts()) :
                $ref_products = array();
                while ($refacciones_query->have_posts()) {
                    $refacciones_query->the_post();
                    global $product;
                    if ($product && $product->is_visible() && has_post_thumbnail()) {
                        $ref_products[] = get_post();
                    }
                }
                wp_reset_postdata();
            ?>
            <div class="fp-carousel-container relative">
                <div class="fp-swiper fp-swiper-refacciones overflow-hidden">
                    <div class="swiper-wrapper">
                        <?php foreach ($ref_products as $rp) :
                            global $post;
                            $post = $rp;
                            setup_postdata($post);
                            $product = wc_get_product($post->ID);
                            if (!$product) continue;
                        ?>
                        <div class="swiper-slide" style="width: 220px;">
                            <?php get_template_part_product_card($product); ?>
                        </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </div>

                <button class="fp-nav-prev fp-nav-prev-ref absolute left-0 top-1/2 -translate-y-1/2 -translate-x-3 z-20 w-10 h-10 bg-white rounded-full shadow-lg border border-slate-200 flex items-center justify-center hover:bg-blue-50 hover:border-blue-300 transition-all">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="fp-nav-next fp-nav-next-ref absolute right-0 top-1/2 -translate-y-1/2 translate-x-3 z-20 w-10 h-10 bg-white rounded-full shadow-lg border border-slate-200 flex items-center justify-center hover:bg-blue-50 hover:border-blue-300 transition-all">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            <div class="text-center mt-6 sm:hidden">
                <a href="/?post_type=product&s=&product_cat=refacciones" class="inline-flex items-center gap-1 text-blue-600 font-semibold text-sm">
                    Ver todas las refacciones
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <?php else : ?>
            <div class="text-center py-8 text-slate-500">
                <p>Pronto agregaremos refacciones a esta sección.</p>
            </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ============================================ -->
    <!-- MICROSCOPIOS - 1 SOLO CARRUSEL              -->
    <!-- ============================================ -->
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <section class="py-10 md:py-12 bg-white">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Microscopios</h2>
                    <p class="text-slate-500 mt-1 text-sm md:text-base">Instrumentos de precisión para inspección</p>
                </div>
                <a href="<?php echo esc_url(home_url('/microscopios/')); ?>" class="hidden sm:inline-flex items-center gap-1 text-sky-600 hover:text-sky-700 font-semibold text-sm transition-colors">
                    Ver todo
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <?php
            $original_get = $_GET;
            $_GET['post_type'] = 'product';
            $_GET['s'] = 'microscopio';

            $microscopios_args = array(
                'post_type'      => 'product',
                'posts_per_page' => 12,
                'post_status'    => 'publish',
                's'              => 'microscopio',
            );

            $microscopios_query = new WP_Query($microscopios_args);
            $_GET = $original_get;

            if ($microscopios_query->have_posts()) :
                $micro_products = array();
                while ($microscopios_query->have_posts()) {
                    $microscopios_query->the_post();
                    global $product;
                    if ($product && $product->is_visible()) {
                        $micro_products[] = get_post();
                    }
                }
                wp_reset_postdata();
            ?>
            <div class="fp-carousel-container relative">
                <div class="fp-swiper fp-swiper-microscopios overflow-hidden">
                    <div class="swiper-wrapper">
                        <?php foreach ($micro_products as $mp) :
                            global $post;
                            $post = $mp;
                            setup_postdata($post);
                            $product = wc_get_product($post->ID);
                            if (!$product) continue;
                        ?>
                        <div class="swiper-slide" style="width: 220px;">
                            <?php get_template_part_product_card($product); ?>
                        </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </div>

                <button class="fp-nav-prev fp-nav-prev-micro absolute left-0 top-1/2 -translate-y-1/2 -translate-x-3 z-20 w-10 h-10 bg-white rounded-full shadow-lg border border-slate-200 flex items-center justify-center hover:bg-sky-50 hover:border-sky-300 transition-all">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="fp-nav-next fp-nav-next-micro absolute right-0 top-1/2 -translate-y-1/2 translate-x-3 z-20 w-10 h-10 bg-white rounded-full shadow-lg border border-slate-200 flex items-center justify-center hover:bg-sky-50 hover:border-sky-300 transition-all">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            <div class="text-center mt-6 sm:hidden">
                <a href="<?php echo esc_url(home_url('/microscopios/')); ?>" class="inline-flex items-center gap-1 text-sky-600 font-semibold text-sm">
                    Ver todos los microscopios
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <?php else : ?>
            <div class="text-center py-8 text-slate-500">
                <p>Pronto agregaremos microscopios a esta sección.</p>
            </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ============================================ -->
    <!-- CTA FINAL                                   -->
    <!-- ============================================ -->
    <section class="py-12 md:py-16 bg-gradient-to-br from-slate-900 to-blue-900">
        <div class="container max-w-4xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-4">
                ¿No encuentras lo que buscas?
            </h2>
            <p class="text-slate-300 mb-8 text-lg max-w-xl mx-auto">
                Tenemos más de 19,000 productos. Explora nuestro catálogo completo o contáctanos directamente.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="/tienda" class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 font-semibold rounded-lg transition-colors shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Explorar Catálogo Completo
                </a>
                <a href="https://wa.me/5215512345678" target="_blank" class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-8 py-4 font-semibold rounded-lg transition-colors shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Contáctanos por WhatsApp
                </a>
            </div>

            <p class="text-slate-400 text-sm mt-6">
                Compra 100% segura · Garantía de satisfacción · Envíos a todo México
            </p>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<?php
/**
 * Helper: Render product card reutilizable.
 * Se define aquí como función interna del template.
 */
function get_template_part_product_card($product) {
    global $post;
    ?>
    <div class="group bg-white rounded-xl overflow-hidden border border-slate-200 hover:border-blue-300 hover:shadow-lg transition-all duration-300 flex flex-col h-full">
        <!-- Imagen -->
        <div class="relative overflow-hidden bg-slate-50 aspect-square">
            <a href="<?php the_permalink(); ?>" class="block h-full">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('woocommerce_thumbnail', array(
                        'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                    ));
                } else {
                    $logo_url = get_stylesheet_directory_uri() . '/images/logo-itoolsmx.jpg';
                    echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_the_title()) . '" class="w-full h-full object-contain p-4">';
                }
                ?>
            </a>

            <?php if ($product->is_on_sale()) : ?>
            <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                <?php
                $regular = $product->get_regular_price();
                $sale = $product->get_sale_price();
                if ($regular && $sale) {
                    echo '-' . round((($regular - $sale) / $regular) * 100) . '%';
                } else {
                    echo 'OFERTA';
                }
                ?>
            </span>
            <?php endif; ?>
        </div>

        <!-- Info -->
        <div class="p-3 flex flex-col flex-1">
            <h3 class="font-medium text-slate-800 text-sm leading-snug mb-2 line-clamp-2 group-hover:text-blue-700 transition-colors" style="min-height: 2.5rem;">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <div class="text-base font-bold text-slate-900 mb-3">
                <?php echo $product->get_price_html(); ?>
            </div>

            <div class="fp-add-to-cart mt-auto">
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
        </div>
    </div>
    <?php
}
?>

<!-- ============================================ -->
<!-- ESTILOS UNIFICADOS                          -->
<!-- ============================================ -->
<style>
/* ---- Product Cards ---- */
.fp-add-to-cart {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.fp-add-to-cart .button,
.fp-add-to-cart .added_to_cart {
    width: 100% !important;
    background: #2563eb !important;
    color: white !important;
    font-weight: 600 !important;
    padding: 10px 12px !important;
    border-radius: 8px !important;
    border: none !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
    text-decoration: none !important;
    margin: 0 !important;
    font-size: 13px !important;
    line-height: 1.3 !important;
    cursor: pointer;
}

.fp-add-to-cart .button:hover,
.fp-add-to-cart .added_to_cart:hover {
    background: #1d4ed8 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
}

.fp-add-to-cart .added_to_cart::before {
    content: "✓ ";
}

/* ---- Carousel Containers ---- */
.fp-carousel-container {
    padding: 0 16px;
}

.fp-swiper .swiper-slide {
    height: auto;
    display: flex;
}

.fp-swiper .swiper-slide > div {
    width: 100%;
}

/* ---- Line Clamp ---- */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* ---- Nav Buttons ---- */
.fp-nav-prev,
.fp-nav-next {
    opacity: 0;
    transition: all 0.3s ease;
}

.fp-carousel-container:hover .fp-nav-prev,
.fp-carousel-container:hover .fp-nav-next {
    opacity: 1;
}

/* ---- Responsive ---- */
@media (max-width: 640px) {
    .fp-carousel-container {
        padding: 0;
    }
    .fp-nav-prev,
    .fp-nav-next {
        display: none !important;
    }
}

/* ---- Search highlight ---- */
input[type="search"]:focus {
    outline: none;
    box-shadow: none;
}

/* ---- Fix: Sobrescribir padding-0 del tema ---- */
body.home main#main.site-main > section {
    padding-top: 2.5rem !important;  /* py-10 */
    padding-bottom: 2.5rem !important;
}

@media (min-width: 768px) {
    body.home main#main.site-main > section {
        padding-top: 3rem !important;  /* md:py-12 */
        padding-bottom: 3rem !important;
    }
}

/* Hero no necesita padding extra */
body.home main#main.site-main > section:first-child {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}
</style>

<!-- ============================================ -->
<!-- JAVASCRIPT UNIFICADO                        -->
<!-- ============================================ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper no disponible');
        return;
    }

    // Configuración compartida
    const sharedConfig = {
        slidesPerView: 'auto',
        spaceBetween: 16,
        loop: true,
        grabCursor: true,
        breakpoints: {
            320:  { slidesPerView: 1.5, spaceBetween: 12 },
            480:  { slidesPerView: 2,   spaceBetween: 14 },
            640:  { slidesPerView: 2.5, spaceBetween: 16 },
            768:  { slidesPerView: 3,   spaceBetween: 16 },
            1024: { slidesPerView: 4,   spaceBetween: 16 },
            1280: { slidesPerView: 5,   spaceBetween: 16 },
            1536: { slidesPerView: 6,   spaceBetween: 18 }
        }
    };

    // Herramientas
    if (document.querySelector('.fp-swiper-herramientas')) {
        new Swiper('.fp-swiper-herramientas', {
            ...sharedConfig,
            autoplay: { delay: 4000, disableOnInteraction: false },
            navigation: { nextEl: '.fp-nav-next-herr', prevEl: '.fp-nav-prev-herr' }
        });
    }

    // Refacciones
    if (document.querySelector('.fp-swiper-refacciones')) {
        new Swiper('.fp-swiper-refacciones', {
            ...sharedConfig,
            autoplay: { delay: 4500, disableOnInteraction: false },
            navigation: { nextEl: '.fp-nav-next-ref', prevEl: '.fp-nav-prev-ref' }
        });
    }

    // Microscopios
    if (document.querySelector('.fp-swiper-microscopios')) {
        new Swiper('.fp-swiper-microscopios', {
            ...sharedConfig,
            autoplay: { delay: 5000, disableOnInteraction: false },
            navigation: { nextEl: '.fp-nav-next-micro', prevEl: '.fp-nav-prev-micro' }
        });
    }

    // Abrir sidepanel del carrito al agregar producto
    document.addEventListener('click', function(e) {
        if (e.target.closest('.fp-add-to-cart .button') || 
            e.target.closest('.fp-add-to-cart .ajax_add_to_cart')) {
            setTimeout(function() {
                if (window.cartSidepanel) {
                    window.cartSidepanel.open();
                }
            }, 800);
        }
    });

    document.body.addEventListener('added_to_cart', function() {
        setTimeout(function() {
            if (window.cartSidepanel) {
                window.cartSidepanel.open();
            }
        }, 500);
    });

    // Pausar autoplay en hover
    document.querySelectorAll('.fp-swiper').forEach(function(el) {
        const sw = el.swiper;
        if (sw) {
            el.addEventListener('mouseenter', function() { sw.autoplay.stop(); });
            el.addEventListener('mouseleave', function() { sw.autoplay.start(); });
        }
    });
});
</script>
