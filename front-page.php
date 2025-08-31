<?php
/**
 * Página de inicio personalizada
 */
get_header();
?>
<main id="main-content">
    <!-- Hero Slider -->
    <section class="hero-slider">
        <div class="slider-container">
            <div class="slide active">
                <div class="slide-content">
                    <h1>Herramientas Profesionales</h1>
                    <p>Encuentra las mejores herramientas para tus proyectos</p>
                    <a href="<?php echo home_url('/tienda'); ?>" class="btn btn-primary">Ver Productos</a>
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <h1>Maquinaria Industrial</h1>
                    <p>Soluciones completas para la industria</p>
                    <a href="<?php echo home_url('/tienda'); ?>" class="btn btn-primary">Explorar</a>
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <h1>Ofertas Especiales</h1>
                    <p>Aprovecha nuestras promociones limitadas</p>
                    <a href="<?php echo home_url('/ofertas'); ?>" class="btn btn-secondary">Ver Ofertas</a>
                </div>
            </div>
        </div>
        <div class="slider-controls">
            <button class="prev-slide">&larr;</button>
            <button class="next-slide">&rarr;</button>
        </div>
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
                    <div class="filter-section">
                        <h3 class="filter-title">
                            Categoría
                            <span class="toggle-icon">▼</span>
                        </h3>
                        <div class="filter-content">
                            <?php
                            if ( function_exists('get_terms') ) {
                                $product_categories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => 0
                                ));
                                if (!is_wp_error($product_categories) && !empty($product_categories)) {
                                    foreach ($product_categories as $category) {
                                        echo '<label class="filter-item">';
                                        echo '<input type="checkbox" name="category[]" value="' . esc_attr($category->slug) . '">';
                                        echo '<span class="checkmark"></span>';
                                        echo esc_html($category->name);
                                        echo '</label>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

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
                            if ( function_exists('get_terms') ) {
                                $featured_categories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'number' => 6,
                                    'parent' => 0
                                ));
                                if (!is_wp_error($featured_categories) && !empty($featured_categories)) {
                                    foreach ($featured_categories as $category) {
                                        echo '<div class="category-card">';
                                        echo '<h3>' . esc_html($category->name) . '</h3>';
                                        echo '<p>' . $category->count . ' productos</p>';
                                        echo '<a href="' . esc_url(get_term_link($category)) . '" class="btn btn-outline">Ver Productos</a>';
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </section>

                    <!-- Featured Products -->
                    <section class="featured-products">
                        <h2>Productos Destacados</h2>
                        <div class="products-grid">
                            <?php 
                            if ( function_exists('do_shortcode') ) {
                                echo do_shortcode('[featured_products limit="8" columns="4"]'); 
                            }
                            ?>
                        </div>
                    </section>

                    <!-- Latest Products -->
                    <section class="latest-products">
                        <h2>Últimos Productos</h2>
                        <div class="products-grid">
                            <?php 
                            if ( function_exists('do_shortcode') ) {
                                echo do_shortcode('[recent_products limit="8" columns="4"]'); 
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
