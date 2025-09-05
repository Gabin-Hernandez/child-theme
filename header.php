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
    
    <!-- Estilos y JavaScript para dropdown menu -->
    <style>
        /* Estilos para dropdown menus */
        .dropdown-trigger:hover,
        .dropdown-container:hover .dropdown-trigger {
            background-color: #f3f4f6;
            color: #2563eb;
        }
        
        .dropdown-container:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-menu a:hover {
            background-color: #f9fafb;
            color: #2563eb;
        }
        
        /* Asegurar que los dropdowns estén por encima de otros elementos */
        .dropdown-container {
            z-index: 1000;
        }
        
        /* Animación suave para los iconos */
        .dropdown-trigger svg {
            transition: transform 0.2s ease;
        }
        
        .dropdown-container:hover .dropdown-trigger svg {
            transform: rotate(180deg);
        }
        
        /* Sticky Navigation - CSS puro para garantizar funcionalidad */
        .nav-row {
            position: sticky !important;
            top: 0 !important;
            z-index: 1000 !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.3s ease !important;
        }
        
        /* Asegurar que funcione en todos los navegadores */
        .nav-row {
            -webkit-position: sticky;
            -moz-position: sticky;
            -ms-position: sticky;
            -o-position: sticky;
        }
        
        /* Evitar saltos al hacer sticky */
        .nav-row.is-sticky {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
        }
        
        /* Responsivo */
        @media (max-width: 768px) {
            .nav-row {
                display: none !important;
            }
            
            #mobile-menu-btn {
                display: block !important;
            }
            
            .dropdown-container {
                display: none;
            }
            
            /* Ajustar el buscador en móvil */
            .header-search {
                max-width: none !important;
                margin: 0 10px !important;
            }
        }
        
        @media (max-width: 640px) {
            /* Ocultar texto "Mi Cuenta" en pantallas muy pequeñas */
            .account-link {
                font-size: 0 !important;
            }
            
            .account-link::after {
                content: "👤";
                font-size: 16px;
            }
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mejorar la funcionalidad de los dropdowns
            const dropdowns = document.querySelectorAll('.dropdown-container');
            
            dropdowns.forEach(dropdown => {
                const trigger = dropdown.querySelector('.dropdown-trigger');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                // Agregar eventos táctiles para móviles
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Cerrar otros dropdowns
                    dropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            const otherMenu = otherDropdown.querySelector('.dropdown-menu');
                            otherMenu.style.opacity = '0';
                            otherMenu.style.visibility = 'hidden';
                            otherMenu.style.transform = 'translateY(-10px)';
                        }
                    });
                    
                    // Toggle este dropdown
                    const isOpen = menu.style.opacity === '1';
                    if (isOpen) {
                        menu.style.opacity = '0';
                        menu.style.visibility = 'hidden';
                        menu.style.transform = 'translateY(-10px)';
                    } else {
                        menu.style.opacity = '1';
                        menu.style.visibility = 'visible';
                        menu.style.transform = 'translateY(0)';
                    }
                });
            });
            
            // Cerrar dropdowns al hacer clic fuera
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown-container')) {
                    dropdowns.forEach(dropdown => {
                        const menu = dropdown.querySelector('.dropdown-menu');
                        menu.style.opacity = '0';
                        menu.style.visibility = 'hidden';
                        menu.style.transform = 'translateY(-10px)';
                    });
                }
            });
            
            // Funcionalidad del menú móvil
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
                        mobileMenu.style.display = 'block';
                        // Cambiar icono a X
                        mobileMenuBtn.innerHTML = `
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                            </svg>
                        `;
                    } else {
                        mobileMenu.style.display = 'none';
                        // Cambiar icono a hamburguesa
                        mobileMenuBtn.innerHTML = `
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        `;
                    }
                });
                
                // Cerrar menú móvil al cambiar tamaño de ventana
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 768) {
                        mobileMenu.style.display = 'none';
                        mobileMenuBtn.innerHTML = `
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        `;
                    }
                });
            }
        });
    </script>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<div id="page" class="site">
    <!-- Header Simple -->
    <header style="background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-bottom: 1px solid #e5e7eb;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <!-- Primera fila: Logo, Buscador, Mi Cuenta y Carrito -->
            <div style="display: flex; align-items: center; justify-content: space-between; height: 72px; padding: 0 4px;">
                <!-- Logo -->
                <div style="flex-shrink: 0;">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="font-size: 1.5rem; font-weight: bold; color: #1f2937; text-decoration: none;">
                        ITOOLS MX
                    </a>
                </div>

                <!-- Búsqueda con filtro de categorías (centrado) -->
                <div class="header-search" style="flex: 1; max-width: 500px; margin: 0 40px;"> 
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="position: relative; display: flex; background: white; border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden;">
                        
                        <!-- Selector de categorías -->
                        <select name="product_cat" style="border: none; background: #f9fafb; padding: 8px 12px; font-size: 14px; color: #374151; min-width: 120px; outline: none;">
                            <option value="">Todas</option>
                            <?php
                            if ( function_exists('get_terms') && taxonomy_exists('product_cat') ) {
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
                            } else {
                                // Fallback manual para categorías principales
                                echo '<option value="refacciones">Refacciones</option>';
                                echo '<option value="herramientas">Herramientas</option>';
                                echo '<option value="baterias">Baterías</option>';
                                echo '<option value="pantallas">Pantallas</option>';
                                echo '<option value="accesorios">Accesorios</option>';
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
                        <?php if ( post_type_exists('product') ) : ?>
                            <input type="hidden" name="post_type" value="product">
                        <?php endif; ?>
                        
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
                <div style="display: flex; align-items: center; gap: 16px; flex-shrink: 0;">
                    <!-- Botón menú móvil -->
                    <button id="mobile-menu-btn" style="display: none; background: none; border: none; color: #374151; cursor: pointer; padding: 8px;">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </button>
                    
                    <?php if ( function_exists('wc_get_account_endpoint_url') && class_exists( 'WooCommerce' ) ) : ?>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" class="account-link" style="color: #6b7280; text-decoration: none; white-space: nowrap;">
                            Mi Cuenta
                        </a>
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" style="background: #2563eb; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; white-space: nowrap;">
                            Carrito<?php if ( function_exists('WC') && WC()->cart ) { echo ' (' . WC()->cart->get_cart_contents_count() . ')'; } ?>
                        </a>
                    <?php else : ?>
                        <a href="/mi-cuenta/" class="account-link" style="color: #6b7280; text-decoration: none; white-space: nowrap;">
                            Mi Cuenta
                        </a>
                        <a href="/carrito/" style="background: #2563eb; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; white-space: nowrap;">
                            Carrito
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Segunda fila: Menú de navegación dropdown -->
            <div class="nav-row" style="border-top: 1px solid #f3f4f6; padding: 12px 0;">
                <nav style="display: flex; align-items: center; justify-content: center; gap: 40px;">
                    <!-- Dropdown Refacciones -->
                    <div class="dropdown-container" style="position: relative;">
                        <button class="dropdown-trigger" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; background: none; border: none; color: #374151; font-weight: 500; cursor: pointer; border-radius: 6px; transition: all 0.2s;">
                            Refacciones
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu" style="position: absolute; top: 100%; left: 0; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); min-width: 200px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.2s; z-index: 1000;">
                            <a href="<?php echo get_term_link('pantallas', 'product_cat'); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Pantallas LCD & Touch</a>
                            <a href="<?php echo get_term_link('baterias', 'product_cat'); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Baterías</a>
                            <a href="<?php echo get_term_link('cargadores', 'product_cat'); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Cargadores</a>
                            <a href="<?php echo get_term_link('refacciones', 'product_cat'); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; transition: background 0.2s;">Ver todas las refacciones</a>
                        </div>
                    </div>

                    <!-- Dropdown Herramientas -->
                    <div class="dropdown-container" style="position: relative;">
                        <button class="dropdown-trigger" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; background: none; border: none; color: #374151; font-weight: 500; cursor: pointer; border-radius: 6px; transition: all 0.2s;">
                            Herramientas
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu" style="position: absolute; top: 100%; left: 0; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); min-width: 200px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.2s; z-index: 1000;">
                            <a href="https://itoolsmx.com/categoria/herramientas/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Microscopios</a>
                            <a href="https://itoolsmx.com/categoria/herramientas/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Estaciones de Soldadura</a>
                            <a href="https://itoolsmx.com/categoria/herramientas/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Cautines</a>
                            <a href="https://itoolsmx.com/categoria/herramientas/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Destornilladores</a>
                            <a href="https://itoolsmx.com/categoria/herramientas/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; transition: background 0.2s;">Ver todas las herramientas</a>
                        </div>
                    </div>

                    <!-- Dropdown Marcas -->
                    <div class="dropdown-container" style="position: relative;">
                        <button class="dropdown-trigger" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; background: none; border: none; color: #374151; font-weight: 500; cursor: pointer; border-radius: 6px; transition: all 0.2s;">
                            Marcas
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu" style="position: absolute; top: 100%; left: 0; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); min-width: 200px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.2s; z-index: 1000;">
                            <a href="<?php echo get_term_link('apple', 'product_cat'); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">🍎 Apple</a>
                            <a href="<?php echo get_term_link('samsung', 'product_cat'); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">📱 Samsung</a>
                            <a href="<?php echo get_term_link('huawei', 'product_cat'); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">📲 Huawei</a>
                            <a href="<?php echo get_term_link('xiaomi', 'product_cat'); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">🎯 Xiaomi</a>
                            <a href="<?php echo get_term_link('motorola', 'product_cat'); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">📞 Motorola</a>
                            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; transition: background 0.2s;">Ver todas las marcas</a>
                        </div>
                    </div>

                    <!-- Link directo Accesorios -->
                    <a href="<?php echo get_term_link('accesorios', 'product_cat'); ?>" style="padding: 8px 12px; color: #374151; font-weight: 500; text-decoration: none; border-radius: 6px; transition: all 0.2s;">
                        Accesorios
                    </a>

                    <!-- Link directo Ofertas -->
                    <a href="https://itoolsmx.com/ofertas/" style="padding: 8px 12px; color: #dc2626; font-weight: 600; text-decoration: none; border-radius: 6px; transition: all 0.2s;">
                        🏷️ Ofertas
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Menú móvil -->
    <div id="mobile-menu" style="display: none; background: white; border-bottom: 1px solid #e5e7eb; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
            <!-- Búsqueda móvil -->
            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin-bottom: 20px;">
                <div style="display: flex; background: #f9fafb; border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden;">
                    <input 
                        type="search" 
                        name="s" 
                        style="flex: 1; padding: 12px 16px; border: none; background: transparent; font-size: 16px; outline: none;"
                        placeholder="Buscar productos..." 
                        value="<?php echo esc_attr( get_search_query() ); ?>"
                    >
                    <input type="hidden" name="post_type" value="<?php echo post_type_exists('product') ? 'product' : 'post'; ?>">
                    <button type="submit" style="background: #2563eb; color: white; border: none; padding: 12px 16px; cursor: pointer;">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
            
            <!-- Links del menú móvil -->
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div>
                    <h3 style="font-weight: 600; color: #374151; margin-bottom: 8px; font-size: 16px;">Refacciones</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-left: 16px;">
                        <a href="<?php echo get_term_link('pantallas', 'product_cat'); ?>" style="color: #6b7280; text-decoration: none; font-size: 14px;">Pantallas LCD & Touch</a>
                        <a href="<?php echo get_term_link('baterias', 'product_cat'); ?>" style="color: #6b7280; text-decoration: none; font-size: 14px;">Baterías</a>
                        <a href="<?php echo get_term_link('cargadores', 'product_cat'); ?>" style="color: #6b7280; text-decoration: none; font-size: 14px;">Cargadores</a>
                        <a href="<?php echo get_term_link('refacciones', 'product_cat'); ?>" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500;">Ver todas →</a>
                    </div>
                </div>
                
                <div>
                    <h3 style="font-weight: 600; color: #374151; margin-bottom: 8px; font-size: 16px;">Herramientas</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-left: 16px;">
                        <a href="<?php echo get_term_link('herramientas', 'product_cat'); ?>" style="color: #6b7280; text-decoration: none; font-size: 14px;">Microscopios</a>
                        <a href="<?php echo get_term_link('herramientas', 'product_cat'); ?>" style="color: #6b7280; text-decoration: none; font-size: 14px;">Estaciones de Soldadura</a>
                        <a href="<?php echo get_term_link('herramientas', 'product_cat'); ?>" style="color: #6b7280; text-decoration: none; font-size: 14px;">Cautines</a>
                        <a href="<?php echo get_term_link('herramientas', 'product_cat'); ?>" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500;">Ver todas →</a>
                    </div>
                </div>
                
                <div>
                    <h3 style="font-weight: 600; color: #374151; margin-bottom: 8px; font-size: 16px;">Marcas</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-left: 16px;">
                        <a href="<?php echo get_term_link('apple', 'product_cat'); ?>" style="color: #6b7280; text-decoration: none; font-size: 14px;">🍎 Apple</a>
                        <a href="<?php echo get_term_link('samsung', 'product_cat'); ?>" style="color: #6b7280; text-decoration: none; font-size: 14px;">📱 Samsung</a>
                        <a href="<?php echo get_term_link('huawei', 'product_cat'); ?>" style="color: #6b7280; text-decoration: none; font-size: 14px;">📲 Huawei</a>
                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500;">Ver todas →</a>
                    </div>
                </div>
                
                <div style="border-top: 1px solid #e5e7eb; padding-top: 16px;">
                    <a href="<?php echo get_term_link('accesorios', 'product_cat'); ?>" style="display: block; padding: 12px 0; color: #374151; font-weight: 500; text-decoration: none; border-bottom: 1px solid #f3f4f6;">Accesorios</a>
                    <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" style="display: block; padding: 12px 0; color: #dc2626; font-weight: 600; text-decoration: none;">🏷️ Ofertas</a>
                </div>
            </div>
        </div>
    </div>

    <div id="content" class="site-content"><?php
