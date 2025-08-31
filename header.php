<?php
/**
 * Header moderno para ITOOLS Child Theme
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

<!-- ITOOLS Custom Header -->
<div class="itools-custom-header">

<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-content">
            <div class="contact-info">
                <span>📞 +52 (55) 1234-5678</span>
                <span>✉️ info@itoolsmx.com</span>
            </div>
            <div class="top-bar-links">
                <?php if ( function_exists( 'wc_get_page_permalink' ) && function_exists( 'wc_get_account_menu_items' ) ) : ?>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">Mi Cuenta</a>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/mi-cuenta' ) ); ?>">Mi Cuenta</a>
                <?php endif; ?>
                <a href="<?php echo esc_url( home_url( '/seguimiento' ) ); ?>">Seguimiento</a>
                <a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>">Ayuda</a>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="main-header">
    <div class="container">
        <div class="header-row">
            <!-- Logo Section -->
            <div class="logo-section">
                <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
                    <div class="custom-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
                        <div class="logo-icon">🛠️</div>
                        <div class="logo-text">
                            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                            <?php 
                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description ) : ?>
                                <span class="site-tagline"><?php echo esc_html( $description ); ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Search Section -->
            <div class="search-section">
                <form class="header-search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="search-wrapper">
                        <!-- Category Filter Dropdown -->
                        <div class="category-dropdown">
                            <select name="product_cat" class="category-select">
                                <option value="">Todas las Categorías</option>
                                <?php
                                // Obtener categorías de productos de forma segura
                                if ( function_exists( 'get_terms' ) && taxonomy_exists( 'product_cat' ) ) {
                                    $categories = get_terms( array(
                                        'taxonomy'   => 'product_cat',
                                        'hide_empty' => false,
                                        'parent'     => 0,
                                    ));
                                    
                                    if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
                                        foreach ( $categories as $category ) {
                                            $selected = ( isset( $_GET['product_cat'] ) && $_GET['product_cat'] === $category->slug ) ? 'selected' : '';
                                            printf(
                                                '<option value="%s" %s>%s (%d)</option>',
                                                esc_attr( $category->slug ),
                                                $selected,
                                                esc_html( $category->name ),
                                                $category->count
                                            );
                                        }
                                    }
                                } else {
                                    // Fallback categories si WooCommerce no está disponible
                                    echo '<option value="herramientas">Herramientas Manuales</option>';
                                    echo '<option value="maquinaria">Maquinaria Industrial</option>';
                                    echo '<option value="accesorios">Accesorios</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <!-- Search Input -->
                        <div class="search-input-wrapper">
                            <input 
                                type="search" 
                                name="s" 
                                class="search-input"
                                placeholder="Buscar productos, herramientas, marcas..." 
                                value="<?php echo esc_attr( get_search_query() ); ?>"
                                autocomplete="off"
                            >
                            <input type="hidden" name="post_type" value="product">
                        </div>
                        
                        <!-- Search Button -->
                        <button type="submit" class="search-button" aria-label="Buscar productos">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- User Account -->
                <div class="header-action-item">
                    <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="action-link">
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/mi-cuenta' ) ); ?>" class="action-link">
                    <?php endif; ?>
                        <div class="action-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="action-text"><?php echo is_user_logged_in() ? 'Mi Cuenta' : 'Ingresar'; ?></span>
                    </a>
                </div>

                <!-- Shopping Cart -->
                <div class="header-action-item cart-item">
                    <?php 
                    $cart_url = '#';
                    $cart_count = 0;
                    $cart_total = '$0.00';
                    
                    if ( function_exists( 'WC' ) && WC()->cart ) {
                        $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/carrito' );
                        $cart_count = WC()->cart->get_cart_contents_count();
                        $cart_total = WC()->cart->get_cart_total();
                    } else {
                        $cart_url = home_url( '/carrito' );
                    }
                    ?>
                    <a href="<?php echo esc_url( $cart_url ); ?>" class="action-link cart-link">
                        <div class="action-icon cart-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?php if ( $cart_count > 0 ) : ?>
                                <span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="cart-info">
                            <span class="cart-label">Carrito</span>
                            <span class="cart-total"><?php echo wp_kses_post( $cart_total ); ?></span>
                        </div>
                    </a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-label="Abrir menú móvil" aria-expanded="false">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="main-navigation" role="navigation">
            <div class="nav-wrapper">
                <?php
                // Menú principal con dropdowns de categorías
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'main-menu',
                        'container'      => false,
                        'depth'          => 3,
                        'walker'         => class_exists( 'WP_Bootstrap_Navwalker' ) ? new WP_Bootstrap_Navwalker() : null,
                    ));
                } else {
                    // Menú fallback con categorías dinámicas
                    echo '<ul class="main-menu">';
                    
                    // Inicio
                    echo '<li class="menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">Inicio</a></li>';
                    
                    // Categorías dropdown
                    echo '<li class="menu-item menu-item-has-children">';
                    echo '<a href="' . esc_url( home_url( '/tienda' ) ) . '">Categorías <span class="dropdown-arrow">▼</span></a>';
                    echo '<ul class="sub-menu">';
                    
                    if ( function_exists( 'get_terms' ) && taxonomy_exists( 'product_cat' ) ) {
                        $categories = get_terms( array(
                            'taxonomy'   => 'product_cat',
                            'hide_empty' => false,
                            'parent'     => 0,
                            'number'     => 8,
                        ));
                        
                        if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
                            foreach ( $categories as $category ) {
                                $category_link = get_term_link( $category );
                                if ( ! is_wp_error( $category_link ) ) {
                                    printf(
                                        '<li><a href="%s">%s <span class="item-count">(%d)</span></a></li>',
                                        esc_url( $category_link ),
                                        esc_html( $category->name ),
                                        $category->count
                                    );
                                }
                            }
                        }
                    } else {
                        // Fallback categories
                        echo '<li><a href="' . esc_url( home_url( '/categoria/herramientas' ) ) . '">Herramientas Manuales</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/categoria/maquinaria' ) ) . '">Maquinaria Industrial</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/categoria/accesorios' ) ) . '">Accesorios</a></li>';
                    }
                    
                    echo '</ul></li>';
                    
                    // Otras páginas
                    echo '<li class="menu-item"><a href="' . esc_url( home_url( '/tienda' ) ) . '">Tienda</a></li>';
                    echo '<li class="menu-item"><a href="' . esc_url( home_url( '/ofertas' ) ) . '">Ofertas</a></li>';
                    echo '<li class="menu-item"><a href="' . esc_url( home_url( '/sobre-nosotros' ) ) . '">Nosotros</a></li>';
                    echo '<li class="menu-item"><a href="' . esc_url( home_url( '/contacto' ) ) . '">Contacto</a></li>';
                    
                    echo '</ul>';
                }
                ?>
            </div>
        </nav>
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
