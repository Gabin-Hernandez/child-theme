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

<!-- Hero Slider Section - Dynamic with Real Product Images -->
<section class="hero-slider">
    <div class="slider-container">
        <?php
        // Obtener productos destacados para el slider
        if ( function_exists( 'wc_get_products' ) ) {
            $featured_products = wc_get_products( array(
                'status' => 'publish',
                'featured' => true,
                'limit' => 3,
            ));
            
            // Si no hay productos destacados, obtener productos aleatorios
            if ( empty( $featured_products ) ) {
                $featured_products = wc_get_products( array(
                    'status' => 'publish',
                    'limit' => 3,
                    'orderby' => 'rand',
                ));
            }
            
            if ( ! empty( $featured_products ) ) {
                $slide_index = 0;
                foreach ( $featured_products as $product ) {
                    $product_id = $product->get_id();
                    $product_name = $product->get_name();
                    $product_description = $product->get_short_description();
                    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );
                    $product_url = get_permalink( $product_id );
                    $product_price = $product->get_price_html();
                    
                    // Usar imagen del producto como fondo, con overlay
                    $background_style = '';
                    if ( $product_image ) {
                        $background_style = 'style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url(' . esc_url( $product_image[0] ) . '); background-size: cover; background-position: center;"';
                    } else {
                        // Fallback con gradientes modernos si no hay imagen
                        $gradients = array(
                            'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                            'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                            'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)'
                        );
                        $background_style = 'style="background: ' . $gradients[$slide_index % 3] . ';"';
                    }
                    
                    $active_class = $slide_index === 0 ? ' active' : '';
                    
                    echo '<div class="slide modern-slide' . $active_class . '" ' . $background_style . '>';
                    echo '<div class="slide-overlay"></div>';
                    echo '<div class="slide-content">';
                    echo '<div class="slide-badge">Producto Destacado</div>';
                    echo '<h1>' . esc_html( $product_name ) . '</h1>';
                    
                    if ( $product_description ) {
                        echo '<p>' . wp_strip_all_tags( $product_description ) . '</p>';
                    } else {
                        echo '<p>Descubre este increíble producto de nuestra selección profesional</p>';
                    }
                    
                    echo '<div class="slide-price">' . $product_price . '</div>';
                    echo '<div class="slide-actions">';
                    echo '<a href="' . esc_url( $product_url ) . '" class="btn btn-primary slide-btn">Ver Producto</a>';
                    echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '" class="btn btn-secondary slide-btn">Ver Catálogo</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    
                    $slide_index++;
                }
            } else {
                // Fallback si no hay productos disponibles
                ?>
                <div class="slide active" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="slide-overlay"></div>
                    <div class="slide-content">
                        <div class="slide-badge">ITOOLS México</div>
                        <h1>Herramientas Profesionales</h1>
                        <p>Encuentra las mejores herramientas para tus proyectos más exigentes</p>
                        <div class="slide-actions">
                            <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="btn btn-primary slide-btn">Explorar Catálogo</a>
                            <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" class="btn btn-secondary slide-btn">Contactanos</a>
                        </div>
                    </div>
                </div>
                <div class="slide" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="slide-overlay"></div>
                    <div class="slide-content">
                        <div class="slide-badge">Calidad Garantizada</div>
                        <h1>Maquinaria Industrial</h1>
                        <p>Soluciones completas para la industria y construcción</p>
                        <div class="slide-actions">
                            <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="btn btn-primary slide-btn">Ver Maquinaria</a>
                            <a href="<?php echo esc_url( home_url( '/servicios' ) ); ?>" class="btn btn-secondary slide-btn">Servicios</a>
                        </div>
                    </div>
                </div>
                <div class="slide" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="slide-overlay"></div>
                    <div class="slide-content">
                        <div class="slide-badge">Ofertas Especiales</div>
                        <h1>Descuentos Exclusivos</h1>
                        <p>Aprovecha nuestros precios especiales por tiempo limitado</p>
                        <div class="slide-actions">
                            <a href="<?php echo esc_url( home_url( '/ofertas' ) ); ?>" class="btn btn-primary slide-btn">Ver Ofertas</a>
                            <a href="<?php echo esc_url( home_url( '/newsletter' ) ); ?>" class="btn btn-secondary slide-btn">Suscribirse</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            // Fallback completo si WooCommerce no está disponible
            ?>
            <div class="slide active" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <div class="slide-badge">ITOOLS México</div>
                    <h1>Herramientas Profesionales</h1>
                    <p>Tu socio de confianza en herramientas y equipos industriales</p>
                    <div class="slide-actions">
                        <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="btn btn-primary slide-btn">Explorar Catálogo</a>
                        <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" class="btn btn-secondary slide-btn">Contactanos</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    
    <!-- Slider Navigation -->
    <button class="slider-nav prev" onclick="changeSlide(-1)" aria-label="Slide anterior">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <button class="slider-nav next" onclick="changeSlide(1)" aria-label="Slide siguiente">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    
    <!-- Slider Dots -->
    <div class="slider-dots">
        <?php
        // Generar dots dinámicamente basado en el número de slides
        $total_slides = 3; // Default fallback
        if ( function_exists( 'wc_get_products' ) ) {
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
            if ( ! empty( $featured_products ) ) {
                $total_slides = count( $featured_products );
            }
        }
        
        for ( $i = 1; $i <= $total_slides; $i++ ) {
            $active_class = $i === 1 ? ' active' : '';
            echo '<span class="dot' . $active_class . '" onclick="currentSlide(' . $i . ')"></span>';
        }
        ?>
    </div>
</section>

<!-- Main Content -->
<main class="main-content">
    <div class="container">
        <!-- CTA Section with Statistics - MODERN DESIGN -->
        <section class="hero-cta-section">
            <div class="container">
                <div class="cta-content">
                    <h2>Herramientas para técnicos profesionales</h2>
                    <p>Equipos y herramientas de alta calidad para profesionales como tú. Más de una década de experiencia respaldando tu trabajo.</p>
                    
                    <div class="cta-stats">
                        <div class="stat-item">
                            <span class="stat-number">10+</span>
                            <span class="stat-label">Años de experiencia</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">3</span>
                            <span class="stat-label">Sucursales activas</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">5K+</span>
                            <span class="stat-label">Envíos realizados</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">97%</span>
                            <span class="stat-label">Satisfacción del cliente</span>
                        </div>
                    </div>
                    
                    <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="cta-button">Explorar Catálogo</a>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="categories-section">
            <div class="section-header">
                <h2>Nuestras Categorías</h2>
                <p>Explora nuestra amplia gama de productos profesionales</p>
            </div>
            
            <div class="categories-grid">
                <?php
                // Obtener categorías reales de WooCommerce
                if ( function_exists( 'get_terms' ) && taxonomy_exists( 'product_cat' ) ) {
                    $wc_categories = get_terms( array(
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => false,
                        'parent'     => 0,
                        'number'     => 6, // Mostrar hasta 6 categorías
                    ));
                    
                    if ( ! is_wp_error( $wc_categories ) && ! empty( $wc_categories ) ) {
                        foreach ( $wc_categories as $index => $category ) {
                            $category_link = get_term_link( $category );
                            if ( is_wp_error( $category_link ) ) {
                                continue;
                            }
                            
                            // Obtener imagen de la categoría
                            $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                            $category_image_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : '';
                            
                            // Si no hay imagen de categoría, obtener imagen del primer producto
                            if ( ! $category_image_url ) {
                                $category_products = wc_get_products( array(
                                    'category' => array( $category->slug ),
                                    'limit' => 1,
                                    'status' => 'publish',
                                ));
                                
                                if ( ! empty( $category_products ) ) {
                                    $first_product = $category_products[0];
                                    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $first_product->get_id() ), 'medium' );
                                    if ( $product_image ) {
                                        $category_image_url = $product_image[0];
                                    }
                                }
                            }
                            
                            // Gradientes de respaldo si no hay imagen
                            $gradient_colors = array(
                                'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                                'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                                'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                                'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
                                'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
                                'linear-gradient(135deg, #a8edea 0%, #fed6e3 100%)'
                            );
                            
                            echo '<div class="category-card modern-category" data-aos="fade-up" data-aos-delay="' . ($index * 100) . '">';
                            
                            if ( $category_image_url ) {
                                echo '<div class="category-image" style="background-image: url(' . esc_url( $category_image_url ) . ');">';
                                echo '<div class="category-overlay"></div>';
                            } else {
                                echo '<div class="category-image category-gradient" style="background: ' . $gradient_colors[$index % count($gradient_colors)] . ';">';
                                echo '<div class="category-overlay"></div>';
                            }
                            
                            // Badge con número de productos
                            echo '<div class="category-badge">' . $category->count . ' productos</div>';
                            echo '</div>';
                            
                            echo '<div class="category-info">';
                            echo '<h3>' . esc_html( $category->name ) . '</h3>';
                            
                            // Mostrar descripción si existe
                            if ( $category->description ) {
                                echo '<p>' . esc_html( wp_trim_words( $category->description, 8 ) ) . '</p>';
                            } else {
                                echo '<p>Explora nuestra selección de ' . esc_html( strtolower( $category->name ) ) . ' profesionales</p>';
                            }
                            
                            echo '<div class="category-stats">';
                            if ( $category->count > 0 ) {
                                echo '<span class="stock-indicator in-stock">✓ Disponible</span>';
                            } else {
                                echo '<span class="stock-indicator coming-soon">🔄 Próximamente</span>';
                            }
                            echo '</div>';
                            
                            echo '<a href="' . esc_url( $category_link ) . '" class="btn btn-category">Explorar <span class="arrow">→</span></a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        // Fallback con categorías predefinidas pero buscando imágenes de productos
                        $fallback_categories = array(
                            'herramientas' => 'Herramientas',
                            'refacciones' => 'Refacciones', 
                            'pantallas' => 'Pantallas',
                            'accesorios' => 'Accesorios',
                            'baterias' => 'Baterías'
                        );
                        
                        $index = 0;
                        foreach ( $fallback_categories as $slug => $name ) {
                            // Buscar productos que contengan estas palabras clave
                            $products = wc_get_products( array(
                                'limit' => 1,
                                'status' => 'publish',
                                's' => $slug
                            ));
                            
                            $image_url = '';
                            if ( ! empty( $products ) ) {
                                $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $products[0]->get_id() ), 'medium' );
                                if ( $product_image ) {
                                    $image_url = $product_image[0];
                                }
                            }
                            
                            $gradient_colors = array(
                                'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                                'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                                'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                                'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
                                'linear-gradient(135deg, #fa709a 0%, #fee140 100%)'
                            );
                            
                            echo '<div class="category-card modern-category" data-aos="fade-up" data-aos-delay="' . ($index * 100) . '">';
                            
                            if ( $image_url ) {
                                echo '<div class="category-image" style="background-image: url(' . esc_url( $image_url ) . ');">';
                            } else {
                                echo '<div class="category-image category-gradient" style="background: ' . $gradient_colors[$index % count($gradient_colors)] . ';">';
                            }
                            echo '<div class="category-overlay"></div>';
                            echo '<div class="category-badge">Ver productos</div>';
                            echo '</div>';
                            
                            echo '<div class="category-info">';
                            echo '<h3>' . esc_html( $name ) . '</h3>';
                            echo '<p>Descubre nuestra selección profesional de ' . esc_html( strtolower( $name ) ) . '</p>';
                            echo '<div class="category-stats">';
                            echo '<span class="stock-indicator in-stock">✓ Disponible</span>';
                            echo '</div>';
                            echo '<a href="' . esc_url( home_url( '/tienda/?s=' . urlencode( $slug ) ) ) . '" class="btn btn-category">Explorar <span class="arrow">→</span></a>';
                            echo '</div>';
                            echo '</div>';
                            
                            $index++;
                        }
                    }
                } else {
                    // Fallback completo si WooCommerce no está disponible
                    echo '<div class="no-woocommerce-message">';
                    echo '<h3>Catálogo en Preparación</h3>';
                    echo '<p>Estamos organizando nuestro catálogo para ofrecerte la mejor experiencia de compra.</p>';
                    echo '<a href="' . esc_url( home_url( '/contacto' ) ) . '" class="btn btn-primary">Contáctanos</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>

        <!-- Product Categories Section - GRID FORMAT -->
        <section class="product-categories-section">
            <div class="container">
                <h2 class="section-title">Nuestros Productos por Categoría</h2>
                <p class="section-subtitle">Explora nuestro catálogo organizado por especialidades</p>

                <?php
                // Obtener categorías reales de WooCommerce
                if ( function_exists( 'get_terms' ) && taxonomy_exists( 'product_cat' ) ) {
                    $categories = get_terms( array(
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => false,
                        'parent'     => 0,
                        'number'     => 3, // Limitar a 3 categorías principales
                    ));
                    
                    if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
                        foreach ( $categories as $category ) {
                            // Obtener productos de esta categoría
                            if ( function_exists( 'wc_get_products' ) ) {
                                $products = wc_get_products( array(
                                    'category' => array( $category->slug ),
                                    'limit'    => 8, // 8 productos para mostrar 2 filas de 4
                                    'status'   => 'publish',
                                ));
                                
                                if ( ! empty( $products ) ) {
                                    echo '<div class="category-products-section">';
                                    echo '<div class="category-header">';
                                    echo '<h3 class="category-title">' . esc_html( $category->name ) . '</h3>';
                                    echo '<a href="' . esc_url( get_term_link( $category ) ) . '" class="view-all-btn">Ver todos <span class="arrow">→</span></a>';
                                    echo '</div>';
                                    
                                    echo '<div class="products-grid">';
                                    
                                    foreach ( $products as $product ) {
                                        $product_id = $product->get_id();
                                        $product_name = $product->get_name();
                                        $product_price = $product->get_price_html();
                                        $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'medium' );
                                        $product_url = get_permalink( $product_id );
                                        $sale_price = $product->get_sale_price();
                                        $regular_price = $product->get_regular_price();
                                        
                                        echo '<div class="product-card">';
                                        echo '<div class="product-image">';
                                        
                                        if ( $product_image ) {
                                            echo '<img src="' . esc_url( $product_image[0] ) . '" alt="' . esc_attr( $product_name ) . '">';
                                        } else {
                                            echo '<div class="no-image-placeholder">Sin imagen</div>';
                                        }
                                        
                                        // Badge para productos en oferta
                                        if ( $sale_price ) {
                                            echo '<span class="product-badge sale">Oferta</span>';
                                        }
                                        
                                        echo '</div>';
                                        
                                        echo '<div class="product-info">';
                                        echo '<h4 class="product-title">' . esc_html( $product_name ) . '</h4>';
                                        
                                        echo '<div class="product-price">';
                                        if ( $sale_price && $regular_price ) {
                                            echo '<span class="price-current">$' . number_format( floatval( $sale_price ), 2 ) . '</span>';
                                            echo '<span class="price-original">$' . number_format( floatval( $regular_price ), 2 ) . '</span>';
                                        } else {
                                            echo '<span class="price-current">' . $product_price . '</span>';
                                        }
                                        echo '</div>';
                                        
                                        // Rating placeholder
                                        echo '<div class="product-rating">';
                                        echo '<span class="stars">★★★★★</span>';
                                        echo '<span>(4.5)</span>';
                                        echo '</div>';
                                        
                                        // Stock status
                                        if ( $product->is_in_stock() ) {
                                            echo '<span class="stock-status in-stock">✓ En Stock</span>';
                                        } else {
                                            echo '<span class="stock-status out-of-stock">✗ Agotado</span>';
                                        }
                                        
                                        echo '<a href="' . esc_url( $product_url ) . '" class="add-to-cart-btn">Ver Producto</a>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    
                                    echo '</div>'; // .products-grid
                                    echo '</div>'; // .category-products-section
                                }
                            }
                        }
                    } else {
                        // Fallback si no hay categorías
                        echo '<div class="no-categories-message">';
                        echo '<h3>Configurando catálogo</h3>';
                        echo '<p>Estamos organizando nuestros productos para ofrecerte la mejor experiencia.</p>';
                        echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '" class="cta-button">Ver todos los productos</a>';
                        echo '</div>';
                    }
                } else {
                    // Fallback si WooCommerce no está disponible
                    echo '<div class="woocommerce-not-active">';
                    echo '<h3>Catálogo en preparación</h3>';
                    echo '<p>Pronto podrás explorar nuestro catálogo completo de herramientas profesionales.</p>';
                    echo '</div>';
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
// Hero Slider functionality
document.addEventListener('DOMContentLoaded', function() {
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    if (slides.length > 0) {
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            if (dots.length > 0) {
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
            }
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

        // Auto-advance slides every 5 seconds
        setInterval(() => {
            changeSlide(1);
        }, 5000);

        // Initialize
        showSlide(0);
    }

    // Smooth scrolling for CTA button
    const ctaButton = document.querySelector('.cta-button');
    if (ctaButton) {
        ctaButton.addEventListener('click', function(e) {
            if (this.getAttribute('href').startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    }

    // Product cards hover effects
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

// Global functions for slider navigation
function changeSlide(direction) {
    const event = new CustomEvent('changeSlide', { detail: direction });
    document.dispatchEvent(event);
}

function currentSlide(index) {
    const event = new CustomEvent('currentSlide', { detail: index });
    document.dispatchEvent(event);
}
</script>

<?php get_footer(); ?>
