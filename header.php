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
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
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
            background-color: rgba(255,255,255,0.15);
            color: white;
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
        
        /* Estilos para submenus anidados */
        .has-submenu:hover .submenu-panel,
        .submenu-panel:hover {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateX(0) !important;
        }
        
        .submenu-trigger-item:hover {
            background-color: #f3f4f6;
        }
        
        .submenu-panel {
            pointer-events: all !important;
        }
        
        .has-submenu {
            position: relative;
        }
        
        /* Asegurar que el submenu se mantenga visible */
        .has-submenu:hover .submenu-trigger-item {
            background-color: #f3f4f6;
        }
        
        /* Scrollbar personalizado para submenu */
        .submenu-panel::-webkit-scrollbar {
            width: 8px;
        }
        
        .submenu-panel::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 4px;
        }
        
        .submenu-panel::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        .submenu-panel::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Script para manejar submenus anidados */
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hasSubmenu = document.querySelector('.has-submenu');
            if (hasSubmenu) {
                const submenuPanel = hasSubmenu.querySelector('.submenu-panel');
                
                hasSubmenu.addEventListener('mouseenter', function() {
                    if (submenuPanel) {
                        submenuPanel.style.opacity = '1';
                        submenuPanel.style.visibility = 'visible';
                        submenuPanel.style.transform = 'translateX(0)';
                    }
                });
                
                hasSubmenu.addEventListener('mouseleave', function() {
                    if (submenuPanel) {
                        submenuPanel.style.opacity = '0';
                        submenuPanel.style.visibility = 'hidden';
                        submenuPanel.style.transform = 'translateX(-10px)';
                    }
                });
            }
        });
        </script>
        
        /* Asegurar que los dropdowns estén por encima de otros elementos */
        .dropdown-container {
            position: relative !important;
            z-index: 10010 !important;
        }
        
        .dropdown-menu {
            position: absolute !important;
            z-index: 10011 !important;
        }
        
        /* Incrementar z-index cuando el dropdown está activo/hover */
        .dropdown-container:hover,
        .dropdown-container.active {
            z-index: 10020 !important;
        }
        
        .dropdown-container:hover .dropdown-menu,
        .dropdown-container.active .dropdown-menu {
            z-index: 10021 !important;
        }
        
        /* Animación suave para los iconos */
        .dropdown-trigger svg {
            transition: transform 0.2s ease;
        }
        
        .dropdown-container:hover .dropdown-trigger svg {
            transform: rotate(180deg);
        }
        
        /* Header sticky - se mantiene fijo al hacer scroll */
        header {
            background: #171717;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            position: sticky !important;
            top: 0;
            z-index: 10000 !important;
            transition: all 0.3s ease;
        }
        
        /* Asegurar que el header mantenga z-index incluso con position: static inline */
        #main-header {
            position: relative !important;
            z-index: 10000 !important;
        }
        
        /* Cuando el header se vuelve sticky después de scroll */
        header.sticky,
        #main-header.sticky {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 10000 !important;
        }
        
        /* Efecto adicional cuando se hace scroll */
        header.scrolled {
            background: rgba(23, 23, 23, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }
        
        /* Estilos responsivos para navegación */
        @media (max-width: 1024px) {
            /* Reducir gap del menú en tablets */
            nav {
                gap: 20px !important;
            }
        }
        
        @media (max-width: 768px) {
            /* Ocultar Valoraciones y Accesorios en móviles */
            .nav-item-valoraciones,
            .nav-item-accesorios {
                display: none !important;
            }
            
            /* Reducir aún más el gap en móviles */
            nav {
                gap: 12px !important;
            }
            
            /* Reducir padding de los botones */
            .dropdown-trigger,
            nav a {
                padding: 6px 8px !important;
                font-size: 14px !important;
            }
        }
        
        @media (max-width: 640px) {
            /* Para pantallas muy pequeñas */
            nav {
                gap: 8px !important;
            }
            
            .dropdown-trigger,
            nav a {
                padding: 4px 6px !important;
                font-size: 13px !important;
            }
        }
        
        /* Estilos específicos para mega-menu */
        @media (min-width: 1200px) {
            .mega-menu-grid {
                grid-template-columns: repeat(4, 1fr) !important;
            }
        }
        
        @media (max-width: 1199px) and (min-width: 992px) {
            .mega-menu-grid {
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 20px !important;
            }
        }
        
        @media (max-width: 991px) and (min-width: 769px) {
            .mega-menu-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 16px !important;
            }
        }
        
        /* Responsivo Mejorado */
        @media (max-width: 768px) {
            .nav-row {
                display: none !important;
            }
            
            #mobile-menu-btn {
                display: flex !important;
                align-items: center;
                justify-content: center;
                width: 44px;
                height: 44px;
                border-radius: 8px;
                background: rgba(255,255,255,0.1);
                transition: all 0.3s ease;
            }
            
            #mobile-menu-btn:hover {
                background: rgba(255,255,255,0.2);
                transform: scale(1.05);
            }
            
            .dropdown-container {
                display: none;
            }
            
            /* Layout móvil mejorado */
            .header-row {
                height: 70px !important;
                padding: 0 16px !important;
                gap: 12px;
            }
            
            /* Logo optimizado para móvil */
            .header-logo {
                flex-shrink: 0;
                order: 2;
            }
            
            .header-logo img {
                height: 50px !important;
                max-width: 180px !important;
                object-fit: contain;
            }
            
            /* Botón menú móvil - primera posición */
            .mobile-menu-container {
                order: 1;
                flex-shrink: 0;
            }
            
            /* Ocultar buscador en header móvil - se mostrará en menú móvil */
            .header-search {
                display: none !important;
            }
            
            /* Acciones del usuario - última posición */
            .header-actions {
                order: 3;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            /* Carrito móvil optimizado */
            .cart-wrapper {
                position: relative;
            }
            
            .cart-icon-btn {
                width: 44px !important;
                height: 44px !important;
                padding: 10px !important;
                border-radius: 8px !important;
                background: rgba(255,255,255,0.1) !important;
            }
            
            .cart-icon-btn:hover {
                background: rgba(255,255,255,0.2) !important;
                transform: scale(1.05) !important;
            }
            
            .cart-count-badge {
                top: -8px !important;
                right: -8px !important;
                min-width: 22px !important;
                height: 22px !important;
                font-size: 12px !important;
                border: 2px solid white !important;
            }
        }
        
        @media (max-width: 480px) {
            .header-row {
                height: 65px !important;
                padding: 0 12px !important;
                gap: 8px;
            }
            
            .header-logo img {
                height: 45px !important;
                max-width: 160px !important;
            }
            
            #mobile-menu-btn {
                width: 40px;
                height: 40px;
            }
            
            .cart-icon-btn {
                width: 40px !important;
                height: 40px !important;
                padding: 8px !important;
            }
            
            .cart-count-badge {
                min-width: 20px !important;
                height: 20px !important;
                font-size: 11px !important;
            }
        }
        
        /* Menú móvil mejorado */
        #mobile-menu {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transform: translateY(-100%);
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        
        #mobile-menu.show {
            transform: translateY(0);
        }
        
        .mobile-search-container {
            background: #f8fafc;
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .mobile-search-form {
            display: flex;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .mobile-search-input {
            flex: 1;
            padding: 14px 16px;
            border: none;
            font-size: 16px;
            outline: none;
            background: transparent;
        }
        
        .mobile-search-btn {
            background: #2563eb;
            color: white;
            border: none;
            padding: 14px 18px;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .mobile-search-btn:hover {
            background: #1d4ed8;
        }
        
        .mobile-menu-content {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
            padding: 20px 16px;
        }
        
        .mobile-menu-section {
            margin-bottom: 24px;
        }
        
        .mobile-menu-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 12px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .mobile-menu-links {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-left: 16px;
        }
        
        .mobile-menu-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .mobile-menu-link:hover {
            background: #f3f4f6;
            color: #2563eb;
            transform: translateX(4px);
        }
        
        .mobile-menu-highlight {
            color: #dc2626 !important;
            font-weight: 600;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }
        
        .mobile-menu-highlight:hover {
            background: #fee2e2 !important;
            color: #b91c1c !important;
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
            
            // Funcionalidad del menú móvil - REMOVIDO (duplicado)
            // Esta funcionalidad está implementada más abajo en el archivo
        });
        
        // Funcionalidad para el efecto scroll del header sticky
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (header) {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
        });
        
        // Eliminado ensureStickyBehavior: se usará un wrapper sticky único via CSS.
    </script>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<div id="page" class="site">
    <!-- Header Simple -->
    <header id="main-header" style="background: #171717; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
        <div>
                <!-- Primera fila: Logo, Buscador, Mi Cuenta y Carrito -->
                <div class="header-row flex w-11/12 xl:w-8/12 mx-auto items-center justify-between">
                
                <!-- Botón menú móvil -->
                <div class="mobile-menu-container">
                    <button id="mobile-menu-btn" style="display: none; background: none; border: none; color: white; cursor: pointer; padding: 8px;">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Logo -->
                <div class="header-logo" style="flex-shrink: 0;">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display: block; text-decoration: none;">
                        <img src="http://itoolsmx.com/wp-content/uploads/2023/11/cropped-image-1.png" alt="iTOOLS MX" style="height: 80px; width: auto; max-width: 320px; object-fit: contain;">    
                    </a>
                </div>
          
                <div class="header-search flex-1 min-w-[300px] xl:min-w-[500px] " style="margin: 20px 40px 0 40px; position: relative;"> 
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="position: relative; display: flex; background: white; border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden;">
                        <!-- Campo de búsqueda -->
                        <input 
                            type="search" 
                            name="s" 
                            id="live-search-input"
                            style="flex: 1; padding: 12px 16px; border: none; font-size: 14px; outline: none;"
                            placeholder="Buscar productos: iPhone, Samsung, herramientas..." 
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                            autocomplete="off"
                        >
                        
                        <!-- Input hidden para especificar que es búsqueda de productos -->
                        <?php if ( post_type_exists('product') ) : ?>
                            <input type="hidden" name="post_type" value="product">
                        <?php endif; ?>
                        
                        <!-- Botón de búsqueda -->
                        <button type="submit" style="background: #414040ff; color: white; border: none; padding: 12px 16px; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: background-color 0.2s;" onmouseover="this.style.background='#112e7eff'" onmouseout="this.style.background='#171717'">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            Buscar
                        </button>
                    </form>
                    
                    <!-- Dropdown de resultados de búsqueda en vivo -->
                    <div id="live-search-results" style="
                        position: absolute;
                        top: 100%;
                        left: 0;
                        right: 0;
                        background: white;
                        border: 1px solid #e5e7eb;
                        border-top: none;
                        border-radius: 0 0 8px 8px;
                        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                        max-height: 400px;
                        overflow-y: auto;
                        z-index: 1000;
                        display: none;
                    ">
                        <!-- Los resultados se cargarán aquí dinámicamente -->
                    </div>
                </div>
                <div class="header-actions" style="display: flex; align-items: center; gap: 16px; flex-shrink: 0;">
                    <?php if ( function_exists('wc_get_account_endpoint_url') && class_exists( 'WooCommerce' ) ) : ?>
                        <!-- Nuevo icono de carrito con contador mejorado -->
                        <div class="cart-wrapper" style="position: relative;">
                            <button id="cart-toggle-new" class="cart-icon-btn cart-trigger" data-cart-trigger style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: white; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease; cursor: pointer; display: flex; align-items: center; justify-content: center; position: relative;" onmouseover="this.style.background='rgba(255,255,255,0.25)'; this.style.transform='scale(1.05)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='scale(1)'">
                                <!-- Icono SVG del carrito -->
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="8" cy="21" r="1"></circle>
                                    <circle cx="19" cy="21" r="1"></circle>
                                    <path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43h-15.12"></path>
                                </svg>
                                <!-- Contador mejorado -->
                                <span id="cart-count-badge" class="cart-count-badge" style="position: absolute; top: -12px; right: -12px; background: #ef4444; color: white; font-size: 16px; font-weight: bold; border-radius: 50%; min-width: 28px; height: 28px; <?php 
                                    if ( function_exists('WC') && WC()->cart ) { 
                                        $cart_count = WC()->cart->get_cart_contents_count();
                                        echo $cart_count > 0 ? 'display: flex;' : 'display: none;';
                                    } else {
                                        echo 'display: none;';
                                    } 
                                    ?> align-items: center; justify-content: center; line-height: 1; border: 3px solid white; box-shadow: 0 3px 6px rgba(0,0,0,0.3);">
                                    <?php 
                                    if ( function_exists('WC') && WC()->cart ) { 
                                        $cart_count = WC()->cart->get_cart_contents_count();
                                        echo $cart_count;
                                    } else {
                                        echo '0';
                                    } 
                                    ?>
                                </span>
                            </button>
                        </div>
                    <?php else : ?>
                        <!-- Nuevo icono de carrito con contador mejorado (fallback) -->
                        <div class="cart-wrapper" style="position: relative;">
                            <button id="cart-toggle-fallback-new" class="cart-icon-btn cart-trigger" data-cart-trigger style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: white; padding: 12px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease; cursor: pointer; display: flex; align-items: center; justify-content: center; position: relative;" onmouseover="this.style.background='rgba(255,255,255,0.25)'; this.style.transform='scale(1.05)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='scale(1)'">
                                <!-- Icono SVG del carrito -->
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="8" cy="21" r="1"></circle>
                                    <circle cx="19" cy="21" r="1"></circle>
                                    <path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43h-15.12"></path>
                                </svg>
                                <!-- Contador mejorado -->
                                <span id="cart-count-badge-fallback" class="cart-count-badge" style="position: absolute; top: -12px; right: -12px; background: #ef4444; color: white; font-size: 16px; font-weight: bold; border-radius: 50%; min-width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; line-height: 1; border: 3px solid white; box-shadow: 0 3px 6px rgba(0,0,0,0.3);">0</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
             
            </div>

            <!-- Segunda fila: Menú de navegación dropdown -->
            <div class="nav-row" style="border-top: 1px solid rgba(255,255,255,0.1); padding: 12px 0;">
                <div style="margin: 0 auto; padding: 0 20px;" class="max-w-7xl">
                    <nav style="display: flex; align-items: center; justify-content: center; gap: 40px;">
                    <!-- Dropdown Refacciones con Submenus Anidados -->
                    <div class="dropdown-container refacciones-dropdown" style="position: relative;">
                        <button class="dropdown-trigger" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; background: none; border: none; color: white; font-weight: 500; cursor: pointer; border-radius: 6px; transition: all 0.2s;">
                            Refacciones
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu" style="position: absolute; top: 100%; left: 0; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); min-width: 220px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.2s; z-index: 1000;">
                            <!-- Items originales de Refacciones -->
                            <a href="<?php echo esc_url( home_url( '/pantallas-lcd/' ) ); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='transparent'">Pantallas LCD & Touch</a>
                            <a href="<?php echo esc_url( home_url( '/baterias/' ) ); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='transparent'">Baterías</a>
                            <a href="<?php echo esc_url( home_url( '/carcasas/' ) ); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='transparent'">Carcasas</a>
                            
                            <!-- Nivel 2: Marcas (submenu) -->
                            <div class="has-submenu" style="position: relative;">
                                <div class="submenu-trigger-item" style="display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; color: #374151; cursor: pointer; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='transparent'">
                                    <span style="font-weight: 500;">Marcas por Modelo</span>
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>
                                
                                <!-- Submenu de Marcas -->
                                <div class="submenu-panel" style="position: absolute; top: -80px; left: 100%; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); min-width: 820px; max-height: 500px; overflow-y: auto; opacity: 0; visibility: hidden; transform: translateX(-10px); transition: all 0.3s; z-index: 1001; margin-left: 4px; padding: 24px;">
                                    
                                    <!-- Grid de Marcas (4 columnas) -->
                                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
                                        
                                        <!-- Columna iPhone -->
                                        <div>
                                            <a href="<?php echo esc_url( home_url( '/apple/' ) ); ?>" style="text-decoration: none;">
                                                <div style="padding: 8px 0 12px 0; font-size: 15px; font-weight: 700; color: #1f2937; border-bottom: 2px solid #2563eb; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#2563eb">
                                                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                                                    </svg>
                                                    iPhone
                                                </div>
                                            </a>
                                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                                <a href="<?php echo esc_url( home_url( '/iphone-15-pro-max/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">iPhone 15 Pro Max</a>
                                                <a href="<?php echo esc_url( home_url( '/iphone-15-pro/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">iPhone 15 Pro</a>
                                                <a href="<?php echo esc_url( home_url( '/iphone-14-pro-max/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">iPhone 14 Pro Max</a>
                                                <a href="<?php echo esc_url( home_url( '/iphone-13-pro-max/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">iPhone 13 Pro Max</a>
                                                <a href="<?php echo esc_url( home_url( '/iphone-12-pro-max/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">iPhone 12 Pro Max</a>
                                                <a href="<?php echo esc_url( home_url( '/iphone-11/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">iPhone 11</a>
                                            </div>
                                        </div>

                                        <!-- Columna Samsung -->
                                        <div>
                                            <a href="<?php echo esc_url( home_url( '/samsung/' ) ); ?>" style="text-decoration: none;">
                                                <div style="padding: 8px 0 12px 0; font-size: 15px; font-weight: 700; color: #1f2937; border-bottom: 2px solid #2563eb; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#2563eb">
                                                        <path d="M22.86 5.82v12.36c0 3.21-2.61 5.82-5.82 5.82H6.96c-3.21 0-5.82-2.61-5.82-5.82V5.82C1.14 2.61 3.75 0 6.96 0h10.08c3.21 0 5.82 2.61 5.82 5.82z"/>
                                                    </svg>
                                                    Samsung
                                                </div>
                                            </a>
                                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                                <a href="<?php echo esc_url( home_url( '/galaxy-s24-ultra/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Galaxy S24 Ultra</a>
                                                <a href="<?php echo esc_url( home_url( '/galaxy-s23-ultra/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Galaxy S23 Ultra</a>
                                                <a href="<?php echo esc_url( home_url( '/galaxy-s22-ultra/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Galaxy S22 Ultra</a>
                                                <a href="<?php echo esc_url( home_url( '/galaxy-a54/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Galaxy A54</a>
                                                <a href="<?php echo esc_url( home_url( '/galaxy-a34/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Galaxy A34</a>
                                                <a href="<?php echo esc_url( home_url( '/galaxy-note/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Galaxy Note</a>
                                            </div>
                                        </div>

                                        <!-- Columna Huawei -->
                                        <div>
                                            <a href="<?php echo esc_url( home_url( '/huawei/' ) ); ?>" style="text-decoration: none;">
                                                <div style="padding: 8px 0 12px 0; font-size: 15px; font-weight: 700; color: #1f2937; border-bottom: 2px solid #2563eb; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#2563eb">
                                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                    </svg>
                                                    Huawei
                                                </div>
                                            </a>
                                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                                <a href="<?php echo esc_url( home_url( '/huawei-p60-pro/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Huawei P60 Pro</a>
                                                <a href="<?php echo esc_url( home_url( '/huawei-mate-50/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Huawei Mate 50</a>
                                                <a href="<?php echo esc_url( home_url( '/huawei-p50-pro/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Huawei P50 Pro</a>
                                                <a href="<?php echo esc_url( home_url( '/honor-90/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Honor 90</a>
                                                <a href="<?php echo esc_url( home_url( '/honor-70/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Honor 70</a>
                                            </div>
                                        </div>

                                        <!-- Columna Xiaomi & Otros -->
                                        <div>
                                            <a href="<?php echo esc_url( home_url( '/xiaomi/' ) ); ?>" style="text-decoration: none;">
                                                <div style="padding: 8px 0 12px 0; font-size: 15px; font-weight: 700; color: #1f2937; border-bottom: 2px solid #2563eb; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#2563eb">
                                                        <path d="M19.15 5c.28 0 .85.11.85.4v13.2c0 .29-.57.4-.85.4h-2.4c-.28 0-.75-.11-.75-.4V5.4c0-.29.47-.4.75-.4h2.4zm-4.8 6c.28 0 .65.11.65.4v7.2c0 .29-.37.4-.65.4h-2.8c-.28 0-.65-.11-.65-.4v-7.2c0-.29.37-.4.65-.4h2.8zm-5 3c.28 0 .65.11.65.4v4.2c0 .29-.37.4-.65.4H6.5c-.28 0-.65-.11-.65-.4v-4.2c0-.29.37-.4.65-.4h2.85zm-5-11c.28 0 .65.11.65.4v10.8c0 .29-.37.4-.65.4H1.65c-.28 0-.65-.11-.65-.4V3.4c0-.29.37-.4.65-.4h2.7z"/>
                                                    </svg>
                                                    Xiaomi & Otros
                                                </div>
                                            </a>
                                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                                <a href="<?php echo esc_url( home_url( '/xiaomi-14-ultra/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Xiaomi 14 Ultra</a>
                                                <a href="<?php echo esc_url( home_url( '/redmi-note-13/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Redmi Note 13</a>
                                                <a href="<?php echo esc_url( home_url( '/motorola-edge/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Motorola Edge</a>
                                                <a href="<?php echo esc_url( home_url( '/oppo/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Oppo</a>
                                                <a href="<?php echo esc_url( home_url( '/vivo/' ) ); ?>" style="color: #4b5563; text-decoration: none; padding: 6px 10px; border-radius: 6px; transition: all 0.2s; font-size: 13px; font-weight: 500;" onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Vivo</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- Footer del mega menu -->
                                    <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e5e7eb; text-align: center;">
                                        <a href="<?php echo esc_url( home_url( '/tienda/' ) ); ?>" style="display: inline-flex; align-items: center; gap: 8px; color: #2563eb; text-decoration: none; font-weight: 600; padding: 10px 20px; background: #f3f4f6; border-radius: 8px; transition: all 0.2s; font-size: 14px;" onmouseover="this.style.backgroundColor='#2563eb'; this.style.color='white'" onmouseout="this.style.backgroundColor='#f3f4f6'; this.style.color='#2563eb'">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            Ver todos los modelos disponibles
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Herramientas -->
                    <div class="dropdown-container" style="position: relative;">
                        <button class="dropdown-trigger" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; background: none; border: none; color: white; font-weight: 500; cursor: pointer; border-radius: 6px; transition: all 0.2s;">
                            Herramientas
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu" style="position: absolute; top: 100%; left: 0; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); min-width: 200px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.2s; z-index: 1000;">
                            <a href="<?php echo esc_url( home_url( '/microscopios/' ) ); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Microscopios</a>
                            <a href="<?php echo esc_url( home_url( '/soldadura/' ) ); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Soldadura</a>
                            <a href="<?php echo esc_url( home_url( '/destornilladores/' ) ); ?>" style="display: block; padding: 12px 16px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;">Destornilladores</a>
                        </div>
                    </div>

                    <!-- Link directo Accesorios -->
                    <a href="/?post_type=product&s=&product_cat=accesorios/" class="nav-item-accesorios" style="padding: 8px 12px; color: white; font-weight: 500; text-decoration: none; border-radius: 6px; transition: all 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.15)'" onmouseout="this.style.backgroundColor='transparent'">
                        Accesorios
                    </a>

                    <!-- Link directo Ofertas -->
                    <a href="/ofertas/" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; color: #fbbf24; font-weight: 600; text-decoration: none; border-radius: 6px; transition: all 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.15)'" onmouseout="this.style.backgroundColor='transparent'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.79 21L3 11.21v2c0 .45.54 1 1.21 1h7.36l2.15 2.15c.31.31.85.31 1.16 0L12.79 21zM11.38 17.41c.39.39.39 1.02 0 1.41-.39.39-1.02.39-1.41 0L8.21 17.06 3 11.85V9c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v2.85l-5.21 5.21-1.76-1.76c-.39-.39-1.02-.39-1.41 0s-.39 1.02 0 1.41l1.76 1.76z"/>
                        </svg>
                        Ofertas
                    </a>

                    

                    <!-- Link directo Catálogo -->
                    <a href="https://docs.google.com/spreadsheets/d/1mA0EoKXmrSMijNkwOgIlhmoHL4XrSNrC/edit?pli=1&gid=409173927#gid=409173927" target="_blank" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; color: #10b981; font-weight: 600; text-decoration: none; border-radius: 6px; transition: all 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.15)'" onmouseout="this.style.backgroundColor='transparent'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                        </svg>
                        Catálogo
                    </a>
                    <!-- Link Valoraciones -->
                    <a href="/valoraciones/" class="nav-item-valoraciones" style="display: flex; align-items: center; gap: 4px; padding: 8px 12px; color: #3b82f6; font-weight: 600; text-decoration: none; border-radius: 6px; transition: all 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.15)'" onmouseout="this.style.backgroundColor='transparent'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        Valoraciones
                    </a>
                </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- CSS y JavaScript para Header Sticky -->
    <style>
        /* Estilos para el header sticky */
        #main-header.sticky {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            background: rgba(23, 23, 23, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4) !important;
            transform: translateY(0) !important;
            animation: slideDown 0.3s ease-out !important;
        }

        /* Animación para el header sticky */
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Espaciado para compensar el header fijo */
        body.header-sticky-active {
            padding-top: 100px;
        }

        /* Mejoras visuales para el header sticky */
        #main-header.sticky .header-logo img {
            height: 60px !important;
            transition: height 0.3s ease !important;
        }

        #main-header.sticky .header-row {
            height: 80px !important;
            transition: height 0.3s ease !important;
        }

        /* Responsive para móviles */
        @media (max-width: 768px) {
            #main-header.sticky .header-logo img {
                height: 50px !important;
            }
            
            #main-header.sticky .header-row {
                height: 70px !important;
            }
            
            body.header-sticky-active {
                padding-top: 70px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('main-header');
            const body = document.body;
            let lastScrollTop = 0;
            let isSticky = false;
            
            function handleScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const headerHeight = header.offsetHeight;
                
                // Hacer sticky cuando se haga scroll hacia abajo más de la altura del header
                if (scrollTop > headerHeight) {
                    if (!isSticky) {
                        header.classList.add('sticky');
                        body.classList.add('header-sticky-active');
                        isSticky = true;
                    }
                    
                    // El header siempre debe estar visible cuando está en modo sticky
                    header.classList.remove('sticky-hidden');
                    
                } else {
                    // Remover sticky cuando esté en la parte superior
                    if (isSticky) {
                        header.classList.remove('sticky', 'sticky-hidden');
                        body.classList.remove('header-sticky-active');
                        isSticky = false;
                    }
                }
                
                lastScrollTop = scrollTop;
            }
            
            // Throttle scroll events para mejor rendimiento
            let ticking = false;
            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(handleScroll);
                    ticking = true;
                    setTimeout(() => { ticking = false; }, 16);
                }
            }
            
            window.addEventListener('scroll', requestTick);
            
            // Manejar resize para recalcular posiciones
            window.addEventListener('resize', function() {
                if (isSticky) {
                    handleScroll();
                }
            });
        });
    </script>

    <!-- Menú móvil -->
    <div id="mobile-menu" style="
        display: none; 
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: white;
        z-index: 9999;
        transform: translateX(-100%);
        transition: all 0.3s ease;
        opacity: 0;
        overflow-y: auto;
    ">
        <div style="padding: 20px;">
            <!-- Header del menú móvil con botón de cierre -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 2px solid #f3f4f6;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #2563eb, #1d4ed8); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div>
                        <h2 style="font-size: 18px; font-weight: 700; color: #1f2937; margin: 0;">Menú Principal</h2>
                        <p style="font-size: 12px; color: #6b7280; margin: 0;">Explora nuestros productos</p>
                    </div>
                </div>
                <button id="mobile-menu-close" style="
                    width: 44px; 
                    height: 44px; 
                    background: #f3f4f6; 
                    border: none; 
                    border-radius: 12px; 
                    display: flex; 
                    align-items: center; 
                    justify-content: center; 
                    cursor: pointer;
                    transition: all 0.2s ease;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                " onmouseover="this.style.background='#e5e7eb'; this.style.transform='scale(1.05)'" onmouseout="this.style.background='#f3f4f6'; this.style.transform='scale(1)'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Search - Enhanced -->
            <div style="margin-bottom: 24px; position: sticky; top: 0; background: white; padding-bottom: 16px; border-bottom: 1px solid #e5e7eb;">
                <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="position: relative;">
                    <div style="display: flex; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <input 
                            type="search" 
                            name="s" 
                            id="mobile-search-input"
                            style="flex: 1; padding: 16px 20px; border: none; background: transparent; font-size: 16px; outline: none; color: #1a202c;"
                            placeholder="¿Qué estás buscando?" 
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                            autocomplete="off"
                        >
                        <input type="hidden" name="post_type" value="<?php echo post_type_exists('product') ? 'product' : 'post'; ?>">
                        <button type="submit" style="background: #2563eb; color: white; border: none; padding: 16px 20px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: 600; transition: background-color 0.2s;" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            Buscar
                        </button>
                    </div>
                    
                    <!-- Quick search suggestions for mobile -->
                    <div style="margin-top: 12px; display: flex; flex-wrap: wrap; gap: 8px;">
                        <span style="font-size: 12px; color: #6b7280; font-weight: 500;">Búsquedas populares:</span>
                        <a href="<?php echo esc_url( home_url( '/?s=iphone+15&post_type=product' ) ); ?>" style="background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 6px; font-size: 12px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">iPhone 15</a>
                        <a href="<?php echo esc_url( home_url( '/?s=samsung+galaxy&post_type=product' ) ); ?>" style="background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 6px; font-size: 12px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Samsung Galaxy</a>
                        <a href="<?php echo esc_url( home_url( '/?s=pantallas&post_type=product' ) ); ?>" style="background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 6px; font-size: 12px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Pantallas</a>
                    </div>
                </form>
            </div>
            
            <!-- Enhanced Mobile Menu Links -->
            <div style="display: flex; flex-direction: column; gap: 0;">
                <!-- Refacciones Section -->
                <div style="border-bottom: 1px solid #f3f4f6;">
                    <div style="padding: 16px 0; display: flex; align-items: center; justify-content: space-between; cursor: pointer;" onclick="toggleMobileSection('refacciones')">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; background: #eff6ff; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#2563eb">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-weight: 600; color: #1f2937; margin: 0; font-size: 16px;">Refacciones</h3>
                                <p style="font-size: 12px; color: #6b7280; margin: 0;">Pantallas, baterías y más</p>
                            </div>
                        </div>
                        <svg id="refacciones-arrow" width="16" height="16" fill="#6b7280" viewBox="0 0 16 16" style="transition: transform 0.2s;">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                    <div id="refacciones-content" style="display: none; padding: 0 0 16px 52px; animation: slideDown 0.3s ease;">
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <a href="<?php echo esc_url( home_url( '/pantallas-lcd/' ) ); ?>" style="color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid #f9fafb;">Pantallas LCD & Touch</a>
                            <a href="<?php echo esc_url( home_url( '/baterias/' ) ); ?>" style="color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid #f9fafb;">Baterías</a>
                            <a href="<?php echo esc_url( home_url( '/carcasas/' ) ); ?>" style="color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid #f9fafb;">Carcasas</a>
                            <a href="<?php echo esc_url( home_url( '/flex/' ) ); ?>" style="color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0;">Flex y Conectores</a>
                        </div>
                    </div>
                </div>
                
                <!-- Herramientas Section -->
                <div style="border-bottom: 1px solid #f3f4f6;">
                    <div style="padding: 16px 0; display: flex; align-items: center; justify-content: space-between; cursor: pointer;" onclick="toggleMobileSection('herramientas')">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; background: #f0fdf4; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#16a34a">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-weight: 600; color: #1f2937; margin: 0; font-size: 16px;">Herramientas</h3>
                                <p style="font-size: 12px; color: #6b7280; margin: 0;">Equipos profesionales</p>
                            </div>
                        </div>
                        <svg id="herramientas-arrow" width="16" height="16" fill="#6b7280" viewBox="0 0 16 16" style="transition: transform 0.2s;">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                    <div id="herramientas-content" style="display: none; padding: 0 0 16px 52px;">
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <a href="<?php echo esc_url( home_url( '/microscopios/' ) ); ?>" style="color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid #f9fafb;">Microscopios</a>
                            <a href="<?php echo esc_url( home_url( '/soldadura/' ) ); ?>" style="color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid #f9fafb;">Soldadura</a>
                            <a href="<?php echo esc_url( home_url( '/destornilladores/' ) ); ?>" style="color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0;">Destornilladores</a>
                        </div>
                    </div>
                </div>
                
                <!-- Marcas Section -->
                <div style="border-bottom: 1px solid #f3f4f6;">
                    <div style="padding: 16px 0; display: flex; align-items: center; justify-content: space-between; cursor: pointer;" onclick="toggleMobileSection('marcas')">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; background: #fef3c7; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#d97706">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-weight: 600; color: #1f2937; margin: 0; font-size: 16px;">Marcas</h3>
                                <p style="font-size: 12px; color: #6b7280; margin: 0;">Apple, Samsung, Huawei</p>
                            </div>
                        </div>
                        <svg id="marcas-arrow" width="16" height="16" fill="#6b7280" viewBox="0 0 16 16" style="transition: transform 0.2s;">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                    <div id="marcas-content" style="display: none; padding: 0 0 16px 52px;">
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <a href="<?php echo esc_url( home_url( '/apple/' ) ); ?>" style="display: flex; align-items: center; gap: 8px; color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid #f9fafb;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                                </svg>
                                Apple
                            </a>
                            <a href="<?php echo esc_url( home_url( '/samsung/' ) ); ?>" style="display: flex; align-items: center; gap: 8px; color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid #f9fafb;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M22.86 5.82v12.36c0 3.21-2.61 5.82-5.82 5.82H6.96c-3.21 0-5.82-2.61-5.82-5.82V5.82C1.14 2.61 3.75 0 6.96 0h10.08c3.21 0 5.82 2.61 5.82 5.82z"/>
                                </svg>
                                Samsung
                            </a>
                            <a href="<?php echo esc_url( home_url( '/huawei/' ) ); ?>" style="display: flex; align-items: center; gap: 8px; color: #4b5563; text-decoration: none; font-size: 14px; padding: 8px 0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                Huawei
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Direct Links -->
                <div style="padding: 20px 0; border-bottom: 1px solid #f3f4f6;">
                    <a href="/?post_type=product&s=&product_cat=accesorios/" style="display: flex; align-items: center; gap: 12px; color: #374151; font-weight: 500; text-decoration: none; padding: 12px 0;">
                        <div style="width: 40px; height: 40px; background: #f3e8ff; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#7c3aed">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div>
                            <span style="font-size: 16px;">Accesorios</span>
                            <p style="font-size: 12px; color: #6b7280; margin: 0;">Fundas, cables y más</p>
                        </div>
                    </a>
                </div>
                
                <div style="padding: 20px 0;">
                    <a href="/ofertas/" style="display: flex; align-items: center; gap: 12px; color: #dc2626; font-weight: 600; text-decoration: none; padding: 12px 0;">
                        <div style="width: 40px; height: 40px; background: #fef2f2; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#dc2626">
                                <path d="M12.79 21L3 11.21v2c0 .45.54 1 1.21 1h7.36l2.15 2.15c.31.31.85.31 1.16 0L12.79 21z"/>
                            </svg>
                        </div>
                        <div>
                            <span style="font-size: 16px;">Ofertas Especiales</span>
                            <p style="font-size: 12px; color: #dc2626; margin: 0;">Descuentos exclusivos</p>
                        </div>
                    </a>
                    
                    <a href="https://docs.google.com/spreadsheets/d/1mA0EoKXmrSMijNkwOgIlhmoHL4XrSNrC/edit?pli=1&gid=409173927#gid=409173927" target="_blank" style="display: flex; align-items: center; gap: 12px; color: #10b981; font-weight: 600; text-decoration: none; padding: 12px 0;">
                        <div style="width: 40px; height: 40px; background: #f0fdf4; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#10b981">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                        </div>
                        <div>
                            <span style="font-size: 16px;">Catálogo Completo</span>
                            <p style="font-size: 12px; color: #10b981; margin: 0;">Ver todos los productos</p>
                        </div>
                    </a>

                    <a href="/valoraciones/" target="_blank" style="display: flex; align-items: center; gap: 12px; color: #0e42b1ff; font-weight: 600; text-decoration: none; padding: 12px 0;">
                        <div style="width: 40px; height: 40px; background: #f0fdf4; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#0e42b1ff">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                        </div>
                        <div>
                            <span style="font-size: 16px;">Valoraciones</span>
                            <p style="font-size: 12px; color: #0e42b1ff; margin: 0;">Ver todos los productos</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php 
// Botón flotante de WhatsApp - VERSIÓN HEADER
$whatsapp_number = '5218994178810'; // Cambia este número por el número de WhatsApp de la empresa
$whatsapp_message = '¡Hola! Me interesa obtener más información sobre sus productos.'; // Mensaje predeterminado
$whatsapp_url = 'https://wa.me/' . $whatsapp_number . '?text=' . urlencode($whatsapp_message);
?>

<!-- BOTÓN FLOTANTE WHATSAPP - CORREGIDO -->
<button onclick="openTally()" 
   id="whatsapp-super-button"
   title="Contactar por WhatsApp"
   style="
       position: fixed !important;
       bottom: 30px !important;
       right: 30px !important;
       width: 56px !important;
       height: 56px !important;
       background: #25D366 !important;
       border-radius: 50% !important;
       display: flex !important;
       align-items: center !important;
       justify-content: center !important;
       text-decoration: none !important;
       box-shadow: 0 6px 24px rgba(37, 211, 102, 0.5) !important;
       transition: all 0.3s ease !important;
       z-index: 9999 !important;
       border: 2px solid #ffffff !important;
       cursor: pointer !important;
   ">
    <!-- Ícono de WhatsApp usando SVG para mayor compatibilidad -->
    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor" style="color: #ffffff;">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.484 3.206z"/>
    </svg>
</button>

<style>
/* CSS adicional para el botón WhatsApp */
#whatsapp-super-button:hover {
    background: #20BA5A !important;
    transform: scale(1.1) !important;
    box-shadow: 0 12px 40px rgba(37, 211, 102, 0.8) !important;
}

/* Animación de pulso */
#whatsapp-super-button::before {
    content: '' !important;
    position: absolute !important;
    top: -5px !important;
    left: -5px !important;
    right: -5px !important;
    bottom: -5px !important;
    border-radius: 50% !important;
    border: 3px solid #25D366 !important;
    animation: whatsapp-pulse-super 2s infinite !important;
    opacity: 0 !important;
}

@keyframes whatsapp-pulse-super {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.3);
        opacity: 0;
    }
}

/* Responsive para móviles */
@media (max-width: 768px) {
    #whatsapp-super-button {
        width: 50px !important;
        height: 50px !important;
        bottom: 20px !important;
        right: 20px !important;
    }
    
    #whatsapp-super-button i {
        font-size: 28px !important;
    }
}
</style>

<div id="content" class="site-content">

<!-- Nuevo Sidepanel del Carrito -->
<!-- Overlay -->
<div id="cart-overlay" class="cart-overlay"></div>

<!-- Sidepanel -->
<div id="cart-sidepanel" class="cart-sidepanel">
    <!-- Header -->
    <div class="cart-header">
        <div class="cart-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="8" cy="21" r="1"></circle>
                <circle cx="19" cy="21" r="1"></circle>
                <path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
            </svg>
            <span>Mi Carrito</span>
            <span id="cart-count" class="cart-count">0</span>
        </div>
        <button id="cart-close" class="cart-close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- Content -->
    <div id="cart-content" class="cart-content">
        <div class="cart-empty">
            <div class="empty-icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="8" cy="21" r="1"></circle>
                    <circle cx="19" cy="21" r="1"></circle>
                    <path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                </svg>
            </div>
            <h3>Tu carrito está vacío</h3>
            <p>Descubre nuestros productos y comienza a comprar</p>
            <a href="/tienda" class="btn-shop">
                Ir a la Tienda
            </a>
        </div>
    </div>

    <!-- Footer -->
    <div id="cart-footer" class="cart-footer" style="display: none;">
        <div class="cart-summary">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span id="cart-subtotal">$0.00</span>
            </div>
            <div class="summary-row total">
                <span>Total:</span>
                <span id="cart-total">$0.00</span>
            </div>
        </div>
        <div class="cart-actions">
            <a href="/finalizar-compra/" class="btn-checkout">
                Finalizar Compra
            </a>
        </div>
    </div>
</div>

<script>
// Initialize Lucide icons when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
        console.log('✅ Lucide icons initialized in header');
    } else {
        console.error('❌ Lucide library not loaded');
    }

    // Enhanced Mobile Menu Functionality
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const body = document.body;
    let isMenuOpen = false;
    let isToggling = false; // Flag to prevent rapid toggling

    if (mobileMenuBtn && mobileMenu) {
        // Function to open the menu
        function openMobileMenu() {
            if (isToggling) return;
            isToggling = true;
            
            isMenuOpen = true;
            mobileMenu.style.display = 'block';
            mobileMenu.style.transform = 'translateX(0)';
            mobileMenu.style.opacity = '1';
            body.style.overflow = 'hidden'; // Prevent body scroll
            mobileMenuBtn.setAttribute('aria-expanded', 'true');
            
            // Change icon to X
            mobileMenuBtn.innerHTML = `
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                </svg>
            `;
            
            // Reset toggle flag after animation
            setTimeout(() => {
                isToggling = false;
            }, 350);
        }

        // Function to close the menu
        function closeMobileMenu() {
            if (isToggling) return;
            isToggling = true;
            
            isMenuOpen = false;
            mobileMenu.style.transform = 'translateX(-100%)';
            mobileMenu.style.opacity = '0';
            body.style.overflow = ''; // Restore body scroll
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            
            // Reset all expanded sections
            const sections = ['refacciones', 'herramientas', 'marcas'];
            sections.forEach(section => {
                const content = document.getElementById(section + '-content');
                const arrow = document.getElementById(section + '-arrow');
                if (content && arrow) {
                    content.style.display = 'none';
                    arrow.style.transform = 'rotate(0deg)';
                }
            });
            
            // Change icon back to hamburger
            mobileMenuBtn.innerHTML = `
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            `;
            
            // Hide after animation and reset toggle flag
            setTimeout(() => {
                if (!isMenuOpen) {
                    mobileMenu.style.display = 'none';
                }
                isToggling = false;
            }, 350);
        }

        // Toggle mobile menu sections
        window.toggleMobileSection = function(sectionName) {
            const content = document.getElementById(sectionName + '-content');
            const arrow = document.getElementById(sectionName + '-arrow');
            
            if (content && arrow) {
                const isExpanded = content.style.display === 'block';
                
                if (isExpanded) {
                    content.style.display = 'none';
                    arrow.style.transform = 'rotate(0deg)';
                } else {
                    content.style.display = 'block';
                    arrow.style.transform = 'rotate(180deg)';
                }
            }
        };

        // Mobile menu toggle
        mobileMenuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (isMenuOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        // Close button functionality
        const mobileMenuCloseBtn = document.getElementById('mobile-menu-close');
        if (mobileMenuCloseBtn) {
            mobileMenuCloseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeMobileMenu();
            });
        }

        // Close menu when clicking outside - RE-ENABLED with better logic
        document.addEventListener('click', function(e) {
            if (isMenuOpen && !isToggling) {
                // Check if click is outside menu and not on menu button or close button
                const isOutsideMenu = !mobileMenu.contains(e.target);
                const isNotMenuButton = !mobileMenuBtn.contains(e.target);
                const mobileMenuCloseBtn = document.getElementById('mobile-menu-close');
                const isNotCloseButton = !mobileMenuCloseBtn || !mobileMenuCloseBtn.contains(e.target);
                
                if (isOutsideMenu && isNotMenuButton && isNotCloseButton) {
                    closeMobileMenu();
                }
            }
        });

        // Close menu with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isMenuOpen) {
                closeMobileMenu();
            }
        });

        // Close menu when clicking on links - DISABLED temporarily to debug
        // const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        // mobileMenuLinks.forEach(link => {
        //     link.addEventListener('click', function() {
        //         closeMobileMenu();
        //     });
        // });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && isMenuOpen) {
                closeMobileMenu();
            }
        });

        // Touch gesture support (swipe)
        let touchStartX = 0;
        let touchEndX = 0;

        mobileMenu.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        mobileMenu.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const swipeDistance = touchStartX - touchEndX;
            
            // Swipe left to close
            if (swipeDistance > swipeThreshold) {
                closeMobileMenu();
            }
        }

        // Focus management for accessibility
        mobileMenu.addEventListener('keydown', function(event) {
            if (event.key === 'Tab') {
                const focusableElements = mobileMenu.querySelectorAll('a, button, input, [tabindex]:not([tabindex="-1"])');
                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];

                if (event.shiftKey && document.activeElement === firstElement) {
                    event.preventDefault();
                    lastElement.focus();
                } else if (!event.shiftKey && document.activeElement === lastElement) {
                    event.preventDefault();
                    firstElement.focus();
                }
            }
        });
    }
});

// Re-initialize icons when cart fragments are updated
document.body.addEventListener('wc_fragments_refreshed', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
        console.log('✅ Lucide icons re-initialized after cart update');
    }
});
</script>
