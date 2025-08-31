<?php
/**
 * Header para Child Theme ITOOLS - Versión Simple
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

<div id="page" class="site">
    <!-- Header Simple con Tailwind -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold text-gray-800">
                        ITOOLS MX
                    </a>
                </div>

                <!-- Búsqueda -->
                <div class="flex-1 max-w-md mx-8">
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative">
                        <input 
                            type="search" 
                            name="s" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Buscar herramientas..." 
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                        >
                        <input type="hidden" name="post_type" value="product">
                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 text-white px-4 py-1 rounded text-sm hover:bg-blue-700">
                            Buscar
                        </button>
                    </form>
                </div>

                <!-- Enlaces de cuenta -->
                <div class="flex items-center space-x-4">
                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" class="text-gray-600 hover:text-gray-800">
                            Mi Cuenta
                        </a>
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Carrito (<?php echo WC()->cart->get_cart_contents_count(); ?>)
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div id="content" class="site-content"><?php
