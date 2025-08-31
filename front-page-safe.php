<?php
/**
 * Página de inicio ITOOLS - Versión Sin Tailwind
 */
get_header();
?>

<div style="min-height: 100vh; background-color: #f9fafb;">
    
    <!-- Hero Section -->
    <section style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); color: white; padding: 80px 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center;">
            <h1 style="font-size: 3rem; font-weight: bold; margin-bottom: 24px;">ITOOLS México</h1>
            <p style="font-size: 1.25rem; margin-bottom: 32px; opacity: 0.9;">Herramientas profesionales para técnicos expertos</p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" 
                   style="background: white; color: #2563eb; padding: 12px 32px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-block;">
                    Ver Catálogo
                </a>
                <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" 
                   style="border: 2px solid white; color: white; padding: 12px 32px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-block;">
                    Contacto
                </a>
            </div>
        </div>
    </section>

    <!-- Servicios -->
    <section style="padding: 80px 0; background: white;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div style="text-align: center; margin-bottom: 64px;">
                <h2 style="font-size: 2.5rem; font-weight: bold; color: #1f2937; margin-bottom: 24px;">Nuestros Servicios</h2>
                <p style="font-size: 1.125rem; color: #6b7280;">Soluciones completas para todas tus necesidades técnicas</p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px;">
                <div style="background: #f9fafb; padding: 32px; border-radius: 12px; text-align: center;">
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 16px; color: #1f2937;">Herramientas Eléctricas</h3>
                    <p style="color: #6b7280;">Multímetros, probadores y equipos de medición profesional.</p>
                </div>
                
                <div style="background: #f9fafb; padding: 32px; border-radius: 12px; text-align: center;">
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 16px; color: #1f2937;">Electrónica Automotriz</h3>
                    <p style="color: #6b7280;">Scanner automotriz y herramientas de diagnóstico vehicular.</p>
                </div>
                
                <div style="background: #f9fafb; padding: 32px; border-radius: 12px; text-align: center;">
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 16px; color: #1f2937;">Comunicaciones</h3>
                    <p style="color: #6b7280;">Radios, antenas y equipos de comunicación profesional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <?php if ( function_exists( 'wc_get_products' ) ): ?>
    <section style="padding: 64px 0; background: #f9fafb;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <h2 style="font-size: 2rem; font-weight: bold; text-align: center; color: #1f2937; margin-bottom: 48px;">Productos Destacados</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px;">
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
                <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <?php if ( $product_image ): ?>
                    <img src="<?php echo esc_url( $product_image[0] ); ?>" alt="<?php echo esc_attr( $product_name ); ?>" style="width: 100%; height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div style="padding: 24px;">
                        <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 8px;"><?php echo esc_html( $product_name ); ?></h3>
                        <p style="color: #2563eb; font-weight: bold; font-size: 1.25rem; margin-bottom: 16px;"><?php echo wp_kses_post( $product_price ); ?></p>
                        <a href="<?php echo esc_url( $product_url ); ?>" style="background: #2563eb; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; display: inline-block;">
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
