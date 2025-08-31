<?php
/**
 * Página de inicio personalizada con slider y filtros
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
                    <a href="/tienda" class="btn btn-primary">Ver Productos</a>
                </div>
                <div class="slide-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/slide1.jpg" alt="Herramientas">
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <h1>Maquinaria Industrial</h1>
                    <p>Soluciones completas para la industria</p>
                    <a href="/tienda" class="btn btn-primary">Explorar</a>
                </div>
                <div class="slide-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/slide2.jpg" alt="Maquinaria">
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <h1>Ofertas Especiales</h1>
                    <p>Aprovecha nuestras promociones limitadas</p>
                    <a href="/ofertas" class="btn btn-secondary">Ver Ofertas</a>
                </div>
                <div class="slide-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/slide3.jpg" alt="Ofertas">
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
                            <i class="icon-category"></i>
                            Categoría
                            <span class="toggle-icon">▼</span>
                        </h3>
                        <div class="filter-content">
                            <?php
                            $product_categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                                'parent' => 0
                            ));
                            if (!empty($product_categories)) {
                                foreach ($product_categories as $category) {
                                    echo '<label class="filter-item">';
                                    echo '<input type="checkbox" name="category[]" value="' . $category->slug . '">';
                                    echo '<span class="checkmark"></span>';
                                    echo $category->name;
                                    echo '</label>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3 class="filter-title">
                            <i class="icon-price"></i>
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

                    <div class="filter-section">
                        <h3 class="filter-title">
                            <i class="icon-brand"></i>
                            Marcas
                            <span class="toggle-icon">▼</span>
                        </h3>
                        <div class="filter-content">
                            <?php
                            $brands = get_terms(array(
                                'taxonomy' => 'pa_marca',
                                'hide_empty' => true,
                            ));
                            if (!empty($brands)) {
                                foreach ($brands as $brand) {
                                    echo '<label class="filter-item">';
                                    echo '<input type="checkbox" name="brand[]" value="' . $brand->slug . '">';
                                    echo '<span class="checkmark"></span>';
                                    echo $brand->name;
                                    echo '</label>';
                                }
                            }
                            ?>
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
                            $featured_categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                                'number' => 6,
                                'parent' => 0
                            ));
                            foreach ($featured_categories as $category) {
                                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                $image_url = wp_get_attachment_url($thumbnail_id);
                                echo '<div class="category-card">';
                                if ($image_url) {
                                    echo '<img src="' . $image_url . '" alt="' . $category->name . '">';
                                }
                                echo '<h3>' . $category->name . '</h3>';
                                echo '<p>' . $category->count . ' productos</p>';
                                echo '<a href="' . get_term_link($category) . '" class="btn btn-outline">Ver Productos</a>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </section>

                    <!-- Featured Products -->
                    <section class="featured-products">
                        <h2>Productos Destacados</h2>
                        <div class="products-grid">
                            <?php echo do_shortcode('[featured_products limit="8" columns="4"]'); ?>
                        </div>
                    </section>

                    <!-- Latest Products -->
                    <section class="latest-products">
                        <h2>Últimos Productos</h2>
                        <div class="products-grid">
                            <?php echo do_shortcode('[recent_products limit="8" columns="4"]'); ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
// Slider functionality
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.prev-slide');
    const nextBtn = document.querySelector('.next-slide');
    let currentSlide = 0;

    function showSlide(n) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => showSlide(index));
    });

    // Auto-slide
    setInterval(nextSlide, 5000);

    // Filter toggles
    document.querySelectorAll('.filter-title').forEach(title => {
        title.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.toggle-icon');
            content.classList.toggle('active');
            icon.textContent = content.classList.contains('active') ? '▲' : '▼';
        });
    });
});
</script>

<?php get_footer(); ?>
