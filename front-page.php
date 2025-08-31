<?php
/**
 * Página de inicio personalizada para ITOOLS
 */
get_header();
?>

<main id="main-content">
    <!-- Hero Section -->
    <section class="hero-slider">
        <div class="slider-container">
            <div class="slide active">
                <div class="slide-content">
                    <h1>Herramientas Profesionales</h1>
                    <p>Encuentra las mejores herramientas para tus proyectos</p>
                    <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="btn btn-primary">Ver Productos</a>
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <h1>Maquinaria Industrial</h1>
                    <p>Soluciones completas para la industria</p>
                    <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>" class="btn btn-primary">Explorar</a>
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <h1>Ofertas Especiales</h1>
                    <p>Aprovecha nuestras promociones limitadas</p>
                    <a href="<?php echo esc_url( home_url( '/ofertas' ) ); ?>" class="btn btn-secondary">Ver Ofertas</a>
                </div>
            </div>
        </div>
        
        <!-- Slider Controls -->
        <div class="slider-controls">
            <button class="prev-slide" aria-label="Slide anterior">&larr;</button>
            <button class="next-slide" aria-label="Slide siguiente">&rarr;</button>
        </div>
        
        <!-- Slider Dots -->
        <div class="slider-dots">
            <span class="dot active" data-slide="0"></span>
            <span class="dot" data-slide="1"></span>
            <span class="dot" data-slide="2"></span>
        </div>
    </section>

    <!-- Main Content with Sidebar -->
    <section class="main-section">
        <div class="container">
            <div class="content-wrapper">
                <!-- Sidebar Filters -->
                <aside class="sidebar-filters">
                    <!-- Categories Filter -->
                    <div class="filter-section">
                        <h3 class="filter-title">
                            Categoría
                            <span class="toggle-icon">▼</span>
                        </h3>
                        <div class="filter-content">
                            <?php
                            $categories = itools_get_product_categories();
                            foreach ( $categories as $category ) {
                                printf(
                                    '<label class="filter-item">
                                        <input type="checkbox" name="category[]" value="%s">
                                        <span class="checkmark"></span>
                                        %s
                                    </label>',
                                    esc_attr( $category->slug ),
                                    esc_html( $category->name )
                                );
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="filter-section">
                        <h3 class="filter-title">
                            Rango de Precio
                            <span class="toggle-icon">▼</span>
                        </h3>
                        <div class="filter-content">
                            <div class="price-range">
                                <input type="range" id="price-min" min="0" max="10000" value="0" class="price-slider">
                                <input type="range" id="price-max" min="0" max="10000" value="10000" class="price-slider">
                                <div class="price-inputs">
                                    <input type="number" id="price-min-input" placeholder="Mín" min="0">
                                    <span>-</span>
                                    <input type="number" id="price-max-input" placeholder="Máx" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Actions -->
                    <div class="filter-actions">
                        <button class="btn btn-apply">Aplicar Filtros</button>
                        <button class="btn btn-clear">Limpiar</button>
                    </div>
                </aside>

                <!-- Main Content -->
                <div class="main-content">
                    <!-- Featured Categories -->
                    <section class="featured-categories">
                        <h2>Categorías Principales</h2>
                        <div class="categories-grid">
                            <?php
                            $featured_categories = itools_get_product_categories();
                            $count = 0;
                            foreach ( $featured_categories as $category ) {
                                if ( $count >= 6 ) break; // Limitar a 6 categorías
                                
                                $category_link = function_exists( 'get_term_link' ) ? get_term_link( $category ) : '#';
                                if ( is_wp_error( $category_link ) ) {
                                    $category_link = '#';
                                }
                                
                                printf(
                                    '<div class="category-card">
                                        <h3>%s</h3>
                                        <p>%d productos</p>
                                        <a href="%s" class="btn btn-outline">Ver Productos</a>
                                    </div>',
                                    esc_html( $category->name ),
                                    $category->count,
                                    esc_url( $category_link )
                                );
                                $count++;
                            }
                            ?>
                        </div>
                    </section>

                    <!-- Featured Products -->
                    <section class="featured-products">
                        <h2>Productos Destacados</h2>
                        <div class="products-grid">
                            <?php 
                            if ( function_exists( 'do_shortcode' ) && shortcode_exists( 'featured_products' ) ) {
                                echo do_shortcode( '[featured_products limit="8" columns="4"]' ); 
                            } else {
                                echo '<p>Los productos destacados se mostrarán cuando WooCommerce esté completamente configurado.</p>';
                            }
                            ?>
                        </div>
                    </section>

                    <!-- Latest Products -->
                    <section class="latest-products">
                        <h2>Últimos Productos</h2>
                        <div class="products-grid">
                            <?php 
                            if ( function_exists( 'do_shortcode' ) && shortcode_exists( 'recent_products' ) ) {
                                echo do_shortcode( '[recent_products limit="8" columns="4"]' ); 
                            } else {
                                echo '<p>Los productos recientes se mostrarán cuando WooCommerce esté completamente configurado.</p>';
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
