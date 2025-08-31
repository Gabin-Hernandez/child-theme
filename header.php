<?php
/**
 * Header Simple - ITOOLS Child Theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<div id="page" class="site">
    <!-- Header Simple -->
    <header style="background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-bottom: 1px solid #e5e7eb;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; height: 64px;">
                <!-- Logo -->
                <div>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="font-size: 1.5rem; font-weight: bold; color: #1f2937; text-decoration: none;">
                        ITOOLS MX
                    </a>
                </div>

                <!-- Búsqueda -->
                <div style="flex: 1; max-width: 400px; margin: 0 32px;">
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="position: relative;">
                        <input 
                            type="search" 
                            name="s" 
                            style="width: 100%; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                            placeholder="Buscar herramientas..." 
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                        >
                        <input type="hidden" name="post_type" value="product">
                        <button type="submit" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: #2563eb; color: white; border: none; padding: 4px 12px; border-radius: 4px; font-size: 12px; cursor: pointer;">
                            Buscar
                        </button>
                    </form>
                </div>

                <!-- Enlaces de cuenta -->
                <div style="display: flex; align-items: center; gap: 16px;">
                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" style="color: #6b7280; text-decoration: none;">
                            Mi Cuenta
                        </a>
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" style="background: #2563eb; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none;">
                            Carrito (<?php echo WC()->cart->get_cart_contents_count(); ?>)
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div id="content" class="site-content"><?php
