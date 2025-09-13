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

                <!-- Búsqueda simplificada (centrado) -->
                <div class="header-search" style="flex: 1; max-width: 500px; margin: 20px 40px 0 40px;"> 
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="position: relative; display: flex; background: white; border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden;">
                        <!-- Campo de búsqueda -->
                        <input 
                            type="search" 
                            name="s" 
                            style="flex: 1; padding: 12px 16px; border: none; font-size: 14px; outline: none;"
                            placeholder="Buscar productos: iPhone, Samsung, herramientas..." 
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                        >
                        
                        <!-- Input hidden para especificar que es búsqueda de productos -->
                        <?php if ( post_type_exists('product') ) : ?>
                            <input type="hidden" name="post_type" value="product">
                        <?php endif; ?>
                        
                        <!-- Botón de búsqueda -->
                        <button type="submit" style="background: #2563eb; color: white; border: none; padding: 12px 16px; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: background-color 0.2s;" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
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
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/lcd-y-touch/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Pantallas LCD & Touch</a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/baterias/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Baterías</a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/tapa-de-bateria/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Carcasas</a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/refacciones/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; transition: background 0.2s;">Ver todas las refacciones</a>
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
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/microscopios/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Microscopios</a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/estaciones-soldadura/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Estaciones de Soldadura</a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/cautines/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Cautines</a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/destornilladores/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Destornilladores</a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/herramientas/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; transition: background 0.2s;">Ver todas las herramientas</a>
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
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/apple/" style="display: flex; align-items: center; gap: 8px; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                                </svg>
                                Apple
                            </a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/samsung/" style="display: flex; align-items: center; gap: 8px; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M22.86 5.82v12.36c0 3.21-2.61 5.82-5.82 5.82H6.96c-3.21 0-5.82-2.61-5.82-5.82V5.82C1.14 2.61 3.75 0 6.96 0h10.08c3.21 0 5.82 2.61 5.82 5.82zM12 21.15c5.05 0 9.15-4.1 9.15-9.15S17.05 2.85 12 2.85 2.85 6.95 2.85 12s4.1 9.15 9.15 9.15zm0-16.8c4.22 0 7.65 3.43 7.65 7.65S16.22 19.65 12 19.65 4.35 16.22 4.35 12 7.78 4.35 12 4.35z"/>
                                </svg>
                                Samsung
                            </a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/huawei/" style="display: flex; align-items: center; gap: 8px; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                Huawei
                            </a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/xiaomi/" style="display: flex; align-items: center; gap: 8px; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19.15 5c.28 0 .85.11.85.4v13.2c0 .29-.57.4-.85.4h-2.4c-.28 0-.75-.11-.75-.4V5.4c0-.29.47-.4.75-.4h2.4zm-4.8 6c.28 0 .65.11.65.4v7.2c0 .29-.37.4-.65.4h-2.8c-.28 0-.65-.11-.65-.4v-7.2c0-.29.37-.4.65-.4h2.8zm-5 3c.28 0 .65.11.65.4v4.2c0 .29-.37.4-.65.4H6.5c-.28 0-.65-.11-.65-.4v-4.2c0-.29.37-.4.65-.4h2.85zm-5-11c.28 0 .65.11.65.4v10.8c0 .29-.37.4-.65.4H1.65c-.28 0-.65-.11-.65-.4V3.4c0-.29.37-.4.65-.4h2.7z"/>
                                </svg>
                                Xiaomi
                            </a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/categoria/motorola/" style="display: flex; align-items: center; gap: 8px; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5.5-2.5l7.51-3.49L17.5 6.5 9.99 9.99 6.5 17.5zm5.5-6.6c.61 0 1.1.49 1.1 1.1s-.49 1.1-1.1 1.1-1.1-.49-1.1-1.1.49-1.1 1.1-1.1z"/>
                                </svg>
                                Motorola
                            </a>
                            <a href="https://lightblue-gull-856657.hostingersite.com/tienda/" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; transition: background 0.2s;">Ver todas las marcas</a>
                        </div>
                    </div>

                    <!-- Dropdown Modelos -->
                    <div class="dropdown-container" style="position: relative;">
                        <button class="dropdown-trigger" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; background: none; border: none; color: #374151; font-weight: 500; cursor: pointer; border-radius: 6px; transition: all 0.2s;">
                            Modelos
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu" style="position: absolute; top: 100%; left: 0; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); min-width: 250px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.2s; z-index: 1000; max-height: 400px; overflow-y: auto;">
                            <!-- iPhone -->
                            <div style="padding: 8px 16px; background: #f9fafb; border-bottom: 1px solid #e5e7eb; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">iPhone</div>
                            <a href="<?php echo esc_url( home_url( '/?s=iphone+15+pro+max&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">iPhone 15 Pro Max</a>
                            <a href="<?php echo esc_url( home_url( '/?s=iphone+15+pro&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">iPhone 15 Pro</a>
                            <a href="<?php echo esc_url( home_url( '/?s=iphone+15+plus&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">iPhone 15 Plus</a>
                            <a href="<?php echo esc_url( home_url( '/?s=iphone+15&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">iPhone 15</a>
                            <a href="<?php echo esc_url( home_url( '/?s=iphone+14+pro+max&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">iPhone 14 Pro Max</a>
                            <a href="<?php echo esc_url( home_url( '/?s=iphone+14+pro&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">iPhone 14 Pro</a>
                            <a href="<?php echo esc_url( home_url( '/?s=iphone+13+pro+max&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">iPhone 13 Pro Max</a>
                            <a href="<?php echo esc_url( home_url( '/?s=iphone+12+pro+max&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">iPhone 12 Pro Max</a>
                            
                            <!-- Samsung -->
                            <div style="padding: 8px 16px; background: #f9fafb; border-bottom: 1px solid #e5e7eb; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; margin-top: 8px;">Samsung</div>
                            <a href="<?php echo esc_url( home_url( '/?s=galaxy+s24+ultra&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">Galaxy S24 Ultra</a>
                            <a href="<?php echo esc_url( home_url( '/?s=galaxy+s23+ultra&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">Galaxy S23 Ultra</a>
                            <a href="<?php echo esc_url( home_url( '/?s=galaxy+s22+ultra&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">Galaxy S22 Ultra</a>
                            <a href="<?php echo esc_url( home_url( '/?s=galaxy+a54&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">Galaxy A54</a>
                            <a href="<?php echo esc_url( home_url( '/?s=galaxy+a34&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">Galaxy A34</a>
                            
                            <!-- Huawei -->
                            <div style="padding: 8px 16px; background: #f9fafb; border-bottom: 1px solid #e5e7eb; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; margin-top: 8px;">Huawei</div>
                            <a href="<?php echo esc_url( home_url( '/?s=huawei+p60+pro&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">P60 Pro</a>
                            <a href="<?php echo esc_url( home_url( '/?s=huawei+mate+50+pro&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">Mate 50 Pro</a>
                            <a href="<?php echo esc_url( home_url( '/?s=huawei+p50+pro&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">P50 Pro</a>
                            
                            <!-- Xiaomi -->
                            <div style="padding: 8px 16px; background: #f9fafb; border-bottom: 1px solid #e5e7eb; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; margin-top: 8px;">Xiaomi</div>
                            <a href="<?php echo esc_url( home_url( '/?s=xiaomi+14+ultra&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">Xiaomi 14 Ultra</a>
                            <a href="<?php echo esc_url( home_url( '/?s=xiaomi+13+pro&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">Xiaomi 13 Pro</a>
                            <a href="<?php echo esc_url( home_url( '/?s=redmi+note+13+pro&post_type=product' ) ); ?>" style="display: block; padding: 10px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s; font-size: 14px;">Redmi Note 13 Pro</a>
                            
                            <a href="<?php echo esc_url( home_url( '/tienda/' ) ); ?>" style="display: block; padding: 12px 16px; color: #2563eb; text-decoration: none; transition: background 0.2s; font-weight: 500; border-top: 1px solid #e5e7eb; margin-top: 8px;">Ver todos los modelos</a>
                        </div>
                    </div>

                    <!-- Link directo Accesorios -->
                    <a href="https://lightblue-gull-856657.hostingersite.com/categoria/accesorios/" style="padding: 8px 12px; color: #374151; font-weight: 500; text-decoration: none; border-radius: 6px; transition: all 0.2s;">
                        Accesorios
                    </a>

                    <!-- Link directo Ofertas -->
                    <a href="https://lightblue-gull-856657.hostingersite.com/ofertas/" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; color: #dc2626; font-weight: 600; text-decoration: none; border-radius: 6px; transition: all 0.2s;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.79 21L3 11.21v2c0 .45.54 1 1.21 1h7.36l2.15 2.15c.31.31.85.31 1.16 0L12.79 21zM11.38 17.41c.39.39.39 1.02 0 1.41-.39.39-1.02.39-1.41 0L8.21 17.06 3 11.85V9c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v2.85l-5.21 5.21-1.76-1.76c-.39-.39-1.02-.39-1.41 0s-.39 1.02 0 1.41l1.76 1.76z"/>
                        </svg>
                        Ofertas
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
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/lcd-y-touch/" style="color: #6b7280; text-decoration: none; font-size: 14px;">Pantallas LCD & Touch</a>
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/baterias/" style="color: #6b7280; text-decoration: none; font-size: 14px;">Baterías</a>
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/tapa-de-bateria/" style="color: #6b7280; text-decoration: none; font-size: 14px;">Carcasas</a>
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/refacciones/" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500;">Ver todas →</a>
                    </div>
                </div>
                
                <div>
                    <h3 style="font-weight: 600; color: #374151; margin-bottom: 8px; font-size: 16px;">Herramientas</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-left: 16px;">
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/microscopios/" style="color: #6b7280; text-decoration: none; font-size: 14px;">Microscopios</a>
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/estaciones-soldadura/" style="color: #6b7280; text-decoration: none; font-size: 14px;">Estaciones de Soldadura</a>
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/cautines/" style="color: #6b7280; text-decoration: none; font-size: 14px;">Cautines</a>
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/herramientas/" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500;">Ver todas →</a>
                    </div>
                </div>
                
                <div>
                    <h3 style="font-weight: 600; color: #374151; margin-bottom: 8px; font-size: 16px;">Marcas</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-left: 16px;">
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/apple/" style="display: flex; align-items: center; gap: 8px; color: #6b7280; text-decoration: none; font-size: 14px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                            </svg>
                            Apple
                        </a>
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/samsung/" style="display: flex; align-items: center; gap: 8px; color: #6b7280; text-decoration: none; font-size: 14px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.86 5.82v12.36c0 3.21-2.61 5.82-5.82 5.82H6.96c-3.21 0-5.82-2.61-5.82-5.82V5.82C1.14 2.61 3.75 0 6.96 0h10.08c3.21 0 5.82 2.61 5.82 5.82zM12 21.15c5.05 0 9.15-4.1 9.15-9.15S17.05 2.85 12 2.85 2.85 6.95 2.85 12s4.1 9.15 9.15 9.15zm0-16.8c4.22 0 7.65 3.43 7.65 7.65S16.22 19.65 12 19.65 4.35 16.22 4.35 12 7.78 4.35 12 4.35z"/>
                            </svg>
                            Samsung
                        </a>
                        <a href="https://lightblue-gull-856657.hostingersite.com/categoria/huawei/" style="display: flex; align-items: center; gap: 8px; color: #6b7280; text-decoration: none; font-size: 14px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            Huawei
                        </a>
                        <a href="https://lightblue-gull-856657.hostingersite.com/tienda/" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500;">Ver todas →</a>
                    </div>
                </div>
                
                <div>
                    <h3 style="font-weight: 600; color: #374151; margin-bottom: 8px; font-size: 16px;">Modelos</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-left: 16px; max-height: 200px; overflow-y: auto;">
                        <!-- iPhone populares -->
                        <div style="font-size: 12px; color: #9ca3af; font-weight: 500; margin-top: 4px;">iPhone</div>
                        <a href="<?php echo esc_url( home_url( '/?s=iphone+15+pro+max&post_type=product' ) ); ?>" style="color: #6b7280; text-decoration: none; font-size: 13px; padding-left: 8px;">iPhone 15 Pro Max</a>
                        <a href="<?php echo esc_url( home_url( '/?s=iphone+14+pro+max&post_type=product' ) ); ?>" style="color: #6b7280; text-decoration: none; font-size: 13px; padding-left: 8px;">iPhone 14 Pro Max</a>
                        <a href="<?php echo esc_url( home_url( '/?s=iphone+13+pro+max&post_type=product' ) ); ?>" style="color: #6b7280; text-decoration: none; font-size: 13px; padding-left: 8px;">iPhone 13 Pro Max</a>
                        
                        <!-- Samsung populares -->
                        <div style="font-size: 12px; color: #9ca3af; font-weight: 500; margin-top: 8px;">Samsung</div>
                        <a href="<?php echo esc_url( home_url( '/?s=galaxy+s24+ultra&post_type=product' ) ); ?>" style="color: #6b7280; text-decoration: none; font-size: 13px; padding-left: 8px;">Galaxy S24 Ultra</a>
                        <a href="<?php echo esc_url( home_url( '/?s=galaxy+s23+ultra&post_type=product' ) ); ?>" style="color: #6b7280; text-decoration: none; font-size: 13px; padding-left: 8px;">Galaxy S23 Ultra</a>
                        <a href="<?php echo esc_url( home_url( '/?s=galaxy+a54&post_type=product' ) ); ?>" style="color: #6b7280; text-decoration: none; font-size: 13px; padding-left: 8px;">Galaxy A54</a>
                        
                        <a href="<?php echo esc_url( home_url( '/tienda/' ) ); ?>" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500; margin-top: 8px;">Ver todos →</a>
                    </div>
                </div>
                
                <div style="border-top: 1px solid #e5e7eb; padding-top: 16px;">
                    <a href="https://lightblue-gull-856657.hostingersite.com/categoria/accesorios/" style="display: block; padding: 12px 0; color: #374151; font-weight: 500; text-decoration: none; border-bottom: 1px solid #f3f4f6;">Accesorios</a>
                    <a href="https://lightblue-gull-856657.hostingersite.com/ofertas/" style="display: flex; align-items: center; gap: 8px; padding: 12px 0; color: #dc2626; font-weight: 600; text-decoration: none;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.79 21L3 11.21v2c0 .45.54 1 1.21 1h7.36l2.15 2.15c.31.31.85.31 1.16 0L12.79 21zM11.38 17.41c.39.39.39 1.02 0 1.41-.39.39-1.02.39-1.41 0L8.21 17.06 3 11.85V9c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v2.85l-5.21 5.21-1.76-1.76c-.39-.39-1.02-.39-1.41 0s-.39 1.02 0 1.41l1.76 1.76z"/>
                        </svg>
                        Ofertas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="content" class="site-content"><?php
