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
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#64748b'
                    }
                }
            }
        }
    </script>
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

                <!-- Búsqueda con filtro de categorías -->
                <div style="flex: 1; max-width: 500px; margin: 0 32px;">
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="position: relative; display: flex; background: white; border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden;">
                        
                        <!-- Selector de categorías -->
                        <select name="product_cat" style="border: none; background: #f9fafb; padding: 8px 12px; font-size: 14px; color: #374151; min-width: 120px; outline: none;">
                            <option value="">Todas</option>
                            <?php
                            $product_categories = get_terms( array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                                'parent' => 0
                            ) );
                            
                            $selected_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : '';
                            
                            if ( !empty($product_categories) && !is_wp_error($product_categories) ) {
                                foreach ( $product_categories as $category ) {
                                    $selected = ($selected_cat === $category->slug) ? 'selected' : '';
                                    echo '<option value="' . esc_attr($category->slug) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                        
                        <!-- Separador visual -->
                        <div style="width: 1px; background: #d1d5db;"></div>
                        
                        <!-- Campo de búsqueda -->
                        <input 
                            type="search" 
                            name="s" 
                            style="flex: 1; padding: 8px 16px; border: none; font-size: 14px; outline: none;"
                            placeholder="Buscar herramientas, marcas, modelos..." 
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                        >
                        
                        <!-- Input hidden para especificar que es búsqueda de productos -->
                        <input type="hidden" name="post_type" value="product">
                        
                        <!-- Botón de búsqueda -->
                        <button type="submit" style="background: #2563eb; color: white; border: none; padding: 8px 16px; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: background-color 0.2s;" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
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
