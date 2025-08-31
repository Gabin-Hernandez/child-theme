<?php
/**
 * Front Page - ITOOLS Child Theme
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">ITOOLS MX</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Las mejores herramientas y equipos profesionales para todos tus proyectos
            </p>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
               class="bg-white text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                Ver Catálogo
            </a>
        </div>
    </section>

    <!-- Categorías Destacadas -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Categorías Populares</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-4xl">🔧</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Herramientas Manuales</h3>
                        <p class="text-gray-600 mb-4">Martillos, destornilladores, llaves y más</p>
                        <a href="#" class="text-blue-600 font-medium hover:text-blue-800">Ver más →</a>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-4xl">⚡</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Herramientas Eléctricas</h3>
                        <p class="text-gray-600 mb-4">Taladros, sierras, lijadoras profesionales</p>
                        <a href="#" class="text-blue-600 font-medium hover:text-blue-800">Ver más →</a>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-4xl">🔩</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Ferretería</h3>
                        <p class="text-gray-600 mb-4">Tornillos, clavos, adhesivos y materiales</p>
                        <a href="#" class="text-blue-600 font-medium hover:text-blue-800">Ver más →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <?php if ( function_exists( 'woocommerce_output_featured_products' ) ) : ?>
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Productos Destacados</h2>
            <div class="woocommerce">
                <?php echo do_shortcode( '[featured_products limit="4" columns="4"]' ); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Características -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl text-blue-600">📦</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Envío Gratis</h3>
                    <p class="text-gray-600">En compras mayores a $1,000 pesos</p>
                </div>
                
                <div>
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl text-blue-600">🛡️</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Garantía</h3>
                    <p class="text-gray-600">Productos con garantía del fabricante</p>
                </div>
                
                <div>
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl text-blue-600">💬</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Soporte</h3>
                    <p class="text-gray-600">Atención personalizada para tus proyectos</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
