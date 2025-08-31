<?php
/**
 * Header Template para ITOOLS Child Theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
// WordPress 5.2+ body open hook
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} 
?>

<!-- Top Bar -->
<div class="itools-top-bar">
    <div class="container">
        <div class="top-bar-content">
            <div class="contact-info">
                <span>📞 +52 (55) 1234-5678</span>
                <span>✉️ info@itoolsmx.com</span>
            </div>
            <div class="top-bar-links">
                <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
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
<header id="itools-header" class="itools-main-header">
    <div class="container">
        <div class="header-content">
            <!-- Logo Section -->
            <div class="logo-section">
                <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
                        <h1><?php bloginfo( 'name' ); ?></h1>
                        <?php if ( get_bloginfo( 'description' ) ) : ?>
                            <span class="tagline"><?php bloginfo( 'description' ); ?></span>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Search Section -->
            <div class="search-section">
                <form class="product-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="search-wrapper">
                        <!-- Category Filter -->
                        <select name="product_cat" class="category-filter">
                            <option value="">Elegir categoría</option>
                            <?php
                            $categories = itools_get_product_categories();
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
                            ?>
                        </select>
                        
                        <!-- Search Input -->
                        <input 
                            type="search" 
                            name="s" 
                            placeholder="Busca Productos aquí" 
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                        >
                        <input type="hidden" name="post_type" value="product">
                        
                        <!-- Search Button -->
                        <button type="submit" class="search-btn" aria-label="Buscar">
                            🔍
                        </button>
                    </div>
                </form>
            </div>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- User Account -->
                <div class="account-menu">
                    <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="account-link">
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/mi-cuenta' ) ); ?>" class="account-link">
                    <?php endif; ?>
                        👤
                        <span><?php echo is_user_logged_in() ? 'Mi Cuenta' : 'Iniciar Sesión'; ?></span>
                    </a>
                </div>

                <!-- Shopping Cart -->
                <div class="cart-menu">
                    <?php 
                    $cart_info = itools_get_cart_info();
                    ?>
                    <a href="<?php echo esc_url( $cart_info['url'] ); ?>" class="cart-link">
                        🛒
                        <span class="cart-count"><?php echo esc_html( $cart_info['count'] ); ?></span>
                        <span class="cart-total"><?php echo wp_kses_post( $cart_info['total'] ); ?></span>
                    </a>
                </div>
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="Toggle Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="main-navigation" role="navigation">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'depth'          => 2,
                ));
            } else {
                itools_fallback_menu();
            }
            ?>
        </nav>
    </div>
</header>
<header class="itools-main-header">
    <div class="container">
        <div class="header-content">
            <div class="logo-section">
                <a href="<?php echo home_url('/'); ?>" class="site-logo">
                    <h1><?php bloginfo('name'); ?></h1>
                </a>
            </div>
            
            <div class="search-section">
                <form method="get" action="<?php echo home_url('/'); ?>">
                    <div class="search-wrapper">
                        <select name="product_cat" class="category-filter">
                            <option value="">Elegir categoría</option>
                        </select>
                        <input type="search" name="s" placeholder="Buscar productos..." value="<?php echo get_search_query(); ?>">
                        <button type="submit" class="search-btn">🔍</button>
                    </div>
                </form>
            </div>
            
            <div class="header-actions">
                <a href="/mi-cuenta" class="account-link">👤 Mi Cuenta</a>
                <a href="/carrito" class="cart-link">� Carrito</a>
            </div>
        </div>
        
        <nav class="main-navigation">
            <ul class="nav-menu">
                <li><a href="<?php echo home_url('/'); ?>">Inicio</a></li>
                <li><a href="<?php echo home_url('/tienda'); ?>">Tienda</a></li>
                <li><a href="<?php echo home_url('/contacto'); ?>">Contacto</a></li>
            </ul>
        </nav>
    </div>
</header>

<style>
/* Header Styles */
.top-bar {
    background: #2c3e50;
    color: white;
    padding: 8px 0;
    font-size: 0.9rem;
}

.top-bar-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.contact-info span {
    margin-right: 20px;
}

.top-bar-links a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
    font-size: 0.85rem;
}

.top-bar-links a:hover {
    color: #16a085;
}

.main-header {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
    padding: 15px 0;
}

.header-content {
    display: grid;
    grid-template-columns: 200px 1fr 300px auto;
    gap: 20px;
    align-items: center;
}

.site-logo h1 {
    font-size: 1.8rem;
    color: #2c3e50;
    margin: 0;
}

.tagline {
    font-size: 0.8rem;
    color: #7f8c8d;
}

.search-wrapper {
    position: relative;
    display: flex;
    background: #f8f9fa;
    border-radius: 25px;
    overflow: hidden;
}

.search-wrapper input[type="search"] {
    flex: 1;
    border: none;
    padding: 12px 20px;
    background: transparent;
    outline: none;
}

.search-btn {
    background: #16a085;
    border: none;
    color: white;
    padding: 12px 20px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.search-btn:hover {
    background: #138d75;
}

.header-actions {
    display: flex;
    gap: 20px;
    align-items: center;
}

.account-link,
.wishlist-link,
.cart-link {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #2c3e50;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.account-link:hover,
.wishlist-link:hover,
.cart-link:hover {
    color: #16a085;
}

.cart-count,
.wishlist-count {
    background: #e74c3c;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: bold;
}

.mobile-menu-toggle {
    display: none;
    flex-direction: column;
    background: none;
    border: none;
    cursor: pointer;
    gap: 3px;
}

.mobile-menu-toggle span {
    width: 25px;
    height: 3px;
    background: #2c3e50;
    transition: 0.3s;
}

.main-navigation {
    margin-top: 15px;
    border-top: 1px solid #ecf0f1;
    padding-top: 15px;
}

.nav-menu {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 30px;
}

.nav-menu a {
    color: #2c3e50;
    text-decoration: none;
    font-weight: 500;
    padding: 10px 0;
    transition: color 0.3s ease;
}

.nav-menu a:hover {
    color: #16a085;
}

/* Responsive */
@media (max-width: 1024px) {
    .header-content {
        grid-template-columns: 150px 1fr 250px auto;
        gap: 15px;
    }
}

@media (max-width: 768px) {
    .top-bar {
        display: none;
    }
    
    .header-content {
        grid-template-columns: 1fr auto;
        gap: 15px;
    }
    
    .search-section,
    .header-actions {
        display: none;
    }
    
    .mobile-menu-toggle {
        display: flex;
    }
    
    .main-navigation {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .main-navigation.active {
        display: block;
    }
    
    .nav-menu {
        flex-direction: column;
        padding: 20px;
    }
}
</style>

<?php
// Fallback menu function
function itools_fallback_menu() {
    echo '<ul class="nav-menu">
        <li><a href="' . home_url('/') . '">Inicio</a></li>
        <li><a href="' . home_url('/tienda') . '">Tienda</a></li>
        <li><a href="' . home_url('/categorias') . '">Categorías</a></li>
        <li><a href="' . home_url('/ofertas') . '">Ofertas</a></li>
        <li><a href="' . home_url('/contacto') . '">Contacto</a></li>
    </ul>';
}
?>
