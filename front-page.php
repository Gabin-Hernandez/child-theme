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

    <!-- Categorías Populares -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">Categorías Populares</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">
                Explora nuestras categorías principales y encuentra exactamente lo que necesitas para tus proyectos
            </p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                
                <!-- Refacciones -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=refacciones'">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform group-hover:scale-105 transition duration-300">
                        <div class="h-40 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                            <div class="text-6xl text-white relative z-10">⚙️</div>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-lg mb-1">Refacciones</h3>
                            <p class="text-gray-600 text-sm">Partes y componentes</p>
                        </div>
                    </div>
                </div>
                
                <!-- Pantallas -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=pantallas'">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform group-hover:scale-105 transition duration-300">
                        <div class="h-40 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                            <div class="text-6xl text-white relative z-10">📱</div>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-lg mb-1">Pantallas</h3>
                            <p class="text-gray-600 text-sm">Displays y monitores</p>
                        </div>
                    </div>
                </div>
                
                <!-- Herramientas -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=herramientas'">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform group-hover:scale-105 transition duration-300">
                        <div class="h-40 bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                            <div class="text-6xl text-white relative z-10">🔧</div>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-lg mb-1">Herramientas</h3>
                            <p class="text-gray-600 text-sm">Manuales y eléctricas</p>
                        </div>
                    </div>
                </div>
                
                <!-- Accesorios -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=accesorios'">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform group-hover:scale-105 transition duration-300">
                        <div class="h-40 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                            <div class="text-6xl text-white relative z-10">🎯</div>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-lg mb-1">Accesorios</h3>
                            <p class="text-gray-600 text-sm">Complementos útiles</p>
                        </div>
                    </div>
                </div>
                
                <!-- Baterías -->
                <div class="group cursor-pointer" onclick="window.location.href='<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=baterias'">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform group-hover:scale-105 transition duration-300">
                        <div class="h-40 bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                            <div class="text-6xl text-white relative z-10">🔋</div>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-lg mb-1">Baterías</h3>
                            <p class="text-gray-600 text-sm">Alta duración</p>
                        </div>
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
