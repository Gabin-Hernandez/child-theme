<?php
/**
 * Página de inicio ITOOLS
 */
get_header();
?>

<main class="bg-gray-50 min-h-screen">
    
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-600 to-purple-600 text-white py-20">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">ITOOLS México</h1>
            <p class="text-xl mb-8 opacity-90">Herramientas profesionales para técnicos expertos</p>
            <div class="space-x-4">
                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" 
                   class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Ver Catálogo
                </a>
                <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" 
                   class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                    Contacto
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-br from-blue-500 to-purple-600 py-20 text-white">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <div class="inline-block bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6">
                ITOOLS México
            </div>
            
            <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                Herramientas para técnicos profesionales
            </h2>
            
            <p class="text-xl mb-12 opacity-90 max-w-3xl mx-auto">
                Equipos y herramientas de alta calidad para profesionales como tú. Más de una década de experiencia respaldando tu trabajo.
            </p>
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">10+</div>
                    <div class="text-sm opacity-80 uppercase tracking-wide">Años de experiencia</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">3</div>
                    <div class="text-sm opacity-80 uppercase tracking-wide">Sucursales activas</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">5K+</div>
                    <div class="text-sm opacity-80 uppercase tracking-wide">Envíos realizados</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">97%</div>
                    <div class="text-sm opacity-80 uppercase tracking-wide">Satisfacción del cliente</div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" 
                   class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transform hover:-translate-y-1 transition-all duration-300">
                    Explorar Catálogo
                </a>
                <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" 
                   class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">
                    Contactar Experto
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Nuestros Servicios Especializados</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Soluciones completas para todas tus necesidades técnicas</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Primary Service Card -->
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-8 text-white transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h3 class="text-2xl font-bold mb-2">Herramientas Eléctricas</h3>
                        <p class="text-white text-opacity-90 mb-4">Multímetros y equipos de medición</p>
                        <div class="inline-block bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm font-semibold">
                            Especialistas
                        </div>
                    </div>
                </div>
                
                <!-- Service Card 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Electrónica Automotriz</h3>
                        <p class="text-gray-600 mb-4">Scanner y diagnóstico vehicular</p>
                        <div class="inline-block bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Profesional
                        </div>
                    </div>
                </div>
                
                <!-- Service Card 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Comunicaciones</h3>
                        <p class="text-gray-600 mb-4">Radios y equipos profesionales</p>
                        <div class="inline-block bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Expertos
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <?php if ( function_exists( 'wc_get_products' ) ): ?>
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Productos Destacados</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $featured_products = wc_get_products( array(
                    'status' => 'publish',
                    'featured' => true,
                    'limit' => 3,
                ));
                
                if ( empty( $featured_products ) ) {
                    $featured_products = wc_get_products( array(
                        'status' => 'publish',
                        'limit' => 3,
                        'orderby' => 'rand',
                    ));
                }
                
                foreach ( $featured_products as $product ):
                    $product_id = $product->get_id();
                    $product_name = $product->get_name();
                    $product_price = $product->get_price_html();
                    $product_url = get_permalink( $product_id );
                    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'medium' );
                ?>
                <div class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    <?php if ( $product_image ): ?>
                    <img src="<?php echo esc_url( $product_image[0] ); ?>" alt="<?php echo esc_attr( $product_name ); ?>" class="w-full h-48 object-cover">
                    <?php endif; ?>
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-2"><?php echo esc_html( $product_name ); ?></h3>
                        <p class="text-blue-600 font-bold text-xl mb-4"><?php echo wp_kses_post( $product_price ); ?></p>
                        <a href="<?php echo esc_url( $product_url ); ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                            Ver Producto
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
