<?php
/**
 * Página de inicio moderna para ITOOLS
 */
get_header();
?>

<!-- Hero Slider Section -->
<section class="hero-slider">
    <div class="slider-container">
        <div class="slide active" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="slide-content">
                <h1>Herramientas Profesionales</h1>
                <p>Encuentra las mejores herramientas para tus proyectos más exigentes</p>
                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="btn btn-primary">Explorar Catálogo</a>
            </div>
        </div>
        <div class="slide" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="slide-content">
                <h1>Maquinaria Industrial</h1>
                <p>Soluciones completas para la industria y construcción</p>
                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="btn btn-primary">Ver Maquinaria</a>
            </div>
        </div>
        <div class="slide" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="slide-content">
                <h1>Ofertas Especiales</h1>
                <p>Aprovecha nuestros descuentos exclusivos por tiempo limitado</p>
                <a href="<?php echo esc_url( home_url( '/ofertas' ) ); ?>" class="btn btn-secondary">Ver Ofertas</a>
            </div>
        </div>
    </div>
    
    <!-- Slider Navigation -->
    <button class="slider-nav prev" onclick="changeSlide(-1)" aria-label="Slide anterior">‹</button>
    <button class="slider-nav next" onclick="changeSlide(1)" aria-label="Slide siguiente">›</button>
    
    <!-- Slider Dots -->
    <div class="slider-dots">
        <span class="dot active" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
</section>

<!-- Main Content -->
<main class="main-content">
    <div class="container">
        <!-- Categories Section -->
        <section class="categories-section">
            <div class="section-header">
                <h2>Nuestras Categorías</h2>
                <p>Explora nuestra amplia gama de productos profesionales</p>
            </div>
            
            <div class="categories-grid">
                <?php
                // Obtener categorías de WooCommerce de forma segura
                if ( function_exists( 'get_terms' ) && taxonomy_exists( 'product_cat' ) ) {
                    $categories = get_terms( array(
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => false,
                        'parent'     => 0,
                        'number'     => 6, // Limitar a 6 categorías principales
                    ));
                    
                    if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
                        foreach ( $categories as $category ) {
                            $category_link = get_term_link( $category );
                            if ( is_wp_error( $category_link ) ) {
                                $category_link = '#';
                            }
                            
                            // Obtener imagen de la categoría (thumbnail)
                            $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                            $image_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : '';
                            
                            echo '<div class="category-card">';
                            if ( $image_url ) {
                                echo '<div class="category-image" style="background-image: url(' . esc_url( $image_url ) . ');"></div>';
                            } else {
                                echo '<div class="category-image category-placeholder"></div>';
                            }
                            echo '<div class="category-info">';
                            echo '<h3>' . esc_html( $category->name ) . '</h3>';
                            echo '<p>' . $category->count . ' productos disponibles</p>';
                            echo '<a href="' . esc_url( $category_link ) . '" class="btn btn-outline">Ver Productos</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        // Fallback si no hay categorías o WooCommerce no está activo
                        echo '<div class="category-card">';
                        echo '<div class="category-image category-placeholder"></div>';
                        echo '<div class="category-info">';
                        echo '<h3>Herramientas Manuales</h3>';
                        echo '<p>Herramientas de calidad profesional</p>';
                        echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '" class="btn btn-outline">Ver Productos</a>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="category-card">';
                        echo '<div class="category-image category-placeholder"></div>';
                        echo '<div class="category-info">';
                        echo '<h3>Maquinaria Industrial</h3>';
                        echo '<p>Equipos para construcción e industria</p>';
                        echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '" class="btn btn-outline">Ver Productos</a>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="category-card">';
                        echo '<div class="category-image category-placeholder"></div>';
                        echo '<div class="category-info">';
                        echo '<h3>Accesorios</h3>';
                        echo '<p>Complementos y repuestos</p>';
                        echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '" class="btn btn-outline">Ver Productos</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // Fallback completo si WooCommerce no está disponible
                    for ( $i = 1; $i <= 3; $i++ ) {
                        echo '<div class="category-card">';
                        echo '<div class="category-image category-placeholder"></div>';
                        echo '<div class="category-info">';
                        echo '<h3>Categoría ' . $i . '</h3>';
                        echo '<p>Productos de calidad profesional</p>';
                        echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '" class="btn btn-outline">Ver Productos</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="featured-products-section">
            <div class="section-header">
                <h2>Productos Destacados</h2>
                <p>Los productos más populares de nuestra tienda</p>
            </div>
            
            <div class="products-showcase">
                <?php
                // Mostrar productos destacados de WooCommerce
                if ( function_exists( 'do_shortcode' ) && shortcode_exists( 'featured_products' ) ) {
                    echo do_shortcode( '[featured_products limit="4" columns="4"]' );
                } else {
                    // Fallback para productos destacados
                    echo '<div class="products-fallback">';
                    echo '<p>Los productos destacados se mostrarán cuando WooCommerce esté completamente configurado.</p>';
                    echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '" class="btn btn-primary">Ir a la Tienda</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="cta-section">
            <div class="cta-content">
                <h2>¿Necesitas Asesoría Especializada?</h2>
                <p>Nuestros expertos están listos para ayudarte a encontrar las herramientas perfectas para tu proyecto</p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" class="btn btn-primary">Contactar Experto</a>
                    <a href="tel:+5255123456789" class="btn btn-outline">Llamar Ahora</a>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
// Slider JavaScript
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
    });
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
    });
}

function changeSlide(direction) {
    currentSlideIndex += direction;
    if (currentSlideIndex >= slides.length) currentSlideIndex = 0;
    if (currentSlideIndex < 0) currentSlideIndex = slides.length - 1;
    showSlide(currentSlideIndex);
}

function currentSlide(index) {
    currentSlideIndex = index - 1;
    showSlide(currentSlideIndex);
}

// Auto-advance slides
setInterval(() => {
    changeSlide(1);
}, 5000);
</script>

<?php get_footer(); ?>
