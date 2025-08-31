<?php
/**
 * Header moderno para ITOOLS Child Theme - Versión 2.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<!-- ITOOLS Modern Header -->
<div class="itools-modern-header">
    <!-- Top Info Bar - Minimal -->
    <div class="top-info-bar">
        <div class="container">
            <div class="top-info-content">
                <div class="contact-info">
                    <span class="contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        +52 (55) 1234-5678
                    </span>
                    <span class="contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2"/>
                            <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        info@itoolsmx.com
                    </span>
                </div>
                <div class="top-links">
                    <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">Mi Cuenta</a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>">Ayuda</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header - Sticky -->
    <header class="main-header-modern" id="main-header">
        <div class="container">
            <div class="header-content">
                <!-- Logo Compacto -->
                <div class="logo-compact">
                    <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link">
                            <?php the_custom_logo(); ?>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo">
                            <div class="brand-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="brand-text">
                                <span class="brand-name"><?php bloginfo( 'name' ); ?></span>
                                <span class="brand-tagline">Herramientas Profesionales</span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Navigation Menu -->
                <nav class="main-navigation" id="main-nav">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'nav-menu',
                        'container'      => false,
                        'fallback_cb'    => function() {
                            echo '<ul class="nav-menu">';
                            echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Inicio</a></li>';
                            echo '<li><a href="' . esc_url( home_url( '/tienda' ) ) . '">Tienda</a></li>';
                            echo '<li><a href="' . esc_url( home_url( '/categorias' ) ) . '">Categorías</a></li>';
                            echo '<li><a href="' . esc_url( home_url( '/ofertas' ) ) . '">Ofertas</a></li>';
                            echo '<li><a href="' . esc_url( home_url( '/contacto' ) ) . '">Contacto</a></li>';
                            echo '</ul>';
                        }
                    )); 
                    ?>
                </nav>

                <!-- Search Bar Moderna -->
                <div class="modern-search">
                    <form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="search-input-group">
                            <input 
                                type="search" 
                                name="s" 
                                class="search-field"
                                placeholder="Buscar productos..." 
                                value="<?php echo esc_attr( get_search_query() ); ?>"
                            >
                            <input type="hidden" name="post_type" value="product">
                            <button type="submit" class="search-submit">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                                    <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Header Actions Compactas -->
                <div class="header-actions-modern">
                    <!-- Account -->
                    <div class="action-item">
                        <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="action-btn" title="Mi Cuenta">
                        <?php else : ?>
                            <a href="<?php echo esc_url( home_url( '/mi-cuenta' ) ); ?>" class="action-btn" title="Mi Cuenta">
                        <?php endif; ?>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"/>
                                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Cart -->
                    <div class="action-item cart-action">
                        <?php 
                        $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/carrito' );
                        $cart_count = function_exists( 'WC' ) && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
                        ?>
                        <a href="<?php echo esc_url( $cart_url ); ?>" class="action-btn cart-btn" title="Carrito de Compras">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <?php if ( $cart_count > 0 ) : ?>
                                <span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <div class="mobile-toggle">
                        <button class="mobile-menu-btn" id="mobile-toggle" aria-label="Menú móvil">
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay" id="mobile-menu">
            <div class="mobile-menu-content">
                <div class="mobile-menu-header">
                    <div class="mobile-logo">
                        <span class="brand-name"><?php bloginfo( 'name' ); ?></span>
                    </div>
                    <button class="mobile-close-btn" id="mobile-close">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </button>
                </div>
                
                <div class="mobile-search">
                    <form class="mobile-search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input 
                            type="search" 
                            name="s" 
                            placeholder="Buscar productos..."
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                        >
                        <input type="hidden" name="post_type" value="product">
                    </form>
                </div>

                <nav class="mobile-navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'mobile-nav-menu',
                        'container'      => false,
                        'fallback_cb'    => function() {
                            echo '<ul class="mobile-nav-menu">';
                            echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Inicio</a></li>';
                            echo '<li><a href="' . esc_url( home_url( '/tienda' ) ) . '">Tienda</a></li>';
                            echo '<li><a href="' . esc_url( home_url( '/categorias' ) ) . '">Categorías</a></li>';
                            echo '<li><a href="' . esc_url( home_url( '/ofertas' ) ) . '">Ofertas</a></li>';
                            echo '<li><a href="' . esc_url( home_url( '/contacto' ) ) . '">Contacto</a></li>';
                            echo '</ul>';
                        }
                    )); 
                    ?>
                </nav>

                <div class="mobile-actions">
                    <a href="<?php echo esc_url( $cart_url ); ?>" class="mobile-action-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span>Carrito (<?php echo $cart_count; ?>)</span>
                    </a>
                    <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="mobile-action-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"/>
                                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span><?php echo is_user_logged_in() ? 'Mi Cuenta' : 'Iniciar Sesión'; ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
</div>

<!-- JavaScript para funcionalidad móvil -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileClose = document.getElementById('mobile-close');
    const header = document.getElementById('main-header');
    
    // Mobile menu toggle
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function() {
            mobileMenu.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (mobileClose && mobileMenu) {
        mobileClose.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // Close mobile menu when clicking overlay
    if (mobileMenu) {
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
    
    // Sticky header effect
    if (header) {
        let lastScrollTop = 0;
        
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            // Hide/show on scroll
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                header.classList.add('header-hidden');
            } else {
                header.classList.remove('header-hidden');
            }
            
            lastScrollTop = scrollTop;
        });
    }
});
</script>
    </div>
</header>

<script>
// Header JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-navigation');
    
    if (mobileToggle && mainNav) {
        mobileToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            mainNav.classList.toggle('mobile-open');
            
            // Update aria-expanded
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
        });
    }
    
    // Dropdown menus
    const menuItems = document.querySelectorAll('.menu-item-has-children');
    
    menuItems.forEach(function(item) {
        const link = item.querySelector('a');
        
        if (link) {
            link.addEventListener('click', function(e) {
                // En móvil, prevenir navegación y mostrar submenu
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    item.classList.toggle('dropdown-open');
                }
            });
        }
        
        // Hover para desktop
        item.addEventListener('mouseenter', function() {
            if (window.innerWidth > 768) {
                this.classList.add('dropdown-open');
            }
        });
        
        item.addEventListener('mouseleave', function() {
            if (window.innerWidth > 768) {
                this.classList.remove('dropdown-open');
            }
        });
    });
    
    // Search suggestions (opcional - se puede expandir)
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.classList.add('search-focused');
        });
        
        searchInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('search-focused');
        });
    }
    
    // Cerrar menú móvil al redimensionar ventana
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            mainNav?.classList.remove('mobile-open');
            mobileToggle?.classList.remove('active');
            mobileToggle?.setAttribute('aria-expanded', 'false');
        }
    });
});
</script>

</div>
<!-- End ITOOLS Custom Header -->
