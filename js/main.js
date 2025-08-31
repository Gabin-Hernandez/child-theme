jQuery(document).ready(function($) {
    // Slider functionality
    let currentSlide = 0;
    const slides = $('.slide');
    const dots = $('.dot');
    const totalSlides = slides.length;

    function showSlide(n) {
        slides.removeClass('active');
        dots.removeClass('active');
        currentSlide = (n + totalSlides) % totalSlides;
        slides.eq(currentSlide).addClass('active');
        dots.eq(currentSlide).addClass('active');
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    // Slider controls
    $('.next-slide').on('click', nextSlide);
    $('.prev-slide').on('click', prevSlide);

    // Dots navigation
    $('.dot').on('click', function() {
        const slideIndex = $(this).data('slide');
        showSlide(slideIndex);
    });

    // Auto-slide every 5 seconds
    setInterval(nextSlide, 5000);

    // Filter toggles
    $('.filter-title').on('click', function() {
        const content = $(this).next('.filter-content');
        const icon = $(this).find('.toggle-icon');
        
        content.toggleClass('active');
        if (content.hasClass('active')) {
            icon.text('▲');
            content.css('max-height', content[0].scrollHeight + 'px');
        } else {
            icon.text('▼');
            content.css('max-height', '0');
        }
    });

    // Price range sliders
    const priceMinSlider = $('#price-min');
    const priceMaxSlider = $('#price-max');
    const priceMinInput = $('#price-min-input');
    const priceMaxInput = $('#price-max-input');

    function updatePriceInputs() {
        priceMinInput.val(priceMinSlider.val());
        priceMaxInput.val(priceMaxSlider.val());
    }

    function updatePriceSliders() {
        priceMinSlider.val(priceMinInput.val());
        priceMaxSlider.val(priceMaxInput.val());
    }

    priceMinSlider.on('input', updatePriceInputs);
    priceMaxSlider.on('input', updatePriceInputs);
    priceMinInput.on('input', updatePriceSliders);
    priceMaxInput.on('input', updatePriceSliders);

    // Initialize price inputs
    updatePriceInputs();

    // Filter products via AJAX
    function filterProducts() {
        const categories = [];
        const brands = [];
        
        $('input[name="category[]"]:checked').each(function() {
            categories.push($(this).val());
        });
        
        $('input[name="brand[]"]:checked').each(function() {
            brands.push($(this).val());
        });
        
        const minPrice = priceMinSlider.val();
        const maxPrice = priceMaxSlider.val();
        
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_products',
                categories: categories,
                brands: brands,
                min_price: minPrice,
                max_price: maxPrice,
                nonce: ajax_object.nonce
            },
            beforeSend: function() {
                $('.products-grid').html('<div class="loading">Cargando productos...</div>');
            },
            success: function(response) {
                $('.products-grid').html(response);
            },
            error: function() {
                $('.products-grid').html('<p>Error al cargar productos.</p>');
            }
        });
    }

    // Apply filters button
    $('.btn-apply').on('click', function(e) {
        e.preventDefault();
        filterProducts();
    });

    // Clear filters button
    $('.btn-clear').on('click', function(e) {
        e.preventDefault();
        $('input[type="checkbox"]').prop('checked', false);
        priceMinSlider.val(0);
        priceMaxSlider.val(10000);
        updatePriceInputs();
        filterProducts();
    });

    // Real-time filtering on checkbox change
    $('input[type="checkbox"]').on('change', function() {
        filterProducts();
    });

    // Smooth scrolling for internal links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $($(this).attr('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });

    // Category cards hover effect
    $('.category-card').hover(
        function() {
            $(this).find('.btn').addClass('btn-primary').removeClass('btn-outline');
        },
        function() {
            $(this).find('.btn').removeClass('btn-primary').addClass('btn-outline');
        }
    );

    // Mobile menu toggle (if needed)
    $('.mobile-menu-toggle').on('click', function() {
        $('nav').toggleClass('active');
    });

    // Sticky sidebar on scroll
    $(window).on('scroll', function() {
        const scrollTop = $(window).scrollTop();
        const sidebarTop = $('.sidebar-filters').offset().top - 20;
        
        if (scrollTop > sidebarTop && $(window).width() > 768) {
            $('.sidebar-filters').addClass('sticky');
        } else {
            $('.sidebar-filters').removeClass('sticky');
        }
    });

    // Product quick view (placeholder for future implementation)
    $('.product-quick-view').on('click', function(e) {
        e.preventDefault();
        // Implementar vista rápida del producto
        console.log('Vista rápida del producto');
    });

    // Add to cart animation
    $(document).on('added_to_cart', function() {
        // Agregar animación cuando se añade al carrito
        $('.cart-icon').addClass('bounce');
        setTimeout(function() {
            $('.cart-icon').removeClass('bounce');
        }, 600);
    });
});
