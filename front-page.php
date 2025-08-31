<?php
/**
 * Página de inicio moderna para ITOOLS
 */
get_header();
?>

<style>
/* Force header visibility on front page */
.site-header,
.top-bar,
.main-header {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}
</style>

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
                // Categorías específicas para ITOOLS con iconos y colores
                $itools_categories = array(
                    array(
                        'name' => 'Refacciones',
                        'description' => 'Repuestos y componentes de calidad',
                        'icon' => '⚙️',
                        'color' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                        'url' => home_url('/categoria/refacciones')
                    ),
                    array(
                        'name' => 'Pantallas',
                        'description' => 'Pantallas y displays profesionales',
                        'icon' => '📱',
                        'color' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                        'url' => home_url('/categoria/pantallas')
                    ),
                    array(
                        'name' => 'Herramientas',
                        'description' => 'Herramientas manuales y eléctricas',
                        'icon' => '🔧',
                        'color' => 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                        'url' => home_url('/categoria/herramientas')
                    ),
                    array(
                        'name' => 'Accesorios',
                        'description' => 'Complementos y adaptadores',
                        'icon' => '🔌',
                        'color' => 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
                        'url' => home_url('/categoria/accesorios')
                    ),
                    array(
                        'name' => 'Baterías',
                        'description' => 'Baterías y sistemas de energía',
                        'icon' => '🔋',
                        'color' => 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
                        'url' => home_url('/categoria/baterias')
                    )
                );

                // Intentar obtener categorías reales de WooCommerce si están disponibles
                if ( function_exists( 'get_terms' ) && taxonomy_exists( 'product_cat' ) ) {
                    $wc_categories = get_terms( array(
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => false,
                        'parent'     => 0,
                        'number'     => 5,
                    ));
                    
                    if ( ! is_wp_error( $wc_categories ) && ! empty( $wc_categories ) ) {
                        $category_index = 0;
                        foreach ( $wc_categories as $category ) {
                            if ( $category_index >= count( $itools_categories ) ) break;
                            
                            $category_link = get_term_link( $category );
                            if ( is_wp_error( $category_link ) ) {
                                $category_link = $itools_categories[$category_index]['url'];
                            }
                            
                            // Obtener imagen de la categoría (thumbnail)
                            $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                            $image_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : '';
                            
                            echo '<div class="category-card modern-category" data-aos="fade-up" data-aos-delay="' . ($category_index * 100) . '">';
                            
                            if ( $image_url ) {
                                echo '<div class="category-image" style="background-image: url(' . esc_url( $image_url ) . ');">';
                            } else {
                                echo '<div class="category-image category-gradient" style="background: ' . $itools_categories[$category_index]['color'] . ';">';
                                echo '<div class="category-icon">' . $itools_categories[$category_index]['icon'] . '</div>';
                            }
                            echo '<div class="category-overlay"></div>';
                            echo '</div>';
                            
                            echo '<div class="category-info">';
                            echo '<h3>' . esc_html( $category->name ) . '</h3>';
                            echo '<p>' . $category->count . ' productos disponibles</p>';
                            echo '<div class="category-stats">';
                            echo '<span class="stock-indicator">✅ En Stock</span>';
                            echo '</div>';
                            echo '<a href="' . esc_url( $category_link ) . '" class="btn btn-category">Explorar</a>';
                            echo '</div>';
                            echo '</div>';
                            
                            $category_index++;
                        }
                    } else {
                        // Usar categorías predefinidas como fallback
                        foreach ( $itools_categories as $index => $category ) {
                            echo '<div class="category-card modern-category" data-aos="fade-up" data-aos-delay="' . ($index * 100) . '">';
                            echo '<div class="category-image category-gradient" style="background: ' . $category['color'] . ';">';
                            echo '<div class="category-icon">' . $category['icon'] . '</div>';
                            echo '<div class="category-overlay"></div>';
                            echo '</div>';
                            echo '<div class="category-info">';
                            echo '<h3>' . esc_html( $category['name'] ) . '</h3>';
                            echo '<p>' . esc_html( $category['description'] ) . '</p>';
                            echo '<div class="category-stats">';
                            echo '<span class="stock-indicator">✅ En Stock</span>';
                            echo '</div>';
                            echo '<a href="' . esc_url( $category['url'] ) . '" class="btn btn-category">Explorar</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                } else {
                    // Fallback completo si WooCommerce no está disponible
                    foreach ( $itools_categories as $index => $category ) {
                        echo '<div class="category-card modern-category" data-aos="fade-up" data-aos-delay="' . ($index * 100) . '">';
                        echo '<div class="category-image category-gradient" style="background: ' . $category['color'] . ';">';
                        echo '<div class="category-icon">' . $category['icon'] . '</div>';
                        echo '<div class="category-overlay"></div>';
                        echo '</div>';
                        echo '<div class="category-info">';
                        echo '<h3>' . esc_html( $category['name'] ) . '</h3>';
                        echo '<p>' . esc_html( $category['description'] ) . '</p>';
                        echo '<div class="category-stats">';
                        echo '<span class="stock-indicator">✅ En Stock</span>';
                        echo '</div>';
                        echo '<a href="' . esc_url( $category['url'] ) . '" class="btn btn-category">Explorar</a>';
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
                <p>Descubre nuestras herramientas más populares y de mayor calidad</p>
            </div>
            
            <div class="products-showcase">
                <?php
                // Mostrar productos destacados de WooCommerce
                if ( function_exists( 'wc_get_products' ) ) {
                    $featured_products = wc_get_products( array(
                        'status' => 'publish',
                        'featured' => true,
                        'limit' => 4,
                    ));
                    
                    if ( ! empty( $featured_products ) ) {
                        echo '<div class="products-grid">';
                        foreach ( $featured_products as $product ) {
                            $product_id = $product->get_id();
                            $product_name = $product->get_name();
                            $product_price = $product->get_price_html();
                            $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'medium' );
                            $product_url = get_permalink( $product_id );
                            
                            echo '<div class="product-card">';
                            echo '<div class="product-image">';
                            if ( $product_image ) {
                                echo '<img src="' . esc_url( $product_image[0] ) . '" alt="' . esc_attr( $product_name ) . '">';
                            } else {
                                echo '<div class="product-placeholder">🛠️</div>';
                            }
                            echo '<div class="product-overlay">';
                            echo '<a href="' . esc_url( $product_url ) . '" class="btn btn-primary">Ver Producto</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="product-info">';
                            echo '<h3>' . esc_html( $product_name ) . '</h3>';
                            echo '<div class="product-price">' . $product_price . '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        // Mostrar productos predeterminados como demo
                        $demo_products = array(
                            array(
                                'name' => 'Taladro Profesional XS-2000',
                                'price' => '$2,450.00',
                                'image' => '🔨',
                                'url' => home_url('/producto/taladro-xs-2000')
                            ),
                            array(
                                'name' => 'Kit de Destornilladores Premium',
                                'price' => '$890.00',
                                'image' => '🔧',
                                'url' => home_url('/producto/kit-destornilladores')
                            ),
                            array(
                                'name' => 'Pantalla Industrial HD 24"',
                                'price' => '$3,200.00',
                                'image' => '📺',
                                'url' => home_url('/producto/pantalla-hd-24')
                            ),
                            array(
                                'name' => 'Batería Recargable Pro-Max',
                                'price' => '$1,150.00',
                                'image' => '🔋',
                                'url' => home_url('/producto/bateria-pro-max')
                            ),
                        );
                        
                        echo '<div class="products-grid">';
                        foreach ( $demo_products as $product ) {
                            echo '<div class="product-card demo-product">';
                            echo '<div class="product-image">';
                            echo '<div class="product-placeholder" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">' . $product['image'] . '</div>';
                            echo '<div class="product-overlay">';
                            echo '<a href="' . esc_url( $product['url'] ) . '" class="btn btn-primary">Ver Producto</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="product-info">';
                            echo '<h3>' . esc_html( $product['name'] ) . '</h3>';
                            echo '<div class="product-price">' . esc_html( $product['price'] ) . '</div>';
                            echo '<div class="product-meta">';
                            echo '<span class="stock-status">✅ En Stock</span>';
                            echo '<span class="rating">⭐⭐⭐⭐⭐</span>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                } else {
                    // Fallback si WooCommerce no está activo
                    echo '<div class="products-fallback">';
                    echo '<h3>🛠️ Próximamente</h3>';
                    echo '<p>Estamos preparando nuestro catálogo de productos destacados.</p>';
                    echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '" class="btn btn-primary">Explorar Catálogo</a>';
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
