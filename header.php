<?php
/**
 * Minimal, safe header to avoid critical errors.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <style>
        .itools-simple-header{background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.08);position:sticky;top:0;z-index:1000}
        .itools-simple-header .container{display:flex;align-items:center;justify-content:space-between;padding:10px 15px}
        .itools-simple-header .site-title{margin:0;font-size:1.25rem}
        .itools-simple-header nav ul{list-style:none;margin:0;padding:0;display:flex;gap:16px}
        .itools-simple-header a{text-decoration:none;color:#2c3e50}
    </style>
    </head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<header class="itools-simple-header">
    <div class="container">
        <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
        <nav>
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => '',
                    'container'      => false,
                    'items_wrap'     => '<ul class="menu">%3$s</ul>',
                    'depth'          => 1,
                ) );
            } else {
                echo '<ul class="menu">';
                echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Inicio</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/tienda' ) ) . '">Tienda</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/contacto' ) ) . '">Contacto</a></li>';
                echo '</ul>';
            }
            ?>
        </nav>
    </div>
    </header>

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
