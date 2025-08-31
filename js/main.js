jQuery(document).ready(function($) {
    // Slider functionality
    let currentSlide = 0;
    const slides = $('.slide');
    const dots = $('.dot');
    const totalSlides = slides.length;

    if (slides.length > 0) {
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
    }

    // Filter toggles
    $('.filter-title').on('click', function() {
        const content = $(this).next('.filter-content');
        const icon = $(this).find('.toggle-icon');
        
        content.toggleClass('active');
        if (content.hasClass('active')) {
            if (icon.length) icon.text('▲');
            content.css('max-height', content[0].scrollHeight + 'px');
        } else {
            if (icon.length) icon.text('▼');
            content.css('max-height', '0');
        }
    });

    // Initialize filters as open
    $('.filter-content').addClass('active');
    $('.toggle-icon').text('▲');
    $('.filter-content').each(function() {
        $(this).css('max-height', this.scrollHeight + 'px');
    });

    // Price range sliders
    const priceMinSlider = $('#price-min');
    const priceMaxSlider = $('#price-max');
    const priceMinInput = $('#price-min-input');
    const priceMaxInput = $('#price-max-input');

    function updatePriceInputs() {
        if (priceMinSlider.length) priceMinInput.val(priceMinSlider.val());
        if (priceMaxSlider.length) priceMaxInput.val(priceMaxSlider.val());
    }

    function updatePriceSliders() {
        if (priceMinInput.length) priceMinSlider.val(priceMinInput.val());
        if (priceMaxInput.length) priceMaxSlider.val(priceMaxInput.val());
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
        
        const minPrice = priceMinSlider.val() || 0;
        const maxPrice = priceMaxSlider.val() || 10000;
        
        if (typeof ajax_object !== 'undefined') {
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
        if (priceMinSlider.length) priceMinSlider.val(0);
        if (priceMaxSlider.length) priceMaxSlider.val(10000);
        updatePriceInputs();
        filterProducts();
    });

    // Real-time filtering on checkbox change (with debounce)
    let filterTimeout;
    $('input[type="checkbox"]').on('change', function() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(filterProducts, 500);
    });

    // Mobile menu toggle
    $('.mobile-menu-toggle').on('click', function() {
        $(this).toggleClass('active');
        $('.main-navigation').toggleClass('active');
    });

    // Smooth scrolling for internal links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $($(this).attr('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 500);
        }
    });

    // Category cards hover effect
    $('.category-card').hover(
        function() {
            $(this).find('.btn-outline').addClass('btn-primary').removeClass('btn-outline');
        },
        function() {
            $(this).find('.btn-primary').removeClass('btn-primary').addClass('btn-outline');
        }
    );

    // Search with category filter
    $('.product-search').on('submit', function(e) {
        const searchTerm = $(this).find('input[name="s"]').val().trim();
        const category = $(this).find('select[name="product_cat"]').val();
        
        if (!searchTerm && !category) {
            e.preventDefault();
            alert('Por favor ingresa un término de búsqueda o selecciona una categoría.');
        }
    });

    // Category filter change in search
    $('.category-filter').on('change', function() {
        const form = $(this).closest('form');
        const searchInput = form.find('input[name="s"]');
        
        if ($(this).val() && !searchInput.val()) {
            // If category is selected but no search term, submit the form
            form.submit();
        }
    });

    // Sticky header adjustment
    $(window).on('scroll', function() {
        const scrollTop = $(window).scrollTop();
        const header = $('.itools-main-header');
        
        if (scrollTop > 100) {
            header.addClass('scrolled');
        } else {
            header.removeClass('scrolled');
        }
    });

    // Loading animation for AJAX
    function showLoading() {
        if (!$('.loading-overlay').length) {
            $('body').append('<div class="loading-overlay"><div class="loading-spinner">Cargando...</div></div>');
        }
    }

    function hideLoading() {
        $('.loading-overlay').remove();
    }

    // Cart update animation
    $(document).on('added_to_cart', function() {
        $('.cart-count').addClass('updated');
        setTimeout(function() {
            $('.cart-count').removeClass('updated');
        }, 600);
    });

    // Add loading states to buttons
    $('.btn').on('click', function() {
        const btn = $(this);
        if (!btn.hasClass('loading')) {
            btn.addClass('loading');
            setTimeout(function() {
                btn.removeClass('loading');
            }, 2000);
        }
    });

    // Initialize tooltips (if any)
    $('[data-tooltip]').hover(
        function() {
            const tooltip = $('<div class="tooltip">' + $(this).data('tooltip') + '</div>');
            $('body').append(tooltip);
            
            const element = $(this);
            const offset = element.offset();
            
            tooltip.css({
                position: 'absolute',
                top: offset.top - tooltip.outerHeight() - 5,
                left: offset.left + (element.outerWidth() / 2) - (tooltip.outerWidth() / 2),
                zIndex: 9999
            });
        },
        function() {
            $('.tooltip').remove();
        }
    );

    // Lazy loading for images (simple implementation)
    function lazyLoadImages() {
        $('img[data-src]').each(function() {
            const img = $(this);
            const rect = this.getBoundingClientRect();
            
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                img.attr('src', img.data('src')).removeAttr('data-src');
            }
        });
    }

    $(window).on('scroll resize', lazyLoadImages);
    lazyLoadImages(); // Initial load

    // Accessibility improvements
    $('.filter-title').attr('role', 'button').attr('tabindex', '0');
    $('.filter-title').on('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).click();
        }
    });

    // Console log for debugging
    console.log('ITOOLS Theme JavaScript loaded successfully');
});
