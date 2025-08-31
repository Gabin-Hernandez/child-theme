<?php
/**
 * Página de inicio SIMPLE y FUNCIONAL para ITOOLS
 */
get_header();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Hero Section Simple -->
    <section class="bg-gradient-to-br from-brand-blue to-brand-purple text-white py-20">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">ITOOLS México</h1>
            <p class="text-xl mb-8 opacity-90">Herramientas profesionales para técnicos expertos</p>
            <div class="space-x-4">
                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" 
                   class="bg-white text-brand-blue px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Ver Catálogo
                </a>
                <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" 
                   class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-brand-blue transition-colors">
                    Contacto
                </a>
            </div>
        </div>
    </section>

    <!-- Contenido Básico -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Nuestros Servicios</h2>
                <p class="text-gray-600">Soluciones profesionales para todas tus necesidades</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <h3 class="text-xl font-semibold mb-3">Herramientas Eléctricas</h3>
                    <p class="text-gray-600">Multímetros, probadores y equipos de medición profesional.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <h3 class="text-xl font-semibold mb-3">Electrónica Automotriz</h3>
                    <p class="text-gray-600">Scanner automotriz y herramientas de diagnóstico.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <h3 class="text-xl font-semibold mb-3">Comunicaciones</h3>
                    <p class="text-gray-600">Radios, antenas y equipos de comunicación profesional.</p>
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
                        <p class="text-brand-blue font-bold text-xl mb-4"><?php echo wp_kses_post( $product_price ); ?></p>
                        <a href="<?php echo esc_url( $product_url ); ?>" class="bg-brand-blue text-white px-4 py-2 rounded hover:bg-opacity-90 transition-colors">
                            Ver Producto
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
