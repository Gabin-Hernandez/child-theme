<?php
/**
 * Página de inicio moderna para ITOOLS
 */
get_header();
?>

<!-- Hero Slider Section -->
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
        <!-- Modern CTA Section with Tailwind -->
        <section class="bg-gradient-to-br from-brand-blue to-brand-purple py-20 text-white">
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
                       class="bg-white text-brand-blue px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transform hover:-translate-y-1 transition-all duration-300">
                        Explorar Catálogo
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>" 
                       class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-brand-blue transition-all duration-300">
                        Contactar Experto
                    </a>
                </div>
            </div>
        </section>

        <!-- Services Grid Section with Tailwind -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Nuestros Servicios Especializados</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">Soluciones completas para todas tus necesidades técnicas</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Primary Service Card -->
                    <div class="bg-gradient-to-br from-brand-blue to-brand-purple rounded-2xl p-8 text-white transform hover:-translate-y-2 transition-all duration-300">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="text-center">
                            <h3 class="text-2xl font-bold mb-2">Tablet Digitizer/LCD</h3>
                            <p class="text-white text-opacity-90 mb-4">Premium & Precision</p>
                            <div class="inline-block bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm font-semibold">
                                Especialistas
                            </div>
                        </div>
                    </div>
                    
                    <!-- Screens Service Card -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-10 h-10 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Screens</h3>
                            <p class="text-gray-600 mb-4">Quality is Our Priority</p>
                            <div class="flex flex-wrap gap-2 justify-center">
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-md text-sm">Samsung</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-md text-sm">Xiaomi</span>
                                <span class="px-2 py-1 bg-brand-blue text-white rounded-md text-sm">iPhone</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-md text-sm">Oppo & Vivo</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-md text-sm">Transision</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Repair Machines Service Card -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-10 h-10 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Repair Machines</h3>
                            <p class="text-gray-600 mb-4">One-stop Service</p>
                            <div class="inline-block bg-brand-blue text-white px-3 py-1 rounded-full text-sm font-semibold">
                                Profesional
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                    
                    <div class="service-card dark-card">
                        <div class="service-icon parts-icon">
                            <div class="spare-parts"></div>
                        </div>
                        <div class="service-content">
                            <h3>Spare Parts</h3>
                            <p>Over 19,000+ SKU</p>
                            <div class="service-badge">Amplio Stock</div>
                        </div>
                    </div>
                    
                    <div class="service-card">
                        <div class="service-icon battery-icon">
                            <div class="battery-cell"></div>
                        </div>
                        <div class="service-content">
                            <h3>Battery</h3>
                            <p>Full power, full energy</p>
                            <div class="service-badge">Alta Capacidad</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Brands Carousel Section - REAL CAROUSEL -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Marcas de Confianza</h2>
                    <p class="text-gray-600 text-lg">Trabajamos con las mejores marcas del mercado</p>
                </div>
                
                <!-- Carousel Container -->
                <div class="relative overflow-hidden">
                    <div class="brands-slider flex transition-transform duration-500 ease-in-out" id="brandsSlider">
                        <?php
                        // Marcas reales de tecnología
                        $tech_brands = array(
                            'SAMSUNG', 'APPLE', 'XIAOMI', 'HUAWEI', 'OPPO', 'VIVO', 
                            'REALME', 'NOKIA', 'MOTOROLA', 'LG', 'SONY', 'ONEPLUS',
                            'HONOR', 'POCO', 'REDMI', 'ASUS', 'LENOVO', 'TCL'
                        );
                        
                        // Duplicar para efecto infinito
                        $all_brands = array_merge($tech_brands, $tech_brands);
                        
                        foreach ($all_brands as $brand) {
                            echo '<div class="flex-none w-48 mx-4">';
                            echo '<div class="bg-white rounded-xl border border-gray-200 h-20 flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-300">';
                            echo '<span class="text-gray-700 font-semibold text-lg tracking-wide">' . esc_html($brand) . '</span>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                
                <!-- Carousel Controls -->
                <div class="flex justify-center mt-8 space-x-4">
                    <button onclick="moveBrands(-1)" class="bg-brand-blue text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        ← Anterior
                    </button>
                    <button onclick="moveBrands(1)" class="bg-brand-blue text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        Siguiente →
                    </button>
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
